<template>
	<div>
		<el-card v-if="reserva" class="box-card">

			<div slot="header" class="clearfix">
				<strong>Reserva {{ reserva.id }}</strong>
				<el-dropdown style="float: right; padding: 3px 0">
					<span class="el-dropdown-link">
						<el-button type="primary" size="small">
							Agregar detalles<i class="el-icon-arrow-down el-icon--right"></i>
						</el-button>
					</span>
					<el-dropdown-menu slot="dropdown">
						<el-dropdown-item>Autorizacion</el-dropdown-item>
						<el-dropdown-item>Traslado</el-dropdown-item>
						<el-dropdown-item>Editar reserva</el-dropdown-item>
					</el-dropdown-menu>
				</el-dropdown>
			</div>

			<!-- 
			*	Caja de Nombre de Usuario
			-->
			<b-row class="box_data_reserv">
				<b-col class="box_notif notif_section" md="12" lg="12" xl="12">
					<div class="itemsh_box">
						<p style="margin-bottom: 0px;"><strong>Generar autorizacion de </strong><i>viaticos</i></p>
					</div>
					<div class="itemsh_box">
						<el-button-group>
							<el-button type="primary" icon="el-icon-success" size="small">Aprobar Viaticos</el-button>
							<el-button type="primary" icon="el-icon-error" size="small">Rechazar Viaticos</el-button>
						</el-button-group>
					</div>
				</b-col>
				<b-col class="box_notif notif_section" md="12" lg="12" xl="12">
					<div class="itemsh_box">
						<p style="margin-bottom: 0px; font-family: 'Eurostile LTS';"><strong>Generar autorizacion de </strong><i>reserva</i></p>
					</div>
					<div class="itemsh_box">
						<el-button-group>
							<el-button type="primary" icon="el-icon-success" size="small">Aprobar Reserva</el-button>
							<el-button type="primary" icon="el-icon-error" size="small">Rechazar Reserva</el-button>
						</el-button-group>
					</div>
				</b-col>
				<b-col class="box_auth notif_section" md="12" lg="12" xl="12">
					<div class="itemsh_box">
						<p style="margin-bottom: 0px;">Reserva Aprobada</p>
					</div>
				</b-col>
				<b-col class="box_auth notif_section" md="12" lg="12" xl="12">
					<div class="itemsh_box">
						<p style="margin-bottom: 0px;">Viaticos Aprobados</p>
					</div>
				</b-col>
