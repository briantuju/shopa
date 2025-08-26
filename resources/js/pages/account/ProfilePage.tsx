import VendorPortalNotice from '@/components/profile/VendorPortalNotice';
import { useAppContext } from '@/context/app';
import { InertiaSharedData } from '@/types';
import { usePage } from '@inertiajs/react';
import { Avatar, Button, Card, Divider, Group, Stack, Text } from '@mantine/core';

export default function ProfilePage() {
    const { user } = useAppContext();
    const { is_vendor } = usePage<InertiaSharedData>().props;

    if (is_vendor) {
        return <VendorPortalNotice />;
    }

    return (
        <div style={{ maxWidth: 500, margin: 'auto', padding: 20 }}>
            <Card shadow="sm" radius="md" withBorder>
                <Group gap="md">
                    <Avatar src="https://i.pravatar.cc/150?img=67" size={80} radius="xl" />
                    <Stack gap={2}>
                        <Text size="lg" fw={600}>
                            {user?.name}
                        </Text>
                        <Text size="sm" c="dimmed">
                            Shopa User
                        </Text>
                        <Button size="xs" disabled variant="light" radius="md" mt="xs">
                            Edit Profile
                        </Button>
                    </Stack>
                </Group>

                <Divider my="md" />

                <Stack gap="xs">
                    <Text size="sm">
                        📧 <strong>Email:</strong> {user?.email}
                    </Text>
                    <Text size="sm">
                        📍 <strong>Location:</strong> <span className="text-gray-700">Somewhere in Kenya</span>
                    </Text>
                    <Text size="sm">
                        📝 <strong>Bio:</strong> <span className="text-gray-700">Something awesome is cooking here</span>
                    </Text>
                </Stack>
            </Card>
        </div>
    );
}
