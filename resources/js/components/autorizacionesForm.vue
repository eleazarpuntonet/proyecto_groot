<template>
	<div>
		<el-card class="box-card">

			  <div slot="header" class="clearfix">
			    <strong>Reserva </strong>
			  </div>

			  <el-table
			    :data="tableData"
			    height="700"
			    style="width: 100%">
			    <el-table-column
			      prop="id"
			      label="Nro Reserva">
			    </el-table-column>
			    <el-table-column
			      prop="alcance"
			      label="Alcance">
			    </el-table-column>
			    <el-table-column
			      prop="id_user"
			      label="Usuario">
			    </el-table-column>
			    <el-table-column
			      prop="destino_b"
			      label="Origen">
			    </el-table-column>
			    <el-table-column
			      prop="destino_a"
			      label="Destino">
			    </el-table-column>
			  </el-table>
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
	  		tableData: null,
	  		pagination : {
	  			nextPage    : null,
	  			prevPage    : null,
	  			currentPage : null,
	  			lastPage    : null,
	  		},
	  		bottom: false,
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
	  	  	console.log('Pagina'+(this.pagination.currentPage+1))
	  	    axios.get(route('reservas.index'),{page : (this.pagination.currentPage+1)}) 
	  	        .then(response => {
	  	        	this.pagination.nextPagePath = response.data.reservas.next_page_url
	  	        	this.pagination.prevPagePath = response.data.reservas.prev_page_url
	  	        	this.pagination.currentPage  = response.data.reservas.current_page
	  	        	if (!!this.tableData) {
	  	        		this.tableData            = this.tableData.concat(response.data.reservas.data);
	  	        	} else {
	  	        		this.tableData = response.data.reservas.data
	  	        	}
	  	          })
	  	        .catch(error => {
	  	          console.log(error)
	  	        })
	  	   
	  	  }, 1000);
	  	},
	  },
	  beforeMount(){
	  },
	  created(){
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
	  	    	this.tableData            = response.data.reservas.data
	  	        console.log(response.data.reservas)
	  	      })
	  	    .catch(error => {
	  	      console.log(error)
	  	    })
	  },
	  destroyed () {
	  },
	}
</script>

<style lang="scss">

</style>
