import { useZiggyRoute } from '@/hooks/useZiggyRoute';
import { useForm } from '@inertiajs/react';
import { Button, Paper, PasswordInput, TextInput, Title } from '@mantine/core';
import { FormEvent } from 'react';

interface ResetPasswordProps {
    token: string;
    email: string;
}

export default function ResetPassword({ token, email }: ResetPasswordProps) {
    const route = useZiggyRoute();

    const { data, setData, post, processing, errors } = useForm({
        token,
        email,
        password: '',
        password_confirmation: '',
    });

    const handleSubmit = (e: FormEvent) => {
        e.preventDefault();
        post(route('password.update'));
    };

    return (
        <Paper withBorder shadow="md" p="xl" radius="md" className="mx-auto mt-20 max-w-md">
            <Title order={1} ta="center" mb={10} size={24}>
                Reset password
            </Title>

            <form onSubmit={handleSubmit} role="form" data-testid="reset-password-form">
                <TextInput
                    label="Email"
                    defaultValue={data.email}
                    onChange={(e) => setData('email', e.currentTarget.value)}
                    error={errors.email}
                    required
                    type="email"
                    mb="sm"
                />

                <PasswordInput
                    label="New Password"
                    onChange={(e) => setData('password', e.currentTarget.value)}
                    error={errors.password}
                    required
                    mb="sm"
                />

                <PasswordInput
                    label="Confirm Password"
                    onChange={(e) => setData('password_confirmation', e.currentTarget.value)}
                    error={errors.password_confirmation}
                    required
                />

                <Button fullWidth mt="lg" type="submit" loading={processing} data-testid="submit-btn">
                    Reset Password
                </Button>
            </form>
        </Paper>
    );
}
