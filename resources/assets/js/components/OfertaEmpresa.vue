<template>
  <div id="ofertaempresa">
    <header class="header container-fluid">
      <div class="header-img row">
        <h2>Publishes offers
          <br>contracts professionals</h2>
      </div>
    </header>
    <div class="container-fluid filters">
      <div class="row">
        <div class="container">
          <div class="row">
            <div class="alert alert-info mt-2" role="alert" v-if="mensajeNingunaOferta">
              Aún no tienes ningúna oferta, añade una para que te aparezcan.
            </div>

            <form class="col-lg-12 form-filter">
              <div class="form-row align-items-center">
                <div class="col-auto home-form">
                  <button class="btn btn-primary mb-2" @click.prevent="addOtraOferta()">Añadir Oferta</button>
                </div>
                <div class="col-auto home-form">

                  <div class="input-group mb-2">
                    <div class="input-group-prepend">
                      <div class="input-group-text">
                        <i class="fa fa-code"></i>
                      </div>
                      <input class="form-control g-font-size-16 border-0 g-height-60 rounded-0" name="buscar" id="te" maxlength="45" placeholder="Busca por palabra clave..."
                        aria-label="Buscar por Tecnología" tabindex="1" autocomplete="off" type="search" v-model="search">
                    </div>
                  </div>
                </div>
                <div class="col-auto home-form">

                  <div class="input-group mb-2">
                    <div class="input-group-prepend">
                      <div class="input-group-text">
                        <i class="fa fa-map-marker"></i>
                      </div>
                      <select name="pr" id="pr" class="custom-select g-font-size-16 rounded-0 g-height-60 g-min-width-100x border-0" style="" tabindex="2"
                        v-model="searchProvincia">
                        <option value="0" disabled>Elige tu Provincia</option>
                        <option v-for="provincia in provincias" :key="provincia.id" :value="provincia.id" v-text="provincia.nombre"></option>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="col-auto home-form button-2">
                  <button class="btn btn-danger order-xs-first mb-2" @click.prevent="filtrar()" tabindex="3">
                    Filter </button>
                </div>
              </div>
            </form>
          </div>
          <div class="row">
            <div class="col-lg-2"></div>
            <form class="card card-body add-offer col-lg-8" @submit.prevent="addOferta" v-if="clickAddOferta">
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

              <div class="form-content">
                <div class="form-group">
                  <label for="Sueldo Desde">Sueldo Desde</label>
                  <input type="number" class="form-control" placeholder="Sueldo Desde" v-model="oferta.sueldo_desde">
                </div>
                <div class="form-group">
                  <label for="Sueldo Hasta">Sueldo Hasta</label>
                  <input type="number" class="form-control" placeholder="Sueldo Hasta" v-model="oferta.sueldo_hasta">
                </div>
              </div>
              <button type="submit" class="btn btn-dark btn-block mb-4">Guardar</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <hr/>
    <div class="container">
      <div class="row oferts">
        <div class="col-lg-8">
          <div class="card card-body oferta mb-2" v-bind:key="oferta.id" v-for="oferta in ofertas" v-bind:id="'oferta_' + oferta.id">
            <div class="form-group ">
              <label for="Titulo">Título:</label>
              <input type="text" class="form-control" v-model="oferta.titulo" disabled>
            </div>
            <div class="form-group ">
              <label for="Descripcion">Descripción</label>
              <textarea class="form-control" v-model="oferta.descripcion" disabled></textarea>
            </div>
            <div class="form-group">
              <label for="Provincia">Provincia</label>
              <select class="custom-select" name="selectProvincia" v-model="oferta.provincia_id" disabled>
                <option value="0" disabled>Elige tu Provincia</option>
                <option v-for="provincia in provincias" :key="provincia.id" :value="provincia.id" v-text="provincia.nombre"></option>
              </select>
            </div>
            <div class="form-group ">
              <label for="Vacantes">Vacantes</label>
              <input type="number" class="form-control" v-model="oferta.vacantes" disabled>
            </div>
            <div class="form-content">
              <div class="form-group ">
                <label for="Sueldo Desde">Sueldo Desde</label>
                <input type="number" class="form-control" v-bind:value="oferta.sueldo_desde" disabled>
              </div>
              <div class="form-group ">
                <label for="Sueldo Hasta">Sueldo hasta</label>
                <input type="number" class="form-control" v-bind:value="oferta.sueldo_hasta" disabled>
              </div>
            </div>
            <hr/>
            <div class="buttons-container">
              <button class="btn btn-secondary habilitadoSiempre" v-on:click="buscarInscripciones(oferta.id)">Ver Inscripciones</button>
              <button class="btn btn-primary habilitadoSiempre" name="editar" v-on:click="habilitarCampos(oferta.id)">Editar</button>
              <button class="btn btn-secondary habilitadoSiempre" name="guardar" v-on:click="editOferta(oferta)" style="display:none;">Guardar</button>
              <button class="btn btn-danger habilitadoSiempre" v-on:click="deleteOferta(oferta)">Eliminar</button>
            </div>
          </div>
          <nav class="col-lg-12">
            <ul class="pagination">
              <li class="page-item bef" v-if="pagination.current_page > 1">
                <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page - 1)">Ant</a>
              </li>
              <li class="page-item" v-for="page in pagesNumber" :key="page" :class="[page == isActived ? 'active' : '']">
                <a class="page-link" href="#" @click.prevent="cambiarPagina(page)" v-text="page"></a>
              </li>
              <li class="page-item next" v-if="pagination.current_page < pagination.last_page">
                <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page + 1)">Sig</a>
              </li>
            </ul>
          </nav>
        </div>
        <aside class="col-lg-4 order-sm-first order-lg-last order-md-first order-xs-first" v-if="!mensajeNingunaOferta">
          <div class="aside-content card card-body mb-2">
            <h2>Offerts Stats</h2>
            <div class="inscritos">
              <p>Inscritos</p>
              <p class="numero" v-text="estadisticasInscripcion.totales"></p>
            </div>
            <div class="pendientes">
              <p>Pendientes por gestionar</p>
              <p class="numero" v-text="estadisticasInscripcion.pendientes"></p>
            </div>
            <div class="aceptados">
              <p>Aceptados</p>
              <p class="numero" v-text="estadisticasInscripcion.aceptados"></p>
            </div>
            <div class="rechazados">
              <p>Rechazados</p>
              <p class="numero" v-text="estadisticasInscripcion.rechazados"></p>
            </div>
          </div>
        </aside>
      </div>
    </div>
  </div>
