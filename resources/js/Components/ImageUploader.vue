<template>
    <file-pond
        name="test"
        ref="pond"
        label-idle="Drop files here..."
        v-bind:allow-multiple="true"
        accepted-file-types="image/jpeg, image/png"
        server="/api/photo"
        v-bind:files="myFiles"
        v-on:init="handleFilePondInit"
    />
</template>

<script>
// Import Vue FilePond
import vueFilePond from "vue-filepond";

// Import FilePond styles
import "filepond/dist/filepond.min.css";

// Import FilePond plugins
// Please note that you need to install these plugins separately

// Import image preview plugin styles
import "filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css";

// Import image preview and file type validation plugins
import FilePondPluginFileValidateType from "filepond-plugin-file-validate-type";
import FilePondPluginImagePreview from "filepond-plugin-image-preview";

// Create component
const FilePond = vueFilePond(
    FilePondPluginFileValidateType,
    FilePondPluginImagePreview
);

export default {
    name: "ImageUploader",
    data() {
        return {
            myFiles: ['https://cdn.pixabay.com/photo/2015/04/23/22/00/tree-736885__480.jpg']
        }
    },
    methods: {
        handleFilePondInit: function () {
            console.log("FilePond has initialized");

            // FilePond instance methods are available on `this.$refs.pond`
        },
    },
    components: {
        FilePond,
    },
}
</script>

<style scoped>

</style>
