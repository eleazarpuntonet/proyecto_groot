<script>
  import { Switch as cSwitch } from '@coreui/vue'
  import {
    getRoles,
    getPermisosRutasRoles,
  } from '../../../apiCalls.js'
  export default {
    name: 'PanelLateralIzquiero',
    data () {
      return {
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

        // getPermisosRutasRoles({data:'algo'})
        // .then(response => {
        //   this.permisos = response
        // }).catch( error => {
        //   console.log(error)
        // })
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
      }
    },
    components: {
      cSwitch
    },
    methods: {
    },
    watch: {
    },
  }
</script>
<template>
  <b-tabs>
    <b-tab>
      <template slot="title">
        <i class='icon-settings'></i>
      </template>
      <div class="headerCheckbox">
        <div class="item">
          {{getRoleSelected}}
        </div>
        <div class="crud">
          <div class="crudItem">C</div>
          <div class="crudItem">R</div>
          <div class="crudItem">U</div>
          <div class="crudItem">D</div>
        </div>
      </div>
      <div class="checkBoxBody" v-for="permiso in getPermisos">
        <div class="checkBoxLabel">
          {{permiso.action_name}}
        </div>
        <div class="checkBoxes">
          <el-checkbox v-model="permiso.lee"></el-checkbox>
          <el-checkbox v-model="permiso.escribe"></el-checkbox>
          <el-checkbox v-model="permiso.modifica"></el-checkbox>
          <el-checkbox v-model="permiso.borra"></el-checkbox>
        </div>
      </div>
    </b-tab>
  </b-tabs>
</template>
<style lang="scss">
  .nav-link {
      padding: 0.15rem 0.4rem !important;
  }
  .aside-menu .nav-tabs .nav-link {
      padding: 0.15rem 0.4rem !important;
  }
  .headerCheckbox{
    width: 100%;
    display: flex;
    flex-direction: row;
    .item{
      width: 40%;
    }
    .crud{
      width: 60%;
      display: flex;
      flex-direction: row;
      justify-content: center;
      .crudItem{
        width: 100%;
        margin-left: 20px !important;
        text-align: center;
      }
    }
  }
  .checkBoxBody{
    width: 100%;
    display: flex;
    flex-direction: row;
    justify-content: center;
    .checkBoxLabel{
      width: 40%;
    }
    .checkBoxes{
      width: 60%;
      display: flex;
      flex-direction: row;
      justify-content: center;
      .el-checkbox {
        margin-left: 20px !important;
      }
    }
  }
</style>

