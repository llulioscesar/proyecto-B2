<template>
  <q-page >
    <q-tabs>
      <!-- Tabs - notice slot="title" -->
      <q-tab default slot="title" name="tab-1" icon="face" label="cuenta" />
      <q-tab slot="title" name="tab-2" icon="today" label="Horario"/>

      <!-- Targets -->
      <q-tab-pane class="no-border no-padding" name="tab-1">
        <cuenta/>
      </q-tab-pane>
      <q-tab-pane class="no-border no-padding" name="tab-2">
        Horario
      </q-tab-pane>
    </q-tabs>
  </q-page>
</template>

<style>
</style>

<script>
import cuenta from 'src/components/cuenta'
export default {
  components: {
    cuenta
  },
  name: 'PageIndex'
}
</script>
