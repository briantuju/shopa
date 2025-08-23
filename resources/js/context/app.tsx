import { InertiaSharedData, User } from '@/types';
import { usePage } from '@inertiajs/react';
import { notifications } from '@mantine/notifications';
import { createContext, ReactNode, useContext, useEffect, useState } from 'react';

interface AppContextValue {
    user: User | null;
}

const AppContext = createContext<AppContextValue>({ user: null });

export const AppProvider = ({ children }: { children: ReactNode }) => {
    const props = usePage<InertiaSharedData>().props;
    const [user, setUser] = useState<User | null>(null);

    useEffect(() => {
        setUser(props.auth.user);

        if (props?.flash.message) {
            notifications.show({
                title: props.flash.title || '',
                message: props.flash.message,
                color: 'blue',
            });
        }

        if (props?.flash.success) {
            notifications.show({
                title: props.flash.title || '',
                message: props.flash.success,
                color: 'green',
            });
        }

        if (props?.flash.error) {
            notifications.show({
                title: props.flash.title || '',
                message: props.flash.error,
                color: 'red',
            });
        }
    }, [props]);

    return <AppContext.Provider value={{ user }}>{children}</AppContext.Provider>;
};

export function useAppContext() {
    return useContext(AppContext);
}
