import {getLocalUser}    from         '../auth.js'
const user = getLocalUser()
export default{
    isAuthenticated  : false,
    asideData        : null,
    host             : '',
    sites            : '',
    currentUser      : user,
    roles_auth       : [],
    notifications    : [],
    socket_connected : null,
    isLoggedIn       : !!user,
    loading          : false,
    auth_error       : null,
    customers        : [],
    roles            : [],
    path_Auth        : [],
}