<template>
    <div class="uploader"
        @dragenter="onDragEnter"
        @dragleave="onDragLeave"
        @dragover.prevent
        @drop="onDrop"
        :class="{ dragging: isDragging }">

        <div class="upload-control" v-show="images.length">
            <label for="file">Select a file</label>
            <button @click="upload">Upload</button>
        </div>

<!--    hide drop your files if image is opened - dropped-->
        <div v-show="!images.length">
            <i class="fas fa-cloud-upload-alt"></i>
            <p>Drop Your files here</p>
            <p>OR</p>
            <div class="file-input">
                <label for="file">Select a file</label>
                <input type="file" id="file" @change="onInputChange" multiple>
            </div>
        </div>

        <div class="images-preview" v-show="images.length">
            <div class="img-wrapper" v-for="(image, index) in images" :key="index">
                <img :src="image" :alt="'image ' + index " >
                <div class="details">
                    <span class="name" v-text="files[index].name"></span>
                    <span class="size" v-text="getFileSize(files[index].size)"></span>
                </div>
            </div>
        </div>

    </div>


</template>

<script>
    export default {
        data: () => ({
            isDragging: false,
            counter: 0,
            files: [],
            images: []
        }),
        methods: {
            onDragEnter(e){
                e.preventDefault();

                this.counter++;
                this.isDragging = true;
            },
            onDragLeave(e){
                e.preventDefault();

                this.counter--;
                if (this.counter <= 0)
                this.isDragging = false;
            },
            onInputChange(e){
                const files = e.target.files;

                // add image open files. Files is not array, we need to create it
                Array.from(files).forEach(file => this.addImage(file));
            },
            onDrop(e){
                e.preventDefault();
                e.stopPropagation();

                this.isDragging = false;
                const files = e.dataTransfer.files;

                // add image from droped files. Files is not array, we need to create it
                Array.from(files).forEach(file => this.addImage(file));
            },
            addImage(file) {
                //check if file is an image
                if (!file.type.match('image.*')){
                    // return error with file name using toastr
                    this.$toastr.e(file.name + ' is not an image!');
                    return;
                }

                this.files.push(file);

                //convert this file to Base64 format so we can place it in image src
                const reader = new FileReader ();

                reader.onload = (e) => this.images.push(e.target.result);
                reader.readAsDataURL(file);
            },
            upload(){
                const formData = new FormData();

                this.files.forEach(file => {
                    formData.append('images[]', file, file.name);
                });

                axios.post('/images-upload', formData)
                    .then(response => {
                        // Toastr vue package, imported (s - sucess, e - error)
                        this.$toastr.s('All Images has been uploaded successfully');
                        this.images = [];
                        this.files = [];
                        setInterval(function(){ location.reload(); }, 5000);
                    });
            },
            getFileSize(size){
                const fSExt = ['Bytes', 'KB', 'MB', 'GB'];
                let i = 0;

                while(size > 900){
                    size /= 1024;
                    i++;
                }
                return (Math.round(size * 100) / 100) + ' ' + fSExt[i];
            }
        }
    }
</script>

<style lang="scss">
</style>
