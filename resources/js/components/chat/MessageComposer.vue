<template>
    <div class="composer">
        <textarea v-model = "message" @keydown.enter="send" placeholder="Message..."></textarea>

    </div>
</template>
<script>
export default {

    data: () => {
            return {
                message: '',
            }
        },


    methods: {
        send(e){
            e.preventDefault();
            if(this.message == ''){
                return;
            }
            this.$emit('send', this.message);
            this.message = '';
        }
    }
}
</script>
<style scoped>
    .composer textarea{
        width: 96%;
        margin: 10px;
        padding: 10px;
        resize: none;
        border-radius: 10px;
        border: 1px solid lightgrey;
    }
</style>
