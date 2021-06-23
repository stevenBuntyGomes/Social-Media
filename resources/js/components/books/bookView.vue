<template>

    <div class = "flex flex-col items-center py-4">
        <myBook :book="book"></myBook>
    </div>

</template>
<script>
import { mapGetters } from 'vuex';
import myBook from './mybook.vue';

export default {
    data: () => {
        return {
            options: false,
            // editBook: false,
            deleteBook: false,
            comments: false,

            commentBody: '',
            book: [],
        }
    },


    created(){
        this.book = this.$route.params.thisBook;
    },

    mounted(){
        console.log(this.$route.path);
    },

    components: {
        myBook,
    },

    // props: [
    //     'book'
    // ],

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
