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
                            :select="{ areas: areas, tipos:tipos, examenes: examenes, instructores:instructores }"
                            @on-cancel="dialog"
                        />
                    </template>
                </BtnDialog>
            </template>
        </HeadingPage>

        <v-container>
            {{ actividades }}
        </v-container>
    </AdminLayout>
</template>
<script setup>
import AdminLayout from "@/layouts/AdminLayout.vue";
import HeadingPage from "@/components/HeadingPage.vue";
import BtnDialog from "@/components/BtnDialog.vue";
import FormActividad from "./components/FormActividad.vue";

const props = defineProps({
    actividades: Array,
    areas: Array,
    tipos: Array,
    examenes: Array,
    instructores: Array,
});
</script>
