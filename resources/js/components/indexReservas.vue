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
						          @click="handleEdit(scope.$index, scope.row)">Editar</el-button>
						        <el-button
						          size="mini"
						          type="danger"
						          @click="handleDelete(scope.$index, scope.row)">Eliminar</el-button>
						      </template>
						    </el-table-column>
						  </el-table>
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
    	dataReservas: null,
    }
  },
  computed: {
  },
  methods: {
  	handleEdit(index, row) {
      console.log(index, row);
    },
    handleDelete(index, row) {
      console.log(index, row);
    }
  },
  beforeMount(){
  },
  created(){
  },
  mounted(){
  	axios.get(route('reservas.index')) 
  	    .then(response => {
  	        this.dataReservas=response.data.reservas
  	        console.log(this.dataReservas)
  	      })
  	    .catch(error => {
  	      console.log(error)
  	    })
  }
}
</script>
<style>


</style>
