import { mockPost, mockSetData, setUseFormInitialData } from '@/../../vitest.setup.mjs';
import { useZiggyRoute } from '@/hooks/useZiggyRoute';
import { fireEvent, render, screen } from '@/test-utils';
import ForgotPasswordPage from './ForgotPasswordPage';

describe('ForgotPassword page', () => {
    const route = useZiggyRoute();

    beforeEach(() => {
        mockPost.mockClear();
        mockSetData.mockClear();

        setUseFormInitialData({
            email: '',
        });
    });

    it('renders email input and button', () => {
        render(<ForgotPasswordPage />);

        expect(screen.getByLabelText(/email/i)).toBeInTheDocument();
        expect(screen.getByTestId('submit-btn')).toBeInTheDocument();
    });

    it('calls post when form is submitted', () => {
        render(<ForgotPasswordPage />);

        fireEvent.submit(screen.getByRole('form'));

        expect(mockPost).toHaveBeenCalledWith(route('password.email'));
    });
});
