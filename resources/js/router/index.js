import Vue from 'vue'
import Router from 'vue-router'

// Containers
// import DefaultContainer from '../containers/DefaultContainer'


// Views
import Dashboard        from 'resources/js/views/Dashboard.vue'
import Colors           from '../views/theme/Colors'
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



// Containers
// const DefaultContainer = () => require('resources/js/views/Dashboard.vue')

// // Views
// const Dashboard        = () => require('@/views/Dashboard')

// const Colors           = () => require('@/views/theme/Colors')
// const Typography       = () => require('@/views/theme/Typography')

// const Charts           = () => require('@/views/Charts')
// const Widgets          = () => require('@/views/Widgets')

// // Views - Components
// const Cards            = () => require('@/views/base/Cards')
// const Forms            = () => require('@/views/base/Forms')
// const Switches         = () => require('@/views/base/Switches')
// const Tables           = () => require('@/views/base/Tables')
// const Tabs             = () => require('@/views/base/Tabs')
// const Breadcrumbs      = () => require('@/views/base/Breadcrumbs')
// const Carousels        = () => require('@/views/base/Carousels')
// const Collapses        = () => require('@/views/base/Collapses')
// const Jumbotrons       = () => require('@/views/base/Jumbotrons')
// const ListGroups       = () => require('@/views/base/ListGroups')
// const Navs             = () => require('@/views/base/Navs')
// const Navbars          = () => require('@/views/base/Navbars')
// const Paginations      = () => require('@/views/base/Paginations')
// const Popovers         = () => require('@/views/base/Popovers')
// const ProgressBars     = () => require('@/views/base/ProgressBars')
// const Tooltips         = () => require('@/views/base/Tooltips')

// // Views - Buttons
// const StandardButtons  = () => require('@/views/buttons/StandardButtons')
// const ButtonGroups     = () => require('@/views/buttons/ButtonGroups')
// const Dropdowns        = () => require('@/views/buttons/Dropdowns')
// const BrandButtons     = () => require('@/views/buttons/BrandButtons')

// // Views - Icons
// const Flags            = () => require('@/views/icons/Flags')
// const FontAwesome      = () => require('@/views/icons/FontAwesome')
// const SimpleLineIcons  = () => require('@/views/icons/SimpleLineIcons')
// const CoreUIIcons      = () => require('@/views/icons/CoreUIIcons')

// // Views - Notifications
// const Alerts           = () => require('@/views/notifications/Alerts')
// const Badges           = () => require('@/views/notifications/Badges')
// const Modals           = () => require('@/views/notifications/Modals')

// // Views - Pages
// const Page404          = () => require('@/views/pages/Page404')
// const Page500          = () => require('@/views/pages/Page500')
// const Login            = () => require('@/views/pages/Login')
// const Register         = () => require('@/views/pages/Register')

// // Users
// const Users            = () => require('@/views/users/Users')
// const User             = () => require('@/views/users/User')



Vue.use(Router)

export default new Router({
  mode: 'hash', // https://router.vuejs.org/api/#mode
  linkActiveClass: 'open active',
  scrollBehavior: () => ({ y: 0 }),
  routes: [
    {
      path: '/',
      redirect: '/dashboard',
      name: 'Home',
      component: DefaultContainer,
      children: [
        {
          path: 'dashboard',
          name: 'Dashboard',
          component: Dashboard
        },
        {
          path: 'theme',
          redirect: '/theme/colors',
          name: 'Theme',
          component: {
            render (c) { return c('router-view') }
          },
          children: [
            {
              path: 'colors',
              name: 'Colors',
              component: Colors
            },
            {
              path: 'typography',
              name: 'Typography',
              component: Typography
            }
          ]
        },
        {
          path: 'charts',
          name: 'Charts',
          component: Charts
        },
        {
          path: 'widgets',
          name: 'Widgets',
          component: Widgets
        },
        {
          path: 'users',
          meta: { label: 'Users'},
          component: {
            render (c) { return c('router-view') }
          },
          children: [
            {
              path: '',
              component: Users,
            },
            {
              path: ':id',
              meta: { label: 'User Details'},
              name: 'User',
              component: User,
            },
          ]
        },
        {
          path: 'base',
          redirect: '/base/cards',
          name: 'Base',
          component: {
            render (c) { return c('router-view') }
          },
          children: [
            {
              path: 'cards',
              name: 'Cards',
              component: Cards
            },
            {
              path: 'forms',
              name: 'Forms',
              component: Forms
            },
            {
              path: 'switches',
              name: 'Switches',
              component: Switches
            },
            {
              path: 'tables',
              name: 'Tables',
              component: Tables
            },
            {
              path: 'tabs',
              name: 'Tabs',
              component: Tabs
            },
            {
              path: 'breadcrumbs',
              name: 'Breadcrumbs',
              component: Breadcrumbs
            },
            {
              path: 'carousels',
              name: 'Carousels',
              component: Carousels
            },
            {
              path: 'collapses',
              name: 'Collapses',
              component: Collapses
            },
            {
              path: 'jumbotrons',
              name: 'Jumbotrons',
              component: Jumbotrons
            },
            {
              path: 'list-groups',
              name: 'List Groups',
              component: ListGroups
            },
            {
              path: 'navs',
              name: 'Navs',
              component: Navs
            },
            {
              path: 'navbars',
              name: 'Navbars',
              component: Navbars
            },
            {
              path: 'paginations',
              name: 'Paginations',
              component: Paginations
            },
            {
              path: 'popovers',
              name: 'Popovers',
              component: Popovers
            },
            {
              path: 'progress-bars',
              name: 'Progress Bars',
              component: ProgressBars
            },
            {
              path: 'tooltips',
              name: 'Tooltips',
              component: Tooltips
            }
          ]
        },
        {
          path: 'buttons',
          redirect: '/buttons/standard-buttons',
          name: 'Buttons',
          component: {
            render (c) { return c('router-view') }
          },
          children: [
            {
              path: 'standard-buttons',
              name: 'Standard Buttons',
              component: StandardButtons
            },
            {
              path: 'button-groups',
              name: 'Button Groups',
              component: ButtonGroups
            },
            {
              path: 'dropdowns',
              name: 'Dropdowns',
              component: Dropdowns
            },
            {
              path: 'brand-buttons',
              name: 'Brand Buttons',
              component: BrandButtons
            }
          ]
        },
        {
          path: 'icons',
          redirect: '/icons/font-awesome',
          name: 'Icons',
          component: {
            render (c) { return c('router-view') }
          },
          children: [
            {
              path: 'coreui-icons',
              name: 'CoreUI Icons',
              component: CoreUIIcons
            },
            {
              path: 'flags',
              name: 'Flags',
              component: Flags
            },
            {
              path: 'font-awesome',
              name: 'Font Awesome',
              component: FontAwesome
            },
            {
              path: 'simple-line-icons',
              name: 'Simple Line Icons',
              component: SimpleLineIcons
            }
          ]
        },
        {
          path: 'notifications',
          redirect: '/notifications/alerts',
          name: 'Notifications',
          component: {
            render (c) { return c('router-view') }
          },
          children: [
            {
              path: 'alerts',
              name: 'Alerts',
              component: Alerts
            },
            {
              path: 'badges',
              name: 'Badges',
              component: Badges
            },
            {
              path: 'modals',
              name: 'Modals',
              component: Modals
            }
          ]
        }
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
        {
          path: 'login',
          name: 'Login',
          component: Login
        },
        {
          path: 'register',
          name: 'Register',
          component: Register
        }
      ]
    }
  ]
})
