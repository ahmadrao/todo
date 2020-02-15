<template id="todo-list">
    <div class="row">
        <div class="pull-right">
            <router-link
                class="btn btn-xs btn-outline-primary mb-2"
                v-bind:to="{ path: '/add-todo' }"
            >
                <span class="fa fa-plus"></span>
                Add new Todo
            </router-link>
        </div>
        <table class="table" v-if="todos.length">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Todo Title</th>
                    <th>Todo Descritpion</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(todo, index) in filteredTodos" :key="todo.id">
                    <td>{{ index + 1 }}</td>
                    <td>{{ todo.title }}</td>
                    <td>{{ todo.body }}</td>
                    <td>{{ todo.start_date }}</td>
                    <td>{{ todo.end_date }}</td>
                    <td>
                        <router-link
                            class="btn btn-outline-info btn-sm"
                            v-bind:to="{
                                name: 'Viewtodo',
                                params: { id: todo.id }
                            }"
                        >
                            <i class="fa fa-eye" aria-hidden="true"></i>
                            Show
                        </router-link>
                        <router-link
                            v-if="authorize('modify', todo)"
                            class="btn btn-outline-warning btn-sm"
                            v-bind:to="{
                                name: 'Edittodo',
                                params: { id: todo.id }
                            }"
                        >
                            <i class="fa fa-pencil" aria-hidden="true"></i>
                            Edit
                        </router-link>
                        <button
                            v-if="authorize('deleteTodo', todo)"
                            @click="destroy(index)"
                            class="btn btn-sm btn-outline-danger"
                        >
                            <i class="fa fa-trash-o" aria-hidden="true"></i>
                            Delete
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="alert alert-warning ml-5" v-else>
            <strong>Sorry</strong> There are no todo available.
        </div>
    </div>
</template>

<script>
export default {
    data: function() {
        return { todos: "" };
    },
    created: function() {
        let uri = "/todo";
        Axios.get(uri).then(response => {
            this.todos = response.data;
        });
    },
    computed: {
        filteredTodos() {
            if (this.todos.length) {
                return this.todos;
            } else {
            }
        }
    },

    methods: {
        delete(index) {
            Axios.delete("/todo/" + this.todos[index].id).then(response => {
                this.$toast.success(response.data.message, "Success", {
                    timeout: 2000
                });
                this.todos.splice(index, 1);
                // this.$router.push({ name: "Listtodos" });

                // this.$router.$forceUpdate();
            });
        },

        destroy(index) {
            this.$toast.question("Are you sure about that?", "Confirm", {
                timeout: 20000,
                close: false,
                overlay: true,
                displayMode: "once",
                id: "question",
                zindex: 999,
                title: "Hey",
                position: "center",
                buttons: [
                    [
                        "<button><b>YES</b></button>",
                        (instance, toast) => {
                            this.delete(index);

                            instance.hide(
                                { transitionOut: "fadeOut" },
                                toast,
                                "button"
                            );
                        },
                        true
                    ],
                    [
                        "<button>NO</button>",
                        function(instance, toast) {
                            instance.hide(
                                { transitionOut: "fadeOut" },
                                toast,
                                "button"
                            );
                        }
                    ]
                ]
            });
        }
    }
};
</script>
