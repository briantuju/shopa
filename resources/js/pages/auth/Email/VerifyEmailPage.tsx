import { useZiggyRoute } from '@/hooks/useZiggyRoute';
import { router } from '@inertiajs/react';
import { Button, Container, Group, Paper, Text, Title } from '@mantine/core';
import { useState } from 'react';

export default function VerifyEmail() {
    const [loading, setLoading] = useState(false);
    const route = useZiggyRoute();

    const resendEmailVerification = () => {
        router.post(route('verification.send'), undefined, {
            onStart: () => setLoading(true),
            onFinish: () => setLoading(false),
        });
    };

    return (
        <Container size="sm" className="flex min-h-[600px] items-center justify-center">
            <Paper shadow="md" radius="md" p="xl" withBorder className="w-full">
                <Title order={1} mb="sm" ta="center" size={24}>
                    Verify your email
                </Title>

                <Text c="dimmed" ta="center" mb="lg">
                    Before continuing, please check your email inbox for a verification link. If you didn’t receive the email, click below to request
                    another one.
                </Text>

                <Group justify="center">
                    <Button onClick={resendEmailVerification} loading={loading}>
                        Resend Verification Email
                    </Button>
                </Group>
            </Paper>
        </Container>
    );
}
