<template>
    <main>
      <div id="loginDiv">
        <h1>Espace connexion</h1>
        <nav>
          <input type="text" placeholder="Login" v-model="loginData.login">
          <input type="password" placeholder="Password" v-model="loginData.pwd">
          <figcaption>Pas d'identifiants ? Cliquez <router-link to="/register">ici</router-link> pour créer un compte !</figcaption>
          <input type="submit" class="button-29" value="Se connecter" @click="doLogin()">
        </nav>
      </div>
      <button @click="test()">Clic</button>
    </main>
  </template>

<script>
// import router from '@/router'
import store from '@/store'
export default {
  name: 'LoginView',
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
      dataStore: store,
      loginData: {
        login: '',
        pwd: ''
      }
    }
  },
  methods: {
    // methods here
    doLogin(){
        let datas = new FormData()
        datas.append('login',this.loginData.login)
        datas.append('pwd',this.loginData.pwd)
        datas.append('req','login'),
        datas.append('action','doLogin')
        fetch(this.dataStore.baseUrl,{
            body: datas,
            method: 'POST'
        })
            .then(response=>response.json())
            .then(response=>{
                console.log(response)
                if(response.statut == "200"){
                    localStorage.setItem('idUser',response.idUtilisateur)
                    localStorage.setItem('isLogged',true)
                    window.location.replace('/')
                }else{
                    this.$swal({
                        title: 'Mot de passe ou utilisateur incorrect',
                        icon:'error'
                    })
                }
            })
            .catch(error=>{
                console.error(error)})
    },
    test(){
        this.$swal({
            html: `
                <embed 
                src='https://noto.alwaysdata.net/back/uploads/users/user0/TagadaJones.pdf' width=1900 height=1000>
            `,
            width: 1900
        })
    }
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

main{
  width: 100%;
}

#loginDiv{
  display: flex;
  flex-wrap: wrap;
  padding: 1%;
}

#loginDiv>h1{
  background-color: white;
  padding: 1%;
  margin: 1%;
  text-align: end;
  width: 100%;
}

#loginDiv>nav{
  flex: 1 1 100%;
  border: solid 1px;
  padding: 1%;
  margin: 1%;
  background-color: white;
  text-align: center;
  display: flex;
  align-items: center;
  flex-direction: column;
}

#loginDiv>nav>figcaption{
  background-color: black;
  padding: 0px;
  color: white;
  font-size: 80%;
  font-style: italic;
}

#loginDiv>nav>*{
  padding: 1%;
}

#loginDiv>nav>input{
  margin: 1%;
}

#loginDiv>nav>figcaption>a{
  color: blue;
}
</style>
