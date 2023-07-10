<template>
    <v-app id="inspire">
        <v-app-bar flat>
            <v-container class="fill-height d-flex align-center">
                <v-avatar
                    class="me-10 ms-4"
                    color="grey-darken-1"
                    size="32"
                    icon="mdi-account"
                ></v-avatar>

                <v-btn variant="text"> {{ user.name }} </v-btn>

                <v-spacer></v-spacer>
                <SwitchTheme />

                <v-btn
                    color="red"
                    icon
                    size="small"
                    @click="router.delete('/u/logout')"
                >
                    <v-icon>mdi-logout</v-icon>
                </v-btn>
            </v-container>
        </v-app-bar>

        <v-main class="">
     
            <slot />
        </v-main>

        <v-snackbar v-model="snackbar" multi-line color="success">
            {{ flash.success }}

            <template v-slot:actions>
                <v-btn
                    color="dark"
                    variant="text"
                    @click="snackbar = false"
                    icon="mdi-close"
                ></v-btn>
            </template>
        </v-snackbar>

        <v-snackbar v-model="snackbarError" vertical multi-line color="error">
            <v-expansion-panels>
                <v-expansion-panel
                    elevation="0"
                    class="bg-transparent w-100"
                    :text="error.details"
                >
                    <v-expansion-panel-title
                        expand-icon="mdi-plus"
                        collapse-icon="mdi-minus"
                    >
                        {{ error.error }}
                    </v-expansion-panel-title>
                </v-expansion-panel>
            </v-expansion-panels>

            <template v-slot:actions>
                <v-btn
                    class="px-3"
                    color="white"
                    variant="tonal"
                    @click="snackbarError = false"
                    prepend-icon="mdi-close"
                >
                    Cerrar
                </v-btn>
            </template>
        </v-snackbar>
    </v-app>
</template>

<script setup>
import { ref, computed, watch } from "vue";
import { router, usePage } from "@inertiajs/vue3";
import SwitchTheme from "../components/SwitchTheme.vue";

const flash = computed(() => usePage().props?.flash);
const error = computed(() => usePage().props?.errors);

const user = computed(() => usePage().props?.auth?.usuario);

const snackbar = ref(false);
const snackbarError = ref(false);

watch(
    () => flash.value,
    (newValue) => {
        if (newValue && newValue.success) {
            snackbar.value = true;
        } else {
            snackbar.value = false;
        }
    }
);

watch(
    () => error.value,
    (newValue) => {
        if (newValue.details && newValue.error) {
            snackbarError.value = true;
        } else {
            snackbarError.value = false;
        }
    }
);
</script>
