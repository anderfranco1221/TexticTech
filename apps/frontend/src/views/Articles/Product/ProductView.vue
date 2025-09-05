<script src="./ProductView.ts" lang="ts" />
<template>
  <TitleView>
    Productos
  </TitleView>

  <section class="flex flex-col items-center justify-center">
    <Loadding v-show="loadding" />
    <DataTable :columns="columns" :data="[]" v-show="!loadding">
      <template >
        <div class="flex gap-2">
          <button  class="bg-blue-500 hover:bg-blue-600 text-white px-2 py-1 rounded">
            Editar
          </button>
          <button  class="bg-red-500 hover:bg-red-600 text-white px-2 py-1 rounded">
            Eliminar
          </button>
        </div>
      </template>
    </DataTable>
    <div class="lg:w-5/6 sm:w-full" v-if="!loadding">
      <Paginator v-if="pagination.total > 0" v-model:currentPage="pagination.current_page"
        :total-items="pagination.total" :items-per-page="pagination.per_page" />
    </div>
  </section>
</template>
