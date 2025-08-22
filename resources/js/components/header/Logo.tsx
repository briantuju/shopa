import { Link } from '@inertiajs/react';
import { route } from 'ziggy-js';

const Logo = () => (
    <Link href={route('home')} className="text-xl font-bold tracking-tight text-blue-600">
        Shopa
    </Link>
);

export default Logo;
