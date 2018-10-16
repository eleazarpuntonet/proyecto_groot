<template>
    <div class="container">
        <div class="container-fluid mainTitle">
            <div class="row">
                <div class="col"></div>
                <div class="col">
                    <h1>{{ this.perfil.dominio }}</h1>
                </div>
                <div class="col"></div>
            </div>
        </div>


        <div id="formBox" class="container">
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="dominio">Dominio</label>
                  <input readonly type="text" class="form-control" id="dominio" placeholder="Dominio" name="dominio" :value="this.perfil.dominio">
                </div>
                <div class="form-group col-md-6">
                  <label for="hosting">Hosting</label>
                  <input readonly type="text" class="form-control" id="hosting" placeholder="Hosting" name="hosting" :value="this.perfil.hosting">
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="ip_site">Ip del sitio</label>
                  <input readonly type="text" class="form-control" id="ip_site" placeholder="Ip del Sitio" name="ip_site" :value="this.perfil.ip_site">
                </div>
                <div class="form-group col-md-6">
                  <label for="status">Status</label>
                    <input readonly type="text" class="form-control" id="status" placeholder="status" name="status" :value="this.perfil.status">
                </div>
              </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['perfil_show'],
    data() {
        return  {
            // tableHeading : ['Dominio','Hosting','Ip Site','Status','Editar'],
            perfil : '',
            // id:0,
        }
    },
    mounted() {
        this.perfil = JSON.parse(this.perfil_show)
        console.log(this.perfil_show)
    },
    methods:{
        // Metodos
    }
}
</script>

