<template>
  <!-- <button @click="test()">Test</button> -->
  <main>
    <div id="sideBar">
        <custonBar/>
      </div>
    <div id="viewContainer">
      <carteComponent v-for="n in 20" :key="n"/>
    </div>
  </main>
</template>

<script>  
// import store from '@/store'
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
      // dataStore: store
      visible : false
    }
  },
  methods: {
    // methods here
    test(){
      let myFormData = new FormData();
      myFormData.append('req','user')
      myFormData.append('action','doTest')
      fetch('http://localhost/MyPatron/back/requestHandler.php',{
        body: myFormData,
        method: 'POST'
      })
        .then(response=>response.json())
        .then(response => {
          console.log((response))
        })
        .catch(error=>{
          console.log(error)
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

</style>
