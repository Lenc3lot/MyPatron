<template>
  <nav class="navbar navbar-expand-lg sticky-top navbar-dark bg-dark">
    <span class="navbar-brand" style="flex-grow: 1; text-align: left;">MyPatronCollection</span>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item active">
          <router-link class="nav-link" to="/">Accueil</router-link>
        </li>
        <li class="nav-item">
          <router-link class="nav-link" to="/" @click="confirmAjt()" v-if="isLogged"> + Ajouter un patron</router-link>
        </li>
        <li class="nav-item">
          <router-link class="nav-link" to="/myspace" v-if="isLogged">Mon espace</router-link>
          <router-link class="nav-link" to="/login" v-else>Se connecter</router-link>
        </li>
        <button class="nav  -item" @click="doLogOut()" v-if="isLogged">Déconnexion</button>
      </ul>
    </div>
  </nav>
</template>

<script>
// import router from '@/router';
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
      dataStore: store,
      isLogged: false
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
    },
    doLogOut(){
      localStorage.clear()
      this.$emit('logOut')
      window.location.replace('/#/login')
    }
  },
  mounted() {
    // mounted here
    if(localStorage.getItem('isLogged')){
      this.isLogged = true
    }
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

button{
  margin-left: 2%;
  border-radius: 10px;
}
</style>
