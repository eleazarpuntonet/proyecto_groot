<template>
    <div class="container">
        
            <div class="container-fluid mainTitle">
                <div class="row">
                    <div class="col"></div>
                    <div class="col">
                        <h1>Registro de Credenciales</h1>
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
                    <!-- 
                    *
                    *Campos  obligatorios para poder procesar
                    *el request correctamente en laravel
                    *
                     -->
                    <input type="hidden" name="_token" :value="csrf">
                    <input name="_method" type="hidden" value="PUT">
                     <!-- 
                     *
                     *
                     * -->
                      <div class="form-row">
                        <div class="form-group col-md-6">
                          <label for="id_site">Site</label>
                          <input type="text" class="form-control" id="id_site" placeholder="id_site" name="id_site" :value="this.perfil.id_site">
                        </div>
                        <div class="form-group col-md-6">
                          <label for="descripcion">Descripcion</label>
                          <input type="text" class="form-control" id="descripcion" placeholder="descripcion" name="descripcion" :value="this.perfil.descripcion">
                        </div>
                      </div>
                      <div class="form-row">
                        <div class="form-group col-md-4">
                          <label for="user">User</label>
                          <input type="text" class="form-control" id="user" placeholder="Ip del Sitio" name="user" :value="this.perfil.user">
                        </div>
                        <div class="form-group col-md-4">
                          <label for="passw">Passw</label>
                            <input type="text" class="form-control" id="passw" placeholder="passw" name="passw" :value="this.perfil.passw">
                        </div>
                        <div class="form-group col-md-4">
                          <label for="comentarios">Comentarios</label>
                            <input type="text" class="form-control" id="comentarios" placeholder="comentarios" name="comentarios" :value="this.perfil.comentarios">
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
            // tableHeading : ['Dominio','Hosting','Ip Site','Status','Editar'],
            perfil : '',
            // id:0,
            urlEdit: '',
        }
    },
    mounted() {
        this.perfil = JSON.parse(this.perfil_edit)
        this.urlEdit = route('credenciales.update',this.perfil.id)
        // console.log(this.perfil.id)
    },
    methods:{
        updSite(id){
            return axios.post(route('credenciales.update',this.perfil.id),{ _method: 'PUT'})
                        .then((res)=>{
                            console.log(res);
                        })
                        .catch((error) => {
                            // console.log(error)
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
                            // console.log(error.config);
                        });
        },
    }
}
</script>
