import { render, screen } from '@/test-utils';
import { describe, expect, it } from 'vitest';
import SignupPage from './SignupPage';

describe('Signup component', () => {
    it('has correct heading', () => {
        render(<SignupPage />);
        expect(screen.getByRole('heading', { level: 1 }));
    });
});
