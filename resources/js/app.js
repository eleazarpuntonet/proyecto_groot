require('./bootstrap');
window.axios = require('axios')
window.axios.defaults.headers.common = {
    'X-Requested-With' : 'XMLHttpRequest',
    'Authorization'    :'Bearer '+JSON.parse(localStorage.getItem('jwtToken')),
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
import Vuetable              from 'vuetable-2/src/components/Vuetable'
import cssVars               from 'css-vars-ponyfill'
import BootstrapVue          from 'bootstrap-vue'
import App                   from './App.vue'
import router                from '../../CoreUi/src/router/index.js'
import {getLocalUser}        from './auth.js'
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
Vue.use(Vuetable);
Vue.use(BootstrapVue)
Vue.use(Vuetable)

function install(Vue){
  Vue.component("vuetable", Vuetable);
  Vue.component("vuetable-pagination", VueTablePaginationInfo);
  Vue.component("vuetable-pagination-dropdown", VueTablePaginationDropDown);
  Vue.component("vuetable-pagination-info", VueTablePaginationInfo);
}
const user = getLocalUser()
/*
*VuexStore contiene variables
*que podran ser accesadas desde
*cualquier componente en la aplicacion
*/
const store = new Vuex.Store({
	//State guarda las variables
	state: {
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
        fullname(state){
            return state.currentUser.name+' '+state.currentUser.last_name
        },
    },    
	//Mutations guarda los metodos para modificar los state
	//de forma SINCRONA
	mutations: {
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
        loginSuccess(state, payload){
            state.isLoggedIn  = true
            state.auth_error  = null
            state.loading     = false
            state.currentUser = Object.assign({}, payload.user, {token: payload.access_token})
            localStorage.setItem("user", JSON.stringify(state.currentUser))
            localStorage.setItem("jwtToken", JSON.stringify(state.currentUser.token))
        },
        loginFailed(state, payload){
            state.loading    = false
            state.auth_error = payload.error
        },
        logout(state){
            localStorage.removeItem("user")
            // localStorage.removeItem("jwtToken")
            state.loading     = false
            state.currentUser = null
        }
	},
	//Actions guarda los metodos para modificar los state
	//de forma ASINCRONA
	actions: {
		sendHost(state,value){
			store.commit('addHost',value)
		},
		sendSites(state,value){
			store.commit('addSite',value)
		},
        login(context){
            store.commit('login')
        }
	},
})

/*
*Filtra las rutas de acceso
*para otorgar permisologia
*en la navegacion de turas
*/
// console.log(JSON.parse(localStorage.getItem('user')))
router.beforeEach((to,from, next)=>{
        const rolesToPath = (to.meta.roles)?to.meta.roles:null
        const reqAuth     = to.matched.some(record=> record.meta.auth)
        const currentUser = store.state.currentUser
        /*
        * Valida si la proxima ruta
        * requiere autorizacion y si no hay
        * un usuario logueado se redirecciona
        * al dashboard
        */

        if (reqAuth && !currentUser) {
            next('/login')
        } 
        /*
        *Valida si la siguiente ruta es /login
        *y si hay un usuario logueado,
        *de ser TRUE se redirecciona al dashboard
        */

        else if (to.path == '/login' && currentUser) {
            next('/')
        } 
        /*
        * Valida si existe un usuario logueado y
        * si la proxima ruta requiere de permisologias.
        * De ser TRUE, se valida que una de los roles del usuario
        * concuerde con uno de los roles de la ruta
        */
        // else if (currentUser && rolesToPath) {
        //     currentUser.roles.forEach((rolUser)=>{
        //         to.meta.roles.forEach((rolToPath)=>{
        //             if (rolUser.name==rolToPath) {
        //                 next()
        //             }
        //         })
        //     })
        //     next('/')
        // } 
        else {
            next()
        }

    })

/*
*Intercepta las respuesta de error 401
*para enviar nuevamente al usuario
*al sitio de login
*/
axios.interceptors.response.use(null, (error)=>{
        if (error.response.status == 401) {
            store.commit('logout')
            router.push('/login')
        }
        // if (error.response.status == 500) {
        //     store.commit('logout')
        //     router.push('/login')
        // }
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

