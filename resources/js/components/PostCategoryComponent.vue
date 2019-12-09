<template >
  <div>
    <h3>{{ category.title }}</h3>
    <post-list-default :posts="posts"></post-list-default>
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
      fetch("/api/post/" + this.$route.params.category_id + "/category")
        .then(response => response.json())
        .then(json => {
          this.posts = json.data.posts.data;
          this.category = json.data.category;
        });
    }
  },
  data: function() {
    return {
      postSelected: "",
      posts: [],
      category: ""
    };
  }
};
</script>
