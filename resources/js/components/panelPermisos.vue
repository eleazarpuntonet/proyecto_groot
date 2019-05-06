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
			if ($("body").hasClass("aside-menu-lg-show")) {
			  $("body").toggleClass("aside-menu-lg-show")
			}
		},
	}
</script>
<template>
	<div class="permisosView ele_modelview_A">
		<div class="contRightSide l_radiusBorder">
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
		<div style="display: flex; flex-direction: column; width: 65%;">
			<div class="topSideForm l_radiusBorder">
				<div class="titleForm">
				  <div class="logoGroup">
				    <img
				      src="../../../public/img/sps_logoborderline.png"
				      alt="Logo SPS"/>
				  </div>
				  <div class="textContainer">
				    <div style="display:table-cell;vertical-align:middle;">
				      <div class="texttitle">Asignacion de Permisos</div>
				    </div>
				  </div>
				</div>
			</div>
			<div class="contLeftSide l_radiusBorder">
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
					class="l_radiusBorder"
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
	</div>
</template>
<style lang="scss">
.permisosView{
	.contLeftSide{
		flex-direction: column !important;
		.buttonsUpdateTree{
			display: flex;
			flex-direction: row;
			justify-content: flex-end;
			margin: 5px 0;
		}
	}
}
</style>