<!-- 				<b-col class="box_neg notif_section" md="12" lg="12" xl="12">
					<div class="itemsh_box">
						<p style="margin-bottom: 0px;">Reserva Rechazada</p>
					</div>
				</b-col>
				<b-col class="box_neg notif_section" md="12" lg="12" xl="12">
					<div class="itemsh_box">
						<p style="margin-bottom: 0px;">Viaticos Rechazada</p>
					</div>
				</b-col> -->
			</b-row>
			<b-row class="box_data_reserv">
				<b-col class="box box_name" md="12" lg="12" xl="12">
					<p style="margin-bottom: 0px;"><strong>{{ reserva.user.name }} {{ reserva.user.last_name }}</strong> <i>{{ reserva.user.departamento.disp_name }}</i></p>
				</b-col>
			</b-row>
			<b-row class="box box_data_reserv">
				<el-button type="primary" icon="el-icon-download" size="mini">Descargar en PDF</el-button>
			</b-row>
			<b-row class="box_data_reserv">
				<b-col md="8" lg="8" xl="8">
					<b-row>
						<b-col class="box box_h" md="12" lg="12" xl="12">
							<b-row>
								<b-col class="items_box" md="2" lg="2" xl="2">
									<div class="icon_box main_icon">
										<i class="fas fa-plane-departure"></i>
									</div>
									<div class="date_text">
										{{ reserv.getDate('origen') }}
									</div>
									<div class="date_text">
										{{ reserv.getHour('origen') }}
									</div>
								</b-col>
								<b-col class="items_box" md="1" lg="1" xl="1" >
									<div id="separador1" style="margin: auto;"></div>
								</b-col>
								<b-col md="9" lg="9" xl="9">
									<div class="itemsh_box"> 
										<div class="country">
											<strong>{{ reserv.getAddress('origen','a')}}</strong>
										</div>
										<div class="state">
											<p style="margin-bottom: 0px; margin-top: 12px;">{{ reserv.getAddress('origen','b')}}</p>
										</div>
									</div>
									<div class="itemsh_box"> 
										<div style="margin-right:4px;">
											<i style="font-size: 1.5em;" class="fas fa-map-marker-alt"></i>
										</div>
										<div class="">
											<p>{{ reserv.getAddress('origen','c')}}</p>
										</div>
									</div>
								</b-col>
								<template v-if="!reserv.trslatFlag()">
									<b-col md="12" lg="12" xl="12">
										<div id="separador2"></div>
										<div class="itemsh_box center itinerario"> 
											<div class="icon_box item_icon">
												<i class="fas fa-plane"></i>
											</div>
											<div class="item">
												<strong>Vuelo</strong>
											</div>
											<div class="item">
												<p>4:00 am -</p>
											</div>
											<div class="item">
												<p>Desplazamiento de la casa al aeropuerto</p>
											</div>
										</div>
										<div class="itemsh_box center itinerario"> 
											<div class="icon_box item_icon">
												<i class="fas fa-car"></i>
											</div>
											<div class="item">
												<strong>Taxi</strong>
											</div>
											<div class="item">
												<p>7:00 am -</p>
											</div>
											<div class="item">
												<p>Desplazamiento de la casa al aeropuerto</p>
											</div>
										</div>
										<div class="itemsh_box center itinerario"> 
											<div class="icon_box item_icon">
												<i class="fas fa-car"></i>
											</div>
											<div class="item">
												<strong>Taxi</strong>
											</div>
											<div class="item">
												<p>7:00 am -</p>
											</div>
											<div class="item">
												<p>Desplazamiento de la casa al aeropuerto</p>
											</div>
										</div>
									</b-col>
								</template>
								<template v-else>
									<b-col md="12" lg="12" xl="12">
										<div id="separador2"></div>
										<div class="itemsh_box center itinerario"> 
											<div class="item">
												<p>Esta reserva no posee traslados asignados en esta localidad</p>
											</div>
										</div>
									</b-col>
								</template>
							</b-row>
						</b-col>
						<b-col class="box box_h" md="12" lg="12" xl="12">
							<b-row>
								<b-col class="items_box" md="2" lg="2" xl="2">
									<div class="icon_box main_icon">
										<i class="fas fa-plane-arrival"></i>
									</div>
									<div class="date_text">
										{{ reserv.getDate() }}
									</div>
									<div class="date_text">
										{{ reserv.getHour() }}
									</div>
								</b-col>
								<b-col class="items_box" md="1" lg="1" xl="1" >
									<div id="separador1" style="margin: auto;"></div>
								</b-col>
								<b-col md="9" lg="9" xl="9">
									<div class="itemsh_box"> 
										<div class="country">
											<strong>{{ reserv.getAddress('','a')}}</strong>
										</div>
										<div class="state">
											<p style="margin-bottom: 0px; margin-top: 12px;">{{ reserv.getAddress('','b')}}</p>
										</div>
									</div>
									<div class="itemsh_box"> 
										<div style="margin-right:4px;">
											<i style="font-size: 1.5em;" class="fas fa-map-marker-alt"></i>
										</div>
										<div>
											<p>{{ reserv.getAddress('','c')}}</p>
										</div>
									</div>
								</b-col>
								<template v-if="!reserv.trslatFlag()">
									<b-col md="12" lg="12" xl="12">
										<div id="separador2"></div>
										<div class="itemsh_box center itinerario"> 
											<div class="icon_box item_icon">
												<i class="fas fa-taxi"></i>
											</div>
											<div class="item">
												<strong>Taxi</strong>
											</div>
											<div class="item">
												<p>7:00 am -</p>
											</div>
											<div class="item">
												<p>Desplazamiento de la casa al aeropuerto</p>
											</div>
										</div>
										<div class="itemsh_box center itinerario"> 
											<div class="icon_box item_icon">
												<i class="fas fa-car"></i>
											</div>
											<div class="item">
												<strong>Vehiculo de flota</strong>
											</div>
											<div class="item">
												<p>7:00 am -</p>
											</div>
											<div class="item">
												<p>Desplazamiento de la casa al aeropuerto</p>
											</div>
										</div>
										<div class="itemsh_box center itinerario"> 
											<div class="icon_box item_icon">
												<i class="fas fa-bus-alt"></i>
											</div>
											<div class="item">
												<strong>Bus</strong>
											</div>
											<div class="item">
												<p>7:00 am -</p>
											</div>
											<div class="item">
												<p>Desplazamiento de la casa al aeropuerto</p>
											</div>
										</div>
									</b-col>
								</template>
								<template v-else>
									<b-col md="12" lg="12" xl="12">
										<div id="separador2"></div>
										<div class="itemsh_box center itinerario"> 
											<div class="item">
												<p>Esta reserva no posee traslados asignados en esta localidad</p>
											</div>
										</div>
									</b-col>
								</template>
							</b-row>
						</b-col>
						<b-col class="box box_h" md="12" lg="12" xl="12">
							<b-row>
								<b-col md="12" lg="12" xl="12" style="display: flex; font-size: 1.3em; margin: 8px;">
									<div class="icon_box item_icon">
										<i class="far fa-money-bill-alt"></i>
									</div>
									<div class="item">
										<strong>Viaticos</strong>
									</div>
								</b-col>
								<b-col md="12" lg="12" xl="12">
									<el-table
										size="mini"
										:data="viatics"
										border
										show-summary
										style="width: 100%; margin-bottom: 20px;">
										<el-table-column
											prop="rubro"
											sortable
											label="Rubro">
										</el-table-column>
										<el-table-column
											prop="cantidad"
											sortable
											label="cant">
										</el-table-column>
										<el-table-column
											prop="val_unit"
											sortable
											label="Monto">
										</el-table-column>
									</el-table>
								</b-col>
							</b-row>
						</b-col>
					</b-row>
				</b-col>
				<b-col class="box box_v" md="4" lg="4" xl="4">
					<b-row>
						<b-col md="12" lg="12" xl="12">
							<div class="boxtitle">
								<i class="fas fa-key"></i>
								<strong>Aprobaciones:</strong>
							</div>
							<b-row class="autori">
								<b-col class="img_ger" md="4" lg="4" xl="4">
									<img
									  src="/img/avatars/6.jpg"
									  class="img-avatar"
									  alt="admin@bootstrapmaster.com" />
								</b-col>
								<b-col class="text_aut" md="8" lg="8" xl="8">
									<div class="title_ger">
										<strong style="font-size=1em;">Edgar Saltron</strong>
									</div>
									<div>
										<p style="margin-bottom: 0px;">Gerente de Information Technology</p>
									</div>
									<div>
										<p style="margin-bottom: 0px;">17/09/1992</p>
									</div>
									<div>
										<el-button 
											type="success" 
											round
											size="mini"
											style="
										    font-size: 1em;
										    height: 60%;
										    /* line-height: 1em; */
										    /* margin: auto; */
										    display: flex;
										    flex-direction: column;
										    justify-content: center;
										">Viaticos</el-button>
									</div>
								</b-col>
							</b-row>
							<b-row class="autori">
								<b-col class="img_ger" md="4" lg="4" xl="4">
									<img
									  src="/img/avatars/6.jpg"
									  class="img-avatar"
									  alt="admin@bootstrapmaster.com" />
								</b-col>
								<b-col class="text_aut" md="8" lg="8" xl="8">
									<div class="title_ger">
										<strong style="font-size=1em;">Jackelyne Farias</strong>
									</div>
									<div>
										<p style="margin-bottom: 0px;">Gerente de Talento Humano</p>
									</div>
									<div>
										<p style="margin-bottom: 0px;">17/09/1992</p>
									</div>
									<div>
										<el-button 
											type="success" 
											round
											size="mini"
											style="
										    font-size: 1em;
										    height: 60%;
										    /* line-height: 1em; */
										    /* margin: auto; */
										    display: flex;
										    flex-direction: column;
										    justify-content: center;
										">Reserva</el-button>
									</div>
								</b-col>
							</b-row>
							<b-row class="autori">
								<b-col class="img_ger" md="4" lg="4" xl="4">
									<img
									  src="/img/avatars/6.jpg"
									  class="img-avatar"
									  alt="admin@bootstrapmaster.com" />
								</b-col>
								<b-col class="text_aut" md="8" lg="8" xl="8">
									<div class="title_ger">
										<strong style="font-size=1em;">Esmeralda Da Silva</strong>
									</div>
									<div>
										<p style="margin-bottom: 0px;">Directora</p>
									</div>
									<div>
										<p style="margin-bottom: 0px;">17/09/1992</p>
									</div>
									<div>
										<el-button 
											type="success" 
											round
											size="mini"
											style="
										    font-size: 1em;
										    height: 60%;
										    /* line-height: 1em; */
										    /* margin: auto; */
										    display: flex;
										    flex-direction: column;
										    justify-content: center;
										">Reserva</el-button>
									</div>
								</b-col>
							</b-row>
						</b-col>
						<b-col md="12" lg="12" xl="12">
							<div id="separador2"></div>
							<div class="boxtitle">
								<i class="fas fa-comment"></i>
								<strong>Motivo:</strong>
							</div>
							<div class="boxdesc">
								<p>
									{{ reserv.getMeta('motivo') }}
								</p>
							</div>
						</b-col>
						<b-col md="12" lg="12" xl="12">
							<div id="separador2"></div>
							<div class="boxtitle">
								<i class="fas fa-comment"></i>
								<strong>Agenda:</strong>
							</div>
							<div class="boxdesc">
								<p>
									{{ reserv.getMeta('agenda') }}
								</p>
							</div>
						</b-col>
					</b-row>
				</b-col>	
			</b-row>
		</el-card>
