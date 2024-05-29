<template>
    <form novalidate @submit.prevent="onSubmit">
        <pdfUploads v-model="form.file"></pdfUploads>
        <button @click="test()">Importer</button>
    </form>
</template>

<script>
import pdfUploads from './pdfUploads.vue';
import store from '@/store'
export default {
    components: { pdfUploads },
    data: () => ({
        dataStore: store,
        form: { file: null },
        isSubmit: false,
        img: '',
        fimeName: '',
        idUser:'user0'
    }),
    methods: {
        onSubmit() {
        },
        test() {
            this.submit
            let data = new FormData()
            let taille = Object.keys(this.form.file).length
            let nomsFiles = []
            for (let i = 0; i < taille; i++) {
                data.append('fileToUpload'+i,this.form.file[i])
                nomsFiles.push(this.form.file[i]['name'])
            }
            this.dataStore.newPattern.patternPDF = nomsFiles
            data.append('req','pdf')
            data.append('action','addTempPdf')
            data.append('nbPDF',taille)
            fetch(this.dataStore.baseUrl, {
                body: data,
                method: 'POST'
            })
                .then(response=>response.json())
                .then(response=>{
                    console.log(response)
                    if(response.statut == '200'){
                        this.$swal({
                            title:'Transfert réussi !',
                            icon: 'success'
                        })
                        console.log(this.dataStore.newPattern.patternPDF)
                    }
                })
                .catch(error=>{
                    console.error(error)
                })
        }
    }
}
</script>