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

        <div id="registerFormBox" class="container">
            <form :action="urlEdit" method="POST">
                <input type="hidden" name="_token" :value="csrf">
                <input name="_method" type="hidden" value="PUT">

              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="nombre">Nombre</label>
                  <input type="text" class="form-control" id="nombre" placeholder="Nombre" name="nombre" :value="this.perfil.nombre">
                </div>
                <div class="form-group col-md-6">
                  <label for="cuenta">Cuenta</label>
                  <input type="text" class="form-control" id="cuenta" placeholder="Cuenta" name="cuenta" :value="this.perfil.cuenta">
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="usuario">Usuario</label>
                  <input type="text" class="form-control" id="usuario" placeholder="Usuario" name="usuarioDeProveedor" :value="this.perfil.usuario">
                </div>
                <div class="form-group col-md-6">
                  <label for="contrasena">Contraseña</label>
                    <input type="text" class="form-control" id="contrasena" placeholder="Contraseña" name="passwdDeProveedor" :value="this.perfil.password">
                </div>
              </div>
              <div class="form-group">
                <label for="comentarios">Comentarios</label>
                <textarea class="form-control" id="comentarios" rows="3" name="comentarios" :value="this.perfil.comentarios">
                </textarea>
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
        this.urlEdit = route('proveedores.update',this.perfil.id)
        // console.log(this.perfil.id)
    },
    methods:{
        updSite(id){
            return axios.post(route('proveedores.update',this.perfil.id),{ _method: 'PUT'})
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

