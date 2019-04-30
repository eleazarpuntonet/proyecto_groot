<script>
	import nav from '../CoreUi/src/_nav';
	import auths from '../auth_items'
	import {VueContentLoading,VclTable} from         'vue-content-loading';
	export default {
	  /*
	  *
	  * Variables del componente
	  */
	  data () {
	  	return {
	  		value3 : null,
	  		checkboxGroup6: [],
	  		editable    : false,
	  		auth : {
	  			roleform: auths.submit_roles,
	  			pathform: auths.submit_paths,
	  		},
			nav         : [],
			path_routes : [],
			_routes     : [],
			roles_form_ : {},
			lista_roles : [],
			rules_      : {
			name: [
				{ 
					required: true,
					message: 'El nombre es obligatorio',
					trigger: 'blur' 
				},
			],
			display_name: [
				{ 
					required: true,
					message: 'El apellido es obligatorio',
					trigger: 'blur' 
				},
			],
			description: [
				{ 
					required: true,
					message: 'El apellido es obligatorio',
					trigger: 'blur' 
				},
			],	
			},
		}
	},
	computed: {

	},
	components: {
	    VueContentLoading,
	    VclTable,
	},
	methods: {
		checkChange(item,index,action){
			item.allowed.push(action)
			console.log(index)
			console.log(action)
			console.log(item)

		},
		allowAct(path){
			path.act = []
			path.cont.forEach((va,ia) => {
				let x = path.sub_path.find(sub => sub.idOriginal === va)
				if (x.action.length > 0) {
					x.action.forEach((vb,ib) => {
						vb.allowed = []
						path.act.push(vb)
					})
				}
			})
		},
		handleCheckAllChange(val) {
			console.log(val)
		  val.flagInd=false;
		  if (val.cont.length===0) {
				val.sub_path.forEach((value,index,arr)=>{
					val.cont.push(value.idOriginal)
				})
		  } else {
		  	val.cont=[]
		  }
		  this.allowAct(val)
		},
		handleCheckItem(value) {
		  let checkedCount = value.cont.length;
		  value.flag       = checkedCount === value.sub_path.length;
		  value.flagInd    = checkedCount > 0 && checkedCount < value.sub_path.length;
		  this.allowAct(value)
		},
		id_filter(id_path){
			let idpath      = id_path
			let count       = 0
			let indexSlice  = 0
				indexSlice--
				return {
				idOriginal : id_path,
				}
		},
		submitForm(formName) {
			this.$refs[formName].validate((valid) => {
				let path_toSend = []
				this.path_routes.forEach((val,index)=>{
					if (val.cont.length!=0) {
						path_toSend.push(val.idOriginal)
						val.cont.forEach((x,index)=>{
							path_toSend.push(x)
						})
					} 
				})
				this.roles_form_.pack_idPaths = JSON.stringify(path_toSend);
			  if (valid) {
					axios.post(route('roles.store',this.roles_form_)) 
					.then(response => {
						this.roles_form_ = {}
					  	this.lista_roles.push(response.data)
					  })
					.catch(error => {
					  this.$notify.error({
					    title: 'Error '+error.response.status,
					    message: error.response.data.message
					  });
					})
			  } else {
			    console.log('error submit!!');
			    return false;
			  }
			});
		},
		resetForm(formName) {
			this.$refs[formName].resetFields();
		},
		role_click(val){
			this.path_routes = []  //RUTAS FILTRADAS
			this.roles_form_ = val //Guardo en la variable modelo de formulario, el objeto rol seleccionado
			axios.post(route('roles.Authpath',val.id)) //Peticion API para obtener RUTAS AUTORIZADAS del rol seleccionado
			.then(response => {
				let lista_paths = response.data.auth_roles //RUTAS AUTORIZADAS del rol
				// let lista_paths = response.data.auth_actions //ACCIONES AUTORIZADAS de cada ruta
				this._routes.forEach((x,index)=>{
					if (lista_paths.some(path => path.pathitem_id == x.idOriginal)) {
						// Si el item del menu se encuentra en el arreglo autorizado
						// se barren las sub rutas
						// para filtrar otros items
						this.path_routes.push(x) //Guarda valor encontrado en arreglo de RUTAS FITRADAS
						this.path_routes[(this.path_routes.length-1)].cont = [] //Al ultimo item del arreglo de rutas se crea la propiedad cont donde se guardaran los id de SUBRUTAS AUTORIZADAS
						x.sub_path.forEach((xa,arr)=>{
							let idsubpath = xa.idOriginal
							// Se barren las subrutas de TODAS LAS RUTAS
							if (lista_paths.some(path => path.pathitem_id == idsubpath)) {
								// valida si en las subrutas de TODAS LAS RUTAS se encuentra el id de la SUBRUTA AUTORIZADA

								let temp = lista_paths.find(path => path.pathitem_id == idsubpath)
								this.path_routes[(this.path_routes.length-1)].cont.push(idsubpath)
								// guarda valor de la subruta actual en la propiedad cont del ultimo indice del arreglo de RUTAS FILTRADAS
							} 
						})
					} else {
						// Si el item del menu se NO encuentra en el arreglo autorizado igual se agrega la ruta en al arreglo de RUTAS FILTRADAS pero con la propiedad CONT vacia
						this.path_routes.push(x)
						this.path_routes[(this.path_routes.length-1)].cont = []
					}
					let tamanoCont           = this.path_routes[(this.path_routes.length-1)].cont.length
					let tamanoSubpaths       = this.path_routes[(this.path_routes.length-1)].sub_path.length
					this.path_routes[(this.path_routes.length-1)].flag    = tamanoCont === tamanoSubpaths
					this.path_routes[(this.path_routes.length-1)].flagInd = tamanoCont > 0 && tamanoCont < tamanoSubpaths
				})
				this.path_routes.forEach((v,i) => {
					this.allowAct(v)
				})
			})
			.catch(error => {
				console.log(error)
			})
		},
	},
	beforeMount(){
		axios.get(route('roles.index')) 
		.then(response => {
	  		this.lista_roles=response.data
		}).catch(error => {
			this.$notify.error({
				title: 'Error '+error.response.status,
				message: error.response.data.message
			});
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
<template>
	<div class="rolesView">
		<div class="contRightSide l_radiusBorder">
			<el-table
			  :data      = "lista_roles"
			  @row-click = "role_click"
			  style      = "width: 100%">
			  <el-table-column
			    label = "Role"
			    prop  = "display_name">
			  </el-table-column>
			  <el-table-column
			    label = "Descripcion"
			    prop  = "description">
			  </el-table-column>
			  <template slot="empty">
			  	<VclTable height="90%" width="100%" class="LoadingAnimation"  :columns="2" :rows="20">
			  	</VclTable>
			  </template>
			</el-table>
		</div>
		<div style="display: flex; flex-direction: column; width: 100%;">
			<div class="topSideForm l_radiusBorder">
				Carga de roles
			</div>
			<div class="contLeftSide l_radiusBorder">
				<el-form 
					:rules="rules_" 
					ref="roles_form" 
					:model="roles_form_"  
					size="mini">

					<div class="form_line">
						<el-form-item prop="name" style="width:30%;">
							<div class="el_label">Referencia</div>
							<el-input 
								v-model   = "roles_form_.name"
								:disabled = "!auth.roleform.crea">
								</el-input>
						</el-form-item>

						<el-form-item 
							prop="display_name" 
							style="width:50%;">
							<div class="el_label">Nombre
							</div>
							<el-input 
								v-model   = "roles_form_.display_name"
								:disabled = "!auth.roleform.crea">
							</el-input>
						</el-form-item>

						<el-form-item prop="description" style="width:100%;">
							<div class="el_label">Descripcion</div>
							<el-input 
								v-model   = "roles_form_.description"
								:disabled = "!auth.roleform.crea">
								</el-input>
						</el-form-item>
					</div>

					<el-form-item v-if="auth.roleform.crea || auth.roleform.borra">
						<el-button v-if="auth.roleform.crea"
							type   = "primary"
							@click = "submitForm('roles_form')">Enviar
						</el-button>
						<el-button
							v-if="auth.roleform.crea" 
							@click="resetForm('roles_form')">Reset
						</el-button>
						<el-button 
							v-if="auth.roleform.borra"
							@click="console.log('Ejecuto boton de eliminar')">Eliminar
						</el-button>
					</el-form-item>

				</el-form>
			</div>
		</div>
	</div>
</template>
<style lang="scss">
.rolesView{
	display        : flex;
	flex-direction : row;
	.topSideForm{
		width            : 100%;
		height           : 40px;
		background-color : #EBEAEA;
		font-size        : 1.9vw;
		color            : #231F20;
		font-family      : 'Roboto';
		display          : flex;
		flex-direction   : column;
		justify-content  : center;
		font-style       : bold;
	}
	.contRightSide{
		display          : flex;
		width            : 35%;
		flex-direction   : column;
		justify-content  : flex-start;
		background-color : #EBEAEA;
		.el-table{
			border-radius      : 5px !important;
			margin-top         : 5px;
		}
		.el-table td, .el-table th {
			font-size          : 12px !important;
			padding            : 0px 0 !important;
			min-width          : 0;
			-webkit-box-sizing : border-box;
			box-sizing         : border-box;
			text-overflow      : ellipsis;
			vertical-align     : middle;
			position           : relative;
			text-align         : left;
		}
	}
	.contLeftSide{
		display          : flex;
		width            : 100%;
		width            : 100%;
		display          : flex;
		flex-direction   : row;
		background-color : #EBEAEA;

	}
}
</style>
