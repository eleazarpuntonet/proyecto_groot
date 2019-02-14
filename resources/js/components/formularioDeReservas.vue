<template>
<div id="app" class="rowcentercontainer">
    <b-card no-body class="appblur">
      <b-card-header >
        <strong>Formulario de Solicitud de Servicio de Reservas</strong>
      </b-card-header>
      <b-card-body>
        <b-row>
          <b-col lg="7" md="7">
            <div class="titulo-formulario-reservas">
              <div>
                <img
                  src="../../../public/img/logosps.png"
                  alt="Logo SPS"/>
              </div>
              <div style="text-align:left;">
                <template v-if="dataSend.t_reserva">
                  <h1 v-if="dataSend.t_reserva=='nac'" class="texttitle">Reservas Nacionales</h1>
                  <h1 v-else class="texttitle">Reservas Internacionales</h1>
                </template>
              </div>
            </div>
          </b-col>
          <b-col lg="5" md="5" style="text-align: right;">
            <el-radio-group
              class="radiogroupp"
              fill="#fafafa"
              text-color="#fafafa"
              @change="switchChange" 
              v-model="reserva_switch" 
              size="small">
              <el-radio
                fill="#fafafa"
               class="buttonradio" border :label="1">Reserva Nacional</el-radio>
              <el-radio class="buttonradio" border :label="0">Reserva Internacional</el-radio>
            </el-radio-group>
          </b-col>
        </b-row>

       
        <!-- 
        * Formulario para reservas NACIONALES E INTERNACIONALES
         -->
        <template v-if="dataSend.t_reserva">
          <el-form  
            :model="dataSend" 
            :rules="rules" 
            ref="dataSend">

                <div style="display:flex; width:100%">
                  
                  <el-col class="boxshadow" :span="12" style="margin-bottom:0px; margin-left:2.5px;">
                    <el-col :span="7">
                      <div class="l_label labelm">
                        {{ dataSend.t_reserva=='nac' ? nac_label.from_a.tit : int_label.from_a.tit }}
                      </div>
                      <el-form-item prop="from_a">
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
                    </el-col>

                    <el-col :span="7">
                      <div class="l_label labelm">
                        {{ dataSend.t_reserva=='nac' ? nac_label.from_a.tit : int_label.from_a.tit }}
                      </div>
                      <el-form-item prop="from_b">
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
                    </el-col>

                    <el-col :span="10">
                      <div class="l_label labelm">
                        {{ dataSend.t_reserva=='nac' ? nac_label.from_b.tit : int_label.from_b.tit }}
                      </div>
                      <el-form-item prop="description">
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
                    </el-col>

                    <el-col :span="24">
                      <div class="l_label labelm">
                        {{ dataSend.t_reserva=='nac' ? nac_label.adress_a.tit : int_label.adress_a.tit }}
                      </div>
                      <el-form-item prop="adress_a">
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
                    </el-col>
                  </el-col>

                  <el-col class="boxshadow" :span="12" style="margin-bottom:0px; margin-right:0px;">
                    <el-col :span="7">
                      <div class="l_label labelm">
                        {{ dataSend.t_reserva=='nac' ? nac_label.to_a.tit : int_label.to_a.tit }}
                      </div>
                      <el-form-item prop="to_a">
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
                    </el-col>
                    <el-col :span="7">
                      <div class="l_label labelm">
                        {{ dataSend.t_reserva=='nac' ? nac_label.to_b.tit : int_label.to_b.tit }}
                      </div>
                      <el-form-item prop="to_b">
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
                    </el-col>
                    <el-col :span="10">
                      <div class="l_label labelm">
                        {{ dataSend.t_reserva=='nac' ? nac_label.date_b.desc : int_label.date_b.desc }}
                      </div>
                      <el-form-item prop="date_b">
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
                    </el-col>
                    <el-col :span="24">
                      <div class="l_label labelm">
                        {{ dataSend.t_reserva=='nac' ? nac_label.date_b.desc : int_label.date_b.desc }}
                      </div>
                      <el-form-item prop="adress_b">
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
                    </el-col>
                  </el-col>

                </div>

                <div class="boxshadow" style="display:table; width:100%">
                  <el-col :span="12">
                    <div class="l_label labelm">
                      {{ dataSend.t_reserva=='nac' ? nac_label.motivo.tit : int_label.motivo.tit }}
                    </div>
                    <el-form-item prop="motivo">
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
                  </el-col>
                  <el-col :span="12">
                    <div class="l_label labelm">
                      {{ dataSend.t_reserva=='nac' ? nac_label.agenda.tit : int_label.agenda.tit }}
                    </div>
                    <el-form-item prop="agenda">
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
                  </el-col>
                </div>

                <div class="boxshadow" style="display:table; width:100%">
                  <el-col :span="8" v-if="switch_flag">
                    <div class="l_label labelm">
                      Nombre
                    </div>
                    <el-form-item prop="">
                      <el-tooltip 
                        popper-class="tool_item" 
                        effect="dark"
                        placement="bottom-start"
                        content="Nombre del rubro">
                        <el-input 
                          style="width:100%;"
                          v-model="viatico_temp.rubro"
                          size="small"
                          type="text">                    
                        </el-input>
                      </el-tooltip>
                    </el-form-item>
                  </el-col>
                  <el-col :span="8" v-else>
                    <div class="l_label labelm">
                      Viatico
                    </div>
                    <el-form-item prop="">
                      <el-tooltip 
                        popper-class="tool_item" 
                        effect="dark"
                        placement="bottom-start"
                        content="Seleccione viatico">
                        <el-select v-model="selection" clearable placeholder="Select" size="small" @change="itemChange" style="width:100%;">
                          <el-option
                            v-for="item in rubros"
                            :key="item.value"
                            :label="item.label"
                            :value="item">
                          </el-option>
                        </el-select>
                      </el-tooltip>
                    </el-form-item>
                  </el-col>
                  <el-col :span="8">
                    <div class="l_label labelm">
                      Dias
                    </div>
                    <el-form-item prop="">
                      <el-tooltip 
                        popper-class="tool_item" 
                        effect="dark"
                        placement="bottom-start"
                        content="Dias de consumo">
                        <el-input-number 
                          id="diasInput"
                          style="width:100%;"
                          size="small" 
                          v-model="viatico_temp.dias" 
                          :min="0" 
                          :max="100">
                        </el-input-number>
                      </el-tooltip>
                    </el-form-item>
                  </el-col>
                  <el-col :span="6">
                    <div class="l_label labelm">
                      Monto unitario
                    </div>
                    <el-form-item prop="">
                      <el-tooltip 
                        popper-class="tool_item" 
                        effect="dark"
                        placement="bottom-start"
                        content="Monto por unidad">
                        <el-input 
                          style="width:100%;"
                          v-model="viatico_temp.unit"
                          size="small"
                          type="text">                    
                        </el-input>
                      </el-tooltip>
                    </el-form-item>
                  </el-col>
                  <el-col 
                    :span="2" 
                    style="height: 7vh;display: flex;justify-content: center;">
                    <el-button 
                      @click="addViat"
                      type="info" 
                      icon="el-icon-plus" 
                      size="mini" 
                      circle 
                      style="margin: auto;">
                    </el-button>
                  </el-col>
                </div>

                <div class="boxshadow" style="display:table; width:100%" v-if="this.dataSend.viaticos != 0">
                  <el-col :span="24">
                    <el-table
                    show-summary
                    sum-text="Total viaticos"
                      :data="dataSend.viaticos"
                      style="width: 100%">
                      <el-table-column
                      sortable
                        prop="rubro"
                        label="Rubro"
                        width="180">
                      </el-table-column>
                      <el-table-column
                      sortable
                        prop="val_unit"
                        label="Valor/unidad">
                      </el-table-column>
                      <el-table-column
                      sortable
                        prop="total"
                        label="Total">
                      </el-table-column>
                      <el-table-column
                        label="Acciones">
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
                  </el-col>
                </div>

                <div class="boxshadow" style="display:table; width:100%">
                  <el-button 
                  class="buttoncontrolsend"
                    @click.prevent="validate_send('dataSend')"
                    size="small" 
                    type="primary" 
                    round>Enviar</el-button>
                  <el-button 
                  class="buttoncontrolcancel"
                    type="warning" 
                    size="small" 
                    round>Cancelar</el-button>
                </div>  
            </el-form>

        </template>

      </b-card-body>
    </b-card>
