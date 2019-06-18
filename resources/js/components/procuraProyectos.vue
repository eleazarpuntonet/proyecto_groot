<script>
  import {
    proyectoStore,
    queryUsers
  } from '../apiCalls.js'

  import {VueContentLoading,VclTable} from         'vue-content-loading';
  import {
    formulariodeProyectos,
  } from '../formlabels.js'
  const labelsItems = formulariodeProyectos.es

  import {
    getDepartamentos,
    getUsuarios,
    getRoles
  } from '../apiCalls.js'
export default {
  /*
  *
  * Variables del componente
  */
  data () {
    return {
      loading: {
        participantes : false,
      },
      proyecto: {
        participantes: [],
      },
      usersQuery: [],
      repForm: {},
      proyecto_Temp:{
        participante: null,
        responsable: null,
        contacto: null,
      },
      formItemsProyectos:{
        rules         : formulariodeProyectos.rules,
        labels        : labelsItems
      },
    }
  },
  components :{
    VueContentLoading,
    VclTable
  },
  computed: {
  },
  watch: {
  },
  methods: {
    deleteParticipante(id){
      let valores = this.proyecto.participantes
      this.proyecto.participantes = valores.filter((item)=>{
        return item.id != id
      })
    },
    changeSelectPart(){
      // this.proyecto_Temp.participante = null
      let userSelected = this.usersQuery.find((item)=>{
        return item.id == this.proyecto_Temp.participante
      })
      this.proyecto.participantes.push(userSelected)
    },
    remoteUser(query) {
        this.loading.participantes = true;
       if (query !== '') {
          queryUsers(query)
          .then(response => {
             this.usersQuery = response.data
             this.loading.participantes = false
             console.log(response.data)
            })
          .catch(error => {
            this.$notify.error({
              title: 'Error '+error.response.status,
              message: error.response.data.message
            });
          })
          console.log(query)
       } else {
         this.options4 = [];
       }
     },
    addParticipante(){
      console.log('Agrego participante')
    },
    submitForm(formName){
      this.$refs[formName].validate((valid) => {
       if (valid) {
         proyectoStore(this.proyecto)
           .then(response => {
             
             })
           .catch(error => {
             this.$notify.error({
               title: 'Error '+error.response.status,
               message: error.response.data.message
             });
           })
       } else {
         console.log('error submit!!');
         return false;
       }
     })
    },
    resetForm(){
      console.log(this.proyecto)
    },
  },
  created() {
  },
  beforeMount(){
  }
}
</script>
<template>
  <div class="indexProyectos ele_modelview_A">
    <div style="display: flex; flex-direction: column; width: 100%;">
      <div class="topSideForm l_radiusBorder">
        <div class="titleForm">
          <div class="logoGroup">
            <img
              src="../../../public/img/sps_logoborderline.png"
              alt="Logo SPS"/>
          </div>
          <div class="textContainer">
            <div style="display:table-cell;vertical-align:middle;">
              <div class="texttitle">Proyectos</div>
            </div>
          </div>
        </div>
      </div>

      <el-tabs type="card" >
        <el-tab-pane label="Proyecto">
          <div class="form_line">
            <div class="contLeftSide l_radiusBorder">
              <el-form 
                style="width: 100%;"
                ref="proyectos_form" 
                :rules="formItemsProyectos.rules"
                :model="proyecto">
                <div class="form_line" style="justify-content:space-between !important;">
                  <el-form-item prop="n_proyecto" style="width:50%;">
                    <div class="el_label">{{formItemsProyectos.labels.n_proyecto.label}}</div>
                    <el-input
                      size="small"
                      :placeholder="formItemsProyectos.labels.n_proyecto.placeholder"
                      v-model="proyecto.n_proyecto">
                    </el-input>
                  </el-form-item>

                  <el-form-item prop="status" style="width:50%;">
                    <div class="el_label">{{formItemsProyectos.labels.status.label}}</div>
                    <el-select 
                      style="width:100%"
                      size="small"
                      v-model="proyecto.status" 
                      clearable 
                      :placeholder="formItemsProyectos.labels.status.placeholder">
                      <el-option
                        key="status"
                        label="status"
                        value="status">
                      </el-option>
                    </el-select>
                  </el-form-item>
                </div>

                <div class="form_line" style="justify-content:space-between !important;">
                  <el-form-item prop="presupuesto_absf" style="width:50%;">
                    <div class="el_label">{{formItemsProyectos.labels.presupuesto_absf.label}}</div>
                    <el-input
                      size="small"
                      :placeholder="formItemsProyectos.labels.presupuesto_absf.placeholder"
                      v-model="proyecto.presupuesto_absf">
                      <template slot="append">Bs.S</template>
                    </el-input>
                  </el-form-item>

                  <el-form-item prop="presupuesto_busd" style="width:50%;">
                    <div class="el_label">{{formItemsProyectos.labels.presupuesto_busd.label}}</div>
                    <el-input
                      size="small"
                      :placeholder="formItemsProyectos.labels.presupuesto_busd.placeholder"
                      v-model="proyecto.presupuesto_busd">
                      <template slot="append">USD</template>
                    </el-input>
                  </el-form-item>
                </div>

                <div class="form_line" style="justify-content:space-between !important;">
                  <el-form-item prop="empresa" style="width:50%;">
                    <div class="el_label">{{formItemsProyectos.labels.empresa.label}}</div>
                    <el-select 
                      style="width:100%"
                      size="small"
                      v-model="proyecto.empresa" 
                      clearable 
                      :placeholder="formItemsProyectos.labels.empresa.placeholder">
                      <el-option
                        key="En proceso"
                        label="En proceso"
                        value="En proceso">
                      </el-option>
                      <el-option
                        key="Activo"
                        label="Activo"
                        value="Activo">
                      </el-option>
                    </el-select>
                  </el-form-item>

                  <el-form-item prop="precio_venta" style="width:50%;">
                    <div class="el_label">{{formItemsProyectos.labels.precio_venta.label}}</div>
                    <el-input
                      size="small"
                      :placeholder="formItemsProyectos.labels.precio_venta.placeholder"
                      v-model="proyecto.precio_venta">
                      <template slot="append">Bs.S</template>
                    </el-input>
                  </el-form-item>
                </div>

                <div class="form_line" style="justify-content:space-between !important;">
                  <el-form-item prop="zona" style="width:50%;">
                    <div class="el_label">{{formItemsProyectos.labels.zona.label}}</div>
                    <el-select 
                      style="width:100%"
                      size="small"
                      v-model="proyecto.zona" 
                      clearable 
                      :placeholder="formItemsProyectos.labels.zona.placeholder">
                      <el-option
                        key="status"
                        label="status"
                        value="status">
                      </el-option>
                    </el-select>
                  </el-form-item>

                  <el-form-item prop="precio_ventaUSD" style="width:50%;">
                    <div class="el_label">{{formItemsProyectos.labels.precio_ventaUSD.label}}</div>
                    <el-input
                      size="small"
                      :placeholder="formItemsProyectos.labels.precio_ventaUSD.placeholder"
                      v-model="proyecto.precio_ventaUSD">
                      <template slot="append">USD</template>
                    </el-input>
                  </el-form-item>
                </div>

                <div class="form_line" style="justify-content:space-between !important;">
                  <el-form-item prop="factibilidad" style="width:100%;">
                    <div class="el_label">{{formItemsProyectos.labels.factibilidad.label}}</div>
                    <el-slider 
                      v-model="proyecto.factibilidad" 
                      show-input>
                    </el-slider>
                  </el-form-item>
                </div>

                <div class="form_line" style="justify-content:space-between !important;">
                  <el-form-item prop="accion" style="width:50%;">
                    <div class="el_label">{{formItemsProyectos.labels.accion.label}}</div>
                    <el-input
                      size="small"
                      :placeholder="formItemsProyectos.labels.accion.placeholder"
                      v-model="proyecto.accion">
                    </el-input>
                  </el-form-item>

                  <el-form-item prop="fecha_accion" style="width:50%;">
                    <div class="el_label">{{formItemsProyectos.labels.fecha_accion.label}}</div>
                    <el-date-picker
                      size="small"
                      style="width:100%" 
                      v-model="proyecto.fecha_accion"
                      type="date"
                      value-format="yyyy-MM-dd"
                      :placeholder="formItemsProyectos.labels.fecha_accion.placeholder">
                    </el-date-picker>
                  </el-form-item>
                </div>

                <div class="form_line">
                  <el-form-item prop="descripcion" style="width:100%;">
                    <div class="el_label">{{formItemsProyectos.labels.descripcion.label}}</div>
                    <el-input
                      type="textarea"
                      :rows="2"
                      :placeholder="formItemsProyectos.labels.descripcion.placeholder"
                      v-model="proyecto.descripcion">
                    </el-input>
                  </el-form-item>
                </div>

                <div class="form_line" style="justify-content:space-between !important;">
                  <el-form-item prop="participantes" style="width:33%;">
                    <div class="el_label">{{formItemsProyectos.labels.participantes.label}}</div>

                    <el-select
                      @change="changeSelectPart"
                      style="width: 100%;"
                      v-model="proyecto_Temp.participante"
                      filterable
                      remote
                      reserve-keyword
                      placeholder="Participante"
                      :remote-method="remoteUser"
                      loading-text="Cargando"
                      no-match-text="No se encontraron resultados"
                      no-data-text="No se encontraron resultados"
                      size="small"
                      :loading="loading.participantes">
                      <el-option
                        v-for="item in usersQuery"
                        :key="item.id"
                        :label="(item.name+ item.last_name)"
                        :value="item.id">
                        <span style="float: left; font-size: 1.2vw;">{{item.last_name}}, {{item.name}}</span>
                        <span v-if="item.departamento" style="float: right; color: #8492a6; font-size: 1vw">{{item.departamento.disp_name}}</span>
                      </el-option>
                    </el-select>
                    
                    <div class="usersBox">
                      <div class="userinBox" v-for="item in proyecto.participantes">
                        <div class="name">
                          {{item.name}}
                        </div>
                        <div class="buttonBOX">
                          <el-button 
                            @click="deleteParticipante(item.id)"
                            icon="el-icon-delete" 
                            circle>
                          </el-button>
                        </div>
                      </div>
                    </div>
                  </el-form-item>

                  <el-form-item prop="responsable" style="width:33%;">
                    <div class="el_label">{{formItemsProyectos.labels.responsable.label}}</div>
                    <el-select 
                      style="width:100%"
                      size="small"
                      v-model="proyecto.responsable" 
                      clearable 
                      :placeholder="formItemsProyectos.labels.responsable.placeholder">
                      <el-option
                        key="status"
                        label="status"
                        value="status">
                      </el-option>
                    </el-select>
                  </el-form-item>

                  <el-form-item prop="contacto" style="width:33%;">
                    <div class="el_label">{{formItemsProyectos.labels.contacto.label}}</div>
                    <el-select 
                      style="width:100%"
                      size="small"
                      v-model="proyecto.contacto" 
                      clearable 
                      :placeholder="formItemsProyectos.labels.contacto.placeholder">
                      <el-option
                        key="status"
                        label="status"
                        value="status">
                      </el-option>
                    </el-select>
                  </el-form-item>
                </div>

                <el-form-item style="width:100%;">
                  <div class="el_label">Carta de representacion</div>
                  <el-upload
                    class="upload-demo"
                    drag
                    action="#"
                    multiple>
                    <i class="el-icon-upload"></i>
                    <div class="el-upload__text">Arrastre los documentos aqui o <em>haz clic para cargar</em></div>
                  </el-upload>
                </el-form-item>

               <el-form-item>
                <el-button 
                  size="small"
                  type="info" 
                  icon="el-icon-success"
                  @click="submitForm('proyectos_form')">Enviar
                </el-button>
                <el-button 
                  size="small"
                  icon="el-icon-error"
                  @click="resetForm()">Reset
                </el-button>
               </el-form-item>  
              </el-form>
            </div>
          </div>
        </el-tab-pane>
        <el-tab-pane label="Historial">Historial</el-tab-pane>
        <el-tab-pane label="APU">APU</el-tab-pane>
        <el-tab-pane label="RFQ">RFQ</el-tab-pane>
        <el-tab-pane label="Adjuntos">Adjuntos</el-tab-pane>
      </el-tabs>
    </div>
  </div>
</template>
<style lang="sass">
.indexProyectos
  .el-upload
    width: 100%
  .el-slider
    margin: 0px 15px
  .usersBox
    padding: 0 3px
    color: #606266
    border-radius: 4px
    background-color: #fff
    border: 1px solid #DCDFE6
    .userinBox
      font-size: 0.9rem
      border-radius: 15px
      display: flex
      flex-direction: row
      justify-content: space-between
      height: 32px
      line-height: 23px
      padding: 3px 6px
      background-color: rgba(0, 124, 194, 0.8)
      margin: 3px
      .name
        color: #fff
      .buttonBOX
        .el-button.is-circle
          border-radius: (50% !important)
          padding: (3px !important)
          border: (none !important)
  .appendButtonParticipante
    .el-input-group__append, .el-input-group__prepend
      background-color:(red !important)
      color: yellow
</style>
