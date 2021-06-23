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
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-book-fill" viewBox="0 0 16 16">
                    <path d="M8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783z"/>
                </svg>
            </router-link>

            <router-link to="/newsFeed" class = "router_link px-6 border-b-2 border-blue-500 h-full flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                </svg>
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
            <button @click = "notificationBar = ! notificationBar; eventLight = false; requestedUser = getAuthNotification" class = "focus-outline-none mr-3 relative">
                <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" fill="currentColor" class="bi bi-bell-fill" viewBox="0 0 16 16">
                    <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2zm.995-14.901a1 1 0 1 0-1.99 0A5.002 5.002 0 0 0 3 6c0 1.098-.5 6-2 7h14c-1.5-1-2-5.902-2-7 0-2.42-1.72-4.44-4.005-4.901z"/>
                </svg>
                <div class = "alertNotification" v-if = "eventLight"></div>
            </button>
            <div v-if = "notificationBar" class = "z-50 absolute top-8 bg-white border border-gray-400 shadow-sm notificationList">
                <div class = "">
                    <ul>
                        <li v-for = "(notification, notifyKey) in getAuthNotification.data" :key = "notifyKey" class = "p-3 m-0 border border-gray-400 relative notificationListItem">
                            <div class = "absolute notificationDeletOption">
                                <button @click = "deleteNotification(notification, notifyKey)">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash notificationDeletOptionButton" viewBox="0 0 16 16">
                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                    </svg>
                                </button>
                            </div>
                            <div class="contact">
                                    <div v-if = "notification.data.attributes.status == 1" class = "font-normal no-underline">Friend Request From</div>
                                    <div v-if = "notification.data.attributes.status == 2" class = "font-normal no-underline">Request Accepted by</div>
                                    <div v-if = "notification.data.attributes.status == 3" class = "font-normal no-underline">New
                                            <p
                                            class = "font-bold cursor-pointer text-blue-400"
                                            @click = "goToPostView(notification.data.attributes.post)">
                                                Post
                                            </p>
                                            From
                                         </div>
                                    <div v-if = "notification.data.attributes.status == 4" class = "font-normal no-underline">New Comment On
                                        <p
                                            class = "font-bold cursor-pointer text-blue-400"
                                            @click = "goToPostView(notification.data.attributes.post)">
                                                Post
                                            </p>

                                        From</div>
                                    <div v-if = "notification.data.attributes.status == 5" class = "font-normal no-underline">New Like On

                                            <p
                                            class = "font-bold cursor-pointer text-blue-400"
                                            @click = "goToPostView(notification.data.attributes.post)">
                                                Post
                                            </p>
                                            From
                                         </div>
                                    <div v-if = "notification.data.attributes.status == 6" class = "font-normal no-underline">New
                                        <p
                                        class = "font-bold cursor-pointer text-blue-400"
                                        @click = "goToBookView(notification.data.attributes.book)">
                                            Book
                                        </p>
                                        From
                                    </div>
                                    <div v-if = "notification.data.attributes.status == 7" class = "font-normal no-underline">New Love On
                                        <p
                                        class = "font-bold cursor-pointer text-blue-400"
                                        @click = "goToBookView(notification.data.attributes.book)">
                                            Book
                                        </p>
                                        From
                                    </div>
                                    <div v-if = "notification.data.attributes.status == 8" class = "font-normal no-underline">New Comment On
                                        <p
                                        class = "font-bold cursor-pointer text-blue-400"
                                        @click = "goToBookView(notification.data.attributes.book)">
                                            Book
                                        </p>
                                        From
                                    </div>
                            </div>
                            <div class = "inline flex">
                                <div class = "avatar">
                                    <img class = "chat-image rounded-full" :src="notification.data.attributes.from.data.attributes.profile_image.data.attributes.path" alt="hello">
                                </div>
                                <div class="contact">
                                    <router-link :to = "'/users/' + notification.data.attributes.from.data.user_id">
                                        <p class = "name no-underline">{{ notification.data.attributes.from.data.attributes.name }}</p>
                                    </router-link>
                                </div>
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
            settings: false,
            notificationBar: false,
            keywords: null,
            requestedUser: [],
            eventType: 0,
            eventLight: false,
            bookLink: null,
            postLink: null,
        }
    },

    // data: () => {
    //     return {

    //     }
    // },


    mounted(){

            // this.$store.dispatch('AuthNotification', {
            //     userId: this.authUser.data.user_id,
            // });
            this.$store.dispatch('AuthNotification');

            this.requestedUser = this.getAuthNotification;

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

            // new book notification channel starts

            Echo.private(`NewBookNotification.${this.authUser.data.user_id}`) //the pusher problem was created here
            .listen('NewBookNotification', (e) => {
                this.eventLight = true;
                this.incomingEventBookNotification(e.book_notification);
                alert(e.book_notification);
            });

            // new book notification channel ends

            // book love notification starts

            Echo.private(`bookLoveNotification.${this.authUser.data.user_id}`) //the pusher problem was created here
            .listen('BookLove', (e) => {
                this.eventLight = true;
                this.incomingEventBookLove(e.loved_by, 7);
                alert(e.liked_by);
            });

            // book love notification ends

            // book comment notification starts

            Echo.private(`BookCommentNotification.${this.authUser.data.user_id}`) //the pusher problem was created here
            .listen('BookCommentNotification', (e) => {
                this.eventLight = true;
                this.incomingBookCommentNotification(e.book_comment, 8);
                alert(e.book_comment);
            });

            // book comment notification ends
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
        },

        // event book notification starts

        incomingEventBookNotification(book_notification){
            // this.requestedUser.data.unshift(book_notification);
            this.getAuthNotification.data.unshift(book_notification);
        },

        // event book notification ends

        // event book love norification starts

        incomingEventBookLove(loved_by, data){
            this.requestedUser.unshift(loved_by);
            this.eventType = data;
        },

        // event book love norification ends
        // event book comment norification starts

        incomingBookCommentNotification(book_comment, data){
            this.requestedUser.unshift(book_comment);
            this.eventType = data;
        },

        // event book comment norification ends

        // goToBook starts
        goToBookView(book){
            if(this.$route.path != '/bookView'){
                this.$router.push({name: 'bookView', params: {thisBook: book}});
            }else{
                this.$router.push({name: 'loadingBook', params: {thisBook: book}});
            }
        },
        // goToBook ends

        // goToPost starts
        goToPostView(post){
            if(this.$route.path != '/postView'){
                this.$router.push({name: 'postView', params: {thisPost: post}});
            }else{
                this.$router.push({name: 'loadingPost', params: {thisPost: post}});
            }
        },
        // goToPost ends

        // deleteNotification starts
        deleteNotification(notification, notifyKey){
            this.$store.dispatch('fetchDeleteNotification', {
                notification_id: notification.data.notification_id,
                key: notifyKey,
            });

            this.getAuthNotification.data.splice(notifyKey, 1);
            console.log(notifyKey);
        },
        // deleteNotification ends


    },


    computed: {
        ...mapGetters({
            authUser: 'authUser',
            getNotification: 'getNotification',
            toggleSettings: 'toggleSettings',
            getUserSearch: 'getUserSearch',
            getAuthNotification: 'getAuthNotification',
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

    .notificationList{
        height: 600px;
        width: 350px!important;
        border-radius: 15px;
        overflow: scroll;
    }

    .notificationDeletOption{
        right: 10%;
    }

    .notificationDeletOptionButton{
        width: 35px;
        height: 25px;
        /* border: 1px solid #000000; */
        transition: 0.2s;
        border-radius: 15%;
        text-align: center;
        line-height: 25px;
        background: #ffffff;
        box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
        display: none;
    }

    .notificationDeletOptionButton:hover {
        color: #ffffff;
        box-shadow: none;
        background: rgb(255, 51, 51);
    }

    .notificationListItem{
        transition: 0.2s;
    }


    .notificationListItem:hover .notificationDeletOptionButton{
        transition: 0.2s;
        display: block;

    }

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
        width: 24px;
        height: 24px;
    }


    .avatar{
        /* display: flex; */
        /* align-items: left!important; */
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
