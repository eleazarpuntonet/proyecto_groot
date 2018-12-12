<template>
<div id="app">
    <b-card no-body>
      <b-card-header>
        <strong>Formulario de Solicitud de Servicio de Reservas</strong>
      </b-card-header>
      <b-card-body>
        <b-row>
          <b-col style="text-align: center" lg="12" md="12">
            <el-switch
              @change= "switchChange"
              style="display: block"
              v-model="reserva_switch"
              active-color="#13ce66"
              inactive-color="#ff4949"
              active-text="Reservas nacional"
              inactive-text="Reserva internacinal">
            </el-switch>
          </b-col>
          <b-col lg="12" md="12">
            <template v-if="dataSend.t_reserva">
              <h1 v-if="dataSend.t_reserva=='nac'">Reservas Nacionales</h1>
              <h1 v-else>Reservas Internacionales</h1>
            </template>
          </b-col>

        </b-row>
        
        <!-- 
        * Formulario para reservas NACIONALES E INTERNACIONALES
         -->
        <template v-if="dataSend.t_reserva">
          <el-form 
            :model="dataSend" 
            :rules="rules" 
            size="mini"
            >
            <b-row class="formsection" >
              <!-- 
              * Campo de Pais/Estado de partida
               -->
              <b-col lg="3" md="3">
                <b-form-group
                  id="countryOut" 
                  :description=" dataSend.t_reserva=='nac' ? nac_label.from_a.desc : int_label.from_a.desc"
                  :label=" dataSend.t_reserva=='nac' ? nac_label.from_a.tit : int_label.from_a.tit"
                  label-for="countryOut"
                >
                  <el-select
                    @change="dataSend.t_reserva=='nac' ? getCities(dataSend.from_a) : getCountriesA()"
                    v-model="dataSend.from_a" 
                    style="width:100%" 
                    clearable 
                    id="countryOut" 
                    :placeholder=" dataSend.t_reserva=='nac' ? nac_label.from_a.plac : int_label.from_a.plac"
                    >
                    <!-- 
                    *Opciones desplegables de items NACIONALES
                     -->
                    <template v-if="dataSend.t_reserva=='nac'">
                      <el-option
                        v-for="item in countryOptions"
                        :key="item.id_estado"
                        :label="item.estado"
                        :value="item.id_estado">
                      </el-option>
                    </template>
                    <!-- 
                    *Opciones desplegables de items INTERNACIONALES
                     -->
                    <template v-else>
                      <el-option
                        v-for="item in countries"
                        :key="item.countryName"
                        :label="item.countryName"
                        :value="item.countryName">
                      </el-option>
                    </template>
                  </el-select>
                </b-form-group>
              </b-col>

              <!-- 
              * Campo de Ciudad/Localidad de partida
               -->
              <b-col lg="3" md="3">
                <b-form-group
                  id="ciudadOut" 
                  :description=" dataSend.t_reserva=='nac' ? nac_label.from_b.desc : int_label.from_b.desc"
                  :label=" dataSend.t_reserva=='nac' ? nac_label.from_b.tit : int_label.from_b.tit"
                  label-for="ciudadOut"
                >
                  <el-select
                    :disabled="dataSend.from_a ? false : true"
                    v-model="dataSend.from_b" 
                    style="width:100%" 
                    clearable 
                    id="ciudadOut" 
                    :placeholder=" dataSend.t_reserva=='nac' ? nac_label.from_b.plac : int_label.from_b.plac"
                    >
                    <!-- 
                    *Opciones desplegables de items NACIONALES
                     -->
                    <template v-if="dataSend.t_reserva=='int'">
                      <el-option
                        v-for="item in temp_states"
                        :key="item.name"
                        :label="item.name"
                        :value="item.name">
                      </el-option>
                    </template>
                    <!-- 
                    *Opciones desplegables de items INTERNACIONALES
                     -->
                    <template v-else>
                      <el-option
                        v-for="item in citiesOptions"
                        :key="item.ciudad"
                        :label="item.ciudad"
                        :value="item.ciudad">
                      </el-option>
                    </template>
                  </el-select>
                </b-form-group>
              </b-col>

              <!-- 
              * Campo de Fecha de partida
               -->
              <b-col lg="6" md="6">
                <b-form-group
                  id="date2"
                  :description=" dataSend.t_reserva=='nac' ? nac_label.date_a.desc : int_label.date_a.desc"
                  :label=" dataSend.t_reserva=='nac' ? nac_label.date_a.tit : int_label.date_a.tit"
                  label-for="fecha_arribo"
                >
                <el-date-picker
                  style="width:100%" 
                  id="fecha_arribo"
                  v-model="dataSend.date_a"
                  type="date"
                  value-format="yyyy-MM-dd"
                  :placeholder=" dataSend.t_reserva=='nac' ? nac_label.date_a.plac : int_label.date_a.plac">
                </el-date-picker>
                </b-form-group>
              </b-col>

              <!-- 
              * Campo textarea de la direccion precisa de partida
               -->
              <b-col lg="12" md="12">
                <b-form-group
                  id="direccionDetallada"
                  :description=" dataSend.t_reserva=='nac' ? nac_label.adress_a.desc : int_label.adress_a.desc"
                  :label=" dataSend.t_reserva=='nac' ? nac_label.adress_a.tit : int_label.adress_a.tit"
                  label-for="detailAdress"
                >
                <el-input 
                  type="textarea" 
                  v-model="dataSend.adress_a"
                  id="detailAdress"
                ></el-input>
                </b-form-group>
              </b-col>            
            </b-row>

            <b-row class="formsection" >
                <!-- 
                * Campo de Estado de LLEGADA
                 -->
                <b-col lg="3" md="3">
                  <b-form-group
                    id="countryOut" 
                    :description=" dataSend.t_reserva=='nac' ? nac_label.to_a.desc : int_label.to_a.desc"
                    :label=" dataSend.t_reserva=='nac' ? nac_label.to_a.tit : int_label.to_a.tit"
                    label-for="countryOut"
                  >
                    <el-select
                      @change="dataSend.t_reserva=='nac' ? getCities(dataSend.to_a) : getCountriesB()"
                      v-model="dataSend.to_a" 
                      style="width:100%" 
                      clearable 
                      id="countryOut" 
                      :placeholder=" dataSend.t_reserva=='nac' ? nac_label.to_a.plac : int_label.to_a.plac"
                      >
                      <!-- 
                      *Opciones desplegables de items NACIONALES
                       -->
                      <template v-if="dataSend.t_reserva=='nac'">
                        <el-option
                          v-for="item in countryOptions"
                          :key="item.id_estado"
                          :label="item.estado"
                          :value="item.id_estado">
                        </el-option>
                      </template>
                      <!-- 
                      *Opciones desplegables de items INTERNACIONALES
                       -->
                      <template v-else>
                        <el-option
                          v-for="item in countries"
                          :key="item.countryName"
                          :label="item.countryName"
                          :value="item.countryName">
                        </el-option>
                      </template>
                    </el-select>
                  </b-form-group>
                </b-col>

                <!-- 
                * Campo de Ciudad de LLEGADA
                 -->
                <b-col lg="3" md="3">
                  <b-form-group
                    id="ciudadOut" 
                    :description=" dataSend.t_reserva=='nac' ? nac_label.to_a.desc : int_label.to_a.desc"
                    :label=" dataSend.t_reserva=='nac' ? nac_label.to_a.tit : int_label.to_a.tit"
                    label-for="ciudadOut"
                  >
                    <el-select
                      :disabled="dataSend.to_a ? false : true"
                      v-model="dataSend.to_b" 
                      style="width:100%" 
                      clearable 
                      id="ciudadOut" 
                      :placeholder=" dataSend.t_reserva=='nac' ? nac_label.to_a.plac : int_label.to_a.plac"
                      >
                      <!-- 
                      *Opciones desplegables de items NACIONALES
                       -->
                      <template v-if="dataSend.t_reserva=='int'">
                        <el-option
                          v-for="item in temp_states"
                          :key="item.name"
                          :label="item.name"
                          :value="item.name">
                        </el-option>
                      </template>
                      <!-- 
                      *Opciones desplegables de items INTERNACIONALES
                       -->
                      <template v-else>
                        <el-option
                          v-for="item in citiesOptions"
                          :key="item.ciudad"
                          :label="item.ciudad"
                          :value="item.ciudad">
                        </el-option>
                      </template>
                    </el-select>
                  </b-form-group>
                </b-col>

                <!-- 
                * Campo de Fecha de ARRIBO
                 -->
                <b-col lg="6" md="6">
                  <b-form-group
                    id="date2"
                    :description=" dataSend.t_reserva=='nac' ? nac_label.date_b.desc : int_label.date_b.desc"
                    :label=" dataSend.t_reserva=='nac' ? nac_label.date_b.desc : int_label.date_b.desc"
                    label-for="fecha_arribo"
                  >
                  <el-date-picker
                    value-format="yyyy-MM-dd"
                    style="width:100%" 
                    id="fecha_arribo"
                    v-model="dataSend.date_b"
                    type="date"
                    :placeholder=" dataSend.t_reserva=='nac' ? nac_label.date_b.desc : int_label.date_b.desc"
                    >
                  </el-date-picker>
                  </b-form-group>
                </b-col>

                <!-- 
                * Campo textarea de la direccion precisa de partida
                 -->
                <b-col lg="12" md="12">
                  <b-form-group
                    id="direccionDetallada"
                    :description=" dataSend.t_reserva=='nac' ? nac_label.adress_b.desc : int_label.adress_b.desc"
                    :label=" dataSend.t_reserva=='nac' ? nac_label.adress_b.desc : int_label.adress_b.desc"
                    label-for="detailAdress"
                  >
                  <el-input 
                    type="textarea" 
                    v-model="dataSend.adress_b"
                    id="detailAdress"
                  ></el-input>

                  </b-form-group>
                </b-col>            
            </b-row>

            <b-row class="formsection">
              <!-- 
              * Campo textarea con el MOTIVO de la reserva
               -->
              <b-col lg="6" md="6">
                <b-form-group
                  id="direccionDetallada"
                  :description=" dataSend.t_reserva=='nac' ? nac_label.motivo.desc : int_label.motivo.desc"
                  :label=" dataSend.t_reserva=='nac' ? nac_label.motivo.tit : int_label.motivo.tit"
                  label-for="detailAdress"
                >
                <el-input 
                  type="textarea" 
                  v-model="dataSend.motivo"
                  id="detailAdress"
                ></el-input>

                </b-form-group>
              </b-col>

              <!-- 
              * Campo textarea con la AGENDA de la reserva
               -->
              <b-col lg="6" md="6">
                <b-form-group
                  id="direccionDetallada"
                  :description=" dataSend.t_reserva=='nac' ? nac_label.agenda.desc : int_label.agenda.desc"
                  :label=" dataSend.t_reserva=='nac' ? nac_label.agenda.tit : int_label.agenda.tit"
                  label-for="detailAdress"
                >
                <el-input 
                  type="textarea" 
                  v-model="dataSend.agenda"
                  id="detailAdress"
                ></el-input>

                </b-form-group>
              </b-col>  
            </b-row>

            <b-row class="formsection">
              <b-col class="box_dias" lg="1" md="1">
                <span>Dias</span><br>
                <strong>25</strong>
              </b-col> 
              <b-col lg="11" md="11">
                <el-checkbox-group
                  v-model="viaticos"
                  @change="checkChanged">
                  <el-checkbox-button v-for="item in rubros" :label="item.label" :key="item.label">{{item.label}}</el-checkbox-button>
                </el-checkbox-group>
              </b-col>  
              <template v-if="this.dataSend.viaticos != 0">
                <b-col lg="12" md="12">
                    <el-table
                      :data="dataSend.viaticos"
                      style="width: 100%">
                      <el-table-column
                        prop="rubro"
                        label="Rubro"
                        width="180">
                      </el-table-column>
                      <el-table-column
                        prop="cant"
                        label="Cantidad"
                        width="180">
                      </el-table-column>
                      <el-table-column
                        prop="dias"
                        label="Dias">
                      </el-table-column>
                      <el-table-column
                        prop="val_unit"
                        label="Valor/unidad">
                      </el-table-column>
                      <el-table-column
                        prop="total"
                        label="Total">
                      </el-table-column>
                    </el-table>
                </b-col>
              </template>
              <b-col lg="12" md="12">
                <b-row>
                  <b-col lg="3" md="3">
                    <el-input
                      placeholder="Desayuno"
                      v-model="viatico_temp.rubro"
                      :disabled="false">
                    </el-input>
                  </b-col>
                  <b-col>
                    <el-input
                      placeholder="Cantidad"
                      v-model="viatico_temp.cant"
                      :disabled="false">
                    </el-input>
                  </b-col>
                  <b-col>
                    <el-input
                      placeholder="Monto/unidad"
                      v-model="viatico_temp.unit"
                      :disabled="false">
                    </el-input>
                  </b-col>

                  <b-col class="item_viat">
                    <el-button 
                      @click="addViatico"
                      type="success" 
                      icon="el-icon-check" 
                      circle
                      size="small" 
                      style="margin:auto;"></el-button>
                  </b-col>
                </b-row>
              </b-col>             
            </b-row>

            <el-row class="formsection">
              <el-button 
                @click.prevent="submitForm()"
                size="small" 
                type="primary" 
                round>Enviar</el-button>
              <el-button 
                type="warning" 
                size="small" 
                round>Cancelar</el-button>
            </el-row>
          </el-form>
        </template>

      </b-card-body>
    </b-card>
