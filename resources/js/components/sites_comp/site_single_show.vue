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
        updSite(id){
            return axios.post(route('sites.update',this.perfil.id),{ _method: 'PUT'})
                        .then((res)=>{
                            console.log(res);
                        })
                        .catch((error) => {
                            // console.log(error)
                            // Error
                            if (error.response) {
                                console.log('Error Response')
                                console.log(error.response.data.message)
                                alert('No autorizado')
                                // The request was made and the server responded with a status code
                                // that falls out of the range of 2xx
                                // console.log(error.response.data);
                                // console.log(error.response.status);
                                // console.log(error.response.headers);
                            } else if (error.request) {
                                console.log("The request was made but no response was received")
                                // console.log(error.response)
                                // The request was made but no response was received
                                // `error.request` is an instance of XMLHttpRequest in the browser and an instance of
                                // http.ClientRequest in node.js
                                console.log(error.request);
                            } else {
                                // Something happened in setting up the request that triggered an Error
                                console.log('Something happened in setting up the request that triggered an Error', error.message);
                            }
                            // console.log(error.config);
                        });
        },
    }
}
</script>

