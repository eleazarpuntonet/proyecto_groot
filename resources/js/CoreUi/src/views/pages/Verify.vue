<script>
  import {
    verifyMail
  } from '../../../../apiCalls.js'
  import {registerNewUser} from '../../../../auth.js'
  import iconmail from "vue-material-design-icons/at.vue"
  import iconaccount from "vue-material-design-icons/account.vue"
  import iconlock from "vue-material-design-icons/lock.vue"
  import iconsend from "vue-material-design-icons/send.vue"
  export default {
    name: 'Registro',
    data(){
      return {
        form : {},
        error : null,
        estado : null,
      };
    },
    methods:{
    },
    components: {
      iconmail,
      iconaccount,
      iconlock,
      iconsend
    },
    created(){
      verifyMail(this.$router.app._route.params.verifycode)
      .then(res=>{
        this.estado = res.status
        if (res.status == 200 || res.status == 299) {
          setTimeout(()=>{
            this.$router.push({path:'/login'})
          }, 5000);
        }
      })
      .catch(error=>{
        console.log(error)
      })
    }
  }
</script>
<template>
  <div class="app mainApp">
    <div class="registerBox boxshadow">
        <div class="logocontainer">
          <img class="navbar-brand-full" src="/img/spsapplogo.png"  alt="Logo SPS">
        </div>
        <div class="login_form">
          <el-form 
            ref="login_form" 
            :model="form"  
            size="mini">
            <div class="form_line">
              <el-form-item style="width:100%;">
                <div v-if="estado==200" class="text">
                  <h1>Correo confirmado</h1>
                  <h3>Ya puede iniciar sesion en la aplicacion</h3>
                </div>
                <div v-if="estado==299" class="text">
                  <h1>Este correo ya fue confirmado anteriormente</h1>
                </div>
                <div v-if="estado==499" class="text">
                  <h1>El codigo enviado es invalido</h1>
                  <h3>Por favor contacte al departamento de IT</h3>
                </div>
              </el-form-item>
            </div>
            <div class="form_line" style="margin-top: 15px;">
              <el-button 
                type="info"
                size="mini"
                @click.prevent="sendVerify"><iconsend class="iconregister"/>Validar correo
              </el-button>
            </div>
          </el-form>
        </div>
    </div>
  </div>
</template>
<style lang="scss">
.mainApp{
  display: flex !important;
  flex-direction: column !important;
  justify-content: center !important;
  .registerBox{
    width: 50%;
    margin: auto;
    display: flex;
    flex-direction: column;
    justify-content: flex-start;
    $iconsize : 1.5em;
    .material-design-icon.iconregister {
      height: $iconsize;
      width: $iconsize;
    }
    .material-design-icon.iconregister > .material-design-icon__svg {
        height: $iconsize;
        width: $iconsize;
    }
    .text{
      font-family       : 'Eurostile LTS';
      h1{
        color: #6D6E71;
        font-size: 4vh;
      }
    }
    .logocontainer{
      margin: auto;
      width: 100%;  
      img {
          height: auto;
          width: 95%;
          vertical-align: middle;
          border-style: none;
      }    
    }
    .login_form{
      margin-top: 20px;
      color: #6D6E71;
      width: 100%;
      display: flex;
      flex-direction: column;
      justify-content: flex-end;
      padding-bottom: 20px;
      .el-form-item {
          margin: 3px 10px;
      }
    }
  }
}
  .logocontainer{
    display: flex;
    width: 100%;
    flex-direction: column;
    justify-content: center;

  }
</style>
