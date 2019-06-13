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
      headers: {
      index          : true,
      cantidad          : true,
      unit              : true,
      descripcion       : true,
      nro_parte         : false,
      marca             : true,
      especificaciones  : false,
      referencia        : false,
      comprador         : true,
      estatus           : true,
      rfi               : true,
      comentarios       : true,
      ubicacion         : true,
      prioridad         : true,
      criterios         : true,
      prov_ganador      : true,
      fecha_ofertca_act : true,
      doc_interno       : true,
      po_realizada      : true,
      pagado            : true,
      min_price         : true,
      ext_price         : true,
      oth_price         : true,
      vendor            : true,
      brand             : true,
      delivery          : true,
      incoterm          : true,
      },
      procesos:[{
        cantidad          : 1,
        unit              : 'Unit',
        descripcion       : 'TRANSFORMADOR TRIFASICO DE POTENCIA 34,5/0,480KV. 3 MVA, 3000/3360/4200 kVA, identificados como TXD-12101 y TXD-12102.',
        nro_parte         : 'CA-1020',
        marca             : 'Cooper',
        especificaciones  : 'Texto aleatorio',
        referencia        : 'VER   LA CARPETA: CCM Y DIAGRAMA  ELECTRICO MACOLLA 21.  ',
        comprador         : 'Humberto Hernadez reasignado a Miguel Brito',
        estatus           : 'Cotizado',
        rfi               : '',
        comentarios       : 'Texto aleatorio',
        ubicacion         : 'Item ubicado en PR18-0240-04',
        prioridad         : 1,
        criterios         : 'Variados',
        prov_ganador      : '',
        fecha_ofertca_act : '',
        doc_interno       : 'no',
        po_realizada      : 'no',
        pagado            : 'no',
        min_price         : 284000.00,
        ext_price         : 285000.00,
        oth_price         : 0.00,
        vendor            : 'Cepsa',
        brand             : 'CEPSA, ABB, GE',
        delivery          : 18,
        incoterm          : 'FCA Venezuela',
      }]
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
              <div class="texttitle">Procesos de Procura</div>
            </div>
          </div>
        </div>
      </div>


          <div class="form_line">
            <div class="contLeftSide l_radiusBorder">
              <el-table
                :data="procesos"
                style="width: 100%">
                <template v-if="headers.index">
                  <el-table-column
                    label-class-name="headerTable"
                    class-name="columnTable"
                    min-width = "5"
                    type="index">
                  </el-table-column>
                </template>
                <template v-if="headers.cantidad">
                  <el-table-column
                    label-class-name="headerTable"
                    class-name="columnTable"
                    align     = "center"
                    label="Cantidad"
                    prop="cantidad"
                    min-width = "5"
                    type="cantidad">
                  </el-table-column>
                </template>
                <template v-if="headers.unit">
                  <el-table-column
                    label-class-name="headerTable"
                    class-name="columnTable"
                    align     = "center"
                    label="Unidad"
                    prop="unit"
                    min-width = "5"
                    type="unit">
                  </el-table-column>
                </template>
                <template v- if="headers.descripcion">
                  <el-table-column
                    label-class-name="headerTable"
                    class-name="columnTable"
                    align     = "center"
                    label="Descripcion"
                    prop="descripcion"
                    min-width = "5"
                    type="descripcion">
                  </el-table-column>
                </template>
                <template v-if="headers.nro_parte">
                  <el-table-column
                    label-class-name="headerTable"
                    class-name="columnTable"
                    align     = "center"
                    label="Nro parte"
                    prop="nro_parte"
                    min-width = "5"
                    type="nro_parte">
                  </el-table-column>
                </template>
              </el-table>
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
