import { useZiggyRoute } from '@/hooks/useZiggyRoute';
import { Button, Card, Stack, Text } from '@mantine/core';
import { HiOfficeBuilding } from 'react-icons/hi';

export default function VendorPortalNotice() {
    const route = useZiggyRoute();

    return (
        <div style={{ maxWidth: 500, margin: 'auto', padding: 20 }}>
            <Card shadow="sm" radius="md" withBorder>
                <Stack gap="md" align="center" ta="center">
                    <HiOfficeBuilding size={48} className="text-blue-600" />

                    <Text size="lg" fw={600}>
                        You have a Vendor Account
                    </Text>

                    <Text size="sm" c="dimmed">
                        Your profile is managed separately in the Vendor Portal. Click below to go to your vendor dashboard.
                    </Text>

                    <Button component="a" href={route('filament.vendor.pages.dashboard')}>
                        Go to Vendor Dashboard
                    </Button>
                </Stack>
            </Card>
        </div>
    );
}
