<script setup lang="ts">
import type { BreadcrumbItem } from '@/types';
import AppLayout from '@/layouts/AppLayout.vue';
import { DropdownMenu, DropdownMenuContent, DropdownMenuItem, DropdownMenuTrigger } from '@/components/ui/dropdown-menu';
import { Button } from '@/components/ui/button';
import { ChevronDown } from 'lucide-vue-next';
import {
    NavigationMenu,
    NavigationMenuContent,
    NavigationMenuIndicator,
    NavigationMenuItem,
    NavigationMenuLink,
    NavigationMenuList,
    NavigationMenuTrigger, navigationMenuTriggerStyle,
    NavigationMenuViewport
} from '@/components/ui/navigation-menu';
import { ref } from 'vue';

interface Store {
    id: number;
    name: string;
    is_main_store: boolean;
    is_active: boolean;
}

interface Dealership {
    uuid: string;
    id: number;
    name: string;
    address: string;
    city: string;
    state: string;
    stores: Store[];
}

interface Props {
    dealership: {
        data: Dealership;
    };
}

const props = defineProps<Props>();

const selectedStore = ref<Store | null>(
    props.dealership.data.stores?.find(store => store.is_main_store) ||
    props.dealership.data.stores?.[0] ||
    null
);

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dealerships',
        href: '/dealerships',
    },
    {
        title: props.dealership?.data?.name || 'Loading...',
        href: '#',
    }
];

const selectStore = (store: Store) => {
    selectedStore.value = store;
};
</script>

