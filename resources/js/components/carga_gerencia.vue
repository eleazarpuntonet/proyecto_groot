<script>
	import {VueContentLoading,VclTable} from         'vue-content-loading';
	import {
		getDepartamentos,
	} from '../apiCalls.js'
	export default {
	  /*
	  *
	  * Variables del componente
	  */
	  data () {

	  	return {
	  		editable: false,
	  		gerencia_form:{},
	  		rules_: {
				name: [
						{ required: true, message: 'El nombre es obligatorio', trigger: 'blur' },
					],
				display_name: [
						{ required: true, message: 'El apellido es obligatorio', trigger: 'blur' },
					],
				description: [
						{ required: true, message: 'El apellido es obligatorio', trigger: 'blur' },
					],	

	  		},
	  		lista_gerencias: [],
	  	}
	  },
	  components: {
	      VueContentLoading,
	      VclTable,
	  },
	  computed: {

	  },
	  methods: {
	  	submitForm(formName) {
			this.$refs[formName].validate((valid) => {
			  if (valid) {
			    axios.post(route('gerencias.store'),this.gerencia_form) 
			        .then(response => {
			        	this.lista_gerencias.push(response.data)
			        	resetForm(formName)
			          })
			        .catch(error => {
		        		console.log(error)
			        })
			  } else {
			    console.log('error submit!!');
			    return false;
			  }
			});
		},
		resetForm(formName) {
			this.$refs[formName].resetFields();
		},
		remoteMethod(query) {
		     console.log(query)
		   if (query !== '') {
		     this.loading = true;

		     
			axios.get(route('usuarios.search',query)) 
				.then(response => {
					console.log(response)
					this.options4=response.data
					this.loading = false;
					console.log(this.options4)
				})
				.catch(error => {
				// this.$notify.error({
				//   title: 'Error '+error.response.status,
				//   message: error.response.data.message
				// });
				})
		   } else {
		     this.options4 = [];
		   }
		 },
	  },
	  beforeMount(){
		getDepartamentos() 
		    .then(response => {
		    	this.lista_gerencias=response
		    	ceco: "asdf"
		    	coordinador: null
		    	coordinador_id: null
		    	created_at: "2019-02-21 14:41:23"
		    	dependencia: "asdf"
		    	disp_name: "fasdf"
		    	gerente: null
		    	gerente_id: null
		    	id: 1
		    	ref: "asdf"

		      })
		    .catch(error => {
		    	console.log(error)
		    })
	  },
	  created(){
	  },
	  mounted(){
	  },
	  destroyed () {
	  },
	}
</script>
<template>
	<div class="gerenciasView ele_modelview_A">
		<div class="contRightSide l_radiusBorder">
			<el-table
			  :data="lista_gerencias"
			  style="width:100%"
			  :default-sort = "{prop: 'disp_name', order: 'ascending'}"
			  max-height="800"
			  >
			  <el-table-column
			  :show-overflow-tooltip="true"
			  	min-width="60%"
			    label="Nombre"
			    sortable
			    prop="disp_name">
			  </el-table-column>
			  <el-table-column
			  :show-overflow-tooltip="true"
			  	min-width="40%"
			  	sortable
			    label="C. de costo"
			    prop="ceco">
			    <template slot-scope="scope">
			      {{scope.row.ceco}}
			    </template>
			  </el-table-column>
			  <template slot="empty">
			  	<VclTable height="90%" width="100%" class="LoadingAnimation"  :columns="2" :rows="20">
			  	</VclTable>
			  </template>
			</el-table>
		</div>
		<div style="display: flex; flex-direction: column; width: 65%;">
			<div class="topSideForm l_radiusBorder">
				<div class="titleForm">
				  <div class="logoGroup">
				    <img
				      src="../../../public/img/sps_logoborderline.png"
				      alt="Logo SPS"/>
				  </div>
				  <div class="textContainer">
				    <div style="display:table-cell;vertical-align:middle;">
				      <div class="texttitle">Gestion de Gerencias</div>
				    </div>
				  </div>
				</div>
			</div>
			<div class="contLeftSide l_radiusBorder">
				<el-form :rules="rules_" ref="gerencia_form_" :model="gerencia_form"  size="mini" style="width: 100%">

					<div class="form_line">
						<el-form-item prop="display_name" style="width:60%;">
							<div class="el_label">Nombre</div>
							<el-input v-model="gerencia_form.display_name" ></el-input>
						</el-form-item>

						<el-form-item prop="ref" style="width:40%;">
							<div class="el_label">Referencia</div>
							<el-input v-model="gerencia_form.ref" ></el-input>
						</el-form-item>
					</div>

					<div class="form_line">
						<el-form-item prop="dependencia" style="width:60%;">
							<div class="el_label">Dependencia</div>
							<el-input v-model="gerencia_form.dependencia" ></el-input>
						</el-form-item>
						<el-form-item prop="ceco" style="width:40%;">
							<div class="el_label">Centro de costo</div>
							<el-input v-model="gerencia_form.ceco" ></el-input>
						</el-form-item>
					</div>

					<div class="form_line">
						<el-form-item prop="coordinador" style="width:50%;">
							<div class="el_label">Coordinador</div>
							<el-select
							style="width: 100%;"
							  v-model="gerencia_form.coordinador"
							  filterable
							  remote
							  reserve-keyword
							  placeholder="Nombre"
							  :remote-method="remoteMethod"
							  loading-text="Cargando"
							  no-match-text="No se encontraron resultados"
							  no-data-text="No se encontraron resultados"
							  :loading="loading">
							  <el-option
							    v-for="item in options4"
							    :key="item.id"
							    :label="(item.name+ item.last_name)"
							    :value="item.id">
							    <span style="float: left; font-size: 1.2vw;">{{item.last_name}}, {{item.name}}</span>
							    <span style="float: right; color: #8492a6; font-size: 1vw">Departamento</span>
							  </el-option>
							</el-select>
						</el-form-item>

						<el-form-item prop="gerente" style="width:50%;">
							<div class="el_label">Gerente</div>
							<el-select
							style="width: 100%;"
							  v-model="gerencia_form.gerente"
							  filterable
							  remote
							  reserve-keyword
							  placeholder="Nombre"
							  :remote-method="remoteMethod"
							  loading-text="Cargando"
							  no-match-text="No se encontraron resultados"
							  no-data-text="No se encontraron resultados"
							  :loading="loading">
							  <el-option
							    v-for="item in options4"
							    :key="item.id"
							    :label="(item.name+ item.last_name)"
							    :value="item.id">
							    <span style="float: left; font-size: 1.2vw;">{{item.last_name}}, {{item.name}}</span>
							    <span style="float: right; color: #8492a6; font-size: 1vw">Departamento</span>
							  </el-option>
							</el-select>
						</el-form-item>
					</div>


					<el-form-item v-if="true">
						<el-button type="primary" @click="submitForm('gerencia_form_')">Enviar</el-button>
						<el-button @click="resetForm('gerencia_form_')">Reset</el-button>
					</el-form-item>

				</el-form>
			</div>
		</div>
	</div>
</template>
<style lang="scss">

</style>
