<template>
    <div class="container">
        <div class="form-group" :class="{'has-error' : hasErrors.name}">
            <label for="name" class="col-md-4 control-label">Name</label>

            <div class="col-md-6">
                <input id="name" type="text" class="form-control" name="name"
                        v-model="registerData.name" required autofocus>
                <span v-if="hasErrors.name" class="help-block">
                    <strong>{{errorMessage.name}}</strong>
                </span>
            </div>
        </div>
        <div class="form-group" :class="{'has-error' : hasErrors.telefono}">
            <label for="telefono" class="col-md-4 control-label">telefono</label>

            <div class="col-md-6">
                <input id="telefono" type="text" class="form-control" name="telefono"
                        v-model="registerData.telefono" required autofocus>
                <span v-if="hasErrors.telefono" class="help-block">
                    <strong>{{errorMessage.telefono}}</strong>
                </span>
            </div>
        </div>

        <div class="form-group" :class="{'has-error' : hasErrors.codigo_postal}">
            <label for="codigo_postal" class="col-md-4 control-label">Código postal</label>

            <div class="col-md-6">
                <input id="codigo_postal" type="text" class="form-control" name="codigo_postal"
                        v-model="registerData.codigo_postal" required autofocus>
                <span v-if="hasErrors.codigo_postal" class="help-block">
                    <strong>{{errorMessage.codigo_postal}}</strong>
                </span>
            </div>
        </div>

        <div class="form-group" :class="{'has-error' : hasErrors.direccion}">
            <label for="direccion" class="col-md-4 control-label">Direccion</label>
            <div class="col-md-6">
                <input id="direccion" type="text" class="form-control" name="direccion"
                        v-model="registerData.direccion" required autofocus>
                <span v-if="hasErrors.direccion" class="help-block">
                    <strong>{{errorMessage.direccion}}</strong>
                </span>
            </div>
        </div>
        <div class="form-group">
            <select class="custom-select" name="selectProvincia" v-model="registerData.provincia_id">
                <option value="0" disabled>Elige tu Provincia</option>
                <option v-for="provincia in provincias" :key="provincia.id" :value="provincia.id" v-text="provincia.nombre"></option>
            </select>
        </div>
    </div>
</template>
<script>
export default {
    data: function(){
        return {
            errorMessage: {
                name:null,
                email:null,
                password:null,
                direccion:null,
                telefono:null,
                codigo_postal:null
            }
      }
    },
    methods:{
         getProvincias: function() {
            var url = "provincias";
            axios.get(url).then(response => {
                this.provincias = response.data;
            });
        }
    }
}
</script>
