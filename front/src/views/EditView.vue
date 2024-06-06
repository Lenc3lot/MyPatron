<template>
  <main>
    <div id="editDiv">
      <h1>Edition du patron : {{ pattern.pLibel }}</h1>
      <!-- Titre -->
      <nav>
        <label for="patternTitle">
          <h3>Titre du patron : </h3>
        </label><input id="patternTitle" type="text" placeholder="Titre" v-model="pattern.pLibel" @change="formadata.append('pLibel',pattern.pLibel)">
      </nav>
      <!-- LIEN -->
      <nav>
        <label for="patternLink">
          <h3>Lien du patron : </h3>
        </label><input id="patternLink" type="text" placeholder="Lien..." v-model="pattern.pLien" @change="formadata.append('pLien',pattern.pLien)">
      </nav>
      <!-- MARQUE -->
      <nav>
        <label for="patternBrand">
          <h3>Marque du patron : </h3>
        </label>
        <select id="patternBrand" @change="setNewBrand($event)">
          <option selected disabled>{{pattern.libelMarque}}</option>
          <option v-for="marque in patternBrandList" :key="marque.idMarque" :id="marque.idMarque"
            :value="marque.idMarque">{{
        marque.libelMarque }}</option>
        </select>
      </nav>
      <!-- Type -->
      <nav>
        <label for="patternType">
          <h3>Type du patron : </h3>
        </label>
        <select id="patternType" @change="setNewType($event)">
          <option selected disabled>{{pattern.tpLibel}}</option>
          <option v-for="typepatron in patternTypeList" :key="typepatron.idTypePatron" :id="typepatron.idTypePatron" :value="typepatron.idTypePatron"> 
            {{ typepatron.tpLibel }}
          </option>
        </select>
      </nav>
      <!-- Notes -->
      <nav>
        <label for="patternNotes">
          <h3>Notes : </h3>
        </label><textarea id="patternNotes" type="text" placeholder="Notes sur le patron..."
          v-model="pattern.pDesc" @change="formadata.append('pDesc',pattern.pDesc)"></textarea>
      </nav>
      <!--PDF-->
      <nav>
        <label>
          <h3>PDF :</h3>
          <pdfItemEdit v-for="pdf in pattern.infoPdf" :key="pdf.idPDF" :pdf="pdf" />
        </label>
        <pdfFormSubmit @addEdit="formadata.append('pdfs',JSON.stringify(dataStore.newPattern.patternPDF))"/>
      </nav>
      <button style="padding: 1%;" @click="updatePattern()">Mettre à jour le patron</button>
    </div>
  </main>
</template>

<script>
import store from '@/store'
import pdfFormSubmit from '@/components/pdfFormSubmit.vue'
import pdfItemEdit from '@/components/pdfItemEdit.vue'
export default {
  name: 'editView',
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
    pdfFormSubmit,
    pdfItemEdit
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
      pattern: [],
      newPattern: store.newPattern,
      patternBrandList: [],
      patternTypeList:[],
      formadata: new FormData()
    }
  },
  methods: {
    // methods here
    getPatternBrand() {
            let datas = new FormData();
            datas.append('req', 'pattern');
            datas.append('action', 'getPatternBrand');
            fetch(this.dataStore.baseUrl, {
                body: datas,
                method: 'POST'
            })
                .then(response => response.json())
                .then(response => {
                    this.patternBrandList = response
                })
                .catch(error => {
                    console.log(error)
                })
        },
        getPatternType() {
            let datas = new FormData();
            datas.append('req', 'pattern');
            datas.append('action', 'getPatternType');
            fetch(this.dataStore.baseUrl, {
                body: datas,
                method: 'POST'
            })
                .then(response => response.json())
                .then(response => {
                    this.patternTypeList = response
                })
                .catch(error => {
                    console.log(error)
                })
        },
        setNewBrand(e){
          this.pattern.idMarque = e.target.value
          this.formadata.append('idMarque',this.pattern.idMarque)
        },
        setNewType(e){
          this.pattern.idTypePatron = e.target.value
          this.formadata.append('idTypePatron',this.pattern.idTypePatron)
        },
        updatePattern(){
          this.formadata.append('req','pattern')
          this.formadata.append('action','editPattern')
          this.formadata.append('idUser',localStorage.getItem('idUser'))
          this.formadata.append('idPatron',this.pattern.idPatron)
          console.log(this.formadata)
          fetch(this.dataStore.baseUrl,{
            body:this.formadata,
            method:'POST'
          })
            .then(response=>response.json())
            .then(response=> {
              if(response['statut'] == '200'){
                this.$swal({
                  title: 'Patron modifié !',
                  icon: 'success'
                })
                this.$router.push('/')
              }
            })
            .catch(error=>{
              console.error(error)
            })
        }
  },
  mounted() {
    // mounted here
    this.pattern = this.dataStore.patternInEdit
    console.log(this.pattern)
    this.getPatternBrand()
    this.getPatternType()
  },
  created() {
    // created here
  }
}
</script>

<style scoped>
/* Style here */
#editDiv {
  background-color: white;
  margin: 1%;
  padding: 1%;
}

section {
  display: flex;
  flex-direction: row;
  align-items: center;
}

section>button {
  padding: 1%;
  margin-left: 2%;
}

input{
  margin: 1%;
}
</style>
