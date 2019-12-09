<template >
  <div>
   <post-list-default :posts="posts"></post-list-default>
  </div>
</template>
<script>
export default {
  created() {
    this.getPost();
  },
  methods: {
    postClick: function(p) {
      this.postSelected = p;
    },
    getPost() {
      fetch("/api/post")
        .then(response => response.json())
        .then(json => this.posts = json.data.data);

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
      posts: []
    };
  }
};
</script>
