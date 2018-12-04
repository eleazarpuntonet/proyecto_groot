<template>
	<div>
		<b-card no-body>
			<b-card-header>
				<strong>Reservas</strong>
			</b-card-header>
			<b-card-body>
				<b-row>
					<b-col lg="12" md="12">
					  <el-table
					  	id='tableReservas'
					  	max-height="700"
					    :data="dataReservas"
					    style="width: 100%">
						    <el-table-column
						    	fixed 
						    	type="expand">
						      <template slot-scope="props">
						      	<el-card 
						      		shadow="always"
						      		class="box-card"
						      		>
						      	  <div slot="header" class="clearfix">
						      	    <strong>Detalles de Reserva</strong>
						      	    <el-button style="float: right; padding: 3px 0" type="text">Agregar detalles</el-button>
						      	  </div>

							        <p><strong>Origen:</strong> {{ props.row.origen_a }}, {{ props.row.origen_b }}</p>
							        <p><strong>Dirección:</strong> {{ props.row.origen_det }}</p>
							        <p><strong>Fecha de Partida:</strong> {{ props.row.fecha_partida }}</p>

									<br>
							        <p><strong>Destino:</strong> {{ props.row.destino_a }}, {{ props.row.destino_b }}</p>
							        <p><strong>Dirección:</strong> {{ props.row.destino_det }}</p>
							        <p><strong>Fecha de Retorno:</strong> {{ props.row.fecha_retorno }}</p>
											
									<br>
									<p><strong>Agenda:</strong> {{ props.row.agenda }}</p>
									<p><strong>Motivo:</strong> {{ props.row.motivo }}</p>

									<br>
									<el-steps :space="200" :active="1" finish-status="success">
									  <el-step title="Reserva aprobada"></el-step>
									  <el-step title="Planificando"></el-step>
									  <el-step title="En ejecucion"></el-step>
									</el-steps>
						      	</el-card>
						      </template>
						    </el-table-column>
						    <el-table-column
						      label="Alcance"
						      prop="alcance">
						    </el-table-column>
						    <el-table-column
						      label="Origen"
						      prop="origen_a">
						    </el-table-column>
						    <el-table-column
						      label="Destino"
						      prop="destino_a">
						    </el-table-column>
						    <el-table-column
						      label="Fecha de partida"
						      prop="fecha_partida">
						    </el-table-column>
						    <el-table-column
						      label="Fecha de retorno"
						      prop="fecha_retorno">
						    </el-table-column>

						    <el-table-column
						    	fixed="right"
						      label="Operaciones">

						      	<template slot-scope="scope">

							      <el-button 
							      	size="mini"
							      	@click="handleShow(scope.$index, scope.row)"
							      	icon="el-icon-search" 
							      	circle
							      	>
							      </el-button>
							      <el-button 
							      	size="mini"
							      	@click="handleEdit(scope.$index, scope.row)"
							      	type="success" 
							      	icon="el-icon-check" 
							      	circle
							      	>
							      </el-button>
							      <el-button 
							      	size="mini"
							      	@click="handleDelete(scope.$index, scope.row)"
							      	type="danger" 
							      	icon="el-icon-delete" 
							      	circle>
							      </el-button>
						      	</template>

						    </el-table-column>

<!-- 						    <template slot="append">
						      <div 
						      	  v-infinite-scroll="onInfinite" 
						          infinite-scroll 
						          distance="5"  
						          ref="tableReservas">
						      </div>
						    </template> -->
					  </el-table>
					</b-col>
				</b-row>
				<b-row>
					<b-col lg="12" md="12">
						<el-button
							@click.prevent='addRow' 
							type="primary" 
							plain	
							>Agregar lineas</el-button>
					</b-col>
				</b-row>
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
    	bottom: false,
    	dataReservas: null,
    	pagination : {
    		nextPage    : null,
    		prevPage    : null,
    		currentPage : null,
    		lastPage    : null,
    	}

    }
  },
  computed: {
  },
  watch: {
    bottom(bottom) {
      if (bottom) {
        this.onInfinite()
      }
    }
  },
  methods: {
  	bottomVisible() {
  	  // const scrollY = window.scrollY
  	  // const visible = document.documentElement.clientHeight
  	  // const pageHeight = document.documentElement.scrollHeight
  	  // const bottomOfPage = visible + scrollY >= pageHeight
  	  // return bottomOfPage || pageHeight < visible

  	  const tabla   = document.getElementsByClassName('el-table__body-wrapper')[0]
  	  var offset    = tabla.offsetHeight
  	  var scrolltop = tabla.scrollTop
  	  var scroll    = tabla.scrollHeight

  	  console.log('offset'+offset)
  	  console.log('scrolltop'+scrolltop)
  	  console.log('scroll'+scroll)

  	  if (offset + scrolltop === scroll) {
  	  	return true
  	  }
  	  return false
  	},
  	onInfinite() {
  	  setTimeout(() => {
  	    axios.get(route('reservas.index'),{page : this.pagination.currentPage++}) 
  	        .then(response => {
  	        	this.pagination.nextPagePath = response.data.reservas.next_page_url
  	        	this.pagination.prevPagePath = response.data.reservas.prev_page_url
  	        	this.pagination.currentPage  = response.data.reservas.current_page
  	        	if (!!this.dataReservas) {
  	        		this.dataReservas            = this.dataReservas.concat(response.data.reservas.data);
  	        	} else {
  	        		this.dataReservas = response.data.reservas.data
  	        	}
  	          })
  	        .catch(error => {
  	          console.log(error)
  	        })
  	   
  	  }, 1000);
  	},
  	handleEdit(index, row) {
      console.log(index, row);
    },
    handleDelete(index, row) {
      console.log(index, row);
    },
	handleShow(index, row) {
		this.$router.push({ path: `/reservas/${index}` })
	    console.log(index, row);
  	},

  },
  beforeMount(){
  },
  created() {
  },
  mounted(){
    document.getElementsByClassName('el-table__body-wrapper')[0].addEventListener('scroll', () => {
      this.bottom = this.bottomVisible()
    })
  	axios.get(route('reservas.index')) 
  	    .then(response => {
  	    	this.pagination.nextPagePath = response.data.reservas.next_page_url
  	    	this.pagination.prevPagePath = response.data.reservas.prev_page_url
  	    	this.pagination.currentPage  = response.data.reservas.current_page
  	    	this.pagination.lastPage     = response.data.reservas.to
  	    	this.dataReservas            = response.data.reservas.data
  	        console.log(response.data.reservas)
  	      })
  	    .catch(error => {
  	      console.log(error)
  	    })
  }
}
</script>
<style>


</style>
