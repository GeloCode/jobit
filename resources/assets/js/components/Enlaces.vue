<template>
	<div class="list-group">
        <button  v-for="enlace in enlaces" :key="enlace" type="button" class="list-group-item" v-text="enlace.web" @click.prevent="openLink(enlace.enlace)"></button>
    </div>
</template>
<script>
export default {
  created: function() {
      this.getLinks();
        },
  data: function() {
    return {
      enlaces: []
    };
  },
  props: {
    userId: String
  },
  methods: {
    openLink: function(url) {
      window.open(url);
    },
    getLinks: function() {
      var url = "enlaces/" + this.userId;
      axios
        .get(url)
        .then(response => {
          this.enlaces = response.data;
        })
        .catch(error => {
          toastr.error(error);
        });
    }
  }
};
</script>