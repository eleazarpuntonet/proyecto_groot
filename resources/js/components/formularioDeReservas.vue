<template>
<div id="app">
    <b-card no-body>
      <b-card-header>
        <strong>Formulario de Solicitud de Servicio de Reservas</strong>
      </b-card-header>
      <b-card-body>
        <b-row>
          <b-col lg="12" md="12">

            <!-- 
            * Selection del tipo de reserva
             -->
            <b-form-group
              id="tipoReserva"
              description="Ingrese el alcance de su solicitud"
              label="Alcance de Reserva"
              label-for="tReserva"
            >
            <el-select
              style="width:100%" 
              @change="reservaChange" 
              v-model="reservForm.treserva" 
              clearable 
              id="tReserva" 
              placeholder="Select">
              <el-option
                v-for="item in t_reserva"
                :key="item.value"
                :label="item.text"
                :value="item.value">
              </el-option>
            </el-select>
            </b-form-group>
          </b-col>
        </b-row>
        
        <!-- 
        * Formulario para reservas NACIONALES
         -->
        <template v-if="reservForm.treserva=='nac'">
          <b-row >
              <b-col lg="3" md="3">
                <!-- 
                * Campo de Estado de partida
                 -->
                <b-form-group
                  id="countryOut" 
                  :description="metalabels.label_estado_partida.desc"
                  :label="metalabels.label_estado_partida.title"
                  label-for="countryOut"
                >
                  <el-select
                    @change="getCities(reservForm.estado_salida)"
                    v-model="reservForm.estado_salida" 
                    style="width:100%" 
                    clearable 
                    id="countryOut" 
                    :placeholder="metalabels.label_estado_partida.placeholder">
                    <el-option
                      v-for="item in countryOptions"
                      :key="item.id_estado"
                      :label="item.estado"
                      :value="item.id_estado">
                    </el-option>
                  </el-select>
                </b-form-group>
              </b-col>

              <b-col lg="3" md="3">
                <!-- 
                * Campo de Ciudad de partida
                 -->
                <b-form-group
                  id="ciudadOut" 
                  :description="metalabels.label_ciudad_partida.desc"
                  :label="metalabels.label_ciudad_partida.title"
                  label-for="ciudadOut"
                >
                  <el-select
                    v-model="reservForm.ciudad_salida" 
                    style="width:100%" 
                    clearable 
                    id="ciudadOut" 
                    :placeholder="metalabels.label_ciudad_partida.placeholder">
                    <el-option
                      v-for="item in citiesOptions"
                      :key="item.id_ciudad"
                      :label="item.ciudad"
                      :value="item.id_ciudad">
                    </el-option>
                  </el-select>
                </b-form-group>
              </b-col>

              <b-col lg="6" md="6">
                <!-- 
                * Campo de Fecha de partida
                 -->
                <b-form-group
                  id="date2"
                  :description="metalabels.label_date_partida.desc"
                  :label="metalabels.label_date_partida.title"
                  label-for="fecha_arribo"
                >
                <el-date-picker
                  style="width:100%" 
                  id="fecha_arribo"
                  v-model="reservForm.date_salida"
                  type="date"
                  :placeholder="metalabels.label_date_partida.placeholder">
                </el-date-picker>
                </b-form-group>
              </b-col>

              <b-col lg="12" md="12">
                <!-- 
                * Campo textarea de la direccion precisa de partida
                 -->
                <b-form-group
                  id="direccionDetallada"
                  :description="metalabels.adress_from.desc"
                  :label="metalabels.adress_from.title"
                  label-for="detailAdress"
                >
                <el-input 
                  type="textarea" 
                  v-model="reservForm.direcc_salida"
                  id="detailAdress"
                ></el-input>

                </b-form-group>
              </b-col>            
          </b-row>

          <b-row >
              <b-col lg="3" md="3">
                <!-- 
                * Campo de Estado de LLEGADA
                 -->
                <b-form-group
                  id="countryOut" 
                  :description="metalabels.label_estado_llegada.desc"
                  :label="metalabels.label_estado_llegada.title"
                  label-for="countryOut"
                >
                  <el-select
                    @change="getCities(reservForm.estado_dest)"
                    v-model="reservForm.estado_dest" 
                    style="width:100%" 
                    clearable 
                    id="countryOut" 
                    :placeholder="metalabels.label_estado_llegada.placeholder">
                    <el-option
                      v-for="item in countryOptions"
                      :key="item.id_estado"
                      :label="item.estado"
                      :value="item.id_estado">
                    </el-option>
                  </el-select>
                </b-form-group>
              </b-col>

              <b-col lg="3" md="3">
                <!-- 
                * Campo de Ciudad de LLEGADA
                 -->
                <b-form-group
                  id="ciudadOut" 
                  :description="metalabels.label_ciudad_llegada.desc"
                  :label="metalabels.label_ciudad_llegada.title"
                  label-for="ciudadOut"
                >
                  <el-select
                    v-model="reservForm.ciudad_dest" 
                    style="width:100%" 
                    clearable 
                    id="ciudadOut" 
                    :placeholder="metalabels.label_ciudad_llegada.placeholder">
                    <el-option
                      v-for="item in citiesOptions"
                      :key="item.id_ciudad"
                      :label="item.ciudad"
                      :value="item.id_ciudad">
                    </el-option>
                  </el-select>
                </b-form-group>
              </b-col>

              <b-col lg="6" md="6">
                <!-- 
                * Campo de Fecha de ARRIBO
                 -->
                <b-form-group
                  id="date2"
                  :description="metalabels.label_date_arribo.desc"
                  :label="metalabels.label_date_arribo.title"
                  label-for="fecha_arribo"
                >
                <el-date-picker
                  style="width:100%" 
                  id="fecha_arribo"
                  v-model="reservForm.date_dest"
                  type="date"
                  :placeholder="metalabels.label_date_arribo.placeholder">
                </el-date-picker>
                </b-form-group>
              </b-col>

              <b-col lg="12" md="12">
                <!-- 
                * Campo textarea de la direccion precisa de partida
                 -->
                <b-form-group
                  id="direccionDetallada"
                  :description="metalabels.adress_to.desc"
                  :label="metalabels.adress_to.title"
                  label-for="detailAdress"
                >
                <el-input 
                  type="textarea" 
                  v-model="reservForm.direcc_dest"
                  id="detailAdress"
                ></el-input>

                </b-form-group>
              </b-col>            
          </b-row>

          <b-row>
            <b-col lg="6" md="6">
              <!-- 
              * Campo textarea con el MOTIVO de la reserva
               -->
              <b-form-group
                id="direccionDetallada"
                :description="metalabels.motivo.desc"
                :label="metalabels.motivo.title"
                label-for="detailAdress"
              >
              <el-input 
                type="textarea" 
                v-model="reservForm.motivo"
                id="detailAdress"
              ></el-input>

              </b-form-group>
            </b-col>

            <b-col lg="6" md="6">
              <!-- 
              * Campo textarea con la AGENDA de la reserva
               -->
              <b-form-group
                id="direccionDetallada"
                :description="metalabels.agenda.desc"
                :label="metalabels.agenda.title"
                label-for="detailAdress"
              >
              <el-input 
                type="textarea" 
                v-model="reservForm.agenda"
                id="detailAdress"
              ></el-input>

              </b-form-group>
            </b-col>  
          </b-row>
        </template>

        <template v-else>

          <el-input 
            @change="callSearch" 
            placeholder="Direccion" 
            v-model="selection"></el-input>


        </template>
        <b-row>
          <b-col lg="6" md="6">
          </b-col>
        </b-row>

        <el-row>
              <el-button 
                size="small" 
                type="primary" 
                round>Enviar</el-button>
              <el-button 
                type="warning" 
                size="small" 
                round>Cancelar</el-button>
        </el-row>
      </b-card-body>
    </b-card>

