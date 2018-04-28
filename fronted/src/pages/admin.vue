<template>
  <q-page >
    <q-tabs>
      <!-- Tabs - notice slot="title" -->
      <q-tab default slot="title" name="tab-1" icon="book" label="Inscripciones" />
      <q-tab slot="title" name="tab-2" icon="description" label="Reportes"/>
      <q-tab slot="title" name="tab-3" icon="store_mall_directory" label="Escuela"/>

      <!-- Targets -->
      <q-tab-pane class="no-border no-padding" name="tab-1">
        <inscripciones/>
      </q-tab-pane>
      <q-tab-pane name="tab-2">Tab Two</q-tab-pane>
      <q-tab-pane name="tab-3">Tab Three</q-tab-pane>
    </q-tabs>
  </q-page>
</template>

<style>
</style>

<script>
import inscripciones from 'src/components/admin/inscripciones'
export default {
  components: {
    inscripciones
  },
  name: 'PageIndex'
}
</script>
