<script setup lang="ts">

import type { BreadcrumbItem } from '@/types';
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { computed, ref } from 'vue';
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table';
import { Search, MapPin } from 'lucide-vue-next';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';

interface Dealership {
    id: number;
    uuid: string;
    name: string;
    address: string;
    city: string;
    state: string;
    consultants: string[];
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
</script>

<template>
    <Head title="Dealerships" />

    <AppLayout>
        <div class="flex h-full flex-1 flex-col gap-6 rounded-xl p-4">
            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h1 class="text-2xl font-bold tracking-tight">Dealerships</h1>
                </div>
                <div class="flex items-center gap-2">
                    <Button>Create Dealership</Button>
                </div>
            </div>

            <div class="flex flex-col justify-end gap-4 sm:flex-row sm:items-center">
                <Button variant="outline" @click="clearFilters" v-if="searchQuery">
                    Clear Filters
                </Button>
                <div class="relative w-[300px]">
                    <Search class="absolute left-2 top-2.5 h-4 w-4 text-muted-foreground" />
                    <Input
                        placeholder="Search dealerships..."
                        v-model="searchQuery"
                        class="pl-8"
                    />
                </div>
            </div>

            <Table>
                <TableHeader>
                    <TableRow>
                        <TableHead>Name</TableHead>
                        <TableHead>Location</TableHead>
                        <TableHead></TableHead>
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
                            <Link :href="route('dealerships.show', dealership.uuid)" prefetch>
                                View
                            </Link>
                        </TableCell>
                    </TableRow>
                </TableBody>
            </Table>
        </div>
    </AppLayout>
</template>
