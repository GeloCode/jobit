<template>
<div>
	<div class="list-group">
        <div v-for="enlace in enlaces" :key="enlace.id"  class="list-group-item" v-text="enlace.web" @click.prevent="openLink(enlace.enlace)">
            <a class="btn btn-danger btn-sm" v-bind:href="'/borrarEnlace?id=' + enlace.id">Borrar</a>
        </div>
    </div>
        <button type="button" class="btn btn-xl btn-primary" data-toggle="modal" data-target="#exampleModal">Añadir Enlace</button>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Enlace</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form v-on:submit.prevent="createLink()">
                        <div class="form-group">
                            <input type="text" class="form-control" id="webInput" aria-describedby="web"
                            v-model="enlace.web">
                            <small id="web" class="form-text text-muted">JobIT</small>
                        </div>
                        <div class="form-group">
                             <input type="text" class="form-control" id="urlInput" aria-describedby="web" v-model="enlace.url">
                            <small id="name" class="form-text text-muted">www.noTenemosDNS.tampocoDominio</small>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</template>
<script>
export default {
  created: function() {
    this.getLinks();
  },
  data: function() {
    return {
      enlaces: [],
      enlace: {
        web: "",
        url: ""
      }
    };
  },
  props: {
    userId: String
  },
  methods: {
    openLink: function(url) {
      window.open(url, "_blank");
    },
    getLinks: function() {
      var url = "enlaces/" + this.userId;
      axios
        .get(url)
        .then(response => {
          this.enlaces = response.data;
        })
        .catch(error => {
          toastr.error(error);
        });
    },
    createLink: function() {
      var myMethod = "post";
      var url = "ienlace";
      if (this.enlace.id) {
        myMethod = "put";
        url += "/" + this.userId;
      }
      axios({
        method: myMethod,
        url: url,
        data: {
          user_id: this.userId,
          web: this.enlace.web,
          url: this.enlace.url
        }
      })
        .then(response => {
          $("#enlaceModal").modal("toggle");
          this.getLinks();
        })
        .catch(function(error) {
          toastr.error(error);
        });
    }
  }
};
</script>