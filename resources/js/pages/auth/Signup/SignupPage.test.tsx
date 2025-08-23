import { mockPost, mockSetData, setUseFormInitialData } from '@/../../vitest.setup.mjs';
import { useZiggyRoute } from '@/hooks/useZiggyRoute';
import { fireEvent, render, screen } from '@/test-utils';
import SignupPage from './SignupPage';

describe('SignupPage', () => {
    const route = useZiggyRoute();

    beforeEach(() => {
        mockPost.mockClear();
        mockSetData.mockClear();

        // Strong typing comes from here
        setUseFormInitialData({
            name: '',
            email: '',
            password: '',
            password_confirmation: '',
        });
    });

    it('renders the form correctly', () => {
        render(<SignupPage />);

        expect(screen.getByRole('heading', { level: 1 })).toHaveTextContent('Get Started');
        expect(screen.getByLabelText(/Full Name/i)).toBeInTheDocument();
        expect(screen.getByLabelText(/Email Address/i)).toBeInTheDocument();
        expect(screen.getByLabelText(/^Password/i)).toBeInTheDocument();
        expect(screen.getByLabelText(/Confirm Password/i)).toBeInTheDocument();
    });

    it('updates form data when input changes', () => {
        render(<SignupPage />);

        const nameInput = screen.getByLabelText(/Full Name/i);
        fireEvent.change(nameInput, { target: { value: 'John Doe', name: 'name' } });

        expect(mockSetData).toHaveBeenCalledWith(expect.any(Function));

        // run the function passed to setData to assert transformation
        const updaterFn = mockSetData.mock.calls[0][0];
        const newState = updaterFn({ name: '', email: '', password: '', password_confirmation: '' });

        expect(newState.name).toBe('John Doe');
    });

    it('submits form and calls post with signup route', () => {
        render(<SignupPage />);

        const form = screen.getByRole('form');
        fireEvent.submit(form);

        expect(mockPost).toHaveBeenCalledWith(route('auth.signup'));
    });
});
