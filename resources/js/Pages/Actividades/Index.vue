<template>
    <AdminLayout>
        <HeadingPage title="Actividads" subtitle="Lista de activiades">
            <template #actions>
                <BtnDialog title="Nuevo Actividad" width="600px">
                    <template v-slot:activator="{ dialog }">
                        <v-btn
                            @click="dialog"
                            prepend-icon="mdi-plus"
                            variant="flat"
                        >
                            Nuevo
                        </v-btn>
                    </template>
                    <template v-slot:content="{ dialog }">
                        <FormActividad
                            :select="{
                                areas: areas,
                                tipos: tipos,
                                examenes: examenes,
                                instructores: instructores,
                            }"
                            @on-cancel="dialog"
                        />
                    </template>
                </BtnDialog>
            </template>
        </HeadingPage>

        <v-container fluid>
            <v-card>
                <v-card-item>
                    <DataTable
                        :headers="headers"
                        :items="actividades"
                        url="/admin/actividades"
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
import AdminLayout from "@/layouts/AdminLayout.vue";
import HeadingPage from "@/components/HeadingPage.vue";
import BtnDialog from "@/components/BtnDialog.vue";
import FormActividad from "./components/FormActividad.vue";
import DataTable from "../../components/DataTable.vue";

const props = defineProps({
    headers: Array,
    actividades: Object,
    areas: Array,
    tipos: Array,
    examenes: Array,
    instructores: Array,
});
</script>
