<template>
  <b-row class="mainWindow">
    <b-col class="sideMenu" md="4" lg="4" xl="4">
      <el-table
      :highlight-current-row="true"
        :show-header=false
        :data="lista_resevas"
        style="width: 100%"
        @current-change="rowClick"
        max-height="100%">
        <el-table-column
          fixed
          prop="alcance"
          width="100%">
        </el-table-column>
        <el-table-column
          fixed
          prop="user.name"
          width="100%">
        </el-table-column>
        <el-table-column
          fixed
          prop="destino_b"
          width="100%">
        </el-table-column>
      </el-table>
    </b-col>
    <b-col md="8" lg="8" xl="8">
      <b-row class="databox" v-if="res_select">
        <b-col class="titlebox title" md="12" lg="12" xl="12">
          <div>
            <i class="icon-title fas fa-user"></i>
          </div>
          <div>
            <h2 class="l_titulo">{{ res_select.getFullname() }}</h2>
          </div>
          <div>
            <p class="ptext main-text"></strong> {{ res_select.user_depto }}</p>
          </div>
        </b-col>
        <b-col class="databoxItem">
          <div class="dItem">
            <i class="fas main-icon fa-plane-departure"></i>
            <p class="ptext main-text"><strong>{{ res_select.origen_a }} </strong>{{ res_select.origen_b }}</p>
          </div>
          <div class="dItem">
            <i class="fas main-icon fa-map-marker-alt"></i>
            <p class="ptext main-text">{{ res_select.origen_det }}</p>
          </div>
          <div class="dItem">
            <i class="fas main-icon fa-calendar-alt"></i>
            <p class="ptext main-text">{{ res_select.getDate('origen') }}</p>
          </div>
          <div class="dItem">
            <i class="fas main-icon fa-taxi"></i>
            <p class="ptext main-text">Traslados</p>
          </div>
        </b-col>

        <b-col class="databoxItem">
          <div class="dItem">
            <i class="fas main-icon fa-plane-arrival"></i>
            <p class="ptext main-text"><strong>{{ res_select.destino_a }} </strong>{{ res_select.destino_b }}</p>
          </div>
          <div class="dItem">
            <i class="fas main-icon fa-map-marker-alt"></i>
            <p class="ptext main-text">{{ res_select.destino_det }}</p>
          </div>
          <div class="dItem">
            <i class="fas main-icon fa-calendar-alt"></i>
            <p class="ptext main-text">{{ res_select.getDate() }}</p>
          </div>
          <div class="dItem">
            <i class="fas main-icon fa-taxi"></i>
            <p class="ptext main-text">Traslados</p>
          </div>
        </b-col>

        <b-col class="databoxItem" md="12" lg="12" xl="12">
          <div class="bottom_box">
            <div class="traslado">
              <div class="trasItem">
                <i class="fas main-icon fa-bus"></i>
                <p class="ptext main-text"> Bus </p>
                <p class="ptext main-text"> 15/10/2017 </p>
              </div>
              <div class="trasItem">
                <p class="ptext main-text"> <strong>22:00 - 23:00</strong> </p>
              </div>
              <div class="trasItem bottomtext">
                <div class="textbox">
                  <p class="ptext main-text"> Traslado en transporte urbano al distrito xxxx </p>
                </div>
              </div>
            </div>
            <div class="traslado">
              <div class="trasItem">
                <i class="fas main-icon fa-car"></i>
                <p class="ptext main-text"> Auto de flota </p>
                <p class="ptext main-text"> 15/10/2017 </p>
              </div>
              <div class="trasItem">
                <p class="ptext main-text"> <strong>00:00 - 00:15</strong> </p>
              </div>
              <div class="trasItem bottomtext">
                <div class="textbox">
                  <p class="ptext main-text"> En el distrito xxx se le hace entrega del automovil previamente rentado </p>
                </div>
              </div>
            </div>
            <div class="traslado">
              <div class="trasItem ">
                <i class="fas main-icon fa-car"></i>
                <p class="ptext main-text"> Auto de flota </p>
                <p class="ptext main-text"> 16/10/2017 </p>
              </div>
              <div class="trasItem">
                <p class="ptext main-text"> <strong>08:30 - 08:50</strong> </p>
              </div>
              <div class="trasItem bottomtext">
                <div class="textbox">
                  <p class="ptext main-text"> Traslado desde alojamiento </p>
                </div>
              </div>
            </div>
            <div class="traslado">
              <div class="trasItem " >
                <i class="fas main-icon fa-car"></i>
                <p class="ptext main-text"> Auto de flota </p>
                <p class="ptext main-text"> 16/10/2017 </p>
                <div class="botonClose">
                  <i class="el-icon-circle-close-outline"></i>
                </div>
              </div>
              <div class="trasItem">
                <p class="ptext main-text"> <strong>18:00 - 18:30</strong> </p>
              </div>
              <div class="trasItem bottomtext">
                <div class="textbox">
                  <p class="ptext main-text"> Traslado desde centro empresarial </p>
                </div>
              </div>
            </div>
            <div class="traslado">
              <div class="trasItem ">
                <i class="fas main-icon fa-plane"></i>
                <p class="ptext main-text"> Vuelo </p>
                <p class="ptext main-text"> 19/10/2017 </p>
              </div>
              <div class="trasItem">
                <p class="ptext main-text"> <strong>03:00 - 04:00</strong> </p>
              </div>
              <div class="trasItem bottomtext">
                <div class="textbox">
                  <p class="ptext main-text"> Vuelo con destino al aeropuerto de maiquetia </p>
                </div>
              </div>
            </div>
            <div class="traslado">
              <div class="trasItem">
                <i class="fas main-icon fa-plane"></i>
                <p class="ptext main-text"> Vuelo </p>
                <p class="ptext main-text"> 19/10/2017 </p>
              </div>
              <div class="trasItem">
                <p class="ptext main-text"> <strong>03:00 - 04:00</strong> </p>
              </div>
              <div class="trasItem bottomtext">
                <div class="textbox">
                  <p class="ptext main-text"> Vuelo con destino al aeropuerto de maiquetia </p>
                </div>
              </div>
            </div>
            <div class="traslado">
              <div class="trasItem">
                <i class="fas main-icon fa-plane"></i>
                <p class="ptext main-text"> Vuelo </p>
                <p class="ptext main-text"> 19/10/2017 </p>
              </div>
              <div class="trasItem">
                <p class="ptext main-text"> <strong>03:00 - 04:00</strong> </p>
              </div>
              <div class="trasItem bottomtext">
                <div class="textbox">
                  <p class="ptext main-text" > Vuelo con destino al aeropuerto de maiquetia </p>
                </div>
              </div>
            </div>
            <div class="traslado">
              <div class="trasItem">
                <i class="fas main-icon fa-plane"></i>
                <p class="ptext main-text"> Vuelo </p>
                <p class="ptext main-text"> 19/10/2017 </p>
              </div>
              <div class="trasItem">
                <p class="ptext main-text"> <strong>03:00 - 04:00</strong> </p>
              </div>
              <div class="trasItem bottomtext">
                <div class="textbox">
                  <p class="ptext main-text"> Vuelo con destino al aeropuerto de maiquetia </p>
                </div>
              </div>
            </div>
            <div class="traslado">
              <div class="trasItem">
                <i class="fas main-icon fa-plane"></i>
                <p class="ptext main-text"> Vuelo </p>
                <p class="ptext main-text"> 19/10/2017 </p>
              </div>
              <div class="trasItem">
                <p class="ptext main-text"> <strong>03:00 - 04:00</strong> </p>
              </div>
              <div class="trasItem bottomtext">
                <div class="textbox">
                  <p class="ptext main-text"> Vuelo con destino al aeropuerto de maiquetia </p>
                </div>
              </div>
            </div>
          </div>
        </b-col>

        <b-row class="databoxItem">
          <b-col class="itemForm" md="5" lg="5" xl="5">
            <div class="label">
              <p class="ptext">Tipo</p>
            </div>
            <el-select 
            size="small"
              class="timepicket"
              v-model="traslado.tipo" 
              placeholder="Tipo de traslado">
              <el-option
                v-for="item in tipos_traslados"
                :key="item.value"
                :label="item.label"
                :value="item.value"
                :disabled="item.disabled">
              </el-option>
            </el-select>
            <div class="minilabel">
              <p class="ptext">Seleccione el tipo de transporte que quiere asignar</p>
            </div>
          </b-col>
          <b-col class="itemForm" md="2" lg="2" xl="2">
            <div class="label">
              <p class="ptext">Localidad</p>
            </div>
            <el-select
              size="small"
              class="timepicket"
              v-model="traslado.localidad" 
              placeholder="Localidad del traslado">
              <el-option
                v-for="item in localidad"
                :key="item.value"
                :label="item.label"
                :value="item.value"
                :disabled="item.disabled">
              </el-option>
            </el-select>
            <div class="minilabel">
              <p class="ptext">Localidad del traslado</p>
            </div>
          </b-col>

          
          <b-col class="itemForm" md="5" lg="5" xl="5">
            <div class="label">
              <p class="ptext">Hora</p>
            </div>
            <el-time-select
              size="small"
              v-model="traslado.hora"
              :picker-options="{
                start: '00:00',
                step: '00:15',
                end: '23:59'
              }"
              placeholder="Select time">
            </el-time-select>
            <div class="minilabel">
              <p class="ptext">Seleccione la hora de traslado aproximada, y rango de tiempo preventivo</p>
            </div>
          </b-col>


          <b-col class="itemForm" md="6" lg="6" xl="6">
            <div class="label">
              <p class="ptext">Origen</p>
            </div>
            <el-input
              size="small"
              type="text"
              :rows="2"
              placeholder="Please input"
              v-model="traslado.origen">
            </el-input>
            <div class="minilabel">
              <p class="ptext">Origen del traslado</p>
            </div>
          </b-col>
          <b-col class="itemForm" md="6" lg="6" xl="6">
            <div class="label">
              <p class="ptext">Destino</p>
            </div>
            <el-input
              size="small"
              type="text"
              :rows="2"
              placeholder="Please input"
              v-model="traslado.destino">
            </el-input>
            <div class="minilabel">
              <p class="ptext">Destino del traslado</p>
            </div>
          </b-col>

          <b-col class="itemForm" md="9" lg="9" xl="9">
            <div class="label">
              <p class="ptext">Descripcion</p>
            </div>
            <el-input
            size="small"
              type="textarea"
              :rows="2"
              placeholder="Please input"
              v-model="traslado.description">
            </el-input>
            <div class="minilabel">
              <p class="ptext">Detalles del traslado</p>
            </div>
          </b-col>
          <b-col class="itemForm buttonAdd" md="3" lg="3" xl="3">
            <el-button type="primary" @click="sendtraslado">Agregar Traslado</el-button>
          </b-col>
        </b-row>
      </b-row>
    </b-col>
  </b-row>
