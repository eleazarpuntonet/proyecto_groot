<script>
  import data_countries from '../data_countries.json';
  import venezuela from '../venezuela.json';
  import {
    getAccesos
  } from '../apiCalls.js'
  class Viatico{
    constructor(data){
      this.rubro    = data.rubro
      this.dias     = data.dias
      this.val_unit = data.unit
      this.total = this.dias * this.val_unit
    }
  }

  export default {
    /*
    *
    * Variables del componente
    */
    data () {
      return {
        venezuela: venezuela,
        permisos: this.$store.getters.getUserPermisos,
        tableData: [],
        user: null,
        switch_flag: false,
        selection: null,
        reserva_switch : false,
        dias: 25,
        city_temp_2: [{ 
          value    : null, text: 'Seleccione una ciudad de origen' 
        }],
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
                {
                  value:'otros',
                  label: 'Otros',
                },
        ],
        viatico_temp: {
          rubro: null,
          cant: null,
          dias: null,
          unit: null,
          total : this.cant,
        },
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
                desc : 'Fecha estimada de retorno',
                tit  : 'Ingrese la fecha aproximada de retorno',
                plac : 'Seleccione la fecha de retorno'
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
                desc : 'Fecha estimada de retorno',
                tit  : 'Ingrese la fecha aproximada de retorno',
                plac : 'Seleccione la fecha de retorno'
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

        dataSend : {
           alcance: null,
          t_reserva: null,
          from_a   : null,
          from_b   : null,
          adress_a : null,
          date_a   : null,
          to_a     : null,
          to_b     : null,
          adress_b : null,
          date_b   : null,
          motivo   : null,
          agenda   : null,
            viaticos : [],
        },
        
        // dataSend : {
        //   alcance   : null,
        //   id_user   : this.$store.getters.currentUser.id,
        //   t_reserva : null,
        //   from_a    : 'Caracas',
        //   from_b    : 'Catia',
        //   adress_a  : 'Catia nro 58 496',
        //   date_a    : '2017-11-14',
        //   to_a      : 'Paris',
        //   to_b      : 'Francia',
        //   adress_b  : 'Bla bla bla',
        //   date_b    : '2017-11-20',
        //   motivo    : 'Viajes',
        //   agenda    : 'Viajar',
        //   viaticos  : [],
        // },
        t_reserva    : [
          {value : null, text: 'Seleccione un tipo de reserva'},
          {value : 'nac', text: 'Reserva Nacional'},
          {value : 'int', text: 'Reserva Internacional'},
        ],
        rules: {
          from_a: [
            { 
             required: true,
             message: 'Complete el campo de origen',
             trigger: 'change' 
           },
          ],
          from_b: [
            { 
             required: true,
             message: 'Complete el campo de origen',
             trigger: 'change' 
           },
          ],
          adress_a: [
            { 
             required: true,
             message: 'Ingrese un lugar de origen',
             trigger: 'blur' 
           },
          ],
          adress_b: [
            { 
             required: true,
             message: 'Ingrese una direccion de destino',
             trigger: 'blur' 
           },
          ],
          date_a: [
            { 
             required: true,
             message: 'Ingrese la fecha de partida estimada',
             trigger: 'blur' 
           },
          ],
          date_b: [
            { 
             required: true,
             message: 'Ingrese la fecha de retorno estimada',
             trigger: 'blur' 
           },
          ],
          to_a: [
            { 
             required: true,
             message: 'Ingrese el lugar destino',
             trigger: 'blur' 
           },
          ],
          to_b: [
            { 
             required: true,
             message: 'Ingrese un lugar de destino',
             trigger: 'blur' 
           },
          ],
          motivo: [
            { 
             required: true,
             message: 'Ingrese el motivo de su traslado',
             trigger: 'blur' 
           },
          ],
          agenda: [
            { 
             required: true,
             message: 'Ingrese su agenda en el lugar de destino',
             trigger: 'blur' 
           },
          ],
        } 
      }
    },
    computed: {
        getIntCities(){
          return this.citiesOptions
        }
    },
    watch:{
      permisos(){
        console.log('Permisos ah cambiado')
      }
    },
    methods: {
      checkPermisos(accion_id, accion) {
        if (this.permisos.some(item => item.action_id == accion_id)) {
          let index = this.permisos.findIndex(item => item.action_id == accion_id)
          if (this.permisos[index][accion] == 'true' || this.permisos[index][accion] == true) {
            return true
          } else {
            return false
          }
        } else {
          return false
        }
      },
      deleteRow(index, rows) {
        rows.splice(index, 1);
      },
      itemChange(item){
        this.viatico_temp.rubro = item.value
        if (item.value != 'otros') {
          this.rubros.forEach((val,i)=>{
            if (val.value == item.value) {
              var a = moment(this.dataSend.date_a);
              var b = moment(this.dataSend.date_b);
              this.viatico_temp.unit = val.monto
              this.viatico_temp.dias = b.diff(a, 'days')
            }
          })
        }else{
          this.switch_flag=true
          this.viatico_temp.cant = null
          this.viatico_temp.dias= null
          this.viatico_temp.unit= null
          this.viatico_temp.rubro= null
        }
      },
      addViat(item){
        this.switch_flag=false
        this.dataSend.viaticos.push(new Viatico(this.viatico_temp))
        this.viatico_temp.cant = null
        this.viatico_temp.dias= null
        this.viatico_temp.unit= null
        this.viatico_temp.rubro= null
      },
      switchChange(){
        if (this.reserva_switch == true) {
          this.dataSend.alcance = 'Nacional'
          this.dataSend.t_reserva = 'nac'
        } else {
          this.dataSend.t_reserva = 'int'
          this.dataSend.alcance = 'Internacional'
        }
        this.dataSend.from_a    = null
        this.dataSend.from_b    = null
        this.dataSend.adress_a  = null
        this.dataSend.date_a    = null
        this.dataSend.to_a      = null
        this.dataSend.to_b      = null
        this.dataSend.adress_b  = null
        this.dataSend.date_b    = null
        this.dataSend.motivo    = null
        this.dataSend.agenda    = null
        this.dataSend.viaticos  = []
      },
      getCities(selection){
        this.venezuela.forEach((val)=>{
          if (this.dataSend.from_a==val.estado) {
            this.citiesOptions=val
            // this.citiesOptions=val.ciudades
          }
        })
      },
      getCities2(){

        this.venezuela.forEach((val)=>{
          if (this.dataSend.to_a==val.estado) {
            this.city_temp_2=val
          }
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
          })
        }
      },
      submitForm(){
        var user = this.$store.getters.currentUser
        axios.post(route('reservas.store'),this.dataSend) 
            .then(response => {
                this.$notify({
                  title: response.status,
                  message: 'Registro creado!',
                  type: 'success'
                })
                // this.$router.push({
                //   path: `/reservas/${response.data.id}` 
                // })
              })
            .catch(error => {
              this.$notify.error({
                title: 'Error '+error.response.status,
                message: error.response.data.message
              });
            })
      },
      validate_send(formName){
        this.$refs[formName].validate((valid) => {
          if (valid) {
            this.submitForm();
          } else {
            console.log('error submit!!');
            this.$notify.error({
              title: 'Error de formulario',
              message: 'Debe completar todos los campos requeridos'
            });
            return false;
          }
        });
      },
    },
    beforeCreate(){
      var value      = {}
      value.ruta_id  = this.$router.app._route.meta.router_id
      value.user_id = this.$store.getters.currentUser.id
      
      getAccesos(value)
        .then(response => {
          this.$store.dispatch('setAccesos', response)
        }).catch( error => {
          console.log(error)
        })
    },
    created() {
    },
    mounted(){
    }
  }
