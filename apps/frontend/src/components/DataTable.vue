<script setup lang="ts">
import type { TableColumn } from '@/models/common';

// Define las props utilizando la sintaxis de tipos directamente
interface Props {
    columns: TableColumn[];
    data: any[];
}

const props = defineProps<Props>();
</script>
<template>
    <table class="table-auto md:table-fixed w-3/4 bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden">
        <thead
            class="text-gray-600 dark:text-gray-200 border-b-2 border-gray-200 dark:border-gray-600 text-left font-medium">
            <tr>
                <th class="p-4 pl-8" v-for="col in columns" :key="col.key">
                    {{ col.label }}
                </th>
            </tr>
        </thead>
        <tbody class="border-b border-gray-100 dark:border-gray-700 dark:text-gray-400">
            <tr v-for="(row, rowIndex) in data" :key="rowIndex">
                <td class="p-4 pl-8" v-for="col in columns" :key="col.key + rowIndex">
                    <!-- Si tiene slot, lo usamos -->
                    <slot :name="col.key" :row="row">
                        <!-- Si no tiene slot, mostramos el valor directamente -->
                        {{ row[col.key] }}
                    </slot>
                </td>
            </tr>
        </tbody>
        <tfoot v-if="data.length === 0" class="text-center">
            <tr>
                <td :colspan="columns.length" class="p-4 text-gray-500 dark:text-gray-400">
                    No hay datos disponibles
                </td>
            </tr>
        </tfoot>
    </table>
</template>