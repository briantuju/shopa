import { Link } from '@inertiajs/react';
import { HiOutlineHeart, HiOutlineShoppingCart, HiOutlineUser } from 'react-icons/hi2';

const UserActions = () => {
    return (
        <div className="flex items-center gap-4">
            <Link href="/public" className="relative">
                <HiOutlineHeart className="h-6 w-6 text-gray-600 hover:text-blue-600" />
            </Link>

            <Link href="/public" className="relative">
                <HiOutlineShoppingCart className="h-6 w-6 text-gray-600 hover:text-blue-600" />
                <span className="absolute -top-2 -right-2 rounded-full bg-blue-600 px-1.5 text-xs text-white">2</span>
            </Link>

            <Link href="/public">
                <HiOutlineUser className="h-6 w-6 text-gray-600 hover:text-blue-600" />
            </Link>
        </div>
    );
};

export default UserActions;
