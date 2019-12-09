<template >
  <div>
    <div v-if="post">
      <div class="card w-50 mb-2 ml-auto mr-auto">
        <div class="card-header">
          <img class="card-img-bottom" v-bind:src=" '/images/' + post.image.image " alt />
        </div>
        <div class="card-body">
          <h3 class="card-title">{{ post.title }}</h3>
          <p class="card-text">{{ post.content }}</p>
           <router-link
          type="button"
          class="btn btn-primary"
          :to=" { name: 'post-category',params:{category_id: post.category.id} }"
        >Ver Categorias</router-link>
        </div>
      </div>
    </div>

    <div v-else>
      <h1>Post no encontrado</h1>
    </div>
  </div>
</template>
<script>
export default {
  created() {
    this.getPost();
    // console.log("hola mundo" + this.$route.params.id );
  },
  methods: {
    getPost() {
      fetch("/api/post/" + this.$route.params.id)
        .then(response => response.json())
        .then(json => (this.post = json.data));

      // .then(json => (this.post = console.log(json.data.data)));
      // .then(function(response) {
      //   return response.json();
      // })
      // .then(function(json) {
      //   console.log(json.data.data);
      // });
    }
  },
  data: function() {
    return {
      postSelected: "",
      post: ""
    };
  }
};
</script>
