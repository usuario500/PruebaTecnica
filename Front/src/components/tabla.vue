<template>
    <div>
        <!-- Mostrar personas en la base de datos-->
        <div v-if="show">   
            <button id="app" @click="show=false">Añadir</button>
            <table id="tabla">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Edad</th>
                        <th>Accion</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="persona in personas" :key="persona.id">
                        <td>{{ persona.nombre }}</td>
                        <td>{{ persona.edad }}</td>
                        <td>
                            <button @click="editar(persona)">Editar</button>
                            <button @click="eliminarPersona(persona.id)">Borrar</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Añadir y actualizar persona-->
        <div v-else>

            <!-- Añadir -->
            <div v-if="añadir" id="app">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" v-model="addedPersona.nombre" />
                <br>
                <label for="correo">Edad:</label>
                <input type="number" id="edad" v-model="addedPersona.edad" />
                <br>
                <button @click="canselar">Canselar</button>
                <button @click="guardarPersona">Enviar</button>
            </div>

            <!-- Actualizar -->
            <div v-else id="app">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" v-model="editedPersona.nombre" />
                <br>
                <label for="correo">Edad:</label>
                <input type="number" id="edad" v-model="editedPersona.edad" />
                <br>
                <button @click="canselar">Canselar</button>
                <button @click="actualizarPersona">Enviar</button>
            </div>
        </div>
    </div>
</template>

<script>
import api from '@/api/apiPrueba'
export default { 
    name: 'tabla', 
    data () {
        return {
            show: true,
            añadir: true,
            personas:[],
            addedPersona: {
              nombre: '',
              edad: ''
            },
            editedPersona: {
              id: 0, 
              nombre: '',
              edad: ''
            }
        }
    },
    methods: {

        //Metodos para insertar, leer, actualizar y eliminar
        obtenerPersona() {
            api.get('/personas').then(response => {
                this.personas = response.data;
                console.log(this.personas);
            }).catch(error=>{
                console.error(error);
            })
        },
        guardarPersona() {
            api.post('/personas',
              {
                "nombre": this.addedPersona.nombre,
                "edad" : this.addedPersona.edad
              } ).then(response => {
                this.obtenerPersona();
                this.canselar();
            }).catch(error=>{
                console.error(error);
            })
        },
        actualizarPersona() {
            api.put('/personas/' + this.editedPersona.id,
              {
                "nombre": this.editedPersona.nombre,
                "edad" : this.editedPersona.edad
              } ).then(response => {
                this.obtenerPersona();
                this.canselar();
            }).catch(error=>{
                console.error(error);
            })
        },
        eliminarPersona(id) {
            api.delete('/personas/' + id).then(response => {
                this.obtenerPersona();
                this.canselar();
            }).catch(error=>{
                console.error(error);
            })
        }
        
        //Metodos auxiliares
        ,canselar(){
            this.show = true;
            this.añadir = true;
            this.$nextTick(() => {
              this.addedPersona = { nombre: '', edad: ''}
            });
            this.$nextTick(() => {
              this.editedPersona = { id: 0, nombre: '', edad: ''}
            })
        },
        editar(persona){
            this.añadir = false;
            this.show = false;
            this.editedPersona = { ...persona }
        }
    },
    mounted() {
        this.obtenerPersona();
    }
}

</script>

<style>
#app {
  font-family: 'Avenir', Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 30px;
}

#tabla{
    margin-top: 10px;
    text-align: center;
}
</style>
