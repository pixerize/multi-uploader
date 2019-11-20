<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                        <h3>Multi-Image Uploader Vue + Laravel </h3>
                    </div>
                    <div class="card-body">
                        <image-uploader></image-uploader>
                    </div>
                    <div class="card-body">
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import ImageUploader from './ImageUploader.vue';

    export default {
        data: () => ({
            fileNames: ['file1', 'file2', 'file3']
        }),
        mounted() {
            console.log('Component mounted.')
        },
        components: {
            ImageUploader
        }
    }
</script>

<style lang="sass">
    @import '~vue-toastr/src/vue-toastr.scss'

</style>
