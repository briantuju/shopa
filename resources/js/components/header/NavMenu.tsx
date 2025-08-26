import { useZiggyRoute } from '@/hooks/useZiggyRoute';
import { InertiaSharedData } from '@/types';
import { Link, usePage } from '@inertiajs/react';
import { Button } from '@mantine/core';

interface NavMenuProps {
    vertical?: boolean;
}

const NavMenu = ({ vertical = false }: NavMenuProps) => {
    const route = useZiggyRoute();
    const { is_vendor } = usePage<InertiaSharedData>().props;

    const navItems = [
        { label: 'Shop', path: '/' },
        { label: 'Categories', path: '/' },
        { label: 'Deals', path: '/' },
        { label: 'Start Selling', path: is_vendor ? route('filament.vendor.pages.dashboard') : route('auth.vendor-signup-page') },
    ];

    return (
        <nav>
            <ul className={`flex gap-6 ${vertical ? 'mt-2 flex-col space-y-2' : 'items-center'}`}>
                {navItems.map((item) =>
                    item.label === 'Start Selling' ? (
                        <Button key={item.label} component="a" href={item.path} size="xs" variant="outline">
                            {item.label}
                        </Button>
                    ) : (
                        <li key={item.label}>
                            <Link href={item.path} className="text-gray-700 transition-colors hover:text-blue-600">
                                {item.label}
                            </Link>
                        </li>
                    ),
                )}
            </ul>
        </nav>
    );
};

export default NavMenu;
