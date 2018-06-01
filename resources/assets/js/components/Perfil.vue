<template>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-4">
				<div class="row">
					<div class="col-md-12">
						<img alt="Bootstrap Image Preview" v-bind:src="profile.imagen" class="rounded-circle">
					</div>
				</div>
				<!-- Button trigger modal -->
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
					Launch demo modal
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
								<form method="POST" v-on:submit.prevent="createProfile()">
									<div class="form-group">
										<input type="text" class="form-control" id="nameInput" aria-describedby="name" placeholder="Nombre">
										<small id="name" class="form-text text-muted">Ej. Antonio</small>
									</div>
									<div class="form-group">
										<textarea name="descripcion" rows="4" cols="60"></textarea>
										<small id="name" class="form-text text-muted">Pequeña descripción del usuario</small>
									</div>
									<div class="form-group">
										<select class="custom-select mb-1" name="selectProvincia" v-model="provinciaId">
											<option value="0">Elige tu Provincia</option>
											<option v-for="provincia in provincias" :key="provincia.id" :value="provincia.id" v-text="provincia.nombre"></option>
										</select>
									</div>
									<div class="form-group">
										<label for="telefono">Telefono</label>
										<input type="text" name="telefono">
									</div>
									<div class="form-group">
										<label for="direccion">Direccion</label>
										<input type="text" name="direccion">
									</div>
									<div class="form-group">
										<label for="codigo_postal">Codigo postal</label>
										<input type="text" name="codigo_postal">
									</div>
									<div class="form-group">
										<label for="lenguajes">Lenguajes</label>
										<input type="text" name="lenguajes">
									</div>
									<div class="form-group">
										<label for="frameworks">Frameworks</label>
										<input type="text" name="frameworks">
									</div>
									<div class="form-group">
										<label for="imagen">Imagen</label>
										<input type="file" name="imagen">
									</div>
									<button type="submit" class="btn btn-primary">Submit</button>
								</form>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
								<button type="button" class="btn btn-primary">Save changes</button>
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
		{{profile}}
	</div>
</template>
<script>
	export default {
		created: function () {
			this.getPerfilByUser();
			this.getProvincias();
		},
		data: function () {
			return {
				provincias:[],
				profile: {},
				profileData: {
					name: "",
					descripcion: "",
					telefono: "",
					direccion: "",
					codigo_postal: "",
					lenguajes: "",
					frameworks: "",
					imagen: "",
					user_id: this.userId
				},
				lenguajesArray: [],
				lenguajes: "",
				frameworksArray: [],
				frameworks: "",
				provinciaId: 0,
			};
		},
		props: {
			userId: String
		},
		methods: {
			getPerfilByUser: function () {
				var url = "perfil/usuario/" + this.userId;
				axios.get(url).then(response => {
					this.profile = response.data;
					this.lenguajesArray = this.profile.lenguajes.split(",");
					this.frameworksArray = this.profile.frameworks.split(",");
				});
			},
			createProfile: function () {
				axios.post("perfil/store", this.profileData).then(function (response) {
				}).catch(function (error) {
						toastr.error(error);
					});
			},
			getProvincias: function () {
				var url = "provincias";
				axios.get(url).then(response => {
					this.provincias = response.data;
				});
			}
		}
	};
</script>