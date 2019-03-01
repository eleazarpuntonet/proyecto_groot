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
					  	max-height="550"
					    :data="dataReservas"
					    style="width: 100%">
						    <el-table-column
						      label="Avatar"
						      prop="user">
                  <template slot-scope="scope">
                    <div class="icon_container flexcenter">
                      <img
                        :src="'/storage'+scope.row.user.avatar"
                        class="img-avatar"
                        alt="admin@bootstrapmaster.com" />
                    </div>
                  </template>
						    </el-table-column>
                <el-table-column
                  label="Nombre"
                  prop="user">
                  <template slot-scope="scope">
                    {{scope.row.user.name}} {{scope.row.user.last_name}}
                  </template>
                </el-table-column>
<!--                 <el-table-column
                  label="Nombre"
                  prop="user">
                  <template slot-scope="scope">
                    {{scope.row.user.departamento.disp_name}}
                  </template>
                </el-table-column> -->
                <el-table-column
                  label="Sede"
                  prop="user.sede">
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
						    sortable
						      label="Emision"
						      prop="created_at">
						    </el-table-column>

						    <el-table-column
						    	fixed="right"
						      label="Operaciones">

						      	<template slot-scope="scope">

							      <el-button 
							      	size="mini"
							      	@click="handleShow(scope.$index, scope.row)"
							      	icon="el-icon-view" 
							      	circle
							      	>
							      </el-button>
<!-- 							      <el-button 
							      	size="mini"
							      	@click="handleEdit(scope.$index, scope.row)"
							      	type="success" 
							      	icon="el-icon-check" 
							      	circle
							      	>
							      </el-button> -->
							      <el-button 
							      	size="mini"
							      	@click="handleDelete(scope.$index, scope.row)"
							      	type="danger" 
							      	icon="el-icon-delete" 
							      	circle>
							      </el-button>
						      	</template>

						    </el-table-column>

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
  	  const tabla   = document.getElementsByClassName('el-table__body-wrapper')[0]
  	  var offset    = tabla.offsetHeight
  	  var scrolltop = tabla.scrollTop
  	  var scroll    = tabla.scrollHeight

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
		index++
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
  	      // this.$notify.error({
  	      //   title: 'Error '+error.response.status,
  	      //   message: error.response.data.message
  	      // });
  	    })
  }
}
</script>
<style lang="scss">
.icon_container{
  width: 6.5vh;
  height: 6.5vh;
}

</style>
