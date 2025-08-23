import { useZiggyRoute } from '@/hooks/useZiggyRoute';
import { Link, useForm } from '@inertiajs/react';
import { Button, Card, Group, PasswordInput, SimpleGrid, TextInput, Title } from '@mantine/core';
import { ChangeEvent, FormEvent } from 'react';
import { IoArrowForwardOutline, IoLockClosedOutline, IoMailOutline } from 'react-icons/io5';

export default function LoginPage() {
    const route = useZiggyRoute();
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
                        leftSection={<IoMailOutline />}
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
                        leftSection={<IoLockClosedOutline />}
                        value={data.password}
                        onChange={handleChange}
                        error={errors.password}
                    />

                    <Link href={route('home')} className="text-sm text-blue-500">
                        I have forgot my password
                    </Link>
                </SimpleGrid>

                <Group justify="space-between" align="center">
                    <Button type="submit" className="max-w-max" loading={processing} rightSection={<IoArrowForwardOutline />}>
                        Login
                    </Button>

                    <Link href={route('auth.signup-page')} className="text-blue-500">
                        Create an account
                    </Link>
                </Group>
            </Card>
        </form>
    );
}
