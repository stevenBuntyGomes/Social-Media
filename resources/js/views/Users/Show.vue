<template>

    <div class = "flex flex-col items-center" v-if = "profileStatus.user == 'success' && user">
        <div class = "relative mb-8">
            <div class="w-100 h-64 overflow-hidden z-10">
                <!-- image -->
                <UploadableImage
                    classes = "object-cover w-full"
                    alt = "user background image"
                    image-width= "1200"
                    image-height = "500"
                    location = "cover"
                    :user-image = "user.data.attributes.cover_image"></UploadableImage>
                <!-- <p>{{ user.data.attributes.name }}</p> -->
            </div>
            <div class="absolute flex items-center bottom-0 left-0 -mb-8 ml-12 z-20">
                <div class="w-32">
                    <UploadableImage
                    classes = "object-cover w-32 h-32 border-4 border-gray-200 rounded-full shadow-lg"
                    alt = "user profile image"
                    image-width= "700"
                    image-height = "700"
                    location = "profile"
                    :user-image = "user.data.attributes.profile_image"></UploadableImage>

                </div>
                <p class = "text-2xl text-gray-100 ml-4">{{ user.data.attributes.name }}</p>
            </div>
            <div class="absolute flex items-center bottom-0 right-0 mb-4 mr-12 z-20">
                <button v-if = "friendButtonText && friendButtonText == 'Add Friend'"
                    class = "py-1 px-3 bg-gray-400 rounded"
                    @click = "$store.dispatch('sendFriendRequest', $route.params.userId)">
                    {{ friendButtonText }}
                </button>
                <button v-if = "friendButtonText && friendButtonText == 'Pending Friend Request'"
                    class = "py-1 px-3 bg-gray-400 rounded"
                    @click = "$store.dispatch('sendFriendRequest', $route.params.userId)">
                    {{ friendButtonText }}
                </button>
                <button v-if = "friendButtonText && friendButtonText === 'Accept'"
                    class = "mr-2 py-1 px-3 bg-blue-500 rounded"
                    @click = "$store.dispatch('acceptFriendRequest', $route.params.userId)">
                    Accept
                </button>
                <button v-if = "friendButtonText && friendButtonText == 'Accept'"
                    class = "mr-2 py-1 px-3 bg-gray-400 rounded"
                    @click = "$store.dispatch('ignoreFriendRequest', $route.params.userId)">
                    Ignore
                </button>
                <button v-if = "friendButtonText && friendButtonText == 'options'"
                    class = "mr-2 py-1 px-3 bg-gray-400 rounded"
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
            <div v-if = "newsPostStatus.newsPostStatus == 'loading'">Loading posts....</div>
            <div v-else-if = "newsPostStatus.newsPostStatus == 'success' && posts.length < 1">No posts found....!</div>
            <Post v-else v-for = "(post, postKey) in posts.data" :key = "postKey" :post="post"></Post>
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


        computed: {
            ...mapGetters({
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

</style>
