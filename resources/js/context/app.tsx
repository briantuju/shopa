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

        if (props?.flash_message) {
            notifications.show({
                title: props.flash_title || 'Info',
                message: props.flash_message,
                color: 'blue',
            });
        }

        if (props?.flash_success) {
            notifications.show({
                title: props.flash_title || 'Success',
                message: props.flash_success,
                color: 'green',
            });
        }

        if (props?.flash_error) {
            notifications.show({
                title: props.flash_title || 'Error',
                message: props.flash_error,
                color: 'red',
            });
        }
    }, [props]);

    return <AppContext.Provider value={{ user }}>{children}</AppContext.Provider>;
};

export function useAppContext() {
    return useContext(AppContext);
}
