<template>
	<div class="rowcentercontainer">
		<b-card no-body class="appblur">
		  <b-card-header >
		  </b-card-header>
		  <b-card-body>
		  	<div slot="header" class="clearfix" style="">
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
		  	</div>

		  	<el-container>
		  	  <el-aside width="35%">
				<el-table
				  :data="lista_roles"
				  style="width: 100%">
				  <el-table-column
				    label="Role"
				    prop="display_name">
				  </el-table-column>
				  <el-table-column
				    label="Descripcion"
				    prop="description">
				  </el-table-column>
				</el-table>
		  	  </el-aside>
		  	  <el-container>
				<el-header>
				  	<div class="l_box_title">
						<strong> Carga de Roles</strong> 
				  	</div>
				</el-header>
		  	    <el-main>
		  	    	<div class="formulario_gestion">
		  	    		<el-form :rules="rules_" ref="roles_form" :model="roles_form_"  size="mini">

		  	    			<div class="form_line">
		  	    				<el-form-item prop="name" style="width:30%;">
		  	    					<div class="el_label">Referencia</div>
		  	    					<el-input v-model="roles_form_.name" ></el-input>
		  	    				</el-form-item>

		  	    				<el-form-item prop="display_name" style="width:50%;">
		  	    					<div class="el_label">Nombre</div>
		  	    					<el-input v-model="roles_form_.display_name" ></el-input>
		  	    				</el-form-item>

		  	    				<el-form-item prop="description" style="width:100%;">
		  	    					<div class="el_label">Descripcion</div>
		  	    					<el-input v-model="roles_form_.description" ></el-input>
		  	    				</el-form-item>
		  	    			</div>

		  	    			<el-form-item>
		  	    				<el-button type="primary" @click="submitForm('roles_form')">Enviar</el-button>
		  	    				<el-button @click="resetForm('roles_form')">Reset</el-button>
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
	  		roles_form_:{},
	  		rules_: {
				name: [
						{ required: true, message: 'El nombre es obligatorio', trigger: 'blur' },
					],
				display_name: [
						{ required: true, message: 'El apellido es obligatorio', trigger: 'blur' },
					],
				description: [
						{ required: true, message: 'El apellido es obligatorio', trigger: 'blur' },
					],	

	  		},
	  		lista_roles: [],
	  	}
	  },
	  computed: {

	  },
	  methods: {
	  	submitForm(formName) {
			this.$refs[formName].validate((valid) => {
			  if (valid) {
			    	axios.post(route('roles.store',this.roles_form_)) 
			    	    .then(response => {
			    	    	this.resetForm(formName);
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
		}
	  },
	  beforeMount(){
		axios.get(route('roles.index')) 
		    .then(response => {
	        	this.lista_roles=response.data
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
.formulario_roles{
	width: 100%;
}
.form_line{
	display: flex;
	flex-direction: row;
	justify-content: center;
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
			font-family: 'Raleway', sans-serif;
			font-size: 1.4em;
			display: flex;
			flex-direction: column;
		strong{
			text-transform: capitalize;
			font-size: 3.2em;
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
