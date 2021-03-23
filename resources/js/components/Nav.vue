<template>
    <div class = "bg-white px-4 h-12 flex items-center border-b border-gray-400 shadow-sm fixed top-0 w-full relative">
        <div class = "w-1/3 nav_part_one_responsive">
            <div class = "flex">
                <router-link to="/">
                    <svg class="fill-current w-8 h-8" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M23 12.1c0-6.1-4.9-11-11-11S1 6 1 12.1c0 5.5 4 10.1 9.3 10.9v-7.7H7.5v-3.2h2.8V9.7c0-2.8 1.6-4.3 4.2-4.3 1.2 0 2.5.2 2.5.2v2.7h-1.4c-1.4 0-1.8.8-1.8 1.7v2.1h3.1l-.5 3.2h-2.6V23c5.2-.9 9.2-5.4 9.2-10.9z" fill="#1877f2"/></svg>
                </router-link>
                <div class = "ml-2 relative display_keywords">
                    <div class = "absolute text-gray-700 hover:text-red-700">
                        <svg viewBox="0 0 24 24" class="fill-current w-5 h-5 mt-2 ml-2">
                            <path fill-rule="evenodd" d="M20.2 18.1l-1.4 1.3-5.5-5.2 1.4-1.3 5.5 5.2zM7.5 12c-2.7 0-4.9-2.1-4.9-4.6s2.2-4.6 4.9-4.6 4.9 2.1 4.9 4.6S10.2 12 7.5 12zM7.5.8C3.7.8.7 3.7.7 7.3s3.1 6.5 6.8 6.5c3.8 0 6.8-2.9 6.8-6.5S11.3.8 7.5.8z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <input v-model = "keywords" type="text" name = "search" class = "rounded-full w-56 h-8 bg-gray-200 pl-8 focus:outline-none focus:shadow-outline text-sm" placeholder = "Search Facebook">
                </div>
            </div>
        </div>
        <div class = "nav_part_two_responsive w-1/3 flex justify-center items-center h-full">
            <router-link to="/" class = "router_link px-6 border-b-2 border-blue-500 h-full flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="fill-current w-5 h-5"><path d="M22.6 11l-9.9-9c-.4-.4-1.1-.4-1.5 0l-9.9 9c-.3.3-.5.8-.3 1.2.2.5.6.8 1.1.8h1.6v9c0 .4.3.6.6.6h5.4c.4 0 .6-.3.6-.6v-5.5h3.2V22c0 .4.3.6.6.6h5.4c.4 0 .6-.3.6-.6v-9h1.6c.5 0 .9-.3 1.1-.7.3-.5.2-1-.2-1.3zm-2.5-8h-4.3l5 4.5V3.6c0-.3-.3-.6-.7-.6z"/></svg>
            </router-link>
            <router-link :to="'/users/' + authUser.data.user_id" class = "router_link px-6 border-b-2 border-white h-full flex items-center">
                <img class = "w-8 h-8 object-cover rounded-full nav_profile_image"
                :src="authUser.data.attributes.profile_image.data.attributes.path" alt="">
            </router-link>
            <router-link to="/chatApp" class = "router_link px-6 border-b-2 border-white h-full flex items-center relative">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="fill-current w-5 h-5"><path d="M.5 11.6c0 3.4 1.7 6.3 4.3 8.3V24l3.9-2.1c1 .3 2.2.4 3.3.4 6.4 0 11.5-4.8 11.5-10.7C23.5 5.8 18.3 1 12 1S.5 5.8.5 11.6zm10.3-2.9l3 3.1 5.6-3.1-6.3 6.7-2.9-3.1-5.7 3.1 6.3-6.7z"/></svg>
                <div class = "alertMessage" v-if = "getNotification"></div>
            </router-link>
        </div>
        <div class = "nav_part_three_responsive w-1/3 flex justify-end relative">
        <!-- notification button starts -->
            <button @click = "notification = ! notification; eventLight = false" class = "focus-outline-none mr-3 relative">
                <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" fill="currentColor" class="bi bi-bell-fill" viewBox="0 0 16 16">
                    <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2zm.995-14.901a1 1 0 1 0-1.99 0A5.002 5.002 0 0 0 3 6c0 1.098-.5 6-2 7h14c-1.5-1-2-5.902-2-7 0-2.42-1.72-4.44-4.005-4.901z"/>
                </svg>
                <div class = "alertNotification" v-if = "eventLight"></div>
            </button>
            <div v-if="notification" class = "z-50 absolute top-8 bg-white border border-gray-400 shadow-sm">
                <div class = "">
                    <ul>
                        <li v-for = "user in requestedUser" :key = "user.data.user_id" class = "p-3 m-0 border border-gray-400">
                            <div class="contact">
                                    <p v-if = "eventType == 1" class = "font-normal no-underline">Request From</p>
                                    <p v-if = "eventType == 2" class = "font-normal no-underline">Request Accepted by</p>
                                    <p v-if = "eventType == 3" class = "font-normal no-underline">New Post From</p>
                                    <p v-if = "eventType == 4" class = "font-normal no-underline">New Comment From</p>
                                    <p v-if = "eventType == 5" class = "font-normal no-underline">New Like From</p>
                            </div>
                            <div class="avatar">
                                <img class = "chat-image rounded-full" :src="user.data.attributes.profile_image.data.attributes.path" alt="hello">
                            </div>
                            <div class="contact">
                                <router-link :to = "'/users/' + user.data.user_id">
                                    <p class = "name no-underline">{{ user.data.attributes.name }}</p>
                                </router-link>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- notification button ends -->
            <!-- settings button starts -->
            <button @click = "settings = ! settings" class = "focus-outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="fill-current w-5 h-5"><path d="M22.9 10.1c-.1-.1-.2-.2-.3-.2L20 9.5c-.1-.5-.3-.9-.6-1.4.2-.2.4-.6.8-1 .3-.4.6-.8.7-1 .1 0 .1-.2.1-.3 0-.1 0-.2-.1-.3-.3-.5-1.1-1.3-2.4-2.4-.1-.1-.2-.1-.4-.1-.1 0-.3 0-.3.1l-2 1.5c-.4-.2-.8-.4-1.3-.5l-.4-2.6c0-.1-.1-.2-.2-.3-.1-.2-.2-.2-.3-.2h-3.2c-.3 0-.4.1-.5.4-.1.5-.3 1.4-.4 2.7-.5.1-.9.3-1.3.5l-2-1.5c-.1-.1-.3-.2-.4-.2-.2 0-.7.3-1.4 1-.6.7-1.1 1.3-1.4 1.6-.1.1-.1.2-.1.3 0 .1 0 .2.1.3.6.8 1.2 1.4 1.5 2-.2.5-.3.9-.5 1.4l-2.6.4c-.1 0-.2.1-.3.2-.1.1-.1.2-.1.3v3.2c0 .1 0 .2.1.3.1.1.2.2.3.2l2.6.4c.1.5.3.9.6 1.4-.2.2-.4.6-.8 1-.3.4-.6.8-.7 1-.1.1-.1.2-.1.3 0 .1 0 .2.1.3.4.5 1.2 1.3 2.4 2.4.1.1.2.2.4.2.1 0 .3 0 .4-.1l2-1.5c.3.1.7.3 1.2.5l.4 2.6c0 .1.1.2.2.3.1.1.2.1.4.1h3.2c.3 0 .4-.1.5-.4.1-.5.3-1.4.4-2.7.4-.1.9-.3 1.3-.5l2 1.5c.1.1.3.1.4.1.2 0 .7-.3 1.3-1 .7-.7 1.2-1.2 1.4-1.5.1-.1.1-.2.1-.3 0-.1 0-.2-.1-.4-.7-.8-1.2-1.5-1.5-2 .2-.4.4-.8.6-1.3l2.7-.4c.1 0 .2-.1.3-.2.1-.1.1-.2.1-.3v-3.2c-.2-.1-.2-.2-.3-.3zm-8.3 4.5c-.7.7-1.6 1.1-2.6 1.1s-1.9-.4-2.6-1.1c-.7-.7-1.1-1.6-1.1-2.6s.4-1.9 1.1-2.6c.7-.7 1.6-1.1 2.6-1.1s1.9.4 2.6 1.1c.7.7 1.1 1.6 1.1 2.6s-.4 1.9-1.1 2.6z"/></svg>
            </button>
            <div v-if="settings" class = "z-50 absolute top-8 bg-white border border-gray-400 shadow-sm">
                <div class = "">
                    <ul>
                        <li class = "p-3 m-0 border border-gray-400">
                            <button>
                                <router-link to = "/accountSettings" class = "hover:no-underline hover:text-current">Account Settings</router-link>
                            </button></li>
                        <li class = "p-3 m-0 border border-gray-400"><button>Privacy Settings</button></li>
                        <li class = "p-3 m-0 border border-gray-400"><button @click = "logout">Log Out</button></li>
                    </ul>
                </div>
            </div>
            <!-- settings button ends -->

        </div>
    </div>
