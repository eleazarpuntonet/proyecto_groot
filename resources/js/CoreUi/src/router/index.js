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

//    Users
import Users            from '../views/users/Users'
import User             from '../views/users/User'
import nueva_reserva    from '../../../components/formularioDeReservas'
import index_Reservas    from '../../../components/indexReservas'
import detalle_Reserva    from '../../../components/detalleReservas'
import perfilDeUsuario    from '../../../components/userProfile'

Vue.use(Router)

class Route_item{
  constructor(item,children){

    switch(arguments.length){
      case 1:
        this.path = item.path
        this.name = item.name
        this.component = item.comp
      break
      case 2:
        this.path = item.path
        this.name = item.name
        this.component = item.comp
        this.children = children
        this.redirect = item.redir
        this.component = {
            render (c) { return c('router-view') }
          }
      break
    }

    this.meta = {
      requiresAuth: false,
      roles: []
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

var Colors_route = new Route_item({
    path:'colors',
    name:'Colors',
    comp: Colors,
  })

var Typography_route = new Route_item({
    path:'typography',
    name:'Typography',
    comp: Typography,
  })
Typography_route.changeAuth(true,['admin'])

var Theme_route = new Route_item({
    path:'theme',
    name:'Theme',
    redir: '/theme/colors'
  },[Colors_route,Typography_route])



var MenuReservas = new Route_item({
    path:'reservas',
    name:'Reservas',
    redir: '/reservas/nueva_reserva'
  },[
      new Route_item({
          path:'nueva_reserva',
          name:'Nueva Reserva',
          comp: nueva_reserva,
        }),
      new Route_item({
          path:'listado_reservas',
          name:'Indice de Reservas',
          comp: index_Reservas,
        }),
      new Route_item({
          path:':id_reserva',
          name:'detalleReservas',
          comp: detalle_Reserva,
        }),
      ])

export default new Router({
  mode: 'history', // https://router.vuejs.org/api/#mode
  linkActiveClass: 'open active',
  scrollBehavior: () => ({ y: 0 }),
  routes: [
    login,
    register,
    {
      path: '/',
      redirect: '/dashboard',
      name: 'Home',
      component: DefaultContainer,
      children: [
        perfilUser,
        panelHome,
        Theme_route,
        MenuReservas,
        perfilUser,
        
      ]
    },
  ]
})

/*
* EJEMPLO DE RUTAS OBSOLETAS
*/
// {
//   path: 'base',
//   redirect: '/base/cards',
//   name: 'Base',
//   component: {
//     render (c) { return c('router-view') }
//   },
//   children: [
//     {
//       path: 'cards',
//       name: 'Cards',
//       component: Cards
//     },
//     {
//       path: 'forms',
//       name: 'Forms',
//       component: Forms
//     }
//   ]
// },