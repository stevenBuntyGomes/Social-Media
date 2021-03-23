<template>
    <div class="chat-app">
        <Conversation :contact = "selectedContact" :messages = "messages" @new = "saveNewMessage">
            </Conversation>
            <ContactsList :class = "[(isChatActive) ? 'chat_Responsive' : 'chat_af_Responsive']" :contacts = "chatContacts" :auth = "authUser" @selected = "startConversationWith">
                </ContactsList>
                <button @click = "toggleChatClick" v-bind:class = "[(isChatButtonActive) ? 'chat_responsive_button' : 'chat_af_responsive_button']">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-right" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M1 11.5a.5.5 0 0 0 .5.5h11.793l-3.147 3.146a.5.5 0 0 0 .708.708l4-4a.5.5 0 0 0 0-.708l-4-4a.5.5 0 0 0-.708.708L13.293 11H1.5a.5.5 0 0 0-.5.5zm14-7a.5.5 0 0 1-.5.5H2.707l3.147 3.146a.5.5 0 1 1-.708.708l-4-4a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 4H14.5a.5.5 0 0 1 .5.5z"/>
                        </svg>
                    </button>
    </div>
</template>
<script>
import {mapGetters} from 'vuex'
import Conversation from './Conversation.vue'
import ContactsList from './ContactsList.vue'


export default {
    data:() => {
        return {
            selectedContact: null,
            messages: [],
            notification: false,
            isChatActive: true,
            isChatButtonActive: true,
            // totalUnread: null,
            // contacts: [],
        }
    },


    mounted(){
        var self = this;
        Echo.private(`messages.${this.authUser.data.user_id}`) //the pusher problem was created here
            .listen('NewMessage', (e) => {
                self.handleIncoming(e.message);
            });
        // var self = this;
        // axios.get('/api/contacts')
        //     .then(function (response) {
        //         // console.log(response.data);
        //         self.contacts = response.data;
        //         // commit('setChatContacts', response.data);
        //         // commit('setNewsPosts', response.data);
        //         console.log(self.contacts);
        //     })
        //     .catch(function (error) {

        //     });

        self.$store.dispatch('fetchAuthUser');
        self.$store.dispatch('fetchContacts');

        console.log(self.authUser.data.user_id);
        console.log(self.chatContacts);


        axios.get('/api/countChatContacts')
            .then(function (response){
                if(response.data > 0){
                    self.notification = true;
                    this.$store.dispatch('notify', this.notification);
                }
            })
            .catch(function (error){

            })

    },


    methods: {

        toggleChatClick(){
            this.isChatActive = !this.isChatActive;
            this.isChatButtonActive = !this.isChatButtonActive;
        },



        startConversationWith(contact){
            var self = this;
            self.updateUnreadCount(contact, true, 2);
            self.notification = false;
            this.$store.dispatch('notify', this.notification);
            axios.get(`/api/conversation/${contact.data.user_id}`)
                .then(function (response) {
                    self.messages = response.data;
                    self.selectedContact = contact;
                })
                .catch(function (error){
                    //
                })
        },

        saveNewMessage(message){
            this.messages.push(message);
        },

        handleIncoming(message){
            if(this.selectedContact && message.from == this.selectedContact.data.user_id){

                this.saveNewMessage(message);
                return;
                // this.messages.push(message);
                // alert(message.text);
            }
                this.updateUnreadCount(message.from_contact, false, 1);
                this.notification = true;
                // self.$emit('notification', self.notification);
                this.$store.dispatch('notify', this.notification);
        },

        // update contact unread messages
        updateUnreadCount(contact, reset, status){
            if(status == 1){
                this.chatContacts.data = this.chatContacts.data.map((single) => {
                    if(single.data.user_id != contact.id){//the problem in this line
                        this.notification = true;
                        this.$store.dispatch('notify', this.notification);
                        return single;
                    }
                    if(reset){
                        single.data.attributes.unread = 0;
                        this.notification = false;
                        this.$store.dispatch('notify', this.notification);
                    }else{
                        single.data.attributes.unread += 1;
                        this.notification = true;
                        this.$store.dispatch('notify', this.notification);
                    }

                    return single;
                });
            }else if(status == 2){
                this.chatContacts.data = this.chatContacts.data.map((single) => {
                    if(single.data.user_id != contact.data.user_id){//the problem in this line
                        this.notification = true;
                        this.$store.dispatch('notify', this.notification);
                        return single;
                    }
                    if(reset){
                        single.data.attributes.unread = 0;
                        this.notification = false;
                        this.$store.dispatch('notify', this.notification);
                    }else{
                        single.data.attributes.unread += 1;
                        this.notification = true;
                        this.$store.dispatch('notify', this.notification);
                    }

                    return single;
                });
            }

        },


        // total unread messages


    },

    components: {
        Conversation,
        ContactsList,
    },

    computed: {
            ...mapGetters({
                authUser: 'authUser',
                chatContacts: 'chatContacts',
            })
        },
}
</script>
<style lang = "scss" scoped>
    .chat-app{
        display: flex;
        position: relative;
        height: 100%;
    }

    .chat-image{
        width: 60px;
        height: 60px
    }



    @media (max-width: 575.5px) {
        .chat-app{
            height: 100%;
        }
        .chat_Responsive{
            position: absolute;
            right: -70%;
            z-index: 100;
            width: 70%;
            height: 100%;
            transition: all linear 0.3s;
            background: white;
        }

        .chat_af_Responsive{
            position: absolute;
            right: 0%;
            height: 100%;
            width: 70%;
            z-index: 100;
            transition: all linear 0.3s;
            background: white;
        }



        .chat_responsive_button{
            position: absolute;
            padding: 5px;
            right: 0;
            transition: all linear 0.3s;
            background: white;
            padding: 10px;
            z-index: 100;
        }


        .chat_af_responsive_button{
            position: absolute;
            padding: 5px;
            right: 70%;
            transition: all linear 0.3s;
            background: white;
            padding: 10px;
            z-index: 100;
        }
    }
    @media (min-width:576px) and (max-width:767px) {
        .chat-app{
            height: 100%;
        }
        .chat_Responsive{
            position: absolute;
            right: -70%;
            z-index: 100;
            height: 100%;
            width: 70%;
            transition: all linear 0.3s;
            background: white;
        }

        .chat_af_Responsive{
            position: absolute;
            right: 0px;
            height: 100%;
            width: 70%;
            z-index: 100;
            transition: all linear 0.3s;
            background: white;
        }



        .chat_responsive_button{
            position: absolute;
            padding: 5px;
            right: 0;
            transition: all linear 0.3s;
            background: white;
            padding: 10px;
            z-index: 100;
        }


        .chat_af_responsive_button{
            position: absolute;
            padding: 5px;
            right: 70%;
            transition: all linear 0.3s;
            background: white;
            padding: 10px;
            z-index: 100;
        }
    }



    @media (min-width:767px){
        .chat_responsive_button{
            display: none!important;
        }

        .chat_af_responsive_button{
            display: none!important;
        }
    }

</style>
