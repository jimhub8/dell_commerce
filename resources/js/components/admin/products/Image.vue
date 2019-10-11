<template>
<v-layout row justify-center>
    <v-dialog v-model="dialog" persistent max-width="800px">
        <v-card>
            <v-card-title fixed>
                <span class="headline">Image Update</span>
                <v-spacer></v-spacer>
                <v-btn icon dark @click="close">
                    <v-icon color="black">close</v-icon>
                </v-btn>
            </v-card-title>
            <v-card-text>
                <v-container grid-list-md>
                    <v-layout wrap>
                        <v-form ref="form" @submit.prevent>
                            <v-container grid-list-xl fluid>
                                <v-card>
                                    <v-divider></v-divider>
                                    <v-card-text>
                                        <v-layout row>
                                            <v-flex sm8>
                                                <img :src="avatar" style="width: 100%; height: 200px;">
                                                <v-btn color="red" darken-1 raised @click="onPickFile" style="color: #fff;">Update Image</v-btn>
                                                <input type="file" @change="Getimage" accept="image/*" style="display: none" ref="fileInput">
                                                <v-btn flat @click="cancle" v-show="imagePlaced">Cancle</v-btn>
                                                <v-btn flat @click="upload">Update</v-btn>
                                            </v-flex>
                                            <v-flex sm3 offset-sm-1>
                                                <div v-for="image in images" :key="image.id">
                                                    <img id="image" :src="image.image" :alt="image.id">
                                                    <small style="cursor: pointer; color: red;margin-bottom: 5px;" @click="remove(image.id)">remove</small>
                                                </div>
                                            </v-flex>
                                            <!-- <LightBox :images="images"></LightBox> -->

                                        </v-layout>
                                        <!-- <img :src="avatar" style="width: 100%; height: 200px;" v-show="!actualImage"> -->
                                    </v-card-text>
                                    <!-- <v-card-actions>
                                            <v-btn color="red" darken-1 raised @click="onPickFile" style="color: #fff;">Update Image</v-btn>
                                            <input type="file" @change="Getimage" accept="image/*" style="display: none" ref="fileInput">
                                            <v-btn flat @click="cancle" v-show="imagePlaced">Cancle</v-btn>
                                        </v-card-actions> -->
                                </v-card>
                                <v-card>
                                    <div class="container">
                                        <div class="large-12 medium-12 small-12 filezone">
                                            <input type="file" id="files" ref="files" multiple v-on:change="handleFiles()" />
                                            <p>
                                                Drop your files here <br>or click to search
                                            </p>
                                        </div>

                                        <div v-for="(file, key) in files" class="file-listing">
                                            <img class="preview" v-bind:ref="'preview'+parseInt(key)" />
                                            {{ file.name }}
                                            <div class="success-container" v-if="file.id > 0">
                                                Success
                                            </div>
                                            <div class="remove-container" v-else>
                                                <a class="remove" v-on:click="removeFile(key)">Remove</a>
                                            </div>
                                        </div>
                                        <!-- <v-card-actions>
                                            <v-btn flat color="primary" @click="files=[]" v-show="files.length > 0">clear</v-btn>
                                            <v-spacer></v-spacer>
                                            <a class="submit-button" v-on:click="submitFiles()" v-show="files.length > 0">Submit</a>
                                        </v-card-actions> -->
                                    </div>
                                </v-card>
                            </v-container>
                            <v-card-actions>
                                <v-btn flat @click="close">Close</v-btn>
                                <v-btn flat color="primary" @click="files=[]" v-show="files.length > 0">clear</v-btn>
                                <v-spacer></v-spacer>
                                <v-btn :disabled="loading" :loading="loading" flat color="primary" @click="submitFiles()" v-show="files.length">Submit</v-btn>
                            </v-card-actions>
                        </v-form>
                    </v-layout>
                </v-container>
            </v-card-text>
        </v-card>
    </v-dialog>
</v-layout>
</template>

