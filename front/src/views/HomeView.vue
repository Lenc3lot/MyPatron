<template>
  <!-- <button @click="test()">Test</button> -->
  <main>
    <div id="sideBar">
        <custonBar @resetSearch="resetSearch()" @setSpePatt="setListePatron($event)" :key="nbSide"/>
      </div>
    <div id="viewContainer">
      <carteComponent  v-for="patron in listeSelectedPatrons" :key="patron.idPatron" :patron="patron" @accesPDF="accesPDF($event)" @actuPattern="getAllPaterns()"/>
      <section id="notLog" v-if="!isLogged">
        <h1>Vous voulez rejoindre la communauté MyPatron ?</h1>
        <h2>Alors n'attendez plus et inscrivez vous !</h2>
        <button @click="$router.push('/login')">En cliquant ici !</button>
      </section>
    </div>
    <div id="editMode" v-if="visible">
      <h1>Page édition</h1>
    </div>
    <nav id="pdfPage" v-if="pdfVisible">
      <div>
        <h1>Page PDF</h1>
        <button @click="closePdf()" id="btnFermer">X Fermer</button>
        <section>
          <pdfItem v-for="pdf in dataPDF" :key="pdf.idPDF" :pdf="pdf" @setEmbed="setEmbed($event)"/>
        </section>
        <div><embed :src="lienPDF"></div>
      </div>
    </nav>
  </main>
</template>

<script>  
import store from '@/store'
import custonBar from '@/components/SideBar.vue'
import carteComponent from '@/components/carteComponent.vue'
import pdfItem from '@/components/pdfItem.vue'
export default {
  name: 'HomeView',
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
    custonBar,
    carteComponent,
    pdfItem
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
      visible: false,
      pdfVisible: false,
      listePatrons: [],
      listeSelectedPatrons: [],
      dataPDF: [],
      lienPDF: '',
      nbSide: 0,
      isLogged: false
    }
  },
  methods: {
    // methods here
    getAllPaterns(){
      let myFormData = new FormData();
      myFormData.append('req','pattern')
      myFormData.append('action','getAllPatern')
      myFormData.append('idUser',localStorage.getItem('idUser'))
      fetch(this.dataStore.baseUrl,{
        body: myFormData,
        method: 'POST'
      })
        .then(response=>response.json())
        .then(response => {
          this.listePatrons = response
          this.listeSelectedPatrons = this.listePatrons
        })
        .catch(error=>{
          console.log(error)
        })
    },
    // test(e){
    //   console.log(e)
    //   this.visible = true
    // },
    accesPDF(e){
      this.dataPDF = []
      this.dataPDF = e
      this.pdfVisible = true
    },
    setEmbed(e){
      this.lienPDF = 'https://noto.alwaysdata.net/back'
      this.lienPDF += e
      // console.log(this.lienPDF)
    },
    closePdf(){
      this.pdfVisible = false
      this.lienPDF =''
    },
    setListePatron(e){
      this.listeSelectedPatrons = e
    },
    resetSearch(){
      this.nbSide++
      this.listeSelectedPatrons = this.listePatrons
    }
  },
  mounted () {
    // mounted here
    if(localStorage.getItem('idUser')){
      this.getAllPaterns()
    }
    this.isLogged = localStorage.getItem('isLogged')
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
  display: flex;
  background-color: rgba(211, 211, 211, 0.688);
}

#sideBar{
	width: 15%;
	position: sticky;
	top: 10%;
  height: 10%;
  margin: 2%;
  background-color: white;
  border-radius: 20px;
}

#viewContainer{
	width: 100%;
  display: flex;
  border: solid 1px;
  border-radius: 20px;
  margin: 1%;
  justify-content: space-evenly;
  flex-wrap: wrap;
}

#editMode{
  position: absolute;
  background-color: white;
  width: 100%;
  height: 200%;
  
}

#pdfPage{
  position: absolute;
  background-color: rgb(111, 110, 110,0.4);
  width: 100%;
  height: 150%;
}

#pdfPage>div{
  width: 96%;
  height: 80%;
  margin: 2%;
  padding: 1%;
  border: solid 1px;
  background-color: white;
  box-shadow: 10px 10px 10px black;
  display: flex;
  flex-wrap: wrap;
}

#pdfPage>div>h1{
  flex: 1 1 90%;
}

#pdfPage>div>section{
  display: flex;
  flex-direction: column;
  flex-wrap: wrap;
  width: 20%;
  height: 70%
}

#pdfPage>div>div{
  width: 80%;
  border: solid 1px;
}

embed{
  width: 100%;
  height: 100%;
}

#btnFermer{
  height: 5%;
}

#notLog{
  text-align: center;
}
</style>
