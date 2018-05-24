<template>
    <div>
        <h1>Ofertas</h1>
        <form @submit.prevent="addOferta">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Título" v-model="oferta.titulo">
            </div>
            <div class="form-group">
                <textarea class="form-control" placeholder="Descripción" v-model="oferta.descripcion"></textarea>
            </div>
            <div class="form-group">
                <select class="custom-select" name="selectProvincia" v-model="oferta.provincia_id">
                    <option value="0" disabled>Elige tu Provincia</option>
                    <option v-for="provincia in provincias" :key="provincia.id" :value="provincia.id" v-text="provincia.nombre"></option>
                </select>
            </div>
            <div class="form-group">
                <input type="number" class="form-control" placeholder="Vacantes" v-model="oferta.vacantes">
            </div>
            <button type="submit" class="btn btn-dark btn-block mb-4">Guardar</button>
        </form>
        <div class="card card-body mb-2" v-bind:key="oferta.id" v-for="oferta in ofertas">
            <h3 class="card-title" v-text="oferta.titulo"></h3>
            <p class="card-text" v-text="oferta.descripcion"></p>
            <button class="btn btn-block btn-primary" v-on:click="inscribirse(oferta)">Inscribirse</button>
            <button class="btn btn-block btn-danger" v-on:click="deleteOferta(oferta)">Eliminar</button>
        </div>
        <div class="col-sm-5">
            <pre>@{{ $data }}</pre>
        </div>
    </div>
</template>
<script>
export default {
  created: function() {
    this.getOfertas();
    this.isEmpresa();
    this.getProvincias();
  },
  data: function() {
      return {
            ofertas: [],
            oferta: {
            id: "",
            provincia_id: 0,
            titulo: "",
            descripcion: "",
            vacantes: ""
            },
            inscripcion: {
                user_id: '',
                oferta_id:'',
            },
            provincias: [],
            esEmpresa: "",
            errors: []
            }
  },
  methods: {
    getOfertas: function() {
      var url = "ofertas";
      axios.get(url).then(response => {
        this.ofertas = response.data;
      });
    },
    getOferta: function(id) {
      var url = "oferta/" + id;
      axios.get(url).then(response => {
        this.oferta = response.data;
      });
    },
    deleteOferta: function(oferta) {
      if (confirm("Estas Seguro?")) {
        var url = "ofertas/" + oferta.id;
        axios.delete(url).then(response => {
          this.getOfertas();
          toastr.success("Oferta eliminada correctamente!");
        });
      }
    },
    addOferta: function(oferta) {
      var url = "oferta";
      axios
        .post(url, {
          user_id: 2, //TODO Cambiarlo por el id de usuario real
          provincia_id: this.oferta.provincia_id,
          titulo: this.oferta.titulo,
          descripcion: this.oferta.descripcion,
          vacantes: this.oferta.vacantes
        })
        .then(response => {
          this.getOfertas();
          this.oferta = {};
        })
        .catch(error => {
          this.errors = error.response.data;
        });
    },
    editOferta: function(id) {
      var url = "oferta/" + id;
      axios
        .put(url, {
          provincia_id: this.oferta.provincia_id,
          titulo: this.oferta.titulo,
          descripcion: this.oferta.descripcion,
          vacantes: this.oferta.vacantes
        })
        .then(response => {
          this.getOfertas();
          this.oferta = {};
          this.errors = [];
          toastr.success("Oferta actualizada correctamente!");
        })
        .catch(error => {
          this.errors = error.response.data;
        });
    },
    isEmpresa: function(id) {
      var url = "isEmpleado/" + 2; //TODO Cambairlo por el id del usuario
      axios.get(url).then(response => {
        var role = response.data;
        this.esEmpresa = role == "Empresa" ? true : false;
      });
    },
    getProvincias: function() {
      var url = "provincias";
      axios.get(url).then(response => {
        this.provincias = response.data;
      });
    },
    inscribirse: function(oferta) {
        var url = "inscripcion";
        axios.post(url, {
            user_id: 1,
            oferta_id: oferta.id,            
        });
    }
  }
};
</script>

