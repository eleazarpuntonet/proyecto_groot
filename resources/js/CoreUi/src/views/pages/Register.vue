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
                <div class="text">
                  <h1>Registro</h1>
                </div>
              </el-form-item>
            </div>
            <div class="form_line">
              <el-form-item prop="email" style="width:100%;">
                <el-input 
                  v-model="form.email"
                  placeholder="Correo">
                    <template slot="prepend"><iconmail class="iconregister"/></template>
                  </el-input>
              </el-form-item>
            </div>
            <div class="form_line">
              <el-form-item prop="email" style="width:50%;">
                <el-input 
                  v-model="form.nombre"
                  placeholder="Nombre">
                    <template slot="prepend"><iconaccount class="iconregister"/></template>
                  </el-input>
              </el-form-item>

              <el-form-item prop="email" style="width:50%;">
                <el-input 
                  v-model="form.snombre"
                  placeholder="Apellido">
                    <template slot="prepend"></template>
                  </el-input>
              </el-form-item>
            </div>
            <div class="form_line">
              <el-form-item prop="name" style="width:100%;">
                <el-input 
                  type="password"
                  suffix-icon="el-icon-key"
                  placeholder="Contraseña" 
                  v-model="form.pass1"
                  show-password>
                    <template slot="prepend"><iconlock class="iconregister"/></template>
                  </el-input>
              </el-form-item>
            </div>
            <div class="form_line">
              <el-form-item prop="name" style="width:100%;">
                <el-input 
                  type="password"
                  suffix-icon="el-icon-key"
                  placeholder="Ingrese nuevamente la contraseña" 
                  v-model="form.pass2"
                  show-password>
                    <template slot="prepend"><iconlock class="iconregister"/></template>
                  </el-input>
              </el-form-item>
            </div>
            <div class="form_line" style="margin-top: 15px;">
              <el-button 
                type="info"
                size="mini"
                @click.prevent="registerUser"><iconsend class="iconregister"/> Acceder
              </el-button>
            </div>
          </el-form>
        </div>
    </div>
  </div>
</template>

<script>
  import {
    sendNewUser
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
      error : null
    };
  },
  methods:{
    registerUser(){
      sendNewUser(this.form)
      .then(res=>{
        console.log()
        // this.$store.commit('isAuthenticated',res)
        // this.$router.push({path:'/'})
      })
      .catch(error=>{
        // this.$store.commit('loginFailed', {error})
      })
    },
    handleSelect(item){
      console.log(item)
    }
  },
  components: {
    iconmail,
    iconaccount,
    iconlock,
    iconsend
  }
}
</script>
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
        font-size: 7vh;
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
