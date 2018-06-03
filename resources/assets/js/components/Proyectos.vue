<template>
    <div class="container">
            <div class="row justify-content-between">
                        
                            <div v-for="portfolio in infoPortfolio" :key="portfolio.id" class="card col-md-12">
                                
                                        <div class="card-body">
                                            <center><h4>{{portfolio.titulo}}</h4></center>
                                            <center><p>{{portfolio.text}}</p></center>
                                        </div>
                            </div>
                    </div>
            <center><h2>Proyectos   {{auth}}</h2></center> 
               <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
            Crear Proyecto
            </button>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nuevo Proyecto</h5>
                    
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                        <!-- FORMULARIO -->
                        <form method="POST" v-on:submit.prevent="createProyecto()">
                        <div class="modal-body">
                                    <label for="number">Titulo Proyecto</label>
                                    <input type="text" name="text" maxlength="45" class="form-control" v-model="newTitle">
                                    <div class="form-group">
                                                <label for="text">Descripcion Proyecto</label>
                                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" v-model="newDescription"></textarea>
                                    </div>
                            
                        </div>
                        <div class="modal-footer">
                            <input type="submit" class="btn btn-primary" value="Crear Proyecto">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                        </form>
                         <!-- FIN FORMULARIO -->
                </div>
            </div>
            </div>
            <!-- END MODAL!!!!! -->

                <div class="row justify-content-between">
                            <div v-for="proyecto in proyectos" :key="proyecto.id" class="card col-md-4">
                                <div v-if="proyecto.portfolio_id == portfid">
                               <!-- <p v-if="proyecto.portfolio_id == '3'">-->
                                        <div class="card-body">
                                            <h5>{{proyecto.titulo}}</h5>
                                             <p>{{proyecto.imagen}}</p>
                                            <p>{{proyecto.descripcion}}</p>
                                            <a class="btn btn-success btn-sm" v-bind:href="'/detailProject?id=' + proyecto.id">Ver</a>
                                            <div v-if="useridPerfils == auth">
                                            <a class="btn btn-warning btn-sm" v-bind:href="'/detailProject?id=' + proyecto.id">Editar</a>
                                            <a class="btn btn-danger btn-sm" v-on:click="deleteProyecto(proyecto)">Borrar</a>
                                            </div>
                                        </div>
                                </div>
                            </div>
                    </div>

    </div>
</template>




<script>
    import axios from 'axios'
    import moment from 'moment'
    import toastr from 'toastr'

    moment.locale('es');
    export default {
        props: ['portfid', 'auth'],
        created: function () {
            this.getProyectos(this.portfid);
            this.getInfoPortfolio(this.portfid);
            this.getUserIdProyecto(this.auth);
            this.getUserIdPerfils(this.auth);
        },
        //end
        //aqui almacenamos datos
        data: function(){
            return {
                proyectos: [],
                useridProyecto: '',
                useridPerfils: '',
                infoPortfolio: [],
                newUserid: this.auth,
                newPortfolioid: this.portfid,
                newTitle: '',
                newDescription: '',
                fillProject: {'titulo': '', 'descripcion': ''},
            }
        }, 
        methods: {
            since: function (d) {
                return moment(d).fromNow();
            },
            getProyectos: function (portf_id) {
                var urlProyectos = 'projct/' +portf_id;
                axios.get(urlProyectos).then(response => {
                    this.proyectos = response.data;
                }).catch(error => {
                    proyectos = { 'id': 1 };
                });
            },
            getUserIdProyecto: function (auth){
                var url = "useridProyecto/" + auth;
                 axios.get(url).then(response => {
                    this.useridProyecto = response.data;
                });
            },
            getUserIdPerfils: function (auth){
                var url = "useridPerfils/" + auth;
                 axios.get(url).then(response => {
                    this.useridPerfils = response.data;
                });
            },
            getInfoPortfolio: function (portf_id) {
                var urlPortfolio = 'info/' +portf_id;
                axios.get(urlPortfolio).then(response => {
                    this.infoPortfolio = response.data;
                }).catch(error => {
                    proyectos = { 'id': 1 };
                });
            },
            createProyecto: function(){
                    var url = 'proyectos';
                    axios.post(url, { 
                        user_id: this.newUserid,
                        portfolio_id: this.newPortfolioid,
                        titulo: this.newTitle,
                        descripcion: this.newDescription
                    }).then(response => {
                        this.getProyectos(this.newPortfolioid);
                        this.newUserid = '';
                        this.newPortfolioid = '';
                        this.newTitle = '';
                        this.newDescription = '';
                        this.errors = [];
                        toastr.success('Success');
                    }).catch(error => {
                        this.errors = error.response.data
                    });
            },
              deleteProyecto: function (proyecto) {
                var url = 'proyectos/' + proyecto.id;
                axios.delete(url).then(response => {
                    this.getProyectos();
                    toastr.error('Borrado Correctamente');
                });
            },
            editProyecto: function(proyecto){
                this.fillProject.titulo = proyecto.titulo;
                this.fillProject.descripcion = proyecto.descripcion;
            },

            updateProyecto: function(id){
                var url = 'mobiles/' + id;
                axios.put(url, this.fillMobile).then(response => {
                    this.getMobiles();
                    this.fillMobile = {'id': '', 'user_id': '', 'number': ''};
                    this.errors = [];
                    $('#edit').modal('hide');
                    toastr.success('Actualizado correctamente');
                }).catch(error => {
                    this.errors = error.response.data
                });
            },
        }

    }
</script>