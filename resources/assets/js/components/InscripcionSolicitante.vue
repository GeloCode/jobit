<template>
    <div>
        <h2>Inscripciones Component</h2>
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
                    <td v-text="oferta.estado == 'D' ? 'Aún no la han visto' 
                    : oferta.estado == 'A' ? 'Aceptado' : 'Rechazado'"></td>
                    <td>
                        <button class="btn btn-secondary" @click.prevent="eliminarInscripcion(oferta.id)">Eliminar</button>
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
    userId: String
  },
  data: function() {
    return {
      ofertas: []
    };
  },
  methods: {
    getOfertasInscripcion: function(page) {
      var url = "ofertas/inscripcion/user/" + this.userId;
      axios.get(url).then(response => {
        this.ofertas = response.data;
      });
    },
    eliminarInscripcion: function(id){
        if (confirm("Estas Seguro?")) {
        var url = "inscripcion/" + id;
        axios.delete(url).then(response => {
          this.getOfertasInscripcion();
          toastr.success("Inscripcion eliminada correctamente!");
        });
      }
    }
  }
};
</script>

