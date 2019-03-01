<template>
	<div class="rowcentercontainer">
		<b-card no-body class="appblur">
		  <b-card-header >
		  </b-card-header>
		  <b-card-body>
<!-- 		  	<div slot="header" class="clearfix" style="">
		  		<strong>Gestion de Usuarios</strong>

		  		<el-button-group style="float:right;">
		  		  <el-button 
		  		  @click="back()"
		  		  	size="mini" 
		  		  	type="primary" 
		  		  	icon="el-icon-arrow-left">Anterior</el-button>
		  		  <el-button 
		  		  @click="next()"
		  		  	size="mini" 
		  		  	type="primary">Siguiente<i class="el-icon-arrow-right el-icon-right"></i></el-button>
		  		</el-button-group>
		  	</div> -->



		  	<el-container>
		  	  <el-aside width="35%" style="background-color: white;">
		  	  	
		  	  	<el-table
		  	  	  :data="lista_usuarios"
		  	  	  @row-click="row_click"
		  	  	  style="width: 100%">
		  	  	  <el-table-column
		  	  	    label="Nombre"
		  	  	    prop="user">
		  	  	    <template slot-scope="scope">
		  	  	      {{scope.row.name}} {{scope.row.last_name}}
		  	  	    </template>
		  	  	  </el-table-column>
		  	  	  <el-table-column
		  	  	    label="Sede"
		  	  	    prop="sede">
		  	  	  </el-table-column>
		  	  	</el-table>

		  	  </el-aside>
		  	  <el-container>
		  	    <el-header>
		  		  	<div class="l_box_title">
		  		  		<el-button @click="callImage" type="warning">Iamgen</el-button>
		  				<strong>Usuarios</strong> 
		  		  	</div>
		  	    </el-header>
		  	    <el-main>

		  	    	<div class="formulario_gestion">
		  	    		<el-form :rules="rules_" ref="user_form_" :model="user_form"  size="mini">
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
		  	    						<el-input v-model="user_form.name" ></el-input>
		  	    					</el-form-item>

		  	    					<el-form-item prop="last_name" style="width:100%;">
		  	    						<div class="el_label">Apellidos</div>
		  	    						<el-input v-model="user_form.last_name" ></el-input>
		  	    					</el-form-item>
		  	    				</div>
		  	    			</div>

		  	    			<div class="form_line">
		  	    				<el-form-item prop="ci_usuario" style="width:100%;">
		  	    					<div class="el_label">Cedula de Identidad</div>
		  	    					<el-input v-model="user_form.ci_usuario" class="input-with-select">
		  	    					  <el-select v-model="user_form.ci_usuario" slot="prepend" placeholder="Nac">
		  	    					    <el-option label="V-" value="V-" selected></el-option>
		  	    					    <el-option label="E-" value="E-"></el-option>
		  	    					  </el-select>
		  	    					</el-input>
		  	    				</el-form-item>

		  	    				<el-form-item prop="codigo_empleado" style="width:50%;">
		  	    					<div class="el_label">Codigo de Empleado</div>
		  	    					<el-input v-model="user_form.codigo_empleado" ></el-input>
		  	    				</el-form-item>
		  	    			</div>

		  	    			<div class="form_line">
		  	    				<el-form-item prop="departamento" style="width:100%;">
		  	    					<div class="el_label">Departamento</div>
		  	    					<el-select v-model="user_form.departamento" style="width:100%;">
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
		  	    					<el-input v-model="user_form.cargo" ></el-input>
		  	    				</el-form-item>
		  	    			</div>	

		  	    			<div class="form_line">
		  	    				<el-form-item prop="email" style="width:100%;">
		  	    					<div class="el_label">Correo de contacto</div>
			  	    				<el-input v-model="user_form.email" class="input-with-select" size="mini" :placeholder="user_form.email">
			  	    				  <el-select v-model="dominio_temp"       slot="append" placeholder="Dominio">
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
		  	    					  :titles="['Roles','Usuario']">
		  	    					</el-transfer>
		  	    				</el-form-item>
		  	    			</div>

		  	    			<el-form-item>
		  	    				<el-button type="primary" @click="submitForm('user_form_')">Enviar</el-button>
		  	    				<el-button @click="resetForm('user_form_')">Reset</el-button>
		  	    			</el-form-item>

		  	    		</el-form>
		  	    	</div>

		  	    </el-main>
		  	  </el-container>
		  	</el-container>







		  </b-card-body>
		</b-card>
			
	</div>
