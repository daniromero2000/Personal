<template >
  <div class="col-6 offset-3 mb-4 mt-4">
    <div class="card">
      <div class="card-header">
        <img src="/images/bolitas.png" alt style="width: 56px;margin: -7px auto -14px auto;" />
      </div>
      <div class="card-body">
        <form>
          <div class="form-row">
            <div class="col">
              <input type="text" class="form-control" v-model="name" placeholder="Nombre" />
            </div>
            <div class="col">
              <input type="text" class="form-control" v-model="apellido" placeholder="Apellido" />
            </div>
          </div>
          <div class="form-row">
            <div class="col mt-2">
              <input type="text" class="form-control" v-model="email" placeholder="Email" />
            </div>
          </div>
          <div class="form-row">
            <div class="col mt-2">
              <textarea
                class="form-control"
                name
                id
                placeholder="contenido"
                v-model="content"
                cols="30"
                rows="3"
              ></textarea>
            </div>
          </div>
          <button @click="saveContact" type="button" class="btn btn-primary mt-2">Enviar</button>
        </form>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  created() {
    // this.saveContact();
  },
  methods: {
    saveContact() {
      console.log(this.name, this.apellido, this.email, this.content);
      //   fetch("/api/post/" + this.$route.params.id)
      //     .then(response => response.json())
      //     .then(json => (this.post = json.data));
    }
  },
  data: function() {
    return {
      name: "",
      apellido: "",
      email: "",
      content: ""
    };
  }
};
</script>
