import { createApp } from 'vue';

const app = createApp({
    data() {
        return {
            password: '',
            isPasswordVisible: false
        };
    },
    computed: {
        passwordFieldType() {
            return this.isPasswordVisible ? 'text' : 'password';
        },
        passwordIcon() {
            return this.isPasswordVisible ? 'bi bi-eye-slash' : 'bi bi-eye';
        }
    },
    methods: {
        togglePasswordVisibility() {
            this.isPasswordVisible = !this.isPasswordVisible;
        }
    }
});

// Mount ke elemen dengan ID #app
app.mount('#app');
