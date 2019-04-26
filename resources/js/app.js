require('./bootstrap');
window.axios = require('axios')
window.Vue = require('vue')
window.axios.defaults.headers.common = {
    'X-Requested-With' : 'XMLHttpRequest',
    'Access-Control-Allow-Origin' : '*',
    'Access-Control-Allow-Methods' : 'GET, POST, PUT, DELETE, OPTIONS',
    'X-CSRF-TOKEN'     : document.querySelector('meta[name="csrf-token"]')
                    .getAttribute('content'),
}

import 'core-js/es6/promise'
import 'core-js/es6/string'
import 'core-js/es7/array'
import {
  getPermisosRutasRoles,
} from './apiCalls.js'
import jsPDF             from         'jspdf'
import Vuex              from         'vuex'
import VueRouter         from         'vue-router'
import Vue               from         'vue'
import axios             from         'axios'
import VueAxios          from         'vue-axios'
import sitestable        from         './components/sites_comp/sites_list.vue'
import editForm          from         './components/sites_comp/sites_edit.vue'
import singleSiteShow    from         './components/sites_comp/sites_show.vue'
import proveeList        from         './components/prov_comp/prov_list.vue'
import proveeShow        from         './components/prov_comp/prov_show.vue'
import proveeNew         from         './components/prov_comp/prov_new.vue'
import proveeEdit        from         './components/prov_comp/prov_edit.vue'
import credList          from         './components/cred_comp/cred_list.vue'
import credEdit          from         './components/cred_comp/cred_edit.vue'
import credNew           from         './components/cred_comp/cred_new.vue'
import credShow          from         './components/cred_comp/cred_show.vue'
import factList          from         './components/fact_comp/fact_list.vue'
import factNew           from         './components/fact_comp/fact_new.vue'
import factEdit          from         './components/fact_comp/fact_edit.vue'
import factShow          from         './components/fact_comp/fact_show.vue'
import cssVars           from         'css-vars-ponyfill'
import BootstrapVue      from         'bootstrap-vue'
import App               from         './App.vue'
import router            from         './CoreUi/src/router/index.js'
import {getLocalUser}    from         './auth.js'
import VueContentLoading from         'vue-content-loading';
import {                 VclFacebook, VclInstagram                             }    from         'vue-content-loading'
import {                 Notification }                                        from 'element-ui'
import infiniteScroll    from         'vue-infinite-scroll'

Vue.component('site-new',          require('./components/sites_comp/sites_new.vue'));
Vue.component('sites-table',       require('./components/sites_comp/sites_list.vue'));
Vue.component('sites-edit',        require('./components/sites_comp/sites_edit.vue'));
Vue.component('single-site',       require('./components/sites_comp/sites_show.vue'));
Vue.component('prov-list',         require('./components/prov_comp/prov_list.vue'));
Vue.component('prov-show',         require('./components/prov_comp/prov_show.vue'));
Vue.component('prov-new',          require('./components/prov_comp/prov_new.vue'));
Vue.component('prov-edit',         require('./components/prov_comp/prov_edit.vue'));
Vue.component('cred-list',         require('./components/cred_comp/cred_list.vue'));
Vue.component('cred-edit',         require('./components/cred_comp/cred_edit.vue'));
Vue.component('cred-new',          require('./components/cred_comp/cred_new.vue'));
Vue.component('cred-show',         require('./components/cred_comp/cred_show.vue'));
Vue.component('fact-list',         require('./components/fact_comp/fact_list.vue'));
Vue.component('fact-new',          require('./components/fact_comp/fact_new.vue'));
Vue.component('fact-edit',         require('./components/fact_comp/fact_edit.vue'));
Vue.component('fact-show',         require('./components/fact_comp/fact_show.vue'));
Vue.use(VueAxios, axios)
Vue.use(Vuex)
Vue.use(BootstrapVue)
Vue.use(infiniteScroll)

import ElementUI from 'element-ui';
import 'element-ui/lib/theme-chalk/index.css';
import locale from 'element-ui/lib/locale/lang/en'
Vue.use(ElementUI,{ locale });

import VueAuthenticate from 'vue-authenticate'

Vue.use(VueAuthenticate, {
  baseUrl          : 'http://172.30.33.207:3000/',
  tokenName        : 'access_token',
  storageType      : 'localStorage',
  tokenHeader      : 'Authorization',
  tokenType        : 'Bearer',
  storageNamespace : '',
  loginUrl         : '/api/auth/login',
  registerUrl      : '/api/auth/register',
})