<template>
    <AppLayout>
        <div class="p-4">
            <div class="h-full min-h-svh">
                <!-- Header Section -->
                <div class="bg-white mb-4">
                    <div>
                        <!-- Top row with dealership name and store selector -->
                        <div class="flex items-center gap-3 mb-4">
                            <h1 class="text-2xl font-semibold text-gray-900">
                                {{ dealership.data.name }}
                            </h1>

                            <!-- Store Dropdown -->
                            <DropdownMenu v-if="dealership.data.stores && dealership.data.stores.length > 0">
                                <DropdownMenuTrigger as-child>
                                    <Button variant="outline" size="sm" class="h-8">
                                        {{ selectedStore?.name || 'Select Store' }}
                                        <ChevronDown class="ml-1 h-3 w-3" />
                                    </Button>
                                </DropdownMenuTrigger>
                                <DropdownMenuContent align="start" class="w-48">
                                    <DropdownMenuItem
                                        v-for="store in dealership.data.stores"
                                        :key="store.id"
                                        @click="selectStore(store)"
                                        class="cursor-pointer"
                                    >
                                        {{ store.name }}
                                        <span v-if="store.is_main_store" class="ml-auto text-xs text-gray-500">
                                        (Main)
                                    </span>
                                    </DropdownMenuItem>
                                </DropdownMenuContent>
                            </DropdownMenu>
                        </div>

                        <NavigationMenu>
                            <NavigationMenuList>
                                <NavigationMenuItem>
                                    <NavigationMenuTrigger>Employees</NavigationMenuTrigger>
                                    <NavigationMenuContent>
                                        <NavigationMenuLink>View</NavigationMenuLink>
                                        <NavigationMenuLink>Invited</NavigationMenuLink>
                                        <NavigationMenuLink>Deleted</NavigationMenuLink>
                                    </NavigationMenuContent>
                                </NavigationMenuItem>
                                <NavigationMenuItem>
                                    <NavigationMenuLink href="/docs/introduction" :class="navigationMenuTriggerStyle()">
                                        IT Scans
                                    </NavigationMenuLink>
                                </NavigationMenuItem>
                                <NavigationMenuItem>
                                    <NavigationMenuTrigger>Manuals</NavigationMenuTrigger>
                                    <NavigationMenuContent>
                                        <NavigationMenuLink>ISP</NavigationMenuLink>
                                        <NavigationMenuLink>OSHA</NavigationMenuLink>
                                        <NavigationMenuLink>Red Flag</NavigationMenuLink>
                                        <NavigationMenuLink>CMS</NavigationMenuLink>
                                    </NavigationMenuContent>
                                </NavigationMenuItem>
                                <NavigationMenuItem>
                                    <NavigationMenuTrigger>Audits</NavigationMenuTrigger>
                                    <NavigationMenuContent>
                                        <NavigationMenuLink>OSHA</NavigationMenuLink>
                                        <NavigationMenuLink>Body Shop</NavigationMenuLink>
                                        <NavigationMenuLink>GLBA Walkthrough</NavigationMenuLink>
                                        <NavigationMenuLink>Deal Jackets</NavigationMenuLink>
                                        <NavigationMenuLink>Fit Tests</NavigationMenuLink>
                                    </NavigationMenuContent>
                                </NavigationMenuItem>
                                <NavigationMenuItem>
                                    <NavigationMenuLink href="/docs/introduction" :class="navigationMenuTriggerStyle()">
                                        Vendors
                                    </NavigationMenuLink>
                                </NavigationMenuItem>
                                <NavigationMenuItem>
                                    <NavigationMenuLink href="/docs/introduction" :class="navigationMenuTriggerStyle()">
                                        Ridgeback
                                    </NavigationMenuLink>
                                </NavigationMenuItem>
                                <NavigationMenuItem>
                                    <NavigationMenuLink href="/docs/introduction" :class="navigationMenuTriggerStyle()">
                                        Phishing
                                    </NavigationMenuLink>
                                </NavigationMenuItem>
                                <NavigationMenuItem>
                                    <NavigationMenuLink href="/docs/introduction" :class="navigationMenuTriggerStyle()">
                                        Documents
                                    </NavigationMenuLink>
                                </NavigationMenuItem>
                                <NavigationMenuItem>
                                    <NavigationMenuLink href="/docs/introduction" :class="navigationMenuTriggerStyle()">
                                        OSHA 300 Form
                                    </NavigationMenuLink>
                                </NavigationMenuItem>
                                <NavigationMenuItem>
                                    <NavigationMenuLink href="/docs/introduction" :class="navigationMenuTriggerStyle()">
                                        Settings
                                    </NavigationMenuLink>
                                </NavigationMenuItem>
                                <NavigationMenuItem>
                                    <NavigationMenuLink href="/docs/introduction" :class="navigationMenuTriggerStyle()">
                                        Logs
                                    </NavigationMenuLink>
                                </NavigationMenuItem>
                            </NavigationMenuList>
                        </NavigationMenu>
                    </div>
                </div>

                <!-- Main Content Area -->
                <div class="w-full h-full max-h-svh overflow-hidden flex flex-col items-center justify-center py-32 bg-sidebar rounded-xl border">
                    <div class="text-center">
                        <!-- Placeholder Icon -->
                        <div class="mx-auto mb-8 h-24 w-24 text-gray-300">
                            <svg viewBox="0 0 100 100" fill="currentColor">
                                <rect x="10" y="10" width="15" height="15" opacity="0.3"/>
                                <rect x="30" y="10" width="15" height="15" opacity="0.5"/>
                                <rect x="50" y="10" width="15" height="15" opacity="0.7"/>
                                <rect x="70" y="10" width="15" height="15" opacity="0.9"/>
                                <rect x="10" y="30" width="15" height="15" opacity="0.5"/>
                                <rect x="30" y="30" width="15" height="15" opacity="0.7"/>
                                <rect x="50" y="30" width="15" height="15" opacity="0.9"/>
                                <rect x="70" y="30" width="15" height="15" opacity="0.3"/>
                                <rect x="10" y="50" width="15" height="15" opacity="0.7"/>
                                <rect x="30" y="50" width="15" height="15" opacity="0.9"/>
                                <rect x="50" y="50" width="15" height="15" opacity="0.3"/>
                                <rect x="70" y="50" width="15" height="15" opacity="0.5"/>
                                <rect x="10" y="70" width="15" height="15" opacity="0.9"/>
                                <rect x="30" y="70" width="15" height="15" opacity="0.3"/>
                                <rect x="50" y="70" width="15" height="15" opacity="0.5"/>
                                <rect x="70" y="70" width="15" height="15" opacity="0.7"/>
                            </svg>
                        </div>

                        <h2 class="text-xl font-medium text-gray-900 mb-2">
                            No applications yet
                        </h2>
                        <p class="text-gray-600 mb-8">
                            Get started and create your first application.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
