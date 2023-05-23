<template>
    <AdminLayout>
        <HeadingPage title="Examen" subtitle="Crear nuevo examen">
            <template #actions>
                <v-btn class="" @click="guardar()"> Guardar </v-btn>
            </template>
        </HeadingPage>
        <v-container fluid>
            <v-card>
                <v-toolbar variant="tonal" extended>
                    <v-toolbar-title>
                        <v-text-field
                            class="mt-5"
                            v-model="form.exam_nombre"
                            label="Nombre del examen"
                            variant="solo"
                            :error-messages="form.errors.exam_nombre"
                        ></v-text-field>
                    </v-toolbar-title>

                    <v-btn
                        class="ms-5"
                        prepend-icon="mdi-plus"
                        variant="flat"
                        color="light"
                        size="large"
                        @click="agregarSeccion"
                    >
                        Sección
                    </v-btn>

                    <template v-slot:extension>
                        <v-tabs v-model="tab" align-tabs="title">
                            <v-tab
                                v-for="(item, indexSeccion) in form.secciones"
                                :key="indexSeccion"
                                :value="indexSeccion"
                            >
                                Sección {{ indexSeccion + 1 }}
                            </v-tab>
                        </v-tabs>
                    </template>
                </v-toolbar>

                <v-window v-model="tab">
                    <v-window-item
                        v-for="(item, indexSeccion) in form.secciones"
                        :key="indexSeccion"
                        :value="indexSeccion"
                    >
                        <v-card flat>
                            <v-card-text>
                                <v-row>
                                    <v-col cols="12">
                                        <div class="d-flex">
                                            <v-text-field
                                                v-model="item.secc_nombre"
                                                label="Nombre de la seccion"
                                                :error-messages="
                                                    form.errors[
                                                        `secciones.${indexSeccion}.secc_nombre`
                                                    ]
                                                "
                                            ></v-text-field>

                                            <v-tooltip
                                                text="Quitar sección"
                                                location="start"
                                            >
                                                <template
                                                    v-slot:activator="{ props }"
                                                >
                                                    <v-btn
                                                        v-bind="props"
                                                        class="ms-2"
                                                        size="small"
                                                        icon
                                                        color="red"
                                                        variant="tonal"
                                                        :disabled="
                                                            form.secciones
                                                                .length == 1
                                                        "
                                                    >
                                                        <DialogConfirm
                                                            text="¿Seguro de quitar la sección?"
                                                            @on-confirm="
                                                                quitarSeccion(
                                                                    indexSeccion
                                                                )
                                                            "
                                                        />
                                                        <v-icon>
                                                            mdi-delete-empty-outline
                                                        </v-icon>
                                                    </v-btn>
                                                </template>
                                            </v-tooltip>
                                        </div>
                                    </v-col>

                                    <v-col>
                                        <BtnDialog
                                            title="Nuevo Registro"
                                            width="500px"
                                        >
                                            <template
                                                v-slot:activator="{ dialog }"
                                            >
                                                <v-btn
                                                    color="dark"
                                                    @click="dialog"
                                                    prepend-icon="mdi-plus"
                                                    variant="outlined"
                                                >
                                                    Recurso
                                                </v-btn>
                                            </template>
                                            <template
                                                v-slot:content="{ dialog }"
                                            >
                                                <FormAddRecurso
                                                    @onSubmit="
                                                        agregarRecurso(
                                                            $event,
                                                            indexSeccion
                                                        )
                                                    "
                                                    @on-cancel="dialog"
                                                />
                                            </template>
                                        </BtnDialog>
                                    </v-col>
                                </v-row>
                            </v-card-text>

                            <v-card-item>
                                <v-row>
                                    <v-col
                                        cols="12"
                                        sm="6"
                                        md="4"
                                        lg="3"
                                        v-for="(
                                            recurso, indexRecurso
                                        ) in item.recursos"
                                    >
                                        <v-card variant="tonal">
                                            <v-card-item>
                                                <div>
                                                    <div class="text-overline">
                                                        {{ recurso.recu_tipo }}
                                                    </div>
                                                    <div
                                                        class="text-subtitle-2 mb-1"
                                                    >
                                                        {{
                                                            recurso.recu_nombre
                                                        }}
                                                    </div>
                                                    <div class="text-caption">
                                                        {{
                                                            recurso.recu_descripcion
                                                        }}
                                                    </div>
                                                </div>

                                                {{
                                                    form.errors[
                                                        `secciones.${indexSeccion}.recursos.${indexRecurso}.recu_nombre`
                                                    ]
                                                }}
                                            </v-card-item>

                                            <v-card-actions>
                                                <v-spacer></v-spacer>

                                                <v-btn
                                                    class="px-3"
                                                    prepend-icon="mdi-open-in-new"
                                                    variant="text"
                                                >
                                                    Ver
                                                </v-btn>

                                                <v-btn
                                                    color="red"
                                                    variant="tonal"
                                                    @click="
                                                        quitarRecurso(
                                                            indexSeccion,
                                                            indexRecurso
                                                        )
                                                    "
                                                >
                                                    Quitar
                                                </v-btn>
                                            </v-card-actions>
                                        </v-card>
                                    </v-col>
                                </v-row>
                            </v-card-item>

                            <v-card-item>
                                <v-card
                                    variant="tonal"
                                    v-for="(
                                        pregunta, indexPregunta
                                    ) in item.preguntas"
                                    :key="indexPregunta"
                                    class="mb-5"
                                >
                                    <v-toolbar
                                        variant="tonal"
                                        extended
                                        extension-height="20"
                                    >
                                        <v-app-bar-nav-icon>
                                            <v-avatar color="grey-lighten-1">
                                                P{{ indexPregunta + 1 }}
                                            </v-avatar>
                                        </v-app-bar-nav-icon>

                                        <v-toolbar-title>
                                            <v-text-field
                                                v-model="
                                                    pregunta.preg_enunciado
                                                "
                                                label="Enunciado"
                                                variant="solo"
                                                class="me-5 mt-4"
                                                :error-messages="
                                                    form.errors[
                                                        `secciones.${indexSeccion}.preguntas.${indexPregunta}.preg_enunciado`
                                                    ]
                                                "
                                            ></v-text-field>
                                        </v-toolbar-title>

                                        <v-btn
                                            icon
                                            variant="tonal"
                                            color="red"
                                            size="default"
                                            :disabled="
                                                item.preguntas.length == 1
                                            "
                                        >
                                            <DialogConfirm
                                                text="¿Seguro de quitar la pregunta?"
                                                @on-confirm="
                                                    quitarPregunta(
                                                        indexSeccion,
                                                        indexPregunta
                                                    )
                                                "
                                            />
                                            <v-icon
                                                icon="mdi-delete-empty-outline"
                                            >
                                            </v-icon>
                                        </v-btn>
                                    </v-toolbar>

                                    <v-card-item>
                                        <v-list-item
                                            v-for="(
                                                opcion, indexOpcion
                                            ) in pregunta.opciones"
                                            :key="indexOpcion"
                                        >
                                            <v-text-field
                                                class="my-2"
                                                v-model="opcion.opci_texto"
                                                label="Opcion texto"
                                                :error-messages="
                                                    form.errors[
                                                        `secciones.${indexSeccion}.preguntas.${indexPregunta}.opciones.${indexOpcion}.opci_texto`
                                                    ]
                                                "
                                            ></v-text-field>

                                            <template v-slot:prepend>
                                                <v-avatar
                                                    :color="
                                                        opcion.opci_correcta
                                                            ? 'green-accent-3'
                                                            : 'grey-lighten-1'
                                                    "
                                                >
                                                    O{{ indexOpcion + 1 }}
                                                </v-avatar>
                                            </template>

                                            <template v-slot:append>
                                                <v-tooltip
                                                    text="Marcar como correcta"
                                                >
                                                    <template
                                                        v-slot:activator="{
                                                            props,
                                                        }"
                                                    >
                                                        <v-btn
                                                            v-bind="props"
                                                            class="ms-2"
                                                            density="default"
                                                            icon="mdi-check-all"
                                                            :color="
                                                                opcion.opci_correcta
                                                                    ? 'green-accent-3'
                                                                    : 'grey-lighten-1'
                                                            "
                                                            variant="tonal"
                                                            @click="
                                                                opcion.opci_correcta =
                                                                    !opcion.opci_correcta
                                                            "
                                                        >
                                                        </v-btn>
                                                    </template>
                                                </v-tooltip>

                                                <v-btn
                                                    class="ms-2"
                                                    density="default"
                                                    icon="mdi-delete-empty-outline"
                                                    color="red"
                                                    variant="tonal"
                                                    :disabled="
                                                        pregunta.opciones
                                                            .length == 1
                                                    "
                                                    @click="
                                                        quitarOpcion(
                                                            indexSeccion,
                                                            indexPregunta,
                                                            indexOpcion
                                                        )
                                                    "
                                                >
                                                </v-btn>
                                            </template>
                                        </v-list-item>
                                    </v-card-item>

                                    <v-card-actions>
                                        <v-spacer></v-spacer>
                                        <v-btn
                                            color="dark"
                                            variant="outlined"
                                            prepend-icon="mdi-plus"
                                            class="px-3"
                                            @click="
                                                agregarOpcion(
                                                    indexSeccion,
                                                    indexPregunta
                                                )
                                            "
                                        >
                                            Opción
                                        </v-btn>
                                    </v-card-actions>
                                </v-card>
                            </v-card-item>

                            <v-card-actions class="border-3">
                                <v-spacer></v-spacer>
                                <v-btn
                                    color="dark"
                                    variant="outlined"
                                    prepend-icon="mdi-plus"
                                    class="px-3"
                                    @click="agregarPregunta(indexSeccion)"
                                >
                                    Pregunta
                                </v-btn>
                            </v-card-actions>
                        </v-card>
                    </v-window-item>
                </v-window>
            </v-card>
        </v-container>
    </AdminLayout>
