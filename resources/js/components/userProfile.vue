<template>
  <div class="mainPerfilContainer">
    <b-card no-body>
      <b-card-header>
        <strong>Perfil de Usuario</strong>
      </b-card-header>
      <b-card-body>
        <b-row class="mainHeaderContainer">
          <b-col class="headerContainer" lg="9" md="9">
            <div class="headerItem">
              <p class="title">{{ usuario.name }} {{ usuario.last_name }}</p>
            </div>
            <div class="headerItem">
              <p>{{ usuario.cargo }}</p>
            </div>
            <div class="headerItem">
              <p>{{ usuario.gerencia }}</p>
            </div>
            <div class="headerItem">
              <p>{{ usuario.sede }}</p>
            </div>
            <div class="headerItem">
              <p>{{ usuario.email }}</p>
            </div>
            <div class="headerItem mainRoles">
              <div class="itemRoles">
                <p>Roles:</p>
              </div>
              <div class="itemRole" v-for="role in usuario.roles" style="list-style:none;">
                <el-button 
                  type="info" 
                  round
                  size="mini">{{ role.display_name}}</el-button>
              </div>
            </div>
          </b-col>
          <b-col class="headerContainer text-center" lg="3" md="3">
            <div class="headerItem itemAvatar">
              <el-upload
                class="avatar-uploader"
                action="#"
                :show-file-list="false"
                :on-success="handleAvatarSuccess"
                :before-upload="beforeAvatarUpload">
                <img 
                  :src="'/storage'+usuario.avatar" 
                  class="imgPerfil overlay"
                  alt="admin@bootstrapmaster.com">
              </el-upload>
            </div>
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
        imageUrl : null,
      }
    },
    methods: {
      handleAvatarSuccess(res, file) {
        this.imageUrl = URL.createObjectURL(file.raw);
      },
      beforeAvatarUpload(file) {
        const isJPG = file.type === 'image/jpeg';
        const isLt2M = file.size / 1024 / 1024 < 2;

        if (!isJPG) {
          this.$message.error('La imagen debe estar en formato JPG!');
        }
        if (!isLt2M) {
          this.$message.error('La imagen excede los 2MB!');
        }
        return isJPG && isLt2M;
      }
    },
    mounted(){
      this.imageUrl = JSON.parse(localStorage.getItem('user')).avatar
    }
  }
</script>
<style lang="scss">
.mainPerfilContainer{
  .mainHeaderContainer{
    .headerContainer{
      display: inline-flex;
      flex-direction: column;
      justify-content: space-evenly;
      padding: 5px;
      // background-color: rgba(0, 0, 255, 0.5);
      width: 100%;
      .headerItem{
        box-shadow: 2px 2px 10px rgba(100, 100, 100, 0.3);
        // background-color: rgba(164, 74, 64, 1);
        margin: 2px;
        padding-left: 5px;
        padding-right: 5px;
        p{
          text-shadow: 1px 1px 2px rgba(128, 128, 128, 0.7);
          font-size: 0.95rem;
          font-family: 'Helvetica Neue';
          margin: auto;
          font-style: italic;
          color: rgba(82, 82, 82, 1)
        }
        .avatar-uploader{
          width:100%;
        }
        .title{
          color : rgba(12, 38, 75, 1);
          margin-bottom: 0px;
          text-shadow: 2px 2px 2px rgba(128, 128, 128, 0.8);
          font-size: 2rem;
          font-family: 'Helvetica Neue';
          margin: auto;
        }
      }
      .mainRoles{
        display: flex;
        flex-flow: row wrap;

        .itemRole{
          margin: 1px;
        }
      }
      .itemAvatar{
        height:100%;
        display: flex;
        flex-direction: column;
        justify-content: space-evenly;
        border-radius: 50%;
      }
    }
    .imgPerfil{
      width: 100%;
      border-radius: 50%;
      border: 3px solid rgba(137, 137, 137, 1);      
    }
    .imgPerfil:hover{
        width:100%;
        height:100%;
        // position:absolute;
        background-color:rgba(0, 0, 0, 1);
        opacity: 0.8;
    }
  }
}
</style>