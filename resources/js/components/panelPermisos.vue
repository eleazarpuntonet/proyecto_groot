<script>
	import nav from '../CoreUi/src/_nav';
	import auths from '../auth_items'
	import {
		GetRutas,
		getActions,
		getRoles,
		getRutasRoles,
		sendRutasActualizadas
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
			},
			editableCHANGES(){
			},
			roleSelected(){
				if ($("body").hasClass("aside-menu-lg-show")) {
				  $("body").toggleClass("aside-menu-lg-show")
				}
			},
		},
		methods: {
			checkChangeRuta(nodo , select , children){

			},
			updateCRUD(){
				this.editableCRUD      = !this.editableCRUD
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
				this.roleSelected = currentRow
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
				this.editableRutas = !this.editableRutas
				let checked        = this.$refs.treeRutas.getCheckedKeys()
				let autoriz        = this.rolesTemp
				let diff           = this.rutas.diffRutas(checked,autoriz)
				diff.deleted.forEach(each => this.deleted.push(this.rutas.rutasInline.find(x => x.ruta_id == each)))
				diff.added.forEach(each   => this.added.push(this.rutas.rutasInline.find(x   => x.ruta_id == each)))
				if (this.added.length>0) {
					var textAdd        = 'Se agregaran los accesos a las rutas:'
					this.added.forEach(each   => textAdd+='<br><strong>'+each.name+'</strong>')
					if (this.deleted.length>0){
						textAdd+= '<br> y se eliminaran los accesos a las rutas:'
						this.deleted.forEach(each => textAdd+='<br><strong>'+each.name+'</strong>')
					}
				} else if ((this.deleted.length>0)) {
					var textAdd= 'Se eliminaran los accesos a las rutas:'
					this.deleted.forEach(each => textAdd+='<br><strong>'+each.name+'</strong>')
				}
				if (this.added.length>0 || this.deleted.length>0) {
					this.$msgbox({
					  title: 'Confirmar',
					  message: textAdd,
					  showCancelButton: true,
					  confirmButtonText: 'Enviar',
					  cancelButtonText: 'Cancelar',
					  dangerouslyUseHTMLString: true,
					  beforeClose: (action, instance, done) => {
					  	if (action === 'confirm') {
					  	  instance.confirmButtonLoading = true;
					  	  instance.confirmButtonText    = 'Enviando...';
					  	  console.log('desde aqui se van a envair los cambios')
					  	  let obj = {}
					  	  obj.role = this.roleSelected.id
					  	  this.added.length>0 ? obj.added = this.added : obj.added = null
					  	  this.deleted.length>0 ? obj.deleted = this.deleted : obj.deleted = null
					  	  sendRutasActualizadas(obj)
					  	  .then((res)=>{
					  	  	console.log(res)
					  	  	this.added                    = []
					  	  	this.deleted                  = []
					  	  	instance.confirmButtonLoading = false;
					  	  	done();
					  	  }).catch((error)=>{
					  	  	console.log(error)
					  	  })
					    } else {
					      done();
					    }
					  }
					}).then(action => {
						this.$message({
						type: 'info',
						message: 'action: ' + action
						});
					});
				}
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
				<el-button
				@click="updateCRUD()"
				icon="el-icon-view"
				  type="primary"
				  :disabled="this.editableRutas"
				  size="mini">
				  Ver permisos
				</el-button>
				<el-button
				@click="updateRUTAS"
				icon="el-icon-edit"
				  :disabled="this.editableRutas"
				  type="primary"
				  size="mini">
				  Editar accesos
				</el-button>
				<el-button
				@click="sendCHANGES"
				icon="el-icon-refresh"
				  :disabled="!this.editableRutas"
				  type="primary"
				  size="mini">
				  Actualizar accesos
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
		</div>
	</div>
</template>
<style lang="scss">
.bodycontainer{
	display         : flex;
	flex-direction  : row;
	flex-wrap       : nowrap;
	justify-content : space-between;
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