const user = getLocalUser()
/*
*VuexStore contiene variables
*que podran ser accesadas desde
*cualquier componente en la aplicacion
*/
import state from './cleaninglady/State';
import actions from './cleaninglady/Actions';
import getters from './cleaninglady/Getters';
import mutations from './cleaninglady/Mutations';
const store = new Vuex.Store({
    //State guarda las variables
    state: {
          isAuthenticated  : false,
          permisos_roles         : null,
          host             : '',
          sites            : '',
          currentUser      : user,
          roles_auth      : [],
          notifications    : [],
          socket_connected : null,
          isLoggedIn       : !!user,
          loading          : false,
          auth_error       : null,
          customers        : [],
          roles            : [],
          path_Auth        : [],

    },
      //Getters guarda los metodos para obtener
      //los datos de State
      getters: {
          getPermisosRoles (state) {
              return state.permisos_roles
          },
          isAuthenticated (state) {
              return state.isAuthenticated
          },
          showHost(state){
              return state.host
          },
          notifications(state){
              return state.notifications
          },
          showSites(state){
              return state.sites
          },
          isLoggedIn(state){
              return state.isLoggedIn
          },
          isLoading(state){
              return state.loading
          },
          currentUser(state){
              return state.currentUser
          },
          authError(state){
              return state.auth_error
          },
          customers(state){
              return state.customers
          },
          roles(state){
              return state.roles
          },
          pathAuth(rolesToPath){
              // console.log(this.state.currentUser.roles)
              return
          },
          getPaths (state) {
              return state.path_Auth
          },
      },    
    //Mutations guarda los metodos para modificar los state
    //de forma SINCRONA
    mutations: {
          isAuthenticated (state, payload) {
              // console.log('Recibiendo en autenticated')
              // console.log(payload)
              console.log(payload)
              state.isAuthenticated = true
              state.isLoggedIn  = true
              state.auth_error  = null
              state.loading     = false
              state.currentUser = payload.user
              state.currentUser.token = payload.access_token
              state.currentUser.notifications = payload.notifications
              payload.notifications.forEach((item,index)=>{
                state.notifications.push(JSON.parse(item.data))
              })
                  // console.log(state.notifications)
              localStorage.setItem("user", JSON.stringify(state.currentUser))
              localStorage.setItem("jwtToken", state.currentUser.token)
              // console.log(JSON.parse(localStorage.getItem('user')))
              if (!window.Echo.auth) {
                  window.Echo.auth= {headers: {Authorization: "Bearer " + state.currentUser.token}}
              }
              axios.defaults.headers.common['Authorization'] = 'Bearer '+state.currentUser.token
          },
          addHost(state,value){
              state.host = value
          },
          addSite(state,value){
              state.sites = value
          },
          login(state){
              state.loading    = true
              state.auth_error = null
          },
          loginFailed(state, payload){
              state.loading    = false
              state.auth_error = payload.error
          },
          logout(state){
              state.isAuthenticated = false
              // alert('Se elimina el user')
              localStorage.removeItem("user")
              localStorage.removeItem("jwtToken")
              state.loading     = false
              state.currentUser = null
              delete axios.defaults.headers.common['Authorization']
              router.push({path:'/login'})
          },
          UPDATE_NOTIF(state,value){
              state.notifications.push(value)
          },
          ADD_PATHSARR(state,value){
              console.log('Estohy en el store')
              value.forEach((v,i)=>{
                  state.path_Auth.push(v)
              })
          },
          SETPERMISOS_ROLES(state,val){
              state.permisos_roles = val
          },
    },
    //Actions guarda los metodos para modificar los state
    //de forma ASINCRONA
    actions: {
          // Perform VueAuthenticate login using Vuex actions
      login (context, payload) {
          context.commit('isAuthenticated', {
              user : Object.assign({}, payload.data.user, {token: payload.data.access_token}),
              isAuthenticated: true
          })
          router.push({path:'/'})
      },
      sendHost(state,value){
        store.commit('addHost',value)
      },
      sendSites(state,value){
        store.commit('addSite',value)
      },
      load_permisos(context,value){
        getPermisosRutasRoles(value)
        .then(response => {
          context.commit('SETPERMISOS_ROLES',{
            permisos: response,
            role: value.role
          })

          if (!$("body").hasClass("aside-menu-lg-show")) {
            $("body").toggleClass("aside-menu-lg-show")
          }
        }).catch( error => {
          console.log(error)
        })
      },
    },
})


axios.interceptors.request.use((config)=>{

      let user = JSON.parse(localStorage.getItem('user'))
      // console.log('Interceptando ando:'+!!JSON.parse(localStorage.getItem('user')))
        if (!!JSON.parse(localStorage.getItem('user'))) {
          // console.log('Autenticado')
          if (!window.Echo.auth) {
              window.Echo.auth= {headers: {Authorization: "Bearer " + user.token}}
          }
          if (!axios.defaults.headers.common['Authorization']) {
            config.headers.Authorization = 'Bearer '+user.token
            // console.log('La variable no existe, pero fue creada: '+config.headers.Authorization)
          }
        } else {
          // console.log('No Autenticado')
          store.commit('logout')
          router.push('/login')
          delete axios.defaults.headers.common['Authorization']
        }

    return config
  })

