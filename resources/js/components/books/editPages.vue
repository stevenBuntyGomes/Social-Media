<template>
    <div class = "flex flex-col items-center py-4">
        <div class = "bg-white rounded shadow w-2/3 p-4">
            <div class = "text ml-4 mb-2 font-bold text-base">
                <p>Edit Pages</p>
            </div>
            <div v-for = "(page, pageKey) in getBookPages.data"
            :key = "pageKey"
            class = "justify-between intems-center mb-2">
                <div class = "ml-3 mr-3">
                    <div class = "img_width">
                        <img class = "img_part" :src="page.data.attributes.image" alt="">
                    </div>
                    <Button @click = "addingImage(page, pageKey)">Change Page ({{ pageKey + 1 }})</Button>
                </div>
            </div>
            <div class = "">
                <Button>
                    <router-link :to = "'/book/' + getEditBook.data.attributes.posted_by.data.user_id">
                        Return to Book page
                    </router-link>
                </Button>
                <Button @click = "goToBook">
                    Go To Book
                </Button>
            </div>
        </div>
        <Modal
            v-model="changePage"
            title="Add page"
            :mask-closable = 'false'
            :closable = 'false'>
            <Upload
                v-if = "uploadImage && page"
                ref="upload"
                type="drag"
                :headers= "{'x-csrf-token' : token, 'X-Requested-With' : 'XMLHttpRequest'}"
                :on-success="handleSuccess"
                :format="['jpg','jpeg','png']"
                :max-size="2048"
                :data = "{'index': pageKey, 'book_id': page.data.attributes.book_id, 'book_unique_name': page.data.attributes.book_unique_name}"
                :on-format-error="handleFormatError"
                :on-exceeded-size="handleMaxSize"
                action="/api/mybook/storePages">
                <div style="padding: 20px 0">
                    <Icon type="ios-cloud-upload" size="52" style="color: #3399ff"></Icon>
                    <p>Click or drag files here to upload</p>
                </div>
            </Upload>
            <div v-if = "page" class = "demo-upload-list img_width">
                <img :src="page.data.attributes.image" class = "img_part">
                <div class="demo-upload-list-cover">
                    <Icon type="ios-eye-outline" @click.native="handleView(item.name)"></Icon>
                    <Icon type="ios-trash-outline" @click="deleteImage()"></Icon>
                </div>
            </div>
            <div slot = "footer">
                <button type = "default" @click = "changePage=false">Close</button>
                <button type = "primary" @click = "addImagetoDb" :disabled = "isAdding" :loading="isAdding">Add Image</button>
            </div>
        </Modal>
    </div>
</template>
<script>
import { mapGetters } from 'vuex';

export default {


    data:() =>{
        return{
            data: {
                bookKey: null,
                bookImageName: '',
                bookId: '',
            },
            page: null,
            changePage: false,
            token: '',
            pageKey: null,
            isAdding: false,
            uploadImage: false,
        }
    },


    mounted(){
        this.$store.dispatch('fetchBookPages', {
            bookId: this.getEditBook.data.book_id,
            userId: this.getEditBook.data.attributes.posted_by.data.user_id,
        });
        this.token = document.head.querySelector('meta[name=csrf-token]').content;
    },

    computed: {
        ...mapGetters({
                getEditBook: 'getEditBook',
                getBookPages: 'getBookPages',
                getBookKey: 'getBookKey',
            }),
    },

    methods: {
            addingImage(page, pageKey){

                this.page = page;
                this.pageKey = pageKey;
                this.changePage = true;
                if(this.page.data.attributes.image){
                    this.uploadImage = false;
                }
                // this.i = index;
                // this.data.index = index;
            },

            // adding image to db starts

            addImagetoDb(){
                this.$store.dispatch('editPageDB', {
                    getNewBook: this.page,
                    pageKey: this.pageKey,
                });
                this.changePage = false;
                this.page = null;
                this.pageKey = null;
            },

            // cancelImageModal(){
            //     this.addImage = false;
            //     this.data.imageName = '';
            //     this.data.index = '';
            // },

            // adding image to db ends

            // image Upload starts
            handleSuccess (res, file) {
                if(this.isEditingItem){
                    return this.editData.iconImage = res
                    console.log(res)

                }
                if(this.page){
                    this.page.data.attributes.image_name = res.data.attributes.image_name;
                    this.page.data.attributes.image = res.data.attributes.image_src;
                }

                this.uploadList = false;
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

            // handleError (res, file){
            //     console.log('res', res);
            //     console.log('file', file);
            //     this.$Notice.warning({
            //         title: 'Exceeding file size limit',
            //         desc: `${file.errors.file.length ? file.errors.file[0] : 'something wrong!'}`
            //     });
            // },

            handleView (name) {
                this.imgName = name;
                this.visible = true;
            },
            handleRemove (file) {
                const fileList = this.$refs.upload.fileList;
                this.$refs.upload.fileList.splice(fileList.indexOf(file), 1);
            },

            deleteImage(){
                if(this.page){
                    var image = this.page.data.attributes.image_name;
                    this.page.data.attributes.image_name = '';
                    this.page.data.attributes.image = '';
                }
                this.uploadImage = true;

                this.$store.dispatch('deleteSingleImage', {
                    imageName: image,
                });


                this.$refs.upload.clearFiles();
            },
            // image Upload ends

            // go to books starts
            goToBook(){
                window.location.href = "/api/mybook/pages/" + this.getEditBook.data.book_id;
            }
            // go to books ends
    }
}
</script>
<style scoped>
    .img_width{
        width: 250px;
        height: 250px;
    }

    .img_part{
        width: 100%;
        height: 100%;
        object-fit:contain;
    }
</style>
