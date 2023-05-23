<template>
    <div class="wrapper-login">
        <v-card class="mx-auto my-auto" max-width="400">
            <v-card-title class="pa-5">
                <Logo class="mx-auto"></Logo>
            </v-card-title>
            <v-divider></v-divider>
            <v-card-item>
                <v-form>
                    <v-form ref="formRef" @submit.prevent="submit">
                        <v-row no-gutters>
                            <v-col cols="12" class="my-2">
                                <span class="text-overline my-5">Ingresar</span>
                                
                            </v-col>
                            <v-col cols="12" class="my-2">
                                <v-text-field
                                    v-model="form.email"
                                    prepend-inner-icon="mdi-account"
                                    label="Usuario"
                                />
                            </v-col>
                            <v-col cols="12" class="my-2">
                                <v-text-field
                                    v-model="form.password"
                                    type="password"
                                    label="Contraseña"
                                />
                            </v-col>
                            <v-col cols="12" class="my-2">
                                <v-btn
                                    type="submit"
                                    block
                                    rounded="lg"
                                    variant="flat"
                                    append-icon="mdi-login-variant"
                                >
                                    Ingresar
                                </v-btn>
                            </v-col>
                        </v-row>
                    </v-form>
                </v-form>
            </v-card-item>
        </v-card>
    </div>
</template>
<script setup>
import Logo from "@/components/Logo.vue";
import { useForm } from "@inertiajs/vue3";

const form = useForm({
    email: "admin@gmail.com",
    password: "password",
});

const submit = async () => {
    form.post("/sign-in", {
        onError: (e) => {
            console.log(e);
        },
        onSuccess: (e) => {
            console.log(e);
            console.log("redireccionando");
        },
    });
};
</script>
<style lang="scss">
.wrapper-login{
  display: flex;
  width: 100vw;
  height: 100vh;
  align-items: center;
}
</style>
