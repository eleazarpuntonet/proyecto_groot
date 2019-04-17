<template>
  <b-tabs>
    <b-tab>
      <template slot="title">
        <i class='icon-settings'></i>
      </template>
<div class="sideTable">
  <el-table
    :data="roles"
    style="width: 100%">
    <el-table-column
      class-name="tableCellClass"
      type="selection"
      min-width="10">
    </el-table-column>
    <el-table-column
      :show-overflow-tooltip="true"
      prop="ruta_id"
      label="Id"
      min-width="30">
    </el-table-column>
    <el-table-column
      :show-overflow-tooltip="true"
      prop="name"
      label="Nombre"
      min-width="60">
    </el-table-column>
  </el-table>
</div>
    </b-tab>
  </b-tabs>
</template>

<script>
import { Switch as cSwitch } from '@coreui/vue'
import {
  getRoles,
} from '../../../apiCalls.js'

export default {
name: 'PanelLateralIzquiero',
computed: {
},
components: {
  cSwitch
},
methods: {
},
data () {
  return {
    roles: null,
  }
},
beforeMount(){
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
}
</script>
