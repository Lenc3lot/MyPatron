<template>
    <main>
        <div id="loginDiv">
            <h1>Créer un compte</h1>
            <nav>
                <input type="email" placeholder="Mail" v-model="newUser.mail" required>
                <input type="text" placeholder="Nom" v-model="newUser.nom" required>
                <input type="text" placeholder="Prenom" v-model="newUser.prenom" required>
                <input type="text" placeholder="Login" v-model="newUser.login" required>
                <input type="password" placeholder="Mot de passe" v-model="newUser.mdp" @change="testEqMdp(newUser.mdp)" required>
                <input type="password" placeholder="Mot de passe (valider)" v-model="validMDP" @change="testEqMdp(newUser.mdp)">
                <p v-if="!sameMdp">Merci de saisir un mot de passe identique !</p>
                <input type="submit" class="button-29" value="Créer le compte" @click="testAjtUser()">
            </nav>
        </div>
    </main>
</template>

<script>
import store from '@/store'
export default {
    name: 'registerView',
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
            newUser: {
                mail:'',
                nom:'',
                prenom:'',
                login: '',
                mdp: ''
            },
            validMDP: '',
            sameMdp: true
        }
    },
    methods: {
        // methods here
        testAjtUser(){
            let datas = new FormData()
            datas.append('mail',this.newUser.mail)
            datas.append('nom',this.newUser.nom)
            datas.append('pnom',this.newUser.prenom)
            datas.append('login',this.newUser.login)
            datas.append('req','register')
            datas.append('action','doRegister')
            if(this.sameMdp){
                datas.append('mdp',this.newUser.mdp)
            }
            fetch(this.dataStore.baseUrl,{
                body:datas,
                method: 'POST'
            })
                .then(response=>response.json())
                .then(response=>{
                    console.log(response)
                    if(response.statut == '400'){
                        this.$swal({
                            title: 'Oh oh...',
                            text: ' Compte déjà existant !',
                            icon: 'error'
                        })
                    }
                })
                .catch(error=>{
                    console.error(error)
                })
        },
        testEqMdp(mdp){
            if(mdp == this.validMDP){
                console.log('oui')
                this.sameMdp = true
            }else{
                console.log('non')
                this.sameMdp = false
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

main {
    width: 100%;
}

#loginDiv {
    display: flex;
    flex-wrap: wrap;
    padding: 1%;
}

#loginDiv>h1 {
    background-color: white;
    padding: 1%;
    margin: 1%;
    text-align: end;
    width: 100%;
}

#loginDiv>nav {
    flex: 1 1 100%;
    border: solid 1px;
    padding: 1%;
    margin: 1%;
    background-color: white;
    text-align: center;
    display: flex;
    align-items: center;
    flex-wrap: wrap;
}

#loginDiv>nav>figcaption {
    background-color: black;
    padding: 0px;
    color: white;
    font-size: 80%;
    font-style: italic;
}

#loginDiv>nav>* {
    padding: 1%;
}

#loginDiv>nav>input {
    margin: 1%;
    flex: 1 1 48%;
}

#loginDiv>nav>p {
    margin: 1%;
    flex: 1 1 100%;
    color: red
}

#loginDiv>nav>figcaption>a {
    color: blue;
}
</style>