import Vue from 'vue';
import Vuex from 'vuex';
import User from './modules/user.js';
import Title from './modules/title.js';
import Profile from './modules/profile.js';
import Posts from './modules/post.js';
import chatContacts from './modules/chatContact.js';
import Search from './modules/search.js';
import About from './modules/about.js';
import windowWidth from './modules/windowWidth.js';
import book from './modules/book.js';
import notification from './modules/notification.js';

Vue.use(Vuex);


export default new Vuex.Store({
    modules: {
        User,
        Title,
        Profile,
        Posts,
        chatContacts,
        Search,
        About,
        windowWidth,
        book,
        notification,
    }
})
