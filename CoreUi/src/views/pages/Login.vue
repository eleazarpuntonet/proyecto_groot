<template>
  <div class="app flex-row align-items-center">
    <div class="container">
      <b-row class="justify-content-center">
        <b-col md="8">
          <b-card-group>
            <b-card no-body class="p-4">
              <b-card-body>
                <b-form @submit.prevent="login(user,requestOption)">
                  <h1>Iniciar Sesion</h1>
                  <p class="text-muted">Sign In to your account</p>
                  <b-input-group class="mb-3">
                    <b-input-group-prepend><b-input-group-text><i class="icon-user"></i></b-input-group-text></b-input-group-prepend>
                    <b-form-input type="text" class="form-control" placeholder="Usuario" autocomplete="username email" v-model="user.email"/>
                  </b-input-group>
                  <b-input-group class="mb-4">
                    <b-input-group-prepend><b-input-group-text><i class="icon-lock"></i></b-input-group-text></b-input-group-prepend>
                    <b-form-input type="password" class="form-control" placeholder="Contraseña" autocomplete="current-password" v-model="user.password"/>
                  </b-input-group>
                  <b-row>
                    <b-col cols="6">
                      <b-button type="submit" variant="primary" class="px-4">Login</b-button>
                    </b-col>
                    <b-col cols="6" class="text-right">
                      <b-button variant="link" class="px-0">Forgot password?</b-button>
                    </b-col>
                  </b-row>
                </b-form>
              </b-card-body>
            </b-card>
            <b-card no-body class="text-white bg-primary py-5 d-md-down-none" style="width:44%">
              <b-card-body class="text-center">
                <div>
                  <h2>Sign up</h2>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                  <router-link to="/register">
                    <b-button variant="primary" class="active mt-3" router-link="/register">Formulario de Registro</b-button>
                  </router-link>
                </div>
              </b-card-body>
            </b-card>
          </b-card-group>
<template v-if="authError">
  <b-alert show variant="danger">
    {{authError}}
  </b-alert>
</template>
        </b-col>
      </b-row>
    </div>
  </div>
</template>

<script>
import {mLogin} from '../../../../resources/js/auth.js'
export default {
  name: 'Login',
  data() {
      return  {
        user: {
          email    : '',
          password : '',
        },
        requestOption : {
          url : '/api/auth/login'
        },
        error      : null
      }
  },
  methods: {
    login () {
      this.$auth.login(this.user).then((response)=>{
        this.$store.dispatch('login', response)

      })
    },
  },
  computed: {
    authError(){
      return this.$store.getters.authError
    },
    isAuthenticated() {
      return this.$store.getters.isAuthenticated()
    }
  }
}
</script>