</div>
</template>

<script>
import data_countries from '../data_countries.json';
import venezuela from '../venezuela.json';
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

      // dataSend : {
       //   alcance: null,
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
        alcance   : null,
        id_user   : this.$store.getters.currentUser.id,
        t_reserva : null,
        from_a    : 'Caracas',
        from_b    : 'Catia',
        adress_a  : 'Catia nro 58 496',
        date_a    : '2017-11-14',
        to_a      : 'Paris',
        to_b      : 'Francia',
        adress_b  : 'Bla bla bla',
        date_b    : '2017-11-20',
        motivo    : 'Viajes',
        agenda    : 'Viajar',
        viaticos  : [],
      },
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
  methods: {
    deleteRow(index, rows) {
      rows.splice(index, 1);
    },
    itemChange(item){
      // console.log(item)
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
      console.log('Ejecuto')
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
          console.log(val)
          // this.citiesOptions=val.ciudades
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
          console.log(val)
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
              this.$router.push({
                path: `/reservas/${response.data.id}` 
              })
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
  beforeMount(){

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
<style lang="scss" >
$colorpantonered: #EF4034;
$colorpantone254: #91268F;
$colorpantone285: #007CC2;
$colorpantone368: #7AC142;
$colorpantone143: #FBAF3F;
$colorblanco: #fafafa;
$pantonetext: #6D6E70;
.radiogroupp{
  .el-radio__label{
   color: #231F20 !important;
  }
  label{
    border : 1px solid $pantonetext !important;
    background-color: rgba(251, 175, 63, 0.6);
  }
  label.is-checked{
    border : 1px solid $pantonetext !important;
    background-color: rgba(251, 175, 63, 0.75);
  }
}
.is-checked{
  .el-radio__inner{
    background-color: $pantonetext !important;      
    border-color: $pantonetext !important;    
  }
  .el-radio__label{
    color: $colorblanco !important;    
  }
}


.buttonradio{
  // color:#FBAF3F;
}
.titulo-formulario-reservas{
  display: flex;
  flex-direction: row;
  margin-bottom: 15px;
  .space{
    text-align: right;
  }
  // justify-content: center;
  div{
    margin-left: 5px;
    img{
      width: 5em;
    }
  }
}
.buttoncontrolcancel{
  font-family: 'Eurostile LTS Demi';
  background-color: rgba(109, 110, 113, 1);
  border: white;
  &:hover {
      background-color: #FBAF3F;
      color:#241C14;
  }    
}
.buttoncontrolsend{
  &:hover {
      background-color: #FBAF3F;
      color:#241C14;
  }                     
  font-family: 'Eurostile LTS Demi';
  background-color: rgba(35, 31, 32, 1);
  border: white;
}
label{
  font-family: 'Eurostile LTS';
  // text-shadow: 3px 3px 4px rgba(145,38,143, 0.7);
  color:rgba(109, 110, 113, 1);
  &:hover {
      font-weight: bold;
      color:rgba(36, 28, 20, 1);
  }
}

.text-muted{
  color:red;
}
.texttitle{
  padding: 0px;
  &:hover {
      text-shadow: 2px 2px 6px rgba(0, 0, 0, 1);
  } 
  display: flex;
  color: #BBBDC0;
  font-family: 'Eurostile LTS Demi';
  // text-shadow: 2px 2px 4px rgba(187, 189, 192, 0.7);
  text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
  text-transform: uppercase;
}
.img_logo{
  img{
    width: 5em;
  }
}
.info{
  margin: 10px;
  border: 1px solid rgba(220, 223, 230, 1);
  margin-top: 0px;
  border-radius: 3px;
  align-items: center;
  padding: 5px;
}
.section_viat{
  margin: 10px;
}
.item_viat{
  text-align: center;
}
.el-select{
  display: block !important;
  width: 100%;
}
.formsection{
  // border: 1px solid black;
  margin: 8px;
  border-radius: 5px;
  padding: 5px;
  box-shadow: 2px 2px 5px 3px rgba(136, 136, 136, 0.6);
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
.tool_item{
  background-color: red;
}
</style>
