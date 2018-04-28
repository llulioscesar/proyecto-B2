<template>
  <div class="content">
    {{hijo.busCategoria}}
    <q-list inset-separator>
      <q-list-header>Acudientes</q-list-header>
      <q-item v-for="(acudiente, i) in lista" :key="i">
        <q-item-side inverted :letter="acudiente.nombre.substring(0, 1)" color="secondary" />
        <q-item-main>
          <q-item-tile>
            {{acudiente.nombre}}
            <q-btn @click.native="verAcudiente(i)" round color="white" class="text-black" icon="remove_red_eye" size="10px" />
            <q-btn @click.native="editarAcudiente(i)" round color="white" class="text-black" icon="border_color" size="10px" />
            <q-btn round color="white" class="text-red" icon="close" size="10px" />
          </q-item-tile>
          <q-list link class="no-border">
            <q-list-header>Hijos</q-list-header>
            <q-item class="no-pad" v-for="(hijo, j) in acudiente.hijos" :key="j">
              <q-item-side :letter="hijo.nombre.substring(0, 1)"/>
              <q-item-main :label="hijo.nombre" @click.native="verHijo(i, j)"/>
              <q-item-side right>
                <q-icon :class="hijo.estado ? 'text-blue' : 'text-red'" name="check" size="14px" />
                <q-btn round @click.native="openURL('http://localhost/futbol/api/alumno/pdf?idAlumno='+hijo.id)" class="text-faded" icon="insert_drive_file" size="10px" />
                <q-btn round @click.native="editarHijo(i,j)" class="text-faded" icon="border_color" size="10px" />
                <q-btn v-if="hijo.estado" @click.native="borraAlumno(i, j)" round class="text-red" icon="close" size="10px" />
              </q-item-side>
            </q-item>
            <q-item-separator />
          </q-list>
        </q-item-main>
      </q-item>
      <q-item-separator />
      <!--<q-list-header>acudiente</q-list-header>-->
    </q-list>


    <q-modal minimized  :content-css="{width:'550px'}" no-backdrop-dismiss no-esc-dismiss ref="modalRef1">
      <q-btn style="position: absolute;margin-left: 8px;margin-top: 8px;" @click.native="$refs.modalRef1.hide()" round color="red" icon="close" size="7px"/>
      <div style="padding:35px 50px">
        <q-field label="Nombre:">
          <q-input v-model="hijo.nombre" type="text" class="text-black"/>
        </q-field>
        <q-field label="Documento:">
          <q-input v-model="hijo.documento" type="text"/>
        </q-field>
        <q-field label="Fecha de nacimiento:">
          <q-datetime v-model="hijo.fechaNacimiento" type="date"/>
        </q-field>
        <q-field label="Tipo de sangre:">
          <q-input v-model="hijo.tipoSangre" type="text"/>
        </q-field>
        <q-field label="Fecha de ingreso:">
          <q-datetime v-model="hijo.fechaIngreso" type="date"/>
        </q-field>
        <q-field label="Fecha de retiro:">
          <q-datetime v-model="hijo.fechaRetiro" type="date" clearable popover/>
        </q-field>
        <q-field label="Estado:">
          <q-checkbox v-model="hijo.estado"/>
        </q-field>
        <q-field label="Acudiente">
          <q-search v-model="buscarAcudiente">
            <q-autocomplete @search="searchAcudiente" @selected="selectedAcudiente" separator/>
          </q-search>
        </q-field>
        <q-field label="Categoria">
          <q-search v-model="buscarCategoria">
            <q-autocomplete @search="searchCategoria" @selected="selectedCategoria" />
          </q-search>
        </q-field>
        <br>
        <hr>
        <q-btn @click.native="updateAlumno" color="primary">Guardar</q-btn>
      </div>
    </q-modal>

    <q-modal minimized :content-css="{width:'550px'}"  no-backdrop-dismiss no-esc-dismiss ref="modalRef2">
      <q-btn style="position: absolute;margin-left: 8px;margin-top: 8px;" @click.native="$refs.modalRef2.hide()" round color="red" icon="close" size="7px"/>
      <div style="padding:35px 50px">
        <div class="q-display-1 q-mb-md">{{hijo.nombre}}</div>
        <hr>
        <q-field label="Documento:">{{hijo.documento}}</q-field>
        <q-field label="Fecha de nacimiento:">{{$moment(hijo.fechaNacimiento).format("DD [de] MMMM [del] YYYY")}}</q-field>
        <q-field label="Tipo de sangre:">{{hijo.tipoSangre}}</q-field>
        <q-field label="Ingreso:">{{$moment(hijo.fechaIngreso).format("DD [de] MMMM [del] YYYY")}}</q-field>
        <q-field label="Retiro:">{{$moment(hijo.fechaRetiro).format("DD [de] MMMM [del] YYYY")}}</q-field>
        <q-field label="Estado:">{{hijo.estado}}</q-field>
        <q-field label="Acudiente:">{{hijo.acudiente}}</q-field>
        <q-field label="Categoria:">{{hijo.categoria}}</q-field>
      </div>
    </q-modal>

    <q-modal minimized :content-css="{width:'550px'}"  no-backdrop-dismiss no-esc-dismiss ref="modalRef3">
      <q-btn style="position: absolute;margin-left: 8px;margin-top: 8px;" @click.native="$refs.modalRef3.hide()" round color="red" icon="close" size="7px"/>
      <div style="padding:35px 50px" v-if="lista != null">
        <div class="q-display-1 q-mb-md">{{lista[acudiente].nombre}}</div>
        <hr>
        <q-field label="Documento:">{{lista[acudiente].documento}}</q-field>
        <q-field label="Correo:">{{lista[acudiente].tipoSangre}}</q-field>
        <q-field label="Direccion:">{{lista[acudiente].direccion}}</q-field>
        <q-field label="Telefono:">{{lista[acudiente].telefono}}</q-field>
        <q-field label="Estado:">{{lista[acudiente].estado}}</q-field>
        <q-field label="Usuario:">{{lista[acudiente].user}}</q-field>
      </div>
    </q-modal>

    <q-modal minimized  :content-css="{width:'550px'}" no-backdrop-dismiss no-esc-dismiss ref="modalRef4">
      <q-btn style="position: absolute;margin-left: 8px;margin-top: 8px;" @click.native="$refs.modalRef4.hide()" round color="red" icon="close" size="7px"/>
      <div style="padding:35px 50px" v-if="lista != null">
        <q-field label="Nombre:">
          <q-input v-model="lista[acudiente].nombre" type="text" class="text-black"/>
        </q-field>
        <q-field label="Documento:">
          <q-input v-model="lista[acudiente].documento" type="text"/>
        </q-field>
        <q-field label="Correo:">
          <q-input v-model="lista[acudiente].correo" type="email"/>
        </q-field>
        <q-field label="Direccion:">
          <q-input v-model="lista[acudiente].dirrecion" type="text"/>
        </q-field>
        <q-field label="Telefono:">
          <q-input v-model="lista[acudiente].telefono" type="text"/>
        </q-field>
        <q-field label="Usuario:">
          <q-input v-model="lista[acudiente].user" type="text"/>
        </q-field>
        <q-field label="Estado:">
          <q-checkbox v-model="lista[acudiente].estado"/>
        </q-field>
        <br>
        <hr>
        <q-btn @click.native="updateAcudiente" color="primary">Guardar</q-btn>
      </div>
    </q-modal>

  </div>