</template>


<script>
import {mapGetters} from 'vuex';

export default {
    name: 'Nav',
    data: () => {
        return {
            notification: false,
            settings: false,
            notification: false,
            keywords: null,
            requestedUser: [],
            eventType: 0,
            eventLight: false,
        }
    },

    // data: () => {
    //     return {

    //     }
    // },


    mounted(){
            var self = this;
            axios.get('/api/countChatContacts')
            .then(function (response){
                if(response.data > 0){
                    // self.getNotification = true;
                    self.$store.dispatch('notify', true);
                }else{
                    self.$store.dispatch('notify', false);
                }
            })
            .catch(function (error){

            });



        // friend Request channel starts
        Echo.private(`friendRequests.${this.authUser.data.user_id}`) //the pusher problem was created here
            .listen('NewFriendRequest', (e) => {
                this.incomingEventRequest(e.friend_request, 1);
                this.eventLight = true;
                alert(e.friend_request);
            });
            // friend Request channel ends

            // accept Friend Request channel starts
            Echo.private(`acceptFriendRequest.${this.authUser.data.user_id}`) //the pusher problem was created here
            .listen('AcceptFriendRequest', (e) => {
                this.incomingEventAcceptRequest(e.accept_request, 2);
                this.eventLight = true;
                alert(e.accept_request);
            });
            // accept Friend Request channel ends
            // post Notification channel starts
            Echo.private(`postNotifications.${this.authUser.data.user_id}`) //the pusher problem was created here
            .listen('PostNotification', (e) => {
                this.eventLight = true;
                this.incomingEventPostNotification(e.post_user, 3);
                alert(e.post_user);
            });
            // post Notification channel ends

            // post Comment Notification channel starts
            Echo.private(`postCommentNotifications.${this.authUser.data.user_id}`) //the pusher problem was created here
            .listen('CommentNotification', (e) => {
                this.eventLight = true;
                this.incomingEvenCommentNotification(e.post_comment, 4);
                alert(e.post_comment);
            });
            // post Comment Notification channel ends

            // post Like Notification channel starts
            Echo.private(`postLikeNotifications.${this.authUser.data.user_id}`) //the pusher problem was created here
            .listen('LikeNotification', (e) => {
                this.eventLight = true;
                this.incomingEventLike(e.liked_by, 5);
                alert(e.liked_by);
            });
            // post Like Notification channel ends
    },

    methods: {
        // settings(){

        // }
        logout(){
            this.$store.dispatch('AuthLogOut');
        },


        fetch(){
            this.$store.dispatch('fetchUserSearch', {
                keywords: this.keywords,
            });
        },

        // event send request notification
        incomingEventRequest(friend_request, data){
            this.requestedUser.unshift(friend_request);
            this.eventType = data;

        },

        // event accept request notification
        incomingEventAcceptRequest(accept_request, data){
            this.requestedUser.unshift(accept_request);
            this.eventType = data;
        },

        // event post notification
        incomingEventPostNotification(post_user, data){
            this.requestedUser.unshift(post_user);
            this.eventType = data;
        },


        // event comment notification
        incomingEvenCommentNotification(post_comment, data){
            this.requestedUser.unshift(post_comment);
            this.eventType = data;
        },

        // event like notification
        incomingEventLike(liked_by, data){
            this.requestedUser.unshift(liked_by);
            this.eventType = data;
        }



    },


    computed: {
        ...mapGetters({
            authUser: 'authUser',
            getNotification: 'getNotification',
            toggleSettings: 'toggleSettings',
            getUserSearch: 'getUserSearch',
        })
    },


    watch: {
        keywords(after, before){
            this.fetch();
        }
    },
}
</script>


