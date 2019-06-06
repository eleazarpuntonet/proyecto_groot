var formularioRequisicion = {
	es: {
		fecha_emision : {
			label: 'Fecha de emision',
			placeholder: 'Fecha de emision',
			description: 'Este campo contiene la fecha en la cual se hizo la requisicion en cuestion, el campo es completado por el sistema automaticamente',
		},
		nro_solicitud : {
			label: 'Numero de solicitud',
			placeholder: 'Numero de solicitud',
			description: 'Se refiere a la nomenclatura con la cual sera identificada esta requisicion en especifico, este campo es asignado por el sistema automaticamente',
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
export { 
	formularioRequisicion,
	formularioItemsRequisicion};