<script>
// import VueUploadMultipleImage from 'vue-upload-multiple-image'
export default {
    components: {
        // LightBox,/
    },
    data() {
        return {
            errors: {},
            loading: false,
            dialog: false,
            disabled: true,
            avatar: "",
            actualImage: false,
            imagePlaced: false,
            files: [],
            upload_files: [],
            product: [],
            images: [],
            product_id: null,
        };
    },
    methods: {
        submitFiles() {
            this.loading = true
            for (let i = 0; i < this.files.length; i++) {
                if (this.files[i].id) {
                    continue;
                }
                let formData = new FormData();
                formData.append("image", this.files[i]);

                axios
                    .post(`/product_image/${this.product.id}`, formData, {
                        headers: {
                            "Content-Type": "multipart/form-data"
                        }
                    })
                    .then(
                        function (data) {
                            eventBus.$emit('alertRequest', 'updated')
                            this.loading = false
                            console.log(this.files.length, i);
                            console.log(data);
                            this.files[i].id = data["data"]["id"];
                            this.files.splice(i, 1, this.files[i]);
                            this.upload_files.push(data.data);
                            if (this.files.length === i + 1) {
                                this.sendmail();
                            }
                            // console.log('success');
                        }.bind(this)
                    )
                    .catch(function (data) {
                        this.loading = false
                        console.log("error");
                    })
                    .then(response => {
                        this.loading = false
                        // this.sendmail()
                        // console.log(response);
                    });
            }
        },
        getImagePreviews() {
            for (let i = 0; i < this.files.length; i++) {
                if (/\.(jpe?g|png|gif)$/i.test(this.files[i].name)) {
                    let reader = new FileReader();
                    reader.addEventListener(
                        "load",
                        function () {
                            this.$refs["preview" + parseInt(i)][0].src = reader.result;
                        }.bind(this),
                        false
                    );
                    reader.readAsDataURL(this.files[i]);
                } else if (/\.(csv|xls)$/i.test(this.files[i].name)) {
                    this.$nextTick(function () {
                        this.$refs["preview" + parseInt(i)][0].src = "/storage/img/csv.png";
                    });
                } else if (/\.(pdf)$/i.test(this.files[i].name)) {
                    this.$nextTick(function () {
                        this.$refs["preview" + parseInt(i)][0].src = "/storage/img/pdf.png";
                    });
                } else {
                    this.$nextTick(function () {
                        this.$refs["preview" + parseInt(i)][0].src =
                            "/storage/img/file.png";
                    });
                }
            }
        },
        remove(id) {
            if (confirm('Are you sure you want to delete this image?')) {
                this.loading = true
                axios.delete(`/images/${id}`)
                    .then((response) => {
                        // this.images.splice(index, 1)
                        this.getImages()
                        eventBus.$emit("alertRequest", "Successifully Created");
                    })
                    .catch((error) => {
                        this.loading = false
                        if (error.response.status === 500) {
                            eventBus.$emit('errorEvent', error.response.statusText)
                            return
                        }
                        this.errors = error.response.data.errors
                    })
            }
        },
        getImages() {
            axios
                .get(`/images/${this.product_id}`)
                .then(response => {
                    this.images = response.data;
                })
                .catch(error => {
                    if (error.response.status === 500) {
                        eventBus.$emit('errorEvent', error.response.statusText)
                        return
                    }
                    this.errors = error.response.data.errors;
                });
        },
        removeFile(key) {
            this.files.splice(key, 1);
            this.getImagePreviews();
        },
        handleFiles() {
            let uploadedFiles = this.$refs.files.files;

            for (var i = 0; i < uploadedFiles.length; i++) {
                this.files.push(uploadedFiles[i]);
            }
            this.getImagePreviews();
        },
        close() {
            this.actualImage = false;
            this.dialog = false;
        },

        onPickFile() {
            this.$refs.fileInput.click();
        },
        onFilePicked(event) {
            this.imagePlaced = true;
            const files = event.target.files;
            let filename = files[0].name;
            if (filename.lastIndexOf(".") <= 0) {
                return alert("please upload a valid image");
            }
            const fileReader = new FileReader();
            fileReader.addEventListener("load", () => {
                this.avatar = fileReader.result;
            });
            fileReader.readAsDataURL(files[0]);
            this.image = files[0];
        },
        Getimage(e) {
            let image = e.target.files[0];
            // this.read(image);
            let reader = new FileReader();
            reader.readAsDataURL(image);
            reader.onload = e => {
                this.avatar = e.target.result;
            };
            this.imagePlaced = true;
            let form = new FormData();
            form.append("image", image);
            this.file = form;
            console.log(e.target.files);
        },

        cancle() {
            this.avatar = this.product.image;
            this.imagePlaced = false;
        },

        upload() {
            this.loading = true;
            axios
                .post(`/proImg/${this.product_id}`, this.file)
                .then(response => {
                    this.loading = false;
                    // console.log(response);
                    this.imagePlaced = false;
                    this.color = "black";
                    this.text = "Product image updated";
                    this.snackbar = true;
                    // this.close()
                })
                .catch(error => {
                    this.loading = false;
                    this.errors = error.response.data.errors;
                });
        },
    },
    created() {
        eventBus.$on("imageEvent", data => {
            this.product = data;
            this.avatar = data.image;
            this.dialog = true;
            this.product_id = data.id
            this.getImages()
        });
    }
};
</script>

<style scoped>
input[type="file"] {
    opacity: 0;
    width: 100%;
    height: 200px;
    position: absolute;
    cursor: pointer;
}

.filezone {
    outline: 2px dashed grey;
    outline-offset: -10px;
    background: #ccc;
    color: dimgray;
    padding: 10px 10px;
    min-height: 200px;
    position: relative;
    cursor: pointer;
}

.filezone:hover {
    background: #c0c0c0;
}

.filezone p {
    font-size: 1.2em;
    text-align: center;
    padding: 50px 50px 50px 50px;
}

div.file-listing img {
    max-width: 90%;
}

div.file-listing {
    margin: auto;
    padding: 10px;
    border-bottom: 1px solid #ddd;
}

div.file-listing img {
    height: 100px;
}

div.success-container {
    text-align: center;
    color: green;
}

div.remove-container {
    text-align: center;
}

div.remove-container a {
    color: red;
    cursor: pointer;
}

a.submit-button {
    display: block;
    margin: auto;
    text-align: center;
    width: 200px;
    padding: 10px;
    text-transform: uppercase;
    background-color: #ccc;
    color: white;
    font-weight: bold;
    margin-top: 20px;
}

#image {
    width: 90%;
    height: 150px;
}
</style>
