var formularioRequisicion = {
	es: {
		fecha_emision : {
			label: 'Fecha de emision',
			placeholder: 'Fecha de emision',
			description: 'Coloque el día, mes y año en que se llena la requisición de material y/o equipo',
		},
		nro_solicitud : {
			label: 'Numero de solicitud',
			placeholder: 'Numero de solicitud',
			description: 'Coloque el número correlativo que mantiene usted como unidad solicitante',
		},
		proyecto : {
			label: 'Proyecto',
			placeholder: 'Proyecto',
			description: 'Se refiere al proyecto al cual sera destinado el uso o consumo de los items especificados en esta requisicion',
		},
		linea_servicio : {
			label: 'Linea de servicio',
			placeholder: 'Linea de servicio',
			placeholder: 'Linea de servicio',
		},
		subservicio : {
			label: 'Subservicio',
			description: '?',
		},
		sede : {
			label: 'Sede',
			placeholder: 'Sede',
			description: 'Este campo se refiere a la sede a donde seran destinados los items en la requisicion actual',
		},
		gerencia : {
			label: 'Gerencia/Area/Departamento',
			placeholder: 'Gerencia/Area/Departamento',
			description: 'Se refiere a la gerencia solicitante de los items en cuestion',
		},
		ceco : {
			label: 'Centro de costo',
			placeholder: 'Centro de costo',
			description: '?',
		},
		prioridad : {
			label: 'Prioridad',
			placeholder: 'Prioridad',
			description: 'Relativo al nivel de prioridad que requiere el procesamiento de este requerimiento',
		},	
		f_entrega : {
			label: 'Fecha estimada de entrega',
			placeholder: 'Fecha estimada de entrega',
			description: 'Es referente a la fecha estimada en la que este requerimiento debe ser entregado a la gerencia solicitante',
		},	
		m_compra : {
			label: 'Motivo de la compra',
			placeholder: 'Motivo de la compra',
			description: 'Se refiere a una breve descripcion del motivo y/o justificacion de necesidad de los items en cuestion',
		},
		p_acumplir : {
			label: 'Proceso a cumplir',
			placeholder: 'Proceso a cumplir',
			description: '?',
		},	
		d_entrega : {
			label: 'Direccion de entrega',
			placeholder: 'Referente a la direccion donde deben ser entregados los articulos en cuestion',
			description: '?',
		},			
	},
	rules : {
		m_compra: { 
         	required: true,
         	message: 'El '+'Motivo de la compra'+' no puede permanecer vacio, por favor seleccione un '+'Motivo de la compra',
         	trigger: 'change' 
       	},
		p_acumplir: { 
         	required: true,
         	message: 'El campo no puede permanecer vacio, por favor complete',
         	trigger: 'change' 
       	},
		d_entrega: { 
         	required: true,
         	message: 'El campo no puede permanecer vacio, por favor complete',
         	trigger: 'change' 
       	},
		f_entrega: { 
         	required: true,
         	message: 'La '+'Fecha estimada de entrega'+' no puede permanecer vacio, por favor seleccione una '+'Fecha estimada de entrega',
         	trigger: 'change' 
       	},
		prioridad: { 
			required: true,
			message: 'El campo es necesario, por favor complete',
			trigger: 'change' 
		},
		ceco: { 
			required: true,
			message: 'El campo es necesario, por favor complete',
			trigger: 'change' 
		},
		gerencia: { 
		 	required: true,
		 	message: 'El campo es necesario, por favor complete',
		 	trigger: 'change' 
		},
		sede: { 
			required: true,
			message: 'El campo es necesario, por favor complete',
			trigger: 'change' 
		},
		subservicio: { 
			required: true,
			message: 'El campo es necesario, por favor complete',
			trigger: 'change' 
		},
		linea_servicio: { 
			required: true,
			message: 'El campo es necesario, por favor complete',
			trigger: 'change' 
		},
		proyecto: { 
			required: true,
			message: 'El campo es necesario, por favor complete',
			trigger: 'change' 
		},
		nro_solicitud: { 
			trigger: 'change', 
			required: true,
			message: 'El campo es necesario, por favor complete'
		},
		fecha_emision: { 
			required: true,
			message: 'El campo es necesario, por favor complete',
			trigger: 'change' 
		}		
	},
}

