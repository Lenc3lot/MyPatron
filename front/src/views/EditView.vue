<template>
  <main>
    <div id="editDiv">
        <h1>Edition du patron : {{ pattern.pLibel }}</h1>
    </div>
  </main>
</template>

<script>
import store from '@/store'
export default {
  name: 'editView',
  head () {
    return {
      title: 'Document',
      meta: [
        {
          hid: 'description',
          name: 'description',
          content: 'Your Page Description'
        }
      ]
    }
  },
  components: {
    // components here
  },
  props: {
    // props here
  },
  watch: {
    // variables to watch here
  },
  data () {
    return {
      // variables here
      dataStore: store,
      pattern: []
    }
  },
  methods: {
    // methods here
  },
  mounted () {
    // mounted here
    this.pattern = this.dataStore.patternInEdit
  },
  created () {
    // created here
  }
}
</script>

<style scoped>
/* Style here */
#editDiv{
    background-color: white;
    margin: 1%;
    padding: 1%;
}
</style>
