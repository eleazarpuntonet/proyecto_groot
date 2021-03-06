export function mLogin(credentials){
  return new Promise((res,rej)=>{
      axios.post('/api/auth/login', credentials)
              .then((response)=>{
                  res(response.data)
                })
              .catch((error)=>{
                  rej('Credenciales Invalidas')
                })
    })
}

export function getLocalUser(){
  const userStr = localStorage.getItem('user')
  if (!userStr) {
      return null
    }
  return JSON.parse(userStr)                             
}
export function getLocalUserPermisos(){
  const permisos = localStorage.getItem('userPermisos')
  console.log('Estoy en user permisos')
  console.log(JSON.parse(permisos))
  if (!permisos) {
      return []
    }

  return JSON.parse(permisos)                             
}

export function registerNewUser(data){
  return new Promise((res,rej)=>{
    console.log(data)
      axios.post('api/usuarios', data,{
            headers: {
                    'Content-Type': 'multipart/form-data'
                }
              })
              .then((response)=>{
                  res(response.data)
                })
              .catch((error)=>{
                console.log(error)
                  rej('Error en registro')
                })
    })
}

