require('./bootstrap');

window.Vue = require('vue');

Vue.component('repliesList', require('./components/Replies.vue'));
Vue.component('message', require('./components/Message.vue'));
Vue.component('favorite', require('./components/Favorite.vue'));

const app = new Vue({
    el: '#app',
});