import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

// importing routes start

import start from './views/start.vue'
import Show from './views/Users/Show.vue'
import NewsFeed from './views/Newsfeed.vue'

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
        }
    ];

export default new VueRouter({
    mode: 'history',
    routes
})
