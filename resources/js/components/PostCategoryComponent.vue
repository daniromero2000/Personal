<template >
  <div>
    <h3>{{ category.title }}</h3>
    <post-list-default
     :key="currentPage"
      @getCurrentPage="getCurrentPage"
      v-if="total > 0"
      :posts="posts"
      :pCurrentPage="currentPage"
      :total="total" >
      </post-list-default>
  </div>
</template>
<script>
export default {
  created() {
    this.getPosts();
  },
  methods: {
    postClick: function(p) {
      this.postSelected = p;
    },
    getPosts() {
      //   console.log("_________" + this.$route.params.category_id);
      fetch("/api/post/" + this.$route.params.category_id + "/category?page=" + this.currentPage)
        .then(response => response.json())
        .then(json => {
          this.posts = json.data.posts.data;
          this.category = json.data.category;
          this.total = json.data.posts.last_page;

        });
    },
     getCurrentPage: function(val) {
      this.currentPage = val;
      this.getPosts();
      //   console.log("PostList + currentPage:" + val);
    }
  },
  data: function() {
    return {
      postSelected: "",
      posts: [],
      category: "",
      total: 0,
      currentPage: 1
    };
  }
};
</script>
