<template>
  <div class="card" v-if="add">
    <form class="card-body" @submit.prevent="add">
      <div class="card-title">
        <input type="text" class="form-control form-control-lg" v-model="title" />
      </div>

      <hr />

      <div class="media">
        <div class="media-body">
          <div class="form-group">
            <textarea rows="10" v-model="body" class="form-control" required></textarea>
          </div>
          <button class="btn btn-primary" :disabled="isInvalid">Add Todo</button>
          <button class="btn btn-outline-secondary" @click="cancel" type="button">Cancel</button>
        </div>
      </div>
    </form>
  </div>
</template>
