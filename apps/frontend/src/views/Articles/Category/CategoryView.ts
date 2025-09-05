import { defineComponent } from 'vue';
import DataTable from "@/components/DataTable.vue";
import { categoryService } from '@/services/categoryService';
import BaseModal from '@/components/BaseModal.vue';
import Paginator from '@/components/Paginator.vue';
import Loadding from '@/components/Loadding.vue';
import TitleView from '@/components/TitleView.vue';
import type { CategoryView } from '@/models/Categories';
import type {TableColumn, PaginationModel} from '@/models/common';

export default defineComponent({
    name: "CategoryView",
    components: {
        DataTable,
        BaseModal,
        Paginator,
        Loadding,
        TitleView
    },
    data() {
        return {
            columns: [
                { key: 'id', label: 'ID' },
                { key: 'nombre', label: 'Nombre' },
                { key: 'descripcion', label: 'Descripcion', withMax: 'w-1/3' },
                { key: 'acciones', label: 'Acciones' }
            ] as TableColumn[],
            categories: [] as CategoryView[],
            category: {} as CategoryView,
            pagination: {
                current_page: 1,
                from: 0,
                last_page: 0,
                links: [],
                path: "",
                per_page: 10,
                to: 0,
                total: 0
            } as PaginationModel,
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
                const data = await categoryService.getCategories(this.pagination.per_page, this.pagination.current_page);

                this.categories = data.data.map((category:any) => ({
                    id: category.id,
                    nombre: category.attributes.nombre,
                    descripcion: category.attributes.descripcion,
                    useLink: category.links.self ? category.links.self : null
                }));

                this.pagination = data.meta;
                // console.log(this.pagination);

            } catch (error: any) {
                //this.error = `No se pudieron cargar las categorías: ${err.message || 'Error desconocido'}`;
                console.log('Error al cargar las categorías:', error);
            }
            this.loadding = false;
        },

        openAddModal(category?: CategoryView) {
            //this.isEditing = false;
            if (category) {
                this.category = category;
            }

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

            const response = this.category.id
                ? categoryService.updateCategory(this.category.id, this.category)
                : categoryService.createCategory(this.category);

            response.then(() => {
                if (!this.category.id) this.getCategories();
                this.closeCategoryModal();
            }).catch((error: any) => {
                console.error('Error al guardar la categoría:', error);
            });
        }

    }
});
