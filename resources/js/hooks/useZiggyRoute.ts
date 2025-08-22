import { useRoute } from 'ziggy-js';
import { Ziggy } from '../ziggy';

export function useZiggyRoute() {
    // @ts-expect-error Types of property routes are incompatible
    return useRoute(Ziggy);
}
