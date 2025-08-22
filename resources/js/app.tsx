import '../css/app.css';

import MainLayout from '@/layout/MainLayout';
import Providers from '@/providers';
import { createInertiaApp } from '@inertiajs/react';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ComponentType, ReactNode } from 'react';
import { createRoot } from 'react-dom/client';

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

type PageComponent = ComponentType & {
    layout?: (page: ReactNode) => ReactNode;
};

createInertiaApp({
    title: (title) => (title ? `${title} - ${appName}` : appName),
    resolve: async (name) => {
        const page = (await resolvePageComponent(`./pages/${name}.tsx`, import.meta.glob('./pages/**/*.tsx'))) as { default: PageComponent };
        // We use a default layout (MainLayout)
        page.default.layout =
            page.default.layout ||
            ((page) => (
                <Providers>
                    <MainLayout children={page} />
                </Providers>
            ));

        return page;
    },
    setup({ el, App, props }) {
        const root = createRoot(el);

        root.render(<App {...props} />);
    },
    progress: {
        color: '#4B5563',
    },
});
