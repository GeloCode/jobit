<template>
    <div class="container">
        <div class="alert alert-info mt-2" role="alert" v-if="mensajeNingunaOferta">
            <strong>Vigila! {{userId}}</strong> Aún no tienes ningúna oferta, añade una para que te aparezcan.
        </div>
        <div class="input-group mt-4">
            <input type="search" class="form-control mb-3" v-model="search" placeholder="Busca por palabra clave..." name="buscar"/>
        </div>
        <div class="input-group">
            <select class="custom-select mb-1" name="searchProvincia" v-model="searchProvincia">
                    <option value="0">Elige tu Provincia</option>
                    <option v-for="provincia in provincias" :key="provincia.id" :value="provincia.id" v-text="provincia.nombre"></option>
                </select>
        </div>
        <div class="input-group mb-3">
            <button class="btn btn-danger" @click.prevent="filtrar()">Filter</button>
        </div>
        <button class="btn btn-primary mb-2" @click.prevent="addOtraOferta()">Añadir Oferta</button>
        <form @submit.prevent="addOferta" v-if="clickAddOferta">
            <div class="form-group">
                <label for="titulo">Título</label>
                <input type="text" class="form-control" placeholder="Título" v-model="oferta.titulo">
            </div>
            <div class="form-group">
                <label for="Descripcion">Descripción</label>
                <textarea class="form-control" placeholder="Descripción" v-model="oferta.descripcion"></textarea>
            </div>
            <div class="form-group">
                <label for="Provincia">Provincia</label>
                <select class="custom-select" name="selectProvincia" v-model="oferta.provincia_id">
                    <option value="0" disabled>Elige tu Provincia</option>
                    <option v-for="provincia in provincias" :key="provincia.id" :value="provincia.id" v-text="provincia.nombre"></option>
                </select>
            </div>
            <div class="form-group">
                <label for="vacantes">Vacantes</label>
                <input type="number" class="form-control" placeholder="Vacantes" v-model="oferta.vacantes">
            </div>
            <div class="form-group">
                <label for="Sueldo Desde">Sueldo Desde</label>
                <input type="number" class="form-control" placeholder="Sueldo Desde" v-model="oferta.sueldo_desde">
            </div>
            <div class="form-group">
                <label for="Sueldo Hasta">Sueldo Hasta</label>
                <input type="number" class="form-control" placeholder="Sueldo Hasta" v-model="oferta.sueldo_hasta">
            </div>
            <button type="submit" class="btn btn-dark btn-block mb-4">Guardar</button>
        </form>
        <div class="card card-body mb-2" v-bind:key="oferta.id" v-for="oferta in ofertas" 
        v-bind:id="'oferta_' + oferta.id">
            <div class="form-group inline">
                <label for="Titulo">Título:</label>
                <input type="text" class="form-control" v-model="oferta.titulo" disabled>
            </div>
            <div class="form-group inline">
                <label for="Descripcion">Descripción</label>      
                <textarea class="form-control" v-model="oferta.descripcion" disabled></textarea>
            </div>
            <div class="form-group inline">
                <label for="Sueldo Desde">Sueldo Desde</label>
                <input type="number" class="form-control" v-bind:value="oferta.sueldo_desde" disabled>
            </div>
            <div class="form-group inline">
                <label for="Sueldo Hasta">Sueldo hasta</label>
                <input type="number" class="form-control" v-bind:value="oferta.sueldo_hasta" disabled>
            </div>
            <div class="form-group inline">
                <label for="Vacantes">Vacantes</label>
                <input type="number" class="form-control" v-model="oferta.vacantes" disabled>
            </div>
            <div class="form-group">
                <label for="Provincia">Provincia</label>
                <select class="custom-select" name="selectProvincia" v-model="oferta.provincia_id" disabled>
                    <option value="0" disabled>Elige tu Provincia</option>
                    <option v-for="provincia in provincias" :key="provincia.id" :value="provincia.id" v-text="provincia.nombre"></option>
                </select>
            </div>
            <button class="btn btn-block btn-primary habilitadoSiempre" name="editar" v-on:click="habilitarCampos(oferta.id)">Editar</button>
            <button class="btn btn-block btn-secondary habilitadoSiempre" name="guardar" v-on:click="editOferta(oferta)" style="display:none;">Guardar</button>
            <button class="btn btn-block btn-danger habilitadoSiempre" v-on:click="deleteOferta(oferta)">Eliminar</button>
        </div>
        <nav>
          <ul class="pagination">
              <li class="page-item" v-if="pagination.current_page > 1">
                  <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page - 1)">Ant</a>
              </li>
              <li class="page-item" v-for="page in pagesNumber" :key="page" :class="[page == isActived ? 'active' : '']">
                  <a class="page-link" href="#" @click.prevent="cambiarPagina(page)" v-text="page"></a>
              </li>
              <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                  <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page + 1)">Sig</a>
              </li>
          </ul>
      </nav>          
    </div>
