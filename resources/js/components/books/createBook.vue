<template>

    <div class = "flex flex-col items-center py-4"> <!-- 1 -->
        <div class = "bg-white rounded shadow w-2/3 p-4"> <!-- 2 -->
        <!-- book name starts -->
            <div class = "text ml-4 mb-2 font-bold text-base">
                <p>Book Name</p>
            </div>
            <div class = "justify-between intems-center">
                <div class = "ml-3 mr-3">
                    <input type="text" name = "body" v-model = "bookName"
                    class = "w-full pl-4 h-8 bg-gray-200 rounded-full focus:outline-none focus:shadow-outline text-sm"
                    placeholder = "Book Name">
                </div>
            </div>
            <!-- book name ends -->
            <!-- book page starts -->
            <div class = "text ml-4 mb-2 font-bold text-base">
                <p>Book Page <span class = "font-light text-sm">(No of Pages of the book)</span></p>
            </div>
            <div class = "justify-between intems-center">
                <div class = "ml-3 mr-3">
                    <input type="number" name = "body" v-model = "bookPage"
                    placeholder = "No of Page"
                    class = "w-full pl-4 h-8 bg-gray-200 rounded-full focus:outline-none focus:shadow-outline text-sm">
                </div>
            </div>
            <!-- book page ends -->
            <!-- book unique starts -->
            <div class = "text ml-4 mb-2 font-bold text-base">
                <p>Book Unique Name <span class = "font-light text-sm">(Unique Name that only this book has)</span></p>
            </div>
            <div class = "justify-between intems-center">
                <div class = "ml-3 mr-3">
                    <input type="text" name = "body" v-model = "bookUniqueName"
                    placeholder = "Unique Name of Book"
                    class = "w-full pl-4 h-8 bg-gray-200 rounded-full focus:outline-none focus:shadow-outline text-sm">
                </div>
            </div>
            <!-- book unique ends -->
            <!-- book title image starts -->
            <div class = "text ml-4 mb-2 font-bold text-base">
                <p>Book Image</p>
            </div>
            <div v-if = "bookUniqueName" class = "justify-between intems-center">
                <div class = "ml-3 mr-3">
                    <input type="text" name = "body" v-model = "bookTitleImage"
                    placeholder = "Title Image"
                    class = "w-full pl-4 h-8 bg-gray-200 rounded-full focus:outline-none focus:shadow-outline text-sm">
                    <Button @click = "addingImage()">Add Image</Button>
                    <Modal
                        v-model="addImage"
                        title="Add page"
                        :mask-closable = 'false'
                        :closable = 'false'>
                        <Upload
                            v-if = "uploadCondition"
                            ref="upload"
                            type="drag"
                            :headers= "{'x-csrf-token' : token, 'X-Requested-With' : 'XMLHttpRequest'}"
                            :on-success="handleSuccess"
                            :format="['jpg','jpeg','png']"
                            :data = "{'book_name' : bookUniqueName}"
                            :on-format-error="handleFormatError"
                            :on-exceeded-size="handleMaxSize"
                            action="/api/book/addImage">
                            <div style="padding: 20px 0">
                                <Icon type="ios-cloud-upload" size="52" style="color: #3399ff"></Icon>
                                <p>Click or drag files here to upload</p>
                            </div>
                        </Upload>
                        <div class = "demo-upload-list" v-if = "bookTitleImage">
                            <img v-if = "imageLink" :src="imageLink">
                            <div class="demo-upload-list-cover">
                                <Icon type="ios-eye-outline" @click.native="handleView(item.name)"></Icon>
                                <Icon type="ios-trash-outline" @click="deleteImage()"></Icon>
                            </div>
                        </div>
                        <div slot = "footer">
                            <button type = "default" @click = "addImage=false">Close</button>
                            <button type = "primary" @click = "addImagetoDb" :disabled = "isAdding" :loading="isAdding">Done</button>
                        </div>
                    </Modal>
                </div>
            </div>
            <!-- book title image ends -->
            <!-- book tags starts -->
            <div class = "text ml-4 mb-2 font-bold text-base">
                <p>Book Tags Name <span class = "font-light text-sm">(5 tag names allowed)</span></p>
            </div>
            <div class = "justify-between intems-center">
                <div class = "ml-3 mr-3">
                    <input type="text" name = "body" v-model = "bookTagsName"
                    placeholder = "Tag Names"
                    class = "w-full pl-4 h-8 bg-gray-200 rounded-full focus:outline-none focus:shadow-outline text-sm">
                </div>
            </div>
            <!-- book tags ends -->
            <!-- book post starts -->
            <div class = "justify-between intems-center">
                <div class = "ml-3 mr-3 mt-3">
                    <transition name = "fade">
                            <button v-if = "bookName && bookPage && bookUniqueName && bookTitleImage && bookTagsName"
                                class = "bg-gray-200 ml-2 px-3 py-1 rounded-full"
                                @click = "createBook">
                                Add Book
                            </button>
                    </transition>
                </div>
            </div>
            <!-- book post ends -->
        </div>
    </div>
