import { defineComponent, ref, computed } from "vue";
import "./LogginView.css";

export default defineComponent({
    name: "LogginView",
    /* data() {
        return {
            email: "",
            password: "",
        }
    },
    mounted() {
        console.log("LogginView mounted");
    },
    methods: {
        handleSubmit() {
            console.log(this.email);
            
        
        },
    } */
        
    setup() {
        const email = ref("");
        const password = ref("");
        const isFormValid = computed(() => {
            return email.value.trim() !== "" && password.value.trim() !== "";
        });

        const handleSubmit = () => {
            
            if (isFormValid.value) {
                console.log("Form submitted with:", { email: email.value, password: password.value });
                // Add your login logic here
            } else {
                console.error("Form is invalid");
            }
        };

        return {
            email,
            password,
            isFormValid,
            handleSubmit,
        };
    },
});