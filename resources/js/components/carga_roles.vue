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
		  		  	@click = "back()"
		  		  	size   = "mini"
		  		  	type   = "primary"
		  		  	icon   = "el-icon-arrow-left">Anterior
		  		  </el-button>
		  		  <el-button 
		  		  @click = "next()"
		  		  size   = "mini"
		  		  type   = "primary">Siguiente
		  		  	<i class="el-icon-arrow-right el-icon-right"></i>
		  		  </el-button>
		  		</el-button-group>
		  	</div>

		  	<el-container>
		  	  <el-aside class="l_aside_table" width="35%">
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
		  	    						:disabled = "!formAuth('roles','crea')">
		  	    						</el-input>
		  	    				</el-form-item>

		  	    				<el-form-item 
		  	    					prop="display_name" 
		  	    					style="width:50%;">
		  	    					<div class="el_label">Nombre
		  	    					</div>
		  	    					<el-input 
		  	    						v-model   = "roles_form_.display_name"
		  	    						:disabled = "!formAuth('roles','crea')">
		  	    					</el-input>
		  	    				</el-form-item>

		  	    				<el-form-item prop="description" style="width:100%;">
		  	    					<div class="el_label">Descripcion</div>
		  	    					<el-input 
		  	    						v-model   = "roles_form_.description"
		  	    						:disabled = "!formAuth('roles','crea')">
		  	    						</el-input>
		  	    				</el-form-item>
		  	    			</div>

		  	    			<el-form-item v-if="formAuth('roles','crea') || formAuth('roles','borra')">
		  	    				<el-button v-if="formAuth('roles','crea')"
		  	    					type   = "primary"
		  	    					@click = "submitForm('roles_form')">Enviar
		  	    				</el-button>
		  	    				<el-button
		  	    					v-if="formAuth('roles','crea')" 
		  	    					@click="resetForm('roles_form')">Reset
		  	    				</el-button>
		  	    				<el-button 
		  	    					v-if="formAuth('roles','borra')"
		  	    					@click="console.log('Ejecuto boton de eliminar')">Eliminar
		  	    				</el-button>
		  	    			</el-form-item>

		  	    		</el-form>
		  	    	</div>

		  	    	<div class="path_table">
		  	    		<div class="boxCheckbox">
		  	    			<div class="itemcheckbox" v-for="path in path_routes">
		  	    				<div style="margin: 6px 0;"></div>
		  	    				<el-checkbox 
		  	    					:indeterminate = "path.flagInd"
		  	    					v-model        = "path.flag"
		  	    					@change        = "handleCheckAllChange(path)"
		  	    					size           = "small"
		  	    					:disabled      = "!editable">{{ path.name }}
		  	    				</el-checkbox>
		  	    				<el-checkbox-group 
		  	    					v-model   = "path.cont"
		  	    					@change   = "handleCheckItem(path)"
		  	    					size      = "small"
		  	    					:disabled = "!formAuth('paths','crea')">
		  	    				  <el-checkbox-button 
		  	    				  	v-for  = "subpath in path.sub_path"
		  	    				  	:label = "subpath.idOriginal"
		  	    				  	:key   = "subpath.idOriginal"
		  	    				  	border>{{subpath.name}}
		  	    				  </el-checkbox-button>
		  	    				</el-checkbox-group>
		  	    			</div>
		  	    		</div>
		  	    	</div>
		  	    </el-main>
		  	  </el-container>
		  	</el-container>
		  </b-card-body>
		</b-card>
			
	</div>
