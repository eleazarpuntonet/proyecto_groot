<script>
  import {VueContentLoading,VclTable} from         'vue-content-loading';
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
      editableTabsValue: '2',
      tabIndex: 1,
      contactChannel : [
        {
          value : 'Telefono',
          label: 'Telefono'},
        {
          value: 'Correo',
          label: 'Correo'
        },
        {
          value: 'Wsapp',
          label: 'Whatsapp'
        },
        {
          value: 'Skyppe',
          label: 'Skyppe'
        }],
      contact: [],
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
    handleTabsEdit(targetName, action) {
      if (action === 'add') {
        let newTabName = ++this.tabIndex + '';
        this.editableTabs.push({
          title: 'New Tab',
          name: newTabName,
          content: 'New Tab content'
        });
        this.editableTabsValue = newTabName;
      }
      if (action === 'remove') {
        let tabs = this.editableTabs;
        let activeName = this.editableTabsValue;
        if (activeName === targetName) {
          tabs.forEach((tab, index) => {
            if (tab.name === targetName) {
              let nextTab = tabs[index + 1] || tabs[index - 1];
              if (nextTab) {
                activeName = nextTab.name;
              }
            }
          });
        }
        
        this.editableTabsValue = activeName;
        this.editableTabs = tabs.filter(tab => tab.name !== targetName);
      }
    },
    addContact(){
      
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
              <el-form-item style="width:20%;">
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
              </el-form-item>

              <el-form-item  style="width:30%;">
                <div class="el_label">{{temp_contact.type?temp_contact.type:'Contacto'}}</div>
                <el-input 
                  size="small"
                  :placeholder="temp_contact.type"
                  v-model="temp_contact.value" 
                  :disabled="temp_contact.type?false:true">
                </el-input>
              </el-form-item>

              <el-form-item  style="width:20%; margin-left:5px;">
                <div class="el_label">Nombre</div>
                <el-input 
                  size="small"
                  placeholder="Nombre"
                  v-model="temp_contact.nombre" 
                  :disabled="temp_contact.type?false:true">
                </el-input>
              </el-form-item>

              <el-form-item  style="width:20%; margin-left:5px;">
                <div class="el_label">Cargo</div>
                <el-input 
                  size="small"
                  placeholder="Cargo"
                  v-model="temp_contact.cargo" 
                  :disabled="temp_contact.type?false:true">
                </el-input>
              </el-form-item>

              <el-form-item  style="width:10%; margin-left:5px;">
                <div class="el_label">Agregar</div>
                <el-button 
                  @click="addContact"
                  :disabled="temp_contact.type?false:true"
                  size="small"
                  icon="el-icon-plus" 
                  circle></el-button>
              </el-form-item>
            </div>

            <div class="form_line">
              <div style="width: 50%; display: flex; flex-direction: column;">
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
              </div>
              <div style="width: 50%; margin-left: 5px;">
                <el-form-item style="width:100%;">
                  <div class="contactBox">
                  <div class="el_label">Contacto</div>
                    <el-tabs 
                      v-model="editableTabsValue" 
                      type="border-card" 
                      editable 
                      @edit="handleTabsEdit">
                      <el-tab-pane
                        v-for="(item, index) in contact"
                        :key="item.type"
                        :label="item.type"
                        :name="item.type">
                        Aqui deberia haber algo
                        {{item.value}}
                      </el-tab-pane>
                    </el-tabs>
                  </div>
                </el-form-item>
              </div>
            </div>
            
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
          </el-form>
        </div>
      </div>

    </div>
  </div>
</template>
<style lang="scss">
.clientesView{
  .el-upload{
    width: 100%;
  }
  .el-button--small.is-circle {
      padding: 9px;
      border-radius: 50% !important;
  }
  .el-tabs__nav {
      height: 30px;
  }
  .el-tabs__item {
      height: 20px;
      line-height: 20px;
      font-size: 14px;
  }
  .el-tabs__new-tab{
    // display: none;
  }
  .el-tabs__nav-scroll{
      height: 30px;
  }
}
.el-switch__label{
  font-family: 'Eurostile LTS Demi';
}
.rightSideForm{
  background-color: #D0E7F3;
  width: 50% !important;
}
</style>