</script>
<template>
  <div class="reservasView ele_modelview_A">
    <div style="display: flex; flex-direction: column; width: 100%;">
      <div class="topSideForm l_radiusBorder">
        <div class="titleForm" v-if="dataSend.t_reserva">
          <div class="logoGroup">
            <img
              src="../../../public/img/sps_logoborderline.png"
              alt="Logo SPS"/>
          </div>
          <div class="textContainer">
            <div style="display:table-cell;vertical-align:middle;">
              <div v-if="dataSend.t_reserva=='nac'" class="texttitle">Reservas Nacionales</div>
              <div v-else class="texttitle">Reservas Internacionales</div>
            </div>
          </div>
        </div>
      </div>
      <div class="contLeftSide l_radiusBorder">
        <el-form  
          :model="dataSend" 
          :rules="rules" 
          style="width: 100%;"
          ref="dataSend">
          <div style="display: flex; flex-direction: row; width: 100%; justify-content: flex-end;">
            <div class="subtituloReserva">
            </div>
            <div class="radiogroupp">
              <el-radio-group
                fill="#fafafa"
                text-color="#fafafa"
                @change="switchChange" 
                v-model="reserva_switch" 
                size="small">
                <el-radio
                size="mini"
                  fill="#fafafa"
                  border 
                  :label="1">Reserva Nacional
                </el-radio>
                <el-radio
                  border 
                  size="mini"
                  :label="0">Reserva Internacional
                </el-radio>
              </el-radio-group>
            </div>
          </div>

          <div style="display: flex; flex-direction: row; width: 100%;">
            <div style="display: flex; flex-direction: column; width: 50%;">
              <div class="form_line">
                <el-form-item prop="from_a" style="width: 30%;">
                  <div class="el_label">
                    {{ dataSend.t_reserva=='nac' ? nac_label.from_a.tit : int_label.from_a.tit }}
                  </div>
                  <el-tooltip 
                    popper-class="tool_item" 
                    effect="dark"
                    placement="bottom-start"
                    :content="dataSend.t_reserva=='nac' ? nac_label.from_a.desc : int_label.from_a.desc">
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
                          v-for="item in venezuela"
                          :key="item.estado"
                          :label="item.estado"
                          :value="item.estado">
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
                  </el-tooltip>
                </el-form-item>
                <el-form-item prop="from_b" style="width: 30%;">
                  <div class="el_label">
                    {{ dataSend.t_reserva=='nac' ? nac_label.from_a.tit : int_label.from_a.tit }}
                  </div>
                  <el-tooltip 
                    popper-class="tool_item" 
                    effect="dark"
                    placement="bottom-start"
                    :content="dataSend.t_reserva=='nac' ? nac_label.from_b.desc : int_label.from_b.desc">
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
                          v-for="item in citiesOptions.ciudades"
                          :key="item"
                          :label="item"
                          :value="item">
                        </el-option>
                      </template>
                    </el-select>
                  </el-tooltip>
                </el-form-item>
                <el-form-item prop="description" style="width: 40%;">
                  <div class="el_label">
                    {{ dataSend.t_reserva=='nac' ? nac_label.from_b.tit : int_label.from_b.tit }}
                  </div>
                  <el-tooltip 
                    popper-class="tool_item" 
                    effect="dark"
                    placement="bottom-start"
                    :content="dataSend.t_reserva=='nac' ? nac_label.date_a.desc : int_label.date_a.desc">
                    <el-date-picker
                      style="width:100%" 
                      id="fecha_arribo"
                      v-model="dataSend.date_a"
                      type="date"
                      value-format="yyyy-MM-dd"
                      :placeholder=" dataSend.t_reserva=='nac' ? nac_label.date_a.plac : int_label.date_a.plac">
                    </el-date-picker>
                  </el-tooltip>
                </el-form-item>
              </div>
              <div class="form_line">
                <el-form-item prop="adress_a" style="width: 100%;">
                  <div class="el_label">
                    {{ dataSend.t_reserva=='nac' ? nac_label.adress_a.tit : int_label.adress_a.tit }}
                  </div>
                    <el-tooltip 
                      popper-class="tool_item" 
                      effect="dark"
                      placement="bottom-start"
                      :content="dataSend.t_reserva=='nac' ? nac_label.adress_a.desc : int_label.adress_a.desc">
                      <el-input 
                        type="textarea" 
                        v-model="dataSend.adress_a"
                        id="detailAdress"
                      ></el-input>
                  </el-tooltip>
                </el-form-item>
              </div>            
            </div>
            <div style="display: flex; flex-direction: column; width: 50%; margin-left: 5px;">
              <div class="form_line">
                <el-form-item prop="to_a" style="width: 30%;">
                  <div class="el_label">
                    {{ dataSend.t_reserva=='nac' ? nac_label.to_a.tit : int_label.to_a.tit }}
                  </div>
                  <el-tooltip 
                    popper-class="tool_item" 
                    effect="dark"
                    placement="bottom-start"
                    :content="dataSend.t_reserva=='nac' ? nac_label.to_a.desc : int_label.to_a.desc">
                    <el-select
                      @change="dataSend.t_reserva=='nac' ? getCities2(dataSend.to_a) : getCountriesB()"
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
                            v-for="item in venezuela"
                            :key="item.estado"
                            :label="item.estado"
                            :value="item.estado">
                          </el-option>
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
                  </el-tooltip>
                </el-form-item>
                <el-form-item prop="to_b" style="width: 30%;">
                  <div class="el_label">
                    {{ dataSend.t_reserva=='nac' ? nac_label.to_b.tit : int_label.to_b.tit }}
                  </div>
                  <el-tooltip 
                    popper-class="tool_item" 
                    effect="dark"
                    placement="bottom-start"
                    :content="dataSend.t_reserva=='nac' ? nac_label.to_a.desc : int_label.to_a.desc">
                    <el-select
                      :disabled="dataSend.to_a ? false : true"
                      v-model="dataSend.to_b" 
                      style="width:100%" 
                      clearable 
                      id="ciudadOut" 
                      :placeholder=" dataSend.t_reserva=='nac' ? nac_label.to_a.plac : int_label.to_a.plac"
                      >
                      <template v-if="dataSend.t_reserva=='int'">
                        <el-option
                          v-for="item in temp_states"
                          :key="item.name"
                          :label="item.name"
                          :value="item.name">
                        </el-option>
                      </template>
                      <template v-else>
                        <el-option
                          v-for="item in city_temp_2.ciudades"
                          :key="item"
                          :label="item"
                          :value="item">
                        </el-option>
                      </template>
                    </el-select>
                  </el-tooltip>
                </el-form-item>
                <el-form-item prop="date_b" style="width: 40%;">
                  <div class="el_label">
                    {{ dataSend.t_reserva=='nac' ? nac_label.date_b.desc : int_label.date_b.desc }}
                  </div>
                  <el-tooltip 
                    popper-class="tool_item" 
                    effect="dark"
                    placement="bottom-start"
                    :content="dataSend.t_reserva=='nac' ? nac_label.date_b.desc : int_label.date_b.desc">
                    <el-date-picker
                      value-format="yyyy-MM-dd"
                      style="width:100%" 
                      id="fecha_arribo"
                      v-model="dataSend.date_b"
                      type="date"
                      :placeholder=" dataSend.t_reserva=='nac' ? nac_label.date_b.desc : int_label.date_b.desc"
                      >
                    </el-date-picker>
                  </el-tooltip>
                </el-form-item>
              </div>
              <div class="form_line">
                <el-form-item prop="adress_b" style="width: 100%;">
                  <div class="el_label">
                    {{ dataSend.t_reserva=='nac' ? nac_label.date_b.desc : int_label.date_b.desc }}
                  </div>
                  <el-tooltip 
                    popper-class="tool_item" 
                    effect="dark"
                    placement="bottom-start"
                    :content="dataSend.t_reserva=='nac' ? nac_label.adress_b.desc : int_label.adress_b.desc">
                    <el-input 
                      type="textarea" 
                      v-model="dataSend.adress_b"
                      id="detailAdress"
                    ></el-input>
                  </el-tooltip>
                </el-form-item>
              </div>
            </div>
          </div>
          <div class="form_line">
            <el-form-item prop="motivo" style="width: 50%; ">
              <div class="el_label">
                {{ dataSend.t_reserva=='nac' ? nac_label.motivo.tit : int_label.motivo.tit }}
              </div>
              <el-tooltip 
                popper-class="tool_item" 
                effect="dark"
                placement="bottom-start"
                :content="dataSend.t_reserva=='nac' ? nac_label.motivo.desc : int_label.motivo.desc">
                <el-input 
                  type="textarea" 
                  v-model="dataSend.motivo"
                  id="detailAdress"
                ></el-input>
              </el-tooltip>
            </el-form-item>
            <el-form-item prop="agenda" style="width: 50%; margin-left: 5px;">
              <div class="el_label">
                {{ dataSend.t_reserva=='nac' ? nac_label.agenda.tit : int_label.agenda.tit }}
              </div>
              <el-tooltip 
                popper-class="tool_item" 
                effect="dark"
                placement="bottom-start"
                :content="dataSend.t_reserva=='nac' ? nac_label.agenda.desc : int_label.agenda.desc">
                <el-input 
                  type="textarea" 
                  v-model="dataSend.agenda"
                  id="detailAdress"
                ></el-input>
              </el-tooltip>
            </el-form-item>
          </div>
          <div class="form_line">
            <el-table
                empty-text="Nada para mostrar"
                :data="dataSend.viaticos"
                style="width: 100%; margin: 10px;">
              <template slot="append" class="form_line">
                <div class="form_line">
                  <el-form-item style="width: 30%;" prop="" v-if="switch_flag">
                    <el-tooltip 
                      popper-class="tool_item" 
                      effect="dark"
                      placement="bottom-start"
                      content="Nombre del rubro">
                      <el-input 
                        placeholder="Nombre del rubro"
                        style="width:100%;"
                        v-model="viatico_temp.rubro"
                        size="small"
                        type="text">                    
                      </el-input>
                    </el-tooltip>
                  </el-form-item>
                  <el-form-item style="width: 30%;" prop="" v-else>
                    <el-tooltip 
                      popper-class="tool_item" 
                      effect="dark"
                      placement="bottom-start"
                      content="Seleccione viatico">
                      <el-select 
                        placeholder="Seleccione un rubro"
                        v-model="selection" 
                        clearable 
                        size="small" 
                        @change="itemChange" 
                        style="width:100%;">
                        <el-option
                          v-for="item in rubros"
                          :key="item.value"
                          :label="item.label"
                          :value="item">
                        </el-option>
                      </el-select>
                    </el-tooltip>
                  </el-form-item>
                  <el-form-item style="width: 30%;" prop="">
                    <el-tooltip 
                      popper-class="tool_item" 
                      effect="dark"
                      placement="bottom-start"
                      content="Dias de consumo">
                      <el-input-number 
                        placeholder="Dias"
                        id="diasInput"
                        style="width:100%;"
                        size="small" 
                        v-model="viatico_temp.dias" 
                        :min="0" 
                        :max="100">
                      </el-input-number>
                    </el-tooltip>
                  </el-form-item>
                  <el-form-item style="width: 30%;" prop="">
                    <el-tooltip 
                      popper-class="tool_item" 
                      effect="dark"
                      placement="bottom-start"
                      content="Monto por unidad">
                      <el-input 
                        placeholder="Valor unitario"
                        style="width:100%;"
                        v-model="viatico_temp.unit"
                        size="small"
                        type="text">                    
                      </el-input>
                    </el-tooltip>
                  </el-form-item>
                  <el-form-item style="width: 10%;" class="tableButon">
                    <el-button 
                      @click="addViat"
                      type="info" 
                      icon="el-icon-plus" 
                      size="mini" 
                      circle 
                      style="margin: auto;">
                    </el-button>
                  </el-form-item>
                </div>
              </template>
              <el-table-column
                align     = "center"
                prop      = "rubro"
                label     = "Rubro"
                min-width = "30">
              </el-table-column>
              <el-table-column
                align     = "center"
                prop      = "dias"
                label     = "Dias de consumo"
                min-width = "30">
              </el-table-column>
              <el-table-column
                align     = "center"
                min-width = "30"
                prop      = "val_unit"
                label     = "Monto unitario">
              </el-table-column>
              <el-table-column
                align     = "center"
                min-width = "30"
                prop      = "total"
                label     = "Monto total">
              </el-table-column>
              <el-table-column
                label="Operaciones"
                min-width = "30">
                <template slot-scope="scope">
                  <el-button
                    @click.native.prevent="deleteRow(scope.$index, dataSend.viaticos)"
                    type="text"
                    size="small">
                    Eliminar
                  </el-button>
                </template>
              </el-table-column>
            </el-table>
          </div>
          <div class="form_line buttonsLine">
            <el-button 
              v-if="checkPermisos('reserv002i1','escribe')"
              class="send"
              @click.prevent="validate_send('dataSend')"
              size="small" 
              type="sps1" 
              round>Crear solicitud
            </el-button>
            <el-button 
              class="pause"
              type="warning" 
              size="small" 
              round>Cancelar
            </el-button>
          </div>
        </el-form>
      </div>
    </div>
  </div>
</template>
<style lang="scss" >
  .reservasView{
    .tableButon {
        display: flex;
        justify-content: center;
    }
    .el-table__empty-block{
      display: none;
    }
    .el-table{
      border-radius: 5px !important;
    }
    .el-table td, .el-table th {
      font-size: 12px !important;
      padding: 5px 0 !important;
    }
    .buttonsLine{
      justify-content: flex-start !important;
      margin: 7px 5px;
    }
    .topSideForm{
      flex-direction: row !important;
      justify-content: space-between !important;
    }
    .radiogroupp{
      .el-radio-group {
        padding-top: 4px;
      }
    }
  }
</style>
