<template>
    <slot name="activator" :dialog="() => (dialog = !dialog)"></slot>
    <v-dialog v-model="dialog" :width="width">
        <v-card :title="title">
            <v-container>
                <slot name="content" :dialog="() => (dialog = !dialog)"> </slot>
            </v-container>
        </v-card>
    </v-dialog>
</template>

<script setup>
import { ref } from "vue";

const props = defineProps({
    title: {
        type: String,
        default: "Nuevo usuario",
    },
    width:  {
        type: String,
        default: "70vw",
    },
});

const dialog = ref(false);
</script>
