<template>
    <div class="container">
        
        <div class="container-fluid mainTitle">
            <div class="row">
                <div class="col"></div>
                <div class="col">
                    <h1>Proveedores de Servicios</h1>
                </div>
                <div class="col"></div>
            </div>
        </div>
        <div class="container" id="mainTableProveedores">
            <table id="tableProv" class="table">
              <thead class="thead-light">
                <tr>
                    <th v-for="heading in tableHeading">
                        {{heading}}
                    </th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="data in mutabledatasend">
                    <td scope="row">
                        <a :href="showSite(data.id)">{{ data.nombre }}</a>
                    </td>
                    <td>{{ data.cuenta }}</td>
                    <td>{{ data.usuario }}</td>
                    <td>{{ data.password }}</td>
                    <td>{{ data.comentarios }}</td>
                    <td>
                        <div class="container" id="editButtons">
                            <div class="button-btn">
                                <button type="button" class="btn btn-light btn-sm">
                                    <a :href="editSite(data.id)" >Editar</a>
                                </button>
                            </div>
                            <div class="button-btn">
                                <button type="button" class="btn btn-light btn-sm">
                                    <a @click="delSite(data.id)" >Eliminar</a>
                                </button>
                            </div>
                        </div>
                    </td>
                </tr>
              </tbody>
            </table>
        </div>

    </div>
</template>

<script>
export default {
    props: ['datasend'],
    data() {
        return  {
            tableHeading : ['Nombre','Cuenta','Usuario','Password','Comentarios','Editar'],
            mutabledatasend : '',
        }
    },
    mounted() {
        this.mutabledatasend= JSON.parse(this.datasend)
    },
    methods:{
        editSite(id){
            return route('proveedores.edit',id)
        },
        delSite(id){
            return axios.post(route('proveedores.destroy',id),{ _method: 'delete'})
                        .then((res)=>{
                            console.log(res);
                        })
                        .catch((error) => {
                            // console.log(error)
                            // Error
                            if (error.response) {
                                // El request fue enviado pero el servidor
                                //respondio con un codigo de error
                                console.log(error.response.data);
                                console.log(error.response.status);
                                console.log(error.response.headers);
                            } else if (error.request) {
                                console.log("The request was made but no response was received")
                                // The request was made but no response was received
                                // `error.request` is an instance of XMLHttpRequest in the browser and an instance of
                                // http.ClientRequest in node.js
                                console.log(error.request);
                            } else {
                                // Something happened in setting up the request that triggered an Error
                                console.log('Something happened in setting up the request that triggered an Error', error.message);
                            }
                            // console.log(error.config);
                        });
        },
        showSite(id){
            return route('proveedores.show',id)
        }
    }
}
</script>

