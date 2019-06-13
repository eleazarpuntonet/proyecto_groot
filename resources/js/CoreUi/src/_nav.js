class menuItem{
  constructor(item,children){
    switch(arguments.length){
      case 1:
        this.name    = item.name
        this.url     = item.url
        this.icon    = item.icon
        this.authRol = item.authRol
        this.id_path = item.id_path
      break

      case 2:
        if (item.class) {
          this.class = item.class
        }
        this.id_path = item.id_path
        this.name = item.name
        this.url  = item.url
        this.icon = item.icon
        this.children = children
        this.authRol = item.authRol
      break
    }
  }

  getRoles(){
    return this.authRol
  }


}

class menuBadge extends menuItem{
  constructor(item){
    super(item)
    this.badge = {
      variant: item.badgevariant,
      text: item.badgetext
    }
  }
}

class titleItem{
  constructor(item){
    this.title = true
    this.name = item.name
    this.wrapper = {
      element: null,
      attributes: {}
    }
    item.hasOwnProperty('class')? this.class = item.class : this.class= null
    item.hasOwnProperty('wrapel')? this.wrapper.element = item.wrapel:this.wrapper.element = null
    item.hasOwnProperty('wrapat')? this.wrapper.attributes = item.wrapat:this.wrapper.attributes = null
  }
}

var themeTitle = new titleItem({
  name : "Reservas",
  class: '',
  wrapel: '',
  wrapat: ''
})//TITULO

var panelPrincipal = new menuBadge({
  name: 'Panel Principal', 
  url:'/dashboard',
  icon: 'icon-speedometer',
  badgevariant: 'primary',
  // badgetext:'Nuevo'
})

// var colors = new menuItem({
//       name: 'Colors',
//       url: '/theme/colors',
//       icon: 'icon-drop'
//     })

// var typhography = new menuItem({
//       name: 'Typography',
//       url: '/theme/typography',
//       icon: 'icon-pencil'
//     })


// id_path: 'reserv001m',
// id_path: 'reserv002i',
// id_path: 'reserv003i',
// id_path: 'reserv004i',


var s_reserva = new menuItem({
      id_path: 'reserv002i',
      name: 'Solicitud de Reserva',
      url: '/reservas/nueva_reserva',
      icon: 'icon-pencil',
      class: 'nav-item',
      authRol: ['superadmin','public'],
    })

var index_reservas = new menuItem({
      id_path: 'reserv003i',
      name: 'Indice de Reservas',
      url: '/reservas/listado_reservas',
      icon: 'icon-pencil',
      class: 'nav-item',
      authRol: ['superadmin','public'],
    })

var trasladositem = new menuItem({
      id_path: 'reserv004i',
      name: 'Traslados',
      url: '/reservas/traslados',
      icon: 'icon-pencil',
      class: 'nav-item',
      authRol: ['superadmin','public'],
    })

var items_Reservas = new menuItem({
      id_path: 'reserv001m',
      name: 'Reservas',
      url: '/reservas',
      icon: 'icon-control-play',
      class: 'nav-item',
      authRol: []
    },[
        s_reserva,
        index_reservas,
        trasladositem,
      ])

// id_path:'rrhh002i',
// id_path:'rrhh001m',
var empleados = new menuItem({
      id_path:'rrhh002i',
      name: 'Empleados',
      url: '/usuarios/i_empleados',
      icon: 'icon-pencil',
      class: 'nav-item',
      authRol: ['superadmin','public'],
    })

var gestionUsuario = new menuItem({
      id_path:'rrhh001m',
      name: 'Talento Humano',
      url: '/usuarios',
      icon: 'icon-control-play',
      class: 'nav-item',
      authRol: []
    },[
        empleados,
      ])

// id_path: 'dataload005i',
// id_path: 'dataload004i',
// id_path: 'dataload003i',
// id_path: 'dataload002i',
// id_path: 'dataload001m',
var permisologia = new menuItem({
      id_path: 'dataload006i',
      name: 'Permisos',
      url: '/c_datos/permisos',
      icon: 'icon-pencil',
      class: 'nav-item',
      authRol: ['superadmin','public'],
    })

var n_depto = new menuItem({
      id_path: 'dataload005i',
      name: 'Gerencias',
      url: '/c_datos/gerencias',
      icon: 'icon-pencil',
      class: 'nav-item',
      authRol: ['superadmin','public'],
    })

var n_proveedor = new menuItem({
      id_path: 'dataload004i',
      name: 'Proveedores',
      url: '/c_datos/proveedores',
      icon: 'icon-pencil',
      class: 'nav-item',
      authRol: ['superadmin','public'],
    })

var n_role = new menuItem({
      id_path: 'dataload003i',
      name: 'Roles',
      url: '/c_datos/roles',
      icon: 'icon-pencil',
      class: 'nav-item',
      authRol: ['superadmin','public'],
    })

var n_usuario = new menuItem({
      id_path: 'dataload002i',
      name: 'Usuarios',
      url: '/c_datos/usuarios',
      icon: 'icon-pencil',
      class: 'nav-item',
      authRol: ['superadmin','public'],
    })
var cargaDatos = new menuItem({
      id_path: 'dataload001m',
      name: 'Carga de Datos',
      url: '/c_datos',
      icon: 'icon-control-play',
      class: 'nav-item',
      authRol: []
    },[
        n_depto,
        n_proveedor,
        n_role,
        n_usuario,
        permisologia,
      ])

var rfq = new menuItem({
      id_path: 'procura002i',
      name: 'RFQ',
      url: '/procura/rfq',
      icon: 'icon-pencil',
      class: 'nav-item',
      authRol: ['superadmin','public'],
    })
var proProveedores = new menuItem({
      id_path: 'procura003i',
      name: 'Proveedores',
      url: '/procura/proveedores',
      icon: 'icon-pencil',
      class: 'nav-item',
      authRol: ['superadmin','public'],
    })
var proClientes = new menuItem({
      id_path: 'procura004i',
      name: 'Clientes',
      url: '/procura/clientes',
      icon: 'icon-pencil',
      class: 'nav-item',
      authRol: ['superadmin','public'],
    })
var proProyectos = new menuItem({
      id_path: 'procura005i',
      name: 'Proyectos',
      url: '/procura/proyectos',
      icon: 'icon-pencil',
      class: 'nav-item',
      authRol: ['superadmin','public'],
    })
var proRequisicion = new menuItem({
      id_path: 'procura006i',
      name: 'Requisicion',
      url: '/procura/requisicion',
      icon: 'icon-pencil',
      class: 'nav-item',
      authRol: ['superadmin','public'],
    })
var landingProcura = new menuItem({
      id_path: 'procura007i',
      name: 'Procesos de procura',
      url: '/procura/landing',
      icon: 'icon-pencil',
      class: 'nav-item',
      authRol: ['superadmin','public'],
    })
var procura = new menuItem({
      id_path: 'procura001m',
      name: 'Procura',
      url: '/procura',
      icon: 'icon-control-play',
      class: 'nav-item',
      authRol: []
    },[
        proProyectos,
        proRequisicion,
        rfq,
        proProveedores,
        proClientes,
        landingProcura,
      ])
export default {
  items: [
    panelPrincipal,
    themeTitle,
    items_Reservas,
    gestionUsuario,
    cargaDatos,
    procura,
    // {
    //   divider: true
    // },
    // {
    //   title: true,
    //   name: 'Extras'
    // },
  ]
}
