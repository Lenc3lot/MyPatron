<template>
  <header class="header">
		<ul class="main-nav">
      <nav>
			<li>Trier par :</li>
        <select @change="selectedTag = $event.target.value">
          <option selected disabled>Sélectionner...</option>
          <option v-for="tag in allTags" :key="tag.idTag" :value="tag.idTag">{{ tag.tLibel }}</option>
        </select>
      </nav>
      <nav>
        <li>Type :</li>
        <select @change="selectedType = $event.target.value">
          <option selected disabled>Sélectionner...</option>
          <option v-for="types in allTypes" :key="types.idTypePatron" :value="types.idTypePatron">{{ types.tpLibel }}</option>
        </select>
      </nav>
      <nav>
			<li>Marque :</li>
        <select @change="selectedBrand = $event.target.value">
          <option selected disabled>Sélectionner...</option>
          <option v-for="brand in allBrands" :key="brand.idMarque" :value="brand.idMarque">{{ brand.libelMarque }}</option>
        </select>
      </nav>
      <p v-if="displayReset" @click="resetSearch()">Annuler le tri</p>
		</ul>
    <button @click="selectSpePattern()" v-if="isLogged">GO</button>
	</header>
</template>

<script>
import store from '@/store'
export default {
  name: 'SideBar',
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
      dataStore: store,
      allTags: [],
      allTypes: [],
      allBrands: [],
      selectedTag: '',
      selectedType: '',
      selectedBrand: '',
      displayReset: false,
      isLogged: false
    }
  },
  methods: {
    // methods here
    getTags(){
      let monFormData = new FormData()
      monFormData.append('req','tags')
      monFormData.append('action','getAllTags')
      fetch(this.dataStore.baseUrl, {
        body: monFormData,
        method: 'POST'
      })
        .then(response => response.json())
        .then(response => {
          // console.log(response)
          this.allTags = response
        })
        .catch(error=> {
          console.error(error)
        })
    },
    getType(){
      let monFormData = new FormData()
      monFormData.append('req','pattern')
      monFormData.append('action','getPatternType')
      fetch(this.dataStore.baseUrl, {
        body: monFormData,
        method: 'POST'
      })
        .then(response => response.json())
        .then(response => {
          // console.log(response)
          this.allTypes = response
        })
        .catch(error=> {
          console.error(error)
        })
    },
    selectSpePattern(){
      let monFormData = new FormData()
      monFormData.append('req','pattern')
      monFormData.append('action','selectSpeType')
      monFormData.append('idTypePatron',this.selectedType)
      monFormData.append('idTag',this.selectedTag)
      monFormData.append('idMarque',this.selectedBrand)
      monFormData.append('idUser',localStorage.getItem('idUser'))
      console.log(monFormData)
      fetch(this.dataStore.baseUrl,{
        body: monFormData,
        method: 'POST'
      })
      .then(response => response.json())
      .then(response =>{
        // console.log(response)
        this.selectedSpePattern = response
        this.$emit('setSpePatt',this.selectedSpePattern)
        this.displayReset = true
      })
      .catch(error=>{
        console.error(error)
      })
    },
    resetSearch(){
      this.displayReset = false
      this.$emit('resetSearch')
    },
    getPatternBrands(){
      let monFormData = new FormData()
      monFormData.append('req','pattern')
      monFormData.append('action','getPatternBrand')
      fetch(this.dataStore.baseUrl,{
        body: monFormData,
        method: 'POST'
      })
        .then(response=>response.json())
        .then(response=>{
          this.allBrands = response
        })
    }
  },
  mounted () {
    // mounted here
    this.getTags()
    this.getType()
    this.getPatternBrands()
    this.isLogged = localStorage.getItem('isLogged')
  },
  created () {
    // created here
  }
}
</script>

<style scoped>
/* Style here */

ul {
	margin: 0;
	padding: 0;
	list-style: none;
}


h2,
h3,
a {
	color: #34495e;
}

.main-nav {
	margin-top: 5px;
	display: flex;
	flex-direction: column;
}

.logo a,
.main-nav a {
	padding: 10px 15px;
	text-transform: uppercase;
	text-align: center;
	display: block;
}

.main-nav a {
	color: #34495e;
	font-size: .99em;
}

.main-nav a:hover {
	color: #718daa;
}

.header {
	-webkit-box-shadow: 0px 0px 6px 0px rgba(0, 0, 0, 0.75);
	-moz-box-shadow: 0px 0px 6px 0px rgba(0, 0, 0, 0.75);
	box-shadow: 0px 0px 6px 0px rgba(0, 0, 0, 0.75);
	display: flex;
	flex-direction: column;
  flex-shrink: 0;
	width: 100%;
	padding: 10%;
  border-radius: 20px;
	text-align: center;
	margin-right: 1%;
	position: -webkit-sticky;
	position: sticky;
	top: 0;
}

.header>*{
	width: 100%;
}

select{
  border-radius: 50px 50px; 
  width: 100%;
}

nav{
  padding-bottom: 10%;
}

button{
  border-radius: 50px 50px;
  margin-top: 10%;
  width: 10%;
}

p:hover{
  cursor: pointer;
}
</style>
