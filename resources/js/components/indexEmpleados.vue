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
                :data="tableData4"
                style="width: 100%"
                max-height="250">
                <el-table-column
                  fixed
                  prop="date"
                  label="Fecha"
                  width="150">
                </el-table-column>
                <el-table-column
                  prop="name"
                  label="Nombre"
                  width="120">
                </el-table-column>
                <el-table-column
                  prop="state"
                  label="Estado"
                  width="120">
                </el-table-column>
                <el-table-column
                  prop="city"
                  label="Ciudad"
                  width="120">
                </el-table-column>
                <el-table-column
                  prop="address"
                  label="Dirección"
                  width="300">
                </el-table-column>
                <el-table-column
                  prop="zip"
                  label="Código postal"
                  width="120">
                </el-table-column>
                <el-table-column
                  fixed="right"
                  label="Operaciones"
                  width="120">
                  <template slot-scope="scope">
                    <el-button
                      @click.native.prevent="deleteRow(scope.$index, tableData4)"
                      type="text"
                      size="small">
                      Eliminar
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
      tableData4: [{
        date: '2016-05-03',
        name: 'Tom',
        state: 'California',
        city: 'Los Angeles',
        address: 'No. 189, Grove St, Los Angeles',
        zip: 'CA 90036'
      }, {
        date: '2016-05-02',
        name: 'Tom',
        state: 'California',
        city: 'Los Angeles',
        address: 'No. 189, Grove St, Los Angeles',
        zip: 'CA 90036'
      }, {
        date: '2016-05-04',
        name: 'Tom',
        state: 'California',
        city: 'Los Angeles',
        address: 'No. 189, Grove St, Los Angeles',
        zip: 'CA 90036'
      }, {
        date: '2016-05-01',
        name: 'Tom',
        state: 'California',
        city: 'Los Angeles',
        address: 'No. 189, Grove St, Los Angeles',
        zip: 'CA 90036'
      }, {
        date: '2016-05-08',
        name: 'Tom',
        state: 'California',
        city: 'Los Angeles',
        address: 'No. 189, Grove St, Los Angeles',
        zip: 'CA 90036'
      }, {
        date: '2016-05-06',
        name: 'Tom',
        state: 'California',
        city: 'Los Angeles',
        address: 'No. 189, Grove St, Los Angeles',
        zip: 'CA 90036'
      }, {
        date: '2016-05-07',
        name: 'Tom',
        state: 'California',
        city: 'Los Angeles',
        address: 'No. 189, Grove St, Los Angeles',
        zip: 'CA 90036'
      }],

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
