<template>
	<div>

<!-- 		<el-button-group style="float:right;">
		  <el-button 
		  	size="mini" 
		  	type="primary" 
		  	icon="el-icon-arrow-left">Anterior</el-button>
		  <el-button 
		  	size="mini" 
		  	type="primary">Siguiente<i class="el-icon-arrow-right el-icon-right"></i></el-button>
		</el-button-group> -->
<!-- 		<el-card class="box-card">

			<h1>hola</h1>
		</el-card> -->

		<nav>
		  <router-link to="/detalle/13">Next</router-link>
		  <router-link to="/detalle/14">Next</router-link>
		  <router-link :to="{ name: 'Detalle', params: { id_reserva: 14 }}">User</router-link>
		</nav>
		<h1>hola</h1>
		<router-view></router-view>

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

</style>
