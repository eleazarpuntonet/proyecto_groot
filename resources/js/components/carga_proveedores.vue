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
				  :data="lista_proveedores"
				  style="width: 100%">
				  <el-table-column
				    label="Nombre"
				    prop="nombre">
				  </el-table-column>
				  <el-table-column
				    label="Pais"
				    prop="pais">
				  </el-table-column>
				  <el-table-column
				    label="Rif"
				    prop="rif">
				  </el-table-column>
				</el-table>
		  	  </el-aside>
		  	  <el-container>
				<el-header>
				  	<div class="l_box_title">
						<strong> Proveedores </strong> 
				  	</div>
				</el-header>
		  	    <el-main>
		  	    	<div class="formulario_gestion">
		  	    		<el-form :rules="rules_proveedores" ref="proveedores_form" :model="proveedores_form_"  size="mini">

		  	    			<div class="form_line">
		  	    				<el-form-item prop="nombre" style="width:35%;">
		  	    					<div class="el_label">Nombre</div>
		  	    					<el-input v-model="proveedores_form_.nombre" ></el-input>
		  	    				</el-form-item>

		  	    				<el-form-item prop="r_social" style="width:35%;">
		  	    					<div class="el_label">Razon social</div>
		  	    					<el-input v-model="proveedores_form_.r_social" ></el-input>
		  	    				</el-form-item>

		  	    				<el-form-item prop="rif" style="width:30%;">
		  	    					<div class="el_label">Rif</div>
		  	    					<el-input v-model="proveedores_form_.rif" class="input-with-select">
		  	    					  <el-select v-model="proveedores_form_.rif" slot="prepend" placeholder="Nac">
		  	    					    <el-option label="J-" value="J-" selected></el-option>
		  	    					    <el-option label="E-" value="E-"></el-option>
		  	    					  </el-select>
		  	    					</el-input>
		  	    				</el-form-item>
		  	    			</div>

		  	    			<div class="form_line">
		  	    				<el-form-item prop="t_contribuyente" style="width:30%;">
		  	    					<div class="el_label">Tipo de contribuyente</div>
		  	    					<el-select v-model="proveedores_form_.t_contribuyente" placeholder="Contribuyente">
		  	    					  <el-option label="Ordinario" value="Ordinario" selected></el-option>
		  	    					  <el-option label="Formal" value="Formal"></el-option>
		  	    					  <el-option label="Especial" value="Especial"></el-option>
		  	    					</el-select>
		  	    				</el-form-item>

		  	    				<el-form-item prop="pais" style="width:30%;">
		  	    					<div class="el_label">Pais</div>
		  	    					<el-select v-model="proveedores_form_.pais" placeholder="Pais">
		  	    					  <el-option label="Venezuela" value="Venezuela," selected></el-option>
		  	    					  <el-option label="Otro" value="Otro"></el-option>
		  	    					</el-select>
		  	    				</el-form-item>

		  	    				<el-form-item prop="dir" style="width:70%;">
		  	    					<div class="el_label">Direccion</div>
		  	    					<el-input v-model="proveedores_form_.dir" :disabled="(!proveedores_form_.pais)?true:false">
		  	    					</el-input>
		  	    				</el-form-item>
		  	    			</div>


			  	    		<el-button 
			  	    			:class="(tmp_contact || tmp_extra)?'no_visible':'nada'"
			  	    			@click="_contact(true)"
			  	    			size="mini" 
			  	    			type="primary" 
			  	    			icon="el-icon-circle-plus">Agregar contacto</el-button>

		  	    			<el-button 
		  	    				:class="(tmp_extra || tmp_contact)?'no_visible':'nada'"
		  	    				@click="_extra(true)"
		  	    				size="mini" 
		  	    				type="primary" 
		  	    				icon="el-icon-circle-plus">Agregar informacion extra</el-button>


						<template v-if="tmp_contact">
		  	    			<div class="form_line">
		  	    				<el-form-item prop="contacto" style="width:50%;">
		  	    					<div class="el_label">Nombre</div>
		  	    					<el-input v-model="contactos_form_.nombre">
		  	    					</el-input>
		  	    				</el-form-item>
		  	    				<el-form-item prop="contacto" style="width:50%;">
		  	    					<div class="el_label">Descripcion</div>
		  	    					<el-input v-model="contactos_form_.descripcion">
		  	    					</el-input>
		  	    				</el-form-item>
							</div>

		  	    			<div class="form_line">
		  	    				<el-form-item prop="contacto" style="width:100%;">
		  	    					<div class="el_label">Datos de contacto</div>
			  	    				<el-input v-model="contactos_form_.value" class="input-with-select" size="mini" :placeholder="contactos_form_.medio">
			  	    				  <el-select v-model="contactos_form_.medio"       slot="prepend" placeholder="Medio de contacto">
				  	    				  <el-option label="Correo"         value="Correo">         </el-option>
				  	    				  <el-option label="Telefono" 		value="Telefono"> 		</el-option>
				  	    				  <el-option label="Whatsapp"       value="Whatsapp">       </el-option>
				  	    				  <el-option label="Skype"          value="Skype">          </el-option>
			  	    				  </el-select>
			  	    				  <el-button @click="add_contact()" slot="append" icon="el-icon-check" class="cn_buttonadd"></el-button>
			  	    				</el-input>
		  	    				</el-form-item>
		  	    			</div>
						</template>

						<template v-if="tmp_extra">
		  	    			<div class="form_line">
		  	    				<el-form-item prop="contacto" style="width:100%;">
		  	    					<div class="el_label">Informacion Extra</div>
					  	    			<div class="form_line">
					  	    				<el-form-item prop="contacto" style="width:100%;">
					  	    					<div class="el_label">Descripcion</div>
					  	    					<el-input v-model="extra_form.data" placeholder="Detalles ">
					  	    						<el-select
					  	    							slot="prepend"
					  	    						  	v-model="extra_form.key"
					  	    						  	filterable
					  	    						  	allow-create
					  	    						  	placeholder="Tipo">
					  	    						  	<el-option label="Nuevo" value="Nuevo"></el-option>
					  	    						</el-select>
					  	    						<el-button @click="add_extra()" slot="append" icon="el-icon-check" class="cn_buttonadd"></el-button>
					  	    					</el-input>
					  	    				</el-form-item>
										</div>
		  	    				</el-form-item>
		  	    			</div>
						</template>



		  	    		</el-form>

		  	    	</div>
		  	    </el-main>
		  	    <el-footer>
		  	    	<el-button size="mini" type="primary" @click="submitForm('proveedores_form')">Enviar</el-button>
		  	    	<el-button size="mini" @click="resetForm('proveedores_form')">Reset</el-button>
		  	    </el-footer>
		  	  </el-container>
		  	</el-container>





		  </b-card-body>
		</b-card>
			
	</div>
