import { defineComponent } from 'vue';
import DataTable from "@/components/DataTable.vue";
import { categoryService } from '@/services/categoryService';
import BaseModal from '@/components/BaseModal.vue';
import type { CategoryView } from '@/models/Categories';
import type {TableColumn, PaginationModel} from '@/models/common';

export default defineComponent({
    name: "CategoryView",
    components: {
        DataTable,
        BaseModal
    },
    data() {
        return {
            columns: [
                { key: 'id', label: 'ID' },
                { key: 'nombre', label: 'Nombre' },
                { key: 'descripcion', label: 'Descripcion' },
                { key: 'acciones', label: 'Acciones' }
            ] as TableColumn[],
            categories: [] as CategoryView[],
            category: {} as CategoryView,
            pagination: {} as PaginationModel,
            loadding: false,
            showCategoryModal: false,
        };
    },
    mounted() {
        this.getCategories()
        
        //TODO: Crear el componente de paginación y añadirlo aquí
        //TODO: Loadding en el componente DataTable
        //TODO: Modificar registros
        //TODO: Añadirlos ""
        //TODO: Editarlos ""
    },
    methods: {
        /**Consulta los registros de las categorias */
        async getCategories() {
            this.loadding = true;
            try {
                const data = await categoryService.getCategories();
                
                this.categories = data.data.map((category:any) => ({
                    id: category.id,
                    nombre: category.attributes.nombre,
                    descripcion: category.attributes.descripcion,
                    useLink: category.links.self ? category.links.self : null
                }));

                this.pagination = data.meta;
                console.log(this.pagination);
                
            } catch (error: any) {
                //this.error = `No se pudieron cargar las categorías: ${err.message || 'Error desconocido'}`;
                console.log('Error al cargar las categorías:', error);
            }
            this.loadding = false;
        },
        openAddModal(category: CategoryView) {
            //this.isEditing = false;
            this.category = category;
            this.showCategoryModal = true;
        },
        closeCategoryModal() {
            this.showCategoryModal = false;
            this.category = {} as CategoryView;
        },
        saveCategory() {
            if (!this.category.nombre || !this.category.descripcion) {
                console.error('Nombre y descripción son obligatorios');
                return;
            }

            let response;
            if(this.category.id) {
                response = categoryService.updateCategory(this.category.id, this.category);
            }

            if(!this.category.id){
                response = categoryService.createCategory(this.category);
            }

            response.then(() => {
                this.getCategories();
                this.closeCategoryModal();
            }).catch((error: any) => {
                console.error('Error al guardar la categoría:', error);
            });
        }

    }
});