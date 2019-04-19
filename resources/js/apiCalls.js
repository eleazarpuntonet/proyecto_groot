export function getActions(){
  return new Promise((res,rej)=>{
    axios.get(route('roles.create')) 
    .then(response => {
      res(response.data)
    }).catch(error => {
      rej(error)
    })
  })
}

export function getRoles(){
  return new Promise((res,rej)=>{
    axios.get(route('roles.index')) 
    .then(response => {
      res(response.data)
    }).catch(error => {
      rej(error)
    })
  })
}

export function currUserActions(userId){
  return new Promise((res,rej)=>{
    axios.get(route('usuarios.actionsauth',userId)) 
    .then(response => {
      res(response.data)
    }).catch( error => {
      rej(error)
    })
  })
}

export function getRutasRoles(userId){
  return new Promise((res,rej)=>{
    axios.post(route('roles.Authpath',userId))
    .then(response => {
      res(response.data.auth_roles)
    }).catch( error => {
      rej(error)
    })
  })
}

export function getPermisosRutasRoles(val){
  return new Promise((res,rej)=>{

    let x = {}
    x.data = JSON.stringify(val);
    axios.post(route('roles.permisos',x))
    // axios.post(route('roles.permisos','informacion enviada'))
    .then(response => {
      console.log("recibniendo paquete")
      res(response)
    }).catch( error => {
      rej(error)
    })
  })
}

export function GetRutas(rutas){
  let rutasx = {
    rutasTree   : [],
    rutasInline : [],
    rutasFilter(rutasAutorizadas){
      let rutasFiltradas = []
      rutasAutorizadas.forEach((val,index)=>{
        rutasFiltradas.push(this.rutasInline.find((ruta => ruta.ruta_id === val.pathitem_id)))
      })
    return rutasFiltradas
    }
  }
  rutas.items.forEach((val,index)=>{
    if (val.__proto__.constructor.name == 'menuItem') {
      var stRuta               = {}
      stRuta.ruta_id           = val.id_path
      stRuta.flagAll           = false
      stRuta.flagIndetermiante = false
      stRuta.name              = val.name
      stRuta.cont              = []
      stRuta.act               = []
      rutasx.rutasInline.push(stRuta)
      stRuta.children             = []
      stRuta.hasChildren = true
      val.children.forEach((value,index)=>{
        let x     = {}
        x.ruta_id = value.id_path
        x.flag    = false
        x.name    = value.name
        rutasx.rutasInline.push(x)
        stRuta.children.push(x)
      })
      rutasx.rutasTree.push(stRuta)
    }
  })
  return rutasx
}
