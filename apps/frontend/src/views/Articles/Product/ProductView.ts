import { defineComponent } from 'vue';
import DataTable from "@/components/DataTable.vue";
import BaseModal from '@/components/BaseModal.vue';
import Paginator from '@/components/Paginator.vue';
import Loadding from '@/components/Loadding.vue';
import TitleView from '@/components/TitleView.vue';

export default defineComponent({
  name: "ProductView",
  components: {
    DataTable,
    BaseModal,
    Paginator,
    Loadding,
    TitleView
  },
  data() { },
});
