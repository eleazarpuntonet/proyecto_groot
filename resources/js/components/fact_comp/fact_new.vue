<template>
    <div class="container">
        
            <div class="container-fluid mainTitle">
                <div class="row">
                    <div class="col"></div>
                    <div class="col">
                        <h1>Registro de Datos de Proveedor</h1>
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
                      <label for="id_proveedor">Proveedor</label>
                        <select name="id_proveedor" class="form-control hostingSelect">
                          <option> Seleccione un Hosting</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="servicio">Servicio</label>
                      <input type="text" class="form-control" id="servicio" placeholder="Servicio" name="servicio" value="">
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-4">
                      <label for="ciclo_facturacion">Ciclo de Facturacion</label>
                      <select name="ciclo_facturacion" class="form-control">
                        <option value="Diario">Diario</option>
                        <option value="Anual">Anual</option>
                        <option value="Mensual">Mensual</option>
                        <option value="Semanal">Semanal</option>
                        <option value="Diario">Diario</option>
                        <option value="Unico">Unico</option>
                      </select>
                    </div>
                    <div class="form-group col-md-4">
                      <label for="fecha_corte">Fecha de Corte</label>
                        <input type="date" class="form-control" id="fecha_corte" placeholder="fecha_corte" name="fecha_corte" value="">
                    </div>
                    <div class="form-group col-md-4">
                      <label for="importe">Importe</label>
                        <input type="text" class="form-control" id="importe" placeholder="importe" name="importe" value="">
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
            csrf              : document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            id_proveedor      : '',
            servicio          : '',
            ciclo_facturacion : '',
            fecha_corte       : '',
            importe           : '',
            urlStore          : route('facturacion.store'),
        }
    },
    mounted() {
        // this.perfil = JSON.parse(this.perfil_show)
        // console.log(this.perfil_show)
    },
    methods:{
        onSubmit(){
            // alert("Hola ")
            return axios.post(route('facturacion.store'))
        }
    }
}
</script>
