<template>
  <div class="content shadow-2" style="margin-top:24px; border-radius:5px">
    <q-list inset-separator>
      <q-list-header>
        Profesores
      </q-list-header>
      <q-item v-for="(categoria, i) in categorias" v-if="categorias != null">
          <q-item-side inverted :letter="categoria.nombre.substring(0, 1)" color="secondary" />
          <q-item-main>
            <q-item-tile>{{categoria.nombre}}</q-item-tile>
            <q-item-tile>${{categoria.valor}}</q-item-tile>
          </q-item-main>
          <q-item-side right>
            <q-icon :class="categoria.estado ? 'text-blue' : 'text-red'" name="check" size="14px" />
            <q-btn round @click.native="editar(i)" class="text-faded" icon="border_color" size="10px" />
          </q-item-side>
      </q-item>
    </q-list>

    <q-page-sticky position="bottom-right" :offset="[18, 18]">
      <q-btn @click.native="nuevo" round color="primary" icon="add" />
    </q-page-sticky>


    <q-modal minimized  :content-css="{width:'550px'}" no-backdrop-dismiss no-esc-dismiss ref="modalRef1">
      <q-btn style="position: absolute;margin-left: 8px;margin-top: 8px;" @click.native="$refs.modalRef1.hide()" round color="red" icon="close" size="7px"/>
      <div style="padding:35px 50px">
        <q-field label="Nombre:">
          <q-input v-model="categoria.nombre" type="text" class="text-black"/>
        </q-field>
        <q-field label="Valor:">
          <q-input v-model="categoria.valor" type="number"/>
        </q-field>
        <q-field label="Estado:">
          <q-checkbox v-model="categoria.estado"/>
        </q-field>
        <br>
        <hr>
        <q-btn @click.native="updateCategoria" color="primary">Guardar</q-btn>
      </div>
    </q-modal>

    <q-modal minimized  :content-css="{width:'550px'}" no-backdrop-dismiss no-esc-dismiss ref="modalRef2">
      <q-btn style="position: absolute;margin-left: 8px;margin-top: 8px;" @click.native="$refs.modalRef2.hide()" round color="red" icon="close" size="7px"/>
      <div style="padding:35px 50px">
        <q-field label="Nombre:">
          <q-input v-model="categoria.nombre" type="text" class="text-black"/>
        </q-field>
        <q-field label="Valor:">
          <q-input v-model="categoria.valor" type="number"/>
        </q-field>
        <br>
        <hr>
        <q-btn @click.native="addCategoria" color="primary">Guardar</q-btn>
      </div>
    </q-modal>



  </div>
</template>

<script>
import { allCategorias, actualizarCategoria, insertarCategoria } from 'src/http'
export default {
  data () {
    return {
      categorias:null,
      categoria: {
        nombre: null,
        valor: null,
        id: null,
        estado: null
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
        url: allCategorias
      }).then(res => {
        if( res.data.estado) {
          this.categorias = res.data.datos
        }
      })
    },
    editar(pos) {
      this.categoria = JSON.parse(JSON.stringify(this.categorias[pos]))
      this.$refs.modalRef1.show()
    },
    updateCategoria(){
      var form = new FormData()
      form.set("idCategoria", this.categoria.id)
      form.set("nombre", this.categoria.nombre)
      form.set("valor", this.categoria.valor)
      form.set("estado", this.categoria.estado ? '1' : '0')
      form.set("profesor", null)
      this.$axios({
        method: "post",
        url: actualizarCategoria,
        data: form
      }).then(res => {
        if(res.data.estado){
          this.cargarLista()
          this.$refs.modalRef1.hide()
        }
      })
    },
    nuevo(){
      this.categoria = {
        nombre: null,
        valor: null,
        id: null,
        estado: null
      }
      this.$refs.modalRef2.show()
    },
    addCategoria() {
      var form = new FormData()
      form.set("nombre", this.categoria.nombre)
      form.set("valor", this.categoria.valor)
      this.$axios({
        method: "post",
        url: insertarCategoria,
        data: form
      }).then(res => {
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
