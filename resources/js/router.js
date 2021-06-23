import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

// importing routes start

import start from './views/start.vue'
import Show from './views/Users/Show.vue'
import Feed from './views/Users/Feed.vue'
import NewsFeed from './views/Newsfeed.vue'
import chatApp from './components/chat/chatApp.vue'
import accountSettings from './components/settings/accountSettings.vue'
import friends from './components/profile/friends.vue'
import about from './components/profile/about.vue'
import updateInfo from './components/profile/updateInfo.vue'
import Book from './components/books/book.vue'
import createBook from './components/books/createBook.vue'
import addPages from './components/books/addPages.vue'
import bookView from './components/books/bookView.vue'
import editMyBook from './components/books/editMyBook.vue'
import editPages from './components/books/editPages.vue'
import bookFeed from './components/books/bookFeed.vue'
import loadingBook from './components/books/loadingBook.vue'
import postView from './components/postView.vue'
import loadingPost from './components/loadingPost.vue'

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
            path: '/users-feeds/:userId',
            component: Feed,
            name: 'user.Feed',
            meta: { title: 'Profile Feeds' },
        },
        {
            path: '/newsFeed',
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
        {
            path: '/book/:userId/',
            component: Book,
            name: 'Book',
            meta: { title: 'Book' },
        },
        {
            path: '/createBook',
            component: createBook,
            name: 'createBook',
            meta: { title: 'Create New Book' },
        },
        {
            path: '/addPages',
            component: addPages,
            name: 'addPages',
            meta: { title: 'Add New Pages' },
        },
        {
            path: '/bookView',
            component: bookView,
            name: 'bookView',
            meta: { title: 'Book View' },
        },
        {
            path: '/editMyBook',
            component: editMyBook,
            name: 'editMyBook',
            meta: { title: 'Edit My Book' },
        },
        {
            path: '/editPages',
            component: editPages,
            name: 'editPages',
            meta: { title: 'Edit Pages' },
        },
        {
            path: '/',
            component: bookFeed,
            name: 'BookFeed',
            meta: { title: 'Book Feed' },
        },
        {
            path: '/loadingBook',
            component: loadingBook,
            name: 'loadingBook',
            meta: { title: 'Loading Book' },
        },
        {
            path: '/postView',
            component: postView,
            name: 'postView',
            meta: { title: 'Post View' },
        },

        {
            path: '/loadingPost',
            component: loadingPost,
            name: 'loadingPost',
            meta: { title: 'Loading Post' },
        },
    ];

export default new VueRouter({
    mode: 'history',
    routes
})
