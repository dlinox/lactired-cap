<template>
    <UsuarioLayout>
        <v-container>
            <v-row>
                <v-col cols="12" sm="4">
                    <v-card rounded="lg">
                        <v-list rounded="lg" color="primary">
                            <v-list-item
                                link
                                :disabled="
                                    participacion.part_seccion_actual == 0 &&
                                    !participacion.part_finalizada
                                        ? false
                                        : true
                                "
                                :active="
                                    participacion.part_seccion_actual == 0
                                        ? true
                                        : false
                                "
                            >
                                <v-list-item-title>
                                    Precentacion
                                </v-list-item-title>
                            </v-list-item>
                            <v-divider class="my-2"></v-divider>
                            <v-list-item
                                v-for="n in participacion.part_secciones_total"
                                :key="n"
                                link
                                :disabled="
                                    participacion.part_seccion_actual == n &&
                                    !participacion.part_finalizada
                                        ? false
                                        : true
                                "
                                :active="
                                    participacion.part_seccion_actual == n &&
                                    !participacion.part_finalizada
                                        ? true
                                        : false
                                "
                            >
                                <v-list-item-title>
                                    Seccion {{ n }}
                                </v-list-item-title>
                            </v-list-item>

                            <v-divider class="my-2"></v-divider>

                            <v-list-item
                                link
                                :active="participacion.part_finalizada"
                            >
                                <v-list-item-title>
                                    Finalizado
                                </v-list-item-title>
                            </v-list-item>
                        </v-list>
                    </v-card>
                </v-col>

                <v-col cols="12" sm="8">
                    <v-card :title="actividad.acti_tema">
                        <v-divider></v-divider>
                        <v-form
                            ref="formRef"
                            @submit.prevent="siguienteSeccion"
                        >
                            <template
                                v-if="participacion.part_seccion_actual == 0"
                            >
                                <Presentacion :actividad="actividad" />
                            </template>

                            <template
                                v-if="seccion && !participacion.part_finalizada"
                            >
                                <v-card-item>
                                    <div class="text-subtitle-1 my-4">
                                        Sección
                                        {{ participacion.part_seccion_actual }}:
                                        <strong> {{ aux.secc_nombre }} </strong>
                                    </div>

                                    <iframe
                                        width="100%"
                                        height="350"
                                        src="https://www.youtube.com/embed/YuCZKyAzplE"
                                        frameborder="0"
                                        allowfullscreen
                                    ></iframe>

                                    <v-card
                                        class="mb-4 mt-2 px-5"
                                        variant="tonal"
                                        v-for="(item, index) in aux.preguntas"
                                    >
                                        <v-card-title>
                                            <small>
                                                <strong>
                                                    Pregunta {{ index + 1 }}:
                                                </strong>
                                                {{ item.preg_enunciado }}
                                            </small>
                                        </v-card-title>

                                        <v-card-item>
                                            <v-radio-group
                                                v-model="item.respuesta"
                                                column
                                                :rules="[isRequired]"
                                            >
                                                <v-radio
                                                    v-for="(
                                                        opcion, indexOpcion
                                                    ) in item.opciones"
                                                    :label="opcion.opci_texto"
                                                    :value="opcion.opci_id"
                                                ></v-radio>
                                            </v-radio-group>
                                        </v-card-item>
                                    </v-card>
                                </v-card-item>
                            </template>

                            <template v-if="participacion.part_finalizada">
                                <v-card-item>
                                    <v-alert
                                        color="blue"
                                        variant="tonal"
                                        type="success"
                                        title="¡Felicitaciones por completar con éxito tu capacitación!"
                                    >
                                        <p class="mt-3 mb-2">
                                            Quiero expresarte mi más sincera
                                            felicitación por tu logro. Has
                                            demostrado dedicación, esfuerzo y
                                            perseverancia durante todo el
                                            proceso de capacitación, y eso ha
                                            dado sus frutos. Tu determinación y
                                            compromiso son verdaderamente
                                            admirables.
                                        </p>

                                        <p class="mb-2">
                                            Has adquirido nuevos conocimientos,
                                            habilidades y herramientas que
                                            seguramente te serán de gran
                                            utilidad en tu carrera profesional.
                                            Estoy seguro de que esta
                                            capacitación te abrirá puertas y te
                                            permitirá alcanzar tus metas y
                                            aspiraciones.
                                        </p>

                                        <p class="mb-2">
                                            No olvides reconocer tu propio
                                            mérito y celebrar este hito. Te has
                                            superado a ti mismo/a y has
                                            demostrado tu capacidad para
                                            enfrentar desafíos y alcanzar el
                                            éxito. Estoy orgulloso/a de ti y de
                                            todo lo que has logrado.
                                        </p>

                                        <p class="mb-2">
                                            Ahora que has completado esta
                                            capacitación, te animo a seguir
                                            aprendiendo y creciendo. El
                                            aprendizaje continuo es fundamental
                                            en un mundo en constante cambio, y
                                            tú has demostrado que tienes la
                                            motivación y la determinación para
                                            seguir creciendo profesionalmente.
                                        </p>

                                        <p class="mb-2">
                                            ¡Una vez más, felicitaciones por tu
                                            éxito! Disfruta este momento y
                                            prepárate para los nuevos y
                                            emocionantes desafíos que te
                                            esperan. Estoy seguro/a de que
                                            seguirás cosechando éxitos en tu
                                            carrera. ¡Enhorabuena!
                                        </p>
                                        <p class="mb-2">
                                            Espero que esto sea útil. ¡Si tienes
                                            alguna otra pregunta, no dudes en
                                            hacerla!
                                        </p>
                                    </v-alert>
                                </v-card-item>
                            </template>

                            <v-divider></v-divider>
                            <v-card-actions>
                                <v-spacer></v-spacer>
                                <v-btn
                                    v-if="!participacion.part_finalizada"
                                    class="px-4"
                                    variant="flat"
                                    append-icon="mdi-chevron-right"
                                    @click="siguienteSeccion()"
                                >
                                    continuar
                                </v-btn>
                            </v-card-actions>
                        </v-form>
                    </v-card>
                </v-col>
            </v-row>
        </v-container>
    </UsuarioLayout>
</template>
<script setup>
import { computed, ref } from "vue";
import { router } from "@inertiajs/vue3";
import { isRequired } from "@/helpers/validations.js";
import UsuarioLayout from "@/layouts/UsuarioLayout.vue";
import Presentacion from "./components/Presentacion.vue";

const props = defineProps({
    actividad: Object,
    participacion: Object,
    seccion: Object,
});

const aux = computed(() => {
    return { acti_id: props.actividad.acti_id, ...props.seccion };
});
delete aux.value.recursos;
delete aux.value.secc_nota_aprobatoria;

const formRef = ref(null);
const siguienteSeccion = async () => {
    const { valid } = await formRef.value.validate();
    if (!valid) return;

    router.post("/u/actividad/siguiente-seccion", aux.value, {
        onSuccess: () => console.log("bien"),
    });
};
</script>
