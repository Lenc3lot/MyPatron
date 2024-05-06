<template>
  <h1>Vue Image Upload</h1>
    <form action="http://localhost/oui/test.php" method="POST" enctype="multipart/form-data" id="formToUpload" @onsubmit="console.log('holla')">
      <input name="fileToUpload" id="file-input" type="file" required />
      <input for="formToUpload" type="submit">
    </form>
    
    <h2 for="file-input">Click or Drag N Drop Image</h2>
    <img v-bind:src="img" />
    <h3 v-if="preview">File name: {{ fileName }}</h3>


</template>

<script>export default {
  name: "App",
  data() {
    return {
      fileName: "",
      preview: null,
      preset: process.env.VUE_APP_UPLOAD_PRESET,
      formData: null,
      cloudName: process.env.VUE_APP_CLOUD_NAME,
      success: "",
      img: ''
    };
  },
  methods: {
    handleFileChange: function (event) {
      this.file = event.files[0];
      console.log(this.file)
      this.fileName = this.file.name;
      console.log(URL.createObjectURL(this.file))
      this.img = require(URL.createObjectURL(this.file))

      // this.formData = new FormData();
      // this.formData.append("upload_preset", this.preset);

      // let reader = new FileReader();
      // reader.readAsDataURL(this.file);

      // reader.onload = (e) => {
      //   this.preview = e.target.result;
      //   this.formData.append("file", this.preview);
      //   this.formData.append("fileName",this.fileName)
      //   fetch('http://localhost/oui/test.php',{
      //   body: this.formData,
      //   method: 'POST',
      //   enctype: 'multipart/form-data'
      // })
      //   .then(response=>response.json())
      //   .then(response=>{
      //     console.log(response)
      //   })
      //   .catch(error=>{
      //     console.log(error)
      //   })
      // };
    },
  },
};
</script>

<style scoped>
</style>