import { useZiggyRoute } from '@/hooks/useZiggyRoute';
import { act, fireEvent, render, screen } from '@/test-utils';
import { router } from '@inertiajs/react';
import type { Mock } from 'vitest';
import { vi } from 'vitest';
import VerifyEmailPage from './VerifyEmailPage';

// Mock router.post (we don't need the full useForm here)
vi.mock('@inertiajs/react', async (importOriginal) => {
    const actual: typeof import('@inertiajs/react') = await importOriginal();
    return {
        ...actual,
        router: {
            post: vi.fn(),
        },
    };
});

describe('VerifyEmail', () => {
    const route = useZiggyRoute();
    beforeEach(() => {
        vi.clearAllMocks();
    });

    it('renders heading and description', () => {
        render(<VerifyEmailPage />);
        expect(screen.getByRole('heading', { level: 1 }));
        expect(screen.getByText(/please check your email inbox for a verification link/i)).toBeInTheDocument();
    });

    it('calls router.post when clicking "Resend Verification Email"', () => {
        render(<VerifyEmailPage />);
        const button = screen.getByRole('button', { name: /resend verification email/i });

        fireEvent.click(button);

        expect(router.post).toHaveBeenCalledWith(
            route('verification.send'),
            undefined,
            expect.objectContaining({
                onStart: expect.any(Function),
                onFinish: expect.any(Function),
            }),
        );
    });

    it('sets loading state when request starts and finishes', () => {
        render(<VerifyEmailPage />);
        const button = screen.getByRole('button', { name: /resend verification email/i });

        fireEvent.click(button);

        const options = (router.post as Mock).mock.calls[0][2];

        act(() => {
            options.onStart();
        });
        expect(button).toHaveAttribute('data-loading');

        act(() => {
            options.onFinish();
        });
        expect(button).not.toHaveAttribute('data-loading');
    });
});
