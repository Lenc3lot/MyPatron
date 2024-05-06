<template>
    <div id="myCard">
        <img src="@/assets/img.png" width="150" height="150">
        <section id="titre">
          <h1>{{titre}}</h1>  
          <a @click="change()">Lien vers le patron</a>
        </section>
        <section id="cookie">
          <h3>Marque :</h3>
          <p>{{ marque }}</p>
          <h3>Type :</h3>
          <p>{{ type }}</p>
          <h3>Notes : </h3>
          <textarea name="Notes" id="Notes" style="resize: none;" readonly></textarea>
          <nav>
            <h3>Tags : </h3>
            <p v-for="tag in tags" :key="tag">{{ tag }}</p>
          </nav>
        </section>
        <button>Editer</button>
    </div>
</template>

<script>
// import store from '@/store'
export default {
  name: 'carteComponent',
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
      // dataStore: store
      titre :'Titre du patron',
      lien : 'http://google.com',
      marque : 'Exemple marque',
      type: ' Exemple type ',
      tags: ['tag1','tag2','tag3','tag4']
    }
  },
  methods: {
    // methods here
    change(){
      window.location.replace (this.lien)
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
#myCard{
  display: flex;
  border: solid 0px;
  border-radius: 10px;
  flex: 1 1 25%;
  flex-wrap: wrap;
  padding: 1%;
  margin: 2%;
  max-width: 27%;
  max-height: 400vh;
  min-width: 10%;
  /* min-height: 20%; */
  background-color: wheat;
}

img{
  flex: 0 1 48%;
  min-width: 10px;
  min-height: 10px;
} 

#titre{
  text-align: center;
  flex: 1 1 48%;
  display: flex;
  flex-direction: column;
  min-width: 10%;
  max-width: 48%;
  flex-wrap: wrap;
}

button{
  margin: 1%;
  border: 0px;
  border-radius: 10px;
  box-shadow: none;
}

nav{
  display: flex;
  flex-wrap: wrap;
  justify-content: space-evenly;
}
nav>h3{
  flex: 1 1 100%
}
nav>p{
  flex: 1 1 35%;
}

#cookie{
  flex: 1 1 100%;
  display: flex;
  flex-direction: column;
  min-width: 10%;
}

#notes{
  max-width: 70%;
  max-height: 100%;
  min-height: 10%;
  min-width: 10%;

}
</style>
