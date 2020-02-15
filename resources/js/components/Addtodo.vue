<template id="add-todo">
  <div>
    <h3>Add new todo</h3>
    <form @submit.prevent="create">
      <div class="form-group">
        <label for="add-title">Title</label>
        <input id="add-title" v-model="title" class="form-control" required />
      </div>
      <div class="form-group">
        <label for="add-body">Body</label>
        <textarea class="form-control" rows="10" v-model="body" required></textarea>
      </div>
      <button type="submit" class="btn btn-xs btn-primary">Create Todo</button>
      <router-link class="btn btn-xs btn-warning" v-bind:to="'/'">Cancel</router-link>
    </form>
  </div>
</template>

<script>
export default {
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
