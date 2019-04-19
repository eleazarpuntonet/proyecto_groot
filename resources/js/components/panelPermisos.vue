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
			data () {
				return {
				rolesTemp                   : null,
				roles                       : null,
				rutas                       : null,
				actions                     : null,
				temp                        : null,
				temporalTablaRutasSelection : null,
				temporalTablaRutasMultiple  : null,
				defaultProps: {
				  children: 'children',
				  label: 'name'
				},

				}
		},
		computed: {
		},
		methods: {
			checkChangeRuta(nodo , select , children){
				let paqueteASide       = {}
				let checked            = this.$refs.treeRutas.getCheckedKeys()
				let halfChecked        = this.$refs.treeRutas.getHalfCheckedKeys()
				paqueteASide.findRutas = []
				checked.forEach(each     => paqueteASide.findRutas.push(each))
				halfChecked.forEach(each => paqueteASide.findRutas.push(each))
				this.$store.commit('SETASIDEDATA', paqueteASide)
			},
			roleClick(row,column,event){
				console.log('Roleckick')
				// console.log(row)
				getRutasRoles(row.id)
				.then((res)=>{
					this.rolesTemp = this.rutas.rutasFilter(res)
					if (this.$refs.treeRutas) {
						this.$refs.treeRutas.setCheckedKeys([], true)
						this.rolesTemp.forEach( each => this.$refs.treeRutas.setChecked(each.ruta_id, true))
					}
					
				}).catch((error)=>{
					console.log(error)
				})
			},
			getCheckedKeys(){
				if (this.rolesTemp) {
					let rutasChecked = []
					this.rolesTemp.forEach( each => rutasChecked.push(each.ruta_id))
					return rutasChecked
				} else {
					console.log('no hay nada')
					return []
				}
			}
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
					console.log(this.roles[0])
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
			// console.log(this.$refs.treeRutas.toggleRowSelection(this.roles[0],true))
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
					ref='tablaRoles'
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
		  		<div class="treeRutas">
		  			<el-tree
		  			v-if="this.rolesTemp"
		  			  show-checkbox
		  			  accordion
		  			  ref = "treeRutas"
		  			  :default-checked-keys = "getCheckedKeys()"
		  			  :highlight-current = "true"
		  			  :data                 = "rutas.rutasTree"
		  			  node-key              = "ruta_id"
		  			  @check-change = "checkChangeRuta"
		  			  :props                = "defaultProps">
		  			</el-tree>
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
	.treeRutas{
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
