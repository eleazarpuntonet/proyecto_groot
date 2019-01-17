<template>
  <AppHeaderDropdown right no-caret>
    <template slot="header">
      <div>
        <i class="icon-bell"></i>
        <b-badge pill variant="danger">{{$store.getters.currentUser.notifications.length}}</b-badge>
      </div>
    </template>\
    <template slot="dropdown">
      <b-dropdown-header 
        tag="div" 
        class="text-center"><strong>Notificaciones</strong>
      </b-dropdown-header>
      <b-dropdown-item>
        <i class="fa fa-bell-o" />
        Reservas
        <b-badge variant="info">{{ itemsCount }}</b-badge>
        <div style="height: 30px; background-color: yellow;">
          algo nuevo
        </div>
      </b-dropdown-item>
      <b-dropdown-item><i class="fa fa-envelope-o" /> Mensajes
        <!-- <b-badge variant="success">{{ itemsCount }}</b-badge> -->
      </b-dropdown-item>
      <b-dropdown-item><i class="fa fa-tasks" /> Tareas
        <!-- <b-badge variant="danger">{{ itemsCount }}</b-badge> -->
      </b-dropdown-item>
      <b-dropdown-item><i class="fa fa-comments" /> Comentarios
        <!-- <b-badge variant="warning">{{ itemsCount }}</b-badge> -->
      </b-dropdown-item>
    </template>
  </AppHeaderDropdown>
</template>

<script>
import { HeaderDropdown as AppHeaderDropdown } from '@coreui/vue'
export default {
  name: 'NotificationsBell',
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
    console.log('recibiendo en bell')
    console.log(this.$store.getters.currentUser.notifications.length)
  },
}
</script>