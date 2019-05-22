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
    .then(response => {
      console.log(response)
      var permisos = []
      response.data.forEach((each, index) =>{
        let t         = {}
        t.action_id   = each.action_id
        t.action_name = each.actions.action_name
        t.action_desc = each.actions.action_desc
        t.action_id   = each.actions.action_id
        t.role_id     = each.role_id
        t.lee         = JSON.parse(each.lee)
        t.escribe     = JSON.parse(each.escribe)
        t.modifica    = JSON.parse(each.modifica)
        t.borra       = JSON.parse(each.borra)
        permisos.push(t)
      })
      res(permisos)
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
    },
    changeDisabled(bool){
      this.rutasTree.forEach((each)=>{
        !bool?each.disabled = true:each.disabled = false
        if (each.children.length>0) {
          each.children.forEach((eachA)=>{
            !bool?eachA.disabled = true:eachA.disabled = false
          })
        }
      })
    },
    diffRutas(checkd,autoriz){
      let deleted = autoriz.filter(x => !checkd.includes(x.ruta_id))
      let added   = checkd.filter(x => !autoriz.some(item => item.ruta_id === x))
      return {'deleted': deleted.map(x => x.ruta_id),
              'added' : added}
    }
  }
  rutas.items.forEach((val,index)=>{
    if (val.__proto__.constructor.name == 'menuItem') {
      var stRuta               = {}
      stRuta.ruta_id           = val.id_path
      stRuta.flagAll           = false
      stRuta.flagIndetermiante = false
      stRuta.name              = val.name
      stRuta.disabled              = true
      rutasx.rutasInline.push(stRuta)
      stRuta.children          = []
      stRuta.hasChildren       = true
      val.children.forEach((value,index)=>{
        let x     = {}
        x.disabled = true
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

export function sendRutasActualizadas(val){
  return new Promise((res,rej)=>{
    let x = {}
    x.data = JSON.stringify(val);
    axios.post(route('roles.savepath',x))
    .then(response => {
      console.log(response)
      res(response)
    }).catch( error => {
      rej(error)
    })
  })
}

export function sendPermisosActualizados(val){
  return new Promise((res,rej)=>{
    let x = {}
    x.data = JSON.stringify(val);
    axios.post(route('roles.savepermisos',x))
    .then(response => {
      console.log(response)
      res(response)
    }).catch( error => {
      rej(error)
    })
  })
}

export function getDepartamentos(){
  return new Promise((res,rej)=>{
    axios.get(route('gerencias.index')) 
    .then(response => {
      res(response.data)
    }).catch(error => {
      rej(error)
    })
  })
}

export function getUsuarios(){
  return new Promise((res,rej)=>{
    axios.get(route('usuarios.index')) 
        .then(response => {
          res(response.data)
          })
        .catch(error => {
          rej(error)
        })
  })
}

export function getAccesos(val){
  return new Promise((res,rej)=>{
    let x = {}
    x.data = JSON.stringify(val);
    axios.post(route('roles.accesos',x))
    .then(response => {
      let permisos = []
      response.data.forEach((each)=>{
        if (!permisos.some(item => item.action_id == each.action_id)) {
          permisos.push(each)
        } else {
          let index = permisos.findIndex(item => item.action_id == each.action_id)
          permisos[index].borra    == each.borra ? null : permisos[index].borra = true
          permisos[index].lee      == each.lee ? null : permisos[index].lee = true
          permisos[index].escribe  == each.escribe ? null : permisos[index].escribe = true
          permisos[index].modifica == each.modifica ? null : permisos[index].modifica = true
        }
      })
      res(permisos)
    }).catch( error => {
      rej(error)
    })
  })
}

export function sendNewUser(credentials){
  return new Promise((res,rej)=>{
    axios.post(route('auth.register',credentials)) 
        .then(response => {
          res(response)
          })
        .catch(error => {
          rej(error)
        })
  })
}

export function verifyMail(verification_code){
  return new Promise((res,rej)=>{
    axios.get(route('auth.verify',verification_code)) 
        .then(response => {
          console.log(response)
          res(response)
          })
        .catch(error => {
          rej(error)
        })
  })
}
export function firmaSPS(user){
  let x = {}
  x.user = JSON.stringify(user);
  return new Promise((res,rej)=>{
    axios.get(route('textOnImage',x),{responseType: 'blob'}) 
        .then(response => {
          console.log(response)
          res(response)
          })
        .catch(error => {
          rej(error)
        })
  })
}

export function fileUpload(file){
  return new Promise((res,rej)=>{
    axios.post(route('files.storefile','algo')) 
        .then(response => {
          console.log(response)
          res(response)
          })
        .catch(error => {
          rej(error)
        })
  })
}