<template>
  <main>
    <div id="editDiv">
      <h1>Edition du patron : {{ pattern.pLibel }}</h1>
      <!-- Titre -->
      <nav>
        <label for="patternTitle">
          <h3>Titre du patron : </h3>
        </label><input id="patternTitle" type="text" placeholder="Titre" v-model="newPattern.patterName">
      </nav>
      <!-- LIEN -->
      <nav>
        <label for="patternLink">
          <h3>Lien du patron : </h3>
        </label><input id="patternLink" type="text" placeholder="Lien..." v-model="newPattern.patternLink">
      </nav>
      <!-- MARQUE -->
      <nav>
        <label for="patternBrand">
          <h3>Marque du patron : </h3>
        </label>
        <select id="patternBrand" @change="newPattern.patternBrand = $event.target.value">
          <option selected disabled>Super Bison</option>
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
        <select id="patternType" @change="newPattern.patternType = $event.target.value">
          <option selected disabled>Blouse</option>
          <option v-for="typepatron in patternTypeList" :key="typepatron.idTypePatron" :id="typepatron.idTypePatron"
            :value="typepatron.idTypePatron"> {{ typepatron.tpLibel }}
          </option>
        </select>
      </nav>
      <!-- Notes -->
      <nav>
        <label for="patternNotes">
          <h3>Notes : </h3>
        </label><textarea id="patternNotes" type="text" placeholder="Notes sur le patron..."
          v-model="newPattern.patternDesc"></textarea>
      </nav>
      <!--PDF-->
      <nav>
        <label>
          <h3>PDF :</h3>
          <section>
            <img src="../assets/pdf_file.png" width="50" />
            <figcaption>notice_bardot.pdf</figcaption>
            <button>Supprimer</button>
          </section>
          <section>
            <img src="../assets/pdf_file.png" width="50" />
            <figcaption>patron_bardotA0.pdf</figcaption>
            <button>Supprimer</button>
          </section>
          <section>
            <img src="../assets/pdf_file.png" width="50" />
            <figcaption>patron_Projection_Bardot.pdf</figcaption>
            <button>Supprimer</button>
          </section>
        </label>
        <pdfFormSubmit />
      </nav>
      <button style="padding: 1%;">Mettre à jour le patron</button>
    </div>
  </main>
</template>

<script>
import store from '@/store'
import pdfFormSubmit from '@/components/pdfFormSubmit.vue'

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
    pdfFormSubmit
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
      newPattern: store.newPattern
    }
  },
  methods: {
    // methods here
  },
  mounted() {
    // mounted here
    this.pattern = this.dataStore.patternInEdit
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
</style>
