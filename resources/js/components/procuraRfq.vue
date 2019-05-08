<script>
	import nav from '../CoreUi/src/_nav';
	import auths from '../auth_items'
	import {
		GetRutas,
		getActions,
		getRoles,
		getRutasRoles,
		sendRutasActualizadas
	} from '../apiCalls.js'

	export default {
			data () {
				return {
					formRFQ : {},
					formEMP : {},
				}
		},
		computed : {},
		watch    : {},
		methods  : {},
		beforeMount() {},
		created()     {},
		mounted()     {},
		destroyed()   {},
	}
</script>
<template>
	<div class="RFQView">
		<el-form ref="formularioProcuraRFQ" :model="formRFQ">
			<div class="topSideForm l_radiusBorder">
				PR19-12
			</div>
			<div class="formContainer">
				<div class="rightSideForm l_radiusBorder">
					<div class="form_line">
						<el-form-item prop="proceso" style="width:30%;">
							<div class="el_label">Proceso</div>
							<el-input 
								size="small"
								placeholder="Proceso"
								v-model="formRFQ.proceso" 
								:disabled="false">
							</el-input>
						</el-form-item>

						<el-form-item prop="proyecto" style="width:30%;">
							<div class="el_label">Proyecto</div>
							<el-input 
								placeholder="Proyecto"
								size="small"
								v-model="formRFQ.proyecto" 
								:disabled="false">
							</el-input>
						</el-form-item>

						<el-form-item prop="desc_corta" style="width:40%;">
							<div class="el_label">Descripcion</div>
							<el-input
								placeholder="Descripcion"
								size="small"
								v-model="formRFQ.desc_corta">
							</el-input>
						</el-form-item>
					</div>

					<div class="form_line">
						<el-form-item prop="marca" style="width:33%;">
							<div class="el_label">Marca</div>
							<el-select 
								style="width:100%"
								size="small"
								v-model="formRFQ.marca" 
								clearable 
								placeholder="Marca">
							  <el-option
							    key="item.value"
							    label="item.label"
							    value="item.value">
							  </el-option>
							</el-select>
						</el-form-item>

						<el-form-item prop="cliente" style="width:33%;">
							<div class="el_label">Cliente</div>
							<el-select 
								style="width:100%"
								size="small"
								v-model="formRFQ.cliente"
								clearable 
								placeholder="Cliente">
							  <el-option
							    key="item.value"
							    label="item.label"
							    value="item.value">
							  </el-option>
							</el-select>
						</el-form-item>

						<el-form-item prop="comp_cliente" style="width:33%;">
							<div class="el_label">Comprador cliente</div>
							<el-select 
								style="width:100%"
								size="small"
								v-model="formRFQ.comp_cliente" 
								clearable 
								placeholder="Comprador cliente">
							  <el-option
							    key="item.value"
							    label="item.label"
							    value="item.value">
							  </el-option>
							</el-select>
						</el-form-item>
					</div>

					<div class="form_line">
						<el-form-item prop="fecha_recibida" style="width:25%;">
							<div class="el_label">Fecha recibida</div>
							<el-date-picker
							  size="small"
							  style="width:100%" 
							  id="fecha_recib"
							  v-model="formRFQ.fecha_recibida"
							  type="date"
							  value-format="yyyy-MM-dd"
							  placeholder="Fecha recibida">
							</el-date-picker>
						</el-form-item>

						<el-form-item prop="fecha_original" style="width:25%;">
							<div class="el_label">Fecha original</div>
							<el-date-picker
							  size="small"
							  style="width:100%" 
							  id="fecha_original"
							  v-model="formRFQ.fecha_original"
							  type="date"
							  value-format="yyyy-MM-dd"
							  placeholder="Fecha original">
							</el-date-picker>
						</el-form-item>

						<el-form-item prop="fecha_cotizacion" style="width:25%;">
							<div class="el_label">Fecha cotizacion</div>
							<el-date-picker
							  size="small"
							  style="width:100%" 
							  id="fecha_cotizacion"
							  v-model="formRFQ.fecha_cotizacion"
							  type="date"
							  value-format="yyyy-MM-dd"
							  placeholder="Fecha cotizacion">
							</el-date-picker>
						</el-form-item>

						<el-form-item prop="fecha_extendida" style="width:25%;">
							<div class="el_label">Fecha extendida</div>
							<el-date-picker
							  size="small"
							  style="width:100%" 
							  id="fecha_extendida"
							  v-model="formRFQ.fecha_extendida"
							  type="date"
							  value-format="yyyy-MM-dd"
							  placeholder="Fecha extendida">
							</el-date-picker>
						</el-form-item>
					</div>

					<div class="form_line">
						<el-form-item prop="moneda" style="width:25%;">
							<div class="el_label">Moneda</div>
							<el-select 
								style="width:100%"
								size="small"
								v-model="formRFQ.moneda" 
								clearable 
								placeholder="Moneda">
							  <el-option
							    key="item.value"
							    label="item.label"
							    value="item.value">
							  </el-option>
							</el-select>
						</el-form-item>

						<el-form-item prop="estimado_cli" style="width:25%;">
							<div class="el_label">Estimado $</div>
							<el-input 
								size="small"
								v-model="formRFQ.estimado_cli" 
								:disabled="false">
							</el-input>
						</el-form-item>

						<el-form-item prop="status" style="width:25%;">
							<div class="el_label">Status</div>
							<el-select 
								style="width:100%"
								size="small"
								v-model="formRFQ.status" 
								clearable 
								placeholder="Status">
							  <el-option
							    key="item.value"
							    label="item.label"
							    value="item.value">
							  </el-option>
							</el-select>
						</el-form-item>

						<el-form-item prop="comprador_scz" style="width:25%;">
							<div class="el_label">Comprador SCZ</div>
							<el-select 
								style="width:100%"
								size="small"
								v-model="formRFQ.comprador_scz" 
								clearable 
								placeholder="Comprador SCZ">
							  <el-option
							    key="item.value"
							    label="item.label"
							    value="item.value">
							  </el-option>
							</el-select>
						</el-form-item>
					</div>

					<div class="form_line">
						<el-form-item prop="comentarios" style="width:100%;">
							<el-input
							  type="textarea"
							  :rows="5"
							  placeholder="Comentarios"
							  v-model="formRFQ.comentarios">
							</el-input>
						</el-form-item>
					</div>
				</div>
				<div class="leftSideForm l_radiusBorder">
					<div class="form_line">
						<el-form-item prop="total_items" style="width:33%;">
							<div class="el_label">Total items</div>
							<el-input 
								placeholder="Total items"
								size="small"
								v-model="formRFQ.total_items" 
								:disabled="false">
							</el-input>
						</el-form-item>
						<el-form-item prop="cotizados" style="width:33%;">
							<div class="el_label">Cotizados</div>
							<el-input 
								placeholder="Cotizados"
								size="small"
								v-model="formRFQ.cotizados"  
								:disabled="false">
							</el-input>
						</el-form-item>
						<el-form-item prop="por_cotizar" style="width:33%;">
							<div class="el_label">Por cotizar</div>
							<el-input 
								placeholder="Por cotizar"
								size="small"
								v-model="formRFQ.por_cotizar" 
								:disabled="false">
							</el-input>
						</el-form-item>
					</div>
					<div class="form_line">
						<el-form-item prop="avance" style="width:50%;">
							<div class="el_label">% Avance</div>
							<el-input 
								placeholder="% Avance"
								size="small"
								v-model="formRFQ.avance" 
								:disabled="false">
							</el-input>
						</el-form-item>
						<el-form-item prop="rfi" style="width:50%;">
							<div class="el_label">RFI</div>
							<el-input 
								placeholder="RFI"
								size="small"
								v-model="formRFQ.rfi" 
								:disabled="false">
							</el-input>
						</el-form-item>
					</div>
					<div class="form_line">
						<el-form-item prop="total_cotizacion" style="width:50%;">
							<div class="el_label">Total $</div>
							<el-input 
								placeholder="Total $"
								size="small"
								v-model="formRFQ.total_cotizacion" 
								:disabled="false">
								<template slot="prepend">Total $</template>
							</el-input>
						</el-form-item>
						<el-form-item prop="otros_costos" style="width:50%;">
							<div class="el_label">Otros costos$</div>
							<el-input 
								placeholder="Otros costos"
								size="small"
								v-model="formRFQ.otros_costos" 
								:disabled="false">
							</el-input>
						</el-form-item>
					</div>
					<div class="form_line">
						<div style="width:50%; text-align: center;">
							<el-checkbox 
								v-model="formRFQ.proc_comercialCheck">Proceso de Comercial?
							</el-checkbox>
						</div>
						<div style="width:50%; text-align: center;">
							<el-button 
								size="small"
								type="primary" 
								icon="el-icon-plus">Agregar Comprador
							</el-button>
						</div>
					</div>
					<div class="form_line">
						<el-table
							empty-text="Nada para mostrar"
						  	:data="tableData"
						  	style="width: 100%; margin: 10px;">
							<el-table-column
								align     = "center"
								prop      = "date"
								label     = "Fecha"
								min-width = "30">
							</el-table-column>
							<el-table-column
								align     = "center"
								prop      = "name"
								label     = "Nombre"
								min-width = "30">
							</el-table-column>
							<el-table-column
								align     = "center"
								min-width = "30"
								prop      = "address"
								label     = "Dirección">
							</el-table-column>
						</el-table>
					</div>
				</div>
			</div>
		</el-form>

		<el-form ref="formularioEmpresas" :model="formEMP">
			<div class="form_line formEmpresas l_radiusBorder">
				<el-table
					empty-text="Aun no se ha agregado ninguna empresa"
				  	:data="tableData"
				  	style="width: 100%; margin: 10px;">
				  	<template slot="append">
				  		<div class="form_line">
				  			<el-form-item prop="empresa" style="width:25%;">
				  				<el-select 
				  					style="width:100%"
				  					size="small"
				  					v-model="formEMP.empresa" 
				  					clearable>
				  				  <el-option
				  				    key="item.value"
				  				    label="item.label"
				  				    value="item.value">
				  				  </el-option>
				  				</el-select>
				  			</el-form-item>

				  			<el-form-item prop="n_peticion" style="width:10%;">
				  				<el-input 
				  					size="small"
				  					v-model="formEMP.n_peticion" 
				  					:disabled="false">
				  				</el-input>
				  			</el-form-item>

				  			<el-form-item prop="profit" style="width:10%;">
				  				<el-input 
				  					size="small"
				  					v-model="formEMP.profit" 
				  					:disabled="false">
				  				</el-input>
				  			</el-form-item>

				  			<el-form-item prop="total_venta" style="width:10%;">
				  				<el-input 
				  					size="small"
				  					v-model="formEMP.total_venta" 
				  					:disabled="false">
				  				</el-input>
				  			</el-form-item>

				  			<div style="width:5%;">
				  				<div class="iconRow">
				  					<el-button 
				  						size="small"
				  						type="primary">
				  						<i class="el-icon-upload el-icon-right"></i>
				  					</el-button>
				  				</div>
				  			</div>

				  			<div style="width:5%;">
				  				<div class="iconRow">
				  					<el-button 
				  						size="small"
				  						type="primary">
				  						<i class="el-icon-upload el-icon-right"></i>
				  					</el-button>
				  				</div>
				  			</div>

				  			<el-form-item prop="total_venta" style="width:35%;">
				  				<el-input 
				  					size="small"
				  					v-model="formEMP.total_venta" 
				  					:disabled="false">
				  				</el-input>
				  			</el-form-item>
				  		</div>
				  	</template>
					<el-table-column
						align     = "center"
						prop      = "empresa"
						label     = "Empresa"
						min-width = "25">
					</el-table-column>
					<el-table-column
						align     = "center"
						prop      = "n_peticion"
						label     = "N Peticion"
						min-width = "10">
					</el-table-column>
					<el-table-column
						align     = "center"
						min-width = "10"
						prop      = "profit"
						label     = "% Profit">
					</el-table-column>
					<el-table-column
						align     = "center"
						prop      = "total_ventas"
						label     = "Total Ventas"
						min-width = "10">
					</el-table-column>
					<el-table-column
						align     = "center"
						prop      = "adjrfp"
						label     = "RFP"
						min-width = "5">
					</el-table-column>
					<el-table-column
						align     = "center"
						min-width = "5"
						prop      = "address"
						label     = "POC">
					</el-table-column>
					<el-table-column
						align     = "center"
						min-width = "35"
						prop      = "observaciones"
						label     = "Observaciones">
					</el-table-column>
				</el-table>
			</div>
		</el-form>
	</div>
