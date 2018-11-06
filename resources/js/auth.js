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

export function registerNewUser(credentials){
    return new Promise((res,rej)=>{
        axios.post('api/usuarios', credentials)
                .then((response)=>{
                    res(response.data)
                  })
                .catch((error)=>{
                    rej('Error en registro')
                  })
      })
  }