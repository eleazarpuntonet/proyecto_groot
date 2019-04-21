export default {
	getAsideData (state) {
	    return state.asideData
	},
	isAuthenticated (state) {
	    return state.isAuthenticated
	},
	showHost(state){
	    return state.host
	},
	notifications(state){
	    return state.notifications
	},
	showSites(state){
	    return state.sites
	},
	isLoggedIn(state){
	    return state.isLoggedIn
	},
	isLoading(state){
	    return state.loading
	},
	currentUser(state){
	    return state.currentUser
	},
	authError(state){
	    return state.auth_error
	},
	customers(state){
	    return state.customers
	},
	roles(state){
	    return state.roles
	},
	pathAuth(rolesToPath){
	    // console.log(this.state.currentUser.roles)
	    return
	},
	getPaths (state) {
	    return state.path_Auth
	},
}