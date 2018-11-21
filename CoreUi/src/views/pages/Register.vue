<template>
  <div class="app flex-row align-items-center">
    <div class="container">
      <b-row class="justify-content-center">
        <b-col md="6" sm="8">
          <b-card no-body class="mx-4">
            <b-card-body class="p-4">
              <b-form @submit.prevent="register" enctype="multipart/form-data">
                <h1>Registro de nuevos usuarios</h1>
                <p class="text-muted">Crear credenciales</p>

                <b-input-group class="mb-3">
                  <b-input-group-prepend>
                    <b-input-group-text><i class="icon-user"></i></b-input-group-text>
                  </b-input-group-prepend>
                  <b-form-input type="text" class="form-control" placeholder="Nombre y Apellido" autocomplete="username" v-model="credentials.user"/>
                </b-input-group>


                <b-input-group class="mb-3">
                  <b-input-group-prepend>
                    <b-input-group-text>@</b-input-group-text>
                  </b-input-group-prepend>
                  <b-form-input type="text" class="form-control" placeholder="Email" autocomplete="email" v-model="credentials.email"/>
                </b-input-group>

                <b-input-group class="mb-3">
                  <b-input-group-prepend>
                    <b-input-group-text><i class="icon-lock"></i></b-input-group-text>
                  </b-input-group-prepend>
                  <b-form-input type="password" class="form-control" placeholder="Password" autocomplete="new-password" v-model="credentials.password"/>
                </b-input-group>

                <b-input-group class="mb-4">
                  <b-input-group-prepend>
                    <b-input-group-text><i class="icon-lock"></i></b-input-group-text>
                  </b-input-group-prepend>
                  <b-form-input type="password" class="form-control" placeholder="Repeat password" autocomplete="new-password" v-model="credentials.confPassword"/>
                </b-input-group>

                <b-input-group class="mb-4">
                  <b-input-group-prepend>
                    <b-input-group-text><i class="icon-picture"></i></b-input-group-text>
                  </b-input-group-prepend>

<b-form-file type="file" ref='avatarImg' @change="processFile"  placeholder="Selecciona una imagen de perfil" ></b-form-file>

                </b-input-group>

                <b-button variant="success" block @click="submitForm">Crear credenciales</b-button>
              </b-form>
            </b-card-body>
            <b-card-footer class="p-4">
              <b-row>
                <b-col cols="6">
                  <b-button block class="btn btn-facebook"><span>facebook</span></b-button>
                </b-col>
                <b-col cols="6">
                  <b-button block class="btn btn-twitter" type="button"><span>twitter</span></b-button>
                </b-col>
              </b-row>
              <template v-if="regError">
                <b-alert show variant="danger">
                  {{regError}}
                </b-alert>
              </template>
            </b-card-footer>
          </b-card>
        </b-col>
      </b-row>
    </div>
  </div>
</template>

<script>
import {registerNewUser} from '../../../../resources/js/auth.js'

export default {
  name: 'Register',
  data() {
      return  {
        credentials: {
          user     : '',
          email    : '',
          password : '',
          confPassword : '',
          avatar : null
        },
        error      : null
      }
  },
  methods: {
      processFile(event) {
        this.credentials.avatar = event.target.files[0]
      },
      submitForm(){
        let data = new FormData();
        
        data.append('avatar', this.credentials.avatar);
        data.append('user', this.credentials.user);
        data.append('email', this.credentials.email);
        data.append('password', this.credentials.password);

        registerNewUser(data)
          .then((res)=>{
              // this.$store.commit('loginSuccess',res) 
              // this.$router.push({path:'/'})
              console.log('respuesta')
              console.log(res)
            })
          .catch((error)=>{
            // console.log(error)
              this.$store.commit('loginFailed',{error}) 
            })
      },
  },
  computed: {
    regError(){
      return this.$store.getters.authError
    }
  }
}
</script>