</template>

<script>
class Reservaitem{
  constructor(item){
    this.id             = item.id
    this.origen_a       = item.origen_a
    this.origen_b       = item.origen_b
    this.origen_det     = item.origen_det
    this.fecha_partida  = item.fecha_partida
    this.fecha_retorno  = item.fecha_retorno
    this.destino_a      = item.destino_a
    this.destino_b      = item.destino_b
    this.destino_det    = item.destino_det
    this.traslados      = item.traslados
    this.user_name      = item.user.name
    this.user_last_name = item.user.last_name
    this.user_depto     = item.user.departamento.disp_name
    this.user_cargo     = item.user.cargo
  }

  getFullname(){
    return `${this.user_name} ${this.user_last_name}`
  } 

  getDate(which){
    if (which=='origen') {
      var a = new Date(this.fecha_partida)
      return `${a.getDate()}/${a.getMonth()}/${a.getFullYear()}`
    } else {
      var a = new Date(this.fecha_retorno)
      return `${a.getDate()}/${a.getMonth()}/${a.getFullYear()}`
    }
  } 
}

class Traslado{
  constructor(item){
    this.tipo        = item.tipo
    this.localidad   = item.localidad
    this.hora        = item.hora
    this.descripcion = item.description
    this.reserva_id  = item.reservaid
    this.proveedor   = 1
    this.origen      = item.origen
    this.destino     = item.destino
    
  }

