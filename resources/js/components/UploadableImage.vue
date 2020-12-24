<template>
    <div>
        <img
        :class = "classes"
        :src="userImage.data.attributes.path"
        :alt="alt"
        ref = "userImage">
    </div>
</template>

<script>

import Dropzone from 'dropzone';
import {mapGetters} from 'vuex'


export default {

    name: 'UploadableImage',

    props: [
        'imageWidth',
        'imageHeight',
        'location',
        'userImage',
        'classes',
        'alt',
    ],

    data: () => {
        return {
            dropzone: null,
            uploadedImage: null,
        }
    },

    mounted() {
        if(this.authUser.data.user_id.toString() === this.$route.params.userId){
            this.dropzone = new Dropzone(this.$refs.userImage, this.settings);
        }
    },


    computed: {
        settings(){
            return {
                paramName: 'image',
                url: '/api/user-images',
                acceptedFiles: 'image/*',
                params: {
                    'width': this.imageWidth,
                    'height': this.imageHeight,
                    'location': this.location,
                },
                headers: {
                    'X-CSRF-TOKEN': document.head.querySelector('meta[name=csrf-token]').content,
                },

                success:(e, response) => {
                    // this.uploadedImage = response;
                    this.$store.dispatch('fetchAuthUser');
                    this.$store.dispatch('fetchUser', this.$route.params.userId);
                    this.$store.dispatch('fetchUserPosts', this.$route.params.userId);
                }
            };
        },

        // imageObject() {
        //     return this.uploadedImage || this.userImage;
        // }

        ...mapGetters({
            authUser: 'authUser',
        })
    }
}
</script>


<style scoped>

</style>
