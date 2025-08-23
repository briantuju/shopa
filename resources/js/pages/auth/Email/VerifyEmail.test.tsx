import { render, screen } from '@/test-utils';
import { describe, expect, it } from 'vitest';
import VerifyEmailPage from './VerifyEmailPage';

describe('VerifyEmail component', () => {
    it('renders the heading and text', () => {
        render(<VerifyEmailPage />);
        expect(screen.getByRole('heading', { name: /verify your email/i, level: 1 }));
        expect(screen.getByText(/please check your email inbox/i));
    });

    it('renders resend verification email button', () => {
        render(<VerifyEmailPage />);
        const button = screen.getByRole('button');
        expect(button).toBeInTheDocument();
        expect(button).toHaveTextContent('Resend Verification Email');
    });
});
