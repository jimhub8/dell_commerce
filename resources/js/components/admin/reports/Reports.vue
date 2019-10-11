<template>
<v-content>
    <div v-show="loader" style="text-align: center">
        <v-progress-circular :width="3" indeterminate color="blue" style="margin: 1rem"></v-progress-circular>
    </div>
    <v-container fluid fill-height v-show="!loader">
        <!-- <div> -->
        <v-layout justify-center align-center>
            <!-- <v-layout row>
                <v-flex xs6 sm6>
                </v-flex>
            </v-layout> -->
            <v-layout wrap>
                <v-flex xs4 sm4 style="margin-top: 40px;">
                    <v-card>
                        <h1>Vendor Reports</h1>
                        <hr>
                        <!-- <form action="userDateExpo" method="post"> -->
                        <label for="">vendor</label>
                        <option value=""></option>
                        <select class="custom-select custom-select-md col-md-12 col-md-12" v-model="vendor.vendor_id" style="font-size: 
                        13px;">
                            <option v-for="vendor in Allvendors" :value="vendor.id" :key="vendor.id">{{ vendor.company_name }}</option>
                        </select> Between
                        <hr>
                        <v-flex xs12 sm12>
                            <v-text-field v-model="vendor.start_date" label="start date" type="date" color="blue darken-2" required></v-text-field>
                        </v-flex>
                        <v-flex xs12 sm12>
                            <v-text-field v-model="vendor.end_date" label="End Date" type="date" color="blue darken-2" required></v-text-field>
                        </v-flex>
                        <v-card-actions>
                            <v-btn flat @click="VendorReport" :loading="Vload" :disabled="Vload" success color="black">Get Data</v-btn>
                            <v-spacer></v-spacer>
                            <v-btn flat color="orange">{{ AllVendorR.length }} </v-btn>
                        </v-card-actions>
                        <v-divider></v-divider>
                        <download-excel :data="AllVendorR" :fields="json_fields" v-show="Cdown">
                            Export
                            <img src="/storage/csv.png" style="width: 30px; height: 30px; cursor: pointer;">
                        </download-excel>
                            <!-- </form> -->
                    </v-card>
                </v-flex>

                <!-- <v-divider vertical></v-divider> -->
                <v-flex xs4 sm4 style="margin-top: 40px;">
                    <v-card>
                        <h1>Sales Reports</h1>
                        <hr>
                        <div>
                            <label for="">Sales</label>
                            <select v-model="salesR.sale" class="custom-select custom-select-md col-md-12">
                                <option value=""></option>
                                <option v-for="sale in Allvendors" :key="sale.id" :value="sale.id">{{ sale.company_name }}</option>
                            </select>
                        </div>
                        <hr>
                        <v-flex xs12 sm12>
                            <v-text-field v-model="salesR.start_date" label="start date" type="date" color="blue darken-2" required></v-text-field>
                        </v-flex>
                        <v-flex xs12 sm12>
                            <v-text-field v-model="salesR.end_date" label="End Date" type="date" color="blue darken-2" required></v-text-field>
                        </v-flex>
                        <v-card-actions>
                            <v-btn flat @click="sales" :loading="Sload" :disabled="Sload" success color="black">Get Data</v-btn>
                            <v-spacer></v-spacer>
                            <v-btn flat color="orange">{{ AllSales.length }} </v-btn>
                        </v-card-actions>
                        <download-excel :data="AllSales" :fields="json_fields" v-show="Sdown">
                            Export
                            <img src="/storage/csv.png" style="width: 30px; height: 30px; cursor: pointer;">
                        </download-excel>
                            <v-divider></v-divider>
                    </v-card>
                </v-flex>

                <v-flex xs4 sm4 style="margin-top: 40px;">
                    <v-card>
                        <h1>Branch Reports</h1>
                        <hr>
                        <!-- <form action="DriverReport" method="post"> -->
                        <div>
                            <label for="">Sales</label>
                            <select v-model="branchStatus.sale" class="custom-select custom-select-md col-md-12">
                                    <option value=""></option>
                                    <option v-for="sale in sales" :key="sale.id" :value="sale.name">{{ sale.name }}</option>
                                </select>
                        </div>
                        <label for="">Branch</label>
                        <select class="custom-select custom-select-md col-md-12" v-model="branchR.branch_id">
                            <option value=""></option>
                            <option v-for="branch in AllBranches" :key="branch.id" :value="branch.id">{{ branch.branch_name }}</option>
                        </select> Between
                        <hr>
                        <v-flex xs12 sm12>
                            <v-text-field v-model="branchR.start_date" label="start date" type="date" color="blue darken-2" required></v-text-field>
                        </v-flex>
                        <v-flex xs12 sm12>
                            <v-text-field v-model="branchR.end_date" label="End Date" type="date" color="blue darken-2" required></v-text-field>
                        </v-flex>
                        <v-card-actions>
                            <v-btn flat @click="AllbranchR" :loading="Bload" :disabled="Bload" success color="black">Get Data</v-btn>
                            <v-spacer></v-spacer>
                            <v-btn flat color="orange">{{ AllBranchD.length }} </v-btn>
                        </v-card-actions>
                        <v-divider></v-divider>
                        <download-excel :data="AllBranchD" :fields="json_fields" v-show="Bdown">
                            Export
                            <img src="/storage/csv.png" style="width: 30px; height: 30px; cursor: pointer;">
                        </download-excel>
                            <!-- </form> -->
                    </v-card>
                </v-flex>
                <!-- <v-divider vertical></v-divider> -->
                <v-flex xs4 sm4 style="margin-top: 40px;">
                    <v-card>
                        <h1>Rider Reports</h1>
                        <hr>
                        <!-- <form action="DriverReport" method="post"> -->
                        <label for="">Rider</label>
                        <select class="custom-select custom-select-md col-md-12" v-model="Rinder.rinder_id">
                                    <option value=""></option>
                                    <option v-for="driver in AllDrivers" :key="driver.id" :value="driver.id">{{ driver.name }}</option>
                                </select> Between
                        <hr>
                        <v-flex xs12 sm12>
                            <v-text-field v-model="Rinder.start_date" label="start date" type="date" color="blue darken-2" required></v-text-field>
                        </v-flex>
                        <v-flex xs12 sm12>
                            <v-text-field v-model="Rinder.end_date" label="End Date" type="date" color="blue darken-2" required></v-text-field>
                        </v-flex>
                        <v-card-actions>
                            <v-btn flat @click="AllRinderR" :loading="Rload" :disabled="Rload" success color="black">Get Data</v-btn>
                            <v-spacer></v-spacer>
                            <v-btn flat color="orange">{{ AllRinder.length }} </v-btn>
                        </v-card-actions>
                        <v-divider></v-divider>
                        <download-excel :data="AllRinder" :fields="json_fields" v-show="Rdown">
                            Export
                            <img src="/storage/csv.png" style="width: 30px; height: 30px; cursor: pointer;">
                        </download-excel>
                            <!-- </form> -->
                    </v-card>
                </v-flex>
                <v-flex xs4 sm4 style="margin-top: 40px;">
                    <v-card>
                        <h1>Delivery Reports</h1>
                        <hr>
                        <!-- <form action="DriverReport" method="post"> -->
                        <label for="">Status</label>
                        <select v-model="DeliveryR.sale" class="custom-select custom-select-md col-md-12">
                            <option value=""></option>
                            <option v-for="sale in sales" :key="sale.id" :value="sale.name">{{ sale.name }}</option>
                        </select>

                        <label for="">Branch</label>
                        <select class="custom-select custom-select-md col-md-12" v-model="DeliveryR.branch_id">
                            <option value=""></option>
                            <option v-for="branch in AllBranches" :key="branch.id" :value="branch.id">{{ branch.branch_name }}</option>
                        </select> Between
                        <hr>
                        <h2>Delivery Date Between:</h2>

                        <hr>
                        <v-layout wrap>
                            <v-flex xs12 sm5>
                                <v-text-field v-model="DeliveryR.start_date" label="start date" type="date" color="blue darken-2" required></v-text-field>
                            </v-flex>
                            <v-flex xs12 sm6 offset-sm-1>
                                <v-text-field v-model="DeliveryR.end_date" label="End Date" type="date" color="blue darken-2" required></v-text-field>
                            </v-flex>
                        </v-layout>
                        <h2>Upload Date Between:</h2>
                        <hr>
                        <v-layout wrap>
                            <v-flex xs12 sm6>
                                <v-text-field v-model="DeliveryR.Upstart_date" label="start date" type="date" color="blue darken-2" required></v-text-field>
                            </v-flex>
                            <v-flex xs12 sm6>
                                <v-text-field v-model="DeliveryR.Upend_date" label="End Date" type="date" color="blue darken-2" required></v-text-field>
                            </v-flex>
                        </v-layout>
                        <v-card-actions>
                            <v-btn flat @click="AllDeliveryRR" :loading="Dload" :disabled="Dload" success color="black">Get Data</v-btn>
                            <v-spacer></v-spacer>
                            <v-btn flat color="orange">{{ AllDeliveryR.length }} </v-btn>
                        </v-card-actions>
                        <v-divider></v-divider>
                        <download-excel :data="AllDeliveryR" :fields="json_fields" v-show="Ddown">
                            Export
                            <img src="/storage/csv.png" style="width: 30px; height: 30px; cursor: pointer;">
                        </download-excel>
                            <!-- </form> -->
                            <v-snackbar :timeout="timeout" bottom="bottom" :color="color" left="left" v-model="snackbar">
                                {{ message }}
                                <v-icon dark right>check_circle</v-icon>
                            </v-snackbar>
                    </v-card>
                </v-flex>

                <v-flex xs4 sm4 style="margin-top: 40px;">
                    <v-card>
                        <h1>Product Reports</h1>
                        <hr>
                        <!-- <form action="DriverReport" method="post"> -->
                        <label for="">Status</label>
                        <v-flex xs12 sm12>
                            <v-text-field v-model="ProdR.email" color="blue darken-2" label="Product email" required></v-text-field>
                        </v-flex>
                        <select v-model="ProdR.sale" class="custom-select custom-select-md col-md-12">
                            <option value=""></option>
                            <option v-for="sale in sales" :key="sale.id" :value="sale.name">{{ sale.name }}</option>
                        </select>
                        Delivery Date Between:
                        <hr>
                        <v-flex xs12 sm12>
                            <v-text-field v-model="ProdR.start_date" label="start date" type="date" color="blue darken-2" required></v-text-field>
                        </v-flex>
                        <v-flex xs12 sm12>
                            <v-text-field v-model="ProdR.end_date" label="End Date" type="date" color="blue darken-2" required></v-text-field>
                        </v-flex>
                        <v-card-actions>
                            <v-btn flat @click="AllProdR" :loading="Pload" :disabled="Pload" success color="black">Get Data</v-btn>
                            <v-spacer></v-spacer>
                            <v-btn flat color="orange">{{ AllProd.length }} </v-btn>
                        </v-card-actions>
                        <v-divider></v-divider>
                        <download-excel :data="AllProd" :fields="json_fields" v-show="Pdown">
                            Export
                            <img src="/storage/csv.png" style="width: 30px; height: 30px; cursor: pointer;">
                        </download-excel>
                            <!-- </form> -->
                            <v-snackbar :timeout="timeout" bottom="bottom" :color="color" left="left" v-model="snackbar">
                                {{ message }}
                                <v-icon dark right>check_circle</v-icon>
                            </v-snackbar>
                    </v-card>
                </v-flex>
            </v-layout>
        </v-layout>

        <!-- </div> -->
    </v-container>
