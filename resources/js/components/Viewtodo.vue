<template id="todo">
  <div>
    <h3>{{ todo.title }}</h3>
    <strong>Body : </strong>
    <div>
      {{ todo.body }}
    </div>
  </br>
  <span class="glyphicon glyphicon-arrow-left"></span>
  <router-link v-bind:to="'/'">Back to todo list</router-link>
  </div>
</template>

<script>
   export default {
   data: function () {
   return {todo: {title: '', body: ''}}
 },
 created: function(){
   let uri = '/todo/'+this.$route.params.id;
     Axios.get(uri).then((response) => {
     this.todo = response.data;
   });
 }
 }
</script>
