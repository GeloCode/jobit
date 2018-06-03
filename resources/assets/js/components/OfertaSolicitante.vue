<template>
    <div class="container" id="ofertasolicitante">
        
        <h1>Ofertas</h1>
        <h2>Filtros</h2>
        <div class="input-group">
            <input type="search" class="form-control mb-1" v-model="search.searchWord" placeholder="Busca por palabra clave.."/>
        </div>
        <div class="input-group">
                <select class="custom-select mb-1" name="searchProvincia" v-model="search.searchProvincia">
                    <option value="0">Elige tu Provincia</option>
                    <option v-for="provincia in provincias" :key="provincia.id" :value="provincia.id" v-text="provincia.nombre"></option>
                </select>
        </div>
        <div class="input-group">
            <input type="number" class="form-control mb-1" v-model="search.searchSueldoDesde" placeholder="Sueldo Desde"/>
        </div>
        <div class="input-group">
            <input type="number" class="form-control mb-1" v-model="search.searchSueldoHasta" placeholder="Sueldo Hasta"/>
        </div>
        <div class="input-group mb-3">
            <button class="btn btn-danger" @click.prevent="filtrar()">Filter</button>
        </div>
        <div class="alert alert-info" role="alert" v-if="ofertas.length == 0 && search">
            <strong>Lo siento!</strong> Ninguna oferta coincide con los valores de búsqueda.
        </div>

        <div class="accordion col-lg-8">
          <div class="card" :key="oferta.id" v-for="oferta in ofertas">
            <div class="card-header">
              <h4 class="mb-0">
                <button class="btn btn-link" data-toggle="collapse" :data-target="'#collapse' + oferta.id" 
                aria-expanded="false" :aria-controls="'#collapse' + oferta.id" v-text="oferta.titulo">
                </button>
              </h4>
            </div>
            <div class="collapse show" :id="'#collapse' + oferta.id" data-parent="#accordion">
              <div class="card-body">
                <p class="card-text label">Descripción</p>
                <p class="card-text input" v-text="oferta.descripcion"></p>
                <p class="card-text label">Vacantes</p>
                <p class="card-text input" v-text="oferta.vacantes"></p>
                <p class="card-text label">Sueldo</p>
                <p class="card-text input" v-text="oferta.sueldo_desde + '€ - ' + oferta.sueldo_hasta + '€ Bruto/año'"></p>
                <hr/>
                <div class="button-box">
                  <button class="btn btn-block btn-primary" v-on:click="inscribirse(oferta)" v-if="userId">Inscribirse</button>
                </div>
              </div>
            </div>
          </div>   
        </div>
        <nav>
          <ul class="pagination">
              <li class="page-item" v-if="pagination.current_page > 1">
                  <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page - 1)">Ant</a>
              </li>
              <li class="page-item" v-for="page in pagesNumber" :key="page" :class="[page == isActived && 'active']">
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
    this.getOfertas();
    this.getProvincias();
  },
  props: {
    userId: String,
    word: String,
    provinciaId: String,
  },
  data: function() {
    return {
      ofertas: [],
      oferta: {
        id: "",
        provincia_id: 0,
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
      search: {
        searchWord: this.word,
        searchProvincia: this.provinciaId ? this.provinciaId : 0,
        searchSueldoDesde: "",
        searchSueldoHasta: ""
      },
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
    getOfertas: function(page) {
      var url =
        "ofertas?id="+ this.userId +
        "&page=" + page +
        "&buscar=" + this.search.searchWord +
        "&provincia=" + this.search.searchProvincia +
        "&sueldoDesde=" + this.search.searchSueldoDesde +
        "&sueldoHasta=" + this.search.searchSueldoHasta;
      axios.get(url).then(response => {
        this.ofertas = response.data.ofertas.data;
        this.pagination = response.data.pagination;
      });
    },
    getOferta: function(id) {
      var url = "oferta/" + id;
      axios.get(url).then(response => {
        this.oferta = response.data;
      });
    },
    inscribirse: function(oferta) {
      var url = "inscripcion";
      axios.post(url, {
        user_id: this.userId,
        oferta_id: oferta.id,
        estado: '-'
      }).
        then(response => {
          this.getOfertas();
          toastr.success("Te has inscrito a esta oferta con éxito!");
        });
    },
    getProvincias: function() {
      var url = "provincias";
      axios.get(url).then(response => {
        this.provincias = response.data;
      });
    },
    cambiarPagina(page) {
      let me = this;
      //Actualiza la página actual
      me.pagination.current_page = page;
      //Envia la petición para visualizar la data de esa página
      me.getOfertas(page);
    },
    filtrar: function() {
      this.getOfertas();
      toastr.success("Filtrado Con Éxito!");
    }
  },
  computed: {
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

