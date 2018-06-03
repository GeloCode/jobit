<template>
    <div>
        <h2>Inscripciones Component</h2>
        <button class="btn btn-primary" @click="filtrarPendientePorGestionar()">Pendientes Gestión</button>
        <button class="btn btn-primary" @click="filtrarAceptados()">Aceptados</button>
        <button class="btn btn-primary" @click="filtrarRechazados()">Rechazados</button>
        <table class="table">
            <thead>
                <tr>
                    <th>Titulo</th>
                    <th>Email</th>
                    <th>Estado</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                <tr :key="inscOferta.id" v-for="inscOferta in inscripcionOfertasFiltradas" 
                :class="inscOferta.estado == 'A' ? 'bg-success' : inscOferta.estado == 'R' ? 'bg-danger' : 'bg-warning'">
                    <td v-text="inscOferta.oferta.titulo"></td>
                    <td v-text="inscOferta.user.email"></td>
                    <td v-text="inscOferta.estado == '-' ? 'Pendiente por Gestionar' 
                    : inscOferta.estado == 'A' ? 'Aceptado' : 'Rechazado'"></td>
                    <td>
                        <button  class="btn btn-primary" @click.prevent="verPortfolio(inscOferta.user.id)">Ver Portfolio</button>
                        <button class="btn btn-primary" @click.prevent="aceptarInscripcion(inscOferta.id)" 
                        v-if="inscOferta.estado != 'A'">Aceptar</button>
                        <button class="btn btn-danger" @click.prevent="rechazarInscripcion(inscOferta.id)"
                        v-if="inscOferta.estado != 'R'">Rechazar</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
<script>
export default {
  created: function() {
    this.getOfertasInscripcion();
  },
  props: {
    userId: String,
    ofertaId: String
  },
  data: function() {
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
    getOfertasInscripcion: function(page) {
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
    eliminarInscripcion: function(id) {
      if (confirm("Estas Seguro?")) {
        var url = "inscripcion/" + id;
        axios.delete(url).then(response => {
          this.getOfertasInscripcion();
          toastr.success("Inscripcion eliminada correctamente!");
        });
      }
    },
    aceptarInscripcion: function(id) {
      var url = "inscripcion/aceptar/" + id;
      axios.get(url).then(response => {
        this.getOfertasInscripcion();
        toastr.success("Inscripcion Aceptada correctamente!");
      });
    },
    rechazarInscripcion: function(id) {
      var url = "inscripcion/rechazar/" + id;
      axios.get(url).then(response => {
        this.getOfertasInscripcion();
        toastr.warning("Inscripcion Rechazada!");
      });
    },
    filtrarPendientePorGestionar: function() {
      this.filtrarRechazado = false;
      this.filtrarAceptado = false;
      this.filtrarPendienteGestion = !this.filtrarPendienteGestion;
      this.getOfertasInscripcion();
    },
    filtrarAceptados: function() {
      this.filtrarAceptado = !this.filtrarAceptado;
      this.filtrarRechazado = false;
      this.filtrarPendienteGestion = false;
      this.getOfertasInscripcion();
    },
    filtrarRechazados: function() {
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
      } else if (this.filtrarPendienteGestion){
        this.inscripcionOfertasFiltradas = this.inscripcionofertas.filter(
          inscripcionOferta => {
            return inscripcionOferta.estado == "D";
          }
        );
      } else {
        this.inscripcionOfertasFiltradas = this.inscripcionofertas;
      }
    },
    getIdPortfolio: function(userId) {
      var url = "pillaridportf/" + userId;
      axios
        .get(url)
        .then(response => {
          this.portfolioId = response.data.id;
        })
        .catch(error => {
          portfolios = { id: 1 };
        });
    },
    verPortfolio: function(userId){
      this.getIdPortfolio(userId);
      window.location.href = "/projects?id=" + this.idPortfolio;
    }
  }
};
</script>

