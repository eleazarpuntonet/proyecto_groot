<script>
  import reload from "vue-material-design-icons/reload.vue"
  import deletebutton from "vue-material-design-icons/delete.vue"
  import editbutton from "vue-material-design-icons/pencil.vue"
  import buttonfind from "vue-material-design-icons/FileFind.vue"
  import {VueContentLoading,VclTable} from         'vue-content-loading';
  import {
    tablaProcesosProcura,
  } from '../formlabels.js'
  const tableHeaders = tablaProcesosProcura.es
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
      theaders : tableHeaders,
      tableSelected : {},
      headers: {
        index              : true,
        pr                 : true,
        descripcion        : true,
        proyecto           : true,
        region             : true,
        date_rec_org_cli   : true,
        date_apr_solic_ger : true,
        date_asig          : true,
        date_org_entrega   : true,
        date_ext           : true,
        date_fin_entrega   : true,
        date_env_tdc       : true,
        total              : true,
        cotizados          : true,
        porcentaje         : true,
        rfi                : true,
        por_cotizar        : true,
        tot_cotizacion     : true,
        compra             : true,
        pagado             : true,
        entregado          : true,
        comentarios          : true,
        lid_operacion      : true,
        solicitante        : true,
      },
      procesos:[{
        pr                 : '19-0101-04',
        descripcion        : 'Materiales de oficina OP-INF-T-0034',
        proyecto           : 'Requerimiento Interno',
        region             : 'El Tigre - Sede Pinos II',
        date_rec_org_cli   : '12/27/2018',
        date_apr_solic_ger : '2/1/2019',
        date_asig          : '4/1/2019',
        date_org_entrega   : '8/1/2019',
        date_ext           : '',
        date_fin_entrega   : '01/08/2019',
        date_env_tdc       : '',
        total              : '12',
        cotizados          : '8',
        porcentaje         : '',
        rfi                : '3',
        por_cotizar        : '4',
        tot_cotizacion     : '182.156.256,00',
        compra             : false,
        pagado             : false,
        entregado          : false,
        comentarios        : 'El requerimiento fue llevado a cabo exitosamente',
        lid_operacion      : 'Jorge Ruiz',
        solicitante        : 'Oscar Brito',
      }]
    }
  },
  components :{
    VueContentLoading,
    VclTable,
    reload,
    deletebutton,
    editbutton,
    buttonfind
  },
  computed: {

  },
  watch: {
  },
  methods: {
    selectionChanged(val){
      console.log(val)
      this.tableSelected = val
    },
  },
  created() {
  },
  beforeMount(){
  }
}
</script>
<template>
  <div class="landingProcura ele_modelview_A">
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
              <div class="texttitle">Procesos procura</div>
            </div>
          </div>
        </div>
      </div>


          <div class="form_line">
            <div class="contLeftSide l_radiusBorder" style="flex-direction: column;">
              <div
                v-if="tableSelected.pr"
                 class="form_line buttonsTable">
                <el-tooltip placement="top">
                  <div slot="content">Recargar</div>
                  <el-button
                    size="mini">
                    <reload class="iconnButton"/>
                  </el-button>
                </el-tooltip>
                <el-tooltip placement="top">
                  <div slot="content">Eliminar</div>
                  <el-button
                    size="mini">
                    <deletebutton class="iconnButton"/>
                  </el-button>
                </el-tooltip>
                <el-tooltip placement="top">
                  <div slot="content">Editar</div>
                  <el-button
                    size="mini">
                    <editbutton class="iconnButton"/>
                  </el-button>
                </el-tooltip>
                <el-tooltip placement="top">
                  <div slot="content">Ver detalles</div>
                  <el-button
                    size="mini">
                    <buttonfind class="iconnButton"/>
                  </el-button>
                </el-tooltip>
              </div>  
              <div class="form_line tablaProcesos">
                <el-table
                  highlight-current-row
                  @current-change="selectionChanged"
                  :data="procesos"
                  max-height="600"
                  style="width: 100%">
