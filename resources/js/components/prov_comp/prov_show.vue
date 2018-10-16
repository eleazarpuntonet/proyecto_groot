<template>
    <div class="container">

        <div id="mainTitle" class="container-fluid">
            <div class="row">
                <div class="col"></div>
                <div class="col">
                    <h1>{{ this.perfil.nombre }}</h1>
                </div>
                <div class="col"></div>
            </div>
        </div>

        <div id="formBox" class="container">
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="nombre">Nombre</label>
                  <input readonly type="text" class="form-control" id="nombre" placeholder="Nombre" name="nombre" :value="this.perfil.nombre">
                </div>
                <div class="form-group col-md-6">
                  <label for="cuenta">Cuenta</label>
                  <input readonly type="text" class="form-control" id="cuenta" placeholder="Cuenta" name="cuenta" :value="this.perfil.cuenta">
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="usuario">Usuario</label>
                  <input readonly type="text" class="form-control" id="usuario" placeholder="Usuario" name="usuarioDeProveedor" :value="this.perfil.usuario">
                </div>
                <div class="form-group col-md-6">
                  <label for="contrasena">Contraseña</label>
                    <input readonly type="text" class="form-control" id="contrasena" placeholder="Contraseña" name="passwdDeProveedor"  :value="this.perfil.passwd">
                </div>
              </div>
              <div class="form-group">
                <label for="comentarios">Comentarios</label>
                <textarea readonly class="form-control" id="comentarios" rows="3" name="comentarios" >
                    {{this.perfil.comentarios}}
                </textarea>
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

