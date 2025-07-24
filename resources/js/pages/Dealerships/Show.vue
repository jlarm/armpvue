<script setup lang="ts">

import type { BreadcrumbItem } from '@/types';
import AppLayout from '@/layouts/AppLayout.vue';

interface Dealership {
    uuid: string;
    id: number;
    name: string;
    address: string;
    city: string;
    state: string;
}

interface Props {
    dealership: Dealership[];
}

const props = defineProps<Props>();

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dealerships',
        href: '/dealerships',
    },
    {
        title: props.dealership?.data?.name || 'Loading...',
        href: '#',
    }
]
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="p-4">
            <h2 class="text-2xl font-bold tracking-tight">
                {{ dealership.data.name }}
            </h2>
        </div>
    </AppLayout>
</template>
