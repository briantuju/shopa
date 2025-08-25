import { useZiggyRoute } from '@/hooks/useZiggyRoute';
import { InertiaSharedData } from '@/types';
import { useForm, usePage } from '@inertiajs/react';
import { Button, Card, Flex, Group, PasswordInput, Select, SimpleGrid, Stepper, TextInput, Title } from '@mantine/core';
import { notifications } from '@mantine/notifications';
import { ChangeEvent, FormEvent, useState } from 'react';
import { BiStore } from 'react-icons/bi';
import { HiOutlineUser } from 'react-icons/hi2';
import { IoLocationOutline, IoLockClosedOutline, IoMailOutline } from 'react-icons/io5';

export default function VendorSignupPage() {
    const [active, setActive] = useState(0);
    const route = useZiggyRoute();
    const props = usePage<
        InertiaSharedData & {
            business_types: string[];
        }
    >().props;

    const { data, errors, post, processing, setData, setError, clearErrors } = useForm({
        name: '', // contact person
        email: '',
        password: '',
        password_confirmation: '',

        business_name: '',
        business_type: '',

        store_name: '',
        address_line: '',

        // categories: [] as string[], // we can populate a select dropdown with top categories
    });

    const handleChange = (e: ChangeEvent<HTMLInputElement>) => {
        setData((values) => ({
            ...values,
            [e.target.name]: e.target.value,
        }));
    };

    const validateStep = () => {
        let valid = true;

        if (active === 0) {
            if (!data.name) {
                setError('name', 'Full name is required');
                valid = false;
            } else {
                clearErrors('name');
            }

            if (!data.email) {
                setError('email', 'Email is required');
                valid = false;
            } else {
                clearErrors('email');
            }

            if (!data.password) {
                setError('password', 'Password is required');
                valid = false;
            } else {
                clearErrors('password');
            }

            if (data.password !== data.password_confirmation) {
                setError('password_confirmation', 'Passwords do not match');
                valid = false;
            } else {
                clearErrors('password_confirmation');
            }
        }

        if (active === 1) {
            if (!data.business_name) {
                setError('business_name', 'Business name is required');
                valid = false;
            } else {
                clearErrors('business_name');
            }

            if (!data.store_name) {
                setError('store_name', 'Store name is required');
                valid = false;
            } else {
                clearErrors('store_name');
            }

            if (!data.address_line) {
                setError('address_line', 'Business location is required');
                valid = false;
            } else {
                clearErrors('address_line');
            }
        }

        return valid;
    };

    const nextStep = () =>
        setActive((current) => {
            if (!validateStep()) {
                return current; // stay on same step
            }
            return current < 2 ? current + 1 : current;
        });

    const prevStep = () => setActive((current) => (current > 0 ? current - 1 : current));

    const handleSubmit = (e: FormEvent) => {
        e.preventDefault();

        post(route('auth.vendor-signup'), {
            onError: (errors) => {
                console.log(errors);
                if (errors.name || errors.email || errors.password || errors.password_confirmation) {
                    setActive(0);
                } else if (errors.business_name || errors.business_type || errors.store_name || errors.address_line) {
                    setActive(1);
                }
            },

            onSuccess: () => {
                notifications.show({
                    title: 'Account Created Successfully',
                    message: 'Thank you for signing up to Shopa. Verify your email to get started.',
                    color: 'green',
                });
            },
        });
    };

    return (
        <div>
            <Title order={1} ta="center" my="xl" size={24}>
                Start selling on Shopa
            </Title>

            <form onSubmit={handleSubmit} role="form" className="mx-auto flex max-w-4xl flex-col gap-4 p-8 lg:gap-6">
                <Stepper active={active}>
                    <Stepper.Step label="Personal Information" description="Enter your personal information here">
                        <Card shadow="sm" padding="lg" radius="md" withBorder>
                            <SimpleGrid spacing="lg" cols={{ base: 1, sm: 2 }} mb={{ sm: 'lg' }}>
                                <TextInput
                                    name="name"
                                    label="Full Name"
                                    placeholder="John Doe"
                                    type="text"
                                    withAsterisk
                                    required
                                    leftSection={<HiOutlineUser />}
                                    defaultValue={data.name}
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
                                    leftSection={<IoMailOutline />}
                                    defaultValue={data.email}
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
                                    onChange={handleChange}
                                    error={errors.password}
                                />

                                <PasswordInput
                                    name="password_confirmation"
                                    label="Confirm Password"
                                    type="password"
                                    withAsterisk
                                    required
                                    leftSection={<IoLockClosedOutline />}
                                    onChange={handleChange}
                                    error={errors.password_confirmation}
                                />
                            </SimpleGrid>
                        </Card>
                    </Stepper.Step>

                    <Stepper.Step label="Business Information" description="Enter basic business information here">
                        <Card shadow="sm" padding="lg" radius="md" withBorder>
                            <SimpleGrid cols={{ base: 1, sm: 2 }} spacing="lg" mb={{ sm: 'lg' }}>
                                <TextInput
                                    name="business_name"
                                    label="My Business Name"
                                    placeholder="John's Business"
                                    type="text"
                                    withAsterisk
                                    required
                                    leftSection={<BiStore />}
                                    defaultValue={data.business_name}
                                    onChange={handleChange}
                                    error={errors.business_name}
                                />

                                <Select
                                    name="business_type"
                                    label="Business Type"
                                    placeholder="Business Type"
                                    data={props.business_types}
                                    withAsterisk
                                    required
                                    leftSection={<BiStore />}
                                    defaultValue={data.business_type}
                                    onChange={(value) => setData({ ...data, business_type: value! })}
                                    error={errors.business_type}
                                />

                                <TextInput
                                    name="store_name"
                                    label="My Store Name"
                                    placeholder="John's Store"
                                    type="text"
                                    withAsterisk
                                    required
                                    leftSection={<BiStore />}
                                    defaultValue={data.store_name}
                                    onChange={handleChange}
                                    error={errors.store_name}
                                />

                                <TextInput
                                    name="address_line"
                                    label="Business/Store location"
                                    placeholder="Moi Avenue, Nairobi"
                                    type="text"
                                    withAsterisk
                                    required
                                    leftSection={<IoLocationOutline />}
                                    defaultValue={data.address_line}
                                    onChange={handleChange}
                                    error={errors.address_line}
                                />
                            </SimpleGrid>
                        </Card>
                    </Stepper.Step>

                    <Stepper.Completed>
                        {/* Show a preview of the completed form */}
                        <Flex direction="column" gap={10} p={16} bg="gray.1" className="rounded-lg">
                            <Title order={4} size={20} mb={10}>
                                Confirm Details
                            </Title>

                            <Flex>
                                <span className="min-w-[140px] text-gray-600 lg:min-w-[200px]">Full Name: </span>
                                <span>{data.name}</span>
                            </Flex>
                            <Flex>
                                <span className="min-w-[140px] text-gray-600 lg:min-w-[200px]">Email: </span>
                                <span>{data.email}</span>
                            </Flex>
                            <Flex>
                                <span className="min-w-[140px] text-gray-600 lg:min-w-[200px]">Business Name: </span>
                                <span>{data.business_name}</span>
                            </Flex>
                            <Flex>
                                <span className="min-w-[140px] text-gray-600 lg:min-w-[200px]">Business Type: </span>
                                <span>{data.business_type}</span>
                            </Flex>
                            <Flex>
                                <span className="min-w-[140px] text-gray-600 lg:min-w-[200px]">Store Name: </span>
                                <span>{data.store_name}</span>
                            </Flex>
                            <Flex>
                                <span className="min-w-[140px] text-gray-600 lg:min-w-[200px]">Address Line: </span>
                                <span>{data.address_line}</span>
                            </Flex>
                        </Flex>

                        <Button type="submit" mt={30} loading={processing} data-testid="submit-btn">
                            Create Account
                        </Button>
                    </Stepper.Completed>
                </Stepper>

                <Group justify="flex-end" mt="xl">
                    {active !== 0 && (
                        <Button variant="default" type="button" onClick={prevStep}>
                            Back
                        </Button>
                    )}
                    {active !== 2 && (
                        <Button type="button" onClick={nextStep}>
                            Next step
                        </Button>
                    )}
                </Group>
            </form>
        </div>
    );
}
