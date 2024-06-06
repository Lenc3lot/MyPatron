<template>
  <main>
    <div id="myspaceDiv">
      <h1>Espace Perso</h1>
      <div>
        <section>
          <h3>Login : </h3>
          <input type="text" @change="changedData.append('uLogin', user.uLogin)" v-model="user.uLogin">
        </section>
        <section>
          <h3>Mail : </h3>
          <input type="text" @change="changedData.append('uMail', user.uMail)" v-model="user.uMail">
        </section>
        <section>
          <h3>Nom :</h3>
          <input type="text" @change="changedData.append('uNom', user.uNom)" v-model="user.uNom">
        </section>
        <section>
          <h3>Prenom :</h3>
          <input type="text" @change="changedData.append('uPNom', user.uPNom)" v-model="user.uPNom">
        </section>
      </div>
      <button @click="updateInfos()">Mettre à jour vos informations</button>
    </div>
  </main>
</template>

<script>
import store from '@/store'
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
  data() {
    return {
      // variables here
      dataStore: store,
      user: [],
      changedData: new FormData()
    }
  },
  methods: {
    // methods here
    getInfos() {
      let monformdata = new FormData()
      monformdata.append('req', 'user')
      monformdata.append('action', 'getInfos')
      monformdata.append('idUser', localStorage.getItem('idUser'))
      fetch(this.dataStore.baseUrl, {
        body: monformdata,
        method: 'POST'
      })
        .then(response => response.json())
        .then(response => {
          this.user = response
        })
        .catch(error => {
          console.error(error)
        })
    },
    updateInfos() {
      this.changedData.append('req','user')
      this.changedData.append('action','updateInfos')
      this.changedData.append('idUser',localStorage.getItem('idUser'))
      fetch(this.dataStore.baseUrl, {
        body: this.changedData,
        method: 'POST'
      })
        .then(response => response.json())
        .then(response => {
          if(response.statut == '200'){
            this.$swal({
              title:'Données modifiées avec succés !',
              icon: 'success',
              toast: 'true',
              position: 'top'
            })
          }
        })
        .catch(error => {
          console.error(error)
        })
    }
  },
  mounted() {
    // mounted here
    this.getInfos()
  },
  created() {
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
