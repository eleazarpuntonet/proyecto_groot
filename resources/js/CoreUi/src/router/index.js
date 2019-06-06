import Vue from 'vue'
import Router from 'vue-router'

//    Containers
import DefaultContainer from '../containers/DefaultContainer'

//    Views
import Dashboard        from '../views/Dashboard'

import Colors           from '../views/theme/Colors'
import Typography       from '../views/theme/Typography'

import Charts           from '../views/Charts'
import Widgets          from '../views/Widgets'

//    Views            - Components
import Cards            from '../views/base/Cards'
import Forms            from '../views/base/Forms'
import Switches         from '../views/base/Switches'
import Tables           from '../views/base/Tables'
import Tabs             from '../views/base/Tabs'
import Breadcrumbs      from '../views/base/Breadcrumbs'
import Carousels        from '../views/base/Carousels'
import Collapses        from '../views/base/Collapses'
import Jumbotrons       from '../views/base/Jumbotrons'
import ListGroups       from '../views/base/ListGroups'
import Navs             from '../views/base/Navs'
import Navbars          from '../views/base/Navbars'
import Paginations      from '../views/base/Paginations'
import Popovers         from '../views/base/Popovers'
import ProgressBars     from '../views/base/ProgressBars'
import Tooltips         from '../views/base/Tooltips'

//    Views            - Buttons
import StandardButtons  from '../views/buttons/StandardButtons'
import ButtonGroups     from '../views/buttons/ButtonGroups'
import Dropdowns        from '../views/buttons/Dropdowns'
import BrandButtons     from '../views/buttons/BrandButtons'

//    Views            - Icons
import Flags            from '../views/icons/Flags'
import FontAwesome      from '../views/icons/FontAwesome'
import SimpleLineIcons  from '../views/icons/SimpleLineIcons'
import CoreUIIcons      from '../views/icons/CoreUIIcons'

//    Views            - Notifications
import Alerts           from '../views/notifications/Alerts'
import Badges           from '../views/notifications/Badges'
import Modals           from '../views/notifications/Modals'

//    Views            - Pages
import Page404          from '../views/pages/Page404'
import Page500          from '../views/pages/Page500'
import Login            from '../views/pages/Login'
import Register         from '../views/pages/Register'
import Verify         from '../views/pages/Verify'


//    Users
import Users             from '../views/users/Users'
import User              from '../views/users/User'
import nueva_reserva     from '../../../components/formularioDeReservas'
import index_Reservas    from '../../../components/indexReservas'
import indexEmpleados    from '../../../components/indexEmpleados'
import gestion_usuarios  from '../../../components/gestion_usuarios'
import detalle_Reserva   from '../../../components/detalleReservas'
import perfilDeUsuario   from '../../../components/userProfile'
import traslados_reserva from '../../../components/trasladosForm'
import cargaProveedores  from '../../../components/carga_proveedores'
import cargaUsuarios     from '../../../components/carga_usuarios'
import cargaRoles        from '../../../components/carga_roles'
import cargaGerencias    from '../../../components/carga_gerencia'
import permisos    from '../../../components/panelPermisos'
import rfq from '../../../components/procuraRfq'
import proProveedores from '../../../components/procuraProveedores'
import proClientes from '../../../components/procuraClientes'
import proProyectos from '../../../components/procuraProyectos'
import proRequisicion from '../../../components/formularioRequisicion'


Vue.use(Router)
class Route_item{
  constructor(item,children){
    this.path = item.path
    this.name = item.name
    this.component = item.comp
    this.meta = {
      requiresAuth: false,
      roles: []
    }
    item.router_id ? this.meta.router_id=item.router_id : this.meta.router_id='n/a' 
    if (arguments.length == 2) {
      this.children = children
      this.redirect = item.redir
      this.component = {
          render (c) { return c('router-view') }
        }
    }     
  }

  addRole(rol){
    this.meta.roles.push(rol)
  }

  addRoles(roles){
    if (Array.isArray(roles)) {
      for (var i = roles.length - 1; i >= 0; i--) {
        this.addRole(roles[i])
      }
    } else this.addRole(roles)
  }

  changeAuth(val,roles){
    this.meta.requiresAuth = val
    this.addRoles(roles)
  }
}

var perfilUser = new Route_item({
    path:'perfil_usuario',
    name:'Usuario',
    comp: perfilDeUsuario,
  })

var register = new Route_item({
    path:'/register',
    name:'Register',
    comp: Register,
  })

var verifyc = new Route_item({
    path:'/verify/:verifycode',
    name:'Verify',
    comp: Verify,
    props: true,
  })

var login = new Route_item({
    path:'/login',
    name:'Login',
    comp: Login,
  })

var panelHome = new Route_item({
    path:'dashboard',
    name:'Dashboard',
    comp: Dashboard,
  })
panelHome.changeAuth(true,['public'])

var rolesreservas = ['public']
var traslados = new Route_item({
  router_id : 'reserv004i',
  path:'traslados',
  name:'Traslados',
  comp: traslados_reserva,
  })
