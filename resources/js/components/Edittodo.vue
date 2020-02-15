<template id="todo-edit">
  <div>
    <h3>Add new Todo</h3>
    <form @submit.prevent="updateTodo">
      <div class="form-group">
        <label for="edit-title">Title</label>
        <input id="edit-title" v-model="todo.title" class="form-control" required />
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
              v-model="todo.start_date"
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
              v-model="todo.end_date"
            />
          </div>
        </div>
      </div>

      <div class="form-group">
        <label for="edit-body">Descritpion</label>
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
    return { todo: { title: "", body: "", start_date: "", end_date: "" } };
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
