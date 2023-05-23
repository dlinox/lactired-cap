<template>
    <v-form ref="formRef" @submit.prevent="submit">
        <v-row>
            <v-col cols="12">
                <v-row>
                    <v-col cols="12">
                        <v-text-field
                            v-model.trim="form.inst_nombre"
                            label="Nombre"
                            :rules="[isRequired]"
                            :error-messages="form.errors.inst_nombre"
                        />
                    </v-col>

                    <v-col cols="12">
                        <v-text-field
                            v-model.trim="form.inst_apellido"
                            label="Apellidos"
                            :rules="[isRequired]"
                            :error-messages="form.errors.inst_apellido"
                        />
                    </v-col>

                    <v-col cols="3">
                        <v-select
                            label="Doc. Tipo"
                            v-model.trim="form.inst_documento_tipo"
                            :items="['DNI', 'RUC', 'CE']"
                            :rules="[isRequired]"
                            :error-messages="form.errors.inst_documento_tipo"
                        ></v-select>
                    </v-col>

                    <v-col cols="9">
                        <v-text-field
                            v-model.trim="form.inst_documento_nro"
                            label="Doc. Nro"
                            :rules="[isRequired]"
                            :error-messages="form.errors.inst_documento_nro"
                        />
                    </v-col>

                    <v-col cols="12">
                        <v-text-field
                            v-model.trim="form.inst_email"
                            label="Correo electronico"
                            :rules="[isRequired]"
                            :error-messages="form.errors.inst_email"
                        />
                    </v-col>

                    <v-col cols="12">
                        <v-checkbox v-model="form.inst_estado" label="Estado" />
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
            inst_nombre: "",
            inst_apellido: "",
            inst_documento_tipo: "DNI",
            inst_documento_nro: "",
            inst_email: "",
            inst_password: "",
            inst_estado: true,
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
    ? "/admin/instructores/" + props.formData?.inst_id
    : "/admin/instructores";

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
