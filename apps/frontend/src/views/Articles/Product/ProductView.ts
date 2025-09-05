import { defineComponent } from 'vue';
import DataTable from "@/components/DataTable.vue";
import BaseModal from '@/components/BaseModal.vue';
import Paginator from '@/components/Paginator.vue';
import Loadding from '@/components/Loadding.vue';
import TitleView from '@/components/TitleView.vue';
import type { TableColumn, PaginationModel } from '@/models/common';

export default defineComponent({
  name: "ProductView",
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
        { key: 'precio', label: 'Precio' },
        { key: 'categoria', label: 'Categoría' },
        { key: 'acciones', label: 'Acciones' }
      ] as TableColumn[],
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
    }
  },
});
