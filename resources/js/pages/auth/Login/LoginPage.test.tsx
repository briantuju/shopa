import { render, screen } from '@/test-utils';
import { describe, expect, it } from 'vitest';
import LoginPage from './LoginPage';

describe('Login component', () => {
    it('has correct heading', () => {
        render(<LoginPage />);
        expect(screen.getByRole('heading', { level: 1 }));
    });
});
