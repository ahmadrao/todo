/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");

import Vue from "vue";
import VueIziToast from "vue-izitoast";
import Authorization from "./authorization/authorize";
import "izitoast/dist/css/iziToast.min.css";

Vue.use(VueIziToast);
Vue.use(Authorization);

window.Vue = require("vue");

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component("todo-page", require("./pages/TodoPage.vue").default);
// Vue.component("todos-page", require("./pages/TodosPage.vue").default);

window.VueRouter = require("vue-router").default;

window.VueAxios = require("vue-axios").default;

window.Axios = require("axios").default;

let AppLayout = require("./components/App.vue").default;

// show the list todo template
const Listtodos = Vue.component(
    "Listtodos",
    require("./components/Listtodos.vue").default
);

// add todo template
const Addtodo = Vue.component(
    "Addtodo",
    require("./components/Addtodo.vue").default
);

// edite todo template
const Edittodo = Vue.component(
    "Edittodo",
    require("./components/Edittodo.vue").default
);

// delete todo template
const Deletetodo = Vue.component(
    "Deletetodo",
    require("./components/Deletetodo.vue").default
);

// view single todo template
const Viewtodo = Vue.component(
    "Viewtodo",
    require("./components/Viewtodo.vue").default
);

// registering Modules
Vue.use(VueRouter, VueAxios, axios);

const routes = [
    {
        name: "Listtodos",
        path: "/",
        component: Listtodos
    },
    {
        name: "Addtodo",
        path: "/add-todo",
        component: Addtodo
    },
    {
        name: "Edittodo",
        path: "/edit/:id",
        component: Edittodo
    },
    {
        name: "Deletetodo",
        path: "/todo-delete",
        component: Deletetodo
    },
    {
        name: "Viewtodo",
        path: "/view/:id",
        component: Viewtodo
    }
];

const router = new VueRouter({ mode: "history", routes: routes });

new Vue(Vue.util.extend({ router }, AppLayout)).$mount("#app");

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// const app = new Vue({
//     el: "#app",
//     router
// });
