import { Link, useForm } from '@inertiajs/react';
import { Button, Card, PasswordInput, SimpleGrid, TextInput, Title } from '@mantine/core';
import { ChangeEvent, FormEvent } from 'react';
import { route } from 'ziggy-js';

export default function LoginPage() {
    const { data, setData, post, processing, errors } = useForm({
        email: '',
        password: '',
    });

    const submit = (e: FormEvent) => {
        e.preventDefault();

        post(route('auth.login'));
    };

    const handleChange = (e: ChangeEvent<HTMLInputElement>) => {
        setData((values) => ({
            ...values,
            [e.target.name]: e.target.value,
        }));
    };

    return (
        <form onSubmit={submit} className="mx-auto flex max-w-lg flex-col gap-4 p-8 lg:gap-6">
            <Title order={1} ta="center" size={24}>
                Welcome back
            </Title>

            <Card withBorder radius="md" padding="lg" shadow="md">
                <SimpleGrid spacing="md" cols={1} mb={30}>
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
                </SimpleGrid>

                <Button type="submit" className="mb-4 max-w-max" loading={processing}>
                    Login
                </Button>

                <Link href={route('auth.signup-page')}>Create an account</Link>
            </Card>
        </form>
    );
}
