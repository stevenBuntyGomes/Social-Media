<template>
    <div class="contacts-list">
        <ul>
            <li v-for = "contact in sortedContacts" :key = "contact.id" @click = "selectContact(contact)" :class = "[(contact === selected) ? 'selected' : '', (contact.id == auth.data.user_id) ? 'hidden' : '']">
                <div class="avatar">
                    <img class = "chat-image rounded-full" src="storage/user-images/profile-default-image.jpg" alt="hello">
                </div>
                <div class="contact">
                    <p class = "name">{{ contact.name }}</p>
                    <p class = "email">{{ contact.email }}</p>
                    <span class = "unread" v-if="contact.unread">{{ contact.unread }}</span>
                </div>
            </li>
        </ul>
    </div>
</template>
<script>
export default {
    data: () => {
        return {
            selected: null,
            authId: 0,
        }
    },

    props: [
        'contacts',
        'auth'
    ],

    mounted() {
        // console.log(contacts);
        this.authId = this.auth.data.user_id;
    },


    methods: {
        selectContact(contact){
            this.selected = contact;
            this.$emit('selected', contact);
        }
    },

    computed: {
        sortedContacts(){
            return _.sortBy(this.contacts, [(contact) => {
                if(contact == this.selected){
                    return Infinity;
                }
                return contact.unread;
            }]).reverse();
        }
    }

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
