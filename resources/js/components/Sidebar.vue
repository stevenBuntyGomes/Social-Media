<template>
    <div class = "w-1/3 bg-white p-4 border-r border-gray-400 shadow">
        <h2 class = "font-bold text-2xl tracking-tight">Search Result for People</h2>
        <div class="mt-4 contacts-list">
        <ul>
            <li v-for = "user in getUserSearch.data" :key = "user.data.user_id">
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
</template>
<script>
import {mapGetters} from 'vuex';
    export default {
        computed: {
        ...mapGetters({
            getUserSearch: 'getUserSearch',
        })
    },
    }
</script>
<style lang = "scss" scoped>
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
</style>
