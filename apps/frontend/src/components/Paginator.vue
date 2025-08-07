<template>
    <nav aria-label="Navegación de página">
        <div class="flex items-center justify-between border-t border-gray-400 px-4 py-3 sm:px-6">
            <div class="flex flex-1 justify-between sm:hidden">
                <button 
                    class="relative inline-flex items-center rounded-md bg-muted border-2 border-solid px-4 py-2 text-sm font-medium text-gray-700 dark:text-white hover:bg-gray-50 cursor-pointer"
                    :class="{ 'opacity-50 cursor-not-allowed': currentPage === 1 }"
                    :disabled="currentPage === 1"
                    @click.prevent="changePage(currentPage - 1)"
                >
                    Anterior
                </button>

                <span class="text-sm text-gray-700 dark:text-white flex items-center">
                    Página {{ currentPage }} de {{ totalPages }}
                </span>

                <button 
                    class="relative inline-flex items-center rounded-md bg-muted border-2 border-solid px-4 py-2 text-sm font-medium text-gray-700 dark:text-white hover:bg-gray-50 cursor-pointer"
                    :class="{ 'opacity-50 cursor-not-allowed': currentPage === totalPages }"
                    :disabled="currentPage === totalPages"
                    @click.prevent="changePage(currentPage + 1)"
                >
                    Siguiente
                </button>
                <!-- <a href="#"
                    class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Next</a> -->
            </div>


            <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
                <div class="text-sm text-gray-700 dark:text-white flex-1">
                    <span class="flex items-center">
                        Página {{ currentPage }} de {{ totalPages }}
                    </span>
                    <span class="flex items-center">
                        Total de resultados: <span class="font-medium">{{ totalItems }}</span>
                    </span>
                </div>
                <div>
                    <nav aria-label="Pagination" class="isolate inline-flex -space-x-px rounded-md shadow-xs">
                        <button class="relative inline-flex items-center rounded-l-md px-2 py-2 text-gray-400 inset-ring inset-ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0 cursor-pointer"
                            :class="{ 'opacity-50 cursor-not-allowed': currentPage === 1 }"
                            :disabled="currentPage === 1"
                            @click.prevent="changePage(currentPage - 1)">
                            <span class="sr-only">Anterior</span>
                            <svg viewBox="0 0 20 20" fill="currentColor" data-slot="icon" aria-hidden="true"
                                class="size-5">
                                <path
                                    d="M11.78 5.22a.75.75 0 0 1 0 1.06L8.06 10l3.72 3.72a.75.75 0 1 1-1.06 1.06l-4.25-4.25a.75.75 0 0 1 0-1.06l4.25-4.25a.75.75 0 0 1 1.06 0Z"
                                    clip-rule="evenodd" fill-rule="evenodd" />
                            </svg>
                        </button>

                        <button 
                            v-for="page in totalPages" :key="page"
                            @click.prevent="changePage(page)"
                            :aria-current="page === currentPage ? 'page' : 'false'"
                            class="cursor-pointer relative inline-flex items-center 
                            px-4 py-2 text-sm font-semibold text-gray-900 dark:text-white inset-ring 
                            inset-ring-gray-300 hover:bg-muted focus:z-20"
                            :class=" page === currentPage ? 'bg-secondary z-10 focus-visible:outline-2 focus-visible:outline-offset-2' : ''"
                            >
                            {{ page }}
                        </button>


                        <button class="cursor-pointer relative inline-flex items-center rounded-r-md px-2 py-2 text-gray-400 inset-ring inset-ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0"
                            :class="{ 'opacity-50 cursor-not-allowed': currentPage === totalPages }"
                            :disabled="currentPage === totalPages"
                            @click.prevent="changePage(currentPage + 1)">
                            <span class="sr-only">Siguiente</span>
                            <svg viewBox="0 0 20 20" fill="currentColor" data-slot="icon" aria-hidden="true"
                                class="size-5">
                                <path
                                    d="M8.22 5.22a.75.75 0 0 1 1.06 0l4.25 4.25a.75.75 0 0 1 0 1.06l-4.25 4.25a.75.75 0 0 1-1.06-1.06L11.94 10 8.22 6.28a.75.75 0 0 1 0-1.06Z"
                                    clip-rule="evenodd" fill-rule="evenodd" />
                            </svg>
                        </button>

                    </nav>
                </div>
            </div>
        </div>
    </nav>
</template>

<script lang="ts">
import { defineComponent, computed } from 'vue';

export default defineComponent({
    name: 'Paginator',
    props: {
        totalItems: {
            type: Number,
            required: true,
        },
        itemsPerPage: {
            type: Number,
            required: true,
        },
        currentPage: {
            type: Number,
            required: true,
        },
    },
    emits: ['update:currentPage'],
    setup(props, { emit }) {
        // Calcula el número total de páginas
        const totalPages = computed(() => {
            return Math.ceil(props.totalItems / props.itemsPerPage);
        });

        // Función para cambiar de página
        const changePage = (page: number) => {
            // Solo emite el evento si la página está dentro de un rango válido
            if (page >= 1 && page <= totalPages.value) {
                emit('update:currentPage', page);
            }
        };

        return {
            totalPages,
            changePage,
        };
    },
});
</script>
