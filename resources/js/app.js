import moment from "moment";

require("./bootstrap");

import Vue from "vue";
import VueIziToast from "vue-izitoast";
import Authorization from "./authorization/authorize";
import "izitoast/dist/css/iziToast.min.css";

Vue.use(VueIziToast);
Vue.use(Authorization);

window.Vue = require("vue");

Vue.filter("formatDate", function(value) {
    if (value) {
        return moment(String(value)).format("MMM DD, YYYY h:mm:ss");
    }
});

Vue.filter("two_digits", value => {
    if (value < 0) {
        return "00";
    }
    if (value.toString().length <= 1) {
        return `0${value}`;
    }
    return value;
});

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
