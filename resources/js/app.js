$(document).ready(function() {
	// $('#botonAjax').click(function(){
		$.ajaxSetup({
		    headers: {
		        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		    }
		});
		var dataSend = {
			'Nombre':'Eleazar',
			'Nacionalidad0':'Venezolano',
			'Carrera':'Informatica',
			'Departamento':'IT',
			'Fecha_nac':'17/09/1992'
		}
		$.ajax({
			data     : dataSend,
			url      : "/ajaxHost",
			type     : "GET",
			// dataType : "JSON",
			beforeSend: function(xhr){
			},
			error: function(jqXHR,textStatus,errorThrown){

			},
			success: function(data,textStatus,jqXHR){
				for(var i in data){
					// console.log(data[i].id)
					$('.hostingSelect').append($('<option>',{
						'value' : data[i].id,
						'text'  : data[i].nombre
					}))
				}
			}
		})
		$.ajax({
			data     : dataSend,
			url      : "/ajaxSites",
			type     : "GET",
			// dataType : "JSON",
			beforeSend: function(xhr){
			},
			error: function(jqXHR,textStatus,errorThrown){

			},
			success: function(data,textStatus,jqXHR){
				for(var i in data){
					// console.log(data[i].id)
					$('.sitesSelect').append($('<option>',{
						'value':data[i].id,
						'text':data[i].dominio
					}))
				}
			}
		})

	// })
})
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
 import VueRouter  		from 'vue-router'
 import Vue        		from 'vue'
 import axios      		from 'axios'
 import VueAxios   		from 'vue-axios'
 import rutas      		from './routes.js'
 import sitestable 		from './components/sites_comp/sites_list_table.vue'
 import editForm   		from './components/sites_comp/sites_single_edit.vue'
 import singleSiteShow 	from './components/sites_comp/site_single_show.vue'
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
 Vue.use(VueRouter)
 
 Vue.component('site-new-form',   	require('./components/sites_comp/site_new_form.vue'));
 Vue.component('sites-table',       require('./components/sites_comp/sites_list_table.vue'));
 Vue.component('sites-edit-form',   require('./components/sites_comp/sites_single_edit.vue'));
 Vue.component('single-site-show',  require('./components/sites_comp/site_single_show.vue'));
 Vue.component('prov-list',  		require('./components/prov_comp/prov_list.vue'));
 Vue.component('prov-show', 		require('./components/prov_comp/prov_show.vue'));
 Vue.component('prov-new', 			require('./components/prov_comp/prov_new.vue'));
 Vue.component('prov-edit',			require('./components/prov_comp/prov_edit.vue'));
 Vue.component('cred-list', 		require('./components/cred_comp/cred_list.vue'));
 Vue.component('cred-edit', 		require('./components/cred_comp/cred_edit.vue'));
 Vue.component('cred-new', 			require('./components/cred_comp/cred_new.vue'));
 Vue.component('cred-show', 		require('./components/cred_comp/cred_show.vue'));
 Vue.component('fact-list', 		require('./components/fact_comp/fact_list.vue'));
 Vue.component('fact-new', 			require('./components/fact_comp/fact_new.vue'));
 Vue.component('fact-edit', 		require('./components/fact_comp/fact_edit.vue'));
 Vue.component('fact-show', 		require('./components/fact_comp/fact_show.vue'));

const rout = new VueRouter({
routes : rutas,
mode   : 'history'
})


const app = new Vue({
    el     : '#app',
    router : rout,
    components:{
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
    mounted() { 
            // axios.get('/tasks') 
            //     .then(response => this.tasks = response.data) 
            //     .catch(error => this.errors.push(error));
            // alert('Hola!')
    }
})

