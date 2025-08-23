import { vi } from 'vitest';

export const mockPost = vi.fn();
export const mockSetData = vi.fn();

// A reusable typed mock of useForm
export function createUseFormMock<T extends Record<string, never>>(initialData: T) {
    return {
        data: initialData,
        setData: mockSetData,
        post: mockPost,
        processing: false,
        errors: {} as Partial<Record<keyof T, string>>,
    };
}
