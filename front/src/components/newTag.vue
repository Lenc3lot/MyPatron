<template>
    <nav>
        <!-- Il faut un emit pour envoyer la valeur qui est select , soit mettre les data du patron en création dans le store-->
        <!-- Peut etre aussi stocker en store la liste des != tags, pour pouvoir les supprimer si on veut les tejs -->
        <select @change="send($event)">
            <option disabled selected>Choisir un autre tag</option>
            <option v-for="tag in tagList" :key="tag.idTag" :id="tag.idTag" :value="tag.idTag"> {{ tag.tLibel }}</option>
        </select>
        <!-- <button>X Supprimer</button> -->
    </nav>
</template>

<script>
import store from '@/store'
export default {
    name: 'newTag',
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
    },
    props: {
        // props here
        tagList: Object
    },
    watch: {
        // variables to watch here
    },
    data() {
        return {
            // variables here
            dataStore: store
        }
    },
    methods: {
        // methods here
        send(e){
            this.$emit('addNewTagEvent',e.target.value)
        }
    },
    mounted() {
        // mounted here
        // this.getAllTags();
    },
    created() {
        // created here
    }
}
</script>

<style scoped>
/* Style here */
select{
    width: 100%;
    padding: 10px;
}
</style>
