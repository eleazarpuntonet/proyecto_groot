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
                <form :action="urlStore" method="POST" @submit="onSubmit()">
                <input type="hidden" name="_token" :value="csrf">
                      <div class="form-row">
                        <div class="form-group col-md-6">
                          <label for="id_site">Site</label>
                          <select name="id_site" class="form-control sitesSelect" v-model="id_site">
                            <option>Seleccione un Site</option>
                          </select>
                        </div>
                        <div class="form-group col-md-6">
                          <label for="descripcion">Descripcion</label>
                          <input type="text" class="form-control" id="descripcion" placeholder="descripcion" name="descripcion" v-model="descripcion">
                        </div>
                      </div>
                      <div class="form-row">
                        <div class="form-group col-md-4">
                          <label for="user">Usuario</label>
                          <input type="text" class="form-control" id="user" placeholder="Usuario" name="user" v-model="user">
                        </div>
                        <div class="form-group col-md-4">
                          <label for="passw">Contraseña</label>
                            <input type="text" class="form-control" id="passw" placeholder="Contraseña" name="passw" v-model="passw">
                        </div>
                        <div class="form-group col-md-4">
                          <label for="comentarios">Comentarios</label>
                            <input type="text" class="form-control" id="comentarios" placeholder="comentarios" name="comentarios" v-model="comentarios">
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
            csrf            : document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            id_site         : '',
            descripcion     : '',
            user            : '',
            passw           : '',
            comentarios     : '',
            urlStore        : route('credenciales.store'),
        }
    },
    mounted() {
        // this.perfil = JSON.parse(this.perfil_show)
        // console.log(this.perfil_show)
    },
    methods:{
        onSubmit(){
            // alert("Hola ")
            return axios.post(route('credenciales.store'))
        }
    }
}
</script>
