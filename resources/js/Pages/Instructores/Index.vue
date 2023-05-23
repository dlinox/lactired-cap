<template>
    <AdminLayout>
        <HeadingPage title="Instructores">
            <template #actions>
                <BtnDialog title="Nuevo Instructor" width="500px">
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
                        <FormInstructor @on-cancel="dialog" />
                    </template>
                </BtnDialog>
            </template>
        </HeadingPage>
        <v-container fluid>
            <v-card>
                <v-card-item>
                    <DataTable
                        :headers="headers"
                        :items="instructores"
                        with-action
                        url="/admin/instructores"
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

                        <template v-slot:item.inst_estado="{ item }">
                            <v-btn
                                variant="tonal"
                                class="ml-1"
                                :color="
                                    item.inst_estado ? 'green' : 'secondary'
                                "
                                rounded="0"
                                density="compact"
                            >
                                <small>
                                    {{
                                        item.inst_estado ? "Activo" : "Inactivo"
                                    }}
                                </small>
                            </v-btn>
                        </template>

                        <template v-slot:action="{ item }">
                            <BtnDialog
                                :title="'Editar ' + item.inst_nombre"
                                width="500px"
                            >
                                <template v-slot:activator="{ dialog }">
                                    <v-btn
                                        color="info"
                                        icon
                                        variant="outlined"
                                        density="comfortable"
                                        @click="dialog"
                                    >
                                        <v-icon
                                            size="x-small"
                                            icon="mdi-pencil"
                                        ></v-icon>
                                    </v-btn>
                                </template>
                                <template v-slot:content="{ dialog }">
                                    <FormInstructor
                                        @on-cancel="dialog"
                                        :form-data="item"
                                        :edit="true"
                                    />
                                </template>
                            </BtnDialog>

                            <v-btn
                                icon
                                variant="outlined"
                                density="comfortable"
                                class="ml-1"
                                color="red"
                            >
                                <DialogConfirm
                                    @onConfirm="
                                        () =>
                                            router.delete(
                                                '/admin/instructores/' +
                                                    item.inst_id
                                            )
                                    "
                                />
                                <v-icon
                                    size="x-small"
                                    icon="mdi-delete-empty"
                                ></v-icon>
                            </v-btn>
                        </template>
                    </DataTable>
                </v-card-item>
            </v-card>
        </v-container>
    </AdminLayout>
</template>

<script setup>
import { ref, watch } from "vue";
import { router } from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import DataTable from "@/components/DataTable.vue";
import HeadingPage from "@/components/HeadingPage.vue";
import DialogConfirm from "@/components/DialogConfirm.vue";
import BtnDialog from "@/components/BtnDialog.vue";
import FormInstructor from "./components/FormInstructor.vue";
const props = defineProps({
    instructores: Object,
    headers: Array,
    filters: Object,
    perPageOptions: Array,
});

const search = ref(props.filters.search || "");
const perPage = ref(props.filters.per_page || 10);
</script>