<!--                   <template v-if="headers.index">
                    <el-table-column
                      label-class-name = "headerTable"
                      class-name       = "columnTable"
                      width        = "100"
                      fixed="right"
                      type="selection">
                    </el-table-column>
                  </template> -->
                  <template v-if="headers.pr">
                    <el-table-column
                      label-class-name = "headerTable"
                      class-name       = "columnTable"
                      prop             = "pr"
                      :label           = "theaders.pr.label"
                      min-width        = "150">
                    </el-table-column>
                  </template>
                  <template v-if="headers.descripcion">
                    <el-table-column
                      label-class-name = "headerTable"
                      class-name       = "columnTable"
                      min-width        = "350"
                      prop             = "descripcion"
                      :label           = "theaders.descripcion.label">
                    </el-table-column>
                  </template>
                  <template v-if="headers.proyecto">
                    <el-table-column
                      min-width        = "300"
                      prop="proyecto"
                      :label="theaders.proyecto.label"
                      label-class-name="headerTable"
                      class-name="columnTable">
                    </el-table-column>
                  </template>
                  <template v-if="headers.region">
                    <el-table-column
                      prop             = "region"
                      :label           = "theaders.region.label"
                      label-class-name = "headerTable"
                      class-name       = "columnTable"
                      min-width        = "200">
                    </el-table-column>
                  </template>
                  <template v-if="headers.date_rec_org_cli">
                    <el-table-column
                    align="center"
                    header-align="center"
                      prop="date_rec_org_cli"
                      :label="theaders.date_rec_org_cli.label"
                      label-class-name="headerTable"
                      class-name="columnTable"
                      min-width = "200">
                    </el-table-column>
                  </template>
                  <template v-if="headers.date_apr_solic_ger">
                    <el-table-column
                    align="center"
                    header-align="center"
                      prop="date_apr_solic_ger"
                      :label="theaders.date_apr_solic_ger.label"
                      label-class-name="headerTable"
                      class-name="columnTable"
                      min-width = "200">
                    </el-table-column>
                  </template>
                  <template v-if="headers.date_asig">
                    <el-table-column
                    align="center"
                      prop="date_asig"
                      :label="theaders.date_asig.label"
                      label-class-name="headerTable"
                      class-name="columnTable"
                      min-width = "200">
                    </el-table-column>
                  </template>
                  <template v-if="headers.date_org_entrega">
                    <el-table-column
                    align="center"
                      prop="date_org_entrega"
                      :label="theaders.date_org_entrega.label"
                      label-class-name="headerTable"
                      class-name="columnTable"
                      min-width = "200">
                    </el-table-column>
                  </template>
                  <template v-if="headers.date_ext">
                    <el-table-column
                    align="center"
                      prop="date_ext"
                      :label="theaders.date_ext.label"
                      label-class-name="headerTable"
                      class-name="columnTable"
                      min-width = "200">
                    </el-table-column>
                  </template>
                  <template v-if="headers.date_fin_entrega">
                    <el-table-column
                    align="center"
                      prop="date_fin_entrega"
                      :label="theaders.date_fin_entrega.label"
                      label-class-name="headerTable"
                      class-name="columnTable"
                      min-width = "200">
                    </el-table-column>
                  </template>
                  <template v-if="headers.date_env_tdc">
                    <el-table-column
                    align="center"
                      prop="date_env_tdc"
                      :label="theaders.date_env_tdc.label"
                      label-class-name="headerTable"
                      class-name="columnTable"
                      min-width = "200">
                    </el-table-column>
                  </template>
                  <template v-if="headers.total">
                    <el-table-column
                    align="center"
                      prop="total"
                      :label="theaders.total.label"
                      label-class-name="headerTable"
                      class-name="columnTable"
                      min-width = "120">
                    </el-table-column>
                  </template>
                  <template v-if="headers.cotizados">
                    <el-table-column
                    align="center"
                      prop="cotizados"
                      :label="theaders.cotizados.label"
                      label-class-name="headerTable"
                      class-name="columnTable"
                      min-width = "120">
                    </el-table-column>
                  </template>
                  <template v-if="headers.porcentaje">
                    <el-table-column
                    align="center"
                      prop="porcentaje"
                      :label="theaders.porcentaje.label"
                      label-class-name="headerTable"
                      class-name="columnTable"
                      min-width = "70">
                    </el-table-column>
                  </template>
                  <template v-if="headers.rfi">
                    <el-table-column
                    align="center"
                      prop="rfi"
                      :label="theaders.rfi.label"
                      label-class-name="headerTable"
                      class-name="columnTable"
                      min-width = "50">
                    </el-table-column>
                  </template>
                  <template v-if="headers.por_cotizar">
                    <el-table-column
                    align="center"
                      prop="por_cotizar"
                      :label="theaders.por_cotizar.label"
                      label-class-name="headerTable"
                      class-name="columnTable"
                      min-width = "140">
                    </el-table-column>
                  </template>
                  <template v-if="headers.tot_cotizacion">
                    <el-table-column
                    align="center"
                      prop="tot_cotizacion"
                      :label="theaders.tot_cotizacion.label"
                      label-class-name="headerTable"
                      class-name="columnTable"
                      min-width = "160">
                    </el-table-column>
                  </template>
                  <template v-if="headers.compra">
                    <el-table-column
                      prop="compra"
                      :label="theaders.compra.label"
                      label-class-name="headerTable"
                    align="center"
                      class-name="columnTable"
                      min-width = "140">
                      <template slot-scope="scope">
                        <el-button 
                          size="mini"
                          v-if="scope.row.compra"
                          type="success" 
                          icon="el-icon-check" 
                          circle>
                        </el-button>
                        <el-button 
                          size="mini"
                          v-else
                          icon="el-icon-close" 
                          circle>
                        </el-button>
                      </template>
                    </el-table-column>
                  </template>
                  <template v-if="headers.pagado">
                    <el-table-column
                    align="center"
                      prop="pagado"
                      :label="theaders.pagado.label"
                      label-class-name="headerTable"
                      class-name="columnTable"
                      min-width = "140">
                      <template slot-scope="scope">
                        <el-button 
                          size="mini"
                          v-if="scope.row.pagado"
                          type="success" 
                          icon="el-icon-check" 
                          circle>
                        </el-button>
                        <el-button 
                          size="mini"
                          v-else
                          icon="el-icon-close" 
                          circle>
                        </el-button>
                      </template>
                    </el-table-column>
                  </template>
                  <template v-if="headers.entregado">
                    <el-table-column
                    align="center"
                      prop="entregado"
                      :label="theaders.entregado.label"
                      label-class-name="headerTable"
                      class-name="columnTable"
                      min-width = "140">
                      <template slot-scope="scope">
                        <el-button 
                          size="mini"
                          v-if="scope.row.entregado"
                          type="success" 
                          icon="el-icon-check" 
                          circle>
                        </el-button>
                        <el-button 
                          size="mini"
                          v-else
                          icon="el-icon-close" 
                          circle>
                        </el-button>
                      </template>
                    </el-table-column>
                  </template>
                  <template v-if="headers.comentarios">
                    <el-table-column
                      prop="comentarios"
                      :label="theaders.comentarios.label"
                      label-class-name="headerTable"
                      class-name="columnTable"
                      min-width = "250">
                    </el-table-column>
                  </template>
                  <template v-if="headers.lid_operacion">
                    <el-table-column
                    align="center"
                      prop="lid_operacion"
                      :label="theaders.lid_operacion.label"
                      label-class-name="headerTable"
                      class-name="columnTable"
                      min-width = "160">
                    </el-table-column>
                  </template>
                  <template v-if="headers.solicitante">
                    <el-table-column
                      prop="solicitante"
                      :label="theaders.solicitante.label"
                      label-class-name="headerTable"
                      class-name="columnTable"
                      min-width = "160">
                    </el-table-column>
                  </template>
                </el-table>
              </div>
            </div>
          </div>

    </div>
  </div>
</template>
<style lang="sass">
.landingProcura
  .buttonsTable
    padding: 3px 5px
    justify-content: flex-start
    height: 35px
    .el-button--default
      padding: 0 2px !important
    .material-design-icon.iconnButton 
      height: 2.5em
      width: 2.5em
    .material-design-icon.iconnButton > .material-design-icon__svg 
        height: 2.5em
        width: 2.5em
    
  .tablaProcesos
    width: 100%
  // .headerTable
  // .columnTable
</style>
