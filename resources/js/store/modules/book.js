import { data } from "jquery";

const state = {
    book: [],
    delImage: '',
    allBooks: [],
    editBook: [],
    bookKey: null,
    editPages: [],
};


const getters = {

    allBooks(state){
        return state.allBooks;
    },

    getNewBook(state){
        return state.book;
    },


    getEditBook(state){
        return state.editBook;
    },

    getBookKey(state){
        return state.bookKey;
    },

    getBookPages(state){
        return state.editPages;
    }
};


const actions = {
    // get bookfeed books starts
    fetchBookFeed({state, commit}, data){
        axios.post('/api/get_books')
            .then(function (response) {
                // commit('setUserFriendship', response.data);
                commit('setUserBook', response.data);
            })
            .catch(function (error){
                // commit('setButtonText', 'Add Friend');
            });
    },
    // get bookfeed books ends

    // get user books starts

    fetchAuthBook({state, commit}, data){
        axios.post('/api/auth/book', {
            'user_id': parseFloat(data.user_id),
            })
            .then(function (response) {
                // commit('setUserFriendship', response.data);
                commit('setUserBook', response.data);
            })
            .catch(function (error){
                // commit('setButtonText', 'Add Friend');
            });
    },

    // get user books ends


    createBook({state, commit}, data){
        axios.post('/api/mybook/createMyBook', {
            'userId': data.userId,
            'bookName': data.bookName,
            'bookPage': data.bookPage,
            'bookUniqueName': data.bookUniqueName,
            'bookTitleImage': data.bookTitleImage,
            'bookTagsName': data.bookTagsName,
        })
            .then(function (response) {
                // console.log(response.data);
                // commit('setChatContacts', response.data);
                commit('NewBook', response.data);
            })
            .catch(function (error) {

            });

    },

    addPageDB({state, commit}, data){
        axios.post('/api/mybook/addPageDB', {
            'book_id': data.getNewBook.data.book_id,
            'book_unique_name': data.getNewBook.data.attributes.book_unique_name,
            'page_no': data.pageData.index,
            'page_image': data.pageData.imageName,
        })
            .then(function (response) {
                // console.log(response.data);
                // commit('setChatContacts', response.data);
                // commit('NewBook', response.data);
            })
            .catch(function (error) {

            });
    },

    // edit page from db starts

    editPageDB({state, commit}, data){
        axios.post('/api/mybook/editPageDB', {
            'page_id' : data.getNewBook.data.page_id,
            'book_id': data.getNewBook.data.attributes.book_id,
            'book_unique_name': data.getNewBook.data.attributes.book_unique_name,
            'page_no': data.pageKey + 1,
            'page_image': data.getNewBook.data.attributes.image_name,
            'pageKey': data.pageKey,
        })
            .then(function (response) {
                // console.log(response.data);
                commit('setEditedPage', {
                    editedPage: response.data,
                    pageKey: data.pageKey,
                });
                // commit('NewBook', response.data);
            })
            .catch(function (error) {

            });
    },

    // edit page from db ends

    deleteSingleImage({state, commit}, data){
        axios.post('/api/book/removeImage', {
            'imageName': data.imageName,
        })
            .then(function (response) {
                // console.log(response.data);
                // commit('setChatContacts', response.data);
                commit('deImage', response.data);
            })
            .catch(function (error) {

            });
    },


    delBookTitleImage({state, commit}, data){
        axios.post('/api/book/removeBookImage', {
            'imageName': data.imageName,
        })
            .then(function (response) {
                // console.log(response.data);
                // commit('setChatContacts', response.data);
                commit('deImage', response.data);
            })
            .catch(function (error) {

            });
    },


    // myBook view starts
    myBookView({state, commit}, data){
        this.$router.push({path: 'bookView'});
        window.location.href = "api/mybook/pages";
    },
    // myBook view ends


    // bookComment starts
    commentBook({state, commit}, data){
        axios.post('/api/book/' + data.bookId + '/comment', {body: data.body})
            .then(function (response) {
                commit('pushBookComments', {comments: response.data, bookKey: data.bookKey});
            })
            .catch(function (error) {
                // commit('setPostStatus', 'error');
            })
    },

    // bookComment ends


    // loveBook starts

    loveBook({state, commit}, data){
        axios.post('/api/book/' + data.bookId + '/loveBook')
            .then(function (response) {
                commit('pushLove', {love: response.data, bookKey: data.bookKey});
            })
            .catch(function (error) {
                // commit('setPostStatus', 'error');
            })
    },
    // loveBook ends

    // edit book starts
    fetchEditBook({state, commit}, data){
        commit('editBook', {
            editBook: data.editBook,
            bookKey: data.bookKey,
        });
        data.router.push('/editMyBook');
    },

    fetchEditBookToDB({state, commit}, data){
        axios.post('/api/book/editBookDB', {
            bookId: data.bookId,
            bookName: data.bookName,
            bookPage: data.bookPage,
            bookUniqueName: data.bookUniqueName,
            bookTitleImage: data.bookTitleImage,
            bookTagsName: data.bookTagsName,
            bookKey: data.bookKey,
        })
            .then(function (response) {
                commit('editBookToDB', {editedBook: response.data, bookKey: data.bookKey, router: data.router});
            })
            .catch(function (error) {
                // commit('setPostStatus', 'error');
            })
    },
    // edit boeditedPageok ends

    // edit book Pages starts
    fetchBookPages({state, commit}, data){
        axios.post('/api/book/getBookPages', {
            bookId: data.bookId,
            userId: data.userId,
        })
            .then(function (response) {
                commit('setBookPagesToEdit', {bookPages: response.data});
            })
            .catch(function (error) {
                // commit('setPostStatus', 'error');
            })
    }
    // edit book Pages ends


};


const mutations = {

    setUserBook(state, books){
        state.allBooks = books;
    },


    NewBook(state, book){
        state.book = book;
    },

    deImage(state, response){
        state.delImage = response;
    },


    // add loveBook starts
    pushLove(state, data){
        state.allBooks.data[data.bookKey].data.attributes.loves = data.love;
    },

    pushBookComments(state, data){
        state.allBooks.data[data.bookKey].data.attributes.comments = data.comments;
    },

    // add loveBook ends

    // editbook starts
    editBook(state, data){
        state.editBook = data.editBook;
        state.bookKey = data.bookKey;
    },


    editBookToDB(state, data){
        state.allBooks.data[data.bookKey].data.attributes.book_name = data.editedBook.data.attributes.book_name;
        state.allBooks.data[data.bookKey].data.attributes.book_page = data.editedBook.data.attributes.book_page;
        state.allBooks.data[data.bookKey].data.attributes.book_unique_name = data.editedBook.data.attributes.book_unique_name;
        state.allBooks.data[data.bookKey].data.attributes.book_title_page = data.editedBook.data.attributes.book_title_page;
        state.allBooks.data[data.bookKey].data.attributes.book_tags = data.editedBook.data.attributes.book_tags;

        data.router.push('/editPages');
    },
    // editbook ends
    // edit book page starts
    setBookPagesToEdit(state, data){
        state.editPages = data.bookPages;
    },
    //edit book page ends
    // edit page starts
    setEditedPage(state, data){
        state.editPages.data[data.pageKey].data.attributes.image = editedPage.data.attributes.image;
        state.editPages.data[data.pageKey].data.attributes.image_name = editedPage.data.attributes.image_name;
    }
    // edit page ends
};


export default {
    state,
    getters,
    actions,
    mutations,
}
