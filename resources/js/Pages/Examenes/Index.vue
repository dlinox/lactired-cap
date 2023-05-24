<template>
    <AdminLayout>
        <HeadingPage title="Examenes" subtitle="Lista de examenes">
            <template #actions>
                <Link href="/admin/examenes/create" class="me-4">
                    <v-btn prepend-icon="mdi-plus" variant="flat">
                        Nuevo
                    </v-btn>
                </Link>
            </template>
        </HeadingPage>
        <v-container fluid>
            <v-card>
                <v-card-item>
                    <DataTable
                        :headers="headers"
                        :items="examenes"
                        url="/admin/examenes"
                    >
                        <template v-slot:header="{ filter }">
                            <v-row class="py-3" justify="end">
                                <v-col cols="6">
                                    <v-text-field
                                        v-model="filter.search"
                                        label="Buscar"
                                    />
                                </v-col>
                            </v-row>
                        </template>
                    </DataTable>
                </v-card-item>
            </v-card>
        </v-container>
    </AdminLayout>
</template>
<script setup>
import { Link } from "@inertiajs/vue3";
import AdminLayout from "@/layouts/AdminLayout.vue";
import HeadingPage from "@/components/HeadingPage.vue";
import DataTable from "../../components/DataTable.vue";
const props = defineProps({
    examenes: Object,
    headers: Array
})
</script>
