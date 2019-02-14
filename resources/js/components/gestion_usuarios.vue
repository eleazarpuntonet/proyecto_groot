<template>
	<div class="rowcentercontainer">
		<b-card no-body class="appblur">
		  <b-card-header >
		  	<div class="clearfix" style="">
		  		<strong>Usuario   reserva.id  </strong>

		  		<el-button-group style="float:right;">
		  		  <el-button 
		  		  @click="back(reserva.id)"
		  		  	size="mini" 
		  		  	type="primary" 
		  		  	icon="el-icon-arrow-left">Anterior</el-button>
		  		  <el-button 
	
		  		  @click.native="next(reserva.id)"
		  		  	size="mini" 
		  		  	type="primary">Siguiente<i class="el-icon-arrow-right el-icon-right"></i></el-button>
		  		</el-button-group>
		  	</div>
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

		  	<!-- 
		  	*	Caja de Nombre de Usuario
		  	-->
		  	<b-row class="box_data_reserv boxshadow">
					<div class="avatarcontainer">
<!-- 						<img
						  :src="'/storage'+reserva.user.avatar"
						  class="img-avatar"
						  alt="admin@bootstrapmaster.com" /> -->
					</div>
		  		  	<div class="box_name">
		  				<strong>  Eleazar Ortega</strong> <i>  Coordinacion de Tecnologia  </i> 	
		  		  	</div>
		  	</b-row>


		  </b-card-body>
		</b-card>
			
	</div>
</template>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
import jsPDF from 'jspdf'
class Reserva{
  constructor(res){
  	this.id            = res.id
  	this.id_user       = res.id_user
  	this.alcance       = res.alcance
  	this.origen_a      = res.origen_a
  	this.origen_b      = res.origen_b
  	this.origen_det    = res.origen_det
  	this.fecha_partida = res.fecha_partida
  	this.fecha_retorno = res.fecha_retorno
  	this.destino_a     = res.destino_a
  	this.destino_b     = res.destino_b
  	this.destino_det   = res.destino_det
  	this.motivo        = res.motivo
  	this.agenda        = res.agenda
  	this.created_at    = res.created_at
  	this.updated_at    = res.updated_at
  	this.traslados     = res.traslados

  	this.user_id        = res.user.id
  	this.user_name      = res.user.name
  	this.user_last_name = res.user.last_name
  	this.user_cargo     = res.user.cargo
  	this.user_sede      = res.user.sede
  	this.user_email     = res.user.email
  	this.user_avatar    = res.user.avatar
  	this.user_status    = res.user.status
  	this.user_gerencia  = res.user.departamento.disp_name
  }

  getFullname(){
  	return this.user_id+' '+this.user_last_name
  }

  getDate(which){
  	if (which=='origen') {
  		var a = new Date(this.fecha_partida)
  		return `${a.getDate()}/${a.getMonth()}/${a.getFullYear()}`
  	} else {
  		var a = new Date(this.fecha_retorno)
  		return `${a.getDate()}/${a.getMonth()}/${a.getFullYear()}`
  	}
  }

  getHour(which){
  	if (which=='origen') {
  		var a = new Date(this.fecha_partida)
  		return `${a.getHours()}:${a.getMinutes()}:${a.getSeconds()}`
  	} else {
  		var a = new Date(this.fecha_retorno)
  		return `${a.getHours()}:${a.getMinutes()}:${a.getSeconds()}`
  	}
  }

  getAddress(which,x){
  	if (which=='origen') {
  		switch(x){
  			case 'a':
  				return this.origen_a
  			break;
  			case 'b':
  				return this.origen_b
  			break;
  			case 'c':
  				return this.origen_det
  			break;
  		}
  	}

  	switch(x){
  		case 'a':
  			return this.destino_a
  		break;
  		case 'b':
  			return this.destino_b
  		break;
  		case 'c':
  			return this.destino_det
  		break;
  	}
  }

  getMeta(which){
  	if (which=='motivo') {
  		return this.motivo
  	}
  	if (which=='agenda') {
  		return this.agenda
  	}
  }

  trslatFlag(){
  	if (this.traslados.length==0) {
  		console.log(`no posee traslados`)
  		return false
  	} else {
  		console.log(`posee traslados`)
  		return true
  	}
  }

  getTraslados(){
  	if (this.trslatFlag()) {
  		return this.traslados
  	} else {
  		return null
  	}
  }
}
	export default {
	  /*
	  *
	  * Variables del componente
	  */
	  data () {
	  	return {

	  	}
	  },
	  computed: {

	  },
	  methods: {

	  },
	  beforeMount(){
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
	.box_name{
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
