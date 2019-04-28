<template>
  <div class="app">
    <AppHeader fixed>
      <SidebarToggler class="d-lg-none" display="md" mobile />
      <b-link class="navbar-brand" to="#">
        <img class="navbar-brand-full" src="/img/spsapplogo.png" width="75%" height="75%" alt="Logo SPS">
        <!-- <img class="navbar-brand-full" src="/img/brand/spsapplogo.png" width="89" height="25" alt="CoreUI Logo"> -->
        <img class="navbar-brand-minimized" src="/img/brand/spsapplogo.png" width="30" height="30" alt="CoreUI Logo">
      </b-link>
      <SidebarToggler class="d-md-down-none" display="lg" />
      <b-navbar-nav class="d-md-down-none">
        <b-nav-item class="px-3" to="/dashboard">Dashboard</b-nav-item>
        <b-nav-item class="px-3" to="/perfil_usuario" exact>Users</b-nav-item>
        <b-nav-item class="px-3">Settings</b-nav-item>
      </b-navbar-nav>
      <b-navbar-nav class="ml-auto">
        <b-nav-item class="d-md-down-none">
          <i class="icon-list"></i>
        </b-nav-item>
        <b-nav-item class="d-md-down-none">
          <i class="icon-location-pin"></i>
        </b-nav-item>
        <NotificationsBell/>
        <DefaultHeaderDropdownAccnt/>
      </b-navbar-nav>
      <AsideToggler class="d-none d-lg-block" />
      <!--<AsideToggler class="d-lg-none" mobile />-->
    </AppHeader>
    <div class="app-body">
      <AppSidebar fixed>
        <SidebarHeader/>
        <SidebarForm/>
        <SidebarNav :navItems="nav"></SidebarNav>
        <SidebarFooter/>
        <SidebarMinimizer/>
      </AppSidebar>
      <main class="main">
        <Breadcrumb :list="list"/>
        <div class="wall">
          <router-view></router-view>
        </div>
      </main>
      <AppAside fixed>
        <!--aside-->
        <DefaultAside/>
      </AppAside>
    </div>
    <TheFooter>
      <!--footer-->
      <div>
        <a href="https://coreui.io">CoreUI</a>
        <span class="ml-1">&copy; 2018 creativeLabs.</span>
      </div>
      <div class="ml-auto">
        <span class="mr-1">Powered by</span>
        <a href="https://coreui.io">CoreUI for Vue</a>
      </div>
    </TheFooter>
  </div>
</template>

<script>
  import nav from '../_nav'

  import { 
          Header  as AppHeader,
          Sidebar as AppSidebar,
          Aside   as AppAside,
          Footer  as TheFooter,
          SidebarToggler, 
          SidebarFooter, 
          SidebarForm, 
          SidebarHeader, 
          SidebarMinimizer, 
          SidebarNav, 
          AsideToggler, 
          Breadcrumb 
        } from '@coreui/vue'
  import DefaultAside from './DefaultAside'
  import DefaultHeaderDropdownAccnt from './DefaultHeaderDropdownAccnt'
  import NotificationsBell from '../../../components/notificationsbell.vue'

  export default {
    name: 'DefaultContainer',
    components: {
      AsideToggler,
      AppHeader,
      AppSidebar,
      AppAside,
      TheFooter,
      Breadcrumb,
      DefaultAside,
      DefaultHeaderDropdownAccnt,
      NotificationsBell,
      SidebarForm,
      SidebarFooter,
      SidebarToggler,
      SidebarHeader,
      SidebarNav,
      SidebarMinimizer
    },
    data () {
      return {
        nav: [],
        paths_auth: [],
      }
    },
    computed: {
      name () {
        return this.$route.name
      },
      list () {
        return this.$route.matched.filter((route) => route.name || route.meta.label )
      }
    },
    methods:{
      compareRoles(navitem){
        var flag = false;
        var itemNav = navitem
        if (navitem.length>0) {
          // console.log(itemNav)
          this.$store.getters.currentUser.roles.forEach((val,i)=>{
            // console.log(itemNav)
            // console.log('antes de public')
            if (itemNav == 'public') {
            // if (navitem[0] == val.name || navitem[0]==='public') {
              flag=true
            }
          })
        } else {
          flag=true
        }
        return flag;
      }
    },
    beforeMount(){

      let userid = this.$store.getters.currentUser.roles
      axios.get(route('usuarios.paths',userid)) 
          .then(response => {
            // Esta funcion se encargar
            // de guardar en paths_auth
            // las rutas autorizadas para
            // cada rol del usuario
             response.data.roles.forEach((val,index)=>{
              if (val.auth_roles.length > 0) {
                val.auth_roles.forEach((val,index)=>{
                  if (this.paths_auth.length === 0 ) {
                    this.paths_auth.push(val)
                  } else {
                    let found = this.paths_auth.some(path => path.pathitem_id == val.pathitem_id)
                    if (!found) {
                      this.paths_auth.push(val)
                    }
                  }
                })
              }
             })
            this.$store.commit('ADD_PATHSARR',this.paths_auth)

             nav.items.forEach((val,i,arr)=>{
               // Solo los item de clase 'menuItem entran en la validacion'
               if (val.__proto__.constructor.name == 'menuItem') {
                 // Valida si la funcion permite o no acceder al item de menu   
                 let superFlag = this.paths_auth.some(path => path.pathitem_id == val.id_path)
                 if (superFlag) {

                  if (val.children.length>0) {
                    // Guardo las subrutas/pestanas en una variable
                    // para barrerlos mas tarde
                    let childrens = val.children
                    // Guardo la ruta en una variable
                    // temporal para guardarla en el maestro
                    // de rutas que se imprimiran
                    var temp      = val
                    // Vacio los children de la ruta
                    // en el temporal para que no tenga subrutas/pestanas
                    temp.children = []
                    // Guardo la ruta temporal sin children
                    // en el maestro de rutas a imprimir
                    this.nav.push(temp)
                    // Comienzo a barrer las subrutas para filtrarlas
                    // y guardar solo las subrutas autorizadas
                    childrens.forEach((value,y,arry)=>{
                      // Busca el id_path de las rutas children
                      // en el arreglo paths_auth(que son las rutas autorizadas
                      //  proporcionadas por el servidor)
                      let flagFound = this.paths_auth.some(path => path.pathitem_id == value.id_path)
                      if (flagFound) {
                        this.nav[this.nav.length-1].children.push(value)
                      }
                    })
                    
                  } else{
                    this.nav.push(val)
                  }

                 }
               } else {
                 this.nav.push(val)
               }
             })
            })
          .catch(error => {
            console.log(error)
          })




      // this.nav= nav.items
      // console.log(this.$store.getters.currentUser)
    }
  }
</script>
<style lang="scss">
.wall{
  height: 100%;
  padding: 10px;
  background-color: #DFE3E8;
  -webkit-box-shadow: inset 
  6px //The horizontal offset
  6px //The vertical offset
  7px //The blur radius (optional)
  -5px //The spread radius
  #787986; //Color
     -moz-box-shadow: inset 6px 6px 7px -5px #787986;
          box-shadow: inset 6px 6px 7px -5px #787986;
}
</style>