var formularioItemsRequisicion = {
	es: {
		cantidad : {
			label: 'Cantidad',
			placeholder: 'Cantidad',
			description: 'Se refiere a la cantidad de items son requeridos',
		},
		nro_parte : {
			label: 'Nro de Parte',
			placeholder: 'Numero de parte',
			description: 'Si el item dispone de un numero de parte sera necesario especificarlo en este campo ya que esto determinara en gran medida que sea el articulo que realmente el se esta solicitando',
		},
		unidad : {
			label: 'Unidad',
			placeholder: 'Unidad',
			description: 'Es la unidad de medida que se usa para enumerar la cantidad del item en cuestion',
		},
		descripcion : {
			label: 'Descripcion',
			placeholder: 'Descripcion',
		},
		cod_material : {
			label: 'Cod. Material',
			placeholder: 'Codigo de material',
			description: 'Este campo se debe completar con el nombre, descripcion o caracteristicas utilizadas para referirse al item en cuestion',
		},
		cl_costo : {
			label: 'Clase de costo',
			placeholder: 'Clase de costo',
			description: '?',
		},
		apu : {
			label: 'APU',
			placeholder: 'APU',
			description: '?',
		},
		activo : {
			label: 'Activo',
			placeholder: 'Activo',
			description: '?',
		},
		consumible : {
			label: 'Consumible',
			placeholder: 'Consumible',
			description: '?',
		},
		stock : {
			label: 'Stock en almacen',
			placeholder: 'Stock en almacen',
			description: '?',
		},
		observaciones : {
			label: 'Observaciones',
			placeholder: 'Observaciones',
			description: 'Este campo se debe completar con alguna aclaratoria o comentario acerca del item en cuestion de ser necesario',
		},
	},
	rules : {
				cantidad: { 
		         	required: true,
		         	message: 'La cantidad debe ser un numero mayor a 0',
		         	trigger: 'change' 
		       	},
       			unidad: { 
       	         	required: true,
       	         	message: 'Debe especificar un tipo de unidad para el item',
       	         	trigger: 'change' 
       	       	},
       			nro_parte: { 
       	         	required: false,
       	         	message: 'Debe especificar un numero de parte',
       	         	trigger: 'change' 
       	       	},      
       			descripcion: { 
       	         	required: true,
       	         	message: 'Debe escribir una descripcion del item',
       	         	trigger: 'change' 
       	       	},  	  
       			cod_material: { 
       	         	required: false,
       	         	message: 'Debe escribir un codigo de material',
       	         	trigger: 'change' 
       	       	},       
       			apu: { 
       	         	required: false,
       	         	message: 'Debe escribir un codigo de material',
       	         	trigger: 'change' 
       	       	},       	
       			observaciones: { 
       	         	required: true,
       	         	message: 'Debe escribir una observacion sobre el item',
       	         	trigger: 'change' 
       	       	},           	       	       		       	     	
	},
}

var tablaProcesosProcura = {
	es: {
		pr : {
			label: 'PR',
			description: 'Identificador unico del proceso',
		},		
		descripcion : {
			label: 'Descripcion',
			description: 'Detalle de proceso',
		},
		proyecto : {
			label: 'Proyecto',
			description: 'Proyecto de proceso',
		},
		region : {
			label: 'Region',
			description: 'Region de ejecucion de proyecto',
		},
		date_rec_org_cli : {
			label: 'F. recibido original cliente',
			description: '?',
		},
		date_apr_solic_ger : {
			label: 'F. aprobada solicitud gerente',
			description: '?',
		},
		date_asig : {
			label: 'Fecha de asignacion',
			description: '?',
		},
		date_org_entrega : {
			label: 'Fecha original de entrega',
			description: '?',
		},
		date_ext : {
			label: 'Fecha extendida',
			description: '?',
		},
		date_fin_entrega : {
			label: 'Fecha final de entrega',
			description: '?',
		},
		date_env_tdc : {
			label: 'Fecha enviada tdc',
			description: '?',
		},
		total : {
			label: 'Total',
			description: '?',
		},
		cotizados : {
			label: 'Cotizados',
			description: '?',
		},
		porcentaje : {
			label: '%',
			description: '?',
		},
		rfi : {
			label: 'RFI',
			description: '?',
		},
		por_cotizar : {
			label: 'Por cotizar',
			description: '?',
		},
		tot_cotizacion : {
			label: 'Total cotizacion',
			description: '?',
		},
		compra : {
			label: 'Compra',
			description: '?',
		},
		pagado : {
			label: 'Pagado',
			description: '?',
		},
		entregado : {
			label: 'Entregado',
			description: '?',
		},
		comentarios : {
			label: 'Comentarios',
			description: '?',
		},
		lid_operacion : {
			label: 'Lider operacional',
			description: '?',
		},
		solicitante : {
			label: 'Solicitante',
			description: '?',
		},
	},
}

