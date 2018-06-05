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
            <button type="button" class="btn btn-xl btn-primary" data-toggle="modal" data-target="#profileModal">
              Editar perfil
            </button>
        </div>
    </header>
    <div class="d-none">
        <img alt="Image Preview" src="" style="width:200px;" class="rounded-circle" id="imgForm">
    </div>
    <div class="container-fluid enlace-container">
				<!-- Button trigger modal -->
				<div  class="mostrarEnlaces">
					<enlaces :user-id="userId"></enlaces>
				</div>
    </div>
				<!-- Modal -->
				<div class="modal fade" id="profileModal" tabindex="-1" role="dialog" aria-labelledby="profileModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="profileModalLabel">Editar perfil</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<form v-on:submit.prevent="createProfile()" enctype="multipart/form-data">
									<div class="form-group">
										<input type="text" class="form-control" id="nameInput" aria-describedby="name"
										v-model="profile.name">
										<small id="name" class="form-text text-muted">Ej. Antonio</small>
                    <br>
                    <span v-if="msg.name">
                        <small v-text="msg.name" class="text-danger"></small>
                    </span>
									</div>
									<div class="form-group">
										<textarea name="descripcion" rows="4" cols="60" v-model="profile.descripcion"></textarea>
										<small id="name" class="form-text text-muted">Pequeña descripción del usuario</small>
                    <br>
                    <span v-if="msg.descripcion">
                        <small v-text="msg.descripcion" class="text-danger"></small>
                    </span>
									</div>
									<div class="form-group">
										<select class="custom-select mb-1" name="selectProvincia" v-model="profile.provincia_id">
											<option value="0">Elige tu Provincia</option>
											<option v-for="provincia in provincias" :key="provincia.id" :value="provincia.id" v-text="provincia.nombre"></option>
										</select>
									</div>
									<div class="form-group">
										<label for="telefono">Telefono</label>
										<input type="text" name="telefono" v-model="profile.telefono">
                    <br>
                    <span v-if="msg.telefono">
                        <small v-text="msg.telefono" class="text-danger"></small>
                    </span>
									</div>
									<div class="form-group">
										<label for="direccion">Direccion</label>
										<input type="text" name="direccion" v-model="profile.direccion">
                    <br>
                    <span v-if="msg.direccion">
                        <small v-text="msg.direccion" class="text-danger"></small>
                    </span>
									</div>
									<div class="form-group">
										<label for="codigo_postal">Codigo postal</label>
										<input type="text" name="codigo_postal" v-model="profile.codigo_postal">
                    <br>
                    <span v-if="msg.codigo_postal">
                        <small v-text="msg.codigo_postal" class="text-danger"></small>
                    </span>
									</div>
									<div class="form-group">
										<label for="lenguajes">Lenguajes</label>
										<input type="text" name="lenguajes" v-model="profile.lenguajes">
									</div>
									<div class="form-group">
										<label for="frameworks">Frameworks</label>
										<input type="text" name="frameworks" v-model="profile.frameworks">
									</div>
									<div class="form-group">
										<label for="imagen">Imagen</label>
										<input type="file" name="imagen" @change="processFile($event)">
									</div>
									<button type="submit" class="btn btn-primary">Submit</button>
									
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
								</form>
							</div>
						</div>
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
      
					<div v-if="role.rol_id!=1">
						<proyectos :control="2" :auth="userId" :idperfil="profile.id" :portfid="portfolioId"></proyectos><!-- hashid es el id del // -->
						<!--Aqui los proyectos-->
						<span v-text="portfolioId"></span>
					
        </div>
			</div>
