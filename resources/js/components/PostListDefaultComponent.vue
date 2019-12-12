<template >
  <div>
    <div class="card w-50 mb-2 ml-auto mr-auto" v-for="post in posts" :key="post.id">
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
    <modal-post :post="postSelected "></modal-post>
    <v-pagination
      v-model="currentPage"
      :page-count="total"
      :classes="bootstrapPaginationClasses"
      :labels="paginationAnchorTexts"
    ></v-pagination>
  </div>
</template>
<script>
import vPagination from "vue-plain-pagination";
export default {
  props: ["posts", "total", "pCurrentPage"],
  created() {
    this.currentPage = this.pCurrentPage;
  },
  methods: {
    postClick: function(p) {
      this.postSelected = p;
    }
  },
  data: function() {
    return {
      postSelected: "",
      currentPage: 1,
      bootstrapPaginationClasses: {
        ul: "pagination",
        li: "page-item",
        liActive: "active",
        liDisable: "disabled",
        button: "page-link"
      },
      paginationAnchorTexts: {
        first: "",
        prev: "&laquo;",
        next: "&raquo;",
        last: ""
      }
    };
  },
  components: { vPagination },
  watch: {
    currentPage: function(newVal, oldVal) {
      console.log(newVal);
      this.$emit("getCurrentPage", newVal);
    }
  }
};
</script>
