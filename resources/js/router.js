import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

// importing routes start

import start from './views/start.vue'
import Show from './views/Users/Show.vue'
import NewsFeed from './views/Newsfeed.vue'
import chatApp from './components/chat/chatApp.vue'
import accountSettings from './components/settings/accountSettings.vue'
import friends from './components/profile/friends.vue'
import about from './components/profile/about.vue'
import updateInfo from './components/profile/updateInfo.vue'

// importing routes ends

const routes = [
        {
            path: '/home',
            component: start,
            name: 'home',
            meta: { title: 'start' },
        },

        {
            path: '/users/:userId',
            component: Show,
            name: 'user.show',
            meta: { title: 'Profile' },
        },
        {
            path: '/',
            component: NewsFeed,
            name: 'NewsFeed',
            meta: { title: 'News Feed' },
        },
        {
            path: '/chatApp',
            component: chatApp,
            name: 'chatApp',
            meta: { title: 'Messages' },
        },
        {
            path: '/accountSettings',
            component: accountSettings,
            name: 'accountSettings',
            meta: { title: 'accountSettings' },
        },
        {
            path: '/friends',
            component: friends,
            name: 'friends',
            meta: { title: 'friends' },
        },
        {
            path: '/about/:userId',
            component: about,
            name: 'about',
            meta: { title: 'about' },
        },
        {
            path: '/updateInfo',
            component: updateInfo,
            name: 'updateInfo',
            meta: { title: 'updateInfo' },
        },
    ];

export default new VueRouter({
    mode: 'history',
    routes
})
