import Vue from 'vue'
import VueRouter from 'vue-router'
import VueCtkDateTimePicker from 'vue-ctk-date-time-picker';
import 'vue-ctk-date-time-picker/dist/vue-ctk-date-time-picker.min.css';
// import bearer    from '@websanova/vue-auth/drivers/auth/bearer'
// import axios     from '@websanova/vue-auth/drivers/http/axios.1.x'
// import routers    from '@websanova/vue-auth/drivers/router/vue-router.2.x'

// Containers
import DefaultContainer from '../containers/DefaultContainer.vue'

// Views
import Dashboard        from '../views/Dashboard.vue'
import Colors           from '../views/theme/Colors.vue'
import Typography       from '../views/theme/Typography'
import Charts           from '../views/Charts'
import Widgets          from '../views/Widgets'

// Views - Components
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

// Views - Buttons
import StandardButtons  from '../views/buttons/StandardButtons'
import ButtonGroups     from '../views/buttons/ButtonGroups'
import Dropdowns        from '../views/buttons/Dropdowns'
import BrandButtons     from '../views/buttons/BrandButtons'

// Views - Icons
import Flags            from '../views/icons/Flags'
import FontAwesome      from '../views/icons/FontAwesome'
import SimpleLineIcons  from '../views/icons/SimpleLineIcons'
import CoreUIIcons      from '../views/icons/CoreUIIcons'

// Views - Notifications
import Alerts           from '../views/notifications/Alerts'
import Badges           from '../views/notifications/Badges'
import Modals           from '../views/notifications/Modals'

// Views - Pages
import Page404          from '../views/pages/Page404'
import Page500          from '../views/pages/Page500'
import Login            from '../views/pages/Login'
import Register         from '../views/pages/Register'

// Users
import Users            from '../views/users/Users'
import User             from '../views/users/User'

//Tablas Editadas
import   TableProveedores  from '../../../resources/js/components/corecomponents/tables/prov_table'
import   TableCredenciales from '../../../resources/js/components/corecomponents/tables/cred_table'
import   TableSites        from '../../../resources/js/components/corecomponents/tables/sites_table'
import   TableFacturacion  from '../../../resources/js/components/corecomponents/tables/fact_table'
import   TablaProveedores         from '../../../resources/js/components/provTable'
import   ReservasFormulario         from '../../../resources/js/components/formularioDeReservas'
Vue.use(VueRouter)

import {VueAuthenticate} from 'vue-authenticate'

var formularioReservas = {
      path: 'reservar',
      name: 'Reservas',
      component: ReservasFormulario,
      meta     : {
        auth: true,
        roles: [
          {
            userRol : 'tester',
            lock : true,
          },
          {
            userRol : 'admin',
            lock : true,
          }
        ]
      },
    }

export default new VueRouter({
  mode: 'history', // https://router.vuejs.org/api/#mode
  linkActiveClass: 'open active',
  scrollBehavior: () => ({ y: 0 }),
  routes: 
  [
    {
      path: '/login',
      name: 'Login',
      component: Login,
      meta     : {
        auth: false,
      },
    },
    {
      path: '/register',
      name: 'Register',
      component: Register,
      meta     : {
        auth: false,
      },
    },
    {
      path: '/',
      redirect: '/dashboard',
      name: 'Home',
      component: DefaultContainer,
      meta     : {
        auth: false,

      },
      children: [
        {//IT datatables
          path      : 'credenciales',
          redirect  : '/credenciales/proveedores',
          name      : 'Credenciales',
          component : {
            render (c) { return c('router-view') }
          },
          meta     : {
            auth: true,
            roles: [
              // {
              //   userRol : 'tester',
              //   lock : true,
              // },
              {
                userRol : 'admin',
                lock : true,
              }
            ]
          },
          children: [
            {
              path      : 'proveedores',
              name      : 'Proveedores',
              component : TablaProveedores,
              meta     : {
                auth: true,
                roles: [
                  // {
                  //   userRol : 'tester',
                  //   lock : true,
                  // },
                  {
                    userRol : 'admin',
                    lock : true,
                  }
                ]
              },
            },
            {
              path         : 'accesos',
              name         : 'Accesos',
              component : TablaProveedores,
              meta     : {
                auth: true,
                roles: [
                  {
                    userRol : 'admin',
                    lock : true,
                  }
                ]
              },
            },
            {//Colors
              path         : 'facturacion',
              name         : 'Facturacion',
              component : TableFacturacion
            },
            {
              path         : 'sitios',
              name         : 'Sitios',
              component : TableSites
            },            
          ]
        },
        { //Dashboard
          path: 'dashboard',
          name: 'Dashboard',
          component: Dashboard,
          meta     : {
            auth: false,
          },
        },
        formularioReservas,
      ]
    },
    {
      path: '/pages',
      redirect: '/pages/404',
      name: 'Pages',
      component: {
        render (c) { return c('router-view') }
      },
      children: [
        {
          path: '404',
          name: 'Page404',
          component: Page404
        },
        {
          path: '500',
          name: 'Page500',
          component: Page500
        },
      ]
    }
  ]
})
