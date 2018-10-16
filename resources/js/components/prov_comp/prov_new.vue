<template>
    <div class="container">
            <div class="container-fluid mainTitle">
                <div class="row">
                    <div class="col"></div>
                        <div class="col">
                            <h1>Registro de Nuevo Proveedor</h1>
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
                      <label for="nombre">Nombre</label>
                      <input type="text" class="form-control" id="nombre" placeholder="Nombre" name="nombre" v-model="nombre">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="cuenta">Cuenta</label>
                      <input type="text" class="form-control" id="cuenta" placeholder="Cuenta" name="cuenta" v-model="cuenta">
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="usuario">Usuario</label>
                      <input type="text" class="form-control" id="usuario" placeholder="Usuario" name="usuarioDeProveedor" v-model="usuario">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="contrasena">Contraseña</label>
                        <input type="text" class="form-control" id="contrasena" placeholder="Contraseña" name="passwdDeProveedor" v-model="password">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="comentarios">Comentarios</label>
                    <textarea class="form-control" id="comentarios" rows="3" name="comentarios" v-model="comentarios">
                       
                    </textarea>
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
            nombre : '',
            cuenta : '',
            usuario : '',
            password  : '',
            comentarios  : '',
            urlStore : route('proveedores.store'),
        }
    },
    mounted() {
        // this.perfil = JSON.parse(this.perfil_show)
        // console.log(this.perfil_show)
    },
    methods:{
        // newProvForm()
        // {
        //     console.log(route('sites.store'))
        //     return route('sites.store')
        // },
        onSubmit(){
            return axios.post(route('proveedores.store'))
        }
    }
}
</script>

