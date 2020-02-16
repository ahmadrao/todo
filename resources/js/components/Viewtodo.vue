<template id="todo">
    <div>
        <router-link v-bind:to="'/'" class="btn btn-outline-dark"
            ><span class="fa fa-arrow-left mr-1"></span>Back to todo list
        </router-link>
        <h3>{{ todo.title }}</h3>
        <h4>Descritpion :</h4>
        <br />
        <div>{{ todo.body }}</div>
        <br />
        <div id="root">
            <count-down :date="todo.end_date"></count-down>
        </div>
    </div>
</template>

<script>
import CountDown from "./CountDown.vue";

export default {
    components: { CountDown },
    data: function() {
        return {
            todo: { title: "", body: "", start_date: "", end_date: "" }
        };
    },
    created: function() {
        let uri = "/todo/" + this.$route.params.id;
        Axios.get(uri).then(response => {
            this.todo = response.data;
        });
    }
};
</script>
