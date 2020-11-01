<template>
  <form enctype="multipart/form-data" @submit.prevent="submit()">
      <a-row style="margin: 20px">
           <a-input placeholder="Basic usage"  v-model="name"/>
      </a-row>
      <div class="thumbs">
          <div  v-for="(thumb, index) of thumbs" :key="index" class="thumb">
              <img class="thumb-image" :src="thumb" alt="thumb"/>
          </div>
          <div  class="img_choose">
                 <input  type="file" ref="files"  name="images" accept="image/*" @change="onFileChange" multiple />
          </div>
      </div><br/>
    <div style="margin: 20px">
         <a-button html-type="submit">Upload</a-button>
    </div>

  </form>
</template>
<script>

export default {
  data() {
    return {
        name:'',
        thumbs:[],
        images: [ ],
    };
  },
  methods: {
    onFileChange(event) {
        let files = event.target.files;
  
        for (const file of files) {

            this.images.push(file);
            let reader = new FileReader();
            reader.readAsDataURL(file);

            reader.onload = () => {
                this.thumbs.push(reader.result);
            };

            reader.onerror = function () {
                alert('Ошибка при загрузке файла');
            };

        }
      },
    submit(){
        const formData = new FormData();
        formData.append('name', this.name)
       for( var i = 0; i < this.images.length; i++ ){
            let file = this.images[i];
             formData.append('images[' + i + ']', file);
        }
        
        axios.post('',  formData, {
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        }).then(response =>{
                    console.log('response',response.data);
        })
        .catch(error => console.log(error.response.data.errors))
        
    }
  },
};
</script>
<style>
.thumbs{
    padding: 20px;
    height: 200px;
    display: flex;
}
.thumb{
    width: 200px;
    height: 200px;
    border: 1px solid  cornflowerblue;
    margin-right: 2px;
}
.thumb-image{
    width: 100%;
    height: 100%;
    object-fit: cover;
}
.flex{
    display: flex;
    flex-direction: column;
}
.img_choose{
    width: 200px;
    height: 200px;
    border: 1px dotted #ddd;
    display: flex;
    align-items: center;
    justify-content: center;
}
.img_choose input{
    /* visibility: hidden; */
}
</style>
