<template>
    <div class="container" id="inscripciones-solicitante">
        <h2>Inscripciones</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Titulo</th>
                    <th>Estado</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                <tr :key="oferta.id" v-for="oferta in ofertas" 
                :class="oferta.estado == 'A' ? 'bg-success' : oferta.estado == 'R' && 'bg-danger'">
                    <td v-text="oferta.titulo"></td>
                    <td v-text="oferta.estado == '-' ? 'Aún no la han visto' 
                    : oferta.estado == 'A' ? 'Aceptado' : 'Rechazado'"></td>
                    <td>
                        <button class="btn btn-secondary" data-toggle="modal" data-target="#Oferta" 
                        @click="verOferta(oferta.oferta_id)">Ver Oferta</button>
                        <button class="btn btn-secondary" @click.prevent="eliminarInscripcion(oferta.id)">Eliminar</button>
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- Modal -->
				<div class="modal fade" id="Oferta" tabindex="-1" role="dialog" aria-labelledby="OfertaLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="OfertaLabel">Modal title</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
                <h2 v-text="oferta.titulo"></h2>
                <h2 v-text="oferta.descripcion"></h2>
                <h2 v-text="oferta.sueldo_desde"></h2>
                <h2 v-text="oferta.sueldo_hasta"></h2>
							</div>
						</div>
					</div>
				</div>
    </div>
</template>
<script>
export default {
  created: function() {
    this.getOfertasInscripcion();
  },
  props: {
    userId: String
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
      }
    };
  },
  methods: {
    getOfertasInscripcion: function(page) {
      var url = "ofertas/inscripcion/user/" + this.userId;
      axios.get(url).then(response => {
        this.ofertas = response.data;
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
    verOferta: function(id) {
      var url = "oferta/" + id;
      axios.get(url).then(response => {
        this.oferta = response.data;
      });
    }
  }
};
</script>

