<template>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <form class="card-body" v-if="editing" @submit.prevent="update">
                    <div class="card-title">
                        <input
                            type="text"
                            class="form-control form-control-lg"
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
                                Update
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
                <div class="card-body" v-else>
                    <div class="card-title">
                        <div class="d-flex align-items-center">
                            <h1>{{ title }}</h1>
                            <div class="ml-auto">
                                <a
                                    href="/home"
                                    class="btn btn-outline-secondary"
                                    >Back to all Todos</a
                                >
                            </div>
                        </div>
                    </div>

                    <hr />

                    <div class="media">
                        <div class="media-body">
                            <div v-html="bodyHtml"></div>
                            <div class="row">
                                <div class="col-4">
                                    <div class="ml-auto">
                                        <a
                                            v-if="authorize('modify', todo)"
                                            @click.prevent="edit"
                                            class="btn btn-sm btn-outline-info"
                                            >Edit</a
                                        >
                                        <button
                                            v-if="authorize('deleteTodo', todo)"
                                            @click="destroy"
                                            class="btn btn-sm btn-outline-danger"
                                        >
                                            Delete
                                        </button>
                                    </div>
                                </div>
                                <div class="col-4"></div>
                                <div class="col-4"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import modification from "../mixins/modification";

import UserInfo from "./UserInfo.vue";

export default {
    props: ["todo"],

    mixins: [modification],

    components: { UserInfo },

    data() {
        return {
            title: this.todo.title,
            body: this.todo.body,
            bodyHtml: this.todo.body_html,
            id: this.todo.id,
            beforeEditCache: {}
        };
    },

    computed: {
        isInvalid() {
            return this.body.length < 10 || this.title.length < 10;
        },

        endpoint() {
            return `/todo/${this.id}`;
        }
    },

    methods: {
        setEditCache() {
            this.beforeEditCache = {
                body: this.body,
                title: this.title
            };
        },
        restoreFromCache() {
            this.body = this.beforeEditCache.body;
            this.title = this.beforeEditCache.title;
        },

        payload() {
            return {
                body: this.body,
                title: this.title
            };
        },

        destroy() {
            axios.delete(this.endpoint).then(({ data }) => {
                this.$toast.success(data.message, "Success", { timeout: 2000 });
            });

            setTimeout(() => {
                window.location.href = "/home";
            }, 2000);
        }
    }
};
</script>
