<script>
import Papa from 'papaparse'
import {
  formularioRequisicion,
  formularioItemsRequisicion
} from '../formlabels.js'
const labels = formularioRequisicion.es
const labelsItems = formularioItemsRequisicion.es
	export default {
	  data () {
	  	return {
	  		switchItemForm: false,
	  		temp: {
	  			activo: false,
	  			consumible: false,
	  			stock: false,
	  		},
	  		user: this.$store.getters.currentUser,
	  		formREQ:{
	  			gerencia      : this.$store.getters.currentUser.departamento.disp_name,
	  			gerencia_id   : this.$store.getters.currentUser.departamento.id,
	  			ceco          : this.$store.getters.currentUser.departamento.ceco,
	  			fecha_emision : new Date(),
	  			rules         : formularioRequisicion.rules,
	  			labels        : labels
	  		},
	  		formItemsReq:{
	  			rules         : formularioItemsRequisicion.rules,
	  			labels        : labelsItems
	  		},
	  		itemsReq: [{
			    "cantidad": 15,
			    "unidad": "Metros",
			    "descripcion": "Cabilla corrugada",
			    "nro_parte": "1231215",
			    "cod_material": "me-calcal",
			    "cl_costo": "Exponteneo",
			    "apu": "0012032",
			    "observaciones": "Se necesita el material para la concepcion de equis elemento"
			}],
	  		options: [{
	  		          value: 'Option1',
	  		          label: 'Option1'
	  		        }, {
	  		          value: 'Option2',
	  		          label: 'Option2'
	  		        }, {
	  		          value: 'Option3',
	  		          label: 'Option3'
	  		        }, {
	  		          value: 'Option4',
	  		          label: 'Option4'
	  		        }, {
	  		          value: 'Option5',
	  		          label: 'Option5'
	  		        }]

	  	}
	  },
	  computed:{},
	  methods:{
	  	httpcsv(algo){
	  		Papa.parse(algo.file, {
	  			config: {
					quotes: false, //or array of booleans
					quoteChar: '"',
					delimiter: ",",
					header: true,
					newline: "\r\n",
					skipEmptyLines: false, //or 'greedy',
					columns: null //or array of strings
				},
				escapeChar: '"',
				header: true,
				dynamicTyping: true,
				delimiter: ",",
				
				before: function(file, inputElem)
				{
					// executed before parsing each file begins;
					// what you return here controls the flow
				},
				error: function(err, file, inputElem, reason)
				{
					// executed if an error occurs while loading the file,
					// or if before callback aborted for some reason
				},
	  			complete: function(results) {
	  				console.log(results);
	  			}
	  		});
	  	},
	  	addToTableRequisicion(){
	  		let temp = {}
	  		for(var propertyName in this.formItemsReq) {
	  			if (propertyName != 'rules' || propertyName != 'labels') {
	  				temp[propertyName] = this.formItemsReq[propertyName]
	  			}
	  		}
	  		temp.activo              = this.temp.activo
	  		temp.consumible          = this.temp.consumible
	  		temp.stock               = this.temp.stock
	  		this.temp.activo         = false
	  		this.temp.consumible     = false
	  		this.temp.stock          = false
	  		this.formItemsReq        = {}
	  		this.formItemsReq.rules  = formularioItemsRequisicion.rules
	  		this.formItemsReq.labels = labelsItems
	  		this.itemsReq.push(temp)
	  	},
	  },
	  beforeMount(){},
	  created(){},
	  mounted(){},
	  destroyed(){},
	}
