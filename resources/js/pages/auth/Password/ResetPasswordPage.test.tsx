import { mockPost, mockSetData, setUseFormInitialData } from '@/../../vitest.setup.mjs';
import { useZiggyRoute } from '@/hooks/useZiggyRoute';
import { fireEvent, render, screen } from '@/test-utils';
import ResetPasswordPage from './ResetPasswordPage';

describe('ResetPassword page', () => {
    const route = useZiggyRoute();

    beforeEach(() => {
        mockPost.mockClear();
        mockSetData.mockClear();

        setUseFormInitialData({
            token: 'abc123',
            email: 'test@example.com',
            password: '',
            password_confirmation: '',
        });
    });

    it('renders heading, inputs and button', () => {
        render(<ResetPasswordPage token="abc123" email="test@example.com" />);

        expect(screen.getByRole('heading', { level: 1 })).toBeInTheDocument();
        expect(screen.getByLabelText(/email/i)).toBeInTheDocument();
        expect(screen.getByLabelText(/new password/i)).toBeInTheDocument();
        expect(screen.getByLabelText(/confirm password/i)).toBeInTheDocument();
        expect(screen.getByTestId('submit-btn')).toBeInTheDocument();
    });

    it('calls post on form submit', () => {
        render(<ResetPasswordPage token="abc123" email="test@example.com" />);
        fireEvent.submit(screen.getByTestId('reset-password-form'));

        expect(mockPost).toHaveBeenCalledWith(route('password.update'));
    });
});
