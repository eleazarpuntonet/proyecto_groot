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

			  <el-tabs tab-position="left" style="height: 100%;">

			    <el-tab-pane label="Reserva">
			    	<div class="mainReservas">

			    		<div class="mainLine">
			    				<div class="resValue"><strong>{{ reserva.user.name }} {{ reserva.user.last_name }}</strong></div>
			    		</div>

							<div class="mainLine">
								<div class="itemReservas">
									<div class="resValue contRight"><strong>{{ reserva.origen_a}}</strong></div>
									<div class="resLabel contRight">Pais origen</div>
								</div>
								<div class="itemReservas">
									<div class="resValue contLeft"><strong>{{ reserva.destino_a}}</strong></div>
									<div class="resLabel contLeft">Pais destino</div>
								</div>
							</div>

							<div class="mainLine">
				    		<div class="itemReservas">
				    			<div class=" resValue contRight"><strong>{{ reserva.origen_b}}</strong></div>
				    			<div class=" resLabel contRight">Estado origen</div>
				    		</div>
				    		<div class="itemReservas">
				    			<div class=" resValue contLeft"><strong>{{ reserva.destino_b}}</strong></div>
				    			<div class=" resLabel contLeft">Estado destino</div>
				    		</div>
							</div>

			    		<div class="mainLine">
				    		<div class="itemReservas">
				    			<div class=" resValue contRight"><strong>{{ reserva.origen_det}}</strong></div>
				    			<div class=" resLabel contRight">Direccion origen</div>
				    		</div>
				    		<div class="itemReservas">
				    			<div class=" resValue contLeft"><strong>{{ reserva.destino_det}}</strong></div>
				    			<div class=" resLabel contLeft">Direccion destino</div>
				    		</div>
			    		</div>

			    		<div class="mainLine">
				    		<div class="itemReservas">
				    			<div class=" resValue contRight"><strong>{{ reserva.fecha_partida}}</strong></div>
				    			<div class=" resLabel contRight">Fecha de partida</div>
				    		</div>
				    		<div class="itemReservas">
				    			<div class=" resValue contLeft"><strong>{{ reserva.fecha_retorno}}</strong></div>
				    			<div class=" resLabel contLeft">Fecha de retorno</div>
				    		</div>
			    		</div>

			    		<div class="mainLine">
				    		<div class="itemSingle">
				    			<div class=" resValue contLeft" style="font-size: 15px !important"><p>{{ reserva.motivo}}</p></div>
				    			<div class=" resLabel contLeft" style="font-size: 15px !important">Motivo</div>
				    		</div>
			    		</div>

			    		<div class="mainLine">
				    		<div class="itemSingle">
				    			<div class=" resValue contLeft" style="font-size: 15px !important"><p>{{ reserva.agenda}}</p></div>
				    			<div class=" resLabel contLeft" style="font-size: 15px !important">Agenda</div>
				    		</div>
			    		</div>

			    		<div lg="12" md="12">
					  		<el-steps :active="2" align-center>
									<el-step title="Autorizacion" description="Autorizado"></el-step>
									<el-step title="Planificacion" description="Planificado"></el-step>
									<el-step title="Ejecucion" description="Ejecutado"></el-step>
									<el-step title="Seguimiento" description="En seguimiento"></el-step>
					  		</el-steps>
			    		</div>
			    	</div>	
			    </el-tab-pane>

			    <el-tab-pane label="Traslados">
						<b-row>
							<!-- Seccion de detalle de TRASLADOS -->
							<b-col class="" lg="12" md="12">
								<el-collapse v-model="activeNames" @change="handleChange">
									<ul>
										<li v-for="traslado in reserva.traslados" style="list-style:none;">
											<el-collapse-item :title="traslado.servicio" :name="traslado.id">
												<b-row>
													<b-col class="text-right trasItem trasItemRight" lg="6" md="6">
														<h3>Origen</h3>
													</b-col>
													<b-col class="trasItem trasItemLeft" lg="6" md="6">
														<h3>Destino</h3>
													</b-col>

													<b-col class="trasItem text-right trasItemRight" lg="6" md="6">
														<span>{{traslado.origen}}</span>
													</b-col>
													<b-col class="trasItem trasItemLeft" lg="6" md="6">
														<span>{{traslado.destino}}</span>
													</b-col>

													<b-col class="trasItem text-center" lg="12" md="12">
														<p><strong>Servicio:</strong><span>{{traslado.servicio}}</span></p>
													</b-col>

													<b-col class="trasItem text-center" lg="12" md="12">
														<p><strong>Proveedor:</strong><span>{{traslado.proveedor}}</span></p>
													</b-col>

													<b-col class="trasItem text-center" lg="12" md="12">
														<p><strong>Tipo:</strong><span>{{traslado.tipo}}</span></p>
													</b-col>
												</b-row>
											</el-collapse-item>
										</li>
									</ul>
								</el-collapse>
							</b-col>	
						</b-row>
			    </el-tab-pane>

			    <el-tab-pane label="Autorizaciones">
						<b-row>
							<!-- Seccion de detalle de AUTORIZACIONES -->
							<b-col class=" justify-content-center" lg="12" md="12">
								<ul>
								  <li v-for="autorizacion in reserva.autorizaciones" style="list-style:none;">
										<div class="d-flex justify-content-center align-items-center flex-row authContainer">
											<div class="p-4 authItem authavatar">
												<img
												  src="/img/avatars/1.jpg"
												  class="img-avatar"
												  alt="admin@bootstrapmaster.com" />
											</div>
											<div class="p-4 authItem">
												<div class="valueCont">
													<strong>{{autorizacion.gerencia.disp_name}}</strong>
												</div>
												<div class="labelCont">
													<p>Gerencia</p>
												</div>
											</div>
											<div class="p-4 authItem">
												<div class="valueCont">
													<strong>{{autorizacion.coordinador_id}}</strong>
												</div>
												<div class="labelCont">
													<p>Autorizado</p>
												</div>
											</div>
											<div class="p-4 authItem">
												<div class="valueCont">
													<p>
														<strong>{{autorizacion.date_auth}}</strong>
													</p>
												</div>
												<div class="labelCont">
													<p>Fecha</p>
												</div>
											</div>
										</div>
								  </li>
								</ul>
							</b-col>
						</b-row>		
			    </el-tab-pane>

			  </el-tabs>

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
<style>
.{
}
.itemRight{
	text-align: right;
}
.itemLeft{
	text-align: left;
}
.trasItemRight{

}
.trasItemLeft{

}
.authContainer{
	margin: auto;
	width: 80%;
	/*border: 2px solid #409EFF;*/
	box-shadow: 2px 2px 10px#6ac8ff;
	margin-bottom: 10px;

}
.labelCont{
	font-size: 12px;
	padding-top: 8px;
	line-height: 10px;
	text-align: right;
	font-style: italic;
	color: grey;
}
.valueCont{
	text-align: right;
	font-style: bold;

}
.authItem{
	margin: 3px;
	padding: 3px !important;
	margin-right: 20px;
}
.authavatar{
}
div p{
	margin-bottom: auto;
}
.resLabel{
	text-shadow: 1px 1px 2px rgba(64, 158, 255, 0.8);
	font-size: 12px;
	line-height: 10px;
	text-align: right;
	font-style: italic;
	margin: 5px;
	color: grey;
}
.resValue{
	text-shadow: 1px 1px 2px rgba(128, 128, 128, 0.7);
	font-family: 'Helvetica Neue';
	font-style: bold;
	line-height: 25px;
	font-size: 20px;
}
.contLeft{
	text-align: left;
	padding-left: 10px;
}
.contRight{
	padding-right: 10px;
	text-align: right;
}
.el-steps{
	margin-top: 25px;
}
.mainReservas{
	margin: 25px;
	margin-top: 5px;
	display: inline-block;
}
.itemReservas{
	width: 50%;
}
.mainLine{
	padding: 5px;
	margin: 7px;
	/*border: 2px solid rgba(64, 158, 255, 0.5);*/
	box-shadow: 2px 2px 10px rgba(64, 158, 255, 0.5);
	display: flex;
}
.itemSingle{
	font-size: 15px;
	width: 100%;
}
</style>
