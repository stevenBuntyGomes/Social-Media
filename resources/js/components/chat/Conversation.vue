<template>
    <div class="conversation">
        <h1 class = "selected_contact">{{ contact ? contact.data.attributes.name : 'select a contact' }}</h1>
        <MessagesFeed :contact = "contact" :messages = "messages"></MessagesFeed>
        <MessageComposer :class = "[contact ? '' : 'hidden']" @send = "sendMessage"></MessageComposer>
    </div>
</template>
<script>
import MessagesFeed from './MessagesFeed.vue'
import MessageComposer from './MessageComposer.vue'

export default {
    props: [
        'contact',
        'messages',
    ],

    methods: {
        sendMessage(text){
            if(!this.contact){
                return;
            }else{
                var self = this;
                axios.post('/api/conversation/send', {
                    contact_id: this.contact.data.user_id,
                    text: text,
                })
                .then(function (response){
                    self.$emit('new', response.data);
                })
                .catch(function (error){

                })
            }
        }
    },


    components: {
        MessagesFeed,
        MessageComposer,
    }
}
</script>
<style lang = "scss" scoped>
    .conversation{
        flex: 4;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    h1{
        font-size: 25px;
        padding: 10px;
        margin: 0;
        border-bottom: 1px dashed gray;
    }


    @media (max-width: 575.5px) {
        .selected_contact{
            text-align: center;
        }
    }


    @media (min-width:576px) and (max-width:767px) {
        .selected_contact{
            text-align: center;
        }
    }
</style>
