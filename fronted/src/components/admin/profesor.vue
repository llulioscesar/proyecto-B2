<template>
  <div class="content shadow-2" style="margin-top:24px; border-radius:5px">
    <q-list inset-separator>
      <q-list-header>
        Profesores
      </q-list-header>
      <q-item v-for="(profe, i) in profesores" v-if="profesores != null">
          <q-item-side inverted :letter="profe.nombre.substring(0, 1)" color="secondary" />
          <q-item-main>
            <q-item-tile>{{profe.nombre}}</q-item-tile>
          </q-item-main>
          <q-item-side right>
            <q-icon :class="profe.estado ? 'text-blue' : 'text-red'" name="check" size="14px" />
            <q-btn round @click.native="editar(i)" class="text-faded" icon="border_color" size="10px" />
          </q-item-side>
      </q-item>
    </q-list>

    <q-page-sticky position="bottom-right" :offset="[18, 18]">
      <q-btn @click.native="nuevo" round color="primary" icon="add" />
    </q-page-sticky>


    <q-modal minimized  :content-css="{width:'550px'}" no-backdrop-dismiss no-esc-dismiss ref="modalRef1">
      <q-btn style="position: absolute;margin-left: 8px;margin-top: 8px;" @click.native="$refs.modalRef1.hide()" round color="red" icon="close" size="7px"/>
      <div style="padding:35px 50px" v-if="profesor != null">
        <q-field label="Nombre:">
          <q-input v-model="profesor.nombre" type="text" class="text-black"/>
        </q-field>
        <q-field label="Documento:">
          <q-input v-model="profesor.documento" type="text"/>
        </q-field>
        <q-field label="Correo:">
          <q-input v-model="profesor.correo" type="email"/>
        </q-field>
        <q-field label="Direccion:">
          <q-input v-model="profesor.dirrecion" type="text"/>
        </q-field>
        <q-field label="Telefono:">
          <q-input v-model="profesor.telefono" type="text"/>
        </q-field>
        <q-field label="Usuario:">
          <q-input v-model="profesor.user" type="text"/>
        </q-field>
        <q-field label="Estado:">
          <q-checkbox v-model="profesor.estado"/>
        </q-field>
        <br>
        <hr>
        <q-btn @click.native="updateProfesor()" color="primary">Guardar</q-btn>
      </div>
    </q-modal>

    <q-modal minimized  :content-css="{width:'550px'}" no-backdrop-dismiss no-esc-dismiss ref="modalRef2">
      <q-btn style="position: absolute;margin-left: 8px;margin-top: 8px;" @click.native="$refs.modalRef2.hide()" round color="red" icon="close" size="7px"/>
      <div style="padding:35px 50px" v-if="profesores != null">
        <q-field label="Nombre:">
          <q-input v-model="profesor.nombre" type="text" class="text-black"/>
        </q-field>
        <q-field label="Documento:">
          <q-input v-model="profesor.documento" type="text"/>
        </q-field>
        <q-field label="Correo:">
          <q-input v-model="profesor.correo" type="email"/>
        </q-field>
        <q-field label="Direccion:">
          <q-input v-model="profesor.dirrecion" type="text"/>
        </q-field>
        <q-field label="Telefono:">
          <q-input v-model="profesor.telefono" type="text"/>
        </q-field>
        <q-field label="Usuario:">
          <q-input v-model="profesor.user" type="text"/>
        </q-field>
        <q-field label="Contraseña:">
          <q-input v-model="profesor.password" type="text"/>
        </q-field>
        <br>
        <hr>
        <q-btn @click.native="addProfesor()" color="primary">Guardar</q-btn>
      </div>
    </q-modal>



  </div>
</template>

<script>
import { allProfesores, actualizarAdulto, insertarAdulto } from 'src/http'
export default {
  data () {
    return {
      profesores:null,
      profesor: {
        nombre: null
      }
    }
  },
  beforeMount(){
    this.$nextTick(() => {
      this.cargarLista();
    })
  },
  methods: {
    cargarLista(){
      this.$axios({
        method: 'post',
        url: allProfesores
      }).then(res => {
        if( res.data.estado) {
          this.profesores = res.data.datos
          console.log(this.profesores);
        }
      })
    },
    editar(pos) {
      this.profesor = JSON.parse(JSON.stringify(this.profesores[pos]))
      this.$refs.modalRef1.show()
    },
    updateProfesor(){
      var form = new FormData()
      form.set("id", this.profesor.id)
      form.set("nombre", this.profesor.nombre)
      form.set("documento", this.profesor.documento)
      form.set("direccion", this.profesor.direccion)
      form.set("telefono", this.profesor.telefono)
      form.set("correo", this.profesor.correo)
      form.set("tipo", "1")
      form.set("user", this.profesor.user)
      form.set("estado", (this.profesor.estado ? "1" : "0"))
      this.$axios({
        method: "post",
        url: actualizarAdulto,
        data: form
      }).then(res => {
        if(res.data.estado){
          this.cargarLista()
          this.$refs.modalRef1.hide()
        }
      })
    },
    nuevo(){
      this.profesor = {
        nombre: null,
        documento: null,
        direccion: null,
        telefono: null,
        correo: null,
        user: null,
        password: null
      }
      this.$refs.modalRef2.show()
    },
    addProfesor() {
      console.log(this.profesor);
      var form = new FormData()
      form.set("nombre", this.profesor.nombre)
      form.set("documento", this.profesor.documento)
      form.set("direccion", this.profesor.direccion)
      form.set("telefono", this.profesor.telefono)
      form.set("correo", this.profesor.correo)
      form.set("tipo", "1")
      form.set("user", this.profesor.user)
      form.set("password", this.profesor.password)
      this.$axios({
        method: "post",
        url: insertarAdulto,
        data: form,
        processData: false
      }).then(res => {
        console.log(res);
        if(res.data.estado){
          this.cargarLista()
          this.$refs.modalRef2.hide()
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
