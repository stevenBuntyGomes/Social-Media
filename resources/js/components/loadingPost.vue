<template>

</template>
<script>
export default {
    data: () =>{
        return {
            post: [],
        }
    },

    created(){
        this.post = this.$route.params.thisPost;
    },

    mounted(){
        this.$router.push({name: 'postView', params: {thisPost: this.post}});
    }
}
</script>
<style scoped>

</style>
