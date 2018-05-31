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
								<form method="POST">
									<label for="name">Name</label>
									<input type="text" name="name">
									<label for="descripcion">Descripcion</label>
									<textarea name="descripcion" cols="30" rows="10"></textarea>
									<label for="provincia">Provincia</label>
									<select name="provincia" id="">
										<option value="0"></option>
									</select>
									<label for="telefono">Telefono</label>
									<input type="text" name="telefono">
									<label for="direccion">Direccion</label>
									<input type="text" name="direccion">
									<label for="codigo_postal">Codigo postal</label>
									<input type="text" name="codigo_postal">
									<label for="lenguajes">Lenguajes</label>
									<input type="text" name="lenguajes">
									<label for="frameworks">Frameworks</label>
									<input type="text" name="frameworks">
									<label for="imagen">Imagen</label>
									<input type="file" name="imagen">
								</form>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
								<button type="button" class="btn btn-primary" v-on:submit.prevent="createProfile()">Save changes</button>
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
						<h2 v-text="profile[0].name"></h2>
						<p v-text="profile[0].descripcion"></p>
						<span v-for="lenguaje in lenguajesArray" :key="lenguaje" class="badge badge-pill badge-dark" v-text="lenguaje"></span>
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
		created: function () {
			this.getPerfilByUser();
			this.splitLenguajes();
		},
		data: function () {
			return {
				profile: [],
				lenguajesArray: []
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
				});
			},
			splitLenguajes: function () {
				var url = "perfil/lenguajes/" + this.userId;
				console.log("aaaaaaaaaaaaaaaaaaaaaaaaa " + this.lenguajesArray);
				this.lenguajesArray = axios.get(url).then(response => {
					this.lenguajesArray = response.data;
					console.log(lenguajesArray);
				});
				console.log(typeof this.lenguajesArray);
				this.lenguajesArray = this.lenguajesArray.split(" ");
			}
		}
	};
</script>