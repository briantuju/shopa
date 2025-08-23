import '@testing-library/jest-dom/vitest';

import { createElement } from 'react';
import { vi } from 'vitest';

/**
 * Mock implementation of Inertia's `post` method.
 *
 * Use this spy in tests to assert that form submissions
 * are triggered with the expected route and payload.
 *
 * Example:
 * ```ts
 * expect(mockPost).toHaveBeenCalledWith('http://localhost:8000/auth/signup')
 * ```
 */
export const mockPost = vi.fn();

/**
 * Mock implementation of Inertia's `setData` method.
 *
 * Use this spy in tests to assert that form data updates
 * happen correctly when user inputs change.
 *
 * Example:
 * ```ts
 * fireEvent.change(screen.getByLabelText(/Email/), { target: { value: 'john@example.com', name: 'email' } })
 * expect(mockSetData).toHaveBeenCalled()
 * ```
 */
export const mockSetData = vi.fn();

// Store for initial data
let initialData = {};
let initialErrors = {};

/**
 * Sets up the initial state returned by the mocked `useForm` hook.
 *
 * Call this inside your tests' `beforeEach` (or inline in a test)
 * to control the `data` and `errors` that the component under test receives.
 *
 * @template T - Shape of the form data
 * @param {T} data - Initial form data (e.g., `{ email: '', password: '' }`)
 * @param {Partial<Record<keyof T, string>>} [errors={}] - Validation errors keyed by field name
 *
 * Example:
 * ```ts
 * setUseFormInitialData(
 *   { email: '', password: '' },
 *   { email: 'Email has already been taken.' }
 * )
 * ```
 */
export function setUseFormInitialData(data, errors = {}) {
    initialData = data;
    initialErrors = errors;
}

// ---- Mock Inertia useForm ----
vi.mock('@inertiajs/react', async (importOriginal) => {
    const actual = await importOriginal();
    return {
        ...actual,
        useForm: () => ({
            data: initialData,
            setData: mockSetData,
            post: mockPost,
            processing: false,
            errors: initialErrors,
        }),
        Link: ({ children, ...props }) => createElement('a', props, children),
    };
});

const { getComputedStyle } = window;
window.getComputedStyle = (elt) => getComputedStyle(elt);
window.HTMLElement.prototype.scrollIntoView = () => {};

Object.defineProperty(window, 'matchMedia', {
    writable: true,
    value: vi.fn().mockImplementation((query) => ({
        matches: false,
        media: query,
        onchange: null,
        addListener: vi.fn(),
        removeListener: vi.fn(),
        addEventListener: vi.fn(),
        removeEventListener: vi.fn(),
        dispatchEvent: vi.fn(),
    })),
});

class ResizeObserver {
    observe() {}
    unobserve() {}
    disconnect() {}
}

window.ResizeObserver = ResizeObserver;
