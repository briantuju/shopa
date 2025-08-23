import type { Config } from 'ziggy-js';

export interface Auth {
    user: User;
}

interface Flash {
    flash: {
        message?: string;
        error?: string;
        success?: string;
        title?: string;
    };
}

export interface InertiaSharedData extends Flash {
    name: string;
    auth: Auth;
    ziggy: Config & { location: string };
    [key: string]: unknown;
}

export interface User {
    id: number;
    name: string;
    email: string;
    avatar?: string;
    email_verified_at: string | null;
    created_at: string;
    updated_at: string;
    [key: string]: unknown; // This allows for additional properties...
}
