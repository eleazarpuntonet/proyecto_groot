<template>
  <div>
    <b-row class="mainWindow">
      <b-col class="sideMenu" md="4" lg="4" xl="4">
        <el-table
          class="roundborder"
          :highlight-current-row="true"
          :show-header=false
          :data="lista_resevas"
          style="box-shadow: 0px 2px 5px 3px rgba(136, 136, 136, 0.6);"
          @current-change="rowClick"
          >
          <el-table-column
            fixed
            align="center"
            prop="user"
            width="40%">
            <template slot-scope="scope">
              <div class="tableicon">
                <img
                  :src="'/storage'+scope.row.user.avatar"
                  class="img-avatar"
                  alt="admin@bootstrapmaster.com" />
              </div>
            </template>
          </el-table-column>
          <el-table-column
            fixed
            align="center"
            prop="user"
            width="100%">
            <template slot-scope="scope">
              <div class="tableicon">
                  {{scope.row.user.name}} {{scope.row.user.last_name}}
              </div>
            </template>
          </el-table-column>
          <el-table-column
            fixed
            align="center"
            prop="alcance"
            width="100%">
          </el-table-column>
          <el-table-column
            fixed
            align="center"
            prop="destino_a"
            width="100%">
          </el-table-column>
        </el-table>
      </b-col>
      <b-col md="8" lg="8" xl="8">
        <b-row class="databox" v-if="res_select">
          <div class="container_flexbox boxshadow rowflex">
            <div class="colflex">
              <div class="icon_container flexcenter">
                <img
                  :src="'/storage'+res_select.user_avatar"
                  class="img-avatar"
                  alt="admin@bootstrapmaster.com" />
              </div>
            </div>
            <div class="colflex">
              <div>
                <h2 class="l_titulo" style="margin-bottom: -0.5rem;">{{ res_select.getFullname() }}</h2>
              </div>
              <div>
                </strong> {{ res_select.user_depto }}
              </div>
            </div>
          </div>

          <div class="container_flexbox tableflex">
            <div class="boxshadow databoxItem">
              <div class="dItem">
                <i class="fas main-icon fa-plane-departure"></i>
                <strong>{{ res_select.origen_a }} </strong>{{ res_select.origen_b }}
              </div>
              <div class="dItem">
                <i class="fas main-icon fa-map-marker-alt"></i>
                {{ res_select.origen_det }}
              </div>
              <div class="dItem">
                <i class="fas main-icon fa-calendar-alt"></i>
                {{ res_select.getDate('origen') }}
              </div>
            </div>

            <div class="boxshadow databoxItem">
              <div class="dItem">
                <i class="fas main-icon fa-plane-arrival"></i>
                <strong>{{ res_select.destino_a }} </strong>{{ res_select.destino_b }}
              </div>
              <div class="dItem">
                <i class="fas main-icon fa-map-marker-alt"></i>
                {{ res_select.destino_det }}
              </div>
              <div class="dItem">
                <i class="fas main-icon fa-calendar-alt"></i>
                  {{ res_select.getDate() }}
              </div>
            </div>
          </div>

          <div class="container_flexbox databoxItem boxshadow trasladostable">
            <div class="l_label labelm" v-if="!res_select.traslados.length>0">
              Esta reserva no tiene traslados asignados
            </div>
            <div v-else>
              <div class="traslado" 
              v-for="item in res_select.traslados"
              >
                <div class="trasItem textbox">
                  <i class="fas main-icon fa-plane" v-if="item.tipo=='Vuelo'"></i>
                  <i class="fas main-icon fa-taxi" v-if="item.tipo=='Taxi'"></i>
                  <i class="fas main-icon fa-car" v-if="item.tipo=='Auto'"></i>
                  <i class="fas main-icon fa-bus-alt" v-if="item.tipo=='Bus'"></i>
                </div>
                <div class="trasItem textbox">
                  {{item.tipo}}
                </div>
                <div class="trasItem textbox">
                  <strong>22:00 - 23:00</strong>
                </div>
                <div class="trasItem bottomtext">
                  <div class="textbox">
                    Desde: {{item.origen}}
                  </div>
                </div>
                <div class="trasItem bottomtext">
                  <div class="textbox">
                    Hasta: {{item.destino}}
                  </div>
                </div>
                <div class="trasItem bottomtext">
                  <div class="textbox">
                    {{item.descripcion}}
                  </div>
                </div>
              </div>

            </div>
          </div>

          <el-form  
            class="boxshadow"
            :model="traslado" 
            :rules="rules" 
            ref="traslado">
              <el-col :span="8">
                <div class="l_label labels">
                  <p class="ptext">Tipo</p>
                </div>
                <el-form-item prop="tipo">
                  <el-select 
                    style="width: 100%;"
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
                </el-form-item>
              </el-col>
              <el-col :span="8">
                <div class="l_label labels">
                  <p class="ptext">Localidad</p>
                </div>
                <el-form-item prop="localidad">
                  <el-select
                    style="width: 100%;"
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
                </el-form-item>
              </el-col>
              <el-col :span="8">
                <div class="l_label labels">
                  <p class="ptext">Hora</p>
                </div>
                <el-form-item prop="hora">
                  <el-time-select
                    style="width: 100%;"
                    size="small"
                    v-model="traslado.hora"
                    :picker-options="{
                      start: '00:00',
                      step: '00:15',
                      end: '23:59'
                    }"
                    placeholder="Select time">
                  </el-time-select>
                </el-form-item>
              </el-col>
            
            <el-col :span="12">
              <div class="l_label labels">
                <p class="ptext">Origen</p>
              </div>
              <el-form-item prop="origen">
                <el-input
                  style="width: 100%;"
                  size="small"
                  type="text"
                  :rows="2"
                  placeholder="Origen"
                  v-model="traslado.origen">
                </el-input>
              </el-form-item>
            </el-col>
            <el-col :span="12">
              <div class="l_label labels">
                <p class="ptext">Destino</p>
              </div>
              <el-form-item prop="destino">
                <el-input
                  style="width: 100%;"
                  size="small"
                  type="text"
                  :rows="2"
                  placeholder="Destino"
                  v-model="traslado.destino">
                </el-input>
              </el-form-item>
            </el-col>
            <el-col :span="24">
              <div class="l_label labels">
                <p class="ptext">Descripcion</p>
              </div>
              <el-form-item prop="description">
                <el-input
                  style="width: 100%;"
                  size="small"
                  type="text"
                  :rows="2"
                  placeholder="Descripcion"
                  v-model="traslado.description">
                </el-input>
              </el-form-item>
            </el-col>
            <el-col 
              :span="24"
              class="button_content">
              <el-button
              size="mini" 
              type="primary" 
              @click="submitForm('traslado')">
              Agregar</el-button>
              <el-button
              size="mini" 
              @click="resetForm('traslado')">
              Reset</el-button>
            </el-col>
          </el-form>

        </b-row>
      </b-col>
    </b-row>
  </div>
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
    this.user_avatar     = item.user.avatar
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
      rules: {
               tipo: [
                 { 
                  required : true,
                  message  : 'Seleccione un tipo de traslado',
                  trigger  : 'change'
                },
               ],
               localidad: [
                 { 
                  required : true,
                  message  : 'Seleccione una region de origen o destino',
                  trigger  : 'change'
                },
               ],
               hora: [
                 { 
                  required : true,
                  message  : 'Seleccione la hora del traslado',
                  trigger  : 'change'
                },
               ],
               origen: [
                 { 
                  required : true,
                  message  : 'Ingrese los detalles del origen del traslado',
                  trigger  : 'blur'
                },
               ],
               destino: [
                 { 
                  required : true,
                  message  : 'Ingrese los detalles del destino del traslado',
                  trigger  : 'blur'
                },
               ],
               description: [
                 { 
                  required : true,
                  message  : 'Ingrese una descripcion del traslado',
                  trigger  : 'blur'
                },
               ],
             },
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
    submitForm(formName) {
      this.$refs[formName].validate((valid) => {
        if (valid) {
          this.sendtraslado();
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
    resetForm(formName) {
      this.$refs[formName].resetFields();
    },
    sendtraslado(){
      var a = new Traslado(this.traslado)
      var user = this.$store.getters.currentUser
      a.setUser(user.id)
      axios.post(route('traslados.store'),a) 
          .then(response => {
            this.res_select.traslados.push(response.data)
            this.resetForm('traslado')
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
      console.log(this.res_select)
      if (this.$refs['traslado']) {
        this.$refs['traslado'].resetFields();
      }
      this.localidad[0].value=this.res_select.origen_a
      this.localidad[0].label=this.res_select.origen_a
      this.localidad[1].value=this.res_select.destino_a
      this.localidad[1].label=this.res_select.destino_a
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
              console.log(response.data.reservas.data.length)
              
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
.textbox{
  color: #231F20;
  font-family: 'Eurostile LTS Demi';
}
.trasladostable{
  overflow-y: scroll; 
  height:25vh;
}
.cell{
  // min-width: 2vh !important;
  // width: 100% !important;
}
.tableicon{
  width: 100%;
  img{
    width: 4vh;
    height: 4vh;
  }
}
  .el-table td, .el-table th{
    padding: 6px 0 !important;

  }
.el-table__body{
  width: 100%  !important;

}
.el-table__fixed-body-wrapper{

}
.button_content{
  // display: flex;
  // flex-direction: row;
  button{
    // width: 100%;
    // margin: 0px !important;
  }
}
.el-table__fixed{
  width: 100% !important;
}
.tableflex{
  display: flex;
  div{
    // display: table-cell;
    // width: 50%;
    width: 100%;

  }
}
.container_flexbox{
  width: 100%;
}

.icon_container{
  display: flex;
  justify-content: center;
  margin-left: 8px;
  margin-right: 8px;
  width: 7vh;
  height: 7vh;
  i{
    width: 5vh;
    height: 5vh;
  }
}
.flexcenter{
  justify-content: center;
}
.rowflex{
  display: flex;
  flex-flow: row wrap;
}
.colflex{
  display: flex;
  flex-flow: column wrap;
}
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

.minilabel{
  color:  rgba(0, 0, 0, 0.6);
  font-size: 0.7em;
  font-style: italic;
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
      // margin: 5px;
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
                display: flex;
                flex-direction: row;
                font-size: 1rem;
        background-color: rgba(187, 189, 192, 0.2);
        box-shadow: 2px 2px 4px 3px rgba(187, 189, 192, 0.7);
        margin: 10px 0;
        padding: 3px;
        border-radius: 5px;
        border: 1.5px solid rgba(35, 31, 32, 0.5);
        .trasItem{
          i{
            font-size: 1.1rem;
            margin-top: auto;
            margin-bottom: auto;
          }
            display: flex;
            flex-direction: column;
            margin: 0 10px;
            // margin-left:3px;
            // margin-right: 3px;
            font-size: 0.8em;
        }
      }
    }
  }
}


</style>
