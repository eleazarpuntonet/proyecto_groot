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
      lista_usuarios: [],
      gerencias: [],
      roles: [],
      filters: {},
    }
  },
  components :{
    VueContentLoading,
    VclTable
  },
  computed: {
  },
  watch: {
    lista_usuarios(){
      this.filters.cargo = []
      this.filters.departamento = []
        this.lista_usuarios.forEach((each)=>{
           if (!this.filters.cargo.some(cargo => cargo.text === each.cargo)) {
            this.filters.cargo.push({ text : each.cargo , value : each.cargo})
           }

        if (each.departamento != null) {
         if (!this.filters.departamento.some(departamento => departamento.value === each.departamento.ceco)) {
          this.filters.departamento.push({ text : each.departamento.disp_name , value : each.departamento.ceco})
         } 
        }

          // console.log(each.cargo)
          // console.log(each.gerencia)
          // console.log(each.sede)
          // console.log(each.sexo)
          // console.log(each.status)
        })
      // }
    }
  },
  methods: {
    filterCargo(value, row, column){
      return row.cargo === value;
    },
    filterDepto(value, row, column){
      if (row.departamento != null) {
        return row.departamento.ceco === value;
      } else {
        return false
      }
    },
  },
  created() {
  },
  beforeMount(){
    getDepartamentos()
      .then(res=>{
        this.gerencias = res
      }).catch(error=>{
        console.log(error)
      })

    getUsuarios()
      .then(res=>{
        this.lista_usuarios = res
      }).catch(error=>{
        console.log(error)
      })

    getRoles()
      .then(res=>{
        this.roles = res
      }).catch(error=>{
        console.log(error)
      })
  }
}
</script>
<template>
  <div class="indexEmpleados">
<!--     <div class="contRightSide l_radiusBorder">

    </div> -->
    <div style="display: flex; flex-direction: column; width: 100%;">
      <div class="topSideForm l_radiusBorder">
        Fuerza Laboral
      </div>
      <div class="contLeftSide l_radiusBorder">
        <el-table
          :data="lista_usuarios"
          max-height="500"
          tooltip-effect="light"
          style="width: 100%">
          <el-table-column type="expand">
            <template slot-scope="props">
              <div 
                style="display: flex; flex-direction: row;" 
                v-if="props.row.roles">
                <el-button 
                  size="mini"  
                  round>{{ props.row.roles[0] }}
                </el-button>
              </div>
            </template>
          </el-table-column>
          <el-table-column
            label="Nombre"
            :show-overflow-tooltip="true"
            sortable
            prop="name">
            <template slot-scope="scope">
              {{scope.row.name}} {{scope.row.last_name}}
            </template>
          </el-table-column>
          <el-table-column
            :show-overflow-tooltip="true"
            :filters="filters.cargo"
            :filter-method="filterCargo"
            filter-placement="bottom-end"
            sortable
            label="Cargo"
            prop="cargo">
          </el-table-column>
          <el-table-column
            :show-overflow-tooltip="true"
            label="Sede"
            prop="sede">
          </el-table-column>
          <el-table-column
            sortable
            label="Departamento"
            :show-overflow-tooltip="true"
            :filters="filters.departamento"
            :filter-method="filterDepto"
            filter-placement="bottom-end"
            prop="departamento.disp_name">
          </el-table-column>
          <template slot="empty">
            <VclTable height="90%" width="100%" class="LoadingAnimation"  :columns="5" :rows="25">
            </VclTable>
          </template>
        </el-table>
      </div>
    </div>
  </div>
</template>
<style lang="scss">
.indexEmpleados{
  display        : flex;
  flex-direction : row;
  .topSideForm{
    width: 100%;
    height: 40px;
    background-color: #002E47;
    font-size: 2vw;
    color: white;
    text-shadow: 1px 1px 3px #231F20;
    font-family: 'PT Sans', sans-serif;
    font-weight: 700;
    display: flex;
    flex-direction: column;
    justify-content: center;
    font-style: bold;
  }
  .contRightSide{
    display          : flex;
    width            : 35%;
    flex-direction   : column;
    justify-content  : flex-start;
    background-color : #EBEAEA;
  }
  .contLeftSide{
    display          : flex;
    width            : 100%;
    width            : 100%;
    display          : flex;
    flex-direction   : row;
    background-color : #EBEAEA;
    .el-table{
      border-radius      : 5px !important;
      margin-top         : 5px;
    }
    .el-table td, .el-table th {
      font-size          : 12px !important;
      padding            : 0px 0 !important;
      min-width          : 0;
      -webkit-box-sizing : border-box;
      box-sizing         : border-box;
      text-overflow      : ellipsis;
      vertical-align     : middle;
      position           : relative;
      text-align         : left;
    }

  }
}

</style>
