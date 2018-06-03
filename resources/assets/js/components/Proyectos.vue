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
            <center><h2>Proyectos</h2></center> 
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


            <!-- MODAL edit!!!!!!-->
      <div class="modal fade" id="editProject" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nuevo Proyecto</h5>
                    
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                        <!-- FORMULARIO -->
                        <form method="POST" v-on:submit.prevent="updateProyecto(fillProject.id)">
                        <div class="modal-body">
                                    <label for="titulo">Titulo Proyecto</label>
                                    <input type="text" name="titulo" maxlength="45" class="form-control" v-model="fillProject.titulo">
                                    <div class="form-group">
                                                <label for="descripcion">Descripcion Proyecto</label>
                                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" v-model="fillProject.descripcion"></textarea>
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
                                            <div>
                                           <a href="#" class="btn btn-warning btn-sm" v-on:click.prevent="editProyecto(proyecto)">Editar Proyecto</a>
                                            <a class="btn btn-danger btn-sm" v-on:click="deleteProyecto(proyecto)">Borrar</a>
                                            </div>
                                        </div>
                                </div>
                            </div>
                    </div>
                    <nav>
                        <ul class="pagination">
                            <li class="page-item" v-if="pagination.current_page > 1">
                                <a class="page-link" href="#" @click.prevent="changePage(pagination.current_page - 1)">
                                    <span> Atras</span>
                                </a>
                            </li>

                            <li class="page-item" v-for="page in pagesNumber" :key="page" v-bind:class="[ page == isActived ? 'active' : '']"> 
                                <a class="page-link" href="#" @click.prevent="changePage(page)">
                                    {{page}}
                                </a>
                            </li>
                            <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                                <a class="page-link" href="#" @click.prevent="changePage(pagination.current_page + 1)">Siguiente</a>
                            </li>
                        </ul>
                    </nav>

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
                fillProject: {'id':'', 'titulo': '', 'descripcion': ''},
                 pagination: {
                    total: 0,
                    current_page: 0,
                    per_page: 0,
                    last_page: 0,
                    from: 0,
                    to: 0
                },
                offset: 2,
            }
        }, 
        computed: {
            isActived: function (){
                return this.pagination.current_page;
            },
            pagesNumber: function(){
                if(!this.pagination.to){
                    return [];
                }
                var from =  this.pagination.current_page - this.offset; 
                if (from < 1){
                    from = 1;
                }

                var to = from + (this.offset * 2); 
                if (to >= this.pagination.last_page){
                    to = this.pagination.last_page;
                }
                
                 var pagesArray = [];
                 while  (from <= to){
                     pagesArray.push(from);
                     from++;
                 }
                 return pagesArray;
            }
        },
        methods: {
            since: function (d) {
                return moment(d).fromNow();
            },
            getProyectos: function (portf_id, page) {
                var urlProyectos = 'projct/' +portf_id + '?page=' + page;
                axios.get(urlProyectos).then(response => {
                    this.proyectos = response.data.proyectos.data;
                    this.pagination = response.data.pagination
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
                    toastr.success('Borrado Correctamente');
                    this.getProyectos(this.newPortfolioid);
                });
            },
            editProyecto: function(proyecto){
                this.fillProject.id = proyecto.id;
                this.fillProject.titulo = proyecto.titulo;
                this.fillProject.descripcion = proyecto.descripcion;
                  $('#editProject').modal('show');
            },

            updateProyecto: function(idProject){
                var url = 'proyectos/' + idProject;
                axios.put(url, this.fillProject).then(response => {
                    this.getProyectos(this.newPortfolioid);
                    this.fillProject = {'id':'', 'titulo': '', 'descripcion': ''};
                     $('#editProject').modal('hide');
                    toastr.success('Actualizado correctamente');
                }).catch(error => {
                    this.errors = error.response.data
                });
            },
             changePage: function (page){
                this.pagination.current_page = page;
                this.getProyectos(this.newPortfolioid, page);
            },
        }

    }
</script>