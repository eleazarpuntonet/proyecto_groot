<template>
    <div class="container">
        
        <div class="container-fluid mainTitle">
            <div class="row">
                <div class="col"></div>
                <div class="col">
                    <h1>{{ this.perfil.descripcion }}</h1>
                </div>
                <div class="col"></div>
            </div>
        </div>

        <div id="formBox" class="container">
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="id_site">Site</label>
                  <input readonly type="text" class="form-control" id="id_site" placeholder="id_site" name="id_site" :value="this.perfil.id_site">
                </div>
                <div class="form-group col-md-6">
                  <label for="descripcion">Descripcion</label>
                  <input readonly type="text" class="form-control" id="descripcion" placeholder="descripcion" name="descripcion" :value="this.perfil.descripcion">
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-4">
                  <label for="user">User</label>
                  <input readonly type="text" class="form-control" id="user" placeholder="Ip del Sitio" name="user" :value="this.perfil.user">
                </div>
                <div class="form-group col-md-4">
                  <label for="passw">Passw</label>
                    <input readonly type="text" class="form-control" id="passw" placeholder="passw" name="passw" :value="this.perfil.passw">
                </div>
                <div class="form-group col-md-4">
                  <label for="comentarios">Comentarios</label>
                    <input readonly type="text" class="form-control" id="comentarios" placeholder="comentarios" name="comentarios" :value="this.perfil.comentarios">
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
            csrf   : document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            perfil : '',

        }
    },
    mounted() {
        this.perfil = JSON.parse(this.perfil_show)
        // console.log(this.perfil_show)
    },
    methods:{
        onSubmit(){
            alert("Hola ")
            return axios.post(route('credenciales.store'))
        }
    }
}
</script>