</template>
<script>
export default {
  created: function() {
    this.getOfertasByUserId();
    this.getProvincias();
  },
  props: {
    userId: String
  },
  data: function() {
    return {
      ofertas: [],
      oferta: {
        id: "",
        provincia_id: "",
        titulo: "",
        descripcion: "",
        vacantes: "",
        sueldo_desde: "",
        sueldo_hasta: ""
      },
      inscripcion: {
        oferta_id: ""
      },
      provincias: [],
      esEmpresa: "",
      errors: [],
      clickAddOferta: false,
      search: "",
      searchProvincia: 0,
      pagination: {
        total: 0,
        current_page: 0,
        per_page: 0,
        last_page: 0,
        from: 0,
        to: 0
      }
    };
  },
  methods: {
    getOfertasByUserId: function(page) {
      var url =
        "ofertas/usuario/?id=" +
        this.userId +
        "&page=" +
        page +
        "&buscar=" +
        this.search +
        "&provincia=" +
        this.searchProvincia;
      axios.get(url).then(response => {
        this.ofertas = response.data.ofertas.data;
        this.pagination = response.data.pagination;
      });
    },
    addOtraOferta: function() {
      this.clickAddOferta = true;
    },
    addOferta: function(oferta) {
      var url = "oferta";
      axios
        .post(url, {
          user_id: this.userId,
          provincia_id: this.oferta.provincia_id,
          titulo: this.oferta.titulo,
          descripcion: this.oferta.descripcion,
          vacantes: this.oferta.vacantes,
          sueldo_desde: this.oferta.sueldo_desde,
          sueldo_hasta: this.oferta.sueldo_hasta
        })
        .then(response => {
          this.getOfertasByUserId();
          this.oferta = {};
          this.clickAddOferta = false;
        })
        .catch(error => {
          this.errors = error.response.data;
        });
    },
    getProvincias: function() {
      var url = "provincias";
      axios.get(url).then(response => {
        this.provincias = response.data;
      });
    },
    habilitarCampos: function(id) {
      jQuery("#oferta_" + id + " :input").prop("disabled", false);
      jQuery("#oferta_" + id).addClass("editandoOferta"); // Aqui le añadimos la clase de editar oferta
      jQuery("#oferta_" + id).removeClass("oferta"); // Aqui le añadimos la clase de editar oferta
      //window.scrollTo(jQuery("#oferta_" + id).position());
      jQuery("#oferta_" + id + " [name=editar]").hide();
      jQuery("#oferta_" + id + " [name=guardar]").show();
    },
    editOferta: function(oferta) {
      var url = "oferta/" + oferta.id;
      axios
        .put(url, {
          provincia_id: oferta.provincia_id,
          titulo: oferta.titulo,
          descripcion: oferta.descripcion,
          vacantes: oferta.vacantes,
          sueldo_desde: oferta.sueldo_desde,
          sueldo_hasta: oferta.sueldo_hasta
        })
        .then(response => {
          this.getOfertasByUserId();
          this.oferta = {};
          this.errors = [];
          jQuery("#oferta_" + oferta.id + " :input").prop("disabled", true);
          jQuery("#oferta_" + oferta.id + " .habilitadoSiempre").prop(
            "disabled",
            false
          );
          jQuery("#oferta_" + oferta.id + " [name=guardar]").hide();
          jQuery("#oferta_" + oferta.id + " [name=editar]").show();
          jQuery("#oferta_" + id).addClass("oferta"); // Aqui le añadimos la clase de editar oferta
          jQuery("#oferta_" + id).removeClass("editandoOferta"); // Aqui le añadimos la clase de editar oferta
          toastr.success("Oferta actualizada correctamente!");
        })
        .catch(error => {
          jQuery("#oferta_" + oferta.id + " [name=guardar]").hide();
          jQuery("#oferta_" + oferta.id + " [name=editar]").show();
          this.errors = error.response.data;
        });
    },
    deleteOferta: function(oferta) {
      if (confirm("Estas Seguro?")) {
        var url = "ofertas/" + oferta.id;
        axios.delete(url).then(response => {
          this.getOfertasByUserId();
          toastr.success("Oferta eliminada correctamente!");
        });
      }
    },
    cambiarPagina(page) {
      let me = this;
      //Actualiza la página actual
      me.pagination.current_page = page;
      //Envia la petición para visualizar la data de esa página
      me.getOfertasByUserId(page);
    },
    filtrar: function() {
      this.getOfertasByUserId();
      toastr.success("Filtrado Con Éxito!");
    }
  },
  computed: {
    mensajeNingunaOferta: function() {
      return this.ofertas.length == 0 && !this.clickAddOferta;
    },
    isActived: function() {
      return this.pagination.current_page;
    },
    //Calcula los elementos de la paginación
    pagesNumber: function() {
      if (!this.pagination.to) {
        return [];
      }

      var from = this.pagination.current_page - this.offset;
      if (from < 1) {
        from = 1;
      }

      var to = from + this.offset * 2;
      if (to >= this.pagination.last_page) {
        to = this.pagination.last_page;
      }

      var pagesArray = [];
      while (from <= to) {
        pagesArray.push(from);
        from++;
      }
      return pagesArray;
    }
  }
};
</script>

