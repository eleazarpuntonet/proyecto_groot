<template>
<div id="app">
    <b-card no-body>
      <b-card-header>
        <strong>Tabla de proveedores de servicios web</strong>
      </b-card-header>
      <b-card-body>
        <b-row>

          <b-col md="6" class="my-1">
            <b-form-group horizontal label="Filtrar" class="mb-0">
              <b-input-group>
                <b-form-input v-model="filter" placeholder="Buscar" />
                <b-input-group-append>
                  <b-btn :disabled="!filter" @click="filter = ''">Clear</b-btn>
                </b-input-group-append>
              </b-input-group>
            </b-form-group>
          </b-col>

          <b-col md="6" class="my-1">
            <b-form-group horizontal label="Ordenar" class="mb-0">
              <b-input-group>
                <b-form-select v-model="sortBy" :options="sortOptions">
                  <option slot="first" :value="null">-- none --</option>
                </b-form-select>
                <b-form-select :disabled="!sortBy" v-model="sortDesc" slot="append">
                  <option :value="false">Ascendente</option>
                  <option :value="true">Descendente</option>
                </b-form-select>
              </b-input-group>
            </b-form-group>
          </b-col>

          <b-col md="6" class="my-1">
            <b-form-group horizontal label="Orden" class="mb-0">
              <b-input-group>
                <b-form-select v-model="sortDirection" slot="append">
                  <option value="asc">Ascendente</option>
                  <option value="desc">Descendente</option>
                  <option value="last">Ultimo</option>
                </b-form-select>
              </b-input-group>
            </b-form-group>
          </b-col>

          <b-col md="6" class="my-1">
            <b-form-group horizontal label="Resultados" class="mb-0">
              <b-form-select :options="pageOptions" v-model="perPage" />
            </b-form-group>
          </b-col>
        </b-row>

        <!-- Main table element -->
        <b-table  
                head-variant="dark"
                hover
                outlined
                striped
                responsive
                show-empty
                stacked="md"
                :items="items"
                :fields="fields"
                :current-page="currentPage"
                :per-page="perPage"
                :filter="filter"
                :sort-by.sync="sortBy"
                :sort-desc.sync="sortDesc"
                :sort-direction="sortDirection"
                @filtered="onFiltered"
        >
          <template slot="name" slot-scope="row">{{row.value.first}} {{row.value.last}}</template>

          <template slot="isActive" slot-scope="row">{{row.value?'Yes :)':'No :('}}</template>

          <template slot="sites" slot-scope="row">
            <!-- We use @click.stop here to prevent a 'row-clicked' event from also happening 
              *
              * Estos son los botones que disparan el evento de mostrar
              * modal o mostrar celda con info
              *
            -->
            <b-button size="sm" @click.stop="info(row.item, row.index, $event.target)" class="mr-1">
              Info modal
            </b-button>
            <b-button size="sm" @click.stop="row.toggleDetails">
              {{ row.detailsShowing ? 'Esconder' : 'Mostrar' }} Detalles
            </b-button>
          </template>
            <!-- 
            *
            * Celda de detalles
            *
             -->
          <template slot="row-details" slot-scope="row">
            <b-card>
              <ul>
                <li v-for="(value, key) in row.item" :key="key">{{ key }}: {{ value}}</li>
              </ul>
            </b-card>
          </template>
        </b-table>

        <b-row>
          <b-col md="6" class="my-1">
            <b-pagination :total-rows="totalRows" :per-page="perPage" v-model="currentPage" class="my-0" />
          </b-col>
        </b-row>

        <!-- 
        *
        * Modal detalles
        *
         -->
        <b-modal bg-variant="light" class="text-center" id="modalInfo" @hide="resetModal" :title="modalInfo.content.nombre" ok-only>
          <pre>
            <b-list-group flush>
                <b-list-group-item v-for="(value, key) in modalInfo.content" :key="key">{{ key }}: {{ value}}</b-list-group-item>
            </b-list-group>
          </pre>
        </b-modal>
      </b-card-body>
    </b-card>
