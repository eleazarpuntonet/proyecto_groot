<template>
  <b-tabs>
    <b-tab>
      <template slot="title">
        <i class='icon-settings'></i>
      </template>
<div class="sideTable">
  <el-table
    :data="permisos"
    style="width: 100%">
    <el-table-column
      class-name="tableCellClass"
      type="selection"
      min-width="10">
    </el-table-column>
    <el-table-column
      :show-overflow-tooltip="true"
      prop="role_id"
      label="Id"
      min-width="30">
    </el-table-column>
    <el-table-column
      :show-overflow-tooltip="true"
      prop="action_id"
      label="Nombre"
      min-width="60">
    </el-table-column>
  </el-table>
  {{getSideData}}
</div>
    </b-tab>
  </b-tabs>
</template>

<script>
import { Switch as cSwitch } from '@coreui/vue'
import {
  getRoles,
  getPermisosRutasRoles,
} from '../../../apiCalls.js'

export default {
name: 'PanelLateralIzquiero',
computed: {
  getSideData(){


    console.log('las cosas estan cambiando por aqui')
    let data = this.$store.getters.getAsideData
    if (data) {
      getPermisosRutasRoles(data)
      .then(response => {
        console.log("recibniendo paquete")
        this.permisos = response.data
        return response
      }).catch( error => {
        console.log(error)
      })
    } else {
      return "nada para mostrar"
    }
  },
},
components: {
  cSwitch
},
methods: {
},
watch: {
},
data () {
  return {
    roles: null,
    permisos: null,
    sideData: this.$store.getters.getAsideData,
  }
},
beforeMount(){
  getRoles()
    .then(res=>{
      this.roles = res
    }).catch(error=>{
      console.log(error)
    })


    // getPermisosRutasRoles({
    //   data_id : 'Entretenido',
    //   ruta_id : ['array','de data']
    // })
    //   .then(res=>{
    //     console.log(res)
    //   }).catch(error=>{
    //     console.log(error)
    //   })

},
created(){
},
mounted(){
},
destroyed () {
},
}
</script>
