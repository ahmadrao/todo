<template>
  <div class="container">
    <todos :todos="todos"></todos>
  </div>
</template>

<script>
import Todos from "../components/Todos";

export default {
  components: { Todos },

  props: ["todos"]
};
</script>
