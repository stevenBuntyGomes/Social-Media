<template>
    <div class = "flex flex-col items-center py-4">
        <div class = "bg-white rounded shadow w-2/3 p-4">
            <div class = "text ml-4 mb-2 font-bold text-base">
                <p>Change User Name</p>
            </div>
            <div class = "rounded-full bg-red-300 text-red-900 p-3 mb-3" v-if = "getNameStatus.data == 1">
                <p>New User Name can't be same as Old User Name</p>
            </div>
            <div class = "flex justify-between intems-center">
                <div class = "flex-1 flex ml-3 mr-3">
                    <input type="text" name = "body" v-model = "changeProfileName"
                    class = "w-full pl-4 h-8 bg-gray-200 rounded-full focus:outline-none focus:shadow-outline text-sm">
                    <transition name = "fade">
                            <button v-if = "changeProfileName"
                                class = "bg-gray-200 ml-2 px-3 py-1 rounded-full"
                                @click = "updateUserName">
                                Post
                            </button>
                    </transition>
                </div>
            </div>
        </div>
        <!-- change password -->
        <div class = "bg-white rounded shadow w-2/3 p-4 m-3">
            <div class = "text ml-4 mb-2 font-bold text-base">
                <p>Change User Password</p>
            </div>
            <div class = "rounded-full bg-red-300 text-red-900 p-3 mb-3" v-if = "getChangeStatus.data == 1">
                <p>Old Password is wrong</p>
            </div>
            <div class = "rounded-full bg-red-300 text-red-900 p-3 mb-3" v-else-if = "getChangeStatus.data == 2">
                <p>Old Password and New Password are same</p>
            </div>
            <div class = "rounded-full bg-red-300 text-red-900 p-3 mb-3" v-else-if = "getChangeStatus.data == 3">
                <p>New Password and Confirm Password are not same</p>
            </div>
            <div class = "rounded-full bg-green-300 text-green-700 p-3 mb-3" v-else-if = "getChangeStatus.data == 4">
                <p>Password Changed successfully!</p>
            </div>
            <div class = "flex justify-between intems-center">
                <div class = "ml-3 mr-3">
                    <input type="password" name = "body" placeholder = "Old Passward" v-model = "oldPassword"
                    class = "mb-3 w-full pl-4 h-8 bg-gray-200 rounded-full focus:outline-none focus:shadow-outline text-sm">
                    <input type="password" name = "body" placeholder = "New Passward" v-model = "password"
                    class = "mb-3 w-full pl-4 h-8 bg-gray-200 rounded-full focus:outline-none focus:shadow-outline text-sm">
                    <input type="password" name = "body" placeholder = "Congirm Passward" v-model = "confirmPassword"
                    class = "mb-3 w-full pl-4 h-8 bg-gray-200 rounded-full focus:outline-none focus:shadow-outline text-sm">
                    <transition name = "fade">
                            <button v-if = "oldPassword && password && confirmPassword"
                                class = "bg-gray-200 ml-2 px-3 py-1 rounded-full"
                                @click = "updatePassword">
                                Post
                            </button>
                    </transition>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
import {mapGetters} from 'vuex'

export default {
    name: "accountSettings",

    data:() => {
        return {
            changeProfileName: '',
            oldPassword: '',
            password: '',
            confirmPassword: '',
        }
    },

    mounted(){
        this.changeProfileName = this.authUser.data.attributes.name;
    },


    computed: {
        ...mapGetters({
            authUser: 'authUser',
            getChangeStatus: 'getChangeStatus',
            getNameStatus: 'getNameStatus',
        }),
    },

    methods: {
        updateUserName(){
           this.$store.dispatch('fetchUpdateUserName', this.changeProfileName)
        },

        updatePassword(){
            this.$store.dispatch('fetchUpdatePassword', {
                oldPassword: this.oldPassword,
                password: this.password,
                confirmPassword: this.confirmPassword,
            });
            this.oldPassword = '';
            this.password = '';
            this.confirmPassword = '';
        }
    }
}
</script>
<style scoped>
    .fade-enter-active, .fade-leave-active{
        transition: opacity .6s;
    }

    .fade-enter, .fade-leave-to{
        opacity: 0;
    }
</style>