</template>
<script>
import Enlaces from "./Enlaces.vue";
import Proyectos from "./Proyectos.vue";
export default {
  created: function() {
    this.getPerfilByUser();
    this.getRole();
    this.getProvincias();
    if(this.role!=1){
      this.getPortfolio();
    }
    window.addEventListener("load", function(event) {
      if (window.location.hash === "#execute") {
        $("#profileModal").modal("toggle");
      }
    });
  },
  data: function() {
    return {
			provincias: [],
      portfolioId: '',
      role:{
        rol_id:0
      },
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
      frameworks: "",
      provinciaId: 0,
      msg: []
    };
  },
  props: {
		userId: String,
	},
  components: {
    enlaces: Enlaces,
    proyectos: Proyectos
  },
  watch: {
    'profile.imagen': function(){
        $('#cambiarImagen').css('background-image', this.profile.imagen);
    },
    'profile.name': function(value){
        this.profile.name = value;
        this.checkLengthMax(value, 45, "name");
    },
    'profile.descripcion': function(value){
        this.profile.descripcion = value;
        this.checkLengthMax(value, 255, "descripcion");
    },
    'profile.telefono': function(value){
        this.profile.telefono = value;
        this.checkTelefono(value);
    },
    'profile.direccion': function(value){
        this.profile.direccion = value;
        this.checkLengthMax(value, 120, "direccion");
    },
    'profile.codigo_postal': function(value){
        this.profile.codigo_postal = value;
        this.checkCodigoPostal(value);
    }
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
    createProfile: function() {
      if(this.checkValidaciones()){
        var myMethod = "post";
        var url = "iperfil";
        if (this.profile.id) {
          myMethod = "put";
          url += "/" + this.userId;
        }
        axios({
          method: myMethod,
          url: url,
          data: {
            user_id: this.userId,
            provincia_id: this.profile.provincia_id,
            name: this.profile.name,
            telefono: this.profile.telefono,
            direccion: this.profile.direccion,
            descripcion: this.profile.descripcion,
            codigo_postal: this.profile.codigo_postal,
            lenguajes: this.profile.lenguajes,
            frameworks: this.profile.frameworks,
            imagen: $("#imgForm").attr("src")
          },
          msg: [],
        })
          .then(response => {
            this.openCloseModal();
            this.getPerfilByUser();
            toastr.success("Perfil actualizado correctamente");
            if (this.first) {
              window.location.assign("/perfil");
            }
          })
          .catch(function(error) {
            toastr.error(error);
          });
        }
    },
    getProvincias: function() {
      var url = "provincias";
      axios.get(url).then(response => {
        this.provincias = response.data;
      });
    },
    processFile(event) {
      this.profile.imagen = event.target.files[0];
      var reader = new FileReader();

      reader.addEventListener("load",function() {
         $('#imgForm').attr('src', reader.result);
        },
        false
      );

      if (this.profile.imagen) {
        reader.readAsDataURL(this.profile.imagen);
      }
    },
    openCloseModal: function() {
      $("#profileModal").modal("toggle");
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
    },
    getRole: function(){
      var url = "/isEmpleado/" + this.userId;
      axios.get(url).then(response=>{
        this.role.rol_id=response.data.rol_id;
      }).catch(error=>{
        toastr.error(error);
      });
    },
    checkLengthMax(value, longitud, nombre) {
        if (value.length > longitud) {
            this.msg[nombre] =
                "La longitud máxima de este campo es " +
                longitud;
        } else {
            this.msg[nombre] = "";
            return true;
        }
    },
    checkTelefono(value) {
        if(/^[\d]{3}[-]*([\d]{2}[-]*){2}[\d]{2}$/.test(value)){
          this.msg["telefono"] = "";
        } else {
          this.msg["telefono"] = "El número introducido está en un formato incorrecto";
        }
    },
    checkCodigoPostal(value){
      if(/^(?:0[1-9]|[1-4]\d|5[0-2])\d{3}$/.test(value)){
        this.msg["codigo_postal"] = "";
      } else {
        this.msg["codigo_postal"] = "El código postal está en un formato incorrecto";
      }
    },
    checkValidaciones(){
      var errores = "";
      if(this.msg["name"] != ""){
        errores += "El nombre es incorrecto <br>";
      }
      if(this.msg["descripcion"] != ""){
        errores += "La descripción es incorrecta <br>";
      }
      if(this.msg["telefono"] != ""){
        errores += "El telefono es incorrecto <br>";
      }
      if(this.msg["direccion"] != ""){
        errores += "La direccion es incorrecta <br>";
      }
      if(this.msg["codigo_postal"] != ""){
        errores += "El código postal es incorrecto <br>";
      }
      if(this.profile.lenguajes == ""){
        errores += "Introduce lenguajes <br>"
      }
      if(this.profile.frameworks == ""){
        errores += "Introduce frameworks <br>"
      }
      if(this.profile.provincia_id == 0){
        errores += "Porfavor, elige una provincia <br>";
      }
      toastr.error(errores);
      if(errores.length > 0){
        return false;
      }
    }
  }
};
</script>