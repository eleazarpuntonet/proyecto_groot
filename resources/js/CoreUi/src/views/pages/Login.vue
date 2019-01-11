<template>
  <div class="app flex-row align-items-center">
    <div class="container">
      <b-row class="justify-content-center">
        <div class="loginbox loginv boxshadow">
          <div class="logocontainer">
            <img class="navbar-brand-full" src="/img/spsapplogo.png" width="90%" height="auto" alt="Logo SPS">
          </div>
          <div class="formm">
            <b-form class="formbox">
              <p class="text-muted">Ingrese las credenciales asociadas a su cuenta</p>
              <b-input-group class="mb-3">

                <b-input-group-prepend>
                  <b-input-group-text>
                    <i class="icon-user"></i>
                  </b-input-group-text>
                </b-input-group-prepend>

                <b-form-input 
                type="text" 
                v-model="form.email"
                class="form-control" 
                placeholder="Correo" 
                autocomplete="username email" />
              </b-input-group>

              <b-input-group class="mb-4">
                <b-input-group-prepend>
                  <b-input-group-text>
                    <i class="icon-lock"></i>
                  </b-input-group-text>
                </b-input-group-prepend>
                <b-form-input 
                v-model="form.password"
                type="password" 
                class="form-control" 
                placeholder="Contraseña" 
                autocomplete="current-password" />
              </b-input-group>

              <b-row>
                <b-col cols="6">
                  <b-button 
                  @click.prevent="authenticate"
                  variant="primary" 
                  class="px-4"
                  >Acceder
                </b-button>
                </b-col>
                <b-col cols="6" class="text-right">
                  <!-- <b-button variant="link" class="px-0">Recuperar credenciales</b-button> -->
                </b-col>
              </b-row>

            </b-form>
          </div>
        </div>

      </b-row>
    </div>
  </div>
</template>

<script>
import {mLogin} from '../../../../auth.js'

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
.formm{
  display: flex;
  width: 100%;
  justify-content: center;
}
  .app{
    // background-image: url("/img/login_back.jpg");
    // background-repeat: no-repeat;
    // background-position: right top;
  }
  .logocontainer{
    display: flex;
    justify-content: center;
    width: 100%;
    // display: flex;
    // flex-direction: row;
    justify-content: center;

  }
  .formbox{
    width: 50vh;
  }
  .loginbox{
    display: flex;
    justify-content: center;
    .logocontainer{
  
    }
    .formm{
          
          
        }
  }
  .loginh{
    flex-direction: column;
    .formm{
      flex-direction: row;
      margin:20px;
      .formbox{
        width: 63vh;
      }
    }
    .logocontainer{
      flex-direction: row;
      margin:20px;
      img{
        height: 50vh;
      }
    }
  }
  .loginv{
    flex-direction: row;
    .formm{
      height: 50vh;
      flex-direction: column;
      padding-top: 6.5vw;
      margin:20px;
    }
    .logocontainer{
      flex-direction: column;
      height: 50vh;
      margin:20px;
      img{
        width: 90vh;
      }
    }
  }
</style>
