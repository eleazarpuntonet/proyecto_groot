$(document).ready(function() {
	// $('#botonAjax').click(function(){
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
						'value':data[i].id,
						'text':data[i].nombre
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

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));

// const app = new Vue({
//     el: '#app'
// });

