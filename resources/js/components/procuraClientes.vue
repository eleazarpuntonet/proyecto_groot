<script>
  import iconmail from "vue-material-design-icons/at.vue"
  import skype from 'vue-material-design-icons/SkypeBusiness.vue'
  import Whatsapp from 'vue-material-design-icons/Whatsapp.vue'
  import phone from "vue-material-design-icons/phone.vue"
  import email from "vue-material-design-icons/EmailCheckOutline.vue"
  import cellphone from "vue-material-design-icons/cellphone.vue"
  import ext from "vue-material-design-icons/PhoneClassic.vue"

  import {
    fileUpload
  } from '../apiCalls.js'
export default {
  /*
  *
  * Variables del componente
  */
  data () {
    return {
      input_add: false,
      tmp_input: {},
      formCli: {},
      contact : [],
      temp_contact : {
        extra: [],
        flag: false,
        temp: {
          flag:false
        },
      },
      fileData: {data:'Texto de data'},
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
    fileAction(e){
      console.log('ejecuto file action')
      console.log(e)
      // fileUpload(e)
      //   .then(res=>{
      //     this.roles = res
      //   }).catch(error=>{
      //     console.log(error)
      //   })
    },
    add(contacto){
      contacto.extra.push(contacto.temp)
      contacto.temp={
        flag:false
      }
      contacto.flag=false
    },
    addContItem(canal,item){
      item.flag = true
      item.temp.type = canal
    },
    editContItem(contacto,index){
      contacto.extra[index].flag=true
    },
    saveContItem(contacto,index){
      contacto.extra[index].flag=false
    },
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
      this.contact.push(this.temp_contact)
      this.temp_contact = {
        extra: [],
        flag: false,
        temp: {},
      }
    }
  },
  created() {
    // axios.post(route('files.storefile','algo')) 
    //     .then(response => {
    //       console.log(response)
    //       // res(response)
    //       })
    //     .catch(error => {
    //       console.log(error)
    //     })
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
                            icon="el-icon-plus" 
                            ></el-button>
                            <div class="add">
                            </div>
                              <el-button 
                                @click="addContItem('Skype',contacto)"
                                size="mini"
                                type="primary"><skype class='iconnButton' /> Agregar Skype
                              </el-button>
                              <el-button 
                                @click="addContItem('Whatsapp',contacto)"
                                size="mini"
                                type="primary"><Whatsapp class="iconnButton"/> Agregar WhatsApp
                              </el-button>
                              <el-button 
                                @click="addContItem('Mail',contacto)"
                                size="mini"
                                type="primary"><iconmail class="iconnButton"/> Agregar Correo
                              </el-button>
                              <el-button 
                                @click="addContItem('Telefono',contacto)"
                                size="mini"
                                type="primary"><phone class="iconnButton"/> Agregar Telefono
                              </el-button>
                              <el-button 
                                @click="addContItem('Extension',contacto)"
                                size="mini"
                                type="primary"><ext class="iconnButton"/> Agregar Extension
                              </el-button>
                              <el-button 
                                @click="addContItem('Telefono movil',contacto)"
                                size="mini"
                                type="primary"><cellphone class="iconnButton"/> Agregar Tlf Movil
                              </el-button>
                        </el-popover>
                      </div>
                      <div 
                        v-if="contacto.tlf" 
                        class="contactItem">
                        <div class="contactIcon">
                          <phone class="iconnButton"/>
                        </div>
                        <div v-if="true" style="display: flex;flex-direction: row;justify-content: space-between;width: 100%;">
                          <div>
                            {{contacto.tlf}}
                          </div> 
                          <el-button 
                            slot="reference"
                            size="mini"
                            icon="el-icon-edit" 
                            ></el-button>
                        </div>
                        <div 
                          v-if="contacto.tlfedit"
                          style="display: flex;
                          flex-direction: row;">
                          <el-input 
                            style="margin-right: 2px;"
                            size="small"
                            placeholder="Telefono"
                            v-model="contacto.tlf">
                          </el-input>
                          <el-button 
                            @click="addContItem(contacto)"
                            size="mini"
                            icon="el-icon-check" 
                            rounded>
                          </el-button>
                        </div>
                      </div>
                      <div 
                        v-if="contacto.mail" 
                        class="contactItem">
                        <div class="contactIcon">
                          <email class="iconnButton"/>
                        </div>
                        <div v-if="true" style="display: flex;flex-direction: row;justify-content: space-between;width: 100%;">
                          <div>
                            {{contacto.mail}}
                          </div> 
                          <el-button 
                            slot="reference"
                            size="mini"
                            icon="el-icon-edit" 
                            ></el-button>
                        </div>
                        <div 
                          v-if="contacto.mailedit"
                          style="display: flex;
                          flex-direction: row;">
                          <el-input 
                            style="margin-right: 2px;"
                            size="small"
                            placeholder="Telefono"
                            v-model="contacto.mail">
                          </el-input>
                          <el-button 
                            @click="addContItem(contacto)"
                            size="mini"
                            icon="el-icon-check" 
                            rounded>
                          </el-button>
                        </div>
                      </div>
                      <div v-if="contacto.extra.length>0" v-for="(extra,index) in contacto.extra" class="contactItem">
                        <div class="contactIcon">
                          <skype     v-if="extra.type=='Skype'" class="iconnButton"/>
                          <Whatsapp  v-if="extra.type=='Whatsapp'" class="iconnButton"/>
                          <iconmail  v-if="extra.type=='Mail'" class="iconnButton"/>
                          <phone     v-if="extra.type=='Telefono'" class="iconnButton"/>
                          <ext       v-if="extra.type=='Extension'" class="iconnButton"/>
                          <cellphone v-if="extra.type=='Telefono movil'" class="iconnButton"/>
                        </div>
                        <div v-if="!extra.flag" style="display: flex;flex-direction: row;justify-content: space-between;width: 100%;">
                          <div>
                            {{extra.extra}}
                          </div> 
                          <el-button 
                            @click="editContItem(contacto,index)"
                            slot="reference"
                            size="mini"
                            icon="el-icon-edit" 
                            ></el-button>
                        </div>
                        <div 
                          v-if="extra.flag"
                          style="display: flex;
                          flex-direction: row;">
                          <el-input 
                            style="margin-right: 2px;"
                            size="small"
                            :placeholder="extra.type"
                            v-model="extra.extra">
                          </el-input>
                          <el-button 
                            @click="saveContItem(contacto,index)"
                            size="mini"
                            icon="el-icon-check" 
                            rounded>
                          </el-button>
                        </div>
                      </div>
                      <div v-if="contacto.flag" class="contactItem">
                        <div class="contactIcon">
                          <skype     v-if="contacto.temp.type=='Skype'" class="iconnButton"/>
                          <Whatsapp  v-if="contacto.temp.type=='Whatsapp'" class="iconnButton"/>
                          <iconmail  v-if="contacto.temp.type=='Mail'" class="iconnButton"/>
                          <phone     v-if="contacto.temp.type=='Telefono'" class="iconnButton"/>
                          <ext       v-if="contacto.temp.type=='Extension'" class="iconnButton"/>
                          <cellphone v-if="contacto.temp.type=='Telefono movil'" class="iconnButton"/>
                        </div>
                        <div 
                          style="display: flex;
                          flex-direction: row;">
                          <el-input 
                            style="margin-right: 2px;"
                            size="small"
                            :placeholder="contacto.temp.type"
                            v-model="contacto.temp.extra">
                          </el-input>
                          <el-button 
                            @click="add(contacto)"
                            size="mini"
                            icon="el-icon-check" 
                            rounded>
                          </el-button>
                        </div>
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
                      :data="fileData"
                      action="http://spsapp.sps/api/files"
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
                    @click="fileAction"
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
    display: flex
    .contactIcon
      display: flex
      flex-direction: column
      justify-content: center
      margin-right: 5px
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
      .el-card__body
        padding: 5px
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
