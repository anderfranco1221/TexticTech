import { defineComponent, ref, computed } from 'vue'
import { useRoute } from 'vue-router';
interface PermisosUsuario {
  articles: boolean;
  orders: boolean;
  users: boolean;
  companies: boolean;
  admin: boolean;
  // Puedes añadir más si es necesario
}

export default defineComponent({
    name: 'NavigationBar',
    data() {
        return {
            dropdown: {
                articles: false,
                orders: false,
                users: false,
                companies: false,
                admin: false
            } as PermisosUsuario,
            route: useRoute(),
        }
    },
    mounted() {
        console.log(this.route.name);
    },
    computed: {
        routeName() {
            return this.route.name;
        }
    },
    watch:{
        routeName(newRouteName) {
            // Cierra todos los dropdowns cuando la ruta cambia
            for (const key of Object.keys(this.dropdown) as Array<keyof PermisosUsuario>) {
                this.dropdown[key] = false;
            }
        }
    },
    methods: {
        toggleDropdown(dropdownName: keyof PermisosUsuario) {
            for (const key of Object.keys(this.dropdown) as Array<keyof PermisosUsuario>) {
                if (key !== dropdownName) {
                    this.dropdown[key] = false;
                }
            }
            //console.log(this.dropdown);

            this.dropdown[dropdownName] = !this.dropdown[dropdownName];
        },
    },

});
