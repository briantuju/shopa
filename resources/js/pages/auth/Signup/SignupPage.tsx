import { Link, useForm } from '@inertiajs/react';
import { Button, Card, Group, PasswordInput, SimpleGrid, TextInput, Title } from '@mantine/core';
import { ChangeEvent, FormEvent } from 'react';
import { route } from 'ziggy-js';

export default function SignupPage() {
    const { data, setData, post, processing, errors } = useForm({
        name: '',
        email: '',
        password: '',
        password_confirmation: '',
    });

    const submit = (e: FormEvent) => {
        e.preventDefault();

        post(route('auth.signup'));
    };

    const handleChange = (e: ChangeEvent<HTMLInputElement>) => {
        setData((values) => ({
            ...values,
            [e.target.name]: e.target.value,
        }));
    };

    return (
        <form onSubmit={submit} className="mx-auto flex max-w-3xl flex-col gap-4 p-8 lg:gap-6">
            <Title order={1} ta="center" size={24}>
                Get Started
            </Title>

            <Card withBorder radius="md" padding="lg" shadow="md">
                <SimpleGrid spacing="md" cols={{ base: 1, sm: 2 }} mb={30}>
                    <TextInput
                        name="name"
                        label="Full Name"
                        placeholder="John Doe"
                        type="text"
                        withAsterisk
                        required
                        value={data.name}
                        onChange={handleChange}
                        error={errors.name}
                    />

                    <TextInput
                        name="email"
                        label="Email Address"
                        placeholder="john.doe@example.com"
                        type="email"
                        withAsterisk
                        required
                        value={data.email}
                        onChange={handleChange}
                        error={errors.email}
                    />

                    <PasswordInput
                        name="password"
                        label="Password"
                        type="password"
                        withAsterisk
                        required
                        value={data.password}
                        onChange={handleChange}
                        error={errors.password}
                    />

                    <PasswordInput
                        name="password_confirmation"
                        label="Confirm Password"
                        type="password"
                        withAsterisk
                        required
                        value={data.password_confirmation}
                        onChange={handleChange}
                        error={errors.password_confirmation}
                    />
                </SimpleGrid>

                <Group justify="space-between">
                    <Button type="submit" className="max-w-max" loading={processing}>
                        Signup
                    </Button>

                    <Link href={route('auth.login-page')}>Already have an account? Login</Link>
                </Group>
            </Card>
        </form>
    );
}
