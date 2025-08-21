import { Link } from '@inertiajs/react';

interface NavMenuProps {
    vertical?: boolean;
}

const NavMenu = ({ vertical = false }: NavMenuProps) => {
    const navItems = [
        { label: 'Shop', path: '/' },
        { label: 'Categories', path: '/' },
        { label: 'Deals', path: '/' },
        { label: 'Contact', path: '/' },
    ];

    return (
        <nav>
            <ul className={`flex gap-6 ${vertical ? 'mt-2 flex-col space-y-2' : 'items-center'}`}>
                {navItems.map((item) => (
                    <li key={item.path}>
                        <Link href={item.path} className="text-gray-700 transition-colors hover:text-blue-600">
                            {item.label}
                        </Link>
                    </li>
                ))}
            </ul>
        </nav>
    );
};

export default NavMenu;
