<template>
        <div v-if = "authUser" class = "flex flex-col flex-1 h-screen overflow-y-hidden app_container">
            <Nav></Nav>
                <div class = "flex overflow-y-hidden flex-1">
                    <Sidebar v-bind:class = "[(isSliderActive) ? 'slider_responsive' : 'slider_af_responsive']"></Sidebar>
                    <button @click = "toggleClick" v-bind:class = "[(isSliderButtonActive) ? 'slider_responsive_button' : 'slider_af_responsive_button']">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-right" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M1 11.5a.5.5 0 0 0 .5.5h11.793l-3.147 3.146a.5.5 0 0 0 .708.708l4-4a.5.5 0 0 0 0-.708l-4-4a.5.5 0 0 0-.708.708L13.293 11H1.5a.5.5 0 0 0-.5.5zm14-7a.5.5 0 0 1-.5.5H2.707l3.147 3.146a.5.5 0 1 1-.708.708l-4-4a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 4H14.5a.5.5 0 0 1 .5.5z"/>
                        </svg>
                    </button>

                    <div class = "timeline w-2/3 sm:w-full  overflow-x-hidden">

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
        data: () => {
            return {
                mobileView: false,
                isSliderActive: true,
                isSliderButtonActive: true,
            }
        },

        components: {
            Nav,
            Sidebar,
            // Newsfeed,
            // Show,
        },

        mounted() {
            this.$store.dispatch('fetchAuthUser');
            // window.addEventListener('resize', this.$store.dispatch('fetchWindowWidth'));
        },

        created() {
            this.$store.dispatch('setPageTitle', this.$route.meta.title);

        },


        methods: {
            toggleClick(){
                // var switcher = this.$refs.slider_responsive;
                // var clicks = this.$refs.slider_responsive_button;
                // if(switcher.style.left == "-100px" && clicks.style.left == "0px"){
                //     switcher.style.left == "0px";
                //     clicks.style.left == "34%";
                // }else{
                //     switcher.style.left == "-100px";
                //     clicks.style.left == "0px";
                // }
                this.isSliderActive = !this.isSliderActive;
                this.isSliderButtonActive = !this.isSliderButtonActive;
                //  alert("Hello! I am an alert box!!");
            }
        },

        computed: {
            ...mapGetters({
                authUser: 'authUser',
                getWindowWidth: 'getWindowWidth',
            })
        },


        watch: {
            $route(to, from) {
                this.$store.dispatch('setPageTitle', to.meta.title);

            },


        },




    }
</script>

<style scoped>
    @media (max-width: 575.5px) {

        .app_container{
            width: 100%!important;
        }

        .timeline{
            width: 100%!important;
        }

        .slider_responsive{
            position: absolute;
            left: -34%;
            height: 100%;
            z-index: 100;
            height: 100%;
            transition: all linear 0.3s;
        }

        .slider_af_responsive{
            position: absolute;
            left: 0px;
            height: 100%;
            width: 70%;
            z-index: 100;
            transition: all linear 0.3s;
        }

        .slider_responsive_button{
            position: absolute;
            padding: 5px;
            left: 0;
            transition: all linear 0.3s;
            background: white;
            padding: 10px;
            z-index: 100;
        }

        .slider_af_responsive_button{
            position: absolute;
            padding: 5px;
            left: 70%;
            transition: all linear 0.3s;
            background: white;
            padding: 10px;
            z-index: 100;
        }
    }


    @media (min-width:576px) and (max-width:767px){
        .app_container{
            width: 100%!important;
        }

        .timeline{
            width: 100%!important;
        }

        .slider_responsive{
            position: absolute;
            left: -34%;
            height: 100%;
            z-index: 100;
            transition: all linear 0.3s;
        }

        .slider_af_responsive{
            position: absolute;
            left: 0px;
            height: 100%;
            width: 70%;
            z-index: 100;
            transition: all linear 0.3s;
        }


        .slider_responsive_button{
            position: absolute;
            padding: 5px;
            left: 0;
            transition: all linear 0.3s;
            background: white;
            padding: 10px;
            z-index: 100;
        }

        .slider_af_responsive_button{
            position: absolute;
            padding: 5px;
            left: 70%;
            transition: all linear 0.3s;
            background: white;
            padding: 10px;
            z-index: 100;
        }
    }

    @media (min-width:768px){
        .slider_responsive_button{
            display: none;
        }

        .slider_af_responsive_button{
            display: none;
        }
    }



    @media (min-width:768px) and (max-width:991px) {
        
    }
</style>
