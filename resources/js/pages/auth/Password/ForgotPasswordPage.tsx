import { useZiggyRoute } from '@/hooks/useZiggyRoute';
import { useForm } from '@inertiajs/react';
import { Button, Flex, Paper, Text, TextInput, Title } from '@mantine/core';
import { FormEvent } from 'react';

export default function ForgotPasswordPage() {
    const route = useZiggyRoute();
    const { data, setData, post, processing, errors } = useForm({
        email: '',
    });

    const handleSubmit = (e: FormEvent) => {
        e.preventDefault();
        post(route('password.email'));
    };

    return (
        <Paper withBorder shadow="md" p="xl" radius="md" className="mx-auto mt-20 max-w-md">
            <Flex direction="column" gap="md" align="center">
                <Title order={1} ta="center" mb={10} size={24}>
                    Forgot your password?
                </Title>

                <Text c="gray.8" size="sm" ta="center">
                    No problem at all, just let us know your email and we will send you a password reset link.
                </Text>

                <form onSubmit={handleSubmit} data-testid="forgot-password-form" className="grid place-items-center">
                    <TextInput
                        aria-label="Email"
                        type="email"
                        placeholder="you@example.com"
                        required
                        value={data.email}
                        onChange={(e) => setData('email', e.currentTarget.value)}
                        error={errors.email}
                    />

                    <Button mt="lg" type="submit" loading={processing} data-testid="submit-btn">
                        Send Reset Link
                    </Button>
                </form>
            </Flex>
        </Paper>
    );
}
