<script setup lang="ts">

import type { BreadcrumbItem } from '@/types';
import AppLayout from '@/layouts/AppLayout.vue';
import { Head } from '@inertiajs/vue3';
import { computed, ref } from 'vue';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table';
import { Search, Filter, MoreHorizontal, Phone, MapPin, Star, Building2 } from 'lucide-vue-next';
import { Button } from '@/components/ui/button';

interface Dealership {
    id: number;
    name: string;
    address: string;
    city: string;
    state: string;
}

interface Props {
    dealerships: Dealership[];
}

const props = defineProps<Props>();

const currentPage = ref(1);
const itemsPerPage = ref(25);

const paginatedDealerships = computed(() => {
    const start = (currentPage.value - 1) * itemsPerPage.value;
    const end = start + itemsPerPage.value;
    return props.dealerships.slice(start, end);
})

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dealerships',
        href: '/dealerships',
    },
]
</script>

<template>
    <Head title="Dealerships" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <Card class="flex-1 border-none shadow-none">
            <CardHeader>
                <CardTitle>Dealerships</CardTitle>
            </CardHeader>
            <CardContent>
                <div class="overflow-x-auto">
                    <Table>
                        <TableHeader>
                            <TableRow>
                                <TableHead>Name</TableHead>
                                <TableHead>Location</TableHead>
                            </TableRow>
                        </TableHeader>
                        <TableBody>
                            <TableRow v-for="dealership in paginatedDealerships" :key="dealership.id">
                                <TableCell>{{ dealership.name }}</TableCell>
                                <TableCell>
                                    <span class="flex items-center gap-1">
                                        <MapPin class="h3 w-3" />
                                        {{ dealership.city }}, {{ dealership.state }}
                                    </span>
                                </TableCell>
                                <TableCell class="text-right">
                                    <Button>View</Button>
                                </TableCell>
                            </TableRow>
                        </TableBody>
                    </Table>
                </div>
            </CardContent>
        </Card>
    </AppLayout>
</template>
