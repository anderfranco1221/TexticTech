<script setup lang="ts">
import DataTable from "@/components/DataTable.vue";

</script>
<template>
    <hgroup class="dark:text-white font-bold text-4xl mt-4! mb-8!">
        <h1 class="pl-6 ml-15!">
            Categoria
            
        </h1>
        <div class="mt-5! ml-10! h-1 mx-auto bg-gradient-to-l  md:from-35% sm:from-80% via-95%  via-blue-900 dark:via-cyan-600"></div>
    </hgroup>

    <section class="flex flex-col items-center justify-center">  
        <DataTable
            :columns="[
                { key: 'id', label: 'ID' },
                { key: 'nombre', label: 'Nombre' },
                { key: 'descripcion', label: 'Descripcion' },
                { key: 'acciones', label: 'Acciones' }
            ]"
            :data="[
                { id: 1, nombre: 'Tela', descripcion: 'Telares', acciones: 'Botones' }
            ]"
        >
          <template #acciones="{ row }">
            <button @click="console.log(row)" class="bg-blue-500 hover:bg-blue-600 text-white px-2 py-1 rounded">
              Editar
            </button>
          </template>
        </DataTable>
    </section>
    
</template>