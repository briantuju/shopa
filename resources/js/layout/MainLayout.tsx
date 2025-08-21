import Header from '@/components/header/Header';
import { ReactNode } from 'react';

interface Props {
    children: ReactNode;
}

export default function MainLayout({ children }: Props) {
    return (
        <>
            <Header />

            {children}
        </>
    );
}
