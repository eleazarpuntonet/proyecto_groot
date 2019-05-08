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
      formProv: {},
      repForm: {},
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
  },
  created() {
  },
  beforeMount(){
  }
}
</script>
<template>
  <div class="indexEmpleados ele_modelview_A">
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
              <div class="texttitle">Proveedores</div>
            </div>
          </div>
        </div>
      </div>
      <div class="form_line">
        <div class="contLeftSide l_radiusBorder">
          <el-form 
            style="width: 100%;"
            ref="proveedoresForm" 
            :model="formProv">

            <div class="form_line" style="justify-content:space-between !important;">
              <el-form-item prop="t_proveedor" style="width:40%;">
                <div class="el_label">Tipo de proveedor</div>
                <el-select 
                  style="width:100%"
                  size="small"
                  v-model="formProv.t_proveedor" 
                  clearable 
                  placeholder="Seleccione">
                  <el-option
                    key="item.value"
                    label="item.label"
                    value="item.value">
                  </el-option>
                </el-select>
              </el-form-item>

              <el-form-item prop="representa" style="width:20%; margin-left:5px;">
                <div class="el_label">Representante</div>
                <el-switch
                  active-color="#007CC2"
                  inactive-color="#BCBEC0"
                  v-model="formProv.representa"
                  active-text="Es representante">
                </el-switch>
              </el-form-item>
            </div>

            <div class="form_line">
              <el-form-item prop="r_social" style="width:40%;">
                <div class="el_label">Razon social</div>
                <el-input 
                  size="small"
                  placeholder="Razon social"
                  v-model="formProv.r_social" 
                  :disabled="false">
                </el-input>
              </el-form-item>

              <el-form-item prop="rif" style="width:40%;">
                <div class="el_label">Registro de informacion fiscal</div>
                <el-input 
                  size="small"
                  v-model="formProv.rif" 
                  class="input-with-select">
                  <el-select 
                    v-model="formProv.rif" 
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

              <el-form-item prop="retencion" style="width:20%; margin-left:5px;">
                <div class="el_label">Agente de retencion</div>
                <el-switch
                  active-color="#007CC2"
                  inactive-color="#BCBEC0"
                  v-model="formProv.retencion"
                  active-text="Es agente de retencion">
                </el-switch>
              </el-form-item>
            </div>

            <div class="form_line">
              <el-form-item prop="direccion" style="width:100%;">
                <div class="el_label">Direccion</div>
                <el-input 
                  size="small"
                  placeholder="Direccion"
                  v-model="formProv.direccion" 
                  :disabled="false">
                </el-input>
              </el-form-item>
            </div>

            <div class="form_line">
              <el-form-item prop="email" style="width:33.3%;">
                <div class="el_label">Email</div>
                <el-input 
                  size="small"
                  placeholder="Email"
                  v-model="formProv.email" 
                  :disabled="false">
                </el-input>
              </el-form-item>

              <el-form-item prop="tlf" style="width:33.3%; margin-left:5px;">
                <div class="el_label">Telefono</div>
                <el-input 
                  size="small"
                  placeholder="Telefono"
                  v-model="formProv.tlf" 
                  :disabled="false">
                </el-input>
              </el-form-item>

              <el-form-item prop="tlf_p" style="width:33.3%; margin-left:5px;">
                <div class="el_label">Telefono celular</div>
                <el-input 
                  size="small"
                  placeholder="Tlf celular"
                  v-model="formProv.tlf_p" 
                  :disabled="false">
                </el-input>
              </el-form-item>
            </div>

            <div class="form_line">
              <el-form-item prop="pais" style="width:50%;">
                <div class="el_label">Pais</div>
                <el-input 
                  size="small"
                  placeholder="Pais"
                  v-model="formProv.pais" 
                  :disabled="false">
                </el-input>
              </el-form-item>

              <el-form-item prop="ciudad" style="width:50%; margin-left:5px;">
                <div class="el_label">Ciudad</div>
                <el-input 
                  size="small"
                  placeholder="Ciudad"
                  v-model="formProv.ciudad" 
                  :disabled="false">
                </el-input>
              </el-form-item>
            </div>

            <div class="form_line">
              <el-form-item prop="articulos" style="width:50%;">
                <div class="el_label">Articulos</div>
                <el-select 
                  style="width:100%"
                  size="small"
                  v-model="formProv.articulos" 
                  clearable 
                  placeholder="Seleccione">
                  <el-option
                    key="item.value"
                    label="item.label"
                    value="item.value">
                  </el-option>
                </el-select>
              </el-form-item>

              <el-form-item prop="marca" style="width:50%;">
                <div class="el_label">Marca</div>
                <el-select 
                  style="width:100%"
                  size="small"
                  v-model="formProv.marca" 
                  clearable 
                  placeholder="Seleccione">
                  <el-option
                    key="item.value"
                    label="item.label"
                    value="item.value">
                  </el-option>
                </el-select>
              </el-form-item>
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
        <div class="rightSideForm l_radiusBorder">
          <el-form 
            style="width: 100%;"
            ref="repForm" 
            :model="formProv">
            <div class="form_line">
              <el-form-item prop="marca_rep" style="width:50%;">
                <div class="el_label">Marca representada</div>
                <el-select 
                  style="width:100%"
                  size="small"
                  v-model="formProv.marca_rep" 
                  clearable 
                  placeholder="Seleccione">
                  <el-option
                    key="item.value"
                    label="item.label"
                    value="item.value">
                  </el-option>
                </el-select>
              </el-form-item>

              <el-form-item prop="empresa_rep" style="width:50%;">
                <div class="el_label">Empresa representada</div>
                <el-select 
                  style="width:100%"
                  size="small"
                  v-model="formProv.empresa_rep" 
                  clearable 
                  placeholder="Seleccione">
                  <el-option
                    key="item.value"
                    label="item.label"
                    value="item.value">
                  </el-option>
                </el-select>
              </el-form-item>
            </div>

            <div class="form_line">
              <el-form-item prop="fecha_inicio" style="width:50%;">
                <div class="el_label">Fecha de inicio</div>
                <el-date-picker
                size="small"
                  style="width:100%" 
                  v-model="formProv.fecha_inicio"
                  type="date"
                  value-format="yyyy-MM-dd"
                  placeholder="Fecha de inicio">
                </el-date-picker>
              </el-form-item>

              <el-form-item prop="fecha_final" style="width:50%;">
                <div class="el_label">Fecha final</div>
                <el-date-picker
                size="small"
                  style="width:100%" 
                  v-model="formProv.fecha_final"
                  type="date"
                  value-format="yyyy-MM-dd"
                  placeholder="Fecha final">
                </el-date-picker>
              </el-form-item>
            </div>

            <div class="form_line">
              <el-form-item prop="descripcion" style="width:100%;">
                <div class="el_label">Descripcion</div>
                <el-input
                  type="textarea"
                  :rows="2"
                  placeholder="Descripcion"
                  v-model="repForm.descripcion">
                </el-input>
              </el-form-item>
            </div>

            <div class="form_line">
              <el-form-item prop="descripcion" style="width:100%;">
                <div class="el_label">Carta de representacion</div>
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

            <el-form-item>
              <el-button 
                size="small" 
                icon="el-icon-success"
                type="info">Guardar
              </el-button>
              <el-button 
                icon="el-icon-error"
                size="small">Reset
              </el-button>
            </el-form-item>

          </el-form>
        </div>
      </div>

    </div>
  </div>
</template>
<style lang="scss">
.el-switch__label{
  font-family: 'Eurostile LTS Demi';
}
.rightSideForm{
  background-color: #D0E7F3;
  width: 50% !important;
}
</style>
