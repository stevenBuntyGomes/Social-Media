<template>
    <div class="feed" ref = "feed">
        <ul v-if = "contact">
            <li v-for = "message in messages" :key="message.id" :class = "`message${message.to == contact.id ? ' sent' : ' received'}`">
                <div class="text">
                    {{ message.text }}
                </div>
            </li>
        </ul>
    </div>
</template>
<script>
export default {
    props: [
        'contact',
        'messages',
    ],


    methods: {
        // messages scrolling to bottom
        scrollToBottom(){
            setTimeout(() => {
                this.$refs.feed.scrollTop = this.$refs.feed.scrollHeight - this.$refs.feed.clientHeight;
            }, 50);
        }
    },

    watch: {
        // messages scrolling to bottom starts
        contact(contact){
            this.scrollToBottom();
        },

        messages(messages){
            this.scrollToBottom();
        }
        // messages scrolling to bottom ends
    }
}
</script>
<style lang = "scss" scoped>
    .feed{
        overflow-y: scroll;
        height: 100%;
        max-height: 480px;
    }

    .text{
        margin: 5px!important;
        padding: 5px!important;
        max-width: 200px;
        border-radius: 5px;
        display: inline-block;
    }

    ul{
        list-style: none;
        padding: 5px;
    }

    li.message.received{
        text-align: right;
    }

    li.message.received .text{
        background: white;
    }

    li.message.sent{
        text-align: left;
    }

    li.message.sent .text{
        background: lightgrey;
    }
</style>
