<template>
  <AppHeaderDropdown right no-caret>
    <template slot="header">
      <div>
        <i class="icon-bell"></i>
        <b-badge pill :variant="notifications.length>0?'success':'danger'">{{notifications.length}}</b-badge>
      </div>
    </template>\
    <template slot="dropdown">
  <b-dropdown-header 
    tag="div" 
    class="text-center l_dropdown-header"><strong>Notificaciones</strong>
  </b-dropdown-header>
  <div class="l_dropdownbody">
    <b-dropdown-item 
          v-for="(todoItem,x) in notifications"
         :data="todoItem"
         :key="x" 
         class="l_dropdown-item">
      <div class="l_mainnotif">
        <div class="l_icon">
          <i class="fas fa-info"></i>
        </div>
        <div class="l_mainbox">
          <div class="l_notifbox box_a">
            <div class="l_notifitem" >
              <strong>{{todoItem.user}}</strong> {{todoItem.text}}
            </div>
          </div>
          <div class="l_notifbox box_b">
            <div class="l_notifitem">
              <strong>{{todoItem.datereserva}}</strong>
            </div>
            <div class="l_notifitem">
              <el-button size="mini" round class="buttonnotif" @click.prevent="shownotif(todoItem)">Ver reserva</el-button>
            </div>
          </div>
        </div>
      </div>
    </b-dropdown-item>
  </div>
    </template>
  </AppHeaderDropdown>
</template>

<script>
import { HeaderDropdown as AppHeaderDropdown } from '@coreui/vue'
export default {
  name: 'NotificationsBell',
  buffer: null,
  components: {
    AppHeaderDropdown
  },
  data: () => {
    return { 
      itemsCount: 42 ,
      notificaciones: [] ,
      usuario : JSON.parse(localStorage.getItem('user')),
    }
  },
  computed: {
    notifications: { 
      cache: false, 
      get(){
       return this.$store.getters.notifications 
      } 
    },
  },
  watch: {
  },
  methods:{
    loadata(valor){
      this.buffer = JSON.parse(valor);
    },
    logout(){
      this.$store.commit('logout')
      this.$router.push({path:'/login'})
    },
    shownotif(val){
      console.log(val)
      this.$router.push({ path: `/reservas/${val.reservaid}` })
    }
  },
  created(){
  },
  mounted(){
    window.Echo.channel('reservas-channel').listen('NuevaReserva',(payload)=>{
            console.log('Redibiendo por channel');
            console.log(payload);
            this.$notify({
              title: 'Notificacion',
              message: payload.data.user.toUpperCase()+' '+payload.data.text,
              type: 'success'
            });
            this.$store.commit('UPDATE_NOTIF',payload.data)
        });
  }
}
</script>
<style lang="scss">
@import url('https://fonts.googleapis.com/css?family=Nunito|Nunito+Sans|Poppins|Roboto|Roboto+Condensed|Roboto+Mono');
  $textcolor : #231F20;
  .l_dropdownbody {
      height: 100%;
      max-height: 60vh;
      display: flex;
      flex-direction: column;
      overflow: scroll;
  }
  .buttonnotif{
    height: 1rem !important;
    padding-top: 0px !important;
    padding-bottom: 0px !important;
    display: flex !important;

    span{
      font-size: 0.6rem;
    }
  }
  .l_dropdown-header{
    background-color: #BBBDC0;
    color: #231F20;
  }
  .l_dropdown-item{
    background-color: rgba(251, 175, 63, 0.8) !important;
    border-top: 1px solid rgba(35, 31, 32, 0.8);
  }

  .l_mainnotif{
    display: flex;
    flex-direction: row;
    .l_icon{
    display: flex;
    flex-direction: column;
    justify-content: center;
    font-size: 1.6rem;
      i {
        color : $textcolor;
      }
    }
    .l_mainbox{
      .box_a{
        font-family: 'Nunito Sans', sans-serif;
        font-size: 0.9rem;
        color: #231F20;
      }
      .box_b{
        font-family: 'Roboto Mono', monospace;
        font-size: 0.6rem;
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        color: rgba(35, 31, 32, 0.8);
      }
      .l_notifbox{
        display: flex;
        flex-direction: row;
      }
    }
  }
</style>