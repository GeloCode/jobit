<template>
    <div class="container-fluid">
	<div class="row">
		<div class="col-md-4">
			<div class="row">
				<div class="col-md-12">
					<img alt="Bootstrap Image Preview" v-bind:src="profile.imagen" class="rounded-circle">
				</div>
			</div>
			 <a id="perfilForm" href="#perfilForm" role="button" class="btn" data-toggle="modal">Launch demo modal</a>
			
			<div class="modal fade" id="perfilForm" role="dialog" aria-labelledby="modalForm" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="modalForm">
								Modal title
							</h5> 
							<button type="button" class="close" data-dismiss="modal">
								<span aria-hidden="true">×</span>
							</button>
						</div>
						<div class="modal-body">
							...
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-primary">
								Save changes
							</button> 
							<button type="button" class="btn btn-secondary" data-dismiss="modal">
								Close
							</button>
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
    created: function() {
    this.getPerfilByUser();
  },
  data: function() {
    return {
      profile: []
    };
  },
  props: {
    userId: String
  },
  methods: {
    getPerfilByUser: function() {
      var url = "perfil/usuario/" + this.userId;
      axios.get(url).then(response => {
				this.profile = response.data;
      });
    }
  },
  
};
</script>
