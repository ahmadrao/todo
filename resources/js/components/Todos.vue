<template>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card" v-if="adding">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h2>Add Todo</h2>
                        <div class="ml-auto">
                            <a
                                @click.prevent="adding = !adding"
                                class="btn btn-outline-secondary"
                                >Back to all Todos</a
                            >
                        </div>
                    </div>
                </div>
                <form class="card-body" @submit.prevent="create">
                    <div class="card-title">
                        <input
                            type="text"
                            class="form-control form-control-lg"
                            required
                            v-model="title"
                        />
                    </div>

                    <hr />

                    <div class="media">
                        <div class="media-body">
                            <div class="form-group">
                                <textarea
                                    rows="10"
                                    v-model="body"
                                    class="form-control"
                                    required
                                ></textarea>
                            </div>
                            <button
                                class="btn btn-primary"
                                :disabled="isInvalid"
                            >
                                Add Todo
                            </button>
                            <button
                                class="btn btn-outline-secondary"
                                @click="cancel"
                                type="button"
                            >
                                Cancel
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card" v-else>
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h2>All Todo</h2>
                        <div class="ml-auto">
                            <a
                                @click.prevent="add"
                                class="btn btn-outline-secondary"
                                >Add todo</a
                            >
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <!-- @include ('layouts._messages') -->
                    <div v-for="todo in todos">
                        <excerpt key="todo.id" :todo="todo"></excerpt>
                        <hr />
                    </div>

                    <div v-if="todos.length <= 0" class="alert alert-warning">
                        <strong>Sorry</strong> There are no todo available.
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import modification from "../mixins/modification";
import Excerpt from "./Excerpt.vue";

export default {
    props: ["todos"],

    mixins: [modification],

    components: { Excerpt },

    data() {
        return {
            title: "",
            body: "",
            bodyHtml: ""
        };
    },

    computed: {
        isInvalid() {
            return this.body.length < 10 || this.title.length < 5;
        },

        endpoint() {
            return `/todo`;
        }
    },

    methods: {
        setEditCache() {},
        restoreFromCache() {},

        payload() {
            return {
                body: this.body,
                title: this.title
            };
        }
    }
};
</script>
