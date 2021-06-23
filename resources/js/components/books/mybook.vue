<template>
    <div class = "bg-white rounded shadow w-1/3 mt-6 overflow-hidden">
        <div class = "flex flex-col p-4 relative">
            <div class = "flex items-center">
                <div class = "w-8">
                    <img class = "w-8 h-8 object-cover rounded-full"
                    :src="book.data.attributes.posted_by.data.attributes.profile_image.data.attributes.path" alt="">
                </div>
                <div class = "ml-3">
                    <div class = "text-sm font-bold">{{ book.data.attributes.posted_by.data.attributes.name }}</div>
                    <div class= "text-sm text-gray-600">{{ book.data.attributes.posted_at }}</div>
                </div>
            </div>
            <div v-if = "$route.params.userId == authUser.data.user_id" class = "options absolute right-5">
                <button @click = "options = !options">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots" viewBox="0 0 16 16">
                        <path d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z"/>
                    </svg>
                </button>
                <div v-if="options" class = "z-50 absolute top-6 right-0 bg-white border border-gray-400 shadow-sm">
                    <div class = "">
                        <ul>
                            <li class = "p-3 m-0 border border-gray-400">
                                <button @click = "EditBook">
                                    Edit Book
                                </button>
                            </li>
                            <li class = "p-3 m-0 border border-gray-400">
                                <button @click = "deleteBook = !deleteBook">
                                    Delete Book
                                </button>
                            </li>

                        </ul>
                        <Modal
                                v-model="deleteBook"
                                title="Delete Book"
                                :mask-closable = 'false'
                                :closable = 'false'>
                                <div slot = "footer">
                                    <button type = "default" @click = "deleteBook=false">Close</button>
                                    <button type = "primary" @click = "delBookDb">Add Image</button>
                                </div>
                        </Modal>
                    </div>
                </div>
            </div>
        </div>
        <div class = "w-full">
            <img class = "w-full" :src="book.data.attributes.book_title_image" alt="" @click = "goToBook">
        </div>
        <div class = "px-4 flex justify-between text-gray-700 text-sm pt-3">
            <div class = "flex">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart-fill mt-1 text-red-500" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>
                </svg>
                <p class = "pl-2">
                    {{ book.data.attributes.loves.love_count }}
                </p>
            </div>
            <div>
                <p>
                    {{ book.data.attributes.comments.comment_count }} Comments
                </p>
            </div>
        </div>
        <div class = "flex justify-between border-1 border-gray-400 m-4">
            <button
            class = "flex justify-center py-2 rounded-lg text-sm text-gray-700 w-full focus-outline-none"
            :class = "book.data.attributes.loves.user_love_book ? 'bg-red-500 bg-red-500 text-white' : 'text-gray-700'"
            @click = "$store.dispatch('loveBook', { bookId: book.data.book_id, bookKey: $vnode.key })"
            >
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                    <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/>
                </svg>
                <p class = "ml-2"></p>
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
                    @click = "$store.dispatch('commentBook', {body: commentBody, bookId: book.data.book_id, bookKey: $vnode.key }); commentBody = ''">
                    Post
                </button>
            </div>
            <!-- latest code change update -->
            <div class="flex my-4 items-center" v-for = "comment in book.data.attributes.comments.data">
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

import { mapGetters } from 'vuex';


export default {
    data:() =>{
        return {
            options: false,
            // editBook: false,
            deleteBook: false,
            comments: false,

            commentBody: '',
        }
    },

    props: [
        'book'
    ],

    mounted(){

    },


    methods: {
        zoneStart(){

        },

        delBookDb(){

        },


        goToBook(){
            // this.$router.push({path: '/bookView'});
            window.location.href = "/api/mybook/pages/" + this.book.data.book_id; // this works because / sign is used before string api
            // window.location.href = "api/mybook/pages"; this will not work
            // this.$store.dispatch('myBookView');
        },


        EditBook(){
            this.$store.dispatch('fetchEditBook', {
                editBook: this.book,
                router: this.$router,
                bookKey: this.$vnode.key,
            });

        }
    },


    computed: {
            ...mapGetters({
                authUser: 'authUser',
            }),
        },
}
</script>
<style scoped>

</style>
