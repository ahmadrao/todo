<template id="todo-delete">
  <div>
    <h3>Delete Todo {{ todo.title }}</h3>
    <form v-on:submit.prevent="deleteTodo">
      <p>The action cannot be undone</p>
      <button class="btn btn-xs btn-danger" type="submit" name="button">Delete</button>
      <router-link class="btn btn-xs btn-primary" v-bind:to="'/'">Back</router-link>
    </form>
  </div>
</template>

<script>
export default {
  data: function() {
    return { todo: { body: "", title: "" } };
  },
  created: function() {
    let uri = "/todo/" + this.$route.params.id + "/edit";
    Axios.get(uri).then(response => {
      this.todo = response.data;
    });
  },
  methods: {
    deleteTodo: function() {
      let uri = "/todo/" + this.$route.params.id;
      Axios.delete(uri, this.todo).then(response => {
        this.$toast.success(response.data.message, "Success", {
          timeout: 2000
        });
        this.$router.push({ name: "Listtodos" });
      });
    }
  }
};
</script>
