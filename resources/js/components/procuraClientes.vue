<script>
  import iconmail from "vue-material-design-icons/at.vue"
  import skype from 'vue-material-design-icons/SkypeBusiness.vue'
  import Whatsapp from 'vue-material-design-icons/Whatsapp.vue'
  import phone from "vue-material-design-icons/phone.vue"
  import email from "vue-material-design-icons/EmailCheckOutline.vue"
  import cellphone from "vue-material-design-icons/cellphone.vue"
  import ext from "vue-material-design-icons/PhoneClassic.vue"

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
      formCli: {},
      contact : [],
      temp_contact : {},
      editableTabsValue: '1',
      tabIndex: 1,
      contactChannel : [
        {
          value : 'Telefono',
          label: 'Teléfono'},
        {
          value: 'Correo',
          label: 'Correo'
        },
        {
          value: 'WhatsApp',
          label: 'WhatsApp'
        },
        {
          value: 'Skype',
          label: 'Skype'
        }],
      contact: [],
    }
  },
  components :{
    iconmail,
    skype,
    Whatsapp,
    phone,
    email,
    cellphone,
    ext
  },
  computed: {
  },
  watch: {
  },
  methods: {
    handleTabsEdit(targetName, action) {
      if (action === 'remove') {
        let tabs = this.contact;
        this.contact = tabs.filter(tab => tab.tabName !== targetName);
      }
      if (this.contact.length>0) {
        this.editableTabsValue = this.contact[this.contact.length-1].tabName;
      }
    },
    addContact(){
      this.temp_contact.id = this.contact.length
      let newTabName = ++this.tabIndex + '';
      this.temp_contact.tabName = newTabName
      this.contact.push(this.temp_contact)
      this.temp_contact = {}
    }
  },
  created() {
  },
  beforeMount(){
  }
}
</script>
<template>
  <div class="clientesView ele_modelview_A">
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
              <div class="texttitle">Clientes</div>
            </div>
          </div>
        </div>
      </div>
      <div class="form_line">
        <div class="contLeftSide l_radiusBorder">
          <el-form 
            style="width: 100%;"
            ref="proveedoresForm" 
            :model="formCli">
            <el-tabs type="border-card">
              <el-tab-pane>
                <span slot="label"><i class="el-icon-date"></i>Datos Basicos</span>
                <div class="form_line">
                  <el-form-item prop="r_social" style="width:50%;">
                    <div class="el_label">Razon social</div>
                    <el-input 
                      size="small"
                      placeholder="Razon social"
                      v-model="formCli.nombre" 
                      :disabled="false">
                    </el-input>
                  </el-form-item>

                  <el-form-item prop="rif" style="width:50%;">
                    <div class="el_label">Registro de informacion fiscal</div>
                    <el-input 
                      size="small"
                      v-model="formCli.rif" 
                      class="input-with-select">
                      <el-select 
                        v-model="formCli.rif" 
                        slot="prepend" placeholder="Nac">
                        <el-option 
                          label="J-" 
                          value="J-" 
                          selected>
                        </el-option>
                        <el-option 
                          label="E-" 
                          value="E-">
                        </el-option>
                      </el-select>
                    </el-input>
                  </el-form-item>
                </div>

                <div class="form_line">
                  <el-form-item prop="direccion" style="width:100%;">
                    <div class="el_label">Direccion</div>
                    <el-input 
                      size="small"
                      placeholder="Direccion"
                      v-model="formCli.direccion" 
                      :disabled="false">
                    </el-input>
                  </el-form-item>
                </div>

                <div class="form_line">
                  <el-form-item prop="direccion" style="width:50%;">
                    <div class="el_label">Pais</div>
                    <el-input 
                      size="small"
                      placeholder="Pais"
                      v-model="formCli.pais" 
                      :disabled="false">
                    </el-input>
                  </el-form-item>

                  <el-form-item prop="direccion" style="width:50%;">
                    <div class="el_label">Ciudad</div>
                    <el-input 
                      size="small"
                      placeholder="Ciudad"
                      v-model="formCli.ciudad" 
                      :disabled="false">
                    </el-input>
                  </el-form-item>
                </div>

                <div class="form_line">
                  <el-form-item prop="descripcion" style="width:100%;">
                    <div class="el_label">Descripcion</div>
                    <el-input
                      type="textarea"
                      :rows="2"
                      placeholder="Descripcion"
                      v-model="formCli.descripcion">
                    </el-input>
                  </el-form-item>
                </div>  
              </el-tab-pane>

              <el-tab-pane label="Contacto">
                <div class="form_line">
