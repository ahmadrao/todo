export default {
    data() {
        return {
            editing: false,
            adding: false
        };
    },

    methods: {
        add() {
            this.adding = true;
        },

        edit() {
            this.setEditCache();
            this.editing = true;
        },

        cancel() {
            this.restoreFromCache();
            this.editing = false;
            this.adding = false;
        },

        setEditCache() {},
        restoreFromCache() {},

        getTodos() {
            axios
                .get("/todo")
                .then(response => {
                    this.todos = response.data.data;
                })
                .catch(err => console.log(err));
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
                    this.adding = false;
                    this.$router.push({ name: "Listposts" });
                });
        },

        update() {
            axios
                .put(this.endpoint, this.payload())
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
                    this.editing = false;
                });
        },

        delete() {
            axios.delete(this.endpoint).then(({ data }) => {
                this.$toast.success(data.message, "Success", { timeout: 2000 });
            });
        },

        payload() {},

        destroy() {
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
                            this.delete();

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
