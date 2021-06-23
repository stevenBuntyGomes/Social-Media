<template>

    <div class = "flex flex-col items-center" v-if = "profileStatus.user == 'success' && user">
        <div class = "relative h-64 relative_part_responsive">
            <div class="w-100 h-64 overflow-hidden z-10">
                <!-- image -->
                <div class = "cover_img overflow-hidden">
                    <UploadableImage
                    classes = "object-cover w-full h-64"
                    alt = "user background image"
                    image-width= "1200"
                    image-height = "500"
                    location = "cover"
                    :user-image = "user.data.attributes.cover_image"></UploadableImage>
                </div>
                <!-- <p>{{ user.data.attributes.name }}</p> -->


            </div>
            <!-- profile image staarts -->
                <div class="responsive_image absolute flex items-center bottom-0 left-0 -mb-8 ml-12 z-20">
                    <div class="w-32 img_responsive">
                        <UploadableImage
                        classes = "object-cover w-32 h-32 border-4 border-gray-200 rounded-full shadow-lg"
                        alt = "user profile image"
                        image-width= "700"
                        image-height = "700"
                        location = "profile"
                        :user-image = "user.data.attributes.profile_image"></UploadableImage>

                    </div>
                    <p class = "responsive_profile_name text-2xl text-gray-100 ml-4">{{ user.data.attributes.name }}</p>
                </div>
            <!-- profile image ends -->

            <div class="options_responsive absolute flex items-center bottom-0 right-0 mb-4 mr-12 z-20">
                <button v-if = "friendButtonText && friendButtonText == 'Add Friend'"
                    class = "py-1 px-3 bg-gray-400 rounded options_button"
                    @click = "$store.dispatch('sendFriendRequest', $route.params.userId)">
                    {{ friendButtonText }}
                </button>
                <button v-if = "friendButtonText && friendButtonText == 'Pending Friend Request'"
                    class = "py-1 px-3 bg-gray-400 rounded options_button"
                    @click = "$store.dispatch('sendFriendRequest', $route.params.userId)">
                    {{ friendButtonText }}
                </button>
                <button v-if = "friendButtonText && friendButtonText === 'Accept'"
                    class = "mr-2 py-1 px-3 bg-blue-500 rounded options_button"
                    @click = "$store.dispatch('acceptFriendRequest', $route.params.userId)">
                    Accept
                </button>
                <button v-if = "friendButtonText && friendButtonText == 'Accept'"
                    class = "mr-2 py-1 px-3 bg-gray-400 rounded options_button"
                    @click = "$store.dispatch('ignoreFriendRequest', $route.params.userId)">
                    Ignore
                </button>
                <button v-if = "friendButtonText && friendButtonText == 'options'"
                    class = "mr-2 py-1 px-3 bg-gray-400 rounded options_button"
                    @click = "option = ! option">
                    {{ friendButtonText }}
                </button>
                <!-- absolute path -->
                <div class = "w-6 flex justify-end relative">
                    <div v-if="option && friendButtonText == 'options'" class = "z-50 absolute top-8 bg-white border border-gray-400 shadow-sm">
                        <div class = "">
                            <ul>
                                <li class = "p-3 m-0 border border-gray-400">
                                    <button @click = "$store.dispatch('deleteFriendship', $route.params.userId)">
                                        Unfriend
                                    </button></li>
                            </ul>
                        </div>
                    </div>

                </div>
                <!-- absolute path -->
            </div>
        </div>
        <div class = "px-4 flex items-center border border-grey-400 shadow-sm">
            <div class = "w-1/3">

            </div>
            <div class = "w-1/3 flex justify-center items-center h-fill info_part">
                <router-link v-if = "$route.params.userId == authUser.data.user_id" to="/friends" class = "py-6 px-6 flex h-full items-center icon-color">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-people-fill mr-2" viewBox="0 0 16 16">
                        <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                        <path fill-rule="evenodd" d="M5.216 14A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216z"/>
                        <path d="M4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5z"/>
                    </svg>
                    Friends
                </router-link>
                <router-link :to="'/about/' + $route.params.userId" class = "py-6 px-6 flex h-full items-center icon-color">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-info-circle-fill mr-2" viewBox="0 0 16 16">
                        <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412l-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                    </svg>
                    About
                </router-link>
                <router-link v-if = "$route.params.userId == authUser.data.user_id" to="/updateInfo" class = "py-6 px-6 flex flex-row h-full items-center icon-color">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-gear-wide-connected mr-2" viewBox="0 0 16 16">
                        <path d="M7.068.727c.243-.97 1.62-.97 1.864 0l.071.286a.96.96 0 0 0 1.622.434l.205-.211c.695-.719 1.888-.03 1.613.931l-.08.284a.96.96 0 0 0 1.187 1.187l.283-.081c.96-.275 1.65.918.931 1.613l-.211.205a.96.96 0 0 0 .434 1.622l.286.071c.97.243.97 1.62 0 1.864l-.286.071a.96.96 0 0 0-.434 1.622l.211.205c.719.695.03 1.888-.931 1.613l-.284-.08a.96.96 0 0 0-1.187 1.187l.081.283c.275.96-.918 1.65-1.613.931l-.205-.211a.96.96 0 0 0-1.622.434l-.071.286c-.243.97-1.62.97-1.864 0l-.071-.286a.96.96 0 0 0-1.622-.434l-.205.211c-.695.719-1.888.03-1.613-.931l.08-.284a.96.96 0 0 0-1.186-1.187l-.284.081c-.96.275-1.65-.918-.931-1.613l.211-.205a.96.96 0 0 0-.434-1.622l-.286-.071c-.97-.243-.97-1.62 0-1.864l.286-.071a.96.96 0 0 0 .434-1.622l-.211-.205c-.719-.695-.03-1.888.931-1.613l.284.08a.96.96 0 0 0 1.187-1.186l-.081-.284c-.275-.96.918-1.65 1.613-.931l.205.211a.96.96 0 0 0 1.622-.434l.071-.286zM12.973 8.5H8.25l-2.834 3.779A4.998 4.998 0 0 0 12.973 8.5zm0-1a4.998 4.998 0 0 0-7.557-3.779l2.834 3.78h4.723zM5.048 3.967c-.03.021-.058.043-.087.065l.087-.065zm-.431.355A4.984 4.984 0 0 0 3.002 8c0 1.455.622 2.765 1.615 3.678L7.375 8 4.617 4.322zm.344 7.646l.087.065-.087-.065z"/>
                    </svg>
                    Update Info
                </router-link>
            </div>
            <div class = "w-1/3">

            </div>
        </div>
        <div class = "px-4 flex items-center border border-grey-400 shadow-sm">
            <div class = "w-1/3">

            </div>
            <div class = "w-1/3 flex justify-center items-center h-fill info_part">
                <router-link :to="'/book/' + $route.params.userId" class = "py-6 px-6 flex h-full items-center icon-color">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-book mr-2" viewBox="0 0 16 16">
                        <path d="M1 2.828c.885-.37 2.154-.769 3.388-.893 1.33-.134 2.458.063 3.112.752v9.746c-.935-.53-2.12-.603-3.213-.493-1.18.12-2.37.461-3.287.811V2.828zm7.5-.141c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492V2.687zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783z"/>
                    </svg>
                    Book
                </router-link>
            </div>
            <div class = "w-1/3">

            </div>
        </div>
            <div v-if = "newsPostStatus.newsPostStatus == 'loading'">Loading posts....</div>
            <div v-else-if = "newsPostStatus.newsPostStatus == 'success' && posts.length < 1">No posts found....!</div>
            <Post v-else v-for = "(post, postKey) in posts.data" :key = "postKey" :post="post" @post_key = "removePost"></Post>
    </div>