<!--                   <el-form-item style="width:20%;">
                    <div class="el_label">Canal de contacto</div>
                    <el-select
                      style="width: 100%;"
                      size="small" 
                      v-model="temp_contact.type" 
                      placeholder="Canal de contacto">
                      <el-option
                        v-for="item in contactChannel"
                        :key="item.value"
                        :label="item.label"
                        :value="item.value">
                      </el-option>
                    </el-select>
                  </el-form-item> -->

<!--                   <el-form-item  style="width:30%;">
                    <div class="el_label">{{temp_contact.type?temp_contact.type:'Contacto'}}</div>
                    <el-input 
                      size="small"
                      :placeholder="temp_contact.type"
                      v-model="temp_contact.value" 
                      :disabled="temp_contact.type?false:true">
                    </el-input>
                  </el-form-item> -->

                  <el-form-item  style="width:30%; margin-left:5px;">
                    <div class="el_label">Nombre</div>
                    <el-input 
                      size="small"
                      placeholder="Nombre"
                      v-model="temp_contact.nombre">
                    </el-input>
                  </el-form-item>

                  <el-form-item  style="width:20%; margin-left:5px;">
                    <div class="el_label">Cargo</div>
                    <el-input 
                      size="small"
                      placeholder="Cargo"
                      v-model="temp_contact.cargo">
                    </el-input>
                  </el-form-item>

                  <el-form-item  style="width:20%; margin-left:5px;">
                    <div class="el_label">Correo</div>
                    <el-input 
                      size="small"
                      placeholder="Correo"
                      v-model="temp_contact.mail">
                    </el-input>
                  </el-form-item>

                  <el-form-item  style="width:20%; margin-left:5px;">
                    <div class="el_label">Telefono</div>
                    <el-input 
                      size="small"
                      placeholder="Telefono"
                      v-model="temp_contact.tlf">
                    </el-input>
                  </el-form-item>

                  <el-form-item  style="width:10%; margin-left:5px;">
                    <div class="el_label">Agregar</div>
                    <el-button 
                      @click="addContact"
                      size="small"
                      icon="el-icon-plus" 
                      circle></el-button>
                  </el-form-item>
                </div>

                <div class="contactosBox form_line">
                  <template v-for="contacto in contact">
                    <el-card class="box-card">
                      <div slot="header" class="clearfiss">
                        <div class="head">
                          <div class="nombre">{{contacto.nombre}}</div>
                          <div class="cargo">{{contacto.cargo}}</div>
                        </div>
                        <el-popover
                          placement="bottom-start"
                          popper-class="addCanal"
                          width="200"
                          trigger="click">
                          <el-button 
                            slot="reference"
                            size="mini"
                            icon="el-icon-edit" 
                            ></el-button>
                            <div class="add">
                            </div>
                              <el-button 
                                size="mini"
                                type="primary"><skype class='iconnButton' /> Agregar Skype
                              </el-button>
                              <el-button 
                                size="mini"
                                type="primary"><Whatsapp class="iconnButton"/> Agregar WhatsApp
                              </el-button>
                              <el-button 
                                size="mini"
                                type="primary"><iconmail class="iconnButton"/> Agregar Correo
                              </el-button>
                              <el-button 
                                size="mini"
                                type="primary"><phone class="iconnButton"/> Agregar Telefono
                              </el-button>
                              <el-button 
                                size="mini"
                                type="primary"><email class="iconnButton"/> Agregar Email
                              </el-button>
                              <el-button 
                                size="mini"
                                type="primary"><ext class="iconnButton"/> Agregar Extension
                              </el-button>
                              <el-button 
                                size="mini"
                                type="primary"><cellphone class="iconnButton"/> Agregar Tlf Movil
                              </el-button>
                        </el-popover>
                      </div>
                      <div v-if="contacto.mail" class="contactItem">
                        <email class="iconnButton"/>{{contacto.mail}}
                      </div>
                      <div v-if="contacto.mail" class="contactItem">
                        <phone class="iconnButton"/>{{contacto.tlf}}
                      </div>
                    </el-card>
                  </template>
                </div>
              </el-tab-pane>

              <el-tab-pane label="Adjuntos">
                <div class="form_line">
                  <el-form-item prop="descripcion" style="width:100%;">
                    <div class="el_label">Adjuntar documentos</div>
                    <el-upload
                      class="upload-demo"
                      drag
                      action="#"
                      multiple>
                      <i class="el-icon-upload"></i>
                      <div class="el-upload__text">Arrastre los documentos aqui o <em>haz clic para cargar</em></div>
                      <!-- <div slot="tip" class="el-upload__tip">Solo archivos PDF con un tamaño menor de 500kb</div> -->
                    </el-upload>
                  </el-form-item>
                </div>
              </el-tab-pane>

              <div class="form_line" style="justify-content:flex-start;">
                <el-form-item>
                  <el-button 
                    size="small" 
                    icon="el-icon-success"
                    type="info">Enviar
                  </el-button>
                  <el-button 
                    icon="el-icon-error"
                    size="small">Reset
                  </el-button>
                </el-form-item>
              </div>
            </el-tabs>
          </el-form>
        </div>
      </div>

    </div>
  </div>