</template>
<script setup>
import { ref } from "vue";
import AdminLayout from "@/layouts/AdminLayout.vue";
import HeadingPage from "@/components/HeadingPage.vue";
import DialogConfirm from "@/components/DialogConfirm.vue";
import BtnDialog from "@/components/BtnDialog.vue";
import FormAddRecurso from "./components/FormAddRecurso.vue";
import { useForm } from "@inertiajs/vue3";
const tab = ref(null);

const form = useForm({
    exam_nombre: "Nombre del Examen",
    exam_duracion: 60,
    exam_nota_aprobatoria: 70,
    secciones: [
        {
            secc_nombre: "Nombre de la Sección 1",
            secc_nota_aprobatoria: 60,

            recursos: [
                {
                    recu_nombre: "Recurso 1",
                    recu_descripcion: "Descripcion del recurso 1",
                    recu_tipo: "VIDEO",
                    recu_url: "https://www.youtube.com/",
                    recu_estado: true,
                },
                {
                    recu_nombre: "Recurso 2",
                    recu_descripcion: "Descripcion del recurso 2",
                    recu_tipo: "VIDEO",
                    recu_url: "https://www.youtube.com/",
                    recu_estado: true,
                },
            ],

            preguntas: [
                {
                    preg_enunciado: "Enunciado de la Pregunta 1",
                    opciones: [
                        {
                            opci_texto: "Opción 1",
                            opci_correcta: true,
                        },
                        {
                            opci_texto: "Opción 2",
                            opci_correcta: false,
                        },
                    ],
                },
                {
                    preg_enunciado: "Enunciado de la Pregunta 2",
                    opciones: [
                        {
                            opci_texto: "Opción 1",
                            opci_correcta: false,
                        },
                        {
                            opci_texto: "Opción 2",
                            opci_correcta: true,
                        },
                    ],
                },
            ],
        },
        {
            secc_nombre: "Nombre de la Sección 2",
            secc_nota_aprobatoria: 70,
            recursos: [],
            preguntas: [
                {
                    preg_enunciado: "Enunciado de la Pregunta 1",
                    opciones: [
                        {
                            opci_texto: "Opción 1",
                            opci_correcta: true,
                        },
                        {
                            opci_texto: "Opción 2",
                            opci_correcta: false,
                        },
                    ],
                },
            ],
        },
    ],
});

