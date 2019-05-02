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
          return 'Aun no hay nada para mostrar'
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
  <div class="asideContainer">
    <b-tabs>
        <b-tab>
          <template slot="title">
            <i class='icon-settings'></i>
          </template>
          <div class="headerCheckbox">
            <div class="item">
              {{getRoleSelected}}
            </div>
            <div v-if="visibleTab" class="crud">
              <div class="crudItem">C</div>
              <div class="crudItem">R</div>
              <div class="crudItem">U</div>
              <div class="crudItem">D</div>
            </div>
          </div>
          <div v-if="visibleTab" class="checkBoxBody" v-for="permiso in getPermisos">
            <div class="checkBoxLabel">
              {{permiso.action_name}}
            </div>
            <div class="checkBoxes">
              <el-checkbox :disabled="disableCheck" v-model="permiso.lee"></el-checkbox>
              <el-checkbox :disabled="disableCheck" v-model="permiso.escribe"></el-checkbox>
              <el-checkbox :disabled="disableCheck" v-model="permiso.modifica"></el-checkbox>
              <el-checkbox :disabled="disableCheck" v-model="permiso.borra"></el-checkbox>
            </div>
          </div>
          <div class="buttonLine">
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
        </b-tab>      
    </b-tabs>
  </div>

</template>
<style lang="scss">
.asideContainer{
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

</style>