</script>
<template>
	<div class="requisicionForm ele_modelview_A">
		<div style="display: flex; flex-direction: column; width: 100%;">
			<div class="topSideForm l_radiusBorder">
				<div class="titleForm">
				  <div class="logoGroup">
				    <img
				      src="../../../public/img/sps_logoborderline.png"
				      alt="Logo SPS"/>
				  </div>
				  <div class="textContainer">
				    <div style="display:flex;">
				      <div class="texttitle">Requisicion de Materiales/Equipos</div>
				    </div>
				  </div>
				</div>
			</div>
			<div class="form_line">
				<div class="contLeftSide l_radiusBorder">
					<el-form 
						style="width: 100%;"
						ref="formularioRequisicion" 
						:rules="formREQ.rules"
						:model="formREQ">
						<div class="form_line">
							<el-form-item prop="nro_solicitud" style="width:30%;">
								<div class="el_label">{{formREQ.labels.nro_solicitud.label}}</div>
								<el-input 
									:placeholder="formREQ.labels.nro_solicitud.placeholder"
									size="small"
									v-model="formREQ.nro_solicitud" 
									:disabled="true">
								</el-input>
							</el-form-item>

							<el-form-item prop="proyecto" style="width:40%;">
								<div class="el_label">{{formREQ.labels.proyecto.label}}</div>
								<el-select 
									style="width:100%"
									size="small"
									v-model="formREQ.proyecto" 
									filterable 
									:placeholder="formREQ.labels.proyecto.placeholder">
								  <el-option
								    v-for="item in options"
								    :key="item.value"
								    :label="item.label"
								    :value="item.value">
								  </el-option>
								</el-select>
							</el-form-item>

							<el-form-item prop="gerencia" style="width:30%;">
								<div class="el_label">{{formREQ.labels.gerencia.label}}</div>
								<el-select 
									:disabled="true"
									style="width:100%"
									size="small"
									v-model="formREQ.gerencia" 
									filterable 
									:placeholder="formREQ.labels.gerencia.placeholder">
								  <el-option
								    v-for="item in options"
								    :key="item.value"
								    :label="item.label"
								    :value="item.value">
								  </el-option>
								</el-select>
							</el-form-item>
						</div>
						<div class="form_line">
							<el-form-item prop="p_acumplir" style="width:20%;">
								<div class="el_label">{{formREQ.labels.p_acumplir.label}}</div>
								<el-input 
									size="small"
									:placeholder="formREQ.labels.p_acumplir.placeholder"
									v-model="formREQ.p_acumplir" 
									:disabled="false">
								</el-input>
							</el-form-item>

							<el-form-item prop="subservicio" style="width:20%;">
								<div class="el_label">{{formREQ.labels.subservicio.label}}</div>
								<el-input 
									size="small"
									:placeholder="formREQ.labels.subservicio.placeholder"
									v-model="formREQ.subservicio" 
									:disabled="false">
								</el-input>
							</el-form-item>

							<el-form-item prop="sede" style="width:20%;">
								<div class="el_label">{{formREQ.labels.sede.label}}</div>
								<el-select 
									style="width:100%"
									size="small"
									v-model="formREQ.sede" 
									filterable 
									:placeholder="formREQ.labels.sede.placeholder">
								  <el-option
								    v-for="item in options"
								    :key="item.value"
								    :label="item.label"
								    :value="item.value">
								  </el-option>
								</el-select>
							</el-form-item>

							<el-form-item prop="ceco" style="width:20%;">
								<div class="el_label">{{formREQ.labels.ceco.label}}</div>
								<el-select 
									:disabled="true"
									style="width:100%"
									size="small"
									v-model="formREQ.ceco" 
									filterable 
									:placeholder="formREQ.labels.ceco.placeholder">
								  <el-option
								    v-for="item in options"
								    :key="item.value"
								    :label="item.label"
								    :value="item.value">
								  </el-option>
								</el-select>
							</el-form-item>

							<el-form-item prop="prioridad" style="width:20%;">
								<div class="el_label">{{formREQ.labels.prioridad.label}}</div>
								<el-slider
								  v-model="formREQ.prioridad"
								  :step="50"
								  show-stops>
								</el-slider>
							</el-form-item>
						</div>
						<div class="form_line">
							<el-form-item prop="fecha_emision" style="width:15%;">
								<div class="el_label">{{formREQ.labels.fecha_emision.label}}</div>
								<el-date-picker
									:default-value="new Date()"	
									:disabled=true
									size="small"
									style="width:100%" 
									v-model="formREQ.fecha_emision"
									type="date"
									value-format="yyyy-MM-dd"
									:placeholder="formREQ.labels.fecha_emision.placeholder">
								</el-date-picker>
							</el-form-item>

							<el-form-item prop="f_entrega" style="width:15%;">
								<div class="el_label">{{formREQ.labels.f_entrega.label}}</div>
								<el-date-picker
								  size="small"
								  style="width:100%" 
								  v-model="formREQ.f_entrega"
								  type="date"
								  value-format="yyyy-MM-dd"
								  :placeholder="formREQ.labels.f_entrega.placeholder">
								</el-date-picker>
							</el-form-item>

							<el-form-item prop="m_compra" style="width:35%;">
								<div class="el_label">{{formREQ.labels.m_compra.label}}</div>
								<el-input 
									size="small"
									:placeholder="formREQ.labels.m_compra.placeholder"
									v-model="formREQ.m_compra" 
									:disabled="false">
								</el-input>
							</el-form-item>

							<el-form-item prop="d_entrega" style="width:35%;">
								<div class="el_label">{{formREQ.labels.d_entrega.label}}</div>
								<el-input 
									type="textarea"
									:rows="3"
									size="small"
									:placeholder="formREQ.labels.d_entrega.placeholder"
									v-model="formREQ.d_entrega" 
									:disabled="false">
								</el-input>
							</el-form-item>
						</div>
					</el-form>
				</div>
			</div>
			<div class="form_line formItems l_radiusBorder">
				<el-form 
					style="width: 100%;"
					ref="formularioEmpresas" 
					:model="formItemsReq">
					<el-table
						empty-text="Aun no se ha agregado ninguna empresa"
					  	:data="itemsReq"
					  	style="width: 100%;">
					  	<template slot="append">
					  		<el-button 
					  			size="small"
					  			type="info" 
					  			icon="el-icon-success"
					  			@click="switchItemForm = true">Editar Tabla
					  		</el-button>
					  	</template>
					  	<el-table-column
					  	  type="index">
					  	</el-table-column>
						</el-table-column>
						<el-table-column
							header-row-class-name="headerPrueba"
							align     = "center"
							prop      = "cantidad"
							label     = "Cantidad"
							min-width = "10">
						</el-table-column>
						<el-table-column
							align     = "center"
							prop      = "unidad"
							label     = "Unidad"
							min-width = "10">
						</el-table-column>
						<el-table-column
							align     = "center"
							prop      = "nro_parte"
							label     = "Nro de parte"
							min-width = "10">
						</el-table-column>
						<el-table-column
							align     = "center"
							prop      = "descripcion"
							label     = "Descripcion"
							min-width = "15">
						</el-table-column>
						<el-table-column
							align     = "center"
							prop      = "cod_material"
							label     = "Cod. del material"
							min-width = "10">
						</el-table-column>
						<el-table-column
							align     = "center"
							prop      = "cl_costo"
							label     = "Clase de costo"
							min-width = "10">
						</el-table-column>
						<el-table-column
							align     = "center"
							prop      = "apu"
							label     = "APU"
							min-width = "10">
						</el-table-column>
						<el-table-column 
							align     = "center"
							label="Condicion del material/equipo">
							<el-table-column
								min-width = "10"
								align     = "center"
								prop      = "activo"
								label     = "Activo">
								<template slot-scope="scope">
									<el-button 
										size="mini"
										v-if="scope.row.activo"
										type="success" 
										icon="el-icon-check" 
										circle>
									</el-button>
									<el-button 
										size="mini"
										v-else
										icon="el-icon-close" 
										circle>
									</el-button>

								</template>
							</el-table-column>
							<el-table-column
								min-width = "10"
								align     = "center"
								prop      = "consumible"
								label     = "Consumible">
								<template slot-scope="scope">
									<el-button 
										size="mini"
										v-if="scope.row.consumible"
										type="success" 
										icon="el-icon-check" 
										circle>
									</el-button>
									<el-button 
										size="mini"
										v-else
										icon="el-icon-close" 
										circle>
									</el-button>
								</template>
							</el-table-column>
							<el-table-column
								min-width = "10"
								align     = "center"
								prop      = "stock"
								label     = "Stock en almacen">
								<template slot-scope="scope">
									<el-button 
										size="mini"
										v-if="scope.row.stock"
										type="success" 
										icon="el-icon-check" 
										circle>
									</el-button>
									<el-button 
										size="mini"
										v-else
										icon="el-icon-close" 
										circle>
									</el-button>
								</template>
							</el-table-column>
						</el-table-column>
						<el-table-column
							show-overflow-tooltip
							align     = "left"
							prop      = "observaciones"
							label     = "Observaciones"
							min-width = "15">
						</el-table-column>
					</el-table>
				</el-form>
			</div>
		</div>
		<el-dialog
			title="Tabla de requisicion"
			:visible.sync="switchItemForm"
			:fullscreen="true"
			width="70%"
			center>
			<el-table
				empty-text="Aun no se ha agregado ninguna empresa"
				:data="itemsReq"
				style="width: 100%;">
					<template slot="append">
						<el-button 
							size="small"
							type="info" 
							icon="el-icon-success"
							@click="switchItemForm = true">Agregar archivo .csv
						</el-button>

						<el-upload
						  class="upload-demo"
						  drag
						  :auto-upload="true"
						  :http-request="httpcsv"
						  action="">
						  <i class="el-icon-upload"></i>
						  <div class="el-upload__text">Suelta tu archivo aquí o <em>haz clic para cargar</em></div>
						</el-upload>
					</template>
				  	<el-table-column
				  	  type="index">
				  	</el-table-column>
					</el-table-column>
					<el-table-column
						header-row-class-name="headerPrueba"
						align     = "center"
						prop      = "cantidad"
						label     = "Cantidad"
						min-width = "10">
					</el-table-column>
					<el-table-column
						align     = "center"
						prop      = "unidad"
						label     = "Unidad"
						min-width = "10">
					</el-table-column>
					<el-table-column
						align     = "center"
						prop      = "nro_parte"
						label     = "Nro de parte"
						min-width = "10">
					</el-table-column>
					<el-table-column
						align     = "center"
						prop      = "descripcion"
						label     = "Descripcion"
						min-width = "15">
					</el-table-column>
					<el-table-column
						align     = "center"
						prop      = "cod_material"
						label     = "Cod. del material"
						min-width = "10">
					</el-table-column>
					<el-table-column
						align     = "center"
						prop      = "cl_costo"
						label     = "Clase de costo"
						min-width = "10">
					</el-table-column>
					<el-table-column
						align     = "center"
						prop      = "apu"
						label     = "APU"
						min-width = "10">
					</el-table-column>
					<el-table-column 
						align     = "center"
						label="Condicion del material/equipo">
						<el-table-column
							min-width = "10"
							align     = "center"
							prop      = "activo"
							label     = "Activo">
							<template slot-scope="scope">
								<el-button 
									size="mini"
									v-if="scope.row.activo"
									type="success" 
									icon="el-icon-check" 
									circle>
								</el-button>
								<el-button 
									size="mini"
									v-else
									icon="el-icon-close" 
									circle>
								</el-button>

							</template>
						</el-table-column>
						<el-table-column
							min-width = "10"
							align     = "center"
							prop      = "consumible"
							label     = "Consumible">
							<template slot-scope="scope">
								<el-button 
									size="mini"
									v-if="scope.row.consumible"
									type="success" 
									icon="el-icon-check" 
									circle>
								</el-button>
								<el-button 
									size="mini"
									v-else
									icon="el-icon-close" 
									circle>
								</el-button>
							</template>
						</el-table-column>
						<el-table-column
							min-width = "10"
							align     = "center"
							prop      = "stock"
							label     = "Stock en almacen">
							<template slot-scope="scope">
								<el-button 
									size="mini"
									v-if="scope.row.stock"
									type="success" 
									icon="el-icon-check" 
									circle>
								</el-button>
								<el-button 
									size="mini"
									v-else
									icon="el-icon-close" 
									circle>
								</el-button>
							</template>
						</el-table-column>
					</el-table-column>
					<el-table-column
						align     = "left"
						prop      = "observaciones"
						label     = "Observaciones"
						min-width = "15">
					</el-table-column>
			</el-table>
			<el-form 
				style="width: 100%;"
				:model="formItemsReq">
				<div class="l_radiusBorder forItems">
					<div class="form_line">
						<el-form-item prop="cantidad" style="width:10%;">
							<div class="el_label">{{formItemsReq.labels.cantidad.label}}</div>
							<el-input-number 
								style="width:100%;"
								size="small" 
								v-model="formItemsReq.cantidad">
							</el-input-number>
							</el-input>
						</el-form-item>

						<el-form-item prop="unidad" style="width:30%;">
							<div class="el_label">{{formItemsReq.labels.unidad.label}}</div>
							<el-input 
								:placeholder="formItemsReq.labels.unidad.placeholder"
								size="small"
								v-model="formItemsReq.unidad" 
								:disabled="false">
							</el-input>
						</el-form-item>

						<el-form-item prop="descripcion" style="width:60%;">
							<div class="el_label">{{formItemsReq.labels.descripcion.label}}</div>
							<el-input 
								:placeholder="formItemsReq.labels.descripcion.placeholder"
								size="small"
								v-model="formItemsReq.descripcion" 
								:disabled="false">
							</el-input>
						</el-form-item>
					</div>	
					<div class="form_line">
						<el-form-item prop="nro_parte" style="width:25%;">
							<div class="el_label">{{formItemsReq.labels.nro_parte.label}}</div>
							<el-input 
								:placeholder="formItemsReq.labels.nro_parte.placeholder"
								size="small"
								v-model="formItemsReq.nro_parte" 
								:disabled="false">
							</el-input>
						</el-form-item>

						<el-form-item prop="cod_material" style="width:25%;">
							<div class="el_label">{{formItemsReq.labels.cod_material.label}}</div>
							<el-input 
								:placeholder="formItemsReq.labels.cod_material.placeholder"
								size="small"
								v-model="formItemsReq.cod_material" 
								:disabled="false">
							</el-input>
						</el-form-item>

						<el-form-item prop="cl_costo" style="width:25%;">
							<div class="el_label">{{formItemsReq.labels.cl_costo.label}}</div>
							<el-input 
								:placeholder="formItemsReq.labels.cl_costo.placeholder"
								size="small"
								v-model="formItemsReq.cl_costo" 
								:disabled="false">
							</el-input>
						</el-form-item>

						<el-form-item prop="apu" style="width:25%;">
							<div class="el_label">{{formItemsReq.labels.apu.label}}</div>
							<el-input 
								:placeholder="formItemsReq.labels.apu.placeholder"
								size="small"
								v-model="formItemsReq.apu" 
								:disabled="false">
							</el-input>
						</el-form-item>
					</div>	
					<div class="form_line">
						<el-form-item style="width:50%;">
							<div class="el_label">Condicion del material/equipo</div>
							<el-checkbox 
								size="small"
								v-model="temp.activo" 
								:label="formItemsReq.labels.activo.label" 
								border>
							</el-checkbox>
							<el-checkbox 
								size="small"
								v-model="temp.consumible" 
								:label="formItemsReq.labels.consumible.label" 
								border>
							</el-checkbox>
							<el-checkbox 
								size="small"
								v-model="temp.stock" 
								:label="formItemsReq.labels.stock.label" 
								border>
							</el-checkbox>
						</el-form-item>
						<el-form-item prop="observaciones" style="width:50%;">
							<div class="el_label">{{formItemsReq.labels.observaciones.label}}</div>
							<el-input 
								type="textarea"
								:rows="3"
								:placeholder="formItemsReq.labels.observaciones.placeholder"
								size="small"
								v-model="formItemsReq.observaciones" 
								:disabled="false">
							</el-input>
						</el-form-item>
					</div>	
					<div class="form_line line_bottom">
						<el-button 
							type="info"
							size="small"
							@click="addToTableRequisicion">Agregar a tabla
						</el-button>
					</div>		
				</div>
			</el-form>

			<span slot="footer" class="dialog-footer">
			<el-button 
				size="small"
				@click="switchItemForm = false">Cancelar
			</el-button>
			<el-button 
				size="small"
				type="primary" 
				@click="switchItemForm = false">Confirmar
			</el-button>
			</span>
		</el-dialog>
	</div>
</template>


<style lang="sass">
	.forItems
		background-color: #EBEAEA
		.line_bottom
			padding: 15px 15px
			justify-content: flex-end
	.requisicionForm	
		.formItems
			padding: 0px 0px !important
			.el-table__header
				background-color: blue
				font-size: 0.7rem

		.el-slider
			margin: 0 10px
</style>
