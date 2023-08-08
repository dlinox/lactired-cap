<template>
    <AuthLayout>
        <v-card class="mx-auto my-auto" max-width="400">
            <v-card-title class="pa-5 text-center">
                <img src="/images/logo.svg" alt="" width="100" />
            </v-card-title>
            <v-divider></v-divider>
            <v-card-item>
                <v-form ref="formRef" @submit.prevent="submit">
                    <v-row no-gutters>
                        <v-col cols="12" class="my-2">
                            <span class="text-overline my-5">Registarme</span>
                        </v-col>
                        <v-col cols="12" class="my-2">
                            <v-text-field
                                v-model="form.dni"
                                prepend-inner-icon="mdi-fingerprint"
                                label="Ingrese su N° de DNI"
                            />
                        </v-col>
                        <v-col cols="12" class="my-2">
                            <v-btn
                                type="submit"
                                block
                                variant="flat"
                                append-icon="mdi-text-search"
                            >
                                Buscar
                            </v-btn>
                        </v-col>
                    </v-row>
                </v-form>
            </v-card-item>

            <v-card-item class="pt-0">
                <v-btn variant="text" block>
                    <Link href="/login">
                        <small> Ingregar como administrador </small>
                    </Link>
                </v-btn>
            </v-card-item>
        </v-card>

        <v-dialog v-model="dialog" width="350">
            <v-card>
                <v-card-text>
                    <p class="mb-3">
                        Nombre: <b>{{ empleado.nombre }}</b>
                    </p>
                    <p class="mb-3">
                        Correo: <b>{{ empleado.email }}</b>
                    </p>
                </v-card-text>
                <v-card-actions>
                    <v-btn color="primary" block @click="dialog = false"
                        >Close Dialog</v-btn
                    >
                </v-card-actions>
            </v-card>
        </v-dialog>
    </AuthLayout>
</template>
<script setup>
import { Link, useForm } from "@inertiajs/vue3";

import AuthLayout from "@/layouts/AuthLayout.vue";
import { ref } from "vue";

const dialog = ref(false);

const form = useForm({
    dni: "93116191",
});

const empleado = ref(null);

const submit = async () => {
    form.get("/u/get-empleado", {
        preserveState: true,
        onError: (e) => {
            console.log(e);
        },
        onSuccess: (e) => {

            console.log(e.props.flash.data);
            dialog.value = true;
            empleado.value = e.props.flash.data;
        },
    });
};
</script>
