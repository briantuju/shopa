import { useAppContext } from '@/context/app';
import { useZiggyRoute } from '@/hooks/useZiggyRoute';
import { Link, router } from '@inertiajs/react';
import { Menu, UnstyledButton } from '@mantine/core';
import { useState } from 'react';
import { HiOutlineHeart, HiOutlineShoppingCart, HiOutlineUser } from 'react-icons/hi2';

const UserActions = () => {
    const [loading, setLoading] = useState(false);
    const route = useZiggyRoute();
    const app = useAppContext();

    const handleLogout = () => {
        router.post(route('auth.logout'), undefined, {
            onStart: () => setLoading(true),
            onFinish: () => setLoading(false),
        });
    };

    return (
        <div className="flex items-center gap-4">
            <Link href="/public" className="relative">
                <HiOutlineHeart className="h-6 w-6 text-gray-600 hover:text-blue-600" />
            </Link>

            <Link href="/public" className="relative">
                <HiOutlineShoppingCart className="h-6 w-6 text-gray-600 hover:text-blue-600" />
                <span className="absolute -top-2 -right-2 rounded-full bg-blue-600 px-1.5 text-xs text-white">2</span>
            </Link>

            <Menu shadow="md" width={200}>
                <Menu.Target>
                    <UnstyledButton
                        style={{
                            padding: 'var(--mantine-spacing-sm)',
                            color: 'var(--mantine-color-text)',
                            borderRadius: 'var(--mantine-radius-sm)',
                        }}
                    >
                        <HiOutlineUser size={20} />
                    </UnstyledButton>
                </Menu.Target>

                <Menu.Dropdown>
                    {app.user ? (
                        <>
                            <Menu.Item onClick={handleLogout} color="red" disabled={loading}>
                                Logout
                            </Menu.Item>
                        </>
                    ) : (
                        <>
                            <Menu.Item component={Link} href={route('auth.login-page')}>
                                Login
                            </Menu.Item>
                            <Menu.Item component={Link} href={route('auth.signup-page')}>
                                Signup
                            </Menu.Item>
                        </>
                    )}
                </Menu.Dropdown>
            </Menu>
        </div>
    );
};

export default UserActions;
