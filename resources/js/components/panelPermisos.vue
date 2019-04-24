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
				rolesTemp    : null,
				roles        : null,
				rutas        : null,
				actions      : null,
				roleSelected : null,
				editableRutas : false,
				editableCRUD : false,
				editableCHANGES : false,
				added : [],
				deleted : [],
				defaultProps: {
				  children : 'children',
				  label    : 'name',
				  disabled : 'disabled',
				},
				}
		},
		computed: {
		},
		watch:{
			editableRutas(){
				this.rutas.changeDisabled(this.editableRutas)
			},
			editableCRUD(){
				// this.rutas.changeDisabled(this.editableRutas)
			},
			editableCHANGES(){
				// this.rutas.changeDisabled(this.editableRutas)
			},
		},
		methods: {
			checkChangeRuta(nodo , select , children){

			},
			updateCRUD(){
				this.editableCRUD = !this.editableCRUD
				let paqueteASide       = {}
				let checked            = this.$refs.treeRutas.getCheckedKeys()
				let halfChecked        = this.$refs.treeRutas.getHalfCheckedKeys()
				paqueteASide.findRutas = []
				paqueteASide.role      = this.roleSelected
				checked.forEach(each     => paqueteASide.findRutas.push(each))
				halfChecked.forEach(each => paqueteASide.findRutas.push(each))
				this.$store.dispatch('load_permisos', paqueteASide)
			},
			updateRUTAS(row){
				this.editableRutas = !this.editableRutas
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
			},
			changeRoleSelection(currentRow , oldRow){
				getRutasRoles(currentRow.id)
				.then((res)=>{
					this.rolesTemp = this.rutas.rutasFilter(res)
					if (this.$refs.treeRutas) {
						this.editableRutas = false
						this.$refs.treeRutas.setCheckedKeys([], true)
						this.rolesTemp.forEach( each => this.$refs.treeRutas.setChecked(each.ruta_id, true))
						this.checkChangeRuta()
					}
				}).catch((error)=>{
					console.log(error)
				})
			},
			sendCHANGES(){
				// const h = this.$createElement;
				// this.$msgbox({
				//   title: 'Confirmar',
				//   message: h('p', null, [
				//     h('span', null, 'Message can be '),
				//     h('i', { style: 'color: teal' }, 'VNode')
				//   ]),
				//   showCancelButton: true,
				//   confirmButtonText: 'OK',
				//   cancelButtonText: 'Cancel',
				//   beforeClose: (action, instance, done) => {
				//     if (action === 'confirm') {
				//       instance.confirmButtonLoading = true;
				//       instance.confirmButtonText = 'Loading...';
				//       setTimeout(() => {
				//         done();
				//         setTimeout(() => {
				//           instance.confirmButtonLoading = false;
				//         }, 300);
				//       }, 3000);
				//     } else {
				//       done();
				//     }
				//   }
				// }).then(action => {
				//   this.$message({
				//     type: 'info',
				//     message: 'action: ' + action
				//   });
				// });

				this.editableRutas = !this.editableRutas
				let checked = this.$refs.treeRutas.getCheckedKeys()
				let autoriz = this.rolesTemp
				let diff = this.rutas.diffRutas(checked,autoriz)
				diff.deleted.forEach((each)=>{
					this.deleted.push(this.rutas.rutasInline.find(x => x.ruta_id == each))
				})
				diff.added.forEach((each)=>{
					this.added.push(this.rutas.rutasInline.find(x => x.ruta_id == each))
				})
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
					this.$refs.tablaRoles.setCurrentRow(this.roles[0])
					this.changeRoleSelection(this.roles[0])
					this.roleSelected = this.roles[0]
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
	<div class="bodycontainer">
		<div class="tablaroles">
		<el-table
		fit
		:data="roles"
		ref='tablaRoles'
		highlight-current-row
		@current-change="changeRoleSelection">
			<el-table-column
			prop="display_name"
			label="Rol"
			min-width="100">
			</el-table-column>
		</el-table>
		</div>
		<template v-for="permiso in rutas.rutasTree">
			<br>
		</template>
		<div class="treeRutas">
			<div class="buttonsUpdateTree">
<!-- 				<el-button
				@click="updateCRUD()"
				  type="primary"
				  :disabled="this.editableRutas"
				  size="mini">
				  Editar CRUD
				</el-button> -->
				<el-button
				@click="updateRUTAS"
				  :disabled="this.editableRutas"
				  type="primary"
				  size="mini">
				  Editar accesos
				</el-button>
				<el-button
				@click="sendCHANGES"
				  :disabled="!this.editableRutas"
				  type="primary"
				  size="mini">
				  Actualizar cambios
				</el-button>
			</div>
			<el-tree
			v-if="this.rolesTemp"
			show-checkbox
			ref = "treeRutas"
			@check-change="checkChangeRuta"
			:check-strictly="true"
			:default-checked-keys = "getCheckedKeys()"
			:highlight-current = "true"
			:data                 = "rutas.rutasTree"
			node-key              = "ruta_id"
			:props                = "defaultProps">
			</el-tree>
			<div class="boxinfo">
				<div class="deleted">
					Se eliminaran los siguientes accesos para el rol {{roleSelected}} 
					{{deleted}}
				</div>
				<div class="added">
					Se agregaran los accesos ### al rol ###
					{{added}}
				</div>
				<div class="butonConfirm">
					<el-button type="warning">Confirmar</el-button>
				</div>
			</div>
		</div>
	</div>
</template>
<style lang="scss">
.bodycontainer{
	display         : flex;
	flex-direction  : row;
	flex-wrap       : nowrap;
	justify-content : space-between;
	.boxinfo{
		background-color: white;
		.deleted{
			
		}
		.added{

		}
	}
	.buttonsUpdateTree{
	background-color: white;
	padding: 5px 3px;
		display         : flex;
		flex-direction  : row;
		flex-wrap       : nowrap;
		justify-content : flex-end;
	}
	.customTreeNode{
		display         : flex;
		flex-direction  : row;
		flex-wrap       : nowrap;
		justify-content : space-between;
	   	 width: 100%;
		.treeLabel {
		    display: flex;
		    flex-direction: column;
		    justify-content: center;
		}
	}
	.tableCellClass{
		padding        : 0.5px;
		display        : inline-block;
		height         : 100%;
		vertical-align : middle;
	}
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
