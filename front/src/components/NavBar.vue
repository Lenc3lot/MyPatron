<template>
  <nav class="navbar navbar-expand-lg sticky-top navbar-dark bg-dark">
    <span class="navbar-brand" style="flex-grow: 1; text-align: left;">MyPatronCollection</span>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item active">
          <router-link class="nav-link" to="/">Accueil</router-link>
        </li>
        <li class="nav-item">
          <router-link class="nav-link" to="/" @click="confirmAjt()"> + Ajouter un patron</router-link>
        </li>
        <li class="nav-item">
          <router-link class="nav-link" to="/">Mon espace</router-link>
        </li>
      </ul>
    </div>
  </nav>
</template>

<script>
import store from '@/store'
export default {
  name: 'NavBar',
  head() {
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
  data() {
    return {
      // variables here
      dataStore: store
    }
  },
  methods: {
    // methods here
    async confirmAjt() {
      const { value: email } = await this.$swal({
        title: "Entrer le nom du patron",
        input: "text",
        inputLabel: "Nom du patron",
      });
      if (email) {
        this.dataStore.newPattern.patterName = email
        this.$router.push('/addPatern/2')
      }
    }
  },
  mounted() {
    // mounted here
  },
  created() {
    // created here
  }
}
</script>

<style scoped>
/* Style here */
li {
  border: solid 1px white;
  border-radius: 10px;
  margin-right: 2%;
}

#navbarNav {
  justify-content: end;
}

.navbar-nav {
  display: flex;
  justify-content: end;
  width: 100%
}

.navbar-nav>:nth-child(3) {
  margin-inline-end: 0px;
}
</style>
