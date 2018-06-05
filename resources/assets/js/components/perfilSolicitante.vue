<!-- ANTONIO -->
<template>
	<div class="container">
		<br>
		<div class="row">
			<div class="col-md-4">
				<div class="row">
					<div class="col-md-12">
						<img alt="Image Preview" :src="profile.imagen == '' ? '../../img/avatar.png' : profile.imagen" style="width:200px;" class="rounded-circle" id="imgForm">
					</div>
				</div>
				<div  class="mostrarEnlaces">
					<enlaces :user-id="userId"></enlaces>
				</div>
			</div>
			<div class="col-md-8">
				<div class="row">
					<div class="col-md-12">
						<h2 v-text="profile.name"></h2>
						<p v-text="profile.descripcion"></p>
						<span v-for="lenguaje in lenguajesArray" :key="lenguaje" class="badge badge-pill badge-dark" v-text="lenguaje"></span>
					</div>
					<div class="col-md-12">
						<span v-for="framework in frameworksArray" :key="framework" class="badge badge-pill badge-dark" v-text="framework"></span>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12" v-if="role.rol_id!=1">
						<proyectos :control="1" :auth="userId" :idperfil="profile.id" :portfid="portfolioId"></proyectos>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>
<script>
import Enlaces from "./Enlaces.vue";
import Proyectos from "./Proyectos.vue";
export default {
  created: function() {
    this.getPerfilByUser();
    this.getPortfolio();
  },
  data: function() {
    return {
      portfolioId: '',
      profile: {
        id: "",
        name: "",
        descripcion: "",
        telefono: "",
        direccion: "",
        codigo_postal: "",
        lenguajes: "",
        frameworks: "",
        imagen: "",
        provincia_id: 0
      },
      lenguajesArray: [],
      lenguajes: "",
      frameworksArray: [],
      frameworks: ""
    };
  },
  props: {
		userId: Number,
	},
  components: {
    enlaces: Enlaces,
    proyectos: Proyectos
  },
  methods: {
    getPerfilByUser: function() {
      var url = "perfil/solicitante/" + this.userId;
      axios.get(url).then(response => {
        if (response.data) {
          console.log(response.data);
          // this.profile = response.data;
          // this.lenguajesArray = this.profile.lenguajes.split(",");
          // this.frameworksArray = this.profile.frameworks.split(",");
        }
      });
    },
    getPortfolio: function() {
      var url = "portfoliosPerfil/" + this.userId;
      axios
        .get(url)
        .then(response => {
          this.portfolioId = response.data.id;
        })
        .catch(error => {
          toastr.error(error);
        });
    }
  }
};
</script>