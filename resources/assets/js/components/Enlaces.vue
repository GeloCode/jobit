<template>
<div>
	<div v-for="enlace in enlaces" :key="enlace.id"  class="list-group">
        <div class="list-group-item">
            <a   v-text="enlace.web" :href="enlace.enlace"></a>
            <a class="btn btn-danger btn-sm float-right" @click="deleteEnlace(enlace.id)">Borrar</a>
            <a class="btn btn-warning btn-sm float-right" @click="updateEnlace(enlace.id)">Editar</a>
        </div>
    </div>
        <button type="button" class="btn btn-xl btn-primary" data-toggle="modal" data-target="#enlacesModal">Añadir Enlace</button>
    <div class="modal fade" id="enlacesModal" tabindex="-1" role="dialog" aria-labelledby="enlacesModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="enlacesModalLabel">Enlace</h5>
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
                             <input type="text" class="form-control" id="urlInput" aria-describedby="web" v-model="enlace.enlace">
                            <small id="name" class="form-text text-muted">www.noTenemosDNS.tampocoDominio</small>
                        </div>
                        <button type="submit" class="btn btn-primary" data-dismiss="modal">Submit</button>
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
        user_id: this.userId,
        web: "",
        enlace: ""
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
      alert('entraaaaaaaaaaa');
      axios({
        method: myMethod,
        url: url,
        data: {
          user_id: this.userId,
          web: this.enlace.web,
          enlace: this.enlace.enlace
        }
      })
        .then(response => {
          $("#enlaceModal").modal("toggle");
          toastr.success("Enlaces actualizados correctamente");
          this.getLinks();
        })
        .catch(function(error) {
          toastr.error(error);
        });
    },
    deleteEnlace: function(id) {
      if (confirm("¿Estas Seguro?")) {
        var url = "deleteEnlace/" + id;
        axios
          .delete(url)
          .then(response => {
            toastr.success("Enlace eliminado correctamente!");
            this.getLinks();
          })
          .catch(error => {
            toastr.error(error);
          });
      }
    },
    updateEnlace: function(id) {
      var myMethod = "put";
      var url = "ienlace/" + id;
      toastr.info(myMethod);
      axios({
        method: myMethod,
        url: url,
        data: {
          user_id: this.userId,
          web: this.enlace.web,
          enlace: this.enlace.enlace
        }
      })
        .then(response => {
          $("#enlaceModal").modal("toggle");
          toastr.success("Enlaces actualizados correctamente");
          this.getLinks();
        })
        .catch(function(error) {
          toastr.error(error);
        });
    }
  }
};
</script>