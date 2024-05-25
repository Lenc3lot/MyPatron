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
            console.log('plop')
        },
        test() {
            this.submit
            console.log(this.form)
        }
    }
}
</script>