</template>

<script>
import { filter, openURL } from 'quasar'
import { acudientesHijos, getAlumnoId, getCategoriaId, buscarAcudiente, buscarCategoria, actualizarAlumno, cambiarEstadoAlumno } from 'src/http';

function filtrarAcudiente(data){
  return data.map(acudiente => {
    return {
      label: acudiente.nombre,
      sublabel: 'Cedula: ' + acudiente.documento,
      value: acudiente.id,
      estado: acudiente.estado
    }
  })
}

function filtrarCategoria(data){
  return data.map(categoria => {
    return {
      label: categoria.nombre,
      sublabel: 'Valor: ' + categoria.valor,
      value: categoria.id,
      estado: categoria.estado
    }
  })
}


export default {
  beforeMount () {
    this.$nextTick(() => {
      this.$moment.lang('es');
      this.cargarLista()
    });
  },
  data () {
    return {
      lista: null,
      hijo: {
        id: null,
        documento: null,
        nombre: null,
        fechaNacimiento: null,
        tipoSangre: null,
        fechaIngreso: null,
        fechaRetiro: null,
        estado: null,
        acudiente: null,
        categoria: null
      },
      buscarCategoria: null,
      buscarAcudiente: null,
      acudiente: 0
    }
  },
  methods: {
    openURL,
    verHijo (i, j) {
      this.hijo = JSON.parse(JSON.stringify(this.lista[i].hijos[j]))
      this.hijo.acudiente = JSON.parse(JSON.stringify(this.lista[i].nombre))
      var form = new FormData();
      form.set('idCategoria', this.lista[i].hijos[j].categoria);
      this.$axios({
        method: "post",
        url: getCategoriaId,
        data: form,
        processData: false
      }).then(res => {
        console.log(res.data);
        this.hijo.categoria = res.data.datos['nombre']
        this.$refs.modalRef2.show()
      }).catch(e => {
        console.log(e);
      })
    },
    verAcudiente(pos) {
      this.acudiente = pos
      this.$refs.modalRef3.show()
    },
    editarHijo (i, j) {
      this.hijo = JSON.parse(JSON.stringify(this.lista[i].hijos[j]))
      this.buscarAcudiente = JSON.parse(JSON.stringify(this.lista[i].nombre))
      this.hijo.acudiente = JSON.parse(JSON.stringify(this.lista[i].id))
      var form = new FormData();
      form.set('idCategoria', this.lista[i].hijos[j].categoria);
      this.$axios({
        method: "post",
        url: getCategoriaId,
        data: form,
        processData: true
      }).then(res => {
        var d = res.data.datos;
        this.buscarCategoria = d.nombre
        this.$refs.modalRef1.show()
      }).catch(e => {
        console.log(e);
      })
    },
    editarAcudiente(pos){
      this.acudiente = pos
      this.$refs.modalRef4.show()
    },
    searchAcudiente(termino, done){
      var form = new FormData()
      form.set("buscar", termino)
      this.$axios({
        method:"post",
        url: buscarAcudiente,
        data: form,
        processData: false
      }).then(res => {
        done(filter('true', {field: 'estado', list: filtrarAcudiente(res.data.datos)}));
      }).catch(e => {
        done()
      })
    },
    selectedAcudiente (item) {
      this.buscarAcudiente = item.label
      this.hijo.acudiente = item.value
    },
    searchCategoria (termino, done){
      var form = new FormData()
      form.set("buscar", termino)
      this.$axios({
        method:"post",
        url: buscarCategoria,
        data: form,
        processData: false
      }).then(res => {
        done(filter('true', {field: 'estado', list: filtrarCategoria(res.data.datos)}));
      }).catch(e => {
        done()
      })
    },
    selectedCategoria (item) {
      this.hijo.categoria = item.value
      this.buscarCategoria = item.label
    },
    updateAlumno () {
      var form = new FormData()
      form.set("idAlumno", this.hijo.id)
      form.set("documento", this.hijo.documento)
      form.set("nombre", this.hijo.nombre)
      form.set("fechaNacimiento", this.hijo.fechaNacimiento)
      form.set("tipoSangre", this.hijo.tipoSangre)
      form.set("fechaIngreso", this.hijo.fechaIngreso)
      form.set("fechaRetiro", this.hijo.fechaRetiro)
      form.set("acudiente", this.hijo.acudiente)
      form.set("categoria", this.hijo.categoria)
      form.set("estado", this.hijo.estado ? '1' : '0')
      this.$axios({
        method: "post",
        url: actualizarAlumno,
        data: form,
        processData: false
      }).then(res => {
        if(res.data.estado) {
          this.cargarLista()
        }
      })
    },
    updateAcudiente(post) {
      var form =new FormData()
      form.set("id", this.lista[pos].id)
      form.set("nombre", this.lista[pos].nombre)
      form.set("documento", this.lista[pos].documento)
      form.set("direccion", this.lista[pos].direccion)
      form.set("telefono", this.lista[pos].telefono)
      form.set("correo", this.lista[pos].correo)
      form.set("tipo", "2")
      form.set("user", this.lista[pos].user)
      form.set("estado", this.lista[pos].estado ? "1" : "0")
      this.$axios({
        method: "post",
        url: actualizarAcudiente,
        data: form,
        processData: false
      }).then(res => {
        if(res.data.estado) {
          
        } else {
          this.$q.dialog({
            title: "Error",
            message: res.data.error
          })
        }
      })
    }
    cargarLista () {
      this.$refs.modalRef1.hide()
      this.$axios({
        method: 'post',
        url: acudientesHijos
      }).then(res => {
        console.log(res.data);
        if (res.data.estado) {
          this.lista = res.data.datos
        }
      }).catch(e => {

      })
    },
    borraAlumno (pos, hijo) {
      var hijo = JSON.parse(JSON.stringify(this.lista[pos].hijos[hijo]))
      console.log(hijo);
      var form = new FormData();
      form.set("estado", hijo.estado ? "0" : "1")
      form.set("idAlumno", hijo.id)
      this.$axios({
        method: "post",
        url: cambiarEstadoAlumno,
        data: form,
        processData: false
      }).then(res => {
        console.log(res.data);
        if(res.data.estado){
          this.cargarLista()
        }
      }).catch(e => {

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
