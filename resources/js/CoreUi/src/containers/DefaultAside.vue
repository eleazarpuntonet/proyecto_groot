<script>
  import { Switch as cSwitch } from '@coreui/vue'
  import {
    getRoles,
    getPermisosRutasRoles,
    sendPermisosActualizados,
  } from '../../../apiCalls.js'
  export default {
    name: 'PanelLateralIzquiero',
    data () {
      return {
        visibleTab  : false,
        disableCheck  : true,
        roles         : null,
        permisos      : null,
        roleSelected  : null,
        rutasSelected : null,
        sideData      : null,
      }
    },
    beforeMount(){
      this.sideData = this.$store.getters.getPermisosRoles
      getRoles()
        .then(res=>{
          this.roles = res
        }).catch(error=>{
          console.log(error)
        })
    },
    created(){
    },
    mounted(){
    },
    destroyed () {
    },
    computed: {
      getPermisos(){
        let permisos = this.$store.getters.getPermisosRoles
        if (permisos) {
          this.permisos     = permisos.permisos
          this.roleSelected = permisos.role
          this.visibleTab = !this.visibleTab
          console.log(this.permisos)
          return this.permisos
        } else {
          return []
        }
      },
      getRoleSelected(){
        let permisos = this.$store.getters.getPermisosRoles
        if (permisos) {
          return permisos.role.display_name
        } else {
          return 'Aun no hay nada para mostrar'
        }
      },
    },
    components: {
      cSwitch
    },
    methods: {
      CrudClick(){
        this.disableCheck = !this.disableCheck
      },
      sendChanges(){
        this.disableCheck = !this.disableCheck
        let obj = {}
        obj.role = this.roleSelected.id
        obj.permisos = this.permisos
        sendPermisosActualizados(obj)
        .then(res=>{
          console.log(res)
        }).catch(error=>{
          console.log(error)
        })
      }
    },
    watch: {
      roleSelected(){
      }
    },
  }
</script>
<template>
    <div class="asideContainer ele_modelview_A wall">
      <div class="tablePermisos l_radiusBorder">
        <el-table
        fit
          class="l_radiusBorder"
          :data="getPermisos"
          tooltip-effect="light"
          style="width: 100%">
          <el-table-column
            align     = "left"
            :label     = "getRoleSelected"
            min-width = "50">
            <template slot-scope="props">
              {{ props.row.action_name }}
            </template>
          </el-table-column>
          <el-table-column
            align     = "left"
            label     = "C"
            min-width = "10">
            <template slot-scope="props">
              <el-checkbox :disabled="disableCheck" v-model="props.row.escribe"></el-checkbox>
            </template>
          </el-table-column>
          <el-table-column
            align     = "left"
            label     = "R"
            min-width = "10">
            <template slot-scope="props">
              <el-checkbox :disabled="disableCheck" v-model="props.row.lee"></el-checkbox>
            </template>
          </el-table-column>
          <el-table-column
            align     = "left"
            label     = "U"
            min-width = "10">
            <template slot-scope="props">
              <el-checkbox :disabled="disableCheck" v-model="props.row.modifica"></el-checkbox>
            </template>
          </el-table-column>
          <el-table-column
            align     = "left"
            label     = "D"
            min-width = "10">
            <template slot-scope="props">
              <el-checkbox :disabled="disableCheck" v-model="props.row.borra"></el-checkbox>
            </template>
          </el-table-column>
        </el-table>
      </div>


      <div class="buttonLine l_radiusBorder">
        <el-button
        @click="CrudClick()"
          type="primary"
          icon="el-icon-edit"
          size="mini">
          Editar permisos
        </el-button>
        <el-button
        @click="sendChanges()"
        icon="el-icon-refresh"
          type="primary"
          size="mini">
          Actualizar permisos
        </el-button>
      </div>
    </div>
</template>
<style lang="scss">

.asideContainer{
  padding: 3px !important;
  display: flex;
   flex-direction: column;
   border-left: 5px solid #fff;
   .l_radiusBorder{
     padding: 0 0 !important;
     margin: 2px !important;
   }
  .tablePermisos{
    display: flex;
    flex-direction: column;
    justify-content: flex-start;
    .el-table td, .el-table th {
        padding: 2px 0 !important;

    }
  } 
 .buttonLine{
    margin: 10px 5px;
    display: flex;
    flex-direction: row;  
    justify-content: space-evenly;    
  }
  .aside-menu .nav-tabs .nav-link {
      padding: 0.15rem 0.4rem !important;
  }
  .headerCheckbox{
    width: 100%;
    display: flex;
    flex-direction: row;
    font-family: 'Poppins', sans-serif;
    font-style: bold;
    margin-bottom: 5px;
    padding: 0 3px;
    font-size: 15px;
    color: #231F20;
    .item{
      width: 50%;
    }
    .crud{
      width: 50%;
      display: flex;
      flex-direction: row;
      justify-content: center;
      .crudItem{
        // width: 100%;
        margin: 0 7px !important;
        text-align: center;
      }
    }
  }
  .selectable{
    display : flex;
    flex-direction: column;
    .checkBoxBody{
      width: 100%;
      display: flex;
      flex-direction: row;
      justify-content: center;
      font-family: "Roboto";
      font-style: normal;
      padding: 2px 3px;
      border-bottom: 1px solid rgba(128, 128, 128, 0.5);
      font-size: 15px;
      color: #6D6E70;
      .checkBoxLabel{
        width: 50%;
      }
      .checkBoxes{
        width: 50%;
        display: flex;
        flex-direction: row;
        justify-content: center;
        .el-checkbox {
          margin-left: 10px !important;
        }
      }
    }    
  }

}

</style>

