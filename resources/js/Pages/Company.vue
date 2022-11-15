<script setup>
import { ref } from "vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/inertia-vue3";
import { Link } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";
import { watch } from "vue";
import Pagination from "@/Components/Pagination.vue";

const props = defineProps({
    companies: {
        type: Object,
        default: () => ({}),
    },
    
});

let search = ref("");
watch(search, (value) => {
    Inertia.get(
        "/companies",
        { search: value },
        {
            preserveState: true,
        }
    );
});
</script>

<template>
    <Head title="Company" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                List of Companies
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="mb-4">
                            <input
                                type="text"
                                v-model="search"
                                placeholder="Search..."
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-60 p-2.5"
                            />
                        </div>
                        <div
                            class="relative overflow-x-auto shadow-md sm:rounded-lg"
                        >
                            <table
                                class="w-full text-sm text-left text-gray-500 dark:text-gray-400"
                            >
                                <thead
                                    class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
                                >
                                    <tr>
                                        <th scope="col" class="px-6 py-3">#</th>
                                        <th scope="col" class="px-6 py-3">
                                            Company Name
                                        </th>

                                        <th scope="col" class="px-6 py-3">
                                            Createed At
                                        </th>
                                    </tr>
                                </thead>
                                <div v-if="!companies.data.length">
                                    <p>No results found</p>
                                </div>
                                <tbody>
                                    <tr
                                        v-for="(company, n) in companies.data"
                                        :key="companies.id"
                                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"
                                    >
                                        <th
                                            scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap"
                                        >
                                            {{ n + 1 }}
                                        </th>
                                        <th
                                            scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap"
                                        >
                                            {{ company.company_name }}
                                        </th>

                                        <th
                                            scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap"
                                        >
                                            {{
                                                new Date(
                                                    company.created_at
                                                ).toLocaleString("nl-NL")
                                            }}
                                        </th>
                                    </tr>
                                </tbody>
                            </table>
                            <Pagination :data="companies" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
