<template>
	<div class="rowcentercontainer">
		<b-card no-body class="appblur">
		  <b-card-header >
		  </b-card-header>
		  <b-card-body>
		  	<div class="bodycontainer">
		  		<div class="tablaroles">
		  			<el-table
		  			  :data="roles"
		  			  stripe
		  			  style="width: 100%">
		  			  <el-table-column
		  			    prop="display_name"
		  			    label="Rol"
		  			    width="180">
		  			  </el-table-column>
		  			</el-table>
		  		</div>
		  		<div class="tablactions">
		  			<el-table
		  			  :data="actions"
		  			  style="width: 100%">
		  			  <el-table-column
		  			  	class-name="tableCellClass"
		  			    type="selection"
		  			    min-width="55">
		  			  </el-table-column>
		  			  <el-table-column
		  			  	:show-overflow-tooltip="true"
		  			    prop="action_name"
		  			    label="Nombre">
		  			  </el-table-column>
		  			</el-table>
		  		</div>
		  	</div>
		  </b-card-body>
		</b-card>
			
	</div>
</template>
<script>
	import nav from '../CoreUi/src/_nav';
	import auths from '../auth_items'
	import {
		getActions,
		getRoles,
		currUserActions
	} from '../apiCalls.js'

	export default {
	  /*
	  *
	  * Variables del componente
	  */
	  data () {
	  	return {
	  		roles: null,
	  		actions: null,
	  		temp: null,
	  	}
	},
	computed: {

	},
	methods: {
	},
	beforeMount(){
		getActions()
			.then(res=>{
				this.actions = res
			}).catch(error=>{
				console.log(error)
			})

		getRoles()
			.then(res=>{
				this.roles = res
			}).catch(error=>{
				console.log(error)
			})

		currUserActions(this.$store.getters.currentUser.id)
			.then(res=>{
				console.log(res)
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

<style lang="scss">
.bodycontainer{
	display: flex;
	flex-direction: row;
	flex-wrap: nowrap;
	justify-content: space-between;
}
.tableCellClass{
	padding: 0.5px;
	background-color: red;
	display: inline-block;
	height: 100%;
	vertical-align: middle;
}
.el-table td, .el-table th {
    padding-top: 0.5vh !important;
    padding-bottom: 0.5vh !important;
    padding-left: 2px !important;
    padding-right: 2px !important;
    font-size: 0.8vw !important;
}
.cell{
	display: inline-block;
	height: 100%;
	vertical-align: middle;
	line-height: 1vh !important;
	.el-checkbox{
		vertical-align: middle;
	}
}
label{
	margin-bottom: 0.1rem !important;
}
</style>
