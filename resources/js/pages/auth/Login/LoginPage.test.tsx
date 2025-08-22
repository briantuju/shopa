import { describe, expect, it } from 'vitest';
import { render, screen } from '../../../test-utils/index';
import LoginPage from './LoginPage';

describe('Signup component', () => {
    it('has correct heading', () => {
        render(<LoginPage />);
        expect(screen.getByRole('heading', { level: 1 }));
    });
});
