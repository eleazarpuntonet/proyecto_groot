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
