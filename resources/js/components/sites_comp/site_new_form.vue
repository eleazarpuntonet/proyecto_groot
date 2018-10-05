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
            <!-- {{ csrf_field() }} -->
            <div class="form-group col-md-6">
              <label for="dominio">Dominio</label>
              <input type="text" class="form-control" id="dominio" placeholder="Dominio" name="dominio" value="" v-model="dominio">
            </div>
            <div class="form-group col-md-6">
                <label for="hosting">Hosting</label>
                <select name="hosting" class="form-control hostingSelect" v-model="hosting">
                  <option>Seleccione un Hosting</option>
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
            // tableHeading : ['Dominio','Hosting','Ip Site','Status','Editar'],
            urlStore : route('sites.store'),
            // id:0,
        }
    },
    mounted() {
        // this.perfil = JSON.parse(this.perfil_show)
        // console.log(this.perfil_show)
    },
    methods:{
        newSiteForm()
        {
            console.log(route('sites.store'))
            return route('sites.store')
        },
        onSubmit(){
            alert("Hola ")
            return axios.post(route('sites.store'))
        }
    }
}
</script>

