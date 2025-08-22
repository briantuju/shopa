import { render, screen } from '@/test-utils';
import { describe, expect, it } from 'vitest';
import WelcomePage from './WelcomePage';

describe('Welcome component', () => {
    it('has correct heading', () => {
        render(<WelcomePage />);
        expect(screen.getByRole('heading', { level: 1 }));
    });
});
