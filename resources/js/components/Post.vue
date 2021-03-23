<template>
    <div class = "bg-white rounded shadow w-2/3 mt-6 overflow-hidden">
        <div class = "flex flex-col p-4 relative">
            <div class = "flex items-center">
                <div class = "w-8">
                    <img class = "w-8 h-8 object-cover rounded-full"
                    :src="post.data.attributes.posted_by.data.attributes.profile_image.data.attributes.path" alt="">
                </div>
                <div class = "ml-3">
                    <div class = "text-sm font-bold">{{ post.data.attributes.posted_by.data.attributes.name }}</div>
                    <div class= "text-sm text-gray-600">{{ post.data.attributes.posted_at }}</div>
                </div>
            </div>
            <div class = "mt-4">
                <p>{{ post.data.attributes.body }}</p>
            </div>
            <div class = "options absolute right-5">
                <button v-if = "post.data.attributes.posted_by.data.user_id == authUser.data.user_id" @click = "options = !options">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots" viewBox="0 0 16 16">
                        <path d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z"/>
                    </svg>
                </button>
                <!-- hidden absolute path starts -->
                <div v-if="options" class = "z-50 absolute top-6 right-0 bg-white border border-gray-400 shadow-sm">
                    <div class = "">
                        <ul>
                            <li class = "p-3 m-0 border border-gray-400">
                                <button @click = "editPost = !editPost; zoneStart()">
                                    Edit Post
                                </button></li>
                                <li class = "p-3 m-0 border border-gray-400">
                                <button @click = "deletePost = !deletePost">
                                    Delete Post
                                </button></li>
                                <Modal
                                    v-model="editPost"
                                    title="Edit Post"
                                    @on-ok="postHandler"
                                    @on-cancel="cancel">

                                    <div class="flex justify-between items-center">
                                        <div>
                                            <div class = 'w-8'>
                                                <img class = "w-8 h-8 object-cover rounded-full"
                                                :src="post.data.attributes.posted_by.data.attributes.profile_image.data.attributes.path" alt="">
                                            </div>
                                        </div>
                                        <div class = "flex-1 flex ml-3 mr-3">
                                            <input v-model = "postMessage" type="text" name = "body" class = "w-full pl-4 h-8 bg-gray-200 rounded-full focus:outline-none focus:shadow-outline text-sm" placeholder = "Add a post">
                                            <!-- <transition name = "fade">
                                                <button v-if = "postMessage"
                                                @click = "postHandler"
                                                class = "bg-gray-200 ml-2 px-3 py-1 rounded-full">
                                                Post
                                                </button>
                                            </transition> -->
                                        </div>
                                        <div>
                                            <button
                                                ref = "postEditImage"
                                                type = "button"
                                                class = "myDzone dz-clickable flex justify-center items-center rounded-full w-10 bg-gray-200">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="dz-clickable fill-current w-5 h-5"><path d="M21.8 4H2.2c-.2 0-.3.2-.3.3v15.3c0 .3.1.4.3.4h19.6c.2 0 .3-.1.3-.3V4.3c0-.1-.1-.3-.3-.3zm-1.6 13.4l-4.4-4.6c0-.1-.1-.1-.2 0l-3.1 2.7-3.9-4.8h-.1s-.1 0-.1.1L3.8 17V6h16.4v11.4zm-4.9-6.8c.9 0 1.6-.7 1.6-1.6 0-.9-.7-1.6-1.6-1.6-.9 0-1.6.7-1.6 1.6.1.9.8 1.6 1.6 1.6z"/></svg>
                                            </button>

                                        </div>
                                    </div>
                                    <div class = "my-5">
                                            <p>Clicking image icon will delete previous image of the post if there is any</p>
                                    </div>
                                    <div class="dropzone-edit-previews">
                                        <div id = "dz-edit-template" class = "hidden">
                                            <div class = "dz-preview dz-file-preview mt-4">
                                                <div class = "dz-details">
                                                    <img data-dz-thumbnail class = "w-32 h-32">
                                                    <button data-dz-remove class = "text-xs">Remove</button>
                                                </div>
                                                <div class="dz-progress">
                                                    <span class = "dz-upload" data-dz-upload></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </Modal>
                                <!-- delete post modal starts -->
                                <Modal
                                v-model="deletePost"
                                ok-text = "yes"
                                cancel-text = "no"
                                @on-ok = "deletePostFunction"
                                @on-cancel = "no"
                                title="Delete Post">
                                    <div class = "bg-red-100 text-red-700 px-3 py-2">
                                        Do you Want to delete this post!
                                    </div>
                                </Modal>
                                <!-- delete post modal ends -->
                        </ul>
                    </div>
                </div>
                <!-- hidden absolute path ends -->
            </div>
        </div>
        <div class = "w-full" v-if = "post.data.attributes.image.length">
            <img class = "w-full" :src="post.data.attributes.image" alt="">
        </div>
        <div class = "px-4 flex justify-between text-gray-700 text-sm pt-3">
            <div class = "flex">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="fill-current w-5 h-5"><path d="M20.8 15.6c.4-.5.6-1.1.6-1.7 0-.6-.3-1.1-.5-1.4.3-.7.4-1.7-.5-2.6-.7-.6-1.8-.9-3.4-.8-1.1.1-2 .3-2.1.3-.2 0-.4.1-.7.1 0-.3 0-.9.5-2.4.6-1.8.6-3.1-.1-4.1-.7-1-1.8-1-2.1-1-.3 0-.6.1-.8.4-.5.5-.4 1.5-.4 2-.4 1.5-2 5.1-3.3 6.1l-.1.1c-.4.4-.6.8-.8 1.2-.2-.1-.5-.2-.8-.2H3.7c-1 0-1.7.8-1.7 1.7v6.8c0 1 .8 1.7 1.7 1.7h2.5c.4 0 .7-.1 1-.3l1 .1c.2 0 2.8.4 5.6.3.5 0 1 .1 1.4.1.7 0 1.4-.1 1.9-.2 1.3-.3 2.2-.8 2.6-1.6.3-.6.3-1.2.3-1.6.8-.8 1-1.6.9-2.2.1-.3 0-.6-.1-.8zM3.7 20.7c-.3 0-.6-.3-.6-.6v-6.8c0-.3.3-.6.6-.6h2.5c.3 0 .6.3.6.6v6.8c0 .3-.3.6-.6.6H3.7zm16.1-5.6c-.2.2-.2.5-.1.7 0 0 .2.3.2.7 0 .5-.2 1-.8 1.4-.2.2-.3.4-.2.6 0 0 .2.6-.1 1.1-.3.5-.9.9-1.8 1.1-.8.2-1.8.2-3 .1h-.1c-2.7.1-5.4-.3-5.4-.3H8v-7.2c0-.2 0-.4-.1-.5.1-.3.3-.9.8-1.4 1.9-1.5 3.7-6.5 3.8-6.7v-.3c-.1-.5 0-1 .1-1.2.2 0 .8.1 1.2.6.4.6.4 1.6-.1 3-.7 2.1-.7 3.2-.2 3.7.3.2.6.3.9.2.3-.1.5-.1.7-.1h.1c1.3-.3 3.6-.5 4.4.3.7.6.2 1.4.1 1.5-.2.2-.1.5.1.7 0 0 .4.4.5 1 0 .3-.2.6-.5 1z"/></svg>
                <p class = "pl-2">
                    {{ post.data.attributes.likes.like_count }} likes
                </p>
            </div>
            <div>
                <p>{{ post.data.attributes.comments.comment_count }} comments</p>
            </div>
        </div>
        <div class = "flex justify-between border-1 border-gray-400 m-4">
            <button
            class = "flex justify-center py-2 rounded-lg text-sm text-gray-700 w-full focus-outline-none"
            :class = "post.data.attributes.likes.user_likes_post ? 'bg-blue-600 text-white' : 'text-gray-700'"
            @click = "$store.dispatch('likePost', {postId: post.data.post_id, postKey: $vnode.key })">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="fill-current w-5 h-5"><path d="M20.8 15.6c.4-.5.6-1.1.6-1.7 0-.6-.3-1.1-.5-1.4.3-.7.4-1.7-.5-2.6-.7-.6-1.8-.9-3.4-.8-1.1.1-2 .3-2.1.3-.2 0-.4.1-.7.1 0-.3 0-.9.5-2.4.6-1.8.6-3.1-.1-4.1-.7-1-1.8-1-2.1-1-.3 0-.6.1-.8.4-.5.5-.4 1.5-.4 2-.4 1.5-2 5.1-3.3 6.1l-.1.1c-.4.4-.6.8-.8 1.2-.2-.1-.5-.2-.8-.2H3.7c-1 0-1.7.8-1.7 1.7v6.8c0 1 .8 1.7 1.7 1.7h2.5c.4 0 .7-.1 1-.3l1 .1c.2 0 2.8.4 5.6.3.5 0 1 .1 1.4.1.7 0 1.4-.1 1.9-.2 1.3-.3 2.2-.8 2.6-1.6.3-.6.3-1.2.3-1.6.8-.8 1-1.6.9-2.2.1-.3 0-.6-.1-.8zM3.7 20.7c-.3 0-.6-.3-.6-.6v-6.8c0-.3.3-.6.6-.6h2.5c.3 0 .6.3.6.6v6.8c0 .3-.3.6-.6.6H3.7zm16.1-5.6c-.2.2-.2.5-.1.7 0 0 .2.3.2.7 0 .5-.2 1-.8 1.4-.2.2-.3.4-.2.6 0 0 .2.6-.1 1.1-.3.5-.9.9-1.8 1.1-.8.2-1.8.2-3 .1h-.1c-2.7.1-5.4-.3-5.4-.3H8v-7.2c0-.2 0-.4-.1-.5.1-.3.3-.9.8-1.4 1.9-1.5 3.7-6.5 3.8-6.7v-.3c-.1-.5 0-1 .1-1.2.2 0 .8.1 1.2.6.4.6.4 1.6-.1 3-.7 2.1-.7 3.2-.2 3.7.3.2.6.3.9.2.3-.1.5-.1.7-.1h.1c1.3-.3 3.6-.5 4.4.3.7.6.2 1.4.1 1.5-.2.2-.1.5.1.7 0 0 .4.4.5 1 0 .3-.2.6-.5 1z"/></svg>
                <p class = "ml-2">Like</p>
            </button>
            <button class = "flex justify-center py-2 rounded-lg text-sm text-gray-700 w-full focus-outline-none"
                @click = "comments = ! comments">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="fill-current w-5 h-5"><path d="M20.3 2H3.7C2 2 .6 3.4.6 5.2v10.1c0 1.7 1.4 3.1 3.1 3.1V23l6.6-4.6h9.9c1.7 0 3.1-1.4 3.1-3.1V5.2c.1-1.8-1.3-3.2-3-3.2zm1.8 13.3c0 1-.8 1.8-1.8 1.8H9.9L5 20.4V17H3.7c-1 0-1.8-.8-1.8-1.8v-10c0-1 .8-1.8 1.8-1.8h16.5c1 0 1.8.8 1.8 1.8v10.1zM6.7 6.7h10.6V8H6.7V6.7zm0 2.9h10.6v1.3H6.7V9.6zm0 2.8h10.6v1.3H6.7v-1.3z"/></svg>
                <p class = "ml-2">Comment</p>
            </button>
        </div>
        <div v-if="comments" class = "border-t border-gray-400 p-4 pt-2">
            <div class="flex ">
                <input v-model = "commentBody"
                type="text"
                name = "comment"
                class = "w-full pl-4 h-8 bg-gray-200 rounded-lg focus:outline-none"
                placeholder = "Write your comment">
                <button v-if = "commentBody"
                    class = "bg-gray-200 ml-2 px-2 py-1 rounded-lg focus:outline-none"
                    @click = "$store.dispatch('commentPost', {body: commentBody, postId: post.data.post_id, postKey: $vnode.key}); commentBody = ''">
                    Post
                </button>
            </div>
            <!-- latest code change update -->
            <div class="flex my-4 items-center" v-for = "comment in post.data.attributes.comments.data">
                <div class = "w-8">
                    <img
                    :src="comment.data.attributes.commented_by.data.attributes.profile_image.data.attributes.path" alt="">
                </div>
                <div class = "ml-4 flex-1">
                    <div class = "bg-gray-200 rounded-lg p-2 text-sm">
                        <a class = "font-bold text-blue-700" :href="'/users/' + comment.data.attributes.commented_by.data.user_id">
                            {{ comment.data.attributes.commented_by.data.attributes.name }}
                        </a>
                        <p class = "inline">
                            {{ comment.data.attributes.body }}
                        </p>
                    </div>
                    <div class = "text-xs pl-2">
                        <p>{{ comment.data.attributes.commented_at }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import _ from 'lodash'
import {mapGetters} from 'vuex'
import Dropzone from 'dropzone'


export default {
    name: 'Post',

    data: () => {
        return {
            options: false,
            comments: false,
            commentBody: '',
            editPost: false,
            deletePost: false,
            dropEditZone: null,
            postMessage: '',
            imageFile: false,
        }
    },

    props: [
        'post'
    ],

    mounted(){
        // this.postMessage = this.post.data.attributes.body;

    },


    computed: {
        settings(){
            return {
                paramName: 'image',
                url: '/api/posts/edit',
                acceptedFiles: 'image/*',
                clickable: '.dz-clickable', //it will become clickable
                autoProcessQueue: false,
                previewsContainer: '.dropzone-edit-previews',
                previewTemplate: document.querySelector('#dz-edit-template').innerHTML,
                maxFiles: 1,
                params: {
                    'width': 1000,
                    'height': 1000,
                },
                headers: {
                    'X-CSRF-TOKEN': document.head.querySelector('meta[name=csrf-token]').content,
                },
                sending: (file, xhr, formData) => {
                    formData.append('body', this.postMessage);
                    formData.append('post_id', this.post.data.post_id);
                    formData.append('postKey', this.$vnode.key);
                },
                success:(event, response) =>{
                    this.dropEditZone.removeAllFiles();
                    this.$store.commit('updatePost', {
                        response: response,
                        postKey: this.$vnode.key,
                    });
                },
                maxfilesexceeded: file => {
                    this.dropEditZone.removeAllFiles();
                    this.dropEditZone.addFile(file);
                }
            };
        },

        ...mapGetters({
            authUser: 'authUser',
        }),



        // postMessage: {
        //     get(){
        //         return this.$store.getters.postMessage;
        //     },
        //     // set(postMessage){
        //     //     this.$store.dispatch('fetchPostMessage', postMessage);
        //     // },

        //     set: _.debounce(function(postMessage){
        //         this.$store.dispatch('fetchPostMessage', postMessage);
        //     }, 500),
        // }
    },


    methods: {
            zoneStart(){
                if(this.editPost == true){
                    this.dropEditZone = new Dropzone(this.$refs.postEditImage, this.settings);
                    this.postMessage = this.post.data.attributes.body;
                    this.$store.dispatch('fetchPostMessage', this.postMessage);
                    this.$store.getters.postMessage;
                }
            },

            postHandler(){
                if(this.dropEditZone.getAcceptedFiles().length){
                    this.dropEditZone.processQueue();
                }else{
                    this.$store.dispatch('updatePostMessage', {
                        body: this.postMessage,
                        post_id: this.post.data.post_id,
                        postKey: this.$vnode.key,
                    });
                }

                this.$store.commit('updateMessage', '');
            },
            cancel () {
                this.$Message.info('Clicked cancel');
                this.postMessage = '';
                this.$store.dispatch('fetchPostMessage', this.postMessage);
                this.$store.getters.postMessage;
            },



            // deletePost message strts

            deletePostFunction() {
                this.$store.dispatch('deleteSinglePosts', {
                    post_id: this.post.data.post_id,
                    postKey: this.$vnode.key,
                });
                this.$emit('post_key', this.$vnode.key);
                this.options = false;
            },

            no () {
                this.$Message.info('Clicked no');
            }

            // deletePost message ends
    },



}
</script>
<style scoped>

</style>
