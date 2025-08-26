<?php

namespace App\Filament\Resources\Vendors\Schemas;

use App\Enums\BusinessType;
use App\Enums\VendorStatus;
use App\Models\User;
use Exception;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class VendorForm
{
    /**
     * @throws Exception
     */
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Business Information')
                    ->columns(2)
                    ->schema([
                        TextInput::make('business_name')
                            ->required()
                            ->maxLength(255),
                        Select::make('business_type')
                            ->native(false)
                            ->options(BusinessType::class)
                            ->required(),
                        TextInput::make('registration_number'),
                        TextInput::make('tax_id'),
                    ]),

                Section::make('Storefront')
                    ->columns(2)
                    ->schema([
                        TextInput::make('store_name')
                            ->required(),
                        Textarea::make('store_description')
                            ->rows(3),
                        FileUpload::make('store_logo')
                            ->image()
                            ->disk('public')
                            ->directory('store-logos')
                            ->imageResizeMode('cover')
                            ->imageCropAspectRatio('1:1')
                            ->imagePreviewHeight('100')
                            ->columnSpanFull(),
                        FileUpload::make('store_banner')
                            ->image()
                            ->disk('public')
                            ->directory('store-banners')
                            ->imageResizeMode('cover')
                            ->imageCropAspectRatio('16:9')
                            ->imagePreviewHeight('150')
                            ->columnSpanFull(),
                    ]),

                Section::make('Address')
                    ->columns(2)
                    ->schema([
                        TextInput::make('address_line'),
                        TextInput::make('city'),
                        TextInput::make('state'),
                        //                        Select::make('country')
                        //                            ->disabled()
                        //                            ->options(['Kenya'])
                        //                            ->default('Kenya'),
                        TextInput::make('postal_code'),
                    ]),

                Section::make('Status & Ownership')
                    ->columns(2)
                    ->schema([
                        Select::make('status')
                            ->native(false)
                            ->preload()
                            ->searchable()
                            ->options(VendorStatus::class)
                            ->default(VendorStatus::PENDING->value),
                        Select::make('user_id')
                            ->relationship(name: 'user', titleAttribute: 'name')
                            ->disabled()
                            ->getOptionLabelFromRecordUsing(function (User $user): string {
                                $roles = $user->getRoleNames()
                                    ->map(fn ($role) => strtolower($role))
                                    ->map(fn ($role) => ucfirst($role))
                                    ->implode(', ');
                                $roles_str = empty($roles) ? '' : "($roles)";

                                return "$user->name $roles_str";
                            })
                            ->createOptionForm([
                                Grid::make()
                                    ->components([
                                        TextInput::make('name')
                                            ->maxLength(200)
                                            ->required(),
                                        TextInput::make('email')
                                            ->unique('users', 'email')
                                            ->maxLength(200)
                                            ->required()
                                            ->email(),
                                        TextInput::make('password')
                                            ->required(),
                                        TextInput::make('password_confirmation')
                                            ->required(),
                                        // TODO: Customize user relationship creation
                                        //  since we need to assign a role to the user
                                    ])
                                    ->columns(['base' => 1, 'md' => 2]),
                            ])
                            ->required(),
                    ]),
            ]);
    }
}
