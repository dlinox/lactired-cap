<template>
    <v-form ref="formRef" @submit.prevent="submit">
        <v-row>
            <v-col cols="12">
                <v-row>
                    <v-col cols="12">
                        <v-select
                            label="Doc. Tipo"
                            v-model.trim="form.recu_tipo"
                            :items="['VIDEO', 'PDF', 'IMAGEN']"
                            :rules="[isRequired]"
                        ></v-select>
                    </v-col>
                    <v-col cols="12">
                        <v-text-field
                            color="secondary"
                            v-model.trim="form.recu_nombre"
                            label="Nombre"
                            :rules="[isRequired]"
                        />
                    </v-col>

                    <v-col cols="12">
                        <v-textarea
                            v-model.trim="form.recu_descripcion"
                            label="Descripción"
                            :rules="[isRequired]"
                            rows="2"
                        />
                    </v-col>

                    <v-col cols="12">
                        <v-text-field
                            color="secondary"
                            v-model.trim="form.recu_url"
                            label="URL"
                            :rules="[isRequired]"
                        />
                    </v-col>
                </v-row>
            </v-col>
            <v-col md="12" class="d-flex flex-row-reverse">
                <v-btn
                    type="submit"
                    class="ms-2"
                >
                    agregar
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
            recu_nombre: "",
            recu_descripcion: "",
            recu_tipo: "VIDEO",
            recu_url: "",
            recu_estado: true,
        },
    },

    edit: {
        type: Boolean,
        default: false,
    },
});
const formRef = ref(null);
const form = ref({ ...props.formData });

const submit = async () => {
    const { valid } = await formRef.value.validate();
    if (!valid) return;
    
    console.log("todo bine");
    emit('onSubmit', form.value);
    emit('onCancel');
};
</script>
