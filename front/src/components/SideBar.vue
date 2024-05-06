<template>
  <header class="header">
		<ul class="main-nav">
      <nav>
			<li>Trier par :</li>
        <select>
          <option selected disabled>Sélectionner...</option>
          <option>Option 1</option>
          <option>Option 2</option>
        </select>
      </nav>
      <nav>
        <li>Type :</li>
        <select>
          <option selected disabled>Sélectionner...</option>
          <option>Option 1</option>
          <option>Option 2</option>
        </select>
      </nav>
		</ul>
    <button>GO</button>
	</header>
</template>

<script>
// import store from '@/store'
export default {
  name: 'SideBar',
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
  },
  watch: {
    // variables to watch here
  },
  data () {
    return {
      // variables here
      // dataStore: store
    }
  },
  methods: {
    // methods here
  },
  mounted () {
    // mounted here
  },
  created () {
    // created here
  }
}
</script>

<style scoped>
/* Style here */

ul {
	margin: 0;
	padding: 0;
	list-style: none;
}


h2,
h3,
a {
	color: #34495e;
}

.main-nav {
	margin-top: 5px;
	display: flex;
	flex-direction: column;
}

.logo a,
.main-nav a {
	padding: 10px 15px;
	text-transform: uppercase;
	text-align: center;
	display: block;
}

.main-nav a {
	color: #34495e;
	font-size: .99em;
}

.main-nav a:hover {
	color: #718daa;
}

.header {
	-webkit-box-shadow: 0px 0px 6px 0px rgba(0, 0, 0, 0.75);
	-moz-box-shadow: 0px 0px 6px 0px rgba(0, 0, 0, 0.75);
	box-shadow: 0px 0px 6px 0px rgba(0, 0, 0, 0.75);
	display: flex;
	flex-direction: column;
  flex-shrink: 0;
	width: 100%;
	padding: 10%;
  border-radius: 20px;
	text-align: center;
	margin-right: 1%;
	position: -webkit-sticky;
	position: sticky;
	top: 0;
}

.header>*{
	width: 100%;
}

select{
  border-radius: 50px 50px; 
  width: 100%;
}

nav{
  padding-bottom: 10%;
}

button{
  border-radius: 50px 50px;
  margin-top: 10%;
  width: 10%;
}
</style>
