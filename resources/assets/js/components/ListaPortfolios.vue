<template>
    <div class="container">
        <center>
            <h2>Los portfolios</h2>
        </center>
        <div class="row">
            <div v-for="portfolio in portfolios" :key="portfolio.id" class="card col-md-4">
                <div v-for="nombre in nameUser" :key="nombre.id">
                    <small>
                        <p v-if="portfolio.user_id === nombre.id">Por:
                            <b>{{nombre.name}}</b>
                        </p>
                    </small>
                </div>
                <div class="card-body">
                    <h5 class="card-title" v-text="portfolio.titulo"> </h5>
                    <p class="card-text" v-text="portfolio.text"> </p>
                    <!--a href="#" class="btn btn-danger btn-sm" v-on:click.prevent="deletePortfolio(portfolio)">Borrar</a>-->
                    <a class="btn btn-success btn-sm" v-bind:href="'/projects?id=' +portfolio.id">Ver</a>
                    <div class="col-md-5 offset-md-7">
                        <small>
                            {{ since(portfolio.created_at)}}
                        </small>
                    </div>
                    <hr>
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
import axios from "axios";
import moment from "moment";
import toastr from "toastr";
moment.locale("es");
export default {
  //llamada a la funcion
  //en cuanto se cree! (created), que se haga la funcion
  created: function() {
    this.getPortfolios();
    this.getNames();
  },
  //end
  //aqui almacenamos datos
  data: function() {
    return {
      portfolios: [],
      newUser_id: "",
      newPortfolioTitulo: "",
      newPortfolioDescripcion: "",
      nameUser: [],
      pagination: {
        total: 0,
        current_page: 0,
        per_page: 0,
        last_page: 0,
        from: 0,
        to: 0
      },
      offset: 2 //esta variable decide cuantos numeros habrán despues y antes de la pagina actual
    };
  },
  computed: {
    isActived: function() {
      return this.pagination.current_page;
    },
    pagesNumber: function() {
      if (!this.pagination.to) {
        return [];
      }
      var from = this.pagination.current_page - this.offset;
      if (from < 1) {
        from = 1;
      }

      var to = from + this.offset * 2;
      if (to >= this.pagination.last_page) {
        to = this.pagination.last_page;
      }

      var pagesArray = [];
      while (from <= to) {
        pagesArray.push(from);
        from++;
      }
      return pagesArray;
    }
  },
  components: {
    //'proyectos' :Proyectos
  },
  //end
  //funcionalidad. aqui se llama a laravel y que te pase datos.
  methods: {
    since: function(d) {
      return moment(d).fromNow();
    },
    changePage: function(page) {
      this.pagination.current_page = page;
      this.getPortfolios(page);
    },
    getPortfolios: function(page) {
      var urlPortfolios = "portfolios?page=" + page;
      axios
        .get(urlPortfolios)
        .then(response => {
          (this.portfolios = response.data.portfolios.data),
            (this.pagination = response.data.pagination);
        })
        .catch(error => {
          portfolios = { id: 1 };
        });
    },
    showPortfolio: function(portfolio) {
      var urlPortfolio = "portfolio" + portfolio.id;
      axios
        .get(urlPortfolio)
        .then(response => {
          this.portfolio = response.data;
        })
        .catch(error => {
          portfolios = { id: 1 };
        });
    },
    getNames: function() {
      var url = "selectName";
      axios
        .get(url)
        .then(response => {
          this.nameUser = response.data;
        })
        .catch(error => {
          portfolios = { id: 1 };
        });
    },
    createPortfolio: function() {
      var urlportf = "crearPortfolio";
      axios
        .post(urlportf, {
          user_id: this.newUser_id,
          titulo: this.newPortfolioTitulo,
          descripcion: this.newPortfolioDescripcion
        })
        .then(response => {
          this.getPortfolios();
          this.newUser_id = "";
          this.newPortfolioTitulo = "";
          this.newPortfolioDescripcion = "";
          toastr.success("Portfolio creado con exito");
        })
        .catch(error => {
          toastr.error("Error al crear el portfolio");
        });
    },
    deletePortfolio: function(portfolio) {
      var url = "portfolios/" + portfolio.id;
      axios.delete(url).then(response => {
        this.getPortfolios();
        toastr.error("Borrado Correctamente");
      });
    },
    getPortfolioById: function(portfolio) {
      let url = (window.location.href = "/portfolio/" + portfolio.id);
      axios.get(url);
    }
  }
};
</script>