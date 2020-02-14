<template>
  <div class="container">
    <todo :todo="todo"></todo>
  </div>
</template>

<script>
import Todo from "../components/Todo";

export default {
  components: { Todo },

  props: ["todo"]
};
</script>
