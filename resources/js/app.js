require('./bootstrap');
window.axios = require('axios')
window.axios.defaults.headers.common = {
    'X-Requested-With' : 'XMLHttpRequest',
    // 'Authorization'    :'Bearer '+JSON.parse(localStorage.getItem('jwtToken')),
    'X-CSRF-TOKEN'     : document.querySelector('meta[name="csrf-token"]')
    								.getAttribute('content'),
}

window.Vue = require('vue')
import 'core-js/es6/promise'
import 'core-js/es6/string'
import 'core-js/es7/array'
import Vuex                  from 'vuex'
import VueRouter             from 'vue-router'
import Vue                   from 'vue'
import axios                 from 'axios'
import VueAxios              from 'vue-axios'
import sitestable            from './components/sites_comp/sites_list.vue'
import editForm              from './components/sites_comp/sites_edit.vue'
import singleSiteShow        from './components/sites_comp/sites_show.vue'
import proveeList            from './components/prov_comp/prov_list.vue'
import proveeShow            from './components/prov_comp/prov_show.vue'
import proveeNew             from './components/prov_comp/prov_new.vue'
import proveeEdit            from './components/prov_comp/prov_edit.vue'
import credList              from './components/cred_comp/cred_list.vue'
import credEdit              from './components/cred_comp/cred_edit.vue'
import credNew               from './components/cred_comp/cred_new.vue'
import credShow              from './components/cred_comp/cred_show.vue'
import factList              from './components/fact_comp/fact_list.vue'
import factNew               from './components/fact_comp/fact_new.vue'
import factEdit              from './components/fact_comp/fact_edit.vue'
import factShow              from './components/fact_comp/fact_show.vue'
// import Vuetable              from 'vuetable-2/src/components/Vuetable'
import cssVars               from 'css-vars-ponyfill'
import BootstrapVue          from 'bootstrap-vue'
import App                   from './App.vue'
import router                from '../../CoreUi/src/router/index.js'
import {getLocalUser}        from './auth.js'
import VueCtkDateTimePicker from 'vue-ctk-date-time-picker';
import 'vue-ctk-date-time-picker/dist/vue-ctk-date-time-picker.min.css';
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
Vue.component('vue-ctk-date-time-picker', VueCtkDateTimePicker);
Vue.use(VueAxios, axios)
Vue.use(Vuex)
// Vue.use(Vuetable);
Vue.use(BootstrapVue)
// Vue.use(Vuetable)
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

axios.interceptors.request.use(null, (error)=>{
    console.log('Interceptando ando')
    console.log(store.getters.isAuthenticated())
        if (store.getters.isAuthenticated()) {
            alert('Autenticado')
            axios.defaults.headers.common['Authorization'] = JSON.parse(localStorage.getItem('jwtToken'))
        } else {
          store.commit('logout')
          router.push('/login')
          delete axios.defaults.headers.common['Authorization']
        }
    })


axios.interceptors.response.use(null, (error)=>{
        if (error.response.status == 401) {
            store.commit('logout')
            router.push('/login')
            store.commit('loginFailed',{error: error.response.data.error}) 
        }
        // if (error.response.status == 500) {
        //     store.commit('logout')
        //     router.push('/login')
        //     store.commit('loginFailed',{error: error.response.data.error}) 

        // }
        return Promise.reject(error)
    })
const user = getLocalUser()
/*
*VuexStore contiene variables
*que podran ser accesadas desde
*cualquier componente en la aplicacion
*/
const store = new Vuex.Store({
	//State guarda las variables
	state: {
        isAuthenticated: false,
        host        : '',
        sites       : '',
        currentUser : user,
        isLoggedIn  : !!user,
        loading     : false,
        auth_error  : null,
        customers   : [],
        roles       : [],

	},
    //Getters guarda los metodos para obtener
    //los datos de State
    getters: {
        isAuthenticated (state) {
            return state.isAuthenticated
        },
        showHost(state){
            return state.host
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
            console.log(rolesToPath)
            return
        }
    },    
	//Mutations guarda los metodos para modificar los state
	//de forma SINCRONA
	mutations: {
        isAuthenticated (state, payload) {
          state.isAuthenticated = payload.isAuthenticated
            state.isLoggedIn  = true
            state.auth_error  = null
            state.loading     = false
            state.currentUser = payload.user
            localStorage.setItem("user", JSON.stringify(state.currentUser))
            localStorage.setItem("jwtToken", JSON.stringify(state.currentUser.token))
            console.log(state.currentUser)

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
            localStorage.removeItem("user")
            localStorage.removeItem("jwtToken")
            // localStorage.removeItem("jwtToken")
            state.loading     = false
            state.currentUser = null
            router.push({path:'/login'})
        }
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
        // login(context){
        //     store.commit('login')
        // }
	},
})
/*
*Filtra las rutas de acceso
*para otorgar permisologia
*en la navegacion de turas
*/
// console.log(JSON.parse(localStorage.getItem('user')))





const app = new Vue({
    el         : '#mainApp',
    router,
    store,
    data 	   : {

    },
    template: '<App/>',
    components : {
        VueCtkDateTimePicker,
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
    },
    mounted(){
        console.log('Hola! desde el APP')
    },
    beforeCreate() { 
        axios.get('/ajaxHost') 
            .then(
            	response => {
            		store.dispatch('sendHost',response.data)
            	}
            ).catch(error => this.errors.push(error))
        axios.get('/ajaxSites') 
            .then(
            	response => {
            		store.dispatch('sendSites',response.data)
            	}
            ).catch(error => this.errors.push(error))
    }
})

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
        console.log(from.path+' -> '+to.path)
        console.log(reqAuth)
        console.log(currentUser)

        /*
        * Valida si la proxima ruta requiere autenticacion
        * y hay un usuario autenticado
        * para luego enviar los datos de la proxima ruta
        * y los roles del usuario autenticado para determinar una accion
        */
        // if (reqAuth && currentUser) {
        //         let auth = matchRoles(rolesToPath,currentUser.roles)
        //         if (auth) {
        //             console.log('Si pasa')
        //             next()
        //         } else {
        //             console.log('No pasa')
        //             next(homeRoute)
        //         }
        //     }

        /*
        * mathRoles en una funcion que compara
        * los roles de las rutas y del usuario
        * para validar si el usuario cumple con
        * los roles de la proxima ruta
        */
        function matchRoles(x,y){
                let flag = false

                x.forEach((x)=>{
                    y.forEach((y)=>{
                        if (x.userRol==y.name) {
                            console.log(x.userRol)
                            flag = true
                        }
                    })
                })

                if (flag) return true
                return false

            }
        /*
        * Valida si la proxima ruta
        * requiere autorizacion y si no hay
        * un usuario logueado se redirecciona
        * al dashboard
        */
        if (reqAuth && !currentUser) {
            next(loginRoute)
        } 
        // /*
        // *Valida si la siguiente ruta es /login
        // *y si hay un usuario logueado,
        // *de ser TRUE se redirecciona al dashboard
        // */

        else if (to.path == '/login' && currentUser) {
            console.log(currentUser)
            console.log('Tengo user y voy al login')
            next('/')
        } 
        else {
            next()
        }

        next()


    })