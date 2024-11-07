import './bootstrap';

import Alpine from 'alpinejs';
import Vue from 'vue';
import EditProfile from './components/EditProfile.vue';

window.Alpine = Alpine;
Alpine.start();

Vue.component('edit-profile', EditProfile);
const app = new Vue({
    el: '#app',
});

