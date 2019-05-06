<script>
	import {VueContentLoading,VclTable} from         'vue-content-loading';
	class InfoExtra{
	  constructor(data){
	    this.data    = data.data
	    this.key     = data.key
	  }
	}
	export default {
		data () {

			return {
				permisos: [],
				editable: false,
				tmp_contact: false,
				tmp_extra: false,
				arr_temp:[],
				proveedores_form_:{
					extras: [],
					contacto: [],
				},
				contactos_form_:{
					descripcion : null,
					medio       : null,
					nombre      : null,
					value       : null
				},
				extra_form:{
					data:null,
					key:null
				},
				rules_proveedores: {
				rif: [
						{ required: true, message: 'Campo obligatorio', trigger: 'blur' },
					],
				r_social: [
						{ required: true, message: 'Campo obligatorio', trigger: 'blur' },
					],
				nombre: [
						{ required: true, message: 'Campo obligatorio', trigger: 'blur' },
					],	
				key: [
						{ required: true, message: 'Campo obligatorio', trigger: 'blur' },
					],
				data: [
						{ required: true, message: 'Campo obligatorio', trigger: 'blur' },
					],
				},
				lista_proveedores: [],
				options4: [],
				  value9: [],
				  list: [],
				  loading: false,

			}
		},
		components: {
		  VueContentLoading,
		  VclTable,
		},
		computed: {

		},
		watch:{
			permisos(){
	  			this.$store.dispatch('setAccesos', this.$router.app._route.meta.router_id)
			}
		},
		methods: {
			checkPermisos(accion_id, accion) {
			  if (this.permisos.some(item => item.action_id == accion_id)) {
			    let index = this.permisos.findIndex(item => item.action_id == accion_id)
			    if (this.permisos[index][accion] == 'true' || this.permisos[index][accion] == true) {
			      return true
			    } else {
			      return false
			    }
			  } else {
			    return false
			  }
			},
			add_extra(){
				this.tmp_extra= false
				if (this.extra_form.key) {
					this.proveedores_form_.extras.push({ 
						data: this.extra_form.data,
						key: this.extra_form.key
					})
				} 
			},
			add_contact(){
				this.tmp_contact= false
				if (this.contactos_form_.value) {
					this.proveedores_form_.contacto.push({
						medio       : this.contactos_form_.medio,
						nombre      : this.contactos_form_.nombre,
						value       : this.contactos_form_.value,
						descripcion : this.contactos_form_.descripcion,
					})
				} 
			},
			_contact(val){
				this.tmp_contact=val
				this.contactos_form_.medio       = null
				this.contactos_form_.nombre      = null
				this.contactos_form_.value       = null
				this.contactos_form_.descripcion = null
			},
			_extra(val){
				this.tmp_extra=val
				this.extra_form.key       = null
				this.extra_form.data      = null
			},
			submitForm(formName) {
			this.$refs[formName].validate((valid) => {
			  if (valid) {

			  	this.proveedores_form_.extras = JSON.stringify(this.proveedores_form_.extras)
			  	this.proveedores_form_.contacto = JSON.stringify(this.proveedores_form_.contacto)
			    	axios.post(route('proveedores.store',this.proveedores_form_)) 
			    	    .then(response => {
			    	    	this.resetForm(formName)
			            	this.lista_proveedores.push(response.data)
			    	      })
			    	    .catch(error => {
			    	    	console.log(error)
			    	      this.$notify.error({
			    	        title: 'Error '+error.response,
			    	        message: error.response
			    	      });
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
		   if (query !== '') {
		     this.loading = true;
		     setTimeout(() => {
		       this.loading = false;
		       this.options4 = this.list.filter(item => {
		         return item.label.toLowerCase()
		           .indexOf(query.toLowerCase()) > -1;
		       });
		     }, 200);
		   } else {
		     this.options4 = [];
		   }
		 },
		},
		beforeMount(){
	  		this.permisos = this.$store.getters.getUserPermisos
			axios.get(route('proveedores.index')) 
			    .then(response => {
			    	this.lista_proveedores=response.data
			      })
			    .catch(error => {
			    	console.log(error)
			      this.$notify.error({
			        title: 'Error '+error.response,
			        message: error.response
			      });
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
	<div class="proveedoresView ele_modelview_A">
		<div class="contRightSide l_radiusBorder">
			<el-table
				max-height="800"
			  :data="lista_proveedores"
			  style="width: 100%">
			  <el-table-column
			    label="Nombre"
			    prop="nombre">
			  </el-table-column>
			  <el-table-column
			    label="Pais"
			    prop="pais">
			  </el-table-column>
			  <el-table-column
			    label="Rif"
			    prop="rif">
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
				      <div class="texttitle">gestion de proveedores</div>
				    </div>
				  </div>
				</div>
			</div>
			<div class="contLeftSide l_radiusBorder">
				<el-form :rules="rules_proveedores" ref="proveedores_form" :model="proveedores_form_"  size="mini" style="width: 100%">
					<div class="form_line">
						<div style="display: flex; flex-direction: row; width: 100%; justify-content: flex-end; margin-top: 5px;">
						  <div class="subtituloReserva">
						  </div>
						  <div class="radiogroupp">
						  	<el-button 
						  		:class="(tmp_contact || tmp_extra)?'no_visible':'nada'"
						  		@click="_contact(true)"
						  		size="mini" 
						  		type="primary" 
						  		icon="el-icon-circle-plus">Agregar contacto
						  	</el-button>

						  	<el-button 
						  		:class="(tmp_extra || tmp_contact)?'no_visible':'nada'"
						  		@click="_extra(true)"
						  		size="mini" 
						  		type="primary" 
						  		icon="el-icon-circle-plus">Agregar informacion extra
						  	</el-button>
						  </div>
						</div>
					</div>
					<div class="form_line">
						<el-form-item prop="nombre" style="width:35%;">
							<div class="el_label">Nombre</div>
							<el-input v-model="proveedores_form_.nombre" ></el-input>
						</el-form-item>

						<el-form-item prop="r_social" style="width:35%;">
							<div class="el_label">Razon social</div>
							<el-input v-model="proveedores_form_.r_social" ></el-input>
						</el-form-item>

						<el-form-item prop="rif" style="width:30%;">
							<div class="el_label">Rif</div>
							<el-input v-model="proveedores_form_.rif" class="input-with-select">
							  <el-select v-model="proveedores_form_.rif" slot="prepend" placeholder="Nac">
							    <el-option label="J-" value="J-" selected></el-option>
							    <el-option label="E-" value="E-"></el-option>
							  </el-select>
							</el-input>
						</el-form-item>
					</div>

					<div class="form_line">
						<el-form-item prop="t_contribuyente" style="width:30%;">
							<div class="el_label">Tipo de contribuyente</div>
							<el-select v-model="proveedores_form_.t_contribuyente" placeholder="Contribuyente">
							  <el-option label="Ordinario" value="Ordinario" selected></el-option>
							  <el-option label="Formal" value="Formal"></el-option>
							  <el-option label="Especial" value="Especial"></el-option>
							</el-select>
						</el-form-item>

						<el-form-item prop="pais" style="width:30%;">
							<div class="el_label">Pais</div>
							<el-select v-model="proveedores_form_.pais" placeholder="Pais">
							  <el-option label="Venezuela" value="Venezuela," selected></el-option>
							  <el-option label="Otro" value="Otro"></el-option>
							</el-select>
						</el-form-item>

						<el-form-item prop="dir" style="width:70%;">
							<div class="el_label">Direccion</div>
							<el-input v-model="proveedores_form_.dir" :disabled="(!proveedores_form_.pais)?true:false">
							</el-input>
						</el-form-item>
					</div>

				<template v-if="tmp_contact">
						<div class="form_line">
							<el-form-item prop="contacto" style="width:50%;">
								<div class="el_label">Nombre</div>
								<el-input v-model="contactos_form_.nombre">
								</el-input>
							</el-form-item>
							<el-form-item prop="contacto" style="width:50%;">
								<div class="el_label">Descripcion</div>
								<el-input v-model="contactos_form_.descripcion">
								</el-input>
							</el-form-item>
					</div>

						<div class="form_line">
							<el-form-item prop="contacto" style="width:100%;">
								<div class="el_label">Datos de contacto</div>
			    				<el-input v-model="contactos_form_.value" class="input-with-select" size="mini" :placeholder="contactos_form_.medio">
			    				  <el-select v-model="contactos_form_.medio"       slot="prepend" placeholder="Medio de contacto">
				    				  <el-option label="Correo"         value="Correo">         </el-option>
				    				  <el-option label="Telefono" 		value="Telefono"> 		</el-option>
				    				  <el-option label="Whatsapp"       value="Whatsapp">       </el-option>
				    				  <el-option label="Skype"          value="Skype">          </el-option>
			    				  </el-select>
			    				  <el-button @click="add_contact()" slot="append" icon="el-icon-check" class="cn_buttonadd"></el-button>
			    				</el-input>
							</el-form-item>
						</div>
				</template>


				<template v-if="tmp_extra">
						<div class="form_line">
							<el-form-item prop="contacto" style="width:100%;">
								<div class="el_label">Informacion Extra</div>
			  	    			<div class="form_line">
			  	    				<el-form-item prop="contacto" style="width:100%;">
			  	    					<div class="el_label">Descripcion</div>
			  	    					<el-input v-model="extra_form.data" placeholder="Detalles ">
			  	    						<el-select
			  	    							slot="prepend"
			  	    						  	v-model="extra_form.key"
			  	    						  	filterable
			  	    						  	allow-create
			  	    						  	placeholder="Tipo">
			  	    						  	<el-option label="Nuevo" value="Nuevo"></el-option>
			  	    						</el-select>
			  	    						<el-button @click="add_extra()" slot="append" icon="el-icon-check" class="cn_buttonadd"></el-button>
			  	    					</el-input>
			  	    				</el-form-item>
								</div>
							</el-form-item>
						</div>
				</template>

				<el-form-item v-if="checkPermisos('dataload003i5','escribe')">
					<el-button 
						v-if="checkPermisos('dataload003i5','escribe')"
						size="mini" 
						icon="el-icon-success"
						type="info" 
						@click="submitForm('proveedores_form')">Enviar
					</el-button>
					<el-button 
						v-if="checkPermisos('dataload003i5','modifica')"
						size="mini" 
						type="info" 
						icon="el-icon-edit"">Editar
					</el-button>
					<el-button 
						v-if="checkPermisos('dataload003i5','escribe')"
						icon="el-icon-error"
						size="mini" 
						@click="resetForm('proveedores_form')">Reset
					</el-button>
				</el-form-item>
				</el-form>	
			</div>
		</div>
	</div>
</template>
<style lang="scss">

</style>