</template>
<script>
	import nav from '../CoreUi/src/_nav';
	export default {
	  /*
	  *
	  * Variables del componente
	  */
	  data () {

	  	return {
	  		editable    : false,
	  		actionSetup : {
					switchroles: { 
						desc     : 'Acciones de edicion de acceso a pestañas',
						name     : 'roles',
						actionid : 'dataload003i1',
						lee      : false,
						escribe  : false,
						borra    : false,
						crea     : false,
					},
					switchpaths : { 
						desc     : 'Acciones de edicion de acceso a pestañas',
						name     : 'paths',
						actionid : 'dataload003i2',
						lee      : false,
						escribe  : false,
						borra    : false,
						crea     : false,
					},
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
	  methods: {
			formAuth(quien,action){
				switch(quien){
					case 'roles':
						switch(action){
							case 'lee'     :
								return this.actionSetup.switchroles.lee
							break
							case 'escribe' :
								return this.actionSetup.switchroles.escribe
							break
							case 'borra'   :
								return this.actionSetup.switchroles.borra
							break
							case 'crea'    :
								return this.actionSetup.switchroles.crea
							break
						}
					break
					case 'paths':
						switch(action){
							case 'lee'     :
								return this.actionSetup.switchpaths.lee
							break
							case 'escribe' :
								return this.actionSetup.switchpaths.escribe
							break
							case 'borra'   :
								return this.actionSetup.switchpaths.borra
							break
							case 'crea'    :
								return this.actionSetup.switchpaths.crea
							break
						}
					break
				}
			},
			handleCheckAllChange(val) {
			  val.flagInd=false;
			  if (val.cont.length===0) {
					val.sub_path.forEach((value,index,arr)=>{
						val.cont.push(value.idOriginal)
					})
			  } else {
			  	val.cont=[]
			  }
			},
			handleCheckItem(value) {
			  let checkedCount = value.cont.length;
			  value.flag       = checkedCount === value.sub_path.length;
			  value.flagInd    = checkedCount > 0 && checkedCount < value.sub_path.length;
			},
			id_filter(id_path){
				let idpath      = id_path
				let count       = 0
				let indexSlice  = 0
					idpath.split('').forEach((value,index)=>{
						count++
						if (parseInt(value) || value ==='0') {
							if (indexSlice === 0) {
								indexSlice = count
							}
						}
					})
					indexSlice--
					return {
					idOriginal : id_path,
					id_text    : idpath.substring(0,indexSlice),
					id_int     : idpath.substring(indexSlice,(indexSlice+3)),
					id_item    : idpath.substring((indexSlice+3),(indexSlice+5))
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
				this.path_routes = []
				this.roles_form_ = val
				axios.post(route('roles.Authpath',val.id)) 
				    .then(response => {
				    	let lista_paths = response.data
				    	this._routes.forEach((x,index)=>{
				    		if (lista_paths.some(path => path.pathitem_id == x.idOriginal)) {
				    			// Si el item del menu se encuentra en el arreglo autorizado
				    			// se barren las sub rutas
				    			// para filtrar otros items
			    				this.path_routes.push(x)
			    				this.path_routes[(this.path_routes.length-1)].cont = []
				    			x.sub_path.forEach((xa,arr)=>{
				    				if (lista_paths.some(path => path.pathitem_id == xa.idOriginal)) {
				    					this.path_routes[(this.path_routes.length-1)].cont.push(xa.idOriginal)
				    				} 
				    			})
				    		} else {
				    			this.path_routes.push(x)
				    			this.path_routes[(this.path_routes.length-1)].cont = []
				    		}
				    		let tamanoCont           = this.path_routes[(this.path_routes.length-1)].cont.length
				    		let tamanoSubpaths       = this.path_routes[(this.path_routes.length-1)].sub_path.length
				    		this.path_routes[(this.path_routes.length-1)].flag    = tamanoCont === tamanoSubpaths
				    		this.path_routes[(this.path_routes.length-1)].flagInd = tamanoCont > 0 && tamanoCont < tamanoSubpaths
				    	})
			 	    })
				    .catch(error => {
				    	console.log(error)
				  //     this.$notify.error({
						// title: 'Error '+error.response.status,
						// message: error.response.data.message
				  //     });
				    })
			},
	  },
	  beforeMount(){
	  	var ruth = []
  		nav.items.forEach((val,index)=>{
				if (val.__proto__.constructor.name == 'menuItem') {
					var brute_id      = this.id_filter(val.id_path)
					brute_id.flag     = false
					brute_id.flagInd     = false
					brute_id.name     = val.name
					brute_id.cont     = []
					brute_id.sub_path = []

					val.children.forEach((value,index)=>{
						let x  = this.id_filter(value.id_path)
						x.flag = false
						x.name = value.name
						brute_id.sub_path.push(x)
					})
					this.path_routes.push(brute_id)
				}
				this._routes = this.path_routes
  		})

			axios.get(route('roles.index')) 
			.then(response => {
		  	this.lista_roles=response.data
		  }).catch(error => {
			  this.$notify.error({
					title: 'Error '+error.response.status,
					message: error.response.data.message
			  });
			})

    	axios.get(route('usuarios.actionsauth',this.$store.getters.currentUser.id)) 
      .then(response => {

      	if (response.data.roles.length > 0) {
      		response.data.roles.forEach((x,index)=>{
      			if (x.auth_actions.length > 0) {
      				x.auth_actions.forEach((action,index)=>{


      					if (this.actionSetup.switchroles.actionid == action.action_id) {
      						this.actionSetup.switchroles.desc    = action.action_desc
      						this.actionSetup.switchroles.name    = action.action_name
      						let permissions                      = action.action_permissions.split("")
      						this.actionSetup.switchroles.lee     = permissions.some(p => p == 'l')
      						this.actionSetup.switchroles.escribe = permissions.some(p => p == 'e')
      						this.actionSetup.switchroles.borra   = permissions.some(p => p == 'b')
      						this.actionSetup.switchroles.crea    = permissions.some(p => p == 'c')
      					}
      					if (this.actionSetup.switchpaths.actionid == action.action_id) {
      						this.actionSetup.switchpaths.desc    = action.action_desc
      						this.actionSetup.switchpaths.name    = action.action_name
      						let permissions                      = action.action_permissions.split("")
      						this.actionSetup.switchpaths.lee     = permissions.some(p => p == 'l')
      						this.actionSetup.switchpaths.escribe = permissions.some(p => p == 'e')
      						this.actionSetup.switchpaths.borra   = permissions.some(p => p == 'b')
      						this.actionSetup.switchpaths.crea    = permissions.some(p => p == 'c')
      					}

      				})
      			}
      		})
      	}
      }).catch( error => {
      	console.log(error)
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
.path_table{
	// background-color: rgba(0, 0, 255, .5);
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
	font-size: 1.2vw !important;
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
