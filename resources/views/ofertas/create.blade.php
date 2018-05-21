<form method="post" v-on:submit.prevent="createClase">
        <div class="modal fade" id="create">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4>Nueva Oferta</h4>
                        <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
    
                    </div>
                    <div class="modal-body">
                        <label for="titulo">Titulo de la Oferta</label>
                        <input type="text" name="titulo" class="form-control" v-model="newTitulo">
                        <label for="descripcion">Descripción de la Oferta</label>
                        <textarea name="descripcion" class="form-control" v-model="newDescripcion"></textarea>
                        <label for="vacantes">Vacantes</label>
                        <input type="number" name="vacantes" class="form-control">
                    </div>
                    <div class="modal-footer">
                        <input type="submit" class="btn btn-primary" value="Guardar">
                    </div>
                </div>
            </div>
        </div>
    </form>