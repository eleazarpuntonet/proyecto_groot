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

			<b-row class="box_data_reserv">
				<b-col class="box box_name" md="12" lg="12" xl="12">
					<p style="margin-bottom: 0px;"><strong>Eleazar Arquia Ortega Villarroel</strong> <i>Information Technology</i></p>
				</b-col>
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
										10/12/2018
									</div>
									<div class="date_text">
										10:00 Am
									</div>
								</b-col>
								<b-col class="items_box" md="1" lg="1" xl="1" >
									<div id="separador1" style="margin: auto;"></div>
								</b-col>
								<b-col md="9" lg="9" xl="9">
									<div class="itemsh_box"> 
										<div class="country">
											<strong>Venezuela</strong>
										</div>
										<div class="state">
											<p style="margin-bottom: 0px; margin-top: 12px;">Distrito Capital</p>
										</div>
									</div>
									<div class="itemsh_box"> 
										<div style="margin-right:4px;">
											<i style="font-size: 1.5em;" class="fas fa-map-marker-alt"></i>
										</div>
										<div class="item">
											<p>Av. Ernesto Blohm con Av. La Estancia. Edif. Centro Banaven. Torre D. PH. Chuao, Estado Miranda. Código Postal 1061</p>
										</div>
									</div>
								</b-col>
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
							</b-row>
						</b-col>
						<b-col class="box box_h" md="12" lg="12" xl="12">
							<b-row>
								<b-col class="items_box" md="2" lg="2" xl="2">
									<div class="icon_box main_icon">
										<i class="fas fa-plane-arrival"></i>
									</div>
									<div class="date_text">
										12/12/2018
									</div>
									<div class="date_text">
										12:00 pm
									</div>
								</b-col>
								<b-col class="items_box" md="1" lg="1" xl="1" >
									<div id="separador1" style="margin: auto;"></div>
								</b-col>
								<b-col md="9" lg="9" xl="9">
									<div class="itemsh_box"> 
										<div class="country">
											<strong>Colombia</strong>
										</div>
										<div class="state">
											<p style="margin-bottom: 0px; margin-top: 12px;">Valle del Cauca</p>
										</div>
									</div>
									<div class="itemsh_box"> 
										<div style="margin-right:4px;">
											<i style="font-size: 1.5em;" class="fas fa-map-marker-alt"></i>
										</div>
										<div>
											<p>Avenida 2A # 75H - 35 Cali, Colombia 760050</p>
										</div>
									</div>
								</b-col>
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
									Mucho texto
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
									Mucho texto
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
	export default {
	  /*
	  *
	  * Variables del componente
	  */
	  data () {
	  	return {
	  		reserva: null,
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
@import url('https://fonts.googleapis.com/css?family=Open+Sans|Oswald|Playfair+Display|Poppins|Raleway|Roboto');
.autori{
	margin: 5px;
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
	.box{
		background-color: rgba(235, 235, 235, 1);
		border: 1px solid white;
		font-family: 'Poppins', sans-serif;
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
			font-size: 1.2em;
		}
		strong{
			text-transform: uppercase;
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
			width: 60%;
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
</style>