var formulariodeProyectos = {
	es: {
		n_proyecto : {
			label: 'Nombre del proyecto',
			placeholder: 'Nombre del proyecto',
			description: 'Es el nombre que identificara al proyecto en cuestión',
		},	
		status : {
			label: 'Status',
			placeholder: 'Status',
			description: 'Status actual del proyecto',
		},	
		participantes : {
			label: 'Participantes',
			placeholder: 'Participantes',
			description: 'Ingresa las personas involucradas en el desarrollo de este proyecto',
		},	
		responsable : {
			label: 'Responsable',
			placeholder: 'Responsable',
			description: 'Persona responsable o lider del proyecto',
		},
		presupuesto_absf : {
			label: 'Presupuesto',
			placeholder: 'Presupuesto',
			description: 'Presupuesto del proyecto en bolivares',
		},
		contacto : {
			label: 'Contacto',
			placeholder: 'Contacto',
			description: 'Contactos del proyecto',
		},
		presupuesto_busd : {
			label: 'Presupuesto',
			placeholder: 'Presupuesto',
			description: 'Presupuesto del proyecto en dolares',
		},
		empresa : {
			label: 'Empresa',
			placeholder: 'Empresa',
			description: 'Empresa involucrada en el proyecto',
		},
		precio_venta : {
			label: 'Precio de venta',
			placeholder: 'Precio de venta',
			description: 'Precio de venta del proyecto en bolivares',
		},
		zona : {
			label: 'Zona',
			placeholder: 'Zona',
			description: 'Zonas de desarrollo del proyecto',
		},
		precio_ventaUSD : {
			label: 'Precio de venta',
			placeholder: 'Precio de venta',
			description: 'Precio de venta del proyecto en dolares',
		},
		factibilidad : {
			label: 'Factibilidad',
			placeholder: 'Factibilidad',
			description: 'Factibilidad',
		},
		accion : {
			label: 'Accion',
			placeholder: 'Accion',
			description: 'Acciones por tomar con respecto al proyecto',
		},
		fecha_accion : {
			label: 'Fecha de accion',
			placeholder: 'Fecha de accion',
			description: 'Fecha de ejecucion de acciones pendientes del proyecto',
		},
		descripcion : {
			label: 'Descripcion',
			placeholder: 'Descripcion',
			description: 'Descripcion detallada del proyecto en cuestion',
		},
	},
	rules : {
		n_proyecto: { 
         	required: true,
         	message: 'El campo no puede quedar vacio, por favor complete el campo',
         	trigger: 'change' 
       	},	
		status: { 
         	required: true,
         	message: 'El campo no puede quedar vacio, por favor complete el campo',
         	trigger: 'change' 
       	},	
		empresa: { 
		 	required: true,
		 	message: 'El campo no puede quedar vacio, por favor complete el campo',
		 	trigger: 'change' 
		},
		precio_venta: { 
		 	required: true,
		 	message: 'El campo no puede quedar vacio, por favor complete el campo',
		 	trigger: 'change' 
		},
		precio_ventaUSD: { 
		 	required: true,
		 	message: 'El campo no puede quedar vacio, por favor complete el campo',
		 	trigger: 'change' 
		},
		zona: { 
		 	required: true,
		 	message: 'El campo no puede quedar vacio, por favor complete el campo',
		 	trigger: 'change' 
		},
		participantes: { 
         	required: true,
         	message: 'El campo no puede quedar vacio, por favor complete el campo',
         	trigger: 'change' 
       	},
		responsable: { 
         	required: true,
         	message: 'El campo no puede quedar vacio, por favor complete el campo',
         	trigger: 'change' 
       	},
		presupuesto_absf: { 
         	required: true,
         	message: 'El campo no puede quedar vacio, por favor complete el campo',
         	trigger: 'change' 
       	},
		contacto: { 
         	required: true,
         	message: 'El campo no puede quedar vacio, por favor complete el campo',
         	trigger: 'change' 
       	},
       	presupuesto_busd: { 
         	required: true,
         	message: 'El campo no puede quedar vacio, por favor complete el campo',
         	trigger: 'change' 
       	},
       	factibilidad: { 
         	required: true,
         	message: 'El campo no puede quedar vacio, por favor complete el campo',
         	trigger: 'change' 
       	},
   		accion: { 
	   	  	required: true,
	   	  	message: 'El campo no puede quedar vacio, por favor complete el campo',
	   	  	trigger: 'change' 
   		},
   		fecha_accion: { 
	   	  	required: true,
	   	  	message: 'El campo no puede quedar vacio, por favor complete el campo',
	   	  	trigger: 'change' 
   		},
   		descripcion: { 
	   	  	required: true,
	   	  	message: 'El campo no puede quedar vacio, por favor complete el campo',
	   	  	trigger: 'change' 
   		},
	},
}
export { 
	formularioRequisicion,
	formularioItemsRequisicion,
	formulariodeProyectos,
	tablaProcesosProcura};