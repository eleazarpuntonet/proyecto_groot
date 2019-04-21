import * as mutations  from './types'
export default{
    login (context, payload) {
        context.commit(mutations.isAuthenticated, {
            user : Object.assign({}, payload.data.user, {token: payload.data.access_token}),
            isAuthenticated: true
        })
        router.push({path:'/'})
    },
    sendHost(state,value){
        store.commit(mutations.addHost,value)
    },
    sendSites(state,value){
        store.commit(mutations.addSite,value)
    },
}