<template>
	<div>
		<b-card no-body>
			<b-card-header>
				<strong>Reservas</strong>
			</b-card-header>
			<b-card-body>

        <el-container>
          <el-aside width="30%">
            <el-menu
              default-active="2"
              class="el-menu-vertical-demo">
              <el-menu-item index="1">
                <i class="el-icon-menu"></i>
                <span>Information Techonologi</span>
              </el-menu-item>
              <el-menu-item index="2">
                <i class="el-icon-menu"></i>
                <span>Asuntos Publicos</span>
              </el-menu-item>
              <el-menu-item index="3">
                <i class="el-icon-menu"></i>
                <span>Junta Directiva</span>
              </el-menu-item>
              <el-menu-item index="4">
                <i class="el-icon-menu"></i>
                <span>Junta Directiva</span>
              </el-menu-item>
            </el-menu>
          </el-aside>


          <el-container>
            <el-header>
              <h1>Fuerza de Trabajo</h1>
            </el-header>
            <el-main>
              <el-table
                :data="lista_usuarios"
                style="width: 100%">
                <el-table-column type="expand">
                  <template slot-scope="props">
                    <el-row>
                      <el-col :span="8">
                        <div class="grid_8content">
                          Roles:
                          <div class="roles_box">
                            <el-tag size="mini" type="info" v-for="item in props.row.roles" :key="item.id">
                              {{item.display_name}} 
                            </el-tag>
                          </div>
                        </div>
                      </el-col>
                      <el-col :span="8">
                        <div class="grid_8content">
                          Canal regular
                          {{props.row}}
                          <!-- <p>Coordinador: {{props.row.departamento.coordinador.name}} {{props.row.departamento.coordinador.last_name}}</p> -->
                          <!-- <p>Gerente : {{props.row.departamento.gerente.name}} {{props.row.departamento.gerente.last_name}}</p> -->
                        </div>
                      </el-col>
                      <el-col :span="8">
                        <div class="grid_8content">
                          Canales de contacto:
                          <div class="main_canal_contacto">
                            Correo: eleazaro@spservicesltd.uk
                          </div>
                        </div>
                      </el-col>
                    </el-row>
                  </template>
                </el-table-column>
                <el-table-column
                  label="Nombre"
                  prop="user">
                  <template slot-scope="scope">
                    {{scope.row.name}} {{scope.row.last_name}}
                  </template>
                </el-table-column>
                <el-table-column
                  label="Cargo"
                  prop="cargo">
                </el-table-column>
                <el-table-column
                  label="Sede"
                  prop="sede">
                </el-table-column>
                <el-table-column
                  label="Departamento"
                  prop="departamento.disp_name">
                </el-table-column>
              </el-table>
            </el-main>
            <el-footer>Pie de página</el-footer>
          </el-container>
        </el-container>





			</b-card-body>
		</b-card>
	</div>
</template>

<script>

export default {
  /*
  *
  * Variables del componente
  */
  data () {
    return {
      lista_usuarios: [],
    }
  },
  computed: {
  },
  watch: {
  },
  methods: {
  },
  created() {
  },
  beforeMount(){
  	axios.get(route('usuarios.index')) 
  	    .then(response => {
          this.lista_usuarios=response.data.data
  	        console.log(response)
  	      })
  	    .catch(error => {
  	      // this.$notify.error({
  	      //   title: 'Error '+error.response.status,
  	      //   message: error.response.data.message
  	      // });
  	    })
        console.log('Ejecutando ando')
  }
}
</script>
<style lang="scss">
.grid_8content{
  width:100%;
  display: flex;
  flex-direction: column;
  justify-content: center;
}
.icon_container{
  width: 6.5vh;
  height: 6.5vh;
}

</style>
