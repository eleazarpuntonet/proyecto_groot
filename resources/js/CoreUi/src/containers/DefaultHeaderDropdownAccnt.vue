<template>
  <AppHeaderDropdown right no-caret>
    <template slot="header">
      <img
        :src="'/storage'+usuario.avatar"
        class="img-avatar"
        alt="admin@bootstrapmaster.com" />
    </template>\
    <template slot="dropdown">
      <b-dropdown-header tag="div" class="text-center"><strong>{{ usuario.name }} {{ usuario.last_name }}</strong></b-dropdown-header>
      <b-dropdown-item><i class="fa fa-bell-o" /> Actualizaciones
        <b-badge variant="info">{{ itemsCount }}</b-badge>
      </b-dropdown-item>
      <b-dropdown-item><i class="fa fa-envelope-o" /> Mensajes
        <b-badge variant="success">{{ itemsCount }}</b-badge>
      </b-dropdown-item>
      <b-dropdown-item><i class="fa fa-tasks" /> Tareas
        <b-badge variant="danger">{{ itemsCount }}</b-badge>
      </b-dropdown-item>
      <b-dropdown-item><i class="fa fa-comments" /> Comentarios
        <b-badge variant="warning">{{ itemsCount }}</b-badge>
      </b-dropdown-item>
      <b-dropdown-header
        tag="div"
        class="text-center">
        <strong>Configuraciones</strong>
      </b-dropdown-header>
      <b-dropdown-item>
        <router-link tag="a" to="/perfil_usuario">
          <i class="fa fa-user" /> 
          Perfil
        </router-link>
      </b-dropdown-item>
      <b-dropdown-item><i class="fa fa-wrench" /> Configuraciones</b-dropdown-item>
      <b-dropdown-item><i class="fa fa-usd" /> Pagos
        <b-badge variant="secondary">{{ itemsCount }}</b-badge>
      </b-dropdown-item>
      <b-dropdown-item><i class="fa fa-file" /> Proyectos
        <b-badge variant="primary">{{ itemsCount }}</b-badge>
      </b-dropdown-item>
      <b-dropdown-divider />
      <b-dropdown-item @click.prevent="logout"><i class="fa fa-lock" /> Cerrar session</b-dropdown-item>
    </template>
  </AppHeaderDropdown>
</template>

<script>
import { HeaderDropdown as AppHeaderDropdown } from '@coreui/vue'
export default {
  name: 'DefaultHeaderDropdownAccnt',
  components: {
    AppHeaderDropdown
  },
  data: () => {
    return { 
      itemsCount: 42 ,
      usuario : JSON.parse(localStorage.getItem('user')),
    }
  },
  methods:{
    logout(){
      this.$store.commit('logout')
      this.$router.push({path:'/login'})
    },
  },
  created(){
    if (!!localStorage.getItem('user')) {
      console.log('Tenemos usuario!')
      console.log(this.usuario)
    } else {
      console.log('No hay usuario')
    }
  },
}
</script>
