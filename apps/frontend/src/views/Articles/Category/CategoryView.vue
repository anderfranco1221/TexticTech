<script src="./CategoryView.ts" lang="ts" />
<!-- <script src="./CategoryView.ts" lang="ts"/> -->
<template>
    <hgroup class="dark:text-white font-bold text-4xl mt-4! mb-8!">
        <h1 class="pl-6 ml-15!">
            Categoria

        </h1>
        <div
            class="mt-5! ml-10! h-1 mx-auto bg-gradient-to-l  md:from-35% sm:from-80% via-95%  via-blue-900 dark:via-cyan-600">
        </div>
    </hgroup>

    <section class="flex flex-col items-center justify-center">
        <DataTable :columns="columns" :data="categories" v-show="!loadding">
            <template #acciones="{ row }">
                <div class="flex gap-2">
                    <button @click="openAddModal(row)"
                        class="bg-blue-500 hover:bg-blue-600 text-white px-2 py-1 rounded">
                        Editar
                    </button>
                    <button @click="console.log(row)" class="bg-red-500 hover:bg-red-600 text-white px-2 py-1 rounded">
                        Eliminar
                    </button>
                </div>
            </template>
        </DataTable>
    </section>

    <BaseModal v-model="showCategoryModal" :title="category.id ? 'Editar Categoría' : 'Nueva Categoría'"
        withClass="sm:max-w-lg" @confirm="saveCategory" @close="closeCategoryModal">
        <form @submit.prevent="saveCategory" class="space-y-4">
            <div class="flex flex-col sm:flex-row sm:items-center gap-2">
                <label for="categoryName" class="w-40">Nombre:</label>
                <input type="text" id="categoryName" v-model="category.nombre" required class="block rounded-md bg-white px-3 py-1.5 text-gray-900 -outline-offset-1 outline-gray-300 focus:outline-2  focus:outline-blue-500 sm:text-sm/6 w-max sm:w-96"/>
            </div>
            <div class="flex flex-col sm:flex-row sm:items-center gap-2 mt-3!">
                <label for="categoryDescription" class="w-40">Descripción:</label>
                <div class="mt-2! w-max sm:w-96">
                    <textarea id="categoryDescription" name="categoryDescription" v-model="category.descripcion" rows="4" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-blue-500 sm:text-sm/6"></textarea>
                </div>
            </div>
        </form>

    </BaseModal>


</template>