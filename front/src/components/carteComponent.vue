<template>
    <div id="myCard">
        <img :src="img" width="150" height="150">
          <h1>{{patron.pLibel}}</h1>  
          <a @click="change()">{{patron.pLien}}</a>
        <section id="cookie">
          <h3>Marque :</h3>
          <p>{{ patron.libelMarque }}</p>
          <h3>Type :</h3>
          <p>{{ patron.tpLibel }}</p>
          <h3>Notes : </h3>
          <textarea name="Notes" id="notes" style="resize: none;" readonly v-model="desc"></textarea>
          <nav>
            <h3>Tags : </h3>
            <p v-for="tag in tags" :key="tag.idTag">{{ tag.tLibel }}</p>
          </nav>
          <!-- <embed 
          src="https://noto.alwaysdata.net/back/uploads/users/user0/TagadaJones.pdf"
          width="192O"> -->
        </section>
        <button @click="pdfAcces()">PDF</button>
        <button @click="editPattern()">Editer</button>
        <button @click="deletePattern()">Supprimer</button>
    </div>
</template>

<script>
import store from '@/store'
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
    patron:Object
  },
  watch: {
    // variables to watch here  
  },
  data () {
    return {
      // variables here
      dataStore: store,
      desc: this.patron.pDesc,
      tags: this.patron.tags,
      img : 'http://noto.alwaysdata.net/back/'+this.patron.pCheminPhoto
    }
  },
  methods: {
    // methods here
    editPattern(){
      this.dataStore.patternInEdit = this.patron
      this.$router.push('/editPattern/'+this.patron.idPatron)
    },
    pdfAcces(){
      this.$emit('accesPDF',this.patron.infoPdf)
    },
    deletePattern(){
      let monFormData = new FormData()
      monFormData.append('idPatron',this.patron.idPatron)
      monFormData.append('pdfInfos',JSON.stringify(this.patron.infoPdf))
      monFormData.append('pCheminPhoto',this.patron.pCheminPhoto)
      monFormData.append('req','pattern')
      monFormData.append('action','deletePattern')
      console.log(monFormData)
      fetch(this.dataStore.baseUrl,{
        body: monFormData,
        method:'POST'
      })
        .then(response=>response.json())
        .then(response=>{
          console.log(response)
        })
        .catch(error=>{
          console.error(error)
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
#myCard{
  display: flex;
  border: solid 0px;
  border-radius: 10px;
  flex: 1 1 25%;
  /* flex-wrap: wrap; */
  flex-direction: column;
  padding: 1%;
  margin: 2%;
  max-width: 27%;
  max-height: 400vh;
  min-width: 10%;
  /* min-height: 20%; */
  background-color: wheat;
  font-size: 100%;
}

 img{
  /* flex: 0 1 48%; */
  min-width: 10px;
  min-height: 10px;
  align-self: center;
} 

h1,a{
  align-self: center;
}

button{
  margin: 1%;
  border: 0px;
  border-radius: 10px;
  box-shadow: none;
}

/* nav{
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
} */

#notes{
  width: 100%;
  max-width: 100%;
  max-height: 100%;
  min-height: 10%;
  min-width: 10%;
}

</style>
