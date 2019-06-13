<script>
	import {VueContentLoading,VclTable} from         'vue-content-loading';
	import {
		getRoles,
		getUsuarios,
		getDepartamentos,
		firmaSPS,
	} from '../apiCalls.js'


	export default {
	  /*
	  *
	  * Variables del componente
	  */
	  data () {
	  	return {
	  		bannflag: {
	  			nombre      : false,
	  			cargo     : false,
	  			tlf       : false,
	  			skype     : false,
	  			mail      : false,
	  			ubicacion : false
	  		},
	  		permisos: this.$store.getters.getUserPermisos,
			dominio_temp    : null,
			editable        : true,
			temp_roles      : [],
			disabled_flag   : false,
			lista_roles     : [],
			lista_usuarios  : [],
			lista_gerencias : [],
			filters         : {},
			searchbox          : null,
			user_form       : {
				name            : null,
				last_name       : null,
				cargo           : null,
				departamento    : null,
				roles           : [],
				codigo_empleado : null,
				email           : null,
				sede            : null,
				ci_usuario      : null,
				status          : "activo",
				banner          : {},
  			},
			rules_          : {
				name            : [
				{ required      : true, message: 'Por favor ingrese un nombre valido', trigger: 'blur' },
					],
				last_name       : [
				{ required      : true, message: 'Por favor ingrese un apellido valido', trigger: 'blur' },
					],
				codigo_empleado : [
				{ required      : true, message: 'El codigo de empleado es obligatorio', trigger: 'blur' },
					],	
				sede            : [
				{ required      : true, message: 'La sede del empleado es un campo obligatorio', trigger: 'blur' },
					],
				departamento    : [
				{ required      : true, message: 'Por favor seleccione un departamento de la lista desplegable', trigger: 'blur' },
					],	
				cargo           : [
				{ required      : true, message: 'El cargo del empleado es obligatorio', trigger: 'blur' },
					],	
				ci_usuario      : [
				{ required      : true, message: 'La cedula de identidad del empleado es un campo obli', trigger: 'blur' },
					],
				email           : [
				{ required      : true, message: 'El apellido es obligatorio', trigger: 'blur' },
					],		
  			},
	  	}
	  },
	  computed: {

	  },
		watch:{
			lista_usuarios(){
			  this.filters.departamento = []
			    this.lista_usuarios.forEach((each)=>{
					if (each.departamento != null) {
					 if (!this.filters.departamento.some(departamento => departamento.value === each.departamento.ceco)) {
					  this.filters.departamento.push({ text : each.departamento.disp_name , value : each.departamento.ceco})
					 } 
					}
			    })
			}
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
	  	printFirma(user){
			let obj   = {}
			let s_name = this.short_name(this.user_form.name)+' '+this.short_lastname(this.user_form.last_name)
			obj.name  = this.user_form.banner.name!=null && this.bannflag.nombre? this.user_form.banner.name : s_name
			obj.cargo = this.user_form.banner.cargo!=null && this.bannflag.cargo? this.user_form.banner.cargo : this.user_form.cargo
			obj.id    = this.user_form.id
			this.user_form.banner.tlf!= null && this.bannflag.tlf ? obj.tlf=this.user_form.banner.tlf : null
			this.user_form.banner.skype!= null && this.bannflag.skype ? obj.skype=this.user_form.banner.skype : null
			this.user_form.banner.mail!= null && this.bannflag.mail ? obj.mail=this.user_form.banner.mail : null
			this.user_form.banner.ubicacion!= null && this.bannflag.ubicacion ? obj.ubicacion=this.user_form.banner.ubicacion : null
			let val   = this.user_form.email
			obj.email = val
			obj.name  = obj.name.toUpperCase()
			firmaSPS(obj)
			.then(response => {
				let nameFile = response.headers[1]
				console.log(nameFile)
				const url = window.URL.createObjectURL(new Blob([response.data]));
				const link = document.createElement('a');
				link.href = url;
				link.setAttribute('download', nameFile); //or any other extension
				document.body.appendChild(link);
				link.click();
			  })
			.catch(error => {
				console.log(error)
			})
	  	},
	  	filterDepto(value, row, column){
			if (row.departamento != null) {
			return row.departamento.ceco === value;
			} else {
			return false
			}
	  	},
	  	callImage(){
	  		axios.post(route('textOnImage',this.user_form)) 
	  		    .then(response => {
	  		    	console.log(response)
	  		        this.$notify({
	  		          title: response.status,
	  		          message: 'Registro creado!',
	  		          type: 'success'
	  		        })
	  		      })
	  		    .catch(error => {
	  		      this.$notify.error({
	  		        title: 'Error '+error.response.status,
	  		        message: error.response.data.message
	  		      });
	  		    })
	  	},
	  	row_click(row,event,column){
			this.user_form               = row
			this.user_form.departamento  = row.departamento.id
			this.user_form.banner = {}
			this.temp_roles              = []
			this.disabled_flag           = true
	  		row.roles.forEach((x,y)=>{
	        	this.temp_roles.push(x.id)
	  		})
	  		for (var prop in this.bannflag) {
	  			this.bannflag[prop] = false
	  		}
	  	},
	  	text_length(text){
	  		return text.substr(0, 10)+"..."
	  	},
	  	submitForm(formName) {
	  		this.user_form.roles  = this.temp_roles
	  		this.user_form.email+= this.dominio_temp
			this.$refs[formName].validate((valid) => {
			  if (valid) {
			  	// console.log(this.user_form.id)
			    axios.patch(route('usuarios.update',this.user_form.id)) 
			        .then(response => {
			        	// this.lista_usuarios.push(response.data)
			        	this.resetForm(formName)
			            // this.$notify({
			            //   title: response.status,
			            //   message: 'Registro creado!',
			            //   type: 'success'
			            // })
			          })
			        .catch(error => {
			          // this.$notify.error({
			          //   title: 'Error '+error.response.status,
			          //   message: error.response.data.message
			          // });
			        })
			  } else {
			    return false;
			  }
			});
		},
		resetForm(formName) {
			this.$refs[formName].resetFields();
			this.temp_roles=[]
		},
		short_name(name){
			var str = name.split(" ")
				return str[0]
		},
		short_lastname(name){
			var str = name.split(" ")
			if (str.length == 1) {
				return str[0]
			} else if (str.length == 2) {
				return str[0]+" "+str[1][0]+"."
			} else if (str.length == 3) {
				return str[0]+" "+str[1][0]+"."
			}
		},
		deptos_(obj){
			if (obj.departamento) {
				var splitted_text = obj.departamento.disp_name.split(" ")
				if (splitted_text.length>2) {
					// return splitted_text[0]+" "+splitted_text[1][3]
					return splitted_text[0]+" "+splitted_text[1].substring(0,4)+"..."
				} else {
					return splitted_text[0]
				}
			}
		}
	  },
	  beforeMount(){
	  	this.$store.dispatch('setAccesos', this.$router.app._route.meta.router_id)
	  	getRoles()
		    .then(response => {
		        response.forEach((x,y)=>{
		        	this.lista_roles.push({
		            key: x.id,
		            label: x.display_name,
		            disabled: false
		          })
		        })
		      })
		    .catch(error => {
		      this.$notify.error({
		        title: 'Error '+error.response.status,
		        message: error.response.data.message
		      });
		    })
		getUsuarios()
		    .then(response => {
		  		this.lista_usuarios = response
		      })
		    .catch(error => {
		      this.$notify.error({
		        title: 'Error '+error.response.status,
		        message: error.response.data.message
		      });
		    })
	  	getDepartamentos()
			.then(response => {
				this.lista_gerencias=response
			  })
			.catch(error => {
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
	<div class="usersView ele_modelview_A">
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
				:data="lista_usuarios.filter(data => !searchbox || data.name.toLowerCase().includes(searchbox.toLowerCase()) || data.last_name.toLowerCase().includes(searchbox.toLowerCase()))"
				@row-click="row_click"
				max-height="800"
				:default-sort = "{prop: 'name', order: 'ascending'}"
				style="width: 100%">
				<el-table-column
					label="Nombre"
					sortable
	            	:show-overflow-tooltip="true"
					prop="name">
					<template slot-scope="scope">
					{{short_name(scope.row.name)}} {{short_lastname(scope.row.last_name)}}
					</template>
				</el-table-column>
				<el-table-column
					:filters="filters.departamento"
					:filter-method="filterDepto"
					sortable
					label="Gerencia"
	            	:show-overflow-tooltip="true"
					prop="departamento.disp_name">
				</el-table-column>
				<template slot="empty">
					<VclTable height="90%" width="100%" class="LoadingAnimation"  :columns="2" :rows="20">
					</VclTable>
				</template>
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
				      <div class="texttitle">Usuarios</div>
				    </div>
				  </div>
				</div>
			</div>
			<div class="contLeftSide l_radiusBorder">
				<el-form :rules="rules_" ref="user_form_" :model="user_form"  size="mini" style="width: 100%;">
					<div style="display: flex; flex-direction: row;">
						<div class="form_line" style="width: 9vw; height: 9vw; align-items: center;"> 
							<img
							  src="/storage/avats/user-default.png"
							  class="img-avatar"
							  alt="admin@bootstrapmaster.com" />
						</div>	
						<div class="form_line_main">
							<div class="form_line">
								<el-form-item prop="name" style="width:50%;">
									<div class="el_label">Nombres</div>
									<el-input v-model="user_form.name" :disabled="!editable"></el-input>
								</el-form-item>

								<el-form-item prop="last_name" style="width:50%;">
									<div class="el_label">Apellidos</div>
									<el-input v-model="user_form.last_name" :disabled="!editable"></el-input>
								</el-form-item>
							</div>

							<div class="form_line">
								<el-form-item prop="name" style="width:50%;">
									<div class="el_label">Nombre de pila</div>
									<el-input v-model="user_form.display_name" :disabled="!editable"></el-input>
								</el-form-item>

								<el-form-item prop="last_name" style="width:50%;">
									<div class="el_label">Cargo</div>
									<el-input v-model="user_form.display_cargo" :disabled="!editable"></el-input>
								</el-form-item>
							</div>
						</div>
					</div>

					<div class="form_line">
						<el-form-item prop="ci_usuario" style="width:100%;">
							<div class="el_label">Cedula de Identidad</div>
							<el-input v-model="user_form.ci_usuario" class="input-with-select" :disabled="!editable">
							  <el-select v-model="user_form.ci_usuario" slot="prepend" placeholder="Nac" :disabled="!editable">
							    <el-option label="V-" value="V-" selected></el-option>
							    <el-option label="E-" value="E-"></el-option>
							  </el-select>
							</el-input>
						</el-form-item>

						<el-form-item prop="codigo_empleado" style="width:50%;">
							<div class="el_label">Codigo de Empleado</div>
							<el-input v-model="user_form.codigo_empleado" :disabled="!editable"></el-input>
						</el-form-item>
					</div>

					<div class="form_line">
						<el-form-item prop="departamento" style="width:100%;">
							<div class="el_label">Departamento</div>
							<el-select v-model="user_form.departamento" style="width:100%;" :disabled="!editable">
							  <el-option
							    v-for="item in lista_gerencias"
							    :key="item.id"
							    :label="item.disp_name"
							    :value="item.id">
							  </el-option>
							</el-select>
						</el-form-item>

						<el-form-item prop="cargo" style="width:100%;">
							<div class="el_label">Cargo</div>
							<el-input v-model="user_form.cargo" :disabled="!editable"></el-input>
						</el-form-item>
					</div>	

					<div class="form_line">
						<el-form-item prop="email" style="width:50%;">
							<div class="el_label">Correo de contacto</div>
							<el-input v-model="user_form.email" class="input-with-select" size="mini" :placeholder="user_form.email" :disabled="!editable">
							  <el-select v-model="dominio_temp"       slot="append" placeholder="Dominio" :disabled="!editable">
								  <el-option label="@spservicesltd.uk"   value="@spservicesltd.uk" selected></el-option>
								  <el-option label="@spservicesinc.uk" 	 value="@spservicesinc.uk"></el-option>
							  </el-select>
							</el-input>
						</el-form-item>		

						<el-form-item prop="tlf" style="width:50%;">
							<div class="el_label">Telefono</div>
							<el-input v-model="user_form.tlf" class="input-with-select" size="mini" placeholder="Telefono" :disabled="!editable">
							</el-input>
						</el-form-item>						
					</div>

					<div class="el_label">Agregar detalles a firma</div>
					<div class="form_line">
						<el-form-item prop="tlf" style="width:80%;">
							<el-input 
								v-model="user_form.banner.name" 
								class="input-with-select" 
								size="mini" 
								placeholder="Nombre" 
								:disabled="!bannflag.nombre">
							</el-input>
						</el-form-item>	
						<el-form-item 
							style="width:20%;">
							<el-checkbox v-model="bannflag.nombre">Nombre personalizado</el-checkbox>
						</el-form-item>						
					</div>
					<div class="form_line">
						<el-form-item prop="tlf" style="width:80%;">
							<el-input 
								v-model="user_form.banner.cargo" 
								class="input-with-select" 
								size="mini" 
								placeholder="Cargo" 
								:disabled="!bannflag.cargo">
							</el-input>
						</el-form-item>		
						<el-form-item 
							style="width:20%;">
							<el-checkbox v-model="bannflag.cargo">Cargo personalizado</el-checkbox>
						</el-form-item>					
					</div>
					<div class="form_line">
						<el-form-item prop="tlf" style="width:80%;">
							<el-input 
								v-model="user_form.banner.tlf" 
								class="input-with-select" 
								size="mini" 
								placeholder="Telefono" 
								:disabled="!bannflag.tlf">
							</el-input>
						</el-form-item>		
						<el-form-item 
							style="width:20%;">
							<el-checkbox v-model="bannflag.tlf">Telefono</el-checkbox>
						</el-form-item>		
					</div>
					<div class="form_line">
						<el-form-item prop="tlf" style="width:80%;">
							<el-input 
								v-model="user_form.banner.skype" 
								class="input-with-select" 
								size="mini" 
								placeholder="Skype" 
								:disabled="!bannflag.skype">
							</el-input>
						</el-form-item>	
						<el-form-item 
							style="width:20%;">
							<el-checkbox v-model="bannflag.skype">Skype</el-checkbox>
						</el-form-item>		
					</div>
					<div class="form_line">
						<el-form-item prop="tlf" style="width:80%;">
							<el-input 
								v-model="user_form.banner.mail" 
								class="input-with-select" 
								size="mini" 
								placeholder="Correo" 
								:disabled="!bannflag.mail">
							</el-input>
						</el-form-item>	
						<el-form-item 
							style="width:20%;">
							<el-checkbox v-model="bannflag.mail">Correo</el-checkbox>
						</el-form-item>						
					</div>
					<div class="form_line">
						<el-form-item prop="tlf" style="width:80%;">
							<el-input 
								v-model="user_form.banner.ubicacion" 
								class="input-with-select" 
								size="mini" 
								placeholder="Ubicacion" 
								:disabled="!bannflag.ubicacion">
							</el-input>
						</el-form-item>
						<el-form-item 
							style="width:20%;">
							<el-checkbox v-model="bannflag.ubicacion">Ubicacion</el-checkbox>
						</el-form-item>							
					</div>


					<div class="form_line">
						<el-form-item>
							<div class="el_label">Gestion de roles de acceso</div>
							<el-transfer
							  v-model="temp_roles"
							  :data="lista_roles"
							  size="mini"
							  :titles="['Roles','Usuario']" :disabled="!editable">
							</el-transfer>
						</el-form-item>
					</div>
					<el-form-item>
						<el-button 
							v-if="checkPermisos('dataload003i3','escribe')"
							type="info" 
							icon="el-icon-success"
							@click="submitForm('user_form_')">Enviar
						</el-button>
						<el-button 
							v-if="checkPermisos('dataload003i3','escribe')"
							icon="el-icon-error"
							@click="resetForm('user_form_')">Reset
						</el-button>
						<el-button 
							v-if="checkPermisos('dataload003i3','escribe')"
							icon="el-icon-error"
							@click="printFirma(user_form)">Generar firma
						</el-button>
					</el-form-item>
				</el-form>
			</div>
		</div>
	</div>
</template>
<style lang="scss">
.usersView{
	.contLeftSide{
		width            : 100% !important;
		display          : flex !important;
		flex-direction   : row !important;
		background-color : #EBEAEA !important;
		padding          : 10px 15px !important;
	}
	.form_line_main{
		width            : 100% !important;
		margin           : 0 20px !important;
		display          : flex !important;
		flex-direction   : column !important;
		justify-content  : center !important;
	}
}
</style>