axios.interceptors.response.use(null, (error)=>{
    if (error.response) {
        if (error.response.status == 401) {
            Notification.error({
              title: 'Error '+error.response.status,
              message: 'No autenticado'
            });
            store.commit('logout')
            store.commit('loginFailed',{error: error.response.data.error}) 
            router.push('/login')
            // console.log('Ejecuto salida')
        }

        if (error.response.status == 405) {
            Notification.error({
              title: 'Error Interno',
              message: 'Algo anda mal en el servidor'
            });
        }

        if (error.response.status == 404) {
            Notification.error({
              title: 'Error en Query',
              message: 'El query enviado no arrojo ningun resultado'
            });
        }

        if (error.response.status == 500) {
            Notification.error({
              title: 'Error Interno',
              message: 'Algo anda mal en el servidor'
            });
        }
      // Request made and server responded
      // console.log(error.response.data);
      // console.log(error.response.status);
      // console.log(error.response.headers);
    } else if (error.request) {
      // The request was made but no response was received
      Notification.error({
        title: 'Error '+error.request,
        message: 'No se ha recibido respuesta'
      });
      // console.log(error.request);
    } else { 
        Notification.error({
          title: 'Error '+error.message,
          message: 'Ups, algo sucedio'
        });
      // Something happened in setting up the request that triggered an Error
      console.log('Error', error.message);
    }
    return Promise.reject(error)
  })


const app = new Vue({
    el         : '#mainApp',
    router,
    store,
    data 	   : {

    },
    template: '<App/>',
    components : {
        App,
    	sitestable,
    	editForm,
    	singleSiteShow,
    	proveeList,
    	proveeShow,
    	proveeNew,
    	credEdit,
    	credShow,
    	proveeEdit,
    	factList,
    	factNew,
    	factEdit,
    	factShow,
        VclFacebook,
        VclInstagram,
        VueContentLoading,
    },
    mounted(){

    },
    beforeCreate() { 
    },
    beforeMount() {
        var reqauth     = this.$router.history.current.meta.requiresAuth
        var thisPath    = this.$router.history.current.path
        var currentUser = store.state.currentUser
        var roles       = this.$router.history.current.meta.roles

        if (reqauth && !currentUser) {
            // console.log('Disparo salida')
            this.$router.push('/login')
        }

        if (thisPath == '/login' && currentUser) {
            this.$router.push('/')
        } 

        if (reqauth && currentUser) {
            let auth = matchRoles(roles,currentUser.roles)
            if (!auth) {
                this.$router.push('/')
            } 
        }
    }
})

/*
* matchRoles en una funcion que compara
* los roles de las rutas y del usuario
* para validar si el usuario cumple con
* los roles de la proxima ruta
*/
function matchRoles(x,y){
        let flag = false
        // console.log(x)
        // console.log(y)

        x.forEach((x)=>{
            y.forEach((y)=>{
                if (x==y.name || x=='public') {
                    flag = true
                }
            })
        })

        if (flag) return true
        return false

    }

router.beforeEach((to,from, next)=>{
        /*
        *   -rolesToPath = contiene boolean si la proxima ruta
        *       contiene metadata con el key "roles"
        *   -reqAuth = boolean de la metadata de la proxima ruta
        *   -currentUser = usuario actual
        */
        const rolesToPath = (to.meta.roles)?to.meta.roles:null
        const reqAuth     = to.matched.some(record=> record.meta.requiresAuth)
        const currentUser = store.state.currentUser
        const homeRoute   = '/dashboard'
        const loginRoute  = '/login'
        // console.log(from.path+' -> '+to.path)

        // console.log(rolesToPath)
        // console.log(currentUser.roles)


        /*
        * Valida si la proxima ruta
        * requiere autorizacion y si no hay
        * un usuario logueado se redirecciona
        * al dashboard
        */
        if (reqAuth && !currentUser) {
            next(loginRoute)
        } 
        /*
        * Valida si la proxima ruta requiere autenticacion
        * y hay un usuario autenticado
        * para luego enviar los datos de la proxima ruta
        * y los roles del usuario autenticado para determinar una accion
        */
        else if (reqAuth && currentUser) {
            let auth = matchRoles(rolesToPath,currentUser.roles)
            if (auth) {
                // console.log('Si pasa')
                next()
            } else {
                // console.log('No pasa')
                // console.log(auth)
                router.push(homeRoute)
            }
        }
        /*
        *Valida si la siguiente ruta es /login
        *y si hay un usuario logueado,
        *de ser TRUE se redirecciona al dashboard
        */
        else if (to.path == '/login' && currentUser) {
            next('/')
        } 
        else {
            next()
        }

        // next()
    })

