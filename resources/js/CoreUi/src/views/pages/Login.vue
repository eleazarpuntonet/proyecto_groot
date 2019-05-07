<template>
  <div class="app mainApp">
    <div class="loginBox boxshadow">
      <div class="form_line">
        <div class="logocontainer">
          <img class="navbar-brand-full" src="/img/spsapplogo.png"  alt="Logo SPS">
        </div>
        <div class="login_form">
          <el-form 
            ref="login_form" 
            :model="form"  
            size="mini">
            <div class="form_line">
              <el-form-item prop="name" style="width:100%;">
                <div class="text">
                  Ingrese las credenciales asociadas a su cuenta
                </div>
              </el-form-item>
            </div>
            <div class="form_line">
              <el-form-item prop="name" style="width:100%;">
                <el-input 
                  v-model="form.email"
                  placeholder="Correo">
                    <template slot="prepend"><iconmail class="iconlogin" /></template>
                  </el-input>
              </el-form-item>
            </div>
            <div class="form_line">
              <el-form-item prop="name" style="width:100%;">
                <el-input 
                type="password"
                  suffix-icon="el-icon-key"
                  placeholder="Contraseña" 
                  v-model="form.password"
                  show-password>
                    <template slot="prepend"><iconlock class="iconlogin" /></template>
                  </el-input>
              </el-form-item>
            </div>
            <div class="form_line">
              <el-button 
                type="info"
                size="mini"
                @click.prevent="authenticate"><iconsend class="iconregister"/> Acceder
              </el-button>
            </div>
          </el-form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import {mLogin} from '../../../../auth.js'
import iconmail from "vue-material-design-icons/at.vue"
import iconsend from "vue-material-design-icons/send.vue"
import iconlock from "vue-material-design-icons/lock.vue"

export default {
  name: 'Login',
  data(){
    return {
      form : {
        email : null,
        password: null
      },
      error : null
    };
  },
  components: {
    iconmail,
    iconlock,
    iconsend
  },
  methods:{
    authenticate(){
      // this.$store.dispatch('login')

      mLogin(this.form)
      .then(res=>{
        this.$store.commit('isAuthenticated',res)
        // this.$store.dispatch('login',res)
        this.$router.push({path:'/'})
      })
      .catch(error=>{
        this.$store.commit('loginFailed', {error})
      })
    }
  }
}
</script>
<style lang="scss">
.mainApp{
  display: flex !important;
  flex-direction: column !important;
  justify-content: center !important;
  .loginBox{
    width: 90%;
    margin: auto;
    .logocontainer{
      width: 70%;  
      img {
          height: auto;
          width: 95%;
          vertical-align: middle;
          border-style: none;
      }    
    }
    .login_form{
      color: #6D6E71;
      width: 30%;
      display: flex;
      flex-direction: column;
      justify-content: flex-end;
      padding-bottom: 4%;
      $iconsize: 1.5em;
      .material-design-icon.iconlogin {
        height: $iconsize;
        width: $iconsize;
      }
      .material-design-icon.iconlogin > .material-design-icon__svg {
          height: $iconsize;
          width: $iconsize;
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