<style scoped>
    .alertMessage{
        position: absolute;
        top: 25%;
        right: 25%;
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background: #00FF00;
    }

    .alertNotification{
        position: absolute;
        top: 0%;
        left: 50%;
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background: #00FF00;
    }

    .chat-image{
        width: 20px;
        height: 20px;
        margin: 0 auto;
    }


    .avatar{
        display: flex;
        align-items: center;
        padding-right: 10px;
    }


    .contact .name{
        margin: 0;
        font-weight: bold;
    }

    .contact .unread{
        position: absolute;
        right: 11px;
        background: rgb(3, 206, 37);
        color:white;
        display: flex;
        font-weight: 700;
        justify-content: center;
        align-items: center;
        line-height: 20px;
        font-size: 12px;
        padding: 0 6px;
        border-radius: 50%;
    }

    p{
        margin: 0;
    }


    @media (max-width: 767px) {
        .nav_part_one_responsive{
            width: 10%!important;
        }

        .nav_part_two_responsive{
            width: 70%!important;
        }

        .nav_part_three_responsive{
            width: 20%!important;
        }

        .router_link{
            padding: 0px 10px 0px;
        }

        /* .nav_profile_image{
            width: 15px;
            height: 15px;
        } */


        .timeline{
            width: 100%!important;
        }

        .slider_responsive{
            display: none;
        }

        .display_keywords{
            display: none;
        }
    }


    @media (min-width:768px) and (max-width:991px) {
        .display_keywords{
            display: none!important;
        }
    }
</style>
