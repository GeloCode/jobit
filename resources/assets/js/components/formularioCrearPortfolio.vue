<template>
<div>
    <div class="container">
        <form method="POST" v-on:submit.prevent="createPortfolio()">
                <label for="text">Titulo</label>
                <input type="text" name="text" maxlength="45" class="form-control" v-model="portfolio.titulo">
                <div class="form-group">
                            <label for="exampleFormControlTextarea1">Descripcion Portfolio</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" v-model="portfolio.text"></textarea>
                </div>
                <input type="submit" class="btn btn-primary" value="Crear Portfolio">
        </form>
    </div>
</div>
</template>
<script>
import axios from "axios";
import moment from "moment";
import toastr from "toastr";
moment.locale("es");
export default {
  props:{
      userId: String,
  },
  data: function() {
    return {
      proyectos: [],
      infoPortfolio: [],
      idPortfolio: "",
      portfolio: {
        user_id: this.userId,
        titulo: "",
        text: ""
      }
    };
  },
  methods: {
    since: function(d) {
      return moment(d).fromNow();
    },
    createPortfolio: function() {
      var url = "crearPortfolio";
      axios
        .post(url, {
          user_id: this.userId,
          titulo: this.portfolio.titulo,
          text: this.portfolio.text
        })
        .then(response => {
          this.portfolio = response.data;
          this.errors = [];
          toastr.success("Success");
          window.location.href = "/perfil";
        })
        .catch(error => {
          this.errors = error.response.data;
          toastr.danger("Hay algun error");
        });
    }
  }
};
</script>