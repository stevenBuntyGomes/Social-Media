<template>
    <div class = "flex flex-col items-center py-4">
        <div class = "bg-white rounded shadow w-2/3 p-4 m-3">
            <div class = "flex justify-between intems-center">
                <div class = "ml-3 mr-3">
                    <div class = "mt-4 flex items-center mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-book-half" viewBox="0 0 16 16">
                            <path d="M8.5 2.687c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492V2.687zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783z"/>
                        </svg>
                        <p class = "ml-3">Studied at: {{ getAbout.data.attributes.study_place }}</p>
                    </div>
                    <input type="text" name = "body" placeholder = "Update Study At" v-model = "studyAt"
                    class = "mb-1 w-full pl-4 h-8 bg-gray-200 rounded-full focus:outline-none focus:shadow-outline text-sm">
                    <div class = "mt-4 flex items-center mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-briefcase" viewBox="0 0 16 16">
                            <path d="M6.5 1A1.5 1.5 0 0 0 5 2.5V3H1.5A1.5 1.5 0 0 0 0 4.5v1.384l7.614 2.03a1.5 1.5 0 0 0 .772 0L16 5.884V4.5A1.5 1.5 0 0 0 14.5 3H11v-.5A1.5 1.5 0 0 0 9.5 1h-3zm0 1h3a.5.5 0 0 1 .5.5V3H6v-.5a.5.5 0 0 1 .5-.5z"/>
                            <path d="M0 12.5A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5V6.85L8.129 8.947a.5.5 0 0 1-.258 0L0 6.85v5.65z"/>
                        </svg>
                        <p class = "ml-3">Work Place: {{ getAbout.data.attributes.work_place }}</p>
                    </div>
                    <input type="text" name = "body" placeholder = "Update Work Place" v-model = "workPlace"
                    class = "mb-3 w-full pl-4 h-8 bg-gray-200 rounded-full focus:outline-none focus:shadow-outline text-sm">
                    <div class = "mt-1 flex items-center mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-briefcase-fill" viewBox="0 0 16 16">
                            <path d="M6.5 1A1.5 1.5 0 0 0 5 2.5V3H1.5A1.5 1.5 0 0 0 0 4.5v8A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-8A1.5 1.5 0 0 0 14.5 3H11v-.5A1.5 1.5 0 0 0 9.5 1h-3zm0 1h3a.5.5 0 0 1 .5.5V3H6v-.5a.5.5 0 0 1 .5-.5zm1.886 6.914L15 7.151V12.5a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5V7.15l6.614 1.764a1.5 1.5 0 0 0 .772 0zM1.5 4h13a.5.5 0 0 1 .5.5v1.616L8.129 7.948a.5.5 0 0 1-.258 0L1 6.116V4.5a.5.5 0 0 1 .5-.5z"/>
                        </svg>
                        <p class = "ml-3">Business: {{ getAbout.data.attributes.business }}</p>
                    </div>
                    <input type="text" name = "body" placeholder = "Update Business" v-model = "business"
                    class = "mb-3 w-full pl-4 h-8 bg-gray-200 rounded-full focus:outline-none focus:shadow-outline text-sm">
                    <div class = "mt-1 flex items-center mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-fill" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M4 4a4 4 0 1 1 4.5 3.969V13.5a.5.5 0 0 1-1 0V7.97A4 4 0 0 1 4 3.999zm2.493 8.574a.5.5 0 0 1-.411.575c-.712.118-1.28.295-1.655.493a1.319 1.319 0 0 0-.37.265.301.301 0 0 0-.057.09V14l.002.008a.147.147 0 0 0 .016.033.617.617 0 0 0 .145.15c.165.13.435.27.813.395.751.25 1.82.414 3.024.414s2.273-.163 3.024-.414c.378-.126.648-.265.813-.395a.619.619 0 0 0 .146-.15.148.148 0 0 0 .015-.033L12 14v-.004a.301.301 0 0 0-.057-.09 1.318 1.318 0 0 0-.37-.264c-.376-.198-.943-.375-1.655-.493a.5.5 0 1 1 .164-.986c.77.127 1.452.328 1.957.594C12.5 13 13 13.4 13 14c0 .426-.26.752-.544.977-.29.228-.68.413-1.116.558-.878.293-2.059.465-3.34.465-1.281 0-2.462-.172-3.34-.465-.436-.145-.826-.33-1.116-.558C3.26 14.752 3 14.426 3 14c0-.599.5-1 .961-1.243.505-.266 1.187-.467 1.957-.594a.5.5 0 0 1 .575.411z"/>
                        </svg>
                        <p class = "ml-3">Lives In: {{ getAbout.data.attributes.Location }}</p>
                    </div>
                    <input type="text" name = "body" placeholder = "Update Lives In" v-model = "livesIn"
                    class = "mb-3 w-full pl-4 h-8 bg-gray-200 rounded-full focus:outline-none focus:shadow-outline text-sm">
                    <div class = "mt-1 flex items-center mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-phone-fill" viewBox="0 0 16 16">
                            <path d="M3 2a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V2zm6 11a1 1 0 1 0-2 0 1 1 0 0 0 2 0z"/>
                        </svg>
                        <p class = "ml-3">Contact: {{ getAbout.data.attributes.contact }}</p>
                    </div>
                    <input type="text" name = "body" placeholder = "Update Contact" v-model = "contact"
                    class = "mb-3 w-full pl-4 h-8 bg-gray-200 rounded-full focus:outline-none focus:shadow-outline text-sm">
                    <div class = "mt-1 flex items-center mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-info-circle-fill mr-2" viewBox="0 0 16 16">
                            <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412l-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                        </svg>
                        <p class = "ml-3">[If you leave any update field empty and update then the particular field will show (not yet)]</p>
                    </div>
                    <transition name = "fade">
                            <button
                                class = "bg-gray-200 ml-2 px-3 py-1 rounded-full"
                                @click = "updateUserInfo">
                                Update
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
    name: "updateInfo",

    data: () => {
        return {
            studyAt: '',
            workPlace: '',
            business: '',
            livesIn: '',
            contact: '',
        }
    },

    mounted(){
        this.$store.dispatch('fetchAuthAbout', {
                user_id: this.authUser.data.user_id,
            });
    },
    computed: {
            ...mapGetters({
                getAbout: 'getAbout',
                authUser: 'authUser',
            }),
        },


    

    methods: {
        updateUserInfo(){
            this.$store.dispatch('updateUserAbout', {
                study_place: this.studyAt,
                work_place: this.workPlace,
                business: this.business,
                Location: this.livesIn,
                contact: this.contact,
            });
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
