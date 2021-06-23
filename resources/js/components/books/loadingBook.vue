<template>

</template>
<script>
export default {
    data: () =>{
        return {
            book: [],
        }
    },

    created(){
        this.book = this.$route.params.thisBook;
    },

    mounted(){
        this.$router.push({name: 'bookView', params: {thisBook: this.book}});
    }
}
</script>
<style scoped>

</style>
