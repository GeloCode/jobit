<template>
<div class="enlaces-component">
  <div class="badge badge-pill badge-light center" data-toggle="modal" data-target="#enlacesModal"  @click="limpiarEnlace();" v-if="controlarenlaces !=1">Añadir Enlace</div>
	  
    <div class="link-group row">
        <div v-for="enlace in enlaces" :key="enlace.id"  class="link-group-item col-lg-2 col-md-3 col-sm-4 col-xs-6">    
            <div class="badge badge-pill badge-dark">
              <div class="pill">
                <i class="fa fa-pencil" data-toggle="modal" data-target="#updateEnlace" @click="getEnlaceById(enlace.id)" v-if="controlarenlaces !=1"></i>
                <a class="link"  target="_blank" v-text="enlace.web" :href="enlace.enlace"></a> 
                <i class="fa fa-times-circle" @click="deleteEnlace(enlace.id)" v-if="controlarenlaces !=1"></i>
              </div>
            </div>
            
        </div>
    </div>
        
    <div class="modal fade" id="enlacesModal" tabindex="-1" role="dialog" aria-labelledby="enlacesModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="enlacesModalLabel">Añadir enlace</h5>
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
                        <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="updateEnlace" tabindex="-1" role="dialog" aria-labelledby="updateEnlaceLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateEnlaceLabel">Editar enlace</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form v-on:submit.prevent="updateEnlace()">
                        <div class="form-group">
                            <input type="text" class="form-control" id="webInput" aria-describedby="web"
                            v-model="enlace.web">
                            <small id="web" class="form-text text-muted">JobIT</small>
                        </div>
                        <div class="form-group">
                             <input type="text" class="form-control" id="urlInput" aria-describedby="web" v-model="enlace.enlace">
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
        id:0,
        user_id: this.userId,
        web: "",
        enlace: ""
      }
    };
  },
  props: {
    userId: String,
    controlarenlaces: String
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
          toastr.success("Enlaces actualizados correctamente");
          this.getLinks();
        })
        .catch(function(error) {
          toastr.error(error);
        });
          $("#enlacesModal").modal("toggle");          
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
    updateEnlace: function() {
     console.log(this.enlace.id);
      var url = "ienlace/" + this.enlace.id;
      axios.put(url, {
        user_id : this.userId,
        web : this.enlace.web,
        enlace : this.enlace.enlace
      })
        .then(response => {
          toastr.success("Enlaces actualizados correctamente");
          this.getLinks();
        })
        .catch(function(error) {
          this.getLinks();
          toastr.error(error);
        });
        $("#updateEnlace").modal("toggle");
    },
    getEnlaceById: function(id){
      var url = "enlace/" + id;
      axios.get(url).then(response => {
        this.enlace = response.data;
      });
      $("#updateEnlace").modal("toggle");
    },
    limpiarEnlace : function(){
      this.enlace = {};
    }
  }
};
</script>                    