</template>
<script>
	class InfoExtra{
	  constructor(data){
	    this.data    = data.data
	    this.key     = data.key
	  }
	}
	export default {
	  /*
	  *
	  * Variables del componente
	  */
	  data () {

	  	return {
	  		tmp_contact: false,
	  		tmp_extra: false,
	  		arr_temp:[],
	  		proveedores_form_:{
	  			extras: [],
	  			contacto: [],
	  		},
	  		contactos_form_:{
	  			descripcion : null,
	  			medio       : null,
	  			nombre      : null,
	  			value       : null
	  		},
	  		extra_form:{
	  			data:null,
	  			key:null
	  		},
	  		rules_proveedores: {
				rif: [
						{ required: true, message: 'Campo obligatorio', trigger: 'blur' },
					],
				r_social: [
						{ required: true, message: 'Campo obligatorio', trigger: 'blur' },
					],
				nombre: [
						{ required: true, message: 'Campo obligatorio', trigger: 'blur' },
					],	
				key: [
						{ required: true, message: 'Campo obligatorio', trigger: 'blur' },
					],
				data: [
						{ required: true, message: 'Campo obligatorio', trigger: 'blur' },
					],
	  		},
	  		lista_proveedores: [],
	  		options4: [],
	  		  value9: [],
	  		  list: [],
	  		  loading: false,

	  	}
	  },
	  computed: {

	  },
	  methods: {
	  	add_extra(){
	  		this.tmp_extra= false
	  		if (this.extra_form.key) {
	  			this.proveedores_form_.extras.push({ 
	  				data: this.extra_form.data,
	  				key: this.extra_form.key
	  			})
	  		} 
	  	},
	  	add_contact(){
	  		this.tmp_contact= false
	  		if (this.contactos_form_.value) {
	  			this.proveedores_form_.contacto.push({
	  				medio       : this.contactos_form_.medio,
	  				nombre      : this.contactos_form_.nombre,
	  				value       : this.contactos_form_.value,
	  				descripcion : this.contactos_form_.descripcion,
	  			})
	  		} 
	  	},
	  	_contact(val){
	  		this.tmp_contact=val
	  		this.contactos_form_.medio       = null
	  		this.contactos_form_.nombre      = null
	  		this.contactos_form_.value       = null
	  		this.contactos_form_.descripcion = null
	  	},
	  	_extra(val){
	  		this.tmp_extra=val
	  		this.extra_form.key       = null
	  		this.extra_form.data      = null
	  	},
	  	submitForm(formName) {
			this.$refs[formName].validate((valid) => {
			  if (valid) {

			  	console.log()
			  	this.proveedores_form_.extras = JSON.stringify(this.proveedores_form_.extras)
			  	this.proveedores_form_.contacto = JSON.stringify(this.proveedores_form_.contacto)
			    	axios.post(route('proveedores.store',this.proveedores_form_)) 
			    	    .then(response => {
			    	    	this.resetForm(formName)
			            	this.lista_proveedores.push(response.data)
			    	      })
			    	    .catch(error => {
			    	    	console.log(error)
			    	      this.$notify.error({
			    	        title: 'Error '+error.response,
			    	        message: error.response
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
		remoteMethod(query) {
		   if (query !== '') {
		     this.loading = true;
		     setTimeout(() => {
		       this.loading = false;
		       this.options4 = this.list.filter(item => {
		         return item.label.toLowerCase()
		           .indexOf(query.toLowerCase()) > -1;
		       });
		     }, 200);
		   } else {
		     this.options4 = [];
		   }
		 },
	  },
	  beforeMount(){
	  		axios.get(route('proveedores.index')) 
	  		    .then(response => {
	  	        	this.lista_proveedores=response.data
	  		      })
	  		    .catch(error => {
	  		    	console.log(error)
	  		      this.$notify.error({
	  		        title: 'Error '+error.response,
	  		        message: error.response
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
.el-input-group__prepend{
	width: 30%!important;
}
.cn_buttonadd{
	background-color: rgb(64, 158, 255) !important;
	color: white !important;
}
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
.no_visible{
	display:none;
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
			font-size: 1em;
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
