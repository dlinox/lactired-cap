<template>
    <v-form ref="formRef" @submit.prevent="submit">
        <v-row>
            <v-col cols="12">
                <v-row>
                    <v-col cols="12">
                        <v-text-field
                            color="secondary"
                            v-model.trim="form.area_nombre"
                            label="Nombre"
                            :rules="[isRequired]"
                            :error-messages="form.errors.area_nombre"
                        />
                    </v-col>

                    <v-col cols="12">
                        <v-textarea
                            v-model.trim="form.area_descripcion"
                            label="Descripción"
                            :rules="[isRequired]"
                            rows="2"
                            :error-messages="form.errors.area_descripcion"
                        />
                    </v-col>

                    <v-col cols="12">
                        <v-checkbox v-model="form.area_estado" label="Estado" />
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
            area_nombre: "",
            area_descripcion: "",
            area_estado: true,
        },
    },

    edit: {
        type: Boolean,
        default: false,
    },
});
const formRef = ref(null);
const form = useForm({ ...props.formData });
const formUrl = props.edit
    ? "/admin/areas/" + props.formData?.area_id
    : "/admin/areas";

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
