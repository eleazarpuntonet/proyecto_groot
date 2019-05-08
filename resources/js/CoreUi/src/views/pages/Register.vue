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
      var validatePass = (rule, value, callback) => {
        if (value === '') {
          callback(new Error('Ingrese una contraseña'));
        } else {
          // if (this.form.pass1 !== '') {
          //   this.$refs.registerForm.validateField('pass1');
          // }
          callback();
        }
      };
      var validatePass2 = (rule, value, callback) => {
        if (value === '') {
          callback(new Error('Ingrese la contraseña nuevamente'));
        } else if (value !== this.form.pass1) {
          callback(new Error('Las contraseñas no coinciden, intente nuevamente'));
        } else {
          callback();
        }
      };
      return {
        form : {},
        estado : null,
        error : null,
        rules: {
          email: [
            { required: true, message: 'Ingrese un correo email valido', trigger: 'blur' },
            { type: 'email', message: 'Ingrese un correo email valido', trigger: 'blur' }
          ],
          nombre: [
            { required: true, message: 'El campo de nombre no debe permanecer vacio', trigger: 'blur' },
          ],
          snombre: [
            { required: true, message: 'El campo de apellido no debe permanecer vacio', trigger: 'blur' },
          ],
          pass1: [
            { validator: validatePass, trigger: 'blur' },
            { min: 6, message: 'La contraseña debe tener como minimo 6 caracteres', trigger: 'blur' }
          ],
          pass2: [
            { validator: validatePass2, trigger: 'blur' }
          ],

        },
      };
    },
    methods:{
      registerUser(formName){
        this.$refs[formName].validate((valid) => {
          if (valid) {
            sendNewUser(this.form)
            .then(res=>{
              this.estado = res.status
            })
            .catch(error=>{
              console.log(error)
            })
          } else {
            console.log('Error en formulario')
            return false;
          }
        });
      },
      clearFields(){
        this.$refs[registerForm].resetFields();
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
<template>
  <div class="app mainApp">
    <div class="registerBox boxshadow">
        <div class="logocontainer">
          <img class="navbar-brand-full" src="/img/spsapplogo.png"  alt="Logo SPS">
        </div>
        <div v-if="estado == 200" class="form_line">
            <div class="text infotext">
              <h3>Se ha enviado un link de confirmacion a su correo, una vez confirmado su correo podra iniciar sesion</h3>
            </div>
        </div>
        <div v-else class="login_form">
          <el-form 
            status-icon
            :model="form"  
            :rules="rules"
            ref="registerForm" 
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
              <el-form-item prop="nombre" style="width:50%;">
                <el-input 
                  v-model="form.nombre"
                  placeholder="Nombre">
                    <template slot="prepend"><iconaccount class="iconregister"/></template>
                  </el-input>
              </el-form-item>

              <el-form-item prop="snombre" style="width:50%;">
                <el-input 
                  v-model="form.snombre"
                  placeholder="Apellido">
                    <template slot="prepend"></template>
                  </el-input>
              </el-form-item>
            </div>
            <div class="form_line">
              <el-form-item prop="pass1" style="width:100%;">
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
              <el-form-item prop="pass2" style="width:100%;">
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
                @click.prevent="registerUser('registerForm')"><iconsend class="iconregister"/> Acceder
              </el-button>
              <el-button 
                type="info"
                size="mini"
                @click.prevent="clearFields('registerForm')"><iconsend class="iconregister"/> Limpiar campos
              </el-button>
            </div>
          </el-form>
        </div>
    </div>
  </div>
</template>
<style lang="scss">
.hidden{
  display: none;
}
.mainApp{

  display: flex !important;
  flex-direction: column !important;
  justify-content: center !important;
  .infotext{
    color: #6D6E71;
    font-size: 4vh;
    margin: 20px auto;
    text-align: center;
  }
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