const seccion = [
    {
        secc_nombre: "Nombre de la Sección",
        secc_nota_aprobatoria: 100,
        recursos: [],
        preguntas: [
            {
                preg_enunciado: "Enunciado de la Pregunta",
                opciones: [
                    {
                        opci_texto: "Opción 1",
                        opci_correcta: true,
                    },
                    {
                        opci_texto: "Opción 2",
                        opci_correcta: false,
                    },
                    {
                        opci_texto: "Opción 3",
                        opci_correcta: false,
                    },
                ],
            },
        ],
    },
];

const agregarSeccion = () => {
    form.secciones.push(...seccion);
    tab.value = form.secciones.length - 1;
};
const quitarSeccion = (indexSeccion) => {
    form.secciones.splice(indexSeccion, 1);
    tab.value = 0;
};

const agregarRecurso = (item, indexSeccion) => {
    form.secciones[indexSeccion].recursos.push(item);
};
const quitarRecurso = (indexSeccion, indexRecurso) => {
    form.secciones[indexSeccion].recursos.splice(indexRecurso, 1);
};

const agregarPregunta = (indexSeccion) => {
    form.secciones[indexSeccion].preguntas.push(seccion[0].preguntas[0]);
};
const quitarPregunta = (indexSeccion, indexPregunta) => {
    form.secciones[indexSeccion].preguntas.splice(indexPregunta, 1);
};

const agregarOpcion = (indexSeccion, indexPregunta) => {
    form.secciones[indexSeccion].preguntas[indexPregunta].opciones.push({
        opci_texto: "Opción",
        opci_correcta: false,
    });
};
const quitarOpcion = (indexSeccion, indexPregunta, indexOpcion) => {
    form.secciones[indexSeccion].preguntas[indexPregunta].opciones.splice(
        indexOpcion,
        1
    );
};

const guardar = () => {
    console.log(form);

    form.post("/admin/examenes", option);
    //let res = await axios.post("/admin/examenes",  form.value);

    //console.log(res);
};
const option = {
    onSuccess: (page) => {
        console.log("onSuccess");
        emit("onCancel");
    },
    onError: (errors) => {
        console.log("onError");
    },
    onFinish: (visit) => {
        console.log("onFinish");
    },
};
</script>
