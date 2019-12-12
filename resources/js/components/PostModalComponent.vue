<template >
   <!-- Modal -->
<div  class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">{{ post.title }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        {{ post.content }}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
</template>
<script>
export default {
     props:["post"],
    created(){
        // console.log("modal created");
        // setTimeout(function(){
        //     $("#exampleModal").modal("show");
        // },1000);
    },
    watch: {
        post: function(newVal, oldVal){
             $("#exampleModal").modal("show");

        }
    },
}
</script>
