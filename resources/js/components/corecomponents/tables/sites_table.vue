<template>
  <div class="animated fadeIn">
    <b-row>
      <b-col lg="12">
        <b-card 
          :header="caption">
          <b-table 
            :hover="hover" 
            :striped="striped" 
            :bordered="bordered" 
            :small="small" 
            :fixed="fixed" responsive="sm" 
            :items="items" 
            :fields="fields" 
            :current-page="currentPage" 
            :per-page="perPage">
            <template slot="status" slot-scope="data">
              <b-badge :variant="getBadge(data.item.status)">{{data.item.status}}</b-badge>
            </template>
          </b-table>
          <nav>
            <b-pagination :total-rows="getRowCount(items)" :per-page="perPage" v-model="currentPage" prev-text="Prev" next-text="Next" hide-goto-end-buttons/>
          </nav>
        </b-card>
      </b-col><!--/.col-->
    </b-row><!--/.row-->
  </div>
</template>

<script>
/**
   * Randomize array element order in-place.
   * Using Durstenfeld shuffle algorithm.
   */
const shuffleArray = (array) => {
  for (let i = array.length - 1; i > 0; i--) {
    let j = Math.floor(Math.random() * (i + 1))
    let temp = array[i]
    array[i] = array[j]
    array[j] = temp
  }
  return array
}

export default {
  name: 'c-table',
  props: {
    caption: {
      type: String,
      default: '<i class=fa fa-align-justify></i> Lista de Sitios de Acceso'
    },
    hover: {
      type: Boolean,
      default: false
    },
    striped: {
      type: Boolean,
      default: false
    },
    bordered: {
      type: Boolean,
      default: false
    },
    small: {
      type: Boolean,
      default: true
    },
    fixed: {
      type: Boolean,
      default: false
    },
    headers: {
      // type: Array,
      default: false
    },
    dataItems: ''


  },
  data: () => {
    return {
      items: [],
      // items: [],
      fields: [
        {key: 'dominio'},
        {key: 'hosting'},
        {key: 'ip_site'},
        {key: 'status'},
      ],
      currentPage: 1,
      perPage: 5,
      totalRows: 0
    }
  },
  created() {
      // this.mutableData= JSON.parse(this.headers)
      axios.get(route('sites.index')) 
          .then(
            response => {
              this.items=response.data
              // store.dispatch('sendHost',response.data)
            }
          ).catch(error => this.errors.push(error))
  },
  methods: {
    getBadge (status) {
      return status === 'Active' ? 'success'
        : status === 'Inactive' ? 'secondary'
          : status === 'Pending' ? 'warning'
            : status === 'Banned' ? 'danger' : 'primary'
    },
    getRowCount (items) {
      return items.length
    }
  }
}
</script>
