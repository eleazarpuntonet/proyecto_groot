<template>
  <div class="animated fadeIn">
    <b-row>
      <b-col lg="12">
        <c-table small 
        caption="<i class='fa fa-align-justify'></i> Lista de Proveedores"
        :dataItems="tableItems"
        :headers="headItems"></c-table>
      </b-col><!--/.col-->
    </b-row><!--/.row-->
  </div>

</template>

<script>
import cTable from './table.vue'

export default {
  name: 'tables',
  components: {cTable},
  data() {
      return  {
          // tableHeading : ['Nombre','Cuenta','Usuario','Password','Comentarios','Editar'],
          headItems: [
            {key: 'Nombre'},
            {key: 'Cuenta'},
            {key: 'Usuario'},
            {key: 'Password'},
            {key: 'Comentarios'}
          ],
          tableItems : '',
      }
  },
  // beforeCreate() { 

  // },
  created() {
      // this.mutableData= JSON.parse(this.headers)
      // axios.get(route('proveedores.index')) 
      //     .then(
      //       response => {
      //         // console.log(response.data)
      //         this.tableItems=response.data
      //         // store.dispatch('sendHost',response.data)
      //         console.log('created')
      //         console.log(this.tableItems)
      //       }
      //     ).catch(error => this.errors.push(error))
  },
}
</script>
