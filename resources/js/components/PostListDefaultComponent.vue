<template >
  <div>
    <div class="card w-50 mb-2 ml-auto mr-auto" v-for="post in posts">
      <div class="card-body">
        <h5 class="card-title">{{ post.title }}</h5>
        <img class="card-img-bottom" v-bind:src=" '/images/' + post.image " alt />
        <p class="card-text">{{ post.content }}</p>
        <button type="button" class="btn btn-primary" v-on:click="postClick(post)">Ver más</button>
        <router-link
          type="button"
          class="btn btn-primary"
          :to=" { name: 'detail',params:{id: post.id} }"
        >Ver Detalles</router-link>
      </div>
    </div>
    <modal-post :post="postSelected"></modal-post>
  </div>
</template>
<script>
export default {
  created() {},
  props: ["posts"],
  methods: {
    postClick: function(p) {
      this.postSelected = p;
    }
  },
  data: function() {
    return {
      postSelected: ""
    };
  }
};
</script>
