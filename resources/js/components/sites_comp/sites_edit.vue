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
                    <form :action="urlEdit" method="POST">
                        <input type="hidden" name="_token" :value="csrf">
                        <input name="_method" type="hidden" value="PUT">
                        
                      <div class="form-row">
                        <div class="form-group col-md-6">
                          <label for="dominio">Dominio</label>
                          <input type="text" class="form-control" id="dominio" placeholder="Dominio" name="dominio" :value="this.perfil.dominio">
                        </div>
                        <div class="form-group col-md-6">
                          <label for="hosting">Hosting</label>
                          <input type="text" class="form-control" id="hosting" placeholder="Hosting" name="hosting" :value="this.perfil.hosting">
                        </div>
                      </div>
                      <div class="form-row">
                        <div class="form-group col-md-6">
                          <label for="ip_site">Ip del sitio</label>
                          <input type="text" class="form-control" id="ip_site" placeholder="Ip del Sitio" name="ip_site" :value="this.perfil.ip_site">
                        </div>
                        <div class="form-group col-md-6">
                          <label for="status">Status</label>
                            <input type="text" class="form-control" id="status" placeholder="status" name="status" :value="this.perfil.status">
                        </div>
                      </div>
                      <button type="submit" class="btn btn-primary">Enviar</button>
                  </form>
              </div>
          </div>
</template>

<script>
export default {
    props: ['perfil_edit','info'],
    data() {
        return  {
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            perfil : '',
            urlEdit: '',
        }
    },
    mounted() {
        this.perfil = JSON.parse(this.perfil_edit)
        this.urlEdit = route('sites.update',this.perfil.id)
    },
    methods:{
        updSite(id){
            return axios.post(route('sites.update',this.perfil.id),{ _method: 'PUT'})
                        .then((res)=>{
                            console.log(res);
                        })
                        .catch((error) => {
                            console.log(error)
                            // Error
                            if (error.response) {
                                // El request fue enviado pero el servidor
                                //respondio con un codigo de error
                                console.log(error.response.data);
                                console.log(error.response.status);
                                console.log(error.response.headers);
                            } else if (error.request) {
                                console.log("The request was made but no response was received")
                                // The request was made but no response was received
                                // `error.request` is an instance of XMLHttpRequest in the browser and an instance of
                                // http.ClientRequest in node.js
                                console.log(error.request);
                            } else {
                                // Something happened in setting up the request that triggered an Error
                                console.log('Something happened in setting up the request that triggered an Error', error.message);
                            }
                        });
        },
    }
}
</script>

