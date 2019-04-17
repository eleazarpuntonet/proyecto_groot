<script>
	import nav from '../CoreUi/src/_nav';
	import auths from '../auth_items'
	import {
		GetRutas,
		getActions,
		getRoles,
		getRutasRoles,
		currUserActions
	} from '../apiCalls.js'

	export default {
	  /*
	  *
	  * Variables del componente
	  */
	  data () {
	  	return {
			roles                       : null,
			rutas                       : null,
			actions                     : null,
			temp                        : null,
			temporalTablaRutasSelection : null,
			temporalTablaRutasMultiple  : null,
	  	}
	},
	computed: {

	},
	methods: {
		roleClick(row,column,event){
			getRutasRoles(row.id)
			.then((res)=>{
				this.toggleSelection(this.rutas.rutasFilter(res))
				// console.log(res)
			}).catch((error)=>{
				console.log(error)
			})
		},
		toggleSelection(rows) {
			console.log(this.$refs.multipleTable)
			console.log(rows)
			if (rows) {
				rows.forEach(row => {
				  this.$refs.multipleTable.toggleRowSelection(row);
				});
			} 
			// else {
			// this.$refs.multipleTable.clearSelection();
			// }
		},
		handSelectionChange(val){
			this.temporalTablaRutasMultiple = val;
		},
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
		this.rutas = GetRutas(nav)
	},
	created(){
	},
	mounted(){
	},
	destroyed () {
	},
	}
</script>
<template>
	<div class="rowcentercontainer">
		<b-card no-body class="appblur">
		  <b-card-header >
		  </b-card-header>
		  <b-card-body>
		  	<div class="bodycontainer">
		  		<div class="tablaroles">
		  			<el-table
		  				fit
		  			  :data="roles"
		  			  stripe
		  			  @row-click="roleClick"
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
					:reserve-selection="true"
					:data             = "rutas.rutasTree"
					row-key          = "ruta_id"
					border
					ref               = "multipleTable"
					@selection-change = "handSelectionChange"
					style             = "width: 100%">
						<el-table-column
							class-name             = "tableCellClass"
							type                   = "selection"
							min-width              = "10">
						</el-table-column>
						<el-table-column
							:show-overflow-tooltip = "true"
							prop                   = "ruta_id"
							label                  = "Id"
							min-width              = "30">
						</el-table-column>
						<el-table-column
							:show-overflow-tooltip = "true"
							prop                   = "name"
							label                  = "Nombre"
							min-width              = "60">
						</el-table-column>
						<el-table-column type="expand">
							<template slot-scope="props">
							<div class="tablaChild">
							<el-table
								:show-header="false"
							  :data             = "props.row.child"
							  style             = "width: 100%">
							  <el-table-column
							  	class-name             = "tableCellClass"
							  	type                   = "selection"
							  	min-width              = "10">
							  </el-table-column>
							  <el-table-column
							  	:show-overflow-tooltip = "true"
							  	prop                   = "ruta_id"
							  	label                  = "Id"
							  	min-width              = "30">
							  </el-table-column>
							  <el-table-column
							  	:show-overflow-tooltip = "true"
							  	prop                   = "name"
							  	label                  = "Nombre"
							  	min-width              = "60">
							  </el-table-column>
							  <el-table-column type="expand">
							    <template slot-scope="props">
							      <p>Estado: {{ props.row }}</p>
							    </template>
							  </el-table-column>
							</el-table>
							</div>
							</template>
						</el-table-column>
						<el-table-column type="expand">
							<template slot-scope="props">
								{{props.row}}
							</template>
						</el-table-column>
					</el-table>
		  		</div>
		  	</div>
		  </b-card-body>
		</b-card>
			
	</div>
</template>
<style lang="scss">
.bodycontainer{
	display         : flex;
	flex-direction  : row;
	flex-wrap       : nowrap;
	justify-content : space-between;
	.tablactions{
		width          : 70%;
		margin-left    : 10px;
	}
	.tablaroles{
		width          : 30%;
	}
	.cell{
		display        : inline-block;
		height         : 100%;
		vertical-align : middle;
		.el-checkbox{
			vertical-align: middle;
		}
	}
}
.tableCellClass{
	padding        : 0.5px;
	display        : inline-block;
	height         : 100%;
	vertical-align : middle;
}
.el-table td, .el-table th {
	padding-top    : 0.5vh !important;
	padding-bottom : 0.5vh !important;
	padding-left   : 2px !important;
	padding-right  : 2px !important;
	font-size      : 0.8vw !important;
}

label{
	margin-bottom  : 0.1rem !important;
}
</style>
