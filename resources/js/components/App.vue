<template>
        <div v-if = "authUser" class = "flex flex-col flex-1 h-screen overflow-y-hidden">
            <Nav></Nav>
                <div class = "flex overflow-y-hidden flex-1">
                    <Sidebar></Sidebar>

                    <div class = "w-2/3 overflow-x-hidden">

                         <!-- <Newsfeed></Newsfeed>
                        <Show></Show> -->
                        <router-view :key = "$route.fullPath"></router-view>
                    </div>

                </div>

        </div>
</template>

<script>

    import {mapGetters} from 'vuex';
    import Nav from './Nav.vue'
    import Sidebar from './Sidebar.vue'
    // import Newsfeed from '../views/Newsfeed.vue'
    // import Show from '../views/Users/Show.vue'

    export default {
        name: "App",
        self: this,

        components: {
            Nav,
            Sidebar,
            // Newsfeed,
            // Show,
        },

        mounted() {
            this.$store.dispatch('fetchAuthUser');
        },

        created() {
            this.$store.dispatch('setPageTitle', this.$route.meta.title);
        },


        computed: {
            ...mapGetters({
                authUser: 'authUser'
            })
        },


        watch: {
            $route(to, from) {
                this.$store.dispatch('setPageTitle', to.meta.title);
            }
        },




    }
</script>

<style scoped>

</style>
