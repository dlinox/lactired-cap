<template>
    <v-form ref="formRef" @submit.prevent="submit">
        <v-row>
            <v-col cols="12">
                <v-row>
                    <v-col cols="12">
                        <v-text-field
                            label="Tema"
                            v-model.trim="form.acti_tema"
                            :rules="[isRequired]"
                            :error-messages="form.errors.acti_tema"
                        />
                    </v-col>

                    <v-col cols="12">
                        <v-textarea
                            v-model.trim="form.acti_descripcion"
                            label="Descripción"
                            :rules="[isRequired]"
                            rows="3"
                            :error-messages="form.errors.acti_descripcion"
                        />
                    </v-col>

                    <v-col cols="6">
                        <v-select
                            label="Area"
                            v-model.trim="form.acti_area_id"
                            :rules="[isRequired]"
                            :error-messages="form.errors.acti_area_id"
                            :items="select.areas"
                            item-title="area_nombre"
                            item-value="area_id"
                        ></v-select>
                    </v-col>

                    <v-col cols="6">
                        <v-select
                            label="Tipo"
                            v-model.trim="form.acti_tipo_id"
                            :rules="[isRequired]"
                            :error-messages="form.errors.acti_tipo_id"
                            item-title="tipo_nombre"
                            item-value="tipo_id"
                            :items="select.tipos"
                            disabled
                        ></v-select>
                    </v-col>

                    <v-col cols="12">
                        <v-select
                            label="Examen"
                            v-model.trim="form.acti_exam_id"
                            :rules="[isRequired]"
                            :error-messages="form.errors.acti_exam_id"
                            :items="select.examenes"
                            item-title="exam_nombre"
                            item-value="exam_id"
                        ></v-select>
                    </v-col>

                    <!-- <v-col cols="12">
                        <v-select
                            v-model.trim="form.acti_modalidad"
                            :rules="[isRequired]"
                            :error-messages="form.errors.acti_modalidad"
                            label="Instructor"
                            :items="select.instructores"
                            item-title="nombre"
                            item-value="inst_id"
                        ></v-select>
                    </v-col> -->

                    <v-col cols="6">
                        <v-text-field
                            type="date"
                            label="Fecha de inicio"
                            v-model.trim="form.acti_fecha_inicio"
                            :rules="[isRequired]"
                            :error-messages="form.errors.acti_fecha_inicio"
                        />
                    </v-col>
                    <v-col cols="6">
                        <v-text-field
                            type="date"
                            label="Fecha de fin"
                            v-model.trim="form.acti_fecha_fin"
                            :rules="[isRequired]"
                            :error-messages="form.errors.acti_fecha_fin"
                        />
                    </v-col>

                    <v-col cols="6">
                        <v-select
                            disabled
                            v-model.trim="form.acti_modalidad"
                            :rules="[isRequired]"
                            :error-messages="form.errors.acti_modalidad"
                            label="Modalidad"
                            :items="['VIRTUAL', 'PRESENCIAL']"
                        ></v-select>
                    </v-col>

                    <v-col cols="12">
                        <v-checkbox v-model="form.acti_estado" label="Estado" />
                    </v-col>
                </v-row>
            </v-col>
            <v-col md="12" class="d-flex flex-row-reverse">
                <v-btn
                    type="submit"
                    class="ms-2"
                    :loading="form.processing"
                    :disabled="!form.isDirty"
                >
                    Guardar
                </v-btn>
                <v-btn variant="tonal" color="red" @click="$emit('onCancel')">
                    cancelar
                </v-btn>
            </v-col>
        </v-row>
    </v-form>
</template>
<script setup>
import { ref } from "vue";
import { useForm } from "@inertiajs/vue3";
import { isRequired } from "@/helpers/validations.js";
const emit = defineEmits(["onCancel", "onSubmit"]);
const props = defineProps({
    formData: {
        type: Object,
        default: {
            acti_tema: "",
            acti_descripcion: "",
            acti_fecha_inicio: "",
            acti_fecha_fin: "",
            acti_modalidad: "VIRTUAL",
            acti_anio: new Date().getFullYear(), //now();
            acti_estado: true,
            acti_area_id: null,
            acti_tipo_id: 1,
            acti_inst_id: null,
            acti_exam_id: null,
        },
    },
    edit: {
        type: Boolean,
        default: false,
    },
    select: Object,
});
const formRef = ref(null);
const form = useForm({ ...props.formData });
const formUrl = props.edit
    ? "/admin/actividades/" + props.formData?.acti_id
    : "/admin/actividades";

const submit = async () => {
    const { valid } = await formRef.value.validate();
    if (!valid) return;
    if (props.edit) form.put(formUrl, option);
    else form.post(formUrl, option);
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