</v-content>
</template>

<script>
export default {
    data() {
        return {
            AllProd: [],
            ProdR: {},
            Allvendors: [],
            AllDrivers: [],
            salesR: {},
            statusD: {},
            vendor: {},
            DeliveryR: {
                branch_id: ""
            },
            Rinder: {},
            branchStatus: {},
            AllBranches: [],
            AllSales: [],
            AllVendorR: [],
            AllRinder: [],
            branchRD: {},
            branchR: {},
            AllBranchD: [],
            AllDeliveryR: [],
            Allsales: [],
            loader: false,
            Sload: false,
            Vload: false,
            Bload: false,
            Dload: false,
            Rload: false,
            Cdown: false,
            Bdown: false,
            Sdown: false,
            Pdown: false,
            Ddown: false,
            Pload: false,
            Rdown: false,
            snackbar: false,
            timeout: 5000,
            message: "Success",
            color: "black",
            json_fields: {
                "Product name": "product_name",
                "Client Name": "name",
                "Client Address": "address",
                "Payment id": "payment_id",
                "Payment Status": "sale",
                "Delivered": "delivered",
                "Date Ordered": "created_at",
                "vendor Name": "vendor_name",
                "vendor Email": "vendor_email",
                "vendor Phone": "vendor_phone",
                "Quantity": "quantity",
                "List Price": "list_price",
                "Price": "price",
            }
        };
    },
    methods: {
        VendorReport() {
            eventBus.$emit("progressEvent");
            this.Vload = true;
            this.AllVendorR = [];
            axios
                .post("/vendorProduct", this.$data.vendor)
                .then(response => {
                    this.Vload = false;
                    this.AllVendorR = response.data;
                    if (this.AllVendorR.length < 1) {
                        this.message = "no data";
                        this.color = "red";
                        this.snackbar = true;
                        this.Cdown = false;
                    } else {
                        this.Cdown = true;
                        this.message = "success";
                        this.color = "black";
                        this.snackbar = true;
                    }
                    eventBus.$emit("StoprogEvent");
                })
                .catch(error => {
                    eventBus.$emit("StoprogEvent");
                    this.Vload = false;
                    this.errors = error.response.data.errors;
                });
        },

        sales() {
            eventBus.$emit("progressEvent");
            this.Sload = true;
            this.AllSales = [];
            axios
                .post("/sales", this.$data.salesR)
                .then(response => {
                    this.Sload = false;
                    this.AllSales = response.data;
                    // console.log(response.data)
                    if (this.AllSales.length < 1) {
                        this.message = "no data";
                        this.color = "red";
                        this.snackbar = true;
                        this.Sdown = false;
                    } else {
                        this.Sdown = true;
                        this.message = "success";
                        this.color = "black";
                        this.snackbar = true;
                    }
                    eventBus.$emit("StoprogEvent");
                })
                .catch(error => {
                    eventBus.$emit("StoprogEvent");
                    this.Sload = false;
                    this.errors = error.response.data.errors;
                });
        },

        AllRinderR() {
            eventBus.$emit("progressEvent");
            this.Rload = true;
            this.AllRinder = [];
            axios
                .post("/DriverReport", this.$data.Rinder)
                .then(response => {
                    this.Rload = false;
                    this.AllRinder = response.data;
                    if (this.AllRinder.length < 1) {
                        this.message = "no data";
                        this.color = "red";
                        this.snackbar = true;
                        this.Rdown = false;
                    } else {
                        this.Rdown = true;
                        this.message = "success";
                        this.color = "black";
                        this.snackbar = true;
                    }
                    eventBus.$emit("StoprogEvent");
                })
                .catch(error => {
                    eventBus.$emit("StoprogEvent");
                    this.Rload = false;
                    this.errors = error.response.data.errors;
                });
        },

        AllProdR() {
            eventBus.$emit("progressEvent");
            this.Pload = true;
            // this.AllProd = []
            axios
                .post("/ProdReport", this.$data.ProdR)
                .then(response => {
                    this.Pload = false;
                    this.AllProd = response.data;
                    if (this.AllProd.length < 1) {
                        this.message = "no data";
                        this.color = "red";
                        this.snackbar = true;
                        this.Pdown = false;
                    } else {
                        this.Pdown = true;
                        this.message = "success";
                        this.color = "black";
                        this.snackbar = true;
                    }
                    eventBus.$emit("StoprogEvent");
                })
                .catch(error => {
                    eventBus.$emit("StoprogEvent");
                    this.Rload = false;
                    this.errors = error.response.data.errors;
                });
        },
        AllDeliveryRR() {
            eventBus.$emit("progressEvent");
            this.Dload = true;
            this.AllDeliveryR = [];
            axios
                .post("/DelivReport", this.$data.DeliveryR)
                .then(response => {
                    this.Dload = false;
                    this.AllDeliveryR = response.data;
                    if (this.AllDeliveryR.length < 1) {
                        this.message = "no data";
                        this.color = "red";
                        this.snackbar = true;
                        this.Ddown = false;
                    } else {
                        this.Ddown = true;
                        this.message = "success";
                        this.color = "black";
                        this.snackbar = true;
                    }
                    eventBus.$emit("StoprogEvent");
                })
                .catch(error => {
                    eventBus.$emit("StoprogEvent");
                    this.Rload = false;
                    this.errors = error.response.data.errors;
                });
        },
        AllbranchR() {
            eventBus.$emit("progressEvent");
            this.Bload = true;
            this.AllBranchD = [];
            axios
                .post("/branchesExpo", {
                    branch: this.$data.branchR,
                    branch_status: this.$data.branchStatus
                })
                .then(response => {
                    this.Bload = false;
                    this.AllBranchD = response.data;
                    if (this.AllBranchD.length < 1) {
                        this.message = "no data";
                        this.color = "red";
                        this.snackbar = true;
                        this.Bdown = false;
                    } else {
                        this.Bdown = true;
                        this.message = "success";
                        this.color = "black";
                        this.snackbar = true;
                        this.AllBranchD = response.data;
                    }
                    eventBus.$emit("StoprogEvent");
                })
                .catch(error => {
                    eventBus.$emit("StoprogEvent");
                    this.Bload = false;
                    this.errors = error.response.data.errors;
                });
        }
    },
    mounted() {
        this.loader = true;

        axios
            .get("/companies")
            .then(response => {
                this.Allvendors = response.data;
            })
            .catch(error => {
                this.errors = error.response.data.errors;
            });

        axios
            .get("/getDrivers")
            .then(response => {
                this.AllDrivers = response.data;
                this.loader = false;
            })

            .catch(error => {
                this.loader = false;
                this.errors = error.response.data.errors;
            });

        axios
            .get("/getBranch")
            .then(response => {
                this.AllBranches = response.data;
                this.loader = false;
            })

            .catch(error => {
                this.loader = false;
                this.errors = error.response.data.errors;
            });

        axios
            .get("/getStatuses")
            .then(response => {
                this.Allsales = response.data;
            })
            .catch(error => {
                this.errors = error.response.data.errors;
            });
    }
};
</script>

<style scoped>
.theme--light.v-card {
    background-color: rgba(158, 158, 158, 0.08);
    height: 550px;
}
</style>
