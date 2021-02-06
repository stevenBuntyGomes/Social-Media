<template>
    <div class="chat-app">
        <Conversation :contact = "selectedContact" :messages = "messages" @new = "saveNewMessage">
            </Conversation>
            <ContactsList :contacts = "chatContacts" :auth = "authUser" @selected = "startConversationWith">
                </ContactsList>
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
        startConversationWith(contact){
            var self = this;
            self.updateUnreadCount(contact, true);
            self.notification = false;
            this.$store.dispatch('notify', this.notification);
            axios.get(`/api/conversation/${contact.id}`)
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
            if(this.selectedContact && message.from === this.selectedContact.id){

                this.saveNewMessage(message);
                return;
                // this.messages.push(message);
                // alert(message.text);
            }
                this.updateUnreadCount(message.from_contact, false);
                this.notification = true;
                // self.$emit('notification', self.notification);
                this.$store.dispatch('notify', this.notification);
        },

        // update contact unread messages
        updateUnreadCount(contact, reset){
            this.chatContacts = this.chatContacts.map((single) => {
                if(single.id != contact.id){
                    this.notification = true;
                    this.$store.dispatch('notify', this.notification);
                    return single;
                }

                if(reset){
                    single.unread = 0;
                    this.notification = false;
                    this.$store.dispatch('notify', this.notification);
                }else{
                    single.unread += 1;
                    this.notification = true;
                    this.$store.dispatch('notify', this.notification);
                }

                return single;
            });
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
    }

    .chat-image{
        width: 60px;
        height: 60px
    }
</style>
