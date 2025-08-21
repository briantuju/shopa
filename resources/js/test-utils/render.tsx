import { MantineProvider } from '@mantine/core';
import { render as testingLibraryRender } from '@testing-library/react';
import { ReactNode } from 'react';
import { theme } from '../theme';

export function render(ui: ReactNode) {
    return testingLibraryRender(<>{ui}</>, {
        wrapper: ({ children }: { children: ReactNode }) => (
            <MantineProvider theme={theme} env="test">
                {children}
            </MantineProvider>
        ),
    });
}