  setUser(id){
    this.user_id     = id
  }
}

export default {

  /*
  *
  * Variables del componente
  */
  data () {
    return {
      traslado: {
        tipo        : null,
        localidad   : null,
        hora        : null,
        origen      : null,
        destino     : null,
        description : null,
        user_id     : null,
      },
      textarea:'',
      step:15,
      unidad: 'Minutos',
      num3: 0,
      tiempo: 0,
      value4: [new Date(), new Date()],
      tipos_traslados: [{
        value: 'Taxi',
        label: 'Taxi'
      }, {
        value: 'Vuelo',
        label: 'Vuelo',
      }, {
        value: 'Bus',
        label: 'Bus'
      }, {
        value: 'Auto',
        label: 'Auto'
      }],
      localidad: [{
        value: 'Origen',
        label: 'Origen'
      }, {
        value: 'Destino',
        label: 'Destino',
      }],
      local: '',
      res_select: null,
      lista_resevas: [],
      bottom: false,
    }
  },
  computed: {
  },
  watch: {
    bottom(bottom) {
      if (bottom) {
        this.onInfinite()
      }
    }
  },
  methods: {
    sendtraslado(){
      console.log('Envia traslado')

      var a = new Traslado(this.traslado)
      var user = this.$store.getters.currentUser
      a.setUser(user.id)
      console.log(a)
      axios.post(route('traslados.store'),a) 
          .then(response => {
            console.log(response)
              this.$notify({
                title: response.status,
                message: 'Registro creado!',
                type: 'success'
              });
            })
          .catch(error => {
            this.$notify.error({
              title: 'Error '+error.response.status,
              message: error.response.data.message
            });
          })
    },
    numberChange(value){
      console.log(value)
      if (this.traslado.t_estimado_=='Minutos' && value>=60) {
        this.traslado.t_estimado_ = "Horas"
        this.step   = 1
        this.traslado.t_estimado = 1
        this.num3   = 1
      } else if (this.traslado.t_estimado_=="Horas" && value>=24){
        this.traslado.t_estimado_ = "Dias"
        this.step   = 1
        this.traslado.t_estimado = 1
        this.num3   = 1
      } else 
      {
        this.traslado.t_estimado = value
      }


      if (this.traslado.t_estimado_=="Dias" && value==0) {
        this.traslado.t_estimado_ = "Horas"
        this.step   = 1
        this.traslado.t_estimado = 24
        this.num3   = 24
      } else if (this.traslado.t_estimado_=="Horas" && value==0) {
        this.traslado.t_estimado_ = "Minutos"
        this.step   = 15
        this.traslado.t_estimado = 59
        this.num3   = 59
      }

    },
    deleteRow(index, rows) {
      rows.splice(index, 1);
    },
    rowClick(row){
      this.res_select         = new Reservaitem(row);
      this.traslado.reservaid = row.id
      console.log(this.traslado)
    },
    bottomVisible() {
      const tabla   = document.getElementsByClassName('el-table__body-wrapper')[0]
      var offset    = tabla.offsetHeight
      var scrolltop = tabla.scrollTop
      var scroll    = tabla.scrollHeight

      if (offset + scrolltop === scroll) {
        return true
      }
      return false
    },
    onInfinite() {
      // setTimeout(() => {
      //   axios.get(route('reservas.index'),{page : this.pagination.currentPage++}) 
      //       .then(response => {
      //         this.pagination.nextPagePath = response.data.reservas.next_page_url
      //         this.pagination.prevPagePath = response.data.reservas.prev_page_url
      //         this.pagination.currentPage  = response.data.reservas.current_page
      //         if (!!this.dataReservas) {
      //           this.dataReservas = this.dataReservas.concat(response.data.reservas.data);
      //         } else {
      //           this.dataReservas = response.data.reservas.data
      //         }
      //         })
      //       .catch(error => {
      //         console.log(error)
      //       })
       
      // }, 1000);
    },
  },
  beforeMount(){
  },
  created() {
  },
  mounted(){
      document.getElementsByClassName('el-table__body-wrapper')[0].addEventListener('scroll', () => {
        this.bottom = this.bottomVisible()
      })
      axios.get(route('reservas.index')) 
          .then(response => {
            // this.pagination.nextPagePath = response.data.reservas.next_page_url
            // this.pagination.prevPagePath = response.data.reservas.prev_page_url
            // this.pagination.currentPage  = response.data.reservas.current_page
            // this.pagination.lastPage     = response.data.reservas.to
            this.lista_resevas            = response.data.reservas.data
            console.log('TRaslados')
              console.log(response.data.reservas)
            })
          .catch(error => {
            console.log(error)
            // this.$notify.error({
            //   title: 'Error '+error.response.status,
            //   message: error.response.data.message
            // });
          })
  }
}
</script>
<style lang="scss">
.formGroup{
  margin: 5px;
}
.bottomtext{
  margin-bottom: 3px;
}
.botonClose{
  display: flex;
  flex-flow: row wrap;
  justify-content: right;
}
.buttonAdd{
  display: flex;
  flex-direction: column;
  justify-content: center;
}
.itemForm{
  padding-right: 5px;
  padding-left: 5px;
}
.label{
  color:  rgba(0, 0, 0, 0.8);
  font-size: 0.8em;
  font-weight: bold;
  text-shadow: 2px 2px 4px rgba(128, 128, 128, 0.9);
}
.minilabel{
  color:  rgba(0, 0, 0, 0.6);
  font-size: 0.7em;
  font-style: italic;
  text-shadow: 2px 2px 4px rgba(128, 128, 128, 0.9);
}
.timepicket{
  width: 100% !important;
}
.ptext{
  margin-bottom: 0px;
}
#separador2{
  height:1px;
  margin-top: 10px;
  margin-bottom: 10px;
  border-bottom:1px solid white;
}
.mainWindow{
  // background-color: rgba(201, 237, 243,0.3);
  .sideMenu{
    display: flex;
    flex-direction: column;
    padding-right: 0px;
    padding-left: 0px;

  }
  .databox{
    .title{
      display: flex;
      flex-direction: row;
      padding: 5px;
      line-height: 1.3em;
      font-size: 1.2em;
      text-align: center;
      background-color: rgba(201, 237, 243, 0.5);
    }
    .databoxItem{
      background-color: white;
      margin: 8px;
      border-radius: 5px;
      padding: 5px;
      box-shadow: 2px 2px 5px 3px rgba(136, 136, 136, 0.6);
      .top_box{
        padding-left: 5px;
        padding-right: 5px;
      }
      .bottom_box{
        border-radius: 5px;
        height: 25em;
        overflow-y: scroll;
      }
      .dItem{
        display: flex;
        flex-direction: row;
        font-size: 1em;
        vertical-align: middle;
        i{
          margin: 5px;
        }
      }
      .traslado{
        background-color: rgba(187, 189, 192, 0.2);
        box-shadow: 2px 2px 4px 3px rgba(187, 189, 192, 0.7);
        margin: 5px;
        padding: 3px;
        border-radius: 5px;
        border: 1.5px solid rgba(35, 31, 32, 0.5);
        .trasItem{
          i{
            margin-top: auto;
            margin-bottom: auto;
          }
          p{
            margin-top: 2px;
            margin-right: 3px;
            margin-bottom: 2px;
            margin-left: 3px;
          }
            display: flex;
            flex-direction: row;
            margin-left:3px;
            margin-right: 3px;
            font-size: 0.8em;
        }
      }
    }
  }
}


</style>
