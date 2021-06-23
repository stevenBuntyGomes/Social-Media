<template>
    <div class = "flex flex-col items-center py-4">
        <div class = "bg-white rounded shadow w-2/3 p-4">
            <div class = "text ml-4 mb-2 font-bold text-base">
                <p>Add Pages ({{ pageNo }})</p>
            </div>
            <div v-for = "(n, index) in pageNo"
            :key = "index"
            class = "justify-between intems-center">
                <div class = "ml-3 mr-3">
                    <Button @click = "addingImage(getNewBook, n)">Add Page ({{ n }})</Button>
                    <input type = "text" name = "body"
                    class = "w-full pl-4 h-8 bg-gray-200 rounded-full focus:outline-none focus:shadow-outline text-sm"
                    placeholder = "Book Name">
                </div>
            </div>
        </div>
        <Modal
            v-model="addImage"
            title="Add page"
            :mask-closable = 'false'
            :closable = 'false'>
            <Upload
                ref="upload"
                type="drag"
                :headers= "{'x-csrf-token' : token, 'X-Requested-With' : 'XMLHttpRequest'}"
                :on-success="handleSuccess"
                :format="['jpg','jpeg','png']"
                :max-size="2048"
                :data = "{'index' : i, 'book_id' : getNewBook.data.book_id, 'book_unique_name': getNewBook.data.attributes.book_unique_name}"
                :on-format-error="handleFormatError"
                :on-exceeded-size="handleMaxSize"
                action="/api/mybook/storePages">
                <div style="padding: 20px 0">
                    <Icon type="ios-cloud-upload" size="52" style="color: #3399ff"></Icon>
                    <p>Click or drag files here to upload</p>
                </div>
            </Upload>
            <div class = "demo-upload-list" v-if = "data.imageName">
                <img :src="data.image_link">
                <div class="demo-upload-list-cover">
                    <Icon type="ios-eye-outline" @click.native="handleView(item.name)"></Icon>
                    <Icon type="ios-trash-outline" @click="deleteImage()"></Icon>
                </div>
            </div>
            <div slot = "footer">
                <button type = "default" @click = "addImage=false">Close</button>
                <button type = "primary" @click = "addImagetoDb" :disabled = "isAdding" :loading="isAdding">Add Image</button>
            </div>
        </Modal>
    </div>
</template>
<script type="text/javascript">
    import {mapGetters} from 'vuex'


    export default {
        data: () => {
            return {
                i: -1,
                pageNo: null,
                dropzone: null,
                addImage: false,
                token: '',
                data: {
                    imageName: '',
                    index: -1,
                    image_link: '',
                },
                isEditingItem: false,
                isAdding: false,
                isIconImageNew: false,
                uploadList: false,
            }
        },


        mounted(){
            this.token = document.head.querySelector('meta[name=csrf-token]').content;
            this.pageNo = parseInt(this.$route.params.bookPage);
        },

        computed: {
            ...mapGetters({
                authUser: 'authUser',
                getNewBook: 'getNewBook',
            }),
        },


        methods: {

            addingImage(getNewBook, index){
                this.addImage = true;
                this.i = index;
                this.data.index = index;
            },

            // adding image to db starts

            addImagetoDb(){
                this.$store.dispatch('addPageDB', {
                    getNewBook: this.getNewBook,
                    pageData: this.data,
                });
                this.addImage = false;
                this.data.imageName = '';
                this.data.image_link = '';
                this.data.index = -1;
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
                this.data.imageName = res.data.attributes.image_name;
                this.data.image_link = res.data.attributes.image_src;
                this.uploadList = true;


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

            deleteImage(isAdd=true){
                if(!isAdd){//for editingIconImage
                    this.isIconImageNew = true;
                    var image = this.data.imageName;
                    this.data.imageName = '';
                    this.$this.$refs.upload.clearFiles();
                }else{
                    var image = this.data.imageName;
                    this.data.imageName = '';
                    this.data.image_link = '';
                    this.$refs.upload.clearFiles();
                }
                this.$store.dispatch('deleteSingleImage', {
                    imageName: image,
                });
            },
            // image Upload ends
        },

    }

</script>
<style scoped>
</style>
