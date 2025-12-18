<script setup>
import { router } from "@inertiajs/vue3";

const emit = defineEmits(["editar"]);

const props = defineProps({
    actividades: {
        type: Array,
        default: () => [],
    },
});

const eliminar = (id) => {
    if (confirm("¿Está seguro de eliminar esta actividad?")) {
        router.post(
            `/tipos-actividades/${id}`,
            {
                _method: "delete",
            },
            {
                preserveScroll: true,
                onSuccess: () => {
                },
                onError: (errors) => {
                    console.error("Error al eliminar:", errors);
                },
            }
        );
    }
};
</script>

<template>
    <div
        class="bg-white border border-gray-100 rounded-xl shadow-sm overflow-hidden w-full"
    >
        <table class="w-full text-left text-sm border-collapse">
            <thead class="bg-gray-50/80 border-b border-gray-100">
                <tr>
                    <th
                        class="px-6 py-4 text-[11px] font-bold text-gray-400 uppercase tracking-wider"
                    >
                        Descripción
                    </th>
                    <th
                        class="px-6 py-4 text-[11px] font-bold text-gray-400 uppercase tracking-wider text-center"
                    >
                        Orden
                    </th>
                    <th
                        class="px-6 py-4 text-[11px] font-bold text-gray-400 uppercase tracking-wider text-right"
                    >
                        Acciones
                    </th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-50">
                <tr
                    v-for="actividad in actividades"
                    :key="actividad.id"
                    class="hover:bg-gray-50/50 transition-colors"
                >
                    <td class="px-6 py-4">
                        <span class="font-medium text-gray-700 text-sm italic">
                            {{ actividad.descripcion }}
                        </span>
                    </td>

                    <td class="px-6 py-4 text-center">
                        <span
                            class="px-2.5 py-1 bg-blue-50 text-blue-600 rounded-md text-[10px] font-bold"
                        >
                            {{ actividad.orden_adicional || 0 }}
                        </span>
                    </td>

                    <td class="px-6 py-4 text-right">
                        <div class="flex justify-end gap-3">
                            <button
                                @click="emit('editar', actividad)"
                                class="text-gray-400 hover:text-blue-500 font-semibold text-xs"
                            >
                                Editar
                            </button>

                            <button
                                @click="eliminar(actividad.id)"
                                class="text-gray-400 hover:text-red-500 font-semibold text-xs"
                            >
                                Borrar
                            </button>
                        </div>
                    </td>
                </tr>

                <tr v-if="actividades.length === 0">
                    <td
                        colspan="3"
                        class="px-6 py-32 text-center text-gray-400 italic"
                    >
                        No se encontraron registros
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
