<script>
	import {VueContentLoading,VclTable} from         'vue-content-loading';



	export default {
	  /*
	  *
	  * Variables del componente
	  */
	  data () {
	  	return {
	  		dominio_temp   : null,
	  		editable   : false,
	  		temp_roles     : [],
	  		disabled_flag  : false,
	  		lista_roles    : [],
	  		lista_usuarios : [],
	  		lista_gerencias: [],
	  		user_form:{
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
	  		},
	  		rules_: {
				name: [
						{ required: true, message: 'Por favor ingrese un nombre valido', trigger: 'blur' },
					],
				last_name: [
						{ required: true, message: 'Por favor ingrese un apellido valido', trigger: 'blur' },
					],
				codigo_empleado: [
						{ required: true, message: 'El codigo de empleado es obligatorio', trigger: 'blur' },
					],	
				sede: [
						{ required: true, message: 'La sede del empleado es un campo obligatorio', trigger: 'blur' },
					],
				departamento: [
						{ required: true, message: 'Por favor seleccione un departamento de la lista desplegable', trigger: 'blur' },
					],	
				cargo: [
						{ required: true, message: 'El cargo del empleado es obligatorio', trigger: 'blur' },
					],	
				ci_usuario: [
						{ required: true, message: 'La cedula de identidad del empleado es un campo obli', trigger: 'blur' },
					],
				email: [
						{ required: true, message: 'El apellido es obligatorio', trigger: 'blur' },
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
	  		console.log(row)
			this.user_form               = row
			this.user_form.departamento  = row.departamento.id
			this.temp_roles              = []
			this.disabled_flag           = true
	  		row.roles.forEach((x,y)=>{
	        	this.temp_roles.push(x.id)
	  		})
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
			axios.get(route('roles.index')) 
			    .then(response => {
			        response.data.forEach((x,y)=>{
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
			axios.get(route('usuarios.index')) 
			    .then(response => {
			    	console.log('Recibiendo montado:=======')
			    	console.log(response)
			  		// this.lista_usuarios = response.data.data
			  		this.lista_usuarios = response.data
			      })
			    .catch(error => {
			      this.$notify.error({
			        title: 'Error '+error.response.status,
			        message: error.response.data.message
			      });
			    })
			axios.get(route('gerencias.index')) 
			    .then(response => {
			    	this.lista_gerencias=response.data
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
	<div class="usersView">
		<div class="contRightSide l_radiusBorder">
			<el-table
			  :data="lista_usuarios"
			  @row-click="row_click"
			  style="width: 100%">
			  <el-table-column
			    label="Nombre"
			    prop="user">
			    <template slot-scope="scope">
			      {{short_name(scope.row.name)}} {{short_lastname(scope.row.last_name)}}
			    </template>
			  </el-table-column>
			  <el-table-column
			    label="Sede"
			    prop="sede">
			    <template slot-scope="scope">
			      {{deptos_(scope.row)}}
			    </template>
			  </el-table-column>
			    <template slot="empty">
			    	<VclTable height="90%" width="100%" class="LoadingAnimation"  :columns="2" :rows="20">
			    	</VclTable>
			    </template>
			</el-table>
		</div>
		<div style="display: flex; flex-direction: column; width: 65%;">
			<div class="topSideForm l_radiusBorder">
				Usuarios
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
							<el-form-item prop="name" style="width:100%;">
								<div class="el_label">Nombres</div>
								<el-input v-model="user_form.name" :disabled="!editable"></el-input>
							</el-form-item>

							<el-form-item prop="last_name" style="width:100%;">
								<div class="el_label">Apellidos</div>
								<el-input v-model="user_form.last_name" :disabled="!editable"></el-input>
							</el-form-item>
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
						<el-form-item prop="email" style="width:100%;">
							<div class="el_label">Correo de contacto</div>
							<el-input v-model="user_form.email" class="input-with-select" size="mini" :placeholder="user_form.email" :disabled="!editable">
							  <el-select v-model="dominio_temp"       slot="append" placeholder="Dominio" :disabled="!editable">
								  <el-option label="@spservicesltd.uk"   value="@spservicesltd.uk" selected></el-option>
								  <el-option label="@spservicesinc.uk" 	 value="@spservicesinc.uk"></el-option>
							  </el-select>
							</el-input>
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

					<el-form-item v-if="editable">
						<el-button type="primary" @click="submitForm('user_form_')">Enviar</el-button>
						<el-button @click="resetForm('user_form_')">Reset</el-button>
					</el-form-item>
				</el-form>
			</div>
		</div>
	</div>
</template>
<style lang="scss">
.usersView{
	display: flex;
	flex-direction:row;
	width: 100%;
	.form_line_main{
		width: 100%;
	    margin: 0 20px;
	    display: flex;
	    flex-direction: column;
	    justify-content: center;
	}
	.topSideForm{
		width: 100%;
		height: 40px;
		background-color: #EBEAEA;
		font-size: 1.9vw;
		color: #231F20;
		font-family: 'Roboto';
		display: flex;
		flex-direction: column;
		justify-content: center;
		font-style: bold;
	}
	.contRightSide{
		width: 35%;
		display: flex;
		flex-direction: column;
		justify-content: flex-start;
		background-color: #EBEAEA;
		.el-table{
			border-radius: 5px !important;
			margin-top: 5px;
		}
		.el-table td, .el-table th {
			font-size: 12px !important;
		    padding: 0px 0 !important;
		    min-width: 0;
		    -webkit-box-sizing: border-box;
		    box-sizing: border-box;
		    text-overflow: ellipsis;
		    vertical-align: middle;
		    position: relative;
		    text-align: left;
		}
	}
	.contLeftSide{
		width: 100%;
		display: flex;
		flex-direction: row;
		background-color: #EBEAEA;
		padding: 10px 15px;
	}
}
</style>
