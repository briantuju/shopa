<?php

namespace App\Filament\Vendor\Resources\Products\Schemas;

use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\Product;
use App\Models\ProductVariant;
use Exception;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Database\Eloquent\Model;

class ProductForm
{
    /**
     * @throws Exception
     */
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Group::make()
                ->schema([
                    Section::make('Product Details')
                        ->schema([
                            TextInput::make('name')
                                ->label('Give your product a name')
                                ->placeholder('Example Iphone 14 Pro Max')
                                ->required()
                                ->maxLength(255),

                            TextInput::make('sku')
                                ->label('Base SKU')
                                ->helperText('A general SKU for the product. Each variant will have its own unique SKU.')
                                ->unique(Product::class, 'sku', ignoreRecord: true)
                                ->live(onBlur: true)
                                // ->afterStateUpdated(fn (string $operation, $state, Set $set) => $operation === 'create' ? $set('sku', $state) : null)
                                ->required(),

                            RichEditor::make('description')
                                ->placeholder('Describe your product in detail here...')
                                ->columnSpanFull(),

                            FileUpload::make('main_image')
                                ->helperText('This is the main image for the product. It will be used in the product listing.')
                                ->disk('public')
                                ->directory('products')
                                ->image()
                                ->required(),

                            Group::make()
                                ->schema([
                                    Section::make('')
                                        ->schema([
                                            Select::make('category_id')
                                                ->label('Select a category for this product')
                                                ->native(false)
                                                ->preload()
                                                ->searchable()
                                                ->relationship('category', 'name')
                                                ->required(),

                                            Select::make('brand_id')
                                                ->label('Select a brand for this product')
                                                ->native(false)
                                                ->preload()
                                                ->searchable()
                                                ->nullable()
                                                ->relationship('brand', 'name'),
                                        ]),
                                ]),
                        ])->columns(2),

                    Section::make('Product Variants')
                        ->schema([
                            Toggle::make('has_variants')
                                ->label('This product has multiple options (like size or color).')
                                ->live()
                                ->default(true)
                                ->dehydrated(false), // This is for UI logic only, not saved

                            Repeater::make('productVariants')
                                ->relationship()
                                ->label('') // The section provides context
                                ->schema([
                                    TextInput::make('sku')
                                        ->label('Variant SKU')
                                        ->required()
                                        ->unique(ProductVariant::class, 'sku', ignoreRecord: true)
                                        ->helperText('Unique identifier for this specific variation.'),

                                    TextInput::make('price')
                                        ->numeric()
                                        ->rules(['regex:/^\d{1,6}(\.\d{0,2})?$/'])
                                        ->prefix('Ksh')
                                        ->minValue(0.1)
                                        ->default(1)
                                        ->step(0.1)
                                        ->required(),

                                    TextInput::make('stock')
                                        ->numeric()
                                        ->integer()
                                        ->minValue(1)
                                        ->step(1)
                                        ->default(1)
                                        ->required(),

                                    FileUpload::make('image')
                                        ->label('Variant Image')
                                        ->disk('public')
                                        ->maxSize(1024 * 5) // 5MB
                                        ->directory('products')
                                        ->image()
                                        ->nullable()
                                        ->columnSpanFull(),

                                    Repeater::make('attributeValues')
                                        // ->relationship(name: 'attributeValues') // This links to the product_variation_attribute_value pivot table
                                        ->label('Attributes for this Variation')
                                        ->schema([
                                            Select::make('attribute_id')
                                                ->label('Attribute Name')
                                                ->searchable()
                                                ->preload()
                                                ->native(false)
                                                ->options(Attribute::all()->pluck('name', 'id'))
                                                ->reactive() // Make it reactive to load values for attribute_value_id
                                                ->required()
                                                ->distinct() // Ensure unique attribute selected within this variation's attributes
                                                ->disableOptionsWhenSelectedInSiblingRepeaterItems(), // Prevent selecting same attribute in other rows of this nested repeater

                                            Select::make('attribute_value_id')
                                                ->label('Attribute Value')
                                                ->searchable()
                                                ->preload()
                                                ->native(false)
                                                ->options(function (Get $get) {
                                                    $attributeId = $get('attribute_id');
                                                    if ($attributeId) {
                                                        return AttributeValue::where('attribute_id', $attributeId)
                                                            ->pluck('value', 'id');
                                                    }

                                                    return [];
                                                })
                                                ->required()
                                                ->distinct() // Ensure unique attribute value selected within this attribute
                                                ->disableOptionsWhenSelectedInSiblingRepeaterItems(), // Prevent selecting same value for the same attribute
                                        ])
                                        ->columns(2) // Two columns for attribute name and value
                                        // ->minItems(1) // Each variation must have at least one attribute
                                        ->defaultItems(1)
                                        ->addActionLabel('Add Attribute')
                                        ->columnSpanFull() // This nested repeater takes full width
                                        ->helperText('Select the attributes that define this specific variation (e.g., Color: Red, Size: M).')
                                        // Only show this field if the 'has_variants' toggle is on
                                        ->visible(fn (string $operation, Get $get) => $get('../../has_variants'))
                                        ->afterStateHydrated(function (Repeater $component, ?Model $record, ?array $state) {
                                            if ($record && $record->relationLoaded('attributeValues')) {
                                                // Transform existing pivot data into the repeater's expected format
                                                $formattedAttributeValues = $record->attributeValues
                                                    ->map(function ($value) {
                                                        return [
                                                            'attribute_id' => $value->attribute_id,
                                                            'attribute_value_id' => $value->id,
                                                        ];
                                                    })->toArray();
                                                $component->state($formattedAttributeValues);
                                            }
                                        }),

                                ])
                                ->defaultItems(1) // Always start with one variant
                                ->minItems(1) // A product must have at least one variant to be sellable
                                ->cloneable(fn (Get $get) => $get('has_variants')) // Allow adding more variants only if toggled
                                ->deletable(fn (Get $get) => $get('has_variants')) // Allow deleting variants only if toggled
                                ->reorderable()
                                ->collapsible()
                                ->columns(['md' => 2, 'base' => 1])
                                ->itemLabel(fn (array $state): ?string => $state['sku'] ?? 'New Variant'),

                        ]),
                ])->columnSpanFull(),
        ])->columns(3);
    }
}
