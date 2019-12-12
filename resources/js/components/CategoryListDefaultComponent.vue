<template >
  <div>
    <div class="card w-50 mb-2 ml-auto mr-auto" v-for="category in categories" :key="category.id">
      <router-link type="button" :to=" { name: 'post-category',params:{category_id: category.id} }">
        <div class="card-body">
          <h5 class="card-title">{{ category.title }}</h5>
          <img class="card-img-bottom" src="/images/1570397770.png" alt />
        </div>
      </router-link>
    </div>
  </div>
</template>
<script>
export default {
  created() {
    this.getCategories();
  },
  methods: {
    getCategories: function() {
      fetch("/api/category/all")
        .then(response => response.json())
        .then(json => {
          this.categories = json.data;
        });
    }
  },
  data: function() {
    return {
      categories: ""
    };
  }
};
</script>
