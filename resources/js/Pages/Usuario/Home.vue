<template>
    <v-app id="inspire">
        <v-app-bar
            class="toolbar-app px-5"
            color="#1A2232"
            density="prominent"
            scroll-behavior="fade-image hide"
            scroll-threshold="140"
            image="https://images.pexels.com/photos/422218/pexels-photo-422218.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1"
        >
            <template v-slot:prepend>
                <Logo :LogoWidth="120" LogoTheme="dark"></Logo>
            </template>

            <template v-slot:append>
                <v-btn
                    color="red"
                    icon
                    size="small"
                    @click="router.delete('/u/logout')"
                >
                    <v-icon>mdi-logout</v-icon>
                </v-btn>
            </template>
        </v-app-bar>

        <v-main>
            <v-container class="pt-0">
                <v-card elevation="0" class="mx-20" style="min-height: 70vh">
                    <v-toolbar flat color="#1A2232" style="z-index: 10000">
                        <v-toolbar-title class="text-white">
                            Capacitaciones
                        </v-toolbar-title>

                        <v-spacer></v-spacer>
                    </v-toolbar>

                    <v-divider></v-divider>

                    <v-container>
                        <v-row>
                            <v-col
                                cols="12"
                                md="6"
                                v-for="(item, index) in actividades"
                            >
                                <CardActividad :item="item" />
                            </v-col>
                        </v-row>
                    </v-container>
                </v-card>
            </v-container>

            <v-footer app class="text-center d-flex flex-column">
                <div class="mt-4">
                    <strong
                        >¡Bienvenido/a a nuestra página de
                        capacitaciones!</strong
                    >
                </div>

                <div class="pt-3 w-75">
                    Explora nuestra variedad de cursos y programas de
                    capacitación para potenciar tus habilidades y conocimientos.
                    Aprende de expertos en el campo y accede a materiales
                    didácticos de calidad. Disfruta de una plataforma de
                    aprendizaje en línea intuitiva y flexible. ¡Inicia tu viaje
                    hacia el éxito hoy mismo!
                </div>

                <v-divider class="my-4" color="red"></v-divider>

                <div>
                    {{ new Date().getFullYear() }} —
                    <strong>Lacti<span class="text-primary">Red</span></strong>
                </div>
            </v-footer>
        </v-main>
    </v-app>
</template>
<script setup>
import Logo from "@/components/Logo.vue";
import CardActividad from "./components/CardActividad.vue";
import { router } from "@inertiajs/vue3";

const props = defineProps({
    actividades: Array,
});
const icons = ["mdi-facebook", "mdi-twitter", "mdi-linkedin", "mdi-instagram"];
</script>
<style lang="scss">
.toolbar-app {
    .v-toolbar__content {
        z-index: 1;
    }
    &::after {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        background-color: rgba(15, 15, 15, 0.5);
        width: 100%;
        height: 100%;
    }
}
</style>
