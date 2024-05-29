<template>
  <!-- <button @click="test()">Test</button> -->
  <main>
    <div id="sideBar">
        <custonBar/>
      </div>
    <div id="viewContainer">
      <carteComponent v-for="patron in listePatrons" :key="patron.idPatron" :patron="patron" @accesPDF="accesPDF($event)" @editEvent="test($event)"/>
    </div>
    <div id="editMode" v-if="visible">
      <h1>Page édition</h1>
    </div>
    <div id="pdfPage" v-if="pdfVisible">
      <h1>Page PDF</h1>
    </div>
  </main>
</template>

<script>  
import store from '@/store'
import custonBar from '@/components/SideBar.vue'
import carteComponent from '@/components/carteComponent.vue'
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
    carteComponent
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
      listePatrons: []
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
          console.log(response)
          this.listePatrons = response
          console.log(this.listePatrons)
        })
        .catch(error=>{
          console.log(error)
        })
    },
    test(e){
      console.log(e)
      this.visible = true
    },
    accesPDF(e){
      console.log(e)
      this.pdfVisible = true
    }
  },
  mounted () {
    // mounted here
    this.getAllPaterns()
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
  background-color: white;
  width: 100%;
  height: 200%;
}
</style>
