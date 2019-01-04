<template>
  <div class="app flex-row align-items-center">
    <div class="container">
      <b-row class="justify-content-center">
        <b-col md="6">
          <b-card-group>
            <b-card no-body class="p-8">
              <b-card-body>
                  <img class="navbar-brand-full" src="/img/spsapplogo.png" width="90%" height="auto" alt="Logo SPS">
                <b-form>
                  <h1 style="margin-top:35px;">Inicio de Sesion</h1>
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
                      <b-button variant="link" class="px-0">Recuperar credenciales</b-button>
                    </b-col>
                  </b-row>

                </b-form>
              </b-card-body>
            </b-card>
          </b-card-group>
        </b-col>
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
  .app{
    background-image: url("/img/login_back.jpg");
    background-repeat: no-repeat;
    // background-position: right top;
  }
</style>
