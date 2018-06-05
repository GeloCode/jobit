<!-- ANTONIO -->
<template>
	 <div id="perfil">
		<header class="header container-fluid">
        <div class="header-img row">
            <div class="col-md-12 img-perfil-container">
              <div class="img-perfil-box">
              <div class="img-perfil" v-bind:style="{ 'background-image': 'url(' +profile.imagen+ ')' }" id="cambiarImagen"></div>
              </div>
            </div>
            <button type="button" class="btn btn-xl btn-primary" data-toggle="modal" data-target="#profileModal" v-if="perfildesdeempresa !=1">
              Editar perfil
            </button>
        </div>
    </header>
    <div class="d-none">
        <img alt="Image Preview" src="" style="width:200px;" class="rounded-circle" id="imgForm">
    </div>
    <div class="container-fluid enlace-container">
				<div  class="mostrarEnlaces">
					<enlaces :controlarenlaces="perfildesdeempresa" :user-id="userId"></enlaces>
				</div>
    </div>
			<div class="container datos-personales">
				<div class="row">
					<div class="col-md-8">
						<h2 v-text="profile.name"></h2>
						<p v-text="profile.descripcion"></p>
						
					</div>
					<div class="col-md-4">
            <h3>Lenguajes:</h3>
            <span v-for="lenguaje in lenguajesArray" :key="lenguaje" class="badge badge-pill badge-dark" v-text="lenguaje"></span>
						<h3>Frameworks:</h3>
            <span v-for="framework in frameworksArray" :key="framework" class="badge badge-pill badge-dark" v-text="framework"></span>
					</div>
				</div>
			</div>
					<div>
						<proyectos :control="2" :auth="userId" :idperfil="profile.id" :portfid="portfolioId"></proyectos><!-- hashid es el id del // -->
						<!--Aqui los proyectos-->
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
		userId: String,
    perfildesdeempresa: String
	},
  components: {
    enlaces: Enlaces,
    proyectos: Proyectos
  },
  methods: {
    getPerfilByUser: function() {
      var url = "perfil/usuario/" + this.userId;
      axios.get(url).then(response => {
        if (response.data) {
          this.profile = response.data;
          this.lenguajesArray = this.profile.lenguajes.split(",");
          this.frameworksArray = this.profile.frameworks.split(",");
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