</template>
<script>
    import Post from '../../components/Post.vue';
    import UploadableImage from '../../components/UploadableImage.vue';
    import { mapGetters } from 'vuex';

    export default {
        // data: () => {
        //     return {
        //         posts: null,
        //         postLoading: true,
        //     }
        // },

        data: () => {
            return {
                option: false,
            }
        },


        components: {
            Post,
            UploadableImage,
        },

        mounted(){

                // dispatching user id and user information
                this.$store.dispatch('fetchUser', this.$route.params.userId);
                this.$store.dispatch('fetchUserPosts', this.$route.params.userId);
        },

        methods: {
            removePost(postKey){
                this.posts.data.splice(postKey, 1);
            }
        },


        computed: {
            ...mapGetters({
                authUser: 'authUser',
                user: 'user',
                posts: 'posts',
                profileStatus: 'profileStatus',
                newsPostStatus: 'newsPostStatus',
                friendButtonText: 'friendButtonText',
            }),
        }
    }
</script>

<style scoped>
    .icon-color{
        color: #1F2937;
    }


    .relative_part_responsive{
        margin-bottom: 100px!important;
    }



    @media (max-width: 575.5px){
       .responsive_image{
            top: 85%;
            left: 50%;
            transform: translate(-50%, -50%);
            margin-left: 0px!important;
            z-index: 50;
            overflow: visible!important;
        }


        .responsive_profile_name{
            position: absolute;
            top: 100%;
            left: 50%;
            transform: translate(-50%, 35%);
            color: #101211;
            margin-left: 0!important;
            z-index: 50;
        }


        .options_responsive{
            margin-right: 0!important;
        }

        .options_button{
            position: absolute;
            right: 0;
            font-size: 10px;
        }

        .profile_image_response{
            width: auto!important;
            height: auto!important;
        }

        .info_part{
            font-size: 11px;
        }
    }

    @media (min-width:576px) and (max-width:767.9px) {
        .responsive_image{
            top: 85%;
            left: 50%;
            transform: translate(-50%, -50%);
            margin-left: 0px!important;
            z-index: 50;
            overflow: visible!important;
        }

        .responsive_profile_name{
            position: absolute;
            top: 100%;
            left: 50%;
            transform: translate(-50%, 35%);
            color: #101211;
            margin-left: 0!important;
            z-index: 50;
        }

        .options_responsive{
            margin-right: 0!important;
        }

        .options_button{
            position: absolute;
            right: 0;
            font-size: 10px;
        }

        .info_part{
            font-size: 14px;
        }
    }


    @media (min-width:768px) and (max-width:991px) {

    }
</style>