</template>
<script>
  export default {
    created: function () {
      this.getOfertasByUserId();
      this.getProvincias();
      this.getEstadisticasIncripcionOferta();
    },
    props: {
      userId: String
    },
    data: function () {
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
        },
        estadisticasInscripcion: {
          totales: 0,
          pendientes: 0,
          aceptados: 0,
          rechazados: 0
        }
      };
    },
    methods: {
      getOfertasByUserId: function (page) {
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
      addOtraOferta: function () {
        this.clickAddOferta = true;
      },
      addOferta: function (oferta) {
        if (this.oferta.titulo != "") {
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
        } else {
          this.clickAddOferta = false;
        }
      },
      editOferta: function (oferta) {
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
            jQuery("#oferta_" + oferta.id).addClass("oferta"); // Aqui le añadimos la clase de editar oferta
            jQuery("#oferta_" + oferta.id).removeClass("editandoOferta"); // Aqui le añadimos la clase de editar oferta
            toastr.success("Oferta actualizada correctamente!");
          })
          .catch(error => {
            jQuery("#oferta_" + oferta.id + " [name=guardar]").hide();
            jQuery("#oferta_" + oferta.id + " [name=editar]").show();
            this.errors = error.response.data;
          });
      },
      getProvincias: function () {
        var url = "provincias";
        axios.get(url).then(response => {
          this.provincias = response.data;
        });
      },
      habilitarCampos: function (id) {
        jQuery("#oferta_" + id + " :input").prop("disabled", false);
        jQuery("#oferta_" + id).addClass("editandoOferta"); // Aqui le añadimos la clase de editar oferta
        jQuery("#oferta_" + id).removeClass("oferta"); // Aqui le añadimos la clase de editar oferta
        //window.scrollTo(jQuery("#oferta_" + id).position());
        jQuery("#oferta_" + id + " [name=editar]").hide();
        jQuery("#oferta_" + id + " [name=guardar]").show();
      },
      deleteOferta: function (oferta) {
        if (confirm("Estas Seguro?")) {
          var url = "ofertas/" + oferta.id;
          axios.delete(url).then(response => {
            this.getOfertasByUserId();
            toastr.success("Oferta eliminada correctamente!");
            this.getEstadisticasIncripcionOferta();
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
      filtrar: function () {
        this.getOfertasByUserId();
        if (this.search != "" || this.searchProvincia != 0) {
          toastr.success("Filtrado Con Éxito!");
        }
      },
      buscarInscripciones: function (id) {
        var url = "/vinscripcionesempresa?ofertaId=" + id;
        window.location.href = url;
      },
      getEstadisticasIncripcionOferta: function () {
        var url = "inscripciones/estadistica/empresa/" + this.userId;
        axios.get(url).then(response => {
          this.estadisticasInscripcion = response.data;
        });
      }
    },
    computed: {
      mensajeNingunaOferta: function () {
        return this.ofertas.length == 0 && !this.clickAddOferta;
      },
      isActived: function () {
        return this.pagination.current_page;
      },
      //Calcula los elementos de la paginación
      pagesNumber: function () {
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