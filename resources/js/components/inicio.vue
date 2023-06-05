.<template>
  <h2 class="text-center">Prospectos</h2>
  <div class="mx-2 my-2">
    <button class="btn btn-dark" @click="agregarProspecto()">Agregar Prospecto <i class="bi bi-person-plus-fill"></i></button>
  </div>
  <div>
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Nombre</th>
          <th>Primer Apellido</th>
          <th>Segundo Apellido</th>
          <th>Status</th>
          <th>Informacion</th>
          <th>Evaluar</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="prospecto in prospectos" :key="prospecto.id">
          <td>{{ prospecto.nombre }}</td>
          <td>{{ prospecto.primer_apellido }}</td>
          <td>{{ prospecto.segundo_apellido }}</td>
          <td>{{ prospecto.status }}</td>
          <td><button class="btn btn-info" @click="verDetalles(prospecto.id)"><i class="bi bi-info-circle"></i></button></td>
          <td><button class="btn btn-dark" @click="evaluarProspecto(prospecto.id)">Evaluar</button></td>
        </tr>
      </tbody>
    </table>
  </div>

  
</template>

<script>
export default {
    data() {
        return {
            prospectos: [],
            modalVisible: false,
        };
    },
    methods: {
        obtenerProspectos(){ 
            axios.get('/prospectos-obtener') 
                .then(response => {
                    this.prospectos = response.data;
                })
                .catch(error => {
                    console.error(error);
            });
        },
        verDetalles(id) {
            window.location.href = '/informacion/' + id;
        },

        evaluarProspecto(id) {
            window.location.href = '/evaluar/' + id;
        },

        agregarProspecto() {
            window.location.href = '/capturar';
        },
    },
    mounted() {
        this.obtenerProspectos();      
    },
}
</script>

<style>

</style>