</template>
<style lang="sass">
$iconnButtonSize: 1.5em
.contactItem
  margin-top: 0 15px
.el-card+.el-card
  margin-left: 5px
.material-design-icon.iconnButton 
  height: $iconnButtonSize
  width:  $iconnButtonSize
.material-design-icon.iconnButton > .material-design-icon__svg 
  height: $iconnButtonSize
  width: $iconnButtonSize
.addCanal
  width: 13vw !important
  display: flex
  flex-direction: column
  padding: 0 !important
  .el-button
    padding: 0 5px
    width: 100%
    margin: 1px 0 !important
    text-align: left
    color: #fff
    background-color: #007CC2
    border-color: #007CC2
.clientesView
  .contactosBox
    padding: 20px 15px
    justify-content: flex-start
  .el-card 
    width: 25%
    .clearfiss
      font-family: 'Eurostile LTS Demi'
      display: flex
      flex-direction: row
      justify-content: space-between
      span
        align-self: center !important  
    .head
      display: flex
      flex-direction: column
      align-items: flex-start
      color: #007CC2
    .el-card__header
      padding: 5px 5px
  .l_radiusBorder
    padding: 0px !important
  .el-tabs--border-card 
    height: 70vh
  .box-card
    .nombre
      font-size: 1.2rem
    .cargo
      font-size: 0.9rem
  .el-upload
    width: 100%
  .el-button--small.is-circle 
    padding: 9px
    border-radius: 50% !important
  .el-button--mini.is-circle 
    padding: 9px
    border-radius: 50% !important
  .el-tabs__item 
    font-size: 14px
  .el-tabs__content
    padding: 5px
  .el-tabs__new-tab
    display: none !important
.el-switch__label
  font-family: 'Eurostile LTS Demi'
.rightSideForm
  background-color: #D0E7F3
  width: 50% !important
</style>
