<template>
    <v-card-item>
        <v-row>
            <v-col cols="12">
                {{ actividad.acti_descripcion }}
            </v-col>
            <v-col cols="12">
                <v-list-item
                    title="Modalida"
                    :subtitle="actividad.acti_modalidad"
                />
            </v-col>

            <v-col cols="6">
                <v-list-item
                    title="Tipo"
                    :subtitle="actividad.tipo.tipo_nombre"
                />
            </v-col>

            <v-col cols="6">
                <v-list-item
                    title="Tipo"
                    :subtitle="actividad.area.area_nombre"
                />
            </v-col>

            <v-col cols="12">
                <v-list-item
                    title="Test"
                    :subtitle="
                        actividad.examen.exam_nombre +
                        ' (' +
                        actividad.examen.secciones_count +
                        ' Secciones)'
                    "
                />
            </v-col>
            <v-col cols="12">
                <v-list-item>
                    <!-- <template v-slot:prepend>
                                   <v-icon>mdi-calendar-minus </v-icon>
                               </template> -->

                    <v-list-item-title
                        >Fecha inicio - Fecha fin
                    </v-list-item-title>
                    <v-list-item-subtitle>
                        {{ actividad.acti_fecha_inicio.substring(0, 10) }}
                        -
                        {{ actividad.acti_fecha_fin.substring(0, 10) }}
                    </v-list-item-subtitle>
                </v-list-item>
            </v-col>
        </v-row>
    </v-card-item>
</template>

<script setup>
const props = defineProps({
    actividad: Object,
});
</script>
