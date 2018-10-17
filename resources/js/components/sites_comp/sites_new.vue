<template>
<div class="container">
    
    <div class="container-fluid mainTitle">
        <div class="row">
            <div class="col"></div>
            <div class="col">
                <h1>Registro de Sitio</h1>
            </div>
            <div class="col"></div>
        </div>
    </div>

    <div v-if="info==='true'" class="container infoTitle">
        <div class="row">
            <div class="col"></div>
            <div class="col">
              {{info}}
            </div>
            <div class="col"></div>
        </div>
    </div>

    <div id="formBox" class="container">
        <form :action="urlStore" method="POST" @submit="onSubmit()">
            <input type="hidden" name="_token" :value="csrf">
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="dominio">Dominio</label>
              <input type="text" class="form-control" id="dominio" placeholder="Dominio" name="dominio" value="" v-model="dominio">
            </div>
            <div class="form-group col-md-6">
                <label for="hosting">Hosting</label>
                <select name="hosting" class="form-control" v-model="hosting">
                    <option v-for="item in this.$store.getters.showHost" :value="item.id">
                    {{item.nombre}}
                    </option>
                </select>
                
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="ip_site">Ip del sitio</label>
              <input type="text" class="form-control" id="ip_site" placeholder="Ip del Sitio" name="ip_site" value="" v-model="ip_site">
            </div>
            <div class="form-group col-md-6">
                <label for="status">Status</label>
                <select name="status" class="form-control" v-model="status">
                  <option>ACTIVO</option>
                  <option>INACTIVO</option>
                </select>
            </div>
          </div>
          <button type="submit" class="btn btn-primary">Enviar</button>
        </form>
    </div>

</div>
</template>

<script>
export default {
    props: ['info'],
    data() {
        return  {
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            dominio : '',
            hosting : '',
            ip_site : '',
            status  : '',
            urlStore : route('sites.store'),
        }
    },
    mounted() {
        // console.log("Componente")
        // console.log(this.$store.getters.showHost)
    },
    methods:{
        newSiteForm()
        {
            return route('sites.store')
        },
        onSubmit(){
            return axios.post(route('sites.store'))
        }
    },

}
</script>

