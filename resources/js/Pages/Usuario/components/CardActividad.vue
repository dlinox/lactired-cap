<template>
    <v-card variant="tonal">
        <v-card-subtitle class="pt-3 d-flex aling-center">
            <v-chip color="info" label size="x-small">
                {{ item.acti_modalidad }}
            </v-chip>

            <v-spacer></v-spacer>
            {{ item.fecha }}
        </v-card-subtitle>
        <v-card-title class="text-h6">
            {{ item.acti_tema }}
        </v-card-title>

        <v-card-subtitle>
            {{ item.acti_descripcion }}
        </v-card-subtitle>
        <v-card-item>
            <v-chip label size="x-small" class="me-2">
                {{ item.tipo.tipo_nombre }}
            </v-chip>

            <v-chip label size="x-small">
                {{ item.area.area_nombre }}
            </v-chip>
        </v-card-item>

        <v-card-item v-if="item.examen">
            <v-icon> mdi-content-paste </v-icon>

            {{ item.examen.exam_nombre }}
        </v-card-item>
        <v-divider></v-divider>
        <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn class="px-3" variant="flat" >
                <DialogConfirm
                    text="¿Seguro de empezar la capacitación?"
                    @onConfirm="
                        () =>
                            router.post('/u/actividad/iniciar', {
                                actividad: item.acti_id,
                                secciones: item.examen.secciones_count,
                            })
                    "
                />
                Participar
            </v-btn>
        </v-card-actions>
    </v-card>
</template>
<script setup>
import { router } from "@inertiajs/vue3";
import DialogConfirm from "../../../components/DialogConfirm.vue";
const props = defineProps({
    item: Object,
});
</script>
