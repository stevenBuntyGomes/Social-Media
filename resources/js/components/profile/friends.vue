<template>
    <div class="friend-list">
        <ul>

            <li v-for = "contact in sortedContacts" :key = "contact.data.user_id" :class = "[(contact.data.user_id == authUser.data.user_id) ? 'hidden' : '']" @click = "selectedRoute(contact)">
                <!-- <router-link to = "">
                </router-link> -->
                <div class="friend-avatar">
                    <img class = "friend-image rounded-full" :src="contact.data.attributes.profile_image.data.attributes.path" alt="hello">
                </div>
                <div class="friend">
                    <p class = "name">{{ contact.data.attributes.name }}</p>
                    <p class = "email">{{ contact.data.attributes.email }}</p>
                    <span class = "unread" v-if="contact.data.attributes.unread">{{ contact.data.attributes.unread }}</span>
                </div>
            </li>
        </ul>
    </div>
</template>
<script>
import {mapGetters} from 'vuex'

export default {



    mounted(){
        this.$store.dispatch('fetchUserFriends');
    },


    computed: {
        sortedContacts(){
            return _.sortBy(this.getUserFriends.data).reverse();
        },


        ...mapGetters({
            authUser: 'authUser',
            getUserFriends: 'getUserFriends',
        }),
    },

    methods: {
        selectedRoute(contact){
            this.$router.push('/users/' + contact.data.user_id);
        }
    }
}
</script>
<style lang = "scss" scopped>

    .friend-image{
        width: 45px;
        height: 45px;
        margin: 0 auto;
    }

    .friend-list{
        flex: 3;
        max-height: 600px;
        overflow-y: scroll;
        border-left: 5px solid rgb(207, 205, 205);
    }

    .friend-list ul{
        list-style: none;
        padding-left: 0;
    }

    .friend-list ul li{
        display: flex;
        flex: 1;
        margin: 15px!important;
        padding: 15px!important;
        border-bottom: 2px solid rgb(207, 205, 205);
        max-height: 80px;
        cursor: pointer;
    }

    .friend-list ul li.selected{
        background: rgb(177, 175, 175);
    }

    .friend-list ul li.hidden{
        display: none;
    }


    .friend-avatar{
        display: flex;
        align-items: center;
        padding-right: 10px;
    }

    .friend{
        display: flex;
        flex: 3;
        flex-direction: column;
        justify-content: center;
        position: relative;
    }

    .friend .name{
        margin: 0;
        font-weight: bold;
    }
    .friend .unread{
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