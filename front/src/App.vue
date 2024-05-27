<template>
  <NavBar @logOut="update()" :key="componentsKey"/>
  <router-view/>
</template>

<script>
  import NavBar from '@/components/NavBar.vue';
  // import SideBar from '@/components/SideBar.vue';
  export default {  
    components:{
      NavBar
    },
  data () {
    return {
      // variables here
      // dataStore: store
      visible : 'false',
      componentsKey : 0
    }
  },
  methods: {
    update(){
      this.componentsKey += 1;
      this.$router.push('/login')
    }
  }
  }
</script>

<style scoped>
#app {
	font-family: Avenir, Helvetica, Arial, sans-serif;
	-webkit-font-smoothing: antialiased;
	-moz-osx-font-smoothing: grayscale;
	color: black; 
	display: flex;
	flex-direction: row;
	height: 100%;
  background-color: rgba(211, 211, 211, 0.688);
}

* {
	box-sizing: border-box;
}

body {
	font-family: 'Montserrat', sans-serif;
	line-height: 1.6;
	margin: 0px;
	padding: 0px;
	min-height: 100vh;
  background-color: rgba(211, 211, 211, 0.688);
	height: 40rem;
}

</style>
