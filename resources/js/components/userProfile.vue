<template>
  <div class="mainPerfilContainer">
    <b-card no-body>
      <b-card-header>
        <strong>Perfil de Usuario</strong>
      </b-card-header>
      <b-card-body>
        <img
          :src="'/storage'+usuario.avatar"
          class="imgPerfil"
          alt="admin@bootstrapmaster.com" />
        <b-row>
          <b-col class="headerContainer" lg="12" md="12">
            <p>Texto plano</p>
          </b-col>
        </b-row>
      </b-card-body>
    </b-card>
  </div>
</template>
<script>
  export default{
    name: 'TablaDeUsuarios',
    data: function () {
      return {
        usuario : JSON.parse(localStorage.getItem('user')),
      }
    },
  }
</script>
<style lang="scss">
.mainPerfilContainer{
  h1{
    color: red;
  }
  .headerContainer{
    background-color: blue;
    width: 100%;
  }
  .imgPerfil{
    margin-top: -50px;
  }
}
</style>