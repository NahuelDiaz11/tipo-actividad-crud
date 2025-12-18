<script setup>
import { ref, computed, watch } from "vue";
import ActividadTable from "@/Components/ActividadesLaborales/Table.vue";
import ActividadForm from "@/Components/ActividadesLaborales/Form.vue";
import { usePage } from "@inertiajs/vue3";

const page = usePage();

const props = defineProps({
    actividades: {
        type: Array,
        default: () => [],
    },
});

const mostrandoFormulario = ref(false);
const actividadEditando = ref(null);

const editarActividad = (actividad) => {
    actividadEditando.value = actividad;
    mostrandoFormulario.value = true;
};

const nuevaActividad = () => {
    actividadEditando.value = null;
    mostrandoFormulario.value = !mostrandoFormulario.value;
};

const successMessage = computed(() => page.props.flash?.success);

const errorMessage = computed(() => {
    return page.props.errors?.descripcion;
});

const showMessage = ref(false);

watch([successMessage, errorMessage], ([success, error]) => {
    if (success || error) {
        showMessage.value = true;

        setTimeout(() => {
            showMessage.value = false;
        }, 5000);
    }
});
</script>

<template>
    <div class="flex min-h-screen bg-[#f8fafc]">
        <aside class="w-64 bg-white border-r hidden md:block flex-shrink-0">
            <div class="p-6 flex items-center gap-3">
                <div class="bg-[#00a78e] p-1.5 rounded-lg shadow-sm">
                    <svg
                        class="w-6 h-6 text-white"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"
                        />
                    </svg>
                </div>
                <span class="text-[#1e293b] font-bold text-lg"
                    >CM Gestiones</span
                >
            </div>
            <nav class="mt-4 px-4 space-y-1">
                <div
                    class="text-gray-400 p-2 text-[10px] font-bold uppercase tracking-widest"
                >
                    Menú
                </div>
                <div
                    class="text-[#00a78e] bg-[#f0fdfa] p-2.5 rounded-xl font-semibold text-sm flex items-center gap-3 cursor-pointer"
                >
                    <span
                        class="w-2 h-2 bg-[#00a78e] rounded-full animate-pulse"
                    ></span>
                    Tipos de Actividad
                </div>
            </nav>
        </aside>

        <div class="flex-1 flex flex-col min-w-0">
            <header
                class="h-16 bg-white border-b flex items-center justify-between px-8 shrink-0"
            >
                <button class="text-gray-400 hover:text-gray-600">
                    <svg
                        class="w-5 h-5"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M11 19l-7-7 7-7"
                        />
                    </svg>
                </button>
                <div class="flex items-center gap-6">
                    <button class="text-gray-400 hover:text-[#00a78e]">
                        <svg
                            class="w-5 h-5"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"
                            />
                        </svg>
                    </button>
                    <div class="flex items-center gap-3 pl-6 border-l h-8">
                        <div class="text-right hidden sm:block">
                            <p
                                class="text-sm font-bold text-gray-800 leading-none"
                            >
                                CM
                            </p>
                            <p
                                class="text-[10px] text-gray-500 font-medium mt-1 uppercase"
                            >
                                Admin CM Gestion
                            </p>
                        </div>
                        <div
                            class="w-9 h-9 bg-[#e2e8f0] rounded-full flex items-center justify-center text-[#64748b] font-bold text-xs border-2 border-white shadow-sm"
                        >
                            C
                        </div>
                    </div>
                </div>
            </header>

            <main
                class="p-8 w-full max-w-[1600px] mx-auto flex-1 overflow-y-auto"
            >
                <div
                    v-if="showMessage && errorMessage"
                    class="mb-6 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700 font-semibold shadow-sm transition-all"
                >
                    {{ errorMessage }}
                </div>
                <div
                    v-if="showMessage && successMessage"
                    class="mb-6 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700 font-semibold shadow-sm transition-all"
                >
                    {{ successMessage }}
                </div>
                <div class="flex justify-between items-start mb-8">
                    <div>
                        <h1 class="text-2xl font-extrabold text-[#1e293b]">
                            Tipos de Actividades
                        </h1>
                        <p class="text-sm text-gray-500 mt-1 italic">
                            Gestión de tipos de actividad y orden jerárquico.
                        </p>
                    </div>
                    <button
                        @click="mostrandoFormulario = !mostrandoFormulario"
                        class="bg-[#00a78e] hover:bg-[#008f7a] text-white px-5 py-2.5 rounded-lg text-sm font-bold flex items-center gap-2 transition shadow-md active:scale-95"
                    >
                        <span class="text-lg leading-none">{{
                            mostrandoFormulario ? "×" : "+"
                        }}</span>
                        {{
                            mostrandoFormulario
                                ? "Cerrar"
                                : "Nuevo tipo de Actividad"
                        }}
                    </button>
                </div>

                <div
                    class="bg-white p-4 rounded-xl border border-gray-100 shadow-sm mb-8 flex gap-4 w-full"
                >
                    <div class="flex-1 relative">
                        <span
                            class="absolute inset-y-0 left-3 flex items-center text-gray-400"
                        >
                            <svg
                                class="w-4 h-4"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
                                />
                            </svg>
                        </span>
                        <input
                            type="text"
                            placeholder="Buscar actividad..."
                            class="w-full pl-10 pr-4 py-2.5 bg-gray-50 border-transparent rounded-lg text-sm focus:ring-1 focus:ring-[#00a78e] focus:bg-white transition-all"
                        />
                    </div>
                    <div class="w-64">
                        <select
                            class="w-full py-2.5 bg-gray-50 border-transparent rounded-lg text-sm text-gray-500 px-4 focus:ring-1 focus:ring-[#00a78e]"
                        >
                            <option>Todas las categorías</option>
                        </select>
                    </div>
                </div>
                <div class="grid grid-cols-1 w-full">
                    <ActividadForm
                        v-if="mostrandoFormulario"
                        :actividad="actividadEditando"
                        @saved="
                            () => {
                                mostrandoFormulario = false;
                                actividadEditando = null;
                            }
                        "
                    />

                    <ActividadTable
                        v-else
                        :actividades="actividades"
                        @editar="editarActividad"
                    />
                </div>
            </main>
        </div>
    </div>
</template>
