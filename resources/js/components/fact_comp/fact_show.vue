<template>
    <div class="container">
        
            <div class="container-fluid mainTitle">
                <div class="row">
                    <div class="col"></div>
                    <div class="col">
                        <h1>{{ this.perfil.servicio }}</h1>
                    </div>
                    <div class="col"></div>
                </div>
            </div>


            <div id="formBox" class="container">
                  <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="id_proveedor">Proveedor</label>
                      <input readonly type="text" class="form-control" id="id_proveedor" placeholder="id_proveedor" name="id_proveedor" :value="this.perfil.id_proveedor">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="servicio">Servicio</label>
                      <input readonly type="text" class="form-control" id="servicio" placeholder="Servicio" name="servicio" :value="this.perfil.servicio">
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-4">
                      <label for="ciclo_facturacion">Ciclo de Facturacion</label>
                      <input readonly type="text" class="form-control" id="ciclo_facturacion" placeholder="Ip del Sitio" name="ciclo_facturacion" :value="this.perfil.ciclo_facturacion">
                    </div>
                    <div class="form-group col-md-4">
                      <label for="fecha_corte">Fecha de Corte</label>
                        <input readonly type="text" class="form-control" id="fecha_corte" placeholder="fecha_corte" name="fecha_corte" :value="this.perfil.fecha_corte">
                    </div>
                    <div class="form-group col-md-4">
                      <label for="importe">Importe</label>
                        <input readonly type="text" class="form-control" id="importe" placeholder="importe" name="importe" :value="this.perfil.importe">
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
        console.log(this.perfil_show)
    },
    methods:{
        // onSubmit(){
        //     alert("Hola ")
        //     return axios.post(route('credenciales.store'))
        // }
    }
}
</script>
