<template>
    <section>
        <img src="../assets/pdf_file.png" width="50" />
        <p>{{name}}</p>
        <button @click="deletePDF()">Supprimer</button>
    </section>
</template>

<script>
import store from '@/store'
export default {
    name: 'pdfItemEdit',
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
        pdf: Object
    },
    watch: {
        // variables to watch here
    },
    data() {
        return {
            // variables here
            dataStore: store,
            name: ''
        }
    },
    methods: {
        // methods here
        deletePDF(){
            let formdata = new FormData()
            formdata.append('req','pdf')
            formdata.append('action','deletePDF')
            formdata.append('idPDF',this.pdf['idPDF'])
            fetch(this.dataStore.baseUrl,{
                body: formdata,
                method: 'POST'
            })
                .then(response=> response.json())
                .then(response=>{
                    console.log(response)
                })
                .catch(error=>{
                    console.error(error)
                })
        }
    },
    mounted() {
        // mounted here
        let splitPath = this.pdf['relativePath'].split('/') 
        this.name = splitPath[4]
    },
    created() {
        // created here
    }
}
</script>

<style scoped>
/* Style here */
section {
  display: flex;
  flex-direction: row;
  align-items: center;
}
</style>
