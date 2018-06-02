<template>
	<div class="container">
		<br>
		<div class="row">
			<div class="col-md-4">
				<div class="row">
					<div class="col-md-12">
						<img alt="Image Preview" src="../../img/avatar.png" style="width:200px;" class="rounded-circle">
					</div>
				</div>
				<br>
				<!-- Button trigger modal -->
				<button type="button" class="btn btn-xl btn-primary" data-toggle="modal" data-target="#exampleModal">
					Editar perfil
				</button>

				<!-- Modal -->
				<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<form v-on:submit.prevent="createProfile()">
									<div class="form-group">
										<input type="text" class="form-control" id="nameInput" aria-describedby="name"
										v-model="profile.name">
										<small id="name" class="form-text text-muted">Ej. Antonio</small>
									</div>
									<div class="form-group">
										<textarea name="descripcion" rows="4" cols="60" v-model="profile.descripcion"></textarea>
										<small id="name" class="form-text text-muted">Pequeña descripción del usuario</small>
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
									</div>
									<div class="form-group">
										<label for="direccion">Direccion</label>
										<input type="text" name="direccion" v-model="profile.direccion">
									</div>
									<div class="form-group">
										<label for="codigo_postal">Codigo postal</label>
										<input type="text" name="codigo_postal" v-model="profile.codigo_postal">
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
										<input type="file" name="imagen">
									</div>
									<button type="submit" class="btn btn-primary">Submit</button>
									
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
								</form>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
					</div>
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
					<div class="col-md-12">
						<!--Aqui los proyectos-->
					</div>
				</div>
			</div>
		</div>
	</div>
</template>
<script>
export default {
  created: function() {
    this.getPerfilByUser();
    this.getProvincias();
  },
  data: function() {
    return {
      provincias: [],
      profile: {
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
      provinciaId: 0
    };
  },
  props: {
    userId: String
  },
  methods: {
    getPerfilByUser: function() {
      var url = "perfil/usuario/" + this.userId;
      axios.get(url).then(response => {
				if(response.data){
					this.profile = response.data;
					this.lenguajesArray = this.profile.lenguajes.split(",");
					this.frameworksArray = this.profile.frameworks.split(",");
				}
      });
    },
    createProfile: function() {
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
          frameworks: this.profile.frameworks
        }
      }).then(response => {
				$("#exampleModal").modal('toggle');
				this.getPerfilByUser();
			})
        .catch(function(error) {
          toastr.error(error);
        });
    },
    getProvincias: function() {
      var url = "provincias";
      axios.get(url).then(response => {
        this.provincias = response.data;
      });
    }
  }
};
</script>