import { useZiggyRoute } from '@/hooks/useZiggyRoute';
import { fireEvent, render, screen } from '@/test-utils';
import * as inertia from '@inertiajs/react';
import type { Mock } from 'vitest';
import { vi } from 'vitest';
import ForgotPasswordPage from './ForgotPasswordPage';

// Mock useForm once at the top
vi.mock('@inertiajs/react', async (importOriginal) => {
    const actual = (await importOriginal()) as typeof import('@inertiajs/react');
    return {
        ...actual,
        useForm: vi.fn().mockReturnValue({
            data: { email: '' },
            setData: vi.fn(),
            post: vi.fn(),
            processing: false,
            errors: {},
        }),
    };
});

describe('ForgotPassword page', () => {
    const route = useZiggyRoute();

    it('renders email input and button', () => {
        render(<ForgotPasswordPage />);
        expect(screen.getByLabelText(/email/i)).toBeInTheDocument();
        expect(screen.getByTestId('submit-btn')).toBeInTheDocument();
    });

    it('calls post when form is submitted', () => {
        const mockPost = vi.fn();
        (inertia.useForm as unknown as Mock).mockReturnValue({
            data: { email: 'test@example.com' },
            setData: vi.fn(),
            post: mockPost,
            processing: false,
            errors: {},
        });

        render(<ForgotPasswordPage />);
        fireEvent.submit(screen.getByTestId('forgot-password-form'));

        expect(mockPost).toHaveBeenCalledWith(expect.stringContaining(route('password.email')));
    });
});
