<template id="add-todo">
    <div>
        <router-link v-bind:to="'/'" class="btn btn-outline-dark"
            ><span class="fa fa-arrow-left mr-1"></span>Back to todo list
        </router-link>
        <h3>Add new todo</h3>
        <form @submit.prevent="create">
            <div class="form-group">
                <label for="add-title">Title</label>
                <input
                    id="add-title"
                    v-model="title"
                    class="form-control"
                    required
                />
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="start_date">Start Date</label>
                        <input
                            type="date"
                            id="start_date"
                            class="form-control"
                            min="2020-01-01"
                            max="2022-12-31"
                            v-model="start_date"
                        />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="end_date">End Date</label>
                        <input
                            type="date"
                            id="end_date"
                            class="form-control"
                            min="2020-01-01"
                            max="2022-12-31"
                            v-model="end_date"
                        />
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="add-body">Descritpion</label>
                <textarea
                    class="form-control"
                    rows="10"
                    v-model="body"
                    required
                ></textarea>
            </div>
            <button
                type="submit"
                class="btn btn-xs btn-primary"
                :disabled="isInvalid"
            >
                Create Todo
            </button>
            <router-link class="btn btn-xs btn-warning" v-bind:to="'/'"
                >Cancel</router-link
            >
        </form>
    </div>
</template>

<script>
export default {
    data() {
        return {
            title: "",
            body: "",
            start_date: "",
            end_date: "",
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
                title: this.title,
                start_date: this.start_date,
                end_date: this.end_date
            };
        },

        create() {
            axios
                .post(this.endpoint, this.payload())
                .catch(({ response }) => {
                    this.$toast.error(response.data.message, "Error", {
                        timeout: 3000
                    });
                })
                .then(({ data }) => {
                    this.bodyHtml = data.body_html;
                    this.$toast.success(data.message, "Success", {
                        timeout: 3000
                    });
                    this.$router.push({ name: "Listtodos" });
                });
        }
    }
};
</script>
