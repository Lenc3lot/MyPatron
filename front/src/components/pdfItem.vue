<template>
    <div>
        <img id="imgPDF" src="../assets/pdf_file.png" width="50" height="50" @click="sendInfo()"/>
        <label for="imgPDF" id="imgPDF"><h6> {{titre}}</h6></label>  
    </div>
</template>

<script>
// import store from '@/store'
export default {
  name: 'pdfItem',
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
    pdf: Object
  },
  watch: {
    // variables to watch here
  },
  data () {
    return {
      // variables here
      // dataStore: store
      titre: '',
      relativePath: ''
    }
  },
  methods: {
    // methods here
    sendInfo(){
        this.$emit('setEmbed',this.relativePath)
    },
    setName(){
        let nomFichier = this.pdf['relativePath']
        let tempTitre = nomFichier.split('/')
        this.titre = tempTitre[4]
    }
  },
  mounted () {
    // mounted here
    this.setName()
    this.relativePath = this.pdf['relativePath'].split('/')
    this.relativePath.splice(0,1)
    let count = this.relativePath.length
    let nvChemin = ''
    for (let index = 0; index < count; index++) {
        nvChemin += '/'+this.relativePath[index]
    }
    this.relativePath = nvChemin
  },
  created () {
    // created here
  }
}
</script>

<style scoped>
/* Style here */
img{
    margin: 1%;
}

#imgPDF:hover{
    cursor: pointer;
}
</style>
