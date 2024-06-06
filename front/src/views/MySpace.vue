<template>
  <main>
    <div id="myspaceDiv">
      <h1>Espace Perso</h1>
      <div>
        <section>
          <h3>Login : </h3><p>bnoto29</p>
        </section>
        <section>
          <h3>Mail : </h3><p>noto.baptiste@yahoo.fr</p>
        </section>
        <section>
          <h3>Nom :</h3><p>Noto</p>
        </section>
        <section>
          <h3>Prenom :</h3><p>Baptiste</p>
        </section>
      </div>
      <button>Mettre à jour vos informations</button>
    </div>
  </main>
</template>

<script>
// import store from '@/store'
export default {
  name: 'mySpace',
  head() {
    return {
      title: 'Document',
      meta: [
        {
          hid: 'description',
          name: 'description',
          content: 'Your Page Description',
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
      // dataStore: store
    }
  },
  methods: {
    // methods here
  },
  mounted () {
    // mounted here
  },
  created () {
    // created here
  }
}
</script>

<style scoped>
/* Style here */
#myspaceDiv {
  background-color: white;
  margin: 1%;
  padding: 1%;
  border-radius: 10px;
}

#myspaceDiv>h1 {
  background-color: lightgray;
  padding: 1%;
}
</style>
