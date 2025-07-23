<script setup lang="ts">

import type { BreadcrumbItem } from '@/types';
import AppLayout from '@/layouts/AppLayout.vue';
import { Head } from '@inertiajs/vue3';

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

    </AppLayout>
</template>
