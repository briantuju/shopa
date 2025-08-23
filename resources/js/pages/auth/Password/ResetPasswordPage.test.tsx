import { useZiggyRoute } from '@/hooks/useZiggyRoute';
import { fireEvent, render, screen } from '@/test-utils';
import * as inertia from '@inertiajs/react';
import type { Mock } from 'vitest';
import { vi } from 'vitest';

import ResetPasswordPage from './ResetPasswordPage';

// Mock Inertia useForm
vi.mock('@inertiajs/react', async (importOriginal) => {
    const actual = (await importOriginal()) as typeof import('@inertiajs/react');
    return {
        ...actual,
        useForm: vi.fn().mockReturnValue({
            data: { token: 'abc123', email: 'test@example.com', password: '', password_confirmation: '' },
            setData: vi.fn(),
            post: vi.fn(),
            processing: false,
            errors: {},
        }),
    };
});

describe('ResetPassword page', () => {
    const route = useZiggyRoute();

    it('renders heading, inputs and button', () => {
        render(<ResetPasswordPage token="abc123" email="test@example.com" />);
        expect(screen.getByRole('heading', { level: 1 })).toBeInTheDocument();
        expect(screen.getByLabelText(/email/i)).toBeInTheDocument();
        expect(screen.getByLabelText(/new password/i)).toBeInTheDocument();
        expect(screen.getByLabelText(/confirm password/i)).toBeInTheDocument();
        expect(screen.getByTestId('submit-btn')).toBeInTheDocument();
    });

    it('calls post on form submit', () => {
        const mockPost = vi.fn();
        (inertia.useForm as unknown as Mock).mockReturnValue({
            data: { token: 'abc123', email: 'test@example.com', password: 'secret123', password_confirmation: 'secret123' },
            setData: vi.fn(),
            post: mockPost,
            processing: false,
            errors: {},
        });

        render(<ResetPasswordPage token="abc123" email="test@example.com" />);
        fireEvent.submit(screen.getByTestId('reset-password-form'));

        expect(mockPost).toHaveBeenCalledWith(expect.stringContaining(route('password.update')));
    });
});
