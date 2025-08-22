import { AppProvider } from '@/context/app';
import { theme } from '@/theme';
import { MantineProvider } from '@mantine/core';
import { Notifications } from '@mantine/notifications';
import { ReactNode } from 'react';

// Import styles of packages that you've installed.
// All packages except `@mantine/hooks` require styles imports
import '@mantine/core/styles.css';
import '@mantine/notifications/styles.css';

const Providers = ({ children }: { children: ReactNode }) => {
    return (
        <>
            <MantineProvider theme={theme}>
                <Notifications position="top-right" limit={3} autoClose={4000} />

                <AppProvider>{children}</AppProvider>
            </MantineProvider>
        </>
    );
};

export default Providers;
