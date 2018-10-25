/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
window.axios = require('axios')
window.axios.defaults.headers.common = {
    'X-Requested-With' : 'XMLHttpRequest',
    'X-CSRF-TOKEN'     : document.querySelector('meta[name="csrf-token"]')
    								.getAttribute('content'),
}
window.Vue = require('vue')

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
 // import rutas      		from './routes.js'
 import Vuex 			from 'vuex'
 import VueRouter  		from 'vue-router'
 import Vue        		from 'vue'
 import axios      		from 'axios'
 import VueAxios   		from 'vue-axios'
 import sitestable 		from './components/sites_comp/sites_list.vue'
 import editForm   		from './components/sites_comp/sites_edit.vue'
 import singleSiteShow 	from './components/sites_comp/sites_show.vue'
 import proveeList	 	from './components/prov_comp/prov_list.vue'
 import proveeShow	 	from './components/prov_comp/prov_show.vue'
 import proveeNew	 	from './components/prov_comp/prov_new.vue'
 import proveeEdit	 	from './components/prov_comp/prov_edit.vue'
 import credList	 	from './components/cred_comp/cred_list.vue'
 import credEdit	 	from './components/cred_comp/cred_edit.vue'
 import credNew	 		from './components/cred_comp/cred_new.vue'
 import credShow 		from './components/cred_comp/cred_show.vue'
 import factList 		from './components/fact_comp/fact_list.vue'
 import factNew 		from './components/fact_comp/fact_new.vue'
 import factEdit 		from './components/fact_comp/fact_edit.vue'
 import factShow 		from './components/fact_comp/fact_show.vue'
 Vue.use(VueAxios, axios)
 Vue.use(Vuex)
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
Vue.use(Vuetable);

import Vuetable from 'vuetable-2/src/components/Vuetable'
 Vue.use(BootstrapVue)
 Vue.use(Vuetable)
 import 'core-js/es6/promise'
 import 'core-js/es6/string'
 import 'core-js/es7/array'
 import cssVars      from 'css-vars-ponyfill'
 import BootstrapVue from 'bootstrap-vue'
 import App          from './App.vue'
 import router       from '../../CoreUi/src/router/index.js'

// const rout = new VueRouter({
// routes : rutas,
// mode   : 'history'
// })
function install(Vue){
  Vue.component("vuetable", Vuetable);
  Vue.component("vuetable-pagination", VueTablePaginationInfo);
  Vue.component("vuetable-pagination-dropdown", VueTablePaginationDropDown);
  Vue.component("vuetable-pagination-info", VueTablePaginationInfo);
}

const store = new Vuex.Store({
	//State guarda las variables
	state: {
		host : '',
		sites: '',
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
	}
})

const app = new Vue({
    el         : '#app',
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

