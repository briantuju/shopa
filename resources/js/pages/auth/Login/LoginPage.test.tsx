import { mockPost, mockSetData, setUseFormInitialData } from '@/../../vitest.setup.mjs';
import { useZiggyRoute } from '@/hooks/useZiggyRoute';
import { fireEvent, render, screen } from '@/test-utils';
import LoginPage from './LoginPage';

describe('LoginPage', () => {
    const route = useZiggyRoute();

    beforeEach(() => {
        mockPost.mockClear();
        mockSetData.mockClear();

        setUseFormInitialData({
            email: '',
            password: '',
        });
    });

    it('renders heading and inputs', () => {
        render(<LoginPage />);

        expect(screen.getByRole('heading', { level: 1 }));
        expect(screen.getByLabelText(/Email Address/i)).toBeInTheDocument();
        expect(screen.getByLabelText(/Password/i)).toBeInTheDocument();
    });

    it('updates form data when typing', () => {
        render(<LoginPage />);

        const emailInput = screen.getByLabelText(/Email Address/i);

        fireEvent.change(emailInput, { target: { value: 'john@example.com', name: 'email' } });

        expect(mockSetData).toHaveBeenCalledWith(expect.any(Function));
    });

    it('submits form and calls post with login route', () => {
        render(<LoginPage />);

        fireEvent.submit(screen.getByRole('form'));

        expect(mockPost).toHaveBeenCalledWith(route('auth.login-page'));
    });
});
