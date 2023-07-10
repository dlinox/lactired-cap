<template>
    <v-app id="inspire">
        <v-navigation-drawer v-model="drawer" theme="dark" border="0">
            <!-- <v-card class="ma-2 text-secondary" variant="tonal">              
                <Logo class="py-5 mx-auto" LogoTheme="dark" :LogoWidth="100"></Logo>
            </v-card> -->
            <MainMenu />
        </v-navigation-drawer>

        <v-app-bar absolute elevation="0">
            <v-app-bar-nav-icon @click="drawer = !drawer"></v-app-bar-nav-icon>
            <v-toolbar-title> <Logo></Logo> </v-toolbar-title>
            <v-spacer></v-spacer>
            <SwitchTheme />
            <v-btn
                color="red"
                icon
                size="small"
                @click="router.delete('/logout')"
            >
                <v-icon>mdi-logout</v-icon>
            </v-btn>
        </v-app-bar>

        <v-main>
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
import MainMenu from "../components/MainMenu.vue";
import SwitchTheme from "../components/SwitchTheme.vue";
import Logo from "../components/Logo.vue";
import { router, usePage } from "@inertiajs/vue3";


const user = computed(() => usePage().props?.auth?.user);
const flash = computed(() => usePage().props?.flash);
const error = computed(() => usePage().props?.errors);

const drawer = ref(null);
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

<style>
/* @import url('https://fonts.googleapis.com/css2?family=Urbanist:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500&display=swap'); */
@import url("https://fonts.googleapis.com/css2?family=Maven+Pro:wght@400;500;600;700;800;900&display=swap");
#inspire {
    /* font-family: 'Urbanist', sans-serif; */
    font-family: "Maven Pro", sans-serif;
}
</style>
