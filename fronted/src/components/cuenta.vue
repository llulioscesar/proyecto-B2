<template>
  <div class="content shadow-2" style="margin-top:24px; border-radius:5px">
    <div v-if="cuenta != null">
      <q-input v-model="cuenta.nombre" float-label="Nombre"/>
      <q-input v-model="cuenta.documento" float-label="Documento"/>
      <q-input v-model="cuenta.direccion" float-label="Direccion"/>
      <q-input v-model="cuenta.correo" float-label="Correo"/>
      <q-input v-model="cuenta.telefono" float-label="Telefono"/>
      <q-input v-model="cuenta.user" float-label="Usuario"/>
      <q-input v-model="cuenta.password" float-label="Contraseña"/>
      <br>
      <q-btn color="primary" @click.native="guardar">Guardar</q-btn>
    </div>
  </div>
</template>

<script>
import {getCuenta, actualizarAdulto} from 'src/http'
export default {
  // name: 'ComponentName',
  data () {
    return {
      cuenta: null
    }
  },
  beforeMount(){
    this.$nextTick(() => {
      this.cargarLista();
    })
  },
  methods: {
    cargarLista(){
      var form = new FormData()
      form.set("idAcudiente", this.$q.localStorage.get.item("usuario").id)
      this.$axios({
        method: 'post',
        url: getCuenta,
        data: form,
        processData: false
      }).then(res => {
        if(res.data.estado){
          this.cuenta = res.data.datos
          console.log(this.cuenta);
        }
      })
    },
    guardar(){
      var form = new FormData()
      form.set("id", this.$q.localStorage.get.item("usuario").id)
      form.set("nombre", this.cuenta.nombre)
      form.set("documento", this.cuenta.documento)
      form.set("direccion", this.cuenta.direccion)
      form.set("correo", this.cuenta.correo)
      form.set("telefono", this.cuenta.telefono)
      form.set("user", this.cuenta.user)
      form.set("password", this.cuenta.password)
      form.set("estado", 1)
      form.set("tipo", this.cuenta.tipo)
      this.$axios({
        method: "post",
        url: actualizarAdulto,
        data: form,
        processData: false
      }).then(res => {
        if(res.data.estado){
          this.cargarLista();
        }
      })
    }
  }
}
</script>

<style>
.content{
  background: white;
  padding: 24px;
  margin: 0 auto;
  max-width: 1110px;
  width: 100%;
  display: block;
}
.q-item-label{
  padding: 15px 0;
}
.no-pad{
  padding: 0 16px!important;
}
input {
  color: #000!important;
}
</style>
