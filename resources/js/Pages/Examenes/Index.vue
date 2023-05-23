<template>
    <AdminLayout>
        <HeadingPage title="Examenes" subtitle="Lista de examenes">
            <template #actions>
                <Link href="/admin/examenes/create" class="me-4">
                    <v-btn prepend-icon="mdi-plus" variant="flat">
                        Nuevo
                    </v-btn>
                </Link>
            </template>
        </HeadingPage>
        <v-container>
            {{ examenes }}
        </v-container>
    </AdminLayout>
</template>
<script setup>
import { Link } from "@inertiajs/vue3";
import AdminLayout from "@/layouts/AdminLayout.vue";
import HeadingPage from "@/components/HeadingPage.vue";
const props = defineProps({
    examenes: Array,
})
</script>
