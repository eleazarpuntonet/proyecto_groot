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

Vue.use(Router)

function componentRoute(path,name,component){
  this.path      = path
  this.name      = name
  this.component = component
  this.children  = []
  this.redirect = ''

  this.meta      = {
    requiresAuth: false,
    roles: []
  }

  this.addChildren = (children)=>{
    this.children.push(children)
  }

  this.addRoles = (rol)=>{
    this.meta.roles.push(rol)
  }

  this.changeAuth = (val,roles)=>{
    this.meta.requiresAuth = val
    if (Array.isArray(roles)) {
      for (var i = roles.length - 1; i >= 0; i--) {
        this.addRoles(roles[i])
      }
    }
  }

  this.redirectTo = (redirectTo)=>{
    this.redirect = redirectTo
    this.component = {
            render (c) { return c('router-view') }
          }
  }
}





var login      = new componentRoute('/login','Login',Login)
var register   = new componentRoute('/register','Register',Register)
var dashboard  = new componentRoute('dashboard','Dashboard',Dashboard)
dashboard.changeAuth(true,['public'])

var colors     = new componentRoute('colors','Colors',Colors)
colors.changeAuth(true,['admin','tester'])

var typography = new componentRoute('typography','Typography',Typography)
typography.changeAuth(true,['admin'])

var theme      = new componentRoute('theme','Theme')
theme.children = [colors,typography]
theme.changeAuth(true,['admin'])
theme.redirectTo('/theme/colors')

var reservas = new componentRoute('reservas','Reservas')
var s_reservas = new componentRoute('nueva_reserva','Nueva reserva',)
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
        dashboard,
        theme,
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