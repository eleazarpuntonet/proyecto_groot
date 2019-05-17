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
      proyecto: {},
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
      <div class="form_line">
        <div class="contLeftSide l_radiusBorder">
          <el-form 
            style="width: 100%;"
            ref="proveedoresForm" 
            :model="proyecto">

            <div class="form_line" style="justify-content:space-between !important;">
              <el-form-item prop="n_proyecto" style="width:50%;">
                <div class="el_label">Nombre del proyecto</div>
                <el-input
                  size="small"
                  placeholder="Nombre del proyecto"
                  v-model="proyecto.n_proyecto">
                </el-input>
              </el-form-item>

              <el-form-item prop="status" style="width:50%;">
                <div class="el_label">Status del proyecto</div>
                <el-select 
                  style="width:100%"
                  size="small"
                  v-model="proyecto.status" 
                  clearable 
                  placeholder="Seleccione">
                  <el-option
                    key="status"
                    label="status"
                    value="status">
                  </el-option>
                </el-select>
              </el-form-item>
            </div>

            <div class="form_line" style="justify-content:space-between !important;">
              <el-form-item prop="cliente" style="width:50%;">
                <div class="el_label">Cliente</div>
                <el-select 
                  style="width:100%"
                  size="small"
                  v-model="proyecto.cliente" 
                  clearable 
                  placeholder="Seleccione">
                  <el-option
                    key="status"
                    label="status"
                    value="status">
                  </el-option>
                </el-select>
              </el-form-item>

              <el-form-item prop="n_proyecto" style="width:50%;">
                <div class="el_label">Presupuesto</div>
                <el-input
                  size="small"
                  placeholder="Presupuesto"
                  v-model="proyecto.presupuesto_absf">
                  <template slot="append">Bs.S</template>
                </el-input>
              </el-form-item>
            </div>

            <div class="form_line" style="justify-content:space-between !important;">
              <el-form-item prop="contacto" style="width:50%;">
                <div class="el_label">Contacto</div>
                <el-select 
                  style="width:100%"
                  size="small"
                  v-model="proyecto.contacto" 
                  clearable 
                  placeholder="Seleccione">
                  <el-option
                    key="status"
                    label="status"
                    value="status">
                  </el-option>
                </el-select>
              </el-form-item>

              <el-form-item prop="presupuesto_busd" style="width:50%;">
                <div class="el_label">Presupuesto</div>
                <el-input
                  size="small"
                  placeholder="Presupuesto"
                  v-model="proyecto.presupuesto_busd">
                  <template slot="append">USD</template>
                </el-input>
              </el-form-item>
            </div>

            <div class="form_line" style="justify-content:space-between !important;">
              <el-form-item prop="empresa" style="width:50%;">
                <div class="el_label">Empresa</div>
                <el-select 
                  style="width:100%"
                  size="small"
                  v-model="proyecto.empresa" 
                  clearable 
                  placeholder="Empresa">
                  <el-option
                    key="status"
                    label="status"
                    value="status">
                  </el-option>
                </el-select>
              </el-form-item>

              <el-form-item prop="precio_venta" style="width:50%;">
                <div class="el_label">Precio de venta</div>
                <el-input
                  size="small"
                  placeholder="Precio de venta"
                  v-model="proyecto.precio_venta">
                  <template slot="append">Bs.S</template>
                </el-input>
              </el-form-item>
            </div>

            <div class="form_line" style="justify-content:space-between !important;">
              <el-form-item prop="empresa" style="width:50%;">
                <div class="el_label">Zonas</div>
                <el-select 
                  style="width:100%"
                  size="small"
                  v-model="proyecto.empresa" 
                  clearable 
                  placeholder="Empresa">
                  <el-option
                    key="status"
                    label="status"
                    value="status">
                  </el-option>
                </el-select>
              </el-form-item>

              <el-form-item prop="precio_ventaUSD" style="width:50%;">
                <div class="el_label">Precio de venta</div>
                <el-input
                  size="small"
                  placeholder="Precio de venta"
                  v-model="proyecto.precio_ventaUSD">
                  <template slot="append">USD</template>
                </el-input>
              </el-form-item>
            </div>

            <div class="form_line" style="justify-content:space-between !important;">
              <el-form-item prop="factibilidad" style="width:100%;">
                <div class="el_label">Factibilidad</div>
                <el-slider 
                  v-model="proyecto.factibilidad" 
                  show-input>
                </el-slider>
              </el-form-item>
            </div>

            <div class="form_line" style="justify-content:space-between !important;">
              <el-form-item prop="accion" style="width:50%;">
                <div class="el_label">Accion a seguir</div>
                <el-input
                  size="small"
                  placeholder="Accion a seguir"
                  v-model="proyecto.accion">
                </el-input>
              </el-form-item>

              <el-form-item prop="fecha_accion" style="width:50%;">
                <div class="el_label">Fecha de accion</div>
                <el-date-picker
                  size="small"
                  style="width:100%" 
                  v-model="proyecto.fecha_accion"
                  type="date"
                  value-format="yyyy-MM-dd"
                  placeholder="Fecha de accion">
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
                  v-model="proyecto.descripcion">
                </el-input>
              </el-form-item>
            </div>

            <el-form-item prop="descripcion" style="width:100%;">
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

          </el-form>
        </div>
      </div>
    </div>
  </div>
</template>
<style lang="sass">
.indexProyectos
  .el-upload
    width: 100%
  .el-slider
    margin: 0px 15px
</style>
