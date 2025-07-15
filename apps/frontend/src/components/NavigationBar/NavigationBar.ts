import { defineComponent, ref, computed } from 'vue'


export default defineComponent({
    name: 'NavigationBar',
    data() {
        return {
            dropdown:{
                articles: false,
                orders: false,
                users: false,
                companies: false,
                admin: false
            }
        }
    },
    mounted() {
        console.log(this.$route.name);
    },
    methods: {
        toggleDropdown(dropdownName: string) {
            /* this.dropdown.forEach(element => {
                element = element ;
            }); */
            this.dropdown[dropdownName] = !this.dropdown[dropdownName];
        },
    },

});
