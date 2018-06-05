<template>
  <div  id="inscripcionesempresa">
    <header class="header container-fluid">
      <div class="header-img row">
        <h2>Start building
          <br>Your team</h2>
      </div>
    </header>
      <div class="container">
        <div class="row">
          <div class="col-md-4">
        <button class="btn btn-primary" @click="filtrarPendientePorGestionar()">Pendientes Gestión</button>
        <button class="btn btn-primary" @click="filtrarAceptados()">Aceptados</button>
        <button class="btn btn-primary" @click="filtrarRechazados()">Rechazados</button>
      </div>
          <table class="col-md-8">
            <thead>
              <tr>
                <th>Titulo</th>
                <th>Email</th>
                <th>Estado</th>
                <th>&nbsp;</th>
              </tr>
            </thead>
            <tbody>
              <tr class="inscripcion-row" :key="inscOferta.id" v-for="inscOferta in inscripcionOfertasFiltradas" :class="inscOferta.estado == 'A' ? 'bg-success' : inscOferta.estado == 'R' ? 'bg-danger' : 'bg-warning'">
                <td v-text="inscOferta.oferta.titulo"></td>
                <td v-text="inscOferta.user.email"></td>
                <td v-text="inscOferta.estado == '-' ? 'Pendiente por Gestionar' 
                    : inscOferta.estado == 'A' ? 'Aceptado' : 'Rechazado'"></td>
                <td>
                  <a class="btn btn-primary" v-bind:href="'/perfilSolicitante?id=' + inscOferta.user.id + '&verenlace=' + verenlace">Ver Portfolio</a>
                  <i class="fa fa-check-circle" @click.prevent="aceptarInscripcion(inscOferta.id)" v-if="inscOferta.estado != 'A'"></i>
                  <i class="fa fa-times-circle" @click.prevent="rechazarInscripcion(inscOferta.id)" v-if="inscOferta.estado != 'R'"></i>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
</template>
<script>
  export default {
    created: function () {
      this.getOfertasInscripcion();
    },
    props: {
      userId: String,
      ofertaId: String,
      verenlace: String
    },
    data: function () {
      return {
        inscripcionofertas: [],
        inscripcionOfertasFiltradas: [],
        filtrarAceptado: false,
        filtrarRechazado: false,
        filtrarPendienteGestion: false,
        portfolioId: "",
      };
    },
    methods: {
      getOfertasInscripcion: function (page) {
        var url =
          "inscripcion/empresas?userId=" +
          this.userId +
          "&ofertaId=" +
          this.ofertaId;
        axios.get(url).then(response => {
          this.inscripcionofertas = response.data;
          this.filtrarInscripcionDependiendoFiltro();
        });
      },
      eliminarInscripcion: function (id) {
        if (confirm("Estas Seguro?")) {
          var url = "inscripcion/" + id;
          axios.delete(url).then(response => {
            this.getOfertasInscripcion();
            toastr.success("Inscripcion eliminada correctamente!");
          });
        }
      },
      aceptarInscripcion: function (id) {
        var url = "inscripcion/aceptar/" + id;
        axios.get(url).then(response => {
          this.getOfertasInscripcion();
          toastr.success("Inscripcion Aceptada correctamente!");
        });
      },
      rechazarInscripcion: function (id) {
        var url = "inscripcion/rechazar/" + id;
        axios.get(url).then(response => {
          this.getOfertasInscripcion();
          toastr.warning("Inscripcion Rechazada!");
        });
      },
      filtrarPendientePorGestionar: function () {
        this.filtrarRechazado = false;
        this.filtrarAceptado = false;
        this.filtrarPendienteGestion = !this.filtrarPendienteGestion;
        this.getOfertasInscripcion();
      },
      filtrarAceptados: function () {
        this.filtrarAceptado = !this.filtrarAceptado;
        this.filtrarRechazado = false;
        this.filtrarPendienteGestion = false;
        this.getOfertasInscripcion();
      },
      filtrarRechazados: function () {
        this.filtrarRechazado = !this.filtrarRechazado;
        this.filtrarAceptado = false;
        this.filtrarPendienteGestion = false;
        this.getOfertasInscripcion();
      },
      filtrarInscripcionDependiendoFiltro() {
        if (this.filtrarAceptado) {
          this.inscripcionOfertasFiltradas = this.inscripcionofertas.filter(
            inscripcionOferta => {
              return inscripcionOferta.estado == "A";
            }
          );
        } else if (this.filtrarRechazado) {
          this.inscripcionOfertasFiltradas = this.inscripcionofertas.filter(
            inscripcionOferta => {
              return inscripcionOferta.estado == "R";
            }
          );
        } else if (this.filtrarPendienteGestion) {
          this.inscripcionOfertasFiltradas = this.inscripcionofertas.filter(
            inscripcionOferta => {
              return inscripcionOferta.estado == "D";
            }
          );
        } else {
          this.inscripcionOfertasFiltradas = this.inscripcionofertas;
        }
      },
      getIdPortfolio: function (userId) {
        var devolver = "";
        var url = "portfoliosPerfil/" + userId;
        axios
          .get(url)
          .then(response => {
            devolver = response.data.id;
          })
          .catch(error => {
            portfolios = {
              id: 1
            };
          });
          return devolver
      },
      verPortfolio: function (userId) {
        var url = "/projects?id=" + userId;
        window.location.href = url;
      }
    }
  };
</script>