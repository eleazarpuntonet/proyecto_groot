class Actionauth{
  constructor(item_id){
    this.actionid = item_id
    this.lee      = false
    this.escribe  = false
    this.borra    = false
    this.crea     = false

    // arguments.length //Es la cantidad de argumentos pasados a una funcion
  }

  setInfo(obj){
    this.name = obj.name
    this.desc = obj.desc
  }

  lee(){
    return this.lee  
  }

  escribe(){
    return this.escribe  
  }

  borra(){
    return this.borra  
  }

  crea(){
    return this.crea  
  }

  setAuth(actions){
   if (actions.length>0) {
      actions.forEach((val,index)=>{
        if (val.action_id == this.actionid) {
          this.setInfo({
            name: val.action_desc,
            desc: val.action_desc
          })
          // let permissions  = val.action_permissions.split("")
          this.lee     = true
          this.escribe = true
          this.borra   = true
          this.crea    = true
        }

      })
    }
    return this
  }
}


var submit_roles = new Actionauth('dataload003i1')
var submit_paths = new Actionauth('dataload003i2')

export default {
  submit_roles,
  submit_paths,
}