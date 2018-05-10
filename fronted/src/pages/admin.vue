<template>
  <q-page >
    <q-tabs>
      <!-- Tabs - notice slot="title" -->
      <q-tab default slot="title" name="tab-1" icon="book" label="Inscripciones y reportes" />
      <q-tab slot="title" name="tab-2" icon="description" label="Categorias"/>
      <q-tab slot="title" name="tab-3" icon="description" label="Profesores"/>
      <!--<q-tab slot="title" name="tab-4" icon="description" label="Canchas"/>
      <q-tab slot="title" name="tab-5" icon="store_mall_directory" label="Escuela"/>-->
      <q-tab slot="title" name="tab-6" icon="face" label="Cuenta"/>

      <!-- Targets -->
      <q-tab-pane class="no-border no-padding" name="tab-1">
        <inscripciones/>
      </q-tab-pane>
      <q-tab-pane name="tab-2">
        <categoria/>
      </q-tab-pane>
      <q-tab-pane name="tab-3">
        <profesor/>
      </q-tab-pane>
      <q-tab-pane name="tab-6">
        <cuenta/>
      </q-tab-pane>
    </q-tabs>
  </q-page>
</template>

<style>
</style>

<script>
import inscripciones from 'src/components/admin/inscripciones'
import categoria from 'src/components/admin/categoria'
import profesor from 'src/components/admin/profesor'
import cuenta from 'src/components/cuenta'
export default {
  components: {
    inscripciones,
    categoria,
    profesor,
    cuenta
  },
  name: 'PageIndex'
}
</script>
