<template>
    <div class = "flex flex-col items-center py-4">
        <div class = "bg-white rounded  shadow w-1/3 mt-6 p-4">
            <div class = "flex justify-start items-center">
                    <div class = 'w-8'>
                        <img class = "w-8 h-8 object-cover rounded-full"
                        :src="authUser.data.attributes.profile_image.data.attributes.path" alt="">
                    </div>
                <div class = "ml-5">
                    <Button>
                        <router-link  outer-link to = "/createBook" class = "flex justify-between items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle mr-2" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                            </svg>
                            Create A new Book
                        </router-link>
                    </Button>
                </div>
            </div>
        </div>
        <myBook v-for = "(book, bookKey) in allBooks.data" :key = "bookKey" :book="book"></myBook>
    </div>
</template>
<script>
import myBook from './mybook.vue';

import { mapGetters } from 'vuex';

export default {
    data:() => {
        return {

        }
    },

    components: {
        myBook,
    },


    mounted(){
        this.$store.dispatch('fetchBookFeed');
    },

    methods: {

    },


    computed: {
        ...mapGetters({
                authUser: 'authUser',
                allBooks: 'allBooks',
            }),
    },


}
</script>
<style scoped>

</style>
