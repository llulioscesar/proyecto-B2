<template>
  <q-layout class="flex-center body">
  <q-page-container>
    <q-page class="flex flex-center">
      <q-card class="login">
        <q-card-title class="text-white">
          Iniciar sesión
        </q-card-title>
        <q-card-main>
          <q-input v-model="usuario" placeholder="Usuario" />
          <br>
          <q-input type="password" v-model="contraseña" placeholder="Contraseña" no-pass-toggle/>
        </q-card-main>
        <br>
        <q-card-actions>
          <q-btn @click="entrar" color="primary" label="Iniciar sesión" />
        </q-card-actions>
      </q-card>
    </q-page>
  </q-page-container>
</q-layout>
</template>

<script>
import {entrar} from 'src/http';
export default {
  data () {
    return {
      usuario: "",
      contraseña: ""
    }
  },
  methods: {
    entrar () {
      if  (this.usuario.length > 4 && this.contraseña.length > 5){
        var form = new FormData();
        form.set('user', this.usuario);
        form.set('password', this.contraseña);
        this.$axios({
          method: 'post',
          url: entrar,
          data: form,
          processData: false,
        }).then(res => {
          var usuario = res.data.datos;
          console.log(res.data);
          if (res.data.estado) {
            this.$q.localStorage.set("usuario", usuario);
            var rol = usuario.tipo;
            switch (rol) {
              case "0":
                this.$router.push("admin");
                break;
              case "1":
                break;
              case "2":
                break;
            }
          } else {
            this.$q.dialog({
              title: "Error",
              message: res.data.error
            })
          }
        }).catch(e => {
          console.log(e);
        })
      } else {
        this.$q.dialog({
          title: "Error",
          message: "El usuario debe tener almenos 5 caracteres y la contraseña 6 caracteres."
        })
      }
    }
  }
}
</script>

<style>
.body{
  background: url('/statics/fondo1.jpg');
  background-repeat: no-repeat;
  background-size: cover;
  background-position: right;
}
.login {
  backdrop-filter: blur(10px);
  max-width: 500px;
  width: 100%;
  padding: 24px;
  background: rgba(0,0,0,0.55);
  box-shadow: none!important;
}
input{
  color: white!important;
}
</style>
