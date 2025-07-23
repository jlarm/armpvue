<script setup lang="ts">

import type { BreadcrumbItem } from '@/types';
import AppLayout from '@/layouts/AppLayout.vue';
import { Head } from '@inertiajs/vue3';
import { computed, ref } from 'vue';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table';
import { Search, Filter, MoreHorizontal, Phone, MapPin, Star, Building2 } from 'lucide-vue-next';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';

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

const searchQuery = ref('');
const currentPage = ref(1);
const itemsPerPage = ref(25);

const filteredDealerships = computed(() => {
    let filtered = props.dealerships;

    if (searchQuery.value) {
        const query = searchQuery.value.toLowerCase();
        filtered = filtered.filter(dealership =>
            dealership.name?.toLowerCase().includes(query.toLowerCase()) ||
            dealership.city?.toLowerCase().includes(query.toLowerCase()) ||
            dealership.state?.toLowerCase().includes(query.toLowerCase())
        );
    }

    return filtered;
})

const paginatedDealerships = computed(() => {
    const start = (currentPage.value - 1) * itemsPerPage.value;
    const end = start + itemsPerPage.value;
    return filteredDealerships.value.slice(start, end);
})

const clearFilters = () => {
    searchQuery.value = '';
    currentPage.value = 1;
}

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
        <div class="flex h-full flex-1 flex-col gap-6 rounded-xl p-4">
            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h1 class="text-2xl font-bold tracking-tight">Dealerships</h1>
                    <p class="text-muted-foreground">
                        Manage and track your dealership relationships
                    </p>
                </div>
                <div class="flex items-center gap-2">
                    <Button variant="outline" @click="clearFilters" v-if="searchQuery">
                        Clear Filters
                    </Button>
                </div>
            </div>

            <div class="flex flex-col gap-4 sm:flex-row sm:items-center">
                <div class="relative flex-1">
                    <Search class="absolute left-2 top-2.5 h-4 w-4 text-muted-foreground" />
                    <Input
                        placeholder="Search dealerships..."
                        v-model="searchQuery"
                        class="pl-8"
                    />
                </div>
            </div>

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
        </div>
    </AppLayout>
</template>
