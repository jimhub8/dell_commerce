<template>
<v-layout row justify-center>
    <v-dialog v-model="openAddRequest" persistent max-width="1200px">
        <v-card>
            <v-card-title fixed class="text-center">
                <span class="headline">Add a product</span>
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
                                <v-layout wrap>
                                    <v-flex xs12 sm6>
                                        <v-select :items="categories" v-model="CatSelect" label="Select category" single-line item-text="name" item-value="id" return-object persistent-hint @change="changeCat(CatSelect)"></v-select>
                                        <small class="has-text-danger" v-if="errors.category">{{ errors.category[0] }}</small>
                                    </v-flex>
                                    <v-flex xs12 sm6>
                                        <v-select :items="subcategories" v-model="subCatSelect" label="Select Subcategory" single-line item-text="name" item-value="id" return-object persistent-hint></v-select>
                                        <!-- <label for="">Brand</label>
                                        <el-select v-model="form.subCatSelect" clearable placeholder="Select Brand">
                                            <el-option v-for="sub_cat in subcategories" :key="sub_cat.value" :label="sub_cat.label" :value="sub_cat.value">
                                            </el-option>
                                        </el-select> -->
                                        <small class="has-text-danger" v-if="errors.subCategory">{{ errors.subCategory[0] }}</small>
                                    </v-flex>
                                    <v-flex xs12 sm6>
                                        <v-text-field v-model="form.name" color="blue darken-2" label="Product Name" required></v-text-field>
                                        <small class="has-text-danger" v-if="errors.name">{{ errors.name[0] }}</small>
                                    </v-flex>
                                    <v-flex xs12 sm6>
                                        <v-text-field v-model="form.sku_no" color="blue darken-2" label="Sku Number" required></v-text-field>
                                        <small class="has-text-danger" v-if="errors.sku_no">{{ errors.sku_no[0] }}</small>
                                    </v-flex>
                                    <v-flex sm6>
                                        <label for="">Brand</label>
                                        <el-select v-model="form.brand" clearable placeholder="Select Brand">
                                            <el-option v-for="item in brands" :key="item.value" :label="item.label" :value="item.value">
                                            </el-option>
                                        </el-select>
                                    </v-flex>
                                    <v-switch v-model="inc_size" class="mt-0" color="primary lighten-2" hide-details label="Include Sizes"></v-switch>
                                    <v-flex xs12 sm6 v-if="inc_size">
                                        <v-select :items="sizes" v-model="sizeSelect" label="Select Sizes" single-line item-text="name" item-value="id" return-object persistent-hint></v-select>
                                        <!-- <small class="has-text-danger" v-if="errors.category">{{ errors.category[0] }}</small> -->
                                    </v-flex>
                                    <v-flex xs12 sm12>
                                        <v-textarea v-model="form.description" color="blue">
                                            <div slot="label">
                                                Special Instructions <small>(optional)</small>
                                            </div>
                                        </v-textarea>
                                    </v-flex>
                                    <ckeditor :editor="editor" v-model="form.editorData" :config="editorConfig"></ckeditor>
                                    <br>
                                    <VDivider />

                                    <h4>Provide initial values to set up your product with:</h4>
                                    <v-flex xs12 sm6>
                                        <v-text-field v-model="form.quantity" color="blue darken-2" label="Quantity" required></v-text-field>
                                        <small class="has-text-danger" v-if="errors.quantity">{{ errors.quantity[0] }}</small>
                                    </v-flex>
                                    <VDivider />

                                    <v-flex xs12 sm6>
                                        <v-text-field v-model="form.price" color="blue darken-2" label="Price" required></v-text-field>
                                        <small class="has-text-danger" v-if="errors.price">{{ errors.price[0] }}</small>
                                    </v-flex>
                                    <v-flex xs12 sm6>
                                        <v-text-field v-model="form.list_price" color="blue darken-2" label="List Price"></v-text-field>
                                    </v-flex>
                                </v-layout>
                                <v-layout row wrap>
                                    <h3>Product Variants</h3>
                                    <p>A single variant will be created automatically unless you enable the multiple variant option.</p>
                                </v-layout>
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <th>VARIANT OPTION</th>
                                        <th>OPTION VALUES</th>
                                        <th>ACTION</th>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(varient_a, index) in varient_all" :key="index">
                                            <td>
                                                <el-select v-model="varient_a.varient_opt" filterable clearable placeholder="Select">
                                                    <el-option v-for="item in variants" :key="item.value" :label="item.title" :value="item.id">
                                                    </el-option>
                                                </el-select>
                                            </td>
                                            <td>
                                                <v-combobox v-model="varient_a.options_val" :filter="filter" :hide-no-data="!search" :items="items" :search-input.sync="search" hide-selected label="Search for an option" multiple small-chips solo>
                                                    <template v-slot:no-data>
                                                        <v-list-tile>
                                                            <span class="subheading">Create</span>
                                                            <v-chip :color="`${colors[nonce - 1]} lighten-3`" label small>
                                                                {{ search }}
                                                            </v-chip>
                                                        </v-list-tile>
                                                    </template>
                                                    <template v-slot:selection="{ item, parent, selected }">
                                                        <v-chip v-if="item === Object(item)" :color="`${item.color} lighten-3`" :selected="selected" label small>
                                                            <span class="pr-2">
                                                                {{ item.text }}
                                                            </span>
                                                            <v-icon small @click="parent.selectItem(item)">close</v-icon>
                                                        </v-chip>
                                                    </template>
                                                    <template v-slot:item="{ index, item }">
                                                        <v-list-tile-content>
                                                            <v-text-field v-if="editing === item" v-model="editing.text" autofocus flat background-color="transparent" hide-details solo @keyup.enter="edit(index, item)"></v-text-field>
                                                            <v-chip v-else :color="`${item.color} lighten-3`" dark label small>
                                                                {{ item.text }}
                                                            </v-chip>
                                                        </v-list-tile-content>
                                                        <v-spacer></v-spacer>
                                                        <v-list-tile-action @click.stop>
                                                            <v-btn icon @click.stop.prevent="edit(index, item)">
                                                                <v-icon>{{ editing !== item ? 'edit' : 'check' }}</v-icon>
                                                            </v-btn>
                                                        </v-list-tile-action>
                                                    </template>
                                                </v-combobox>
                                            </td>
                                            <td>
                                                <v-tooltip bottom>
                                                    <v-btn slot="activator" icon class="mx-0" @click="removeItem(index)">
                                                        <v-icon small color="pink darken-2">delete</v-icon>
                                                    </v-btn>
                                                    <span>Remove</span>
                                                </v-tooltip>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <v-btn color="info" @click="addNew">Add another option</v-btn>
                                <v-card>
                                    <!-- <img :src="avatar" style="width: 100px; height: 100px; border-radius: 50%; text-align:center; margin-top 70px;margin-left-100px"> -->
                                    <v-divider></v-divider>
                                    <img v-show="imagePlaced" :src="avatar" style="width: 200px; height: 200px;">
                                    <v-btn color="red" darken-1 raised @click="onPickFile" style="color: #fff;">Upload</v-btn>
                                    <input type="file" @change="Getimage" accept="image/*" style="display: none" ref="fileInput">
                                    <v-btn @click="upload" flat v-show="imagePlaced" :loading="loading" :disabled="loading">Upload</v-btn>
                                    <v-btn @click="cancle" flat v-show="imagePlaced">Cancel</v-btn>
                                </v-card>
                            </v-container>
                            <v-card-actions>
                                <v-btn flat @click="resetForm">reset</v-btn>
                                <v-btn flat @click="close">Close</v-btn>
                                <v-spacer></v-spacer>
                                <v-btn :disabled="loading" :loading="loading" flat color="primary" @click="save">Submit</v-btn>
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
import ClassicEditor from "@ckeditor/ckeditor5-build-classic";
export default {
    props: ["openAddRequest", "categories"],
    components: {},
    data() {
        const defaultForm = Object.freeze({
            name: "",
            quantity: "",
            list_price: "",
            price: "",
            description: "",
            subCategory: null,
            category: null,
            editorData: "",
            size: ""
        });
        return {
            isUpdating: false,
            brands: [],
            errors: {},
            inc_size: false,
            defaultForm,
            loading: false,
            disabled: true,
            form: Object.assign({}, defaultForm),
            rules: {
                name: [val => (val || "").length > 0 || "This field is required"]
            },
            sizeSelect: [],
            sizes: [],
            subcategories: [],
            variants: [],
            CatSelect: [],
            subCatSelect: [],
            avatar: "",
            imagePlaced: false,

            editor: ClassicEditor,
            editorConfig: {
                // The configuration of the editor.
                // toolbar: [ 'bold', 'italic' ]
            },
            varient_all: [],

            activator: null,
            attach: null,
            colors: ['red', 'purple', 'indigo', 'cyan', 'teal', 'orange'],
            editing: null,
            index: -1,
            items: [
                { header: 'Select an option or create one' },
            ],
            nonce: 1,
            menu: false,
            model: [],
            search: null,
        };
    },
    methods: {
        emptyEditor() {
            this.editorData = "";
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
            let img_arr = [];
            form.append("image", image);
            this.file = form;
            this.img_arr = form.push("image", image);
            console.log(img_arr);
            console.log(e.target.files);
        },

        upload(item) {
            console.log(item);
            this.loading = true;
            axios
                .post(`/proImg/${item.id}`, this.file)
                .then(response => {
                    this.loading = false;
                    // console.log(response);
                    this.imagePlaced = false;
                    this.color = "black";
                    this.text = "Profile image updated";
                    this.snackbar = true;
                    // this.close()
                })
                .catch(error => {
                    this.loading = false;
                    this.errors = error.response.data.errors;
                });
        },

        cancle() {
            this.avatar = this.LogedUser.profile;
            this.imagePlaced = false;
        },
        save() {
            this.loading = true;
            this.form.category = this.CatSelect.id;
            this.form.subCategory = this.subCatSelect.id;
            if (this.inc_size) {
                this.form.size = this.sizeSelect.id;
            }
            axios
                .post("/products", this.$data.form)
                .then(response => {
                    this.loading = false;
                    console.log(response.data);
                    // this.resetForm();
                    this.upload(response.data);
                    eventBus.$emit("alertRequest", "Successifully Created");
                    this.$parent.products.push(response.data);
                    this.close();
                })
                .catch(error => {
                    this.loading = false;
                    if (error.response.status === 500) {
                        eventBus.$emit("errorEvent", error.response.statusText);
                        return;
                    }
                    this.errors = error.response.data.errors;
                });
        },
        resetForm() {
            this.form = Object.assign({}, this.defaultForm);
            this.$refs.form.reset();
        },
        close() {
            this.$emit("closeRequest");
        },

        changeCat(item) {
            this.subcategories = item.sub_categories;
        },

        getSize() {
            this.loader = true;
            axios
                .get("/sizes")
                .then(response => {
                    this.loader = false;
                    this.sizes = response.data;
                })
                .catch(error => {
                    this.loader = false;
                    this.errors = error.response.data.errors;
                });
        },

        getVariant() {
            this.loader = true;
            axios
                .get("/variants")
                .then(response => {
                    this.loader = false;
                    this.variants = response.data;
                })
                .catch(error => {
                    this.loader = false;
                    this.errors = error.response.data.errors;
                });
        },
        edit(index, item) {
            if (!this.editing) {
                this.editing = item
                this.index = index
            } else {
                this.editing = null
                this.index = -1
            }
        },
        filter(item, queryText, itemText) {
            if (item.header) return false

            const hasValue = val => val != null ? val : ''

            const text = hasValue(itemText)
            const query = hasValue(queryText)

            return text.toString()
                .toLowerCase()
                .indexOf(query.toString().toLowerCase()) > -1
        },
        removeItem() {

        },

        addNew() {
            this.varient_all.push({
                options_val: '',
                varient_opt: '',
            })
        }
    },
    mounted() {
        this.getSize();
        this.getVariant();
    },
    watch: {
        model(val, prev) {
            if (val.length === prev.length) return

            this.model = val.map(v => {
                if (typeof v === 'string') {
                    v = {
                        text: v,
                        color: this.colors[this.nonce - 1]
                    }

                    this.items.push(v)

                    this.nonce++
                }

                return v
            })
        }
    },

};
</script>