</template>
<script>
	export default {
	  /*
	  *
	  * Variables del componente
	  */
	  data () {
	  	return {
	  		dominio_temp   : null,
	  		temp_roles     : [],
	  		disabled_flag  : false,
	  		lista_roles    : [],
	  		lista_usuarios : [],
	  		lista_gerencias: [],
	  		user_form:{
	  			name         : null,
	  			last_name       : null,
	  			cargo        : null,
	  			departamento : null,
	  			roles        : [],
	  			codigo_empleado : null,
	  			email        : null,
	  			sede         : null,
	  			ci_usuario           : null,
	  			status       : "activo",
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
	  methods: {
	  	callImage(){
	  		// console.log("llamando iamgen")
	  		axios.get(route('textOnImage')) 
	  		    .then(response => {
	  		    	// this.lista_usuarios.push(response.data)
	  		    	// this.resetForm(formName)
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
	  		this.user_form     = row
	  		this.temp_roles    = []
	  		this.disabled_flag = true
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
			    axios.post(route('usuarios.store'),this.user_form) 
			        .then(response => {
			        	this.lista_usuarios.push(response.data)
			        	this.resetForm(formName)
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
			  } else {
			    return false;
			  }
			});
		},
		resetForm(formName) {
			this.$refs[formName].resetFields();
			this.temp_roles=[]
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
			  this.lista_usuarios=response.data.data
			  this.usuarios=response.data.data
			      })
			    .catch(error => {
			      this.$notify.error({
			        title: 'Error '+error.response.status,
			        message: error.response.data.message
			      });
			    })
			axios.get(route('gerencias.index')) 
			    .then(response => {
			    	console.log(response)
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

<style lang="scss">
.el_label{
	padding-top: 8px;
	padding-bottom: 0px;
	line-height: 1vw;
	font-size: .7vw;
	font-family: 'Eurostile LTS';
}
.formulario_gestion{
	width: 100%;
}
.form_line{
	display: flex;
	flex-direction: row;
	justify-content: center;
}
.form_line_main{
	padding-left: 30px;
	width: 100%;
	display: flex;
	flex-direction: column;
	justify-content: space-between;
}

.el-checkbox__label{
	padding-top: 2px;
	padding-bottom: 0px;
	line-height: 1vw;
	font-size: .7vw;
	font-family: 'Eurostile LTS';
}
.el-checkbox .el-checkbox__label{
	font-size: .8vw !important;
}
.el-checkbox__label span{
	font-size: .8vw !important;
}
.el-transfer-panel{
	width: 18vw !important;
}
.el-transfer__buttons{
  	padding: 0 5px !important;
}
.el-input-group__append{
	width: 30% !important;
}




$unitHeight : 90px;
	#printSheet{
		padding: 2cm;
		background-color: white;
		width: 215.9mm;
		height: 279.4 mm;
		.sheetHeader{
			display: flex;
			flex-direction: row;
			justify-content: space-between;
			height: $unitHeight;
			line-height: $unitHeight;
			background-color: rgba(0, 0, 255, .5);
			.iconMain{
				display: flex;
				flex-direction: row;
				justify-content: center;
				img{
					margin: 15px;
				}
			}
			.headerBody{
				display: flex;
				flex-direction: column;
				justify-content: center;
				text-indent: center;
				span{
					display: inline-block;
					vertical-align: middle;
					line-height: normal;
				}
				.boxname{
					height: 60%;
					line-height: inherit;
					span{
						font-family: 'Raleway', sans-serif;
						font-size: 1.5rem;
					}
				}
				.boxlabel{
					height: 40%;
					line-height: initial;
					span{
						font-size: .5rem;
						font-family: 'Roboto';
					}
				}
			}
			.headerdatabox{
				font-size: .5rem;
				font-family: 'Roboto';
				width: 100px;
				background-color: rgba(255, 0, 0, .5);
				display: flex;
				flex-direction: column;
				justify-content: space-between;
				.datarow{
					line-height: initial;
				}
				span{
					font-size: .5rem;
					font-family: 'Roboto';
				}
			}
		}
	}			
	// @import url('https://fonts.googleapis.com/css?family=Open+Sans|Oswald|Playfair+Display|Poppins|Raleway|Roboto');
	.l_box_title{
			text-align:center;
			font-family: 'Raleway', sans-serif;
			font-size: 1.4em;
			display: flex;
			flex-direction: column;
		strong{
			text-transform: capitalize;
			font-size: 2em;
			line-height:1em;
		}
	}

	.autori{
		margin: 5px;
	}
	.notif_section{
		display: flex;
		flex-direction: row;
		justify-content: center;
		font-size: 1.5em;
		button{
			color: white;
			background-color: #007CC2;
		}
		
	}
	.box_notif{
		background-color: rgba(0, 124, 194, 0.3);
		border: 1px solid white;
		font-family: 'Poppins', sans-serif;
	}
	.box_auth{
		background-color: rgba(251, 175, 63, 0.3);
		border: 1px solid white;
		font-family: 'Poppins', sans-serif;
	}
	.box_neg{
		background-color: rgba(208, 77, 81, 0.3);
		border: 1px solid white;
		font-family: 'Poppins', sans-serif;
	}
	#separador2{
		height:1px;
		margin-top: 10px;
		margin-bottom: 10px;
		border-bottom:1px solid white;
	}
	#separador1{
		// border-left: 1px solid white; /* Border on the left */
		width: 1px; /* Width instead of height */
		height: 100px;
		background-color: white;
	}
	.icon_box{
		margin-top: 0px;
		margin-left: 5px;
		margin-right: 5px;
	}
	.box_data_reserv{
		font-size: 12px;
		.main_icon{
			font-size: 3em;
		}
		.items_box{
			margin: auto;
			text-align: center;
			display: flex;
			flex-flow: column nowrap;
			div {
				width: 100%;
				margin: 3px;
			}
			.date_text{
				font-size: 1em;
				letter-spacing: 1px;
			}
		}
		.itemsh_box{
			margin: auto;
			text-align: center;
			display: flex;
			flex-flow: row nowrap;
			position: relative;
			div{
				height: 100%;
			}
			p{
				text-align: left;
				margin-left: 5px;
				margin-right: 5px;
			}
			.country{
				font-size: 2em;
				line-height: 2em;
				letter-spacing: 1px;
			}
			.state{
				font-size: 1.3em;
				line-height: 2em;	
			}
			.item{
				margin: auto;
				p{
					margin: auto;
					line-height: 1.5em;
				}
			}
			.item_icon{
				font-size: 1.5em;
			}

		}
		.itinerario{
			margin-bottom: 5px;
		}
		.center{
			justify-content:center !important;
			font-size: 1.2em;
		}
		.box_v{
			width: 100%;
		}
		.box_dep{
			font-style: italic;
			font-size: 1.3em;
			line-height:1.3em;
			display: flex; 
			// justify-content: center; 
			align-items: center;
		}
		.img_ger{
			margin: auto;
			padding: 0;
			text-align: center;
			img{
				width: 75%;
			}
		}
		.text_aut{
			display: flex; 
			flex-direction: column;
			font-size: 0.8em;
			line-height:0.9em;
			text-align: left;
			padding: 3px;
			div{
				margin-top:3px;
				margin-bottom: 3px;
				p{
					// margin-bottom: 0px !important;
				}
			}
			.title_ger{
				font-size: 1.5em;
			}
		}
	}
	.box{
		// background-color: rgba(235, 235, 235, 1);
		// border: 1px solid white;
		font-family: 'Poppins', sans-serif;
	}

</style>
