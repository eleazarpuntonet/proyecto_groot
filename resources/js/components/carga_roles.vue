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
	  		permisos: this.$store.getters.getUserPermisos,
	  		checkboxGroup6: [],
	  		editable    : false,
	  		searchbox: null,
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
		checkPermisos(accion_id, accion) {
		  if (this.permisos.some(item => item.action_id == accion_id)) {
		    let index = this.permisos.findIndex(item => item.action_id == accion_id)
		    if (this.permisos[index][accion] == 'true' || this.permisos[index][accion] == true) {
		      return true
		    } else {
		      return false
		    }
		  } else {
		    return false
		  }
		},
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
		this.$store.dispatch('setAccesos', this.$router.app._route.meta.router_id)

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
	<div class="rolesView ele_modelview_A">
		<div class="contRightSide l_radiusBorder">
			<div class="searchBox">
				<el-input 
					size="mini"
					placeholder="Buscar nombre"
					clearable 
					v-model="searchbox">
					<el-button 
						slot="prepend" 
						icon="el-icon-search">
					</el-button>
				</el-input>
			</div>
			<el-table
          	tooltip-effect="light"
			  max-height="800"
			  :data="lista_roles.filter(data => !searchbox || data.display_name.toLowerCase().includes(searchbox.toLowerCase()))"
			  :default-sort = "{prop: 'display_name', order: 'ascending'}"
			  @row-click = "role_click"
			  style      = "width: 100%">
			  <el-table-column
			    label = "Role"
            	:show-overflow-tooltip="true"
			    sortable
			    prop  = "display_name">
			  </el-table-column>
			  <el-table-column
            	:show-overflow-tooltip="true"
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
				<div class="titleForm">
				  <div class="logoGroup">
				    <img
				      src="../../../public/img/sps_logoborderline.png"
				      alt="Logo SPS"/>
				  </div>
				  <div class="textContainer">
				    <div style="display:table-cell;vertical-align:middle;">
				      <div class="texttitle">Carga de roles</div>
				    </div>
				  </div>
				</div>
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
								:disabled = "!checkPermisos('dataload003i1','escribe')">
								</el-input>
						</el-form-item>

						<el-form-item 
							prop="display_name" 
							style="width:50%;">
							<div class="el_label">Nombre
							</div>
							<el-input 
								v-model   = "roles_form_.display_name"
								:disabled = "!checkPermisos('dataload003i1','escribe')">
							</el-input>
						</el-form-item>

						<el-form-item prop="description" style="width:100%;">
							<div class="el_label">Descripcion</div>
							<el-input 
								v-model   = "roles_form_.description"
								:disabled = "!checkPermisos('dataload003i1','escribe')">
								</el-input>
						</el-form-item>
					</div>

					<el-form-item v-if="checkPermisos('dataload003i1','escribe') || checkPermisos('dataload003i1','borra')">
						<el-button 
							v-if="checkPermisos('dataload003i1','escribe')"
							icon="el-icon-success"
							type   = "primary"
							@click = "submitForm('roles_form')">Enviar
						</el-button>
						<el-button
							v-if="checkPermisos('dataload003i1','escribe')"
							icon="el-icon-error"
							@click="resetForm('roles_form')">Reset
						</el-button>
						<el-button 
							type="info"
							icon="el-icon-remove"
							v-if="checkPermisos('dataload003i1','borra')"
							@click="console.log('Ejecuto boton de eliminar')">Eliminar
						</el-button>
					</el-form-item>

				</el-form>
			</div>
		</div>
	</div>
</template>
<style lang="scss">
</style>
