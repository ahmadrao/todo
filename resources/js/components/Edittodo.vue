<template id="todo-edit">
  <div>
    <h3>Add new Todo</h3>
    <form @submit.prevent="updateTodo">
      <div class="form-group">
        <label for="edit-title">Title</label>
        <input id="edit-title" v-model="todo.title" class="form-control" required />
      </div>
      <div class="form-group">
        <label for="edit-body">Body</label>
        <textarea class="form-control" rows="10" v-model="todo.body" required></textarea>
      </div>
      <button type="submit" class="btn btn-xs btn-primary" :disabled="isInvalid">Update Todo</button>
      <router-link class="btn btn-xs btn-warning" v-bind:to="'/'">Cancel</router-link>
    </form>
  </div>
</template>

<script>
export default {
  data: function() {
    return { todo: { title: "", body: "" } };
  },
  created: function() {
    let uri = "/todo/" + this.$route.params.id;
    Axios.get(uri).then(response => {
      this.todo = response.data;
    });
  },
  computed: {
    isInvalid() {
      return this.todo.body.length < 10 || this.todo.title.length < 5;
    }
  },
  methods: {
    updateTodo: function() {
      let uri = "/todo/" + this.$route.params.id;
      Axios.patch(uri, this.todo).then(({ data }) => {
        this.$toast.success(data.message, "Success", {
          timeout: 3000
        });
        this.$router.push({ name: "Listtodos" });
      });
    }
  }
};
</script>