</div>
</template>

<script>
const items = [
  { isActive: true, age: 40, name: { first: 'Dickerson', last: 'Macdonald' } },
  { isActive: false, age: 21, name: { first: 'Larsen', last: 'Shaw' } },
  {
    isActive: false,
    age: 9,
    name: { first: 'Mini', last: 'Navarro' },
    _rowVariant: 'success'
  },
  { isActive: false, age: 89, name: { first: 'Geneva', last: 'Wilson' } },
  { isActive: true, age: 38, name: { first: 'Jami', last: 'Carney' } },
  { isActive: false, age: 27, name: { first: 'Essie', last: 'Dunlap' } },
  { isActive: true, age: 40, name: { first: 'Thor', last: 'Macdonald' } },
  {
    isActive: true,
    age: 87,
    name: { first: 'Larsen', last: 'Shaw' },
    _cellVariants: { age: 'danger', isActive: 'warning' }
  },
  { isActive: false, age: 26, name: { first: 'Mitzi', last: 'Navarro' } },
  { isActive: false, age: 22, name: { first: 'Genevieve', last: 'Wilson' } },
  { isActive: true, age: 38, name: { first: 'John', last: 'Carney' } },
  { isActive: false, age: 29, name: { first: 'Dick', last: 'Dunlap' } }
]

export default {
  /*
  *
  * Variables del componente
  */
  data () {
    return {
      items: items,
      // fields: [
      //   { 
      //     key           : 'name',
      //     label         : 'Person Full name',
      //     sortable      : true,
      //     sortDirection : 'desc' ,
      //     'class'       : 'text-center'
      //   },
      //   { 
      //     key           : 'age',
      //     label         : 'Person age',
      //     sortable      : true,
      //     'class'       : 'text-center'
      //    },
      //   { 
      //     key           : 'isActive',
      //     label         : 'is Active' ,
      //     'class'       : 'text-center'
      //   },
      //   { 
      //     key     : 'actions',
      //     label   : 'Actions' ,
      //     'class' : 'text-center'
      //  }
      // ],
      fields  : [
      { key   : 'nombre', label      : 'Nombre', sortable     : true, sortDirection : 'desc','class'   : 'text-center' },
      { key   : 'cuenta', label      : 'Nro Cuenta', sortable : true, 'class'       : 'text-center' },
      { key   : 'usuario', label     : 'Usuario','class'      : 'text-center' },
      { key   : 'comentarios', label : 'Comentarios','class'  : 'text-center' },
      { key   : 'sites', label       : 'Comentarios','class'  : 'text-center' },
      ],
      currentPage: 1,
      perPage: 5,
      totalRows: items.length,
      pageOptions: [ 5, 10, 15 ],
      sortBy: null,
      sortDesc: false,
      sortDirection: 'asc',
      filter: null,
      modalInfo: { title: '', content: '' }
    }
  },
  /*
  *
  * Variables del computadas
  */
  computed: {
    sortOptions () {
      // Create an options list from our fields
      return this.fields
        .filter(f => f.sortable)
        .map(f => { return { text: f.label, value: f.key } })
    }
  },
  /*
  *
  * Metodos y funciones
  */
  methods: {
    info (item, index, button) {
      this.modalInfo.title = `Row index: ${index}`
      // this.modalInfo.content = JSON.stringify(item, null, 2)
      this.modalInfo.content = item
      this.$root.$emit('bv::show::modal', 'modalInfo', button)
    },
    resetModal () {
      this.modalInfo.title = ''
      this.modalInfo.content = ''
    },
    onFiltered (filteredItems) {
      // Trigger pagination to update the number of buttons/pages due to filtering
      this.totalRows = filteredItems.length
      this.currentPage = 1
    }
  },
  created(){
    axios.get(route('proveedores.index')) 
        .then(
          response => {
            this.items=response.data
            console.log(this.items)
            // store.dispatch('sendHost',response.data)
          })
        .catch(error => {
          console.log(error)
        })
  }
}
</script>
<style>

</style>
