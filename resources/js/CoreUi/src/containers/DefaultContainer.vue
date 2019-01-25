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
        <div class="container-fluid">
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
      nav: []
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
                                                                  console.log('Entra en public')
          // if (navitem[0] == val.name || navitem[0]==='public') {
            flag=true
          }
        })
      } else {
        flag=true
        console.log('escapa')
      }

      return flag;
    }
  },
  beforeMount(){
    nav.items.forEach((val,i,arr)=>{

    if (val.__proto__.constructor.name == 'menuItem') {
                                                         
      if (this.compareRoles(val.authRol)) {
        
        if (val.children.length>0) {

          let childrens = val.children
          var temp = val
          temp.children=[]

          this.nav.push(temp)
          // console.log(childrens)
          childrens.forEach((value,y,arry)=>{
            console.log('entes del error')
            let temvar = false;
            value.authRol.forEach((valor,x)=>{
                temvar=this.compareRoles(valor)
                
            })
            if (temvar) {
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
    // this.nav= nav.items
    // console.log(this.$store.getters.currentUser)
  }
}
</script>