</template>
<script type = "text/javascript">
import {mapGetters} from 'vuex'

    export default {
        data: () => {
            return {
                userId: null,
                bookName: '',
                bookPage: null,
                bookUniqueName: '',
                bookTitleImage: '',
                bookTagsName: '',
                addImage: false,
                token: '',
                i: -1,
                isAdding: false,
                imageLink: '',
                uploadCondition: true,
            }
        },

        mounted(){
            this.token = document.head.querySelector('meta[name=csrf-token]').content;
            this.userId = this.authUser.data.user_id;
        },


        methods: {
            createBook(){
                this.$store.dispatch('createBook', {
                    userId: this.userId,
                    bookName: this.bookName,
                    bookPage: parseInt(this.bookPage),
                    bookUniqueName: this.bookUniqueName,
                    bookTitleImage: this.bookTitleImage,
                    bookTagsName: this.bookTagsName,
                });
                this.$router.push({name: 'addPages', params: {bookPage: parseInt(this.bookPage)}});
                this.userId = '';
                this.bookName = '';
                this.bookPage = '';
                this.bookUniqueName = '';
                this.bookTitleImage = '';
                this.bookTagsName = '';

            },

            addingImage(){
                this.addImage = true;
            },


            addImagetoDb(){
                this.addImage = false;
            },


            // adding image to db ends

            // image Upload starts
            handleSuccess (res, file) {

                this.bookTitleImage = res.data.attributes.image_name;
                this.imageLink = res.data.attributes.image_src;
                this.uploadCondition = false;

            },
            handleFormatError (file) {
                this.$Notice.warning({
                    title: 'The file format is incorrect',
                    desc: 'File format of ' + file.name + ' is incorrect, please select jpg or png.'
                });
            },
            handleMaxSize (file) {
                this.$Notice.warning({
                    title: 'Exceeding file size limit',
                    desc: 'File  ' + file.name + ' is too large, no more than 2M.'
                });
            },

            handleView (name) {
                this.imgName = name;
                this.visible = true;
            },
            // handleRemove (file) {
            //     if(this.uploadImageCondition){
            //         const fileList = this.$refs.upload.fileList;
            //         this.$refs.upload.fileList.splice(fileList.indexOf(file), 1);
            //     }
            // },


            // deleteImage Drag Drop starts
            deleteImage(isAdd=true){
                this.uploadCondition = true;

                if(this.uploadCondition){
                    if(!isAdd){//for editingIconImage
                    this.isIconImageNew = true;
                    var image = this.data.imageName;
                    this.data.imageName = '';
                    }else{
                        var image = this.bookTitleImage;
                        this.bookTitleImage = '';
                        this.imageLink = '';
                        this.$store.dispatch('delBookTitleImage', {
                            imageName: image,
                        });
                    }
                    this.$refs.upload.clearFiles();
                }

            },
            // deleteImage Drag Drop ends

            myBook(){
                window.location.href = "api/mybook/pages";
                // this.$router.push('api/mybook/pages');
                // this.$store.dispatch('fetchmybook');
            }
        },


        computed: {
            ...mapGetters({
                authUser: 'authUser',
                getChangeStatus: 'getChangeStatus',
                getNameStatus: 'getNameStatus',
                getNewBook: 'getNewBook',
            }),
        },
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