traslados.changeAuth(true,rolesreservas)
var nreserva = new Route_item({
  router_id : 'reserv002i',
  path      : 'nueva_reserva',
  name      : 'Nueva Reserva',
  comp      : nueva_reserva,
  })  
nreserva.changeAuth(true,rolesreservas)
var inreserva = new Route_item({
  router_id : 'reserv003i',
  path:'listado_reservas',
  name:'Indice de Reservas',
  comp: index_Reservas,
  })  
inreserva.changeAuth(true,rolesreservas)
var detreserva = new Route_item({
  router_id : 'reserv005i',
  path:':id_reserva',
  name:'Detalle de Reserva',
  comp: detalle_Reserva,
  })  
detreserva.changeAuth(true,rolesreservas)


var MenuReservas = new Route_item({
    router_id : 'reserv001m',
    path:'reservas',
    name:'Reservas',
    redir: '/reservas/listado_reservas'
  },[
      traslados,
      nreserva,
      inreserva,
      detreserva,
    ])

var rolesusuarios = ['public']

var i_empleados = new Route_item({
  router_id : 'rrhh001m',
  path:'i_empleados',
  name:'Indice de Empleados',
  comp: indexEmpleados,
  })  
i_empleados.changeAuth(true,rolesusuarios)

var MenuRRHH = new Route_item({
    router_id : 'rrhh002i',
    path:'usuarios',
    name:'GestionUsuario',
    redir: '/usuarios/g_usuario'
  },[
     i_empleados,
    ])

//Marcador
var rolescargaDatos = ['public']
var cargaDeUsuarios = new Route_item({
  router_id : 'dataload002i',
  path:'usuarios',
  name:'Carga de Empleados',
  comp: cargaUsuarios,
  })  
cargaDeUsuarios.changeAuth(true,rolescargaDatos)

var cargaDeProveedores = new Route_item({
  router_id : 'dataload004i',
  path:'proveedores',
  name:'Carga de Proveedores',
  comp: cargaProveedores,
  })  
cargaDeProveedores.changeAuth(true,rolescargaDatos)

var cargaDeGerencias = new Route_item({
  router_id : 'dataload005i',
  path:'gerencias',
  name:'Carga de Gerencias',
  comp: cargaGerencias,
  })  
cargaDeGerencias.changeAuth(true,rolescargaDatos)

var cargaDeRoles = new Route_item({
  router_id : 'dataload003i',
  path:'roles',
  name:'Carga de Roles',
  comp: cargaRoles,
  })  
cargaDeRoles.changeAuth(true,rolescargaDatos)

var Permisologia = new Route_item({
  router_id : 'dataload006i',
  path:'permisos',
  name:'Permisos',
  comp: permisos,
  })  
Permisologia.changeAuth(true,rolescargaDatos)

var cargaDeDatos = new Route_item({
    router_id : 'dataload001m',
    path:'c_datos',
    name:'Carga de Datos',
    redir: '/c_datos/usuarios'
  },[
     cargaDeUsuarios,
     cargaDeProveedores,
     cargaDeGerencias,
     cargaDeRoles,
     Permisologia,
    ])

var rfqForm = new Route_item({
  router_id : 'procura002i',
  path:'rfq',
  name:'rfq',
  comp: rfq,
  })  
rfqForm.changeAuth(true,rolescargaDatos)

var procProveedores = new Route_item({
  router_id : 'procura003i',
  path:'proveedores',
  name:'Proveedores',
  comp: proProveedores,
  })  
procProveedores.changeAuth(true,rolescargaDatos)

var procClientes = new Route_item({
  router_id : 'procura004i',
  path:'clientes',
  name:'Clientes',
  comp: proClientes,
  })  
procClientes.changeAuth(true,rolescargaDatos)

var procProyectos = new Route_item({
  router_id : 'procura005i',
  path:'proyectos',
  name:'Proyectos',
  comp: proProyectos,
  })  
procProyectos.changeAuth(true,rolescargaDatos)

var procRequisicion = new Route_item({
  router_id : 'procura006i',
  path:'requisicion',
  name:'Requisicion',
  comp: proRequisicion,
  })  
procRequisicion.changeAuth(true,rolescargaDatos)

var procura = new Route_item({
    router_id : 'procura001m',
    path:'procura',
    name:'Procura',
    redir: '/procura/rfq'
  },[
     rfqForm,
     procProveedores,
     procClientes,
     procProyectos,
     procRequisicion
    ])

export default new Router({
  mode: 'history', // https://router.vuejs.org/api/#mode
  linkActiveClass: 'open active',
  scrollBehavior: () => ({ y: 0 }),
  routes: [
    login,
    register,
    verifyc,
    {
      path: '/',
      redirect: '/dashboard',
      name: 'Home',
      component: DefaultContainer,
      children: [
        procura,
        cargaDeDatos,
        MenuRRHH,
        perfilUser,
        panelHome,
        MenuReservas,
      ]
    },
  ]
})
