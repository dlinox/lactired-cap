<template>
    <v-list v-model:opened="menu" nav density="compact">
        <v-list-subheader>Menu</v-list-subheader>
        <v-list-item
            prepend-icon="mdi-home"
            title="Home"
            color="primary"
            :class="
                router.page.url == '/' ? 'v-list-item--active text-primary' : ''
            "
             @click="router.get('/')"
        />

        <v-list-group value="admin">
            <template v-slot:activator="{ props }">
                <v-list-item
                    class="my-1"
                    v-bind="props"
                    prepend-icon="mdi-content-paste                                     "
                    title="Capacitaciones"
                    color="primary"
                ></v-list-item>
            </template>
            <v-list-item
                v-for="(item, index) in menuCapacitacion"
                :key="index"
                class="hola my-1"
                :title="item.title"
                :value="item.value"
                color="primary"
                @click="goToPage(item.to)"
                :class="
                    item.to == router.page.url
                        ? 'v-list-item--active text-primary'
                        : ''
                "
            >
                <template #prepend>
                    <v-icon class="mr-2" size="x-large"
                        >mdi-circle-small
                    </v-icon>
                </template>
            </v-list-item>
        </v-list-group>

        <v-list-group value="admin">
            <template v-slot:activator="{ props }">
                <v-list-item
                    v-bind="props"
                    prepend-icon="mdi-cog"
                    title="Administrar"
                    color="primary"
                ></v-list-item>
            </template>
            <v-list-item
                v-for="(item, index) in menuAdministrar"
                :key="index"
                :title="item.title"
                :value="item.value"
                color="primary"
                class="my-1"
                :class="
                    item.to == router.page.url
                        ? 'v-list-item--active text-primary'
                        : ''
                "
                @click="goToPage(item.to)"
            >
                <template #prepend>
                    <v-icon class="mr-2" size="x-large"
                        >mdi-circle-small
                    </v-icon>
                </template>
            </v-list-item>
        </v-list-group>
    </v-list>
</template>

<script setup>
import { ref } from "vue";
import { router } from "@inertiajs/vue3";

const menuCapacitacion = ref([
    {
        title: "Actividades",
        value: "actividades",
        icon: null,
        to: "/admin/actividades",
    },
    {
        title: "Examenes",
        value: "examenes",
        icon: null,
        to: "/admin/examenes",
    },
]);
const menuAdministrar = ref([
    {
        title: "Usuarios",
        value: "admin.usuarios",
        icon: null,
        to: "/admin/usuarios",
    },
    {
        title: "Areas",
        value: "admin.areas",
        icon: null,
        to: "/admin/areas",
    },
    {
        title: "Tipo",
        value: "admin.tipos",
        icon: null,
        to: "/admin/tipos",
    },

    // {
    //     title: "Recursos",
    //     value: "admin.recursos",
    //     icon: null,
    //     to: "/admin/recursos",
    // },
    {
        title: "Instructores",
        value: "admin.instructores",
        icon: null,
        to: "/admin/instructores",
    },
]);

//const currentMenu = computed(() => router.page.url.split('/')[1] );
const goToPage = (to) => {
    router.get(to);
};

const menu = ref([router.page.url.split("/")[1]]);
</script>

<style scoped>
.v-list-group__items .v-list-item {
    padding-inline-start: 25px !important;
}
</style>