</template>
<style lang="scss">
.RFQView{
	.el-table__empty-block {
	    display: none !important;	
	}
	.topSideForm{
		width: 100%;
		height: 40px;
		background-color: #EBEAEA;
		font-size: 1.9vw;
		color: #231F20;
		font-family: 'Roboto';
		display: flex;
		flex-direction: column;
		justify-content: center;
		font-style: bold;
	}
	.formContainer{
		display: flex;
		flex-direction: row;
		width: 100%;
		.rightSideForm{
			width: 60%;
    		background-color: #EBEAEA;
		}
		.leftSideForm{
			width: 40%;
			padding: 0 5px;
			background-color: #D0E7F3;
			.el-table{
				border-radius: 5px !important;
			}
		}
		.el-table td, .el-table th {
			font-size: 12px !important;
		    padding: 0px 0 !important;
		    min-width: 0;
		    -webkit-box-sizing: border-box;
		    box-sizing: border-box;
		    text-overflow: ellipsis;
		    vertical-align: middle;
		    position: relative;
		    text-align: left;
		}
		.el-table__header-wrapper{

		}
	}
	.formEmpresas{
    	background-color: #EBEAEA;
    	.el-table{
    		border-radius: 5px !important;
    	}
		.el-table td, .el-table th {
			font-size: 12px !important;
		    padding: 0px 0 !important;
		    min-width: 0;
		    -webkit-box-sizing: border-box;
		    box-sizing: border-box;
		    text-overflow: ellipsis;
		    vertical-align: middle;
		    position: relative;
		    text-align: left;
		}
	}
	.iconRow{
	    width: 100%;
	    padding-top: 5px;
	    text-align: center;
	}
	.el-form-item{
		margin-left: 5px;
		.el-input-group__append, .el-input-group__prepend {
			background-color : #f5f7fa;
			color            : #909399;
			vertical-align   : middle;
			display          : table-cell;
			position         : relative;
			border           : 1px solid #dcdfe6;
			border-radius    : 4px;
			padding          : 0 10px !important;
			width            : 1px;
			white-space      : nowrap;
		}
	}

}
.el_label{
  padding-top: 8px;
  padding-bottom: 0px;
  line-height: 1vw;
  font-size: 1vw;
  font-family: 'Source Sans Pro', sans-serif;
}
.form_line{
	display: flex;
	flex-direction: row;
	justify-content: center;
}
</style>
