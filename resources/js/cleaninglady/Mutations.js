import * as mutations  from './types'
export default {
    [mutations.isAuthenticated] (state, payload) {
        // console.log('Recibiendo en autenticated')
        // console.log(payload)
        console.log(payload)
        state.isAuthenticated = true
        state.isLoggedIn  = true
        state.auth_error  = null
        state.loading     = false
        state.currentUser = payload.user
        state.currentUser.token = payload.access_token
        state.currentUser.notifications = payload.notifications
        payload.notifications.forEach((item,index)=>{
          state.notifications.push(JSON.parse(item.data))
        })
            // console.log(state.notifications)
        localStorage.setItem("user", JSON.stringify(state.currentUser))
        localStorage.setItem("jwtToken", state.currentUser.token)
        // console.log(JSON.parse(localStorage.getItem('user')))
        if (!window.Echo.auth) {
            window.Echo.auth= {headers: {Authorization: "Bearer " + state.currentUser.token}}
        }
        axios.defaults.headers.common['Authorization'] = 'Bearer '+state.currentUser.token
    },
    [mutations.addHost](state,value){
        state.host = value
    },
    [mutations.addSite](state,value){
        state.sites = value
    },
    [mutations.login](state){
        state.loading    = true
        state.auth_error = null
    },
    [mutations.loginFailed](state, payload){
        state.loading    = false
        state.auth_error = payload.error
    },
    [mutations.logout](state){
        state.isAuthenticated = false
        // alert('Se elimina el user')
        localStorage.removeItem("user")
        localStorage.removeItem("jwtToken")
        state.loading     = false
        state.currentUser = null
        delete axios.defaults.headers.common['Authorization']
        router.push({path:'/login'})
    },
    [mutations.UPDATE_NOTIF](state,value){
        state.notifications.push(value)
    },
    [mutations.ADD_PATHSARR](state,value){
        value.forEach((v,i)=>{
            state.path_Auth.push(v)
        })
    },
    [mutations.SETASIDEDATA](state,val){
        state.asideData = val
    },
}