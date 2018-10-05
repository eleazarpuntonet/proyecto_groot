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
 import sitestable 		from './components/sites_comp/sites_list_table.vue'
 import editForm   		from './components/sites_comp/sites_single_edit.vue'
 import singleSiteShow 	from './components/sites_comp/site_single_show.vue'
 import rutas      		from './routes.js'
 import axios      		from 'axios'
 import VueAxios   		from 'vue-axios'

 Vue.use(VueAxios, axios)
 Vue.use(VueRouter)
 
 Vue.component('site-new-form',   	require('./components/sites_comp/site_new_form.vue'));
 Vue.component('sites-table',       require('./components/sites_comp/sites_list_table.vue'));
 Vue.component('sites-edit-form',   require('./components/sites_comp/sites_single_edit.vue'));
 Vue.component('single-site-show',  require('./components/sites_comp/site_single_show.vue'));

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
    }
})

