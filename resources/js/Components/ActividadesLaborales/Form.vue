<script setup>
import { useForm } from "@inertiajs/vue3";
import { watch } from "vue";

const emit = defineEmits(["saved"]);

const props = defineProps({
    actividad: {
        type: Object,
        default: null,
    },
});

const form = useForm({
    descripcion: "",
    orden_adicional: 0,
});

watch(
    () => props.actividad,
    (actividad) => {
        form.descripcion = actividad?.descripcion ?? "";
        form.orden_adicional = actividad?.orden_adicional ?? 0;
    },
    { immediate: true }
);

const submit = () => {
    if (props.actividad && props.actividad.id) {
        form.transform((data) => ({
            ...data,
            _method: "put",
        })).post(`/tipos-actividades/${props.actividad.id}`, {
            onSuccess: () => {
                emit("saved");
                form.reset();
            },
            preserveScroll: true,
            onError: (err) => console.error("Error al actualizar:", err),
        });
    } else {
        form.post("/tipos-actividades", {
            onSuccess: () => {
                emit("saved");
                form.reset();
            },
            preserveScroll: true,
        });
    }
};
</script>

<template>
    <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
        <h3 class="text-lg font-bold mb-4 text-[#1e293b] border-b pb-2">
            {{ actividad ? "Editar Actividad" : "Nueva Actividad" }}
        </h3>

        <form @submit.prevent="submit" class="space-y-4">
            <div>
                <label
                    class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1"
                >
                    Descripción
                </label>
                <input
                    v-model="form.descripcion"
                    type="text"
                    class="w-full border-gray-200 rounded-lg bg-gray-50 text-sm focus:ring-[#00a78e] focus:border-[#00a78e]"
                    required
                />
            </div>

            <div>
                <label
                    class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1"
                >
                    Orden Adicional
                </label>
                <input
                    v-model="form.orden_adicional"
                    type="number"
                    class="w-full border-gray-200 rounded-lg bg-gray-50 text-sm focus:ring-[#00a78e] focus:border-[#00a78e]"
                />
                <p class="text-[10px] text-gray-400 mt-1 italic">
                    Define la prioridad de visualización.
                </p>
            </div>

            <button
                type="submit"
                :disabled="form.processing"
                class="w-full bg-[#00a78e] hover:bg-[#008f7a] text-white font-bold py-2.5 rounded-lg transition disabled:opacity-50 text-sm shadow-md"
            >
                {{ form.processing ? "Guardando..." : "Guardar Registro" }}
            </button>
        </form>
    </div>
</template>