</div>
</template>

<script>
export default {
  /*
  *
  * Variables del componente
  */
  data () {
    return {
      access_t:'3GrbQyu3m3B4Qnas49WjvJxrjr9MquB161ibWVqgioxnhusJqL1AAy0Cuy8yekr8',
      selection : null,
      metalabels:{
        label_estado_partida: {
          title       : 'Estado de origen',
          desc        : 'Seleccione el estado de partida',
          placeholder : "Estados"
        },
        label_ciudad_partida: {
          title       : 'Ciudad de origen',
          desc        : 'Seleccione la ciudad de partida',
          placeholder : "Ciudades"
        },
        label_date_partida : {
          desc        : 'Fecha estimada de partida',
          title       : 'Ingrese la fecha aproximada de partida',
          placeholder : 'Seleccione la fecha de partida'
        },
        adress_from: {
          desc  : 'Describa  lo mas detalladamente posible su ubicacion de partida',
          title : 'Direccion detallada'
        },
        label_estado_llegada: {
          title       : 'Estado de destino',
          desc        : 'Seleccione el estado de destino',
          placeholder : "Estados"
        },
        label_ciudad_llegada: {
          title       : 'Ciudad destino',
          desc        : 'Seleccione la ciudad de destino',
          placeholder : "Ciudades"
        },
        label_date_arribo : {
          desc        : 'Fecha estimada de arribo',
          title       : 'Ingrese la fecha aproximada de arribo',
          placeholder : 'Seleccione la fecha de arribo'
        },
        adress_to: {
          desc  : 'Describa  lo mas detalladamente posible la direccion de su destino',
          title : 'Direccion detallada'
        },
        motivo: {
          desc  : 'Describa brevemente el motivo de su reserva',
          title : 'Motivo'
        },
        agenda: {
          desc  : 'Describa detalladamente la agenda de su viaje',
          title : 'Agenda'
        },
      },

      countryOptions    : [{ 
        value    : null, text: 'Seleccione un pais de origen' 
      }],
      citiesOptions    : [{ 
        value    : null, text: 'Seleccione una ciudad de origen' 
      }],
      t_reserva    : [
        {value : null, text: 'Seleccione un tipo de reserva'},
        {value : 'nac', text: 'Reserva Nacional'},
        {value : 'int', text: 'Reserva Internacional'},
      ],
      reservForm : {
        treserva      : null,
        estado_salida : null,
        ciudad_salida : null,
        direcc_salida : null,
        date_salida   : null,
        estado_dest   : null,
        ciudad_dest   : null,
        direcc_dest   : null,
        date_dest     : null,
        motivo        : null,
        agenda        : null,
      }
    }
  },
  /*
  *
  * Variables del computadas
  */
  computed: {
      getCountries(){
        return this.countryOptions
      },
      getIntCities(){
        return this.citiesOptions
      }
  },
  /*
  *
  * Metodos y funciones
  */
  methods: {
    reservaChange(){
      console.log('La selecciona de la reserva ah cambiado')
    },
    getCities(selection){
      axios.get(route('metacontroller.ve_ciudades',selection)) 
          .then(response => {
              this.citiesOptions=response.data
            })
          .catch(error => {
            console.log(error)
          })
    },
    callSearch(){

    }
  },
  beforeMount(){
    axios.get(route('metacontroller.ve_estados')) 
        .then(response => {
            this.countryOptions=response.data
          })
        .catch(error => {
          console.log(error)
        })
  },
  mounted() {

    }
}
</script>
<style>
.el-select:{
  display: block !important;
  width: 100%;
}
</style>
