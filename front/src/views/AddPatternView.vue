<template>
    <main>
        <div id="newPatternDiv">
            <h1>Ajouter un nouveau patron</h1>
            <!-- PHOTO -->
            <nav>
                <label>Photo du patron :</label>
                    <input id="importFile" type="file" style="border: dashed 1px;" placeholder="Ajouter une Photo" @input="console.log($event.file)">
            </nav>
            <!-- TITRE -->
            <nav>
                <label for="patternTitle">
                    <h3>Titre du patron : </h3>
                </label><input id="patternTitle" type="text"
                    placeholder="Titre" v-model="newPattern.patterName">
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
                </label><select id="patternBrand" @change="newPattern.patternBrand = $event.target.value">
                    <option selected disabled>Sélectionner une marque</option>
                    <option v-for="marque in patternBrandList" :key="marque.idMarque" :id="marque.idMarque" :value="marque.idMarque">{{
                    marque.libelMarque }}</option>
                </select>
            </nav>
            <!-- Type -->
            <nav>
                <label for="patternType">
                    <h3>Type du patron : </h3>
                </label>
                <select id="patternType" @change="newPattern.patternType = $event.target.value">
                    <option selected disabled>Sélectionner un type</option>
                    <option v-for="typepatron in patternTypeList" :key="typepatron.idTypePatron"
                        :id="typepatron.idTypePatron" :value="typepatron.idTypePatron"> {{ typepatron.tpLibel }}</option>
                </select>
            </nav>
            <!-- Tag -->
            <nav>
                <label for="patternTags">
                    <h3>Tags du patron : </h3>
                </label>
                <nav>
                    <select @change="addTag($event)">
                        <option disabled selected>Choisir un tag</option>
                        <option v-for="tag in allTagsList" :key="tag.idTag"
                        :id="tag.idTag" :value="tag.idTag"> {{ tag.tLibel }}</option>
                    </select>
                </nav>
                <!-- V-FOR sur un <newTag> par rapport à un nombre qui par défaut = 0, -->
                <newTag v-for="n in nbTag" :tagList="cuttedTagsList" :key="n" @addNewTagEvent="addExtraTag($event)"/>
                <button id="patternAddTags" @click="ajtTag()" v-if="nbTag <1">Ajouter un tag</button>
            </nav>
            <!-- Notes -->
            <nav>
                <label for="patternNotes">
                    <h3>Notes : </h3>
                </label><textarea id="patternNotes" type="text" placeholder="Notes sur le patron..." v-model="newPattern.patternDesc"></textarea>
            </nav>
            <nav>
                <input type="submit" value="Créer un nouveau patron" @click="createNew()">
            </nav>
        </div>
    </main>
</template>

<script>
/*
OK, en fait il faut reprendre le problème pour tout ce qui est MARQUE, TYPE et TAGS, on veux pas récupérer une value mais l'ID qui est lié, donc
il faut mettre en place des events @select sur les input de type select.

Aussi peut être pas mal de reprendre les newTags, voire de tout passer concernant les tags dans le store et de créer un objet newPattern dedans.

TO DO : 
    - Créer nvl objt newPattern dans le store.
    - Récup ID des select.
    - Ajouter les tags par customEvent ou push dans store.
    - Pouvoir suppr des nvx tags ajoutés.
    - Pouvoir upload ( donc stocker dans un doss + chemin relat ) UNE image.
    - Ajout de fichier PDF (simple dans un 1er temps) et de stocker le chemin relat
*/

import store from '@/store'
import newTag from '@/components/newTag.vue'
import router from '@/router'
export default {
    name: 'AddPattern',
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
        newTag
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
            patternBrandList: [],
            patternTypeList: [],
            allTagsList: [],
            cuttedTagsList:[],
            nbTag : 0,
            newPattern: store.newPattern
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
        getAllTags() {
            let datas = new FormData();
            datas.append('req', 'tags');
            datas.append('action', 'getAllTags');
            fetch(this.dataStore.baseUrl, {
                body: datas,
                method: 'POST'
            })
                .then(response => response.json())
                .then(response => {
                    this.allTagsList = response
                })
                .catch(error => {
                    console.log(error)
                })
        },
        ajtTag(){
            this.nbTag++
        },
        addTag(e){
            if(this.nbTag == 0 && this.newPattern.patternTag.length<= 1){
                let idTagSelected = e.target.value - 1
                this.newPattern.patternTag = [e.target.value];
                let tabSize = this.allTagsList.length
                this.cuttedTagsList = this.allTagsList.slice(0,idTagSelected).concat(this.allTagsList.slice(idTagSelected+1,tabSize));
            }else{
                let chngFirstTag = [e.target.value]
                this.newPattern.patternTag = chngFirstTag.concat(this.newPattern.patternTag.slice(1,this.newPattern.patternTag.length))
                let idTagSelected = e.target.value - 1
                let tabSize = this.allTagsList.length
                this.cuttedTagsList = this.allTagsList.slice(0,idTagSelected).concat(this.allTagsList.slice(idTagSelected+1,tabSize));
            }
        },
        addExtraTag(e){
            if(this.nbTag >= 1 && this.newPattern.patternTag.length <= this.nbTag){
                this.newPattern.patternTag.push(e)
            }else{
                let newPat = [e]
                this.newPattern.patternTag = this.newPattern.patternTag.slice(0,this.newPattern.patternTag.length-1).concat(newPat)
            }
        },
        createNew(){
            this.$swal({
                icon:'question',
                title: 'Êtes vous sûr(e) de vouloir créer le nouveau patron ?',
                showCancelButton: true,
                showValidationButton: true,
                confirmButtonText: 'Valider',
                cancelButtonText: 'Annuler'
            }).then((result)=>{
                if(result.isConfirmed){
                    this.$swal('Patron créé !','','success')
                    router.push('/')
                }
            })
        }
    },
    mounted() {
        // mounted here
        this.getPatternBrand();
        this.getPatternType();
        this.getAllTags();
    },
    created() {
        // created here
    }
}
</script>

<style scoped>
/* Style here */
#newPatternDiv {
    display: flex;
    margin: 2%;
    padding: 2%;
    background-color: azure;
    border-radius: 10px;
    display: flex;
    flex-wrap: wrap;
    flex-direction: row;
}

#newPatternDiv>h1 {
    flex: 1 1 100%;
}

#newPatternDiv>nav {
    flex: 1 1 45%;
    margin: 1%;
    display: flex;
    flex-direction: column;
    /* align-items: center; */
}

#newPatternDiv>nav>input,
select,
textarea {
    width: 100%;
    padding: 10px;
}

#newPatternDiv>:nth-last-child(2){
    flex: 1 1 100%;
}

#newPatternDiv>:last-child>input{
    width: 20%;
    border-radius: 10px
}

#newPatternDiv>:nth-child(7)>*{
    width: 20%;
    margin: 1%;
}

#newPatternDiv>:nth-child(2){
    /* background-color: blue; */
    height: 15vh ;
    flex: 1 1 100%;
    justify-content: center;
    align-items: left;
}

#newPatternDiv>:nth-child(2)>input:hover{
    cursor: pointer;
    box-shadow: 5px 5px 5px rgb(178, 171, 171);
}
</style>
