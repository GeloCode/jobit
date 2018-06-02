!<template>
    <div>
        <header class="header container-fluid">
        <div class="header-img row">
            <form>
                <div class="form-row align-items-center">
                    <div class="col-auto home-form">

                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fa fa-code"></i>
                                </div>
                                <input class="form-control g-font-size-16 border-0 g-height-60 rounded-0" name="te" id="te" maxlength="45" placeholder="Buscar por Tecnología"
                                    aria-label="Buscar por Tecnología" tabindex="1" autocomplete="off" type="text" v-model="search.word">
                            </div>
                        </div>
                    </div>
                    <div class="col-auto home-form">

                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fa fa-map-marker"></i>
                                </div>
                                <select name="pr" id="pr" class="custom-select g-font-size-16 rounded-0 g-height-60 g-min-width-100x border-0" style="" tabindex="2" v-model="search.provincia_id">
                                    <option value="0" disabled>Elige tu Provincia</option>
                                    <option v-for="provincia in provincias" :key="provincia.id" :value="provincia.id" v-text="provincia.nombre"></option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-auto home-form">
                        <button class="btn btn-primary mb-2" type="submit" tabindex="3">
                            Buscar Trabajo </button>
                    </div>
                </div>
            </form>
        </div>
    </header>
    <section class="container-fluid rol-information-section ">
        <div class="row">
            <div class="container rol-container">
                <div class="row">
                    <div class="bs-example" data-example-id="thumbnails-with-custom-content">
                    <h2>APP ROLES</h2>
                        <div class="row">
                            
                            <div class="col-sm-6 col-md-3">
                                <div class="thumbnail">
                                <i class="fa fa-user"></i>
                                    <div class="caption">
                                        <h3>Candidatos</h3>
                                        <p>Encuentra el trabajo que quieres</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <div class="thumbnail">
                                <i class="fa fa-users"></i>
                                    <div class="caption">
                                        <h3>Empresa</h3>
                                        <p>Contrata a los mejores profesionales</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <div class="thumbnail">
                                <i class="fa fa-user-secret"></i>
                                    <div class="caption">
                                        <h3>Administrador</h3>
                                        <p>Nuestros moderadores se aseguran de que obtengaís el mejor servicio</p>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    </div>
</template>
<script>
export default {
    created: function(){
        this.getProvincias();
    },
    data: function (){
        return {
            provincias: [],
            search: {
                word: "",
                provincia_id: 0,
            }
        }
    },
    methods: {
        getProvincias: function() {
        var url = "provincias";
        axios.get(url).then(response => {
            this.provincias = response.data;
        });
        },
    }
}
</script>
