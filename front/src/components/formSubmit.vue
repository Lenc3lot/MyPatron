<template>
    <form novalidate @submit.prevent="onSubmit">
        <file-upload v-model="form.file"></file-upload>
        <button @click="test()">Importer</button>
    </form>
    <img v-if="isSubmit" v-bind:src="img" height="100" width="100" />
</template>

<script>
import fileUpload from './fileUpload.vue';
import store from '@/store'
export default {
    components: { fileUpload },
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
            if (!this.isSubmit) {
                let data = new FormData()
                data.append('fileToUpload', this.form.file)
                data.append('req','img')
                data.append('action','addTempPicture')
                fetch('https://noto.alwaysdata.net/back/requestHandler.php', {
                    body: data,
                    method: 'POST'
                })
                    .then(response => response.json())
                    .then(response => {
                        // console.log('plop')
                        console.log(response)
                        this.img = "https://noto.alwaysdata.net/back/uploads/temp/"+this.form.file.name
                        this.fimeName = this.form.file.name
                        this.dataStore.newPattern.patternPicture = this.form.file.name
                        console.log(this.dataStore.newPattern.patternPicture)
                        this.isSubmit = true
                    })
                    .catch(error => {
                        console.log(error)
                    })
            }else{
                // CAS SI UNE IMG DEJA CHARGEE
                console.log('CHANGEMENT IMG');
                let monFormdata = new FormData();
                monFormdata.append('action','deleteTempPict')
                monFormdata.append('req','img')
                monFormdata.append('fileName',this.fimeName)
                monFormdata.append('user',this.idUser)
                monFormdata.append('fileToUpload', this.form.file)
                fetch('http://noto.alwaysdata.net/back/requestHandler.php',{
                    body: monFormdata,
                    method: 'POST'
                })
                    .then(response => response.json())
                    .then(response=>{
                        console.log(response)
                        this.img = "https://noto.alwaysdata.net/back/uploads/temp/"+this.form.file.name
                        this.fimeName = this.form.file.name
                        this.dataStore.newPattern.patternPicture = this.form.file.name
                    })
                    .catch(error => console.error(error))
            }
            // post the form to the server
        },
        test() {
            this.submit
        }
    }
}
</script>