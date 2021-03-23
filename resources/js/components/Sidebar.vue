<template>
    <div class = "w-1/3 bg-white p-4 border-r border-gray-400 shadow">
        <h2 class = "font-bold text-2xl tracking-tight search_result_header">Search Result for People</h2>
        <div class = "ml-2 relative display_keywords">
            <div class = "absolute text-gray-700 hover:text-red-700">
                <svg viewBox="0 0 24 24" class="fill-current w-5 h-5 mt-2 ml-2">
                    <path fill-rule="evenodd" d="M20.2 18.1l-1.4 1.3-5.5-5.2 1.4-1.3 5.5 5.2zM7.5 12c-2.7 0-4.9-2.1-4.9-4.6s2.2-4.6 4.9-4.6 4.9 2.1 4.9 4.6S10.2 12 7.5 12zM7.5.8C3.7.8.7 3.7.7 7.3s3.1 6.5 6.8 6.5c3.8 0 6.8-2.9 6.8-6.5S11.3.8 7.5.8z" clip-rule="evenodd"/>
                </svg>
            </div>
            <input v-model = "keywords" type="text" name = "search" class = "rounded-full w-full h-8 bg-gray-200 pl-8 focus:outline-none focus:shadow-outline text-sm input_field" placeholder = "search people">
        </div>
        <div class="mt-4 contacts-list">
            <ul>
                <li v-for = "user in getUserSearch.data" :key = "user.data.user_id">
                    <div class="avatar">
                        <img class = "chat-image rounded-full" :src="user.data.attributes.profile_image.data.attributes.path" alt="hello">
                    </div>
                    <div class="contact">
                        <router-link :to = "'/users/' + user.data.user_id">
                            <p class = "name no-underline chat-image_text">{{ user.data.attributes.name }}</p>
                        </router-link>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</template>
<script>
import {mapGetters} from 'vuex';
    export default {

        data: () => {
            return {
                keywords: null,
            }
        },

        computed: {
            ...mapGetters({
                getUserSearch: 'getUserSearch',
            })
        },


        methods: {
            fetch(){
                this.$store.dispatch('fetchUserSearch', {
                    keywords: this.keywords,
                });
            },
        },


        watch: {
            keywords(after, before){
                this.fetch();
            }
        },
    }
</script>
<style lang = "scss" scoped>

    .display_keywords{
        display: none;
    }


    .chat-image{
        width: 45px;
        height: 45px;
        margin: 0 auto;
    }

    .contacts-list{
        flex: 3;
        max-height: 600px;
        overflow: scroll;
        border-left: 5px solid rgb(207, 205, 205);
    }

    ul{
        list-style: none;
        padding-left: 0;
    }

    li{
        display: flex;
        flex: 1;
        margin: 10px;
        border-bottom: 2px solid rgb(207, 205, 205);
        max-height: 80px;
        cursor:pointer;
    }

    li.selected{
        background: rgb(177, 175, 175);
    }

    li.hidden{
        display: none;
    }


    .avatar{
        display: flex;
        align-items: center;
        padding-right: 10px;
    }

    .contact{
        display: flex;
        flex: 3;
        flex-direction: column;
        justify-content: center;
        position: relative;
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


    /* responsive part starts  */
    @media (max-width: 575.5px){
        .search_result_header{
            font-size: 12px;
        }


        .display_keywords{
            display: block;
        }

        .display_keywords .input_field{
            font-size: 10px;
        }

        .chat-image{
            width: 18px;
            height: 18px;
        }

        .chat-image_text{
            font-size: 10px;
        }
    }


    @media (min-width:576px) and (max-width:767px){
        .search_result_header{
            font-size: 16px;
        }

        .display_keywords{
            display: block;
        }

        .display_keywords .input_field{
            font-size: 12px;
        }


        .chat-image{
            width: 30px;
            height: 30px;
        }

        .chat-image_text{
            font-size: 14px;
        }
    }

    @media (min-width:768px) and (max-width:991.5px){
        .search_result_header{
            font-size: 16px;
        }

        .display_keywords{
            display: block;
        }

        .display_keywords .input_field{
            font-size: 12px;
        }


        .chat-image{
            width: 30px;
            height: 30px;
        }

        .chat-image_text{
            font-size: 14px;
        }
    }
    
    /* responsive part ends  */
</style>