</div>
</template>

<script>
class Reserva{
  constructor(res){
  	this.alcance
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
	  		reserv : null,
	  		reserva: null,
	  		viatics: [
	  		{
	  			rubro: 'Desayuno',
	  			cantidad: 6,
	  			val_unit: 500
	  		},
	  		{
	  			rubro: 'Almuerzo',
	  			cantidad: 6,
	  			val_unit: 800
	  		},
	  		{
	  			rubro: 'Cena',
	  			cantidad: 6,
	  			val_unit: 1200
	  		},
	  		{
	  			rubro: 'Estacionamiento',
	  			cantidad: 6,
	  			val_unit: 300
	  		},
	  		{
	  			rubro: 'Gastos varios',
	  			cantidad: 6,
	  			val_unit: 250
	  		},
	  		],
	  		activeNames: ['1'],
	  	}
	  },
	  computed: {

	  },
	  methods: {
			handleChange(val) {
			  console.log(val);
			}
	  },
	  beforeMount(){
	  },
	  created(){



	  	axios.get(route('reservas.show',this.$router.app._route.params.id_reserva)) 
	  	    .then(response => {
	  	    	this.reserva = response.data.reserva
	  	    	this.reserv = new Reserva(response.data.reserva)
	  	    	// this.viatics = this.reserva.viaticos
	  	        console.log(this.reserva)
	  	      })
	  	    .catch(error => {
	  	      console.log(error)
	  	    })
	  },
	  mounted(){
	  },
	  destroyed () {
	  },
	}
</script>
<style lang="scss">
// @import url('https://fonts.googleapis.com/css?family=Open+Sans|Oswald|Playfair+Display|Poppins|Raleway|Roboto');
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
	// .box_h{
	// 	height: 100%;
	// }
	.box_name{
		p{
			font-family: 'Raleway', sans-serif;
			font-size: 1.4em;
		}
		strong{
			text-transform: capitalize;
			font-size: 2.2em;
			line-height:2.2em;
		}
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
	background-color: rgba(235, 235, 235, 1);
	border: 1px solid white;
	font-family: 'Poppins', sans-serif;
}
</style>