</div>
</template>

<script>
import data_countries from '../data_countries.json';
class Viatico{
  constructor(data){
    this.rubro    = data.rubro
    this.cant     = data.cant
    this.dias     = data.dias
    this.val_unit = data.unit
    this.total    = this.cant * this.val_unit
  }
}
export default {
  /*
  *
  * Variables del componente
  */
  data () {
    return {
      reserva_switch : false,
      dias: 25,
      rubros: [
              {
                value:'desayuno',
                monto: 800,
                label: 'Desayuno',
              },
              {
                value:'almuerzo',
                monto: 1200,
                label: 'Almuerzo',
              },
              {
                value:'cena',
                monto: 1300,
                label: 'Cena',
              },
              {
                value:'alojamiento',
                monto: 5000,
                label: 'Alojamiento',
              },
              {
                value:'gasolina',
                monto: 300,
                label: 'Gasolina',
              },
              {
                value:'parking',
                monto: 600,
                label: 'Parking',
              },
      ],
      viatico_temp: {
        rubro: null,
        cant: null,
        dias: null,
        unit: null,
        total : this.cant,
      },
      viat_label:{
        dias        : 'Dias',
        c_hospedaje : 'Hospedaje',
        s_hospedaje : 'Sin hospedaje',
        rubro       : 'Rubros',
        rubros      : ['Desayuno','Almuerzo','Cena','Alojamiento','Gasolina','Parking','Otros'],
        moneda      : 'Bs.S'
      },
      viaticos: [],
      countryOptions    : [{ 
        value    : null, text: 'Seleccione un pais de origen' 
      }],
      citiesOptions    : [{ 
        value    : null, text: 'Seleccione una ciudad de origen' 
      }],
      countries:data_countries,
      temp_states: null,
      int_label:{
        from_a   : {
              tit  : 'Pais origen',
              desc : 'Seleccione el pais de origen',
              plac : 'Pais'
        },
        from_b   : {
              tit  : 'Localidad de origen',
              desc : 'Seleccione la localidad de origen',
              plac : 'Localidad',
        },
        adress_a : {
              desc : 'Describa  lo mas detalladamente posible su ubicacion de partida',
              tit  : 'Direccion detallada'
        },
        adress_b : {
              desc : 'Describa  lo mas detalladamente posible la direccion de su destino',
              tit  : 'Direccion detallada'
        },
        date_a   : {
              desc : 'Fecha estimada de partida',
              tit  : 'Ingrese la fecha aproximada de partida',
              plac : 'Seleccione la fecha de partida'
        },
        date_b   : {
              desc : 'Fecha estimada de llegada',
              tit  : 'Ingrese la fecha aproximada de llegada',
              plac : 'Seleccione la fecha de llegada'
        },
        to_a     : {
              tit  : 'Pais destino',
              desc : 'Seleccione la localidad de destino',
              plac : 'Paises'
        },
        to_b     : {
              tit  : 'Localidad destino',
              desc : 'Seleccione la localidad de destino',
              plac : 'Localidad'
        },
        motivo   : {
              desc : 'Describa brevemente el motivo de su reserva',
              tit  : 'Motivo'
        },
        agenda   : {
              desc : 'Describa detalladamente la agenda de su viaje',
              tit  : 'Agenda'
        },
      },
      nac_label:{
        from_a   : {
              tit  : 'Estado origen',
              desc : 'Seleccione el estado de partida',
              plac : 'Estados'
        },
        from_b   : {
              tit  : 'Ciudad origen',
              desc : 'Seleccione la localidad de origen',
              plac : 'Ciudad',
        },
        adress_a : {
              desc : 'Describa  lo mas detalladamente posible su ubicacion de partida',
              tit  : 'Direccion detallada'
        },
        adress_b : {
              desc : 'Describa  lo mas detalladamente posible la direccion de su destino',
              tit  : 'Direccion detallada'
        },
        date_a   : {
              desc : 'Fecha estimada de partida',
              tit  : 'Ingrese la fecha aproximada de partida',
              plac : 'Seleccione la fecha de partida'
        },
        date_b   : {
              desc : 'Fecha estimada de partida',
              tit  : 'Ingrese la fecha aproximada de partida',
              plac : 'Seleccione la fecha de partida'
        },
        to_a     : {
              tit  : 'Estado de destino',
              desc : 'Seleccione el estado de destino',
              plac : "Estados"
        },
        to_b     : {
              tit  : 'Ciudad destino',
              desc : 'Seleccione la ciudad de destino',
              plac : "Ciudades"
        },
        motivo   : {
              desc : 'Describa brevemente el motivo de su reserva',
              tit  : 'Motivo'
        },
        agenda   : {
              desc : 'Describa detalladamente la agenda de su viaje',
              tit  : 'Agenda'
        },
      },

      // dataSend : {
      //   t_reserva: null,
      //   from_a   : null,
      //   from_b   : null,
      //   adress_a : null,
      //   date_a   : null,
      //   to_a     : null,
      //   to_b     : null,
      //   adress_b : null,
      //   date_b   : null,
      //   motivo   : null,
      //   agenda   : null,
          //viaticos : [],
      // },
      
      dataSend : {
        t_reserva: 'nacional',
        from_a   : 'Caracas',
        from_b   : 'Catia',
        adress_a : 'Catia nro 58 496',
        date_a   : '2017-11-14',
        to_a     : 'Paris',
        to_b     : 'Francia',
        adress_b : 'Bla bla bla',
        date_b   : '2017-11-20',
        motivo   : 'Viajes',
        agenda   : 'Mucho alcohol',
        viaticos : [],
      },
      t_reserva    : [
        {value : null, text: 'Seleccione un tipo de reserva'},
        {value : 'nac', text: 'Reserva Nacional'},
        {value : 'int', text: 'Reserva Internacional'},
      ],
      rules: {
        to_a: [
          { required: true, message: 'Por favor seleccione una opcion', trigger: 'blur' },
        ],
        to_b: [
          { required: true, message: 'Por favor seleccione una opcion', trigger: 'blur' },
        ],
        adress_a: [
          {required: true, message: 'Ingrese una direccion de partida', trigger: 'change' }
        ],
        adress_b: [
          {required: true, message: 'Ingrese una direccion de partida', trigger: 'change' }
        ],
        date_a: [
          { type: 'date', required: true, message: 'Por favor seleccione una fecha estimada de partida', trigger: 'change' }
        ],
        date_b: [
          { type: 'date', required: true, message: 'Por favor seleccione una fecha estimada de arribo', trigger: 'change' }
        ],
        agenda: [
          {required: true, message: 'Por favor describa su agenda en el destino, esto nos ayudara a programar mejor su visita ', trigger: 'change' }
        ],
        motivo: [
          {required: true, message: 'Por favor describa el motivo de su reserva', trigger: 'change' }
        ],
      } 
    }
  },
  computed: {
      getIntCities(){
        return this.citiesOptions
      }
  },
  methods: {
    switchChange(){
      if (this.reserva_switch == true) {
        this.dataSend.t_reserva = 'nac'
      } else {
        this.dataSend.t_reserva = 'int'
      }
    },
    addViatico(){
      console.log('Agrego viatocop')
      
      console.log(this.dataSend.viaticos)
      let fecha1 = moment(this.dataSend.date_a);
      let fecha2 = moment(this.dataSend.date_b);
      let dif = fecha2.diff(fecha1,'days')
      this.viatico_temp.dias = dif
      this.dataSend.viaticos.push(new Viatico(this.viatico_temp))
      this.viatico_temp.rubro = null
      this.viatico_temp.cant = null
      this.viatico_temp.dias = null
      this.viatico_temp.dias = null
      this.viatico_temp.unit = null
      this.viatico_temp.total = null
    },
    checkChanged(rubro){
      // console.log(this.viaticos.length)
      console.log(this.viaticos[this.viaticos.length-1])
      this.rubros.forEach((val,i)=>{
        if (this.viaticos[this.viaticos.length-1] == val.label) {
          console.log(val)
          let fecha1 = moment(this.dataSend.date_a);
          let fecha2 = moment(this.dataSend.date_b);
          let dif = fecha2.diff(fecha1,'days')
          this.viatico_temp.rubro = this.viaticos[this.viaticos.length-1]
          this.viatico_temp.cant = this.dias
          this.viatico_temp.dias = dif
          this.viatico_temp.unit = val.monto
          this.dataSend.viaticos.push(new Viatico(this.viatico_temp))
          console.log(this.dataSend.viaticos)

          this.viatico_temp.rubro = null
          this.viatico_temp.cant = null
          this.viatico_temp.dias = null
          this.viatico_temp.unit = null
          this.viatico_temp.total = null
        }
      })
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
    getCountriesA(){
      this.countries.forEach((val)=>{
        if (this.dataSend.from_a==val.countryName) {
          this.temp_states=val.regions
        }
      })
    },
    getCountriesB(){
      this.countries.forEach((val)=>{
        if (this.dataSend.to_a==val.countryName) {
          this.temp_states=val.regions
        }
      })
    },
    addLabel(item,label){
      if (dataSend.t_reserva=='nac') {
        this.nac_label.forEach((val)=>{
          console.log(val)
        })
      } else {
        this.int_label.forEach((val)=>{
          console.log(val)
        })
      }
    },
    submitForm(){
      var user = this.$store.getters.currentUser
      axios.post(route('reservas.store'),this.dataSend) 
          .then(response => {
              console.log(response)
            })
          .catch(error => {
            console.log(error)

          })
      // console.log(this.dataSend)
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
  created() {
    let momentjs = document.createElement('script');    
    momentjs.setAttribute('src',"http://momentjs.com/downloads/moment.min.js");
    document.head.appendChild(momentjs);
  },
  mounted(){
  }
}
</script>
<style lang="scss">
.item_viat{
  text-align: center;
}
.el-select{
  display: block !important;
  width: 100%;
}
.formsection{
  border: 1px solid black;
  margin: 5px;
  border-radius: 5px;
  padding: 5px;
}
.box_dias{
  border: 1px solid #dcdfe6;
  border-radius: 5px;
  // width: 100%;
  text-align: center;
  margin: auto;
}
.viaticos_det{
  display: flex;
  flex-direction: row;
  justify-content: space-between;
}
</style>
