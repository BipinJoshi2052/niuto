<template>
<div>
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        <div class="col-lg-12 col-xl-12">
                            <div class="card card-custom gutter-b bg-transparent shadow-none border-0">
                                <div class="card-header align-items-center  border-bottom-dark px-0">
                                    <div class="card-title mb-0">
                                        <h3 class="card-label mb-0 font-weight-bold text-body">
                                            Add Stock
                                        </h3>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                        <div class="col-lg-12 col-xl-12">
                            <div class="card card-custom gutter-b bg-white border-0">
                                <div class="card-body">
                                    <div class="col-md-12">
                                        <label class="text-body">Products</label>
                                        <fieldset class="form-group mb-3 d-flex">
                                            <select class="js-example-basic-single js-states form-control bg-transparent" v-model="product_id">
                                                <option value="">Select Product</option>
                                                <option v-for="product in products" v-bind:value="product.product_id">
                                                    {{ product.detail == null ? '' : product.detail[0].title }}
                                                </option>
                                            </select>
                                            <a href="javascript:void(0)" class="btn-secondary btn ml-2 white pt-1 pb-1 d-flex align-items-center justify-content-center" @click="addProduct()">ADD</a>
                                        </fieldset>
                                        <small class="form-text text-danger" v-if="errors.has('product_id')" v-text="errors.get('product_id')"></small>
                                    </div>
                                    <div class="col-12" v-if="display_table">
                                        <div class="table-responsive">
                                            <table class="table table-striped  text-body">
                                                <thead>
                                                    <tr>
                                                        <th class="border-0  header-heading" scope="col">Name</th>
                                                        <th class="border-0  header-heading" scope="col">WareHouse</th>
                                                        <th class="border-0  header-heading" scope="col">Stock Status</th>
                                                        <th class="border-0  header-heading" scope="col">Quantity</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr class="" v-for="(selectedProduct, index) in selectedProducts">
                                                        <td> {{ selectedProduct.title}}</td>
                                                        <td>
                                                            <select v-model="stock.warehouse_id[index]" class=" js-states form-control bg-transparent">
                                                                <option value="">Select Warehouse</option>
                                                                <option v-for="warehouse in warehouses" v-bind:value="warehouse.warehouse_id">
                                                                    {{ warehouse.warehouse_name }}
                                                                </option>
                                                            </select>
                                                            <small class="form-text text-danger" v-if="errors.has('warehouse_id.'+index)" v-text="errors.get('qty.'+index)"></small>

                                                        </td>
                                                        <td>
                                                            
                                                            <select v-model="stock.stock_status[index]" class=" js-states form-control bg-transparent">
                                                                <option value="">Select Status</option>
                                                                <option value="IN">IN</option>
                                                                <option value="OUT">OUT</option>
                                                            </select>
                                                            <small class="form-text text-danger" v-if="errors.has('stock_status.'+index)" v-text="errors.get('stock_status.'+index)"></small>

                                                        </td>
                                                        <td class=" text-center">
                                                            <input type="text" class="form-control" placeholder="Enter Quantity" v-model="stock.qty[index]" >
                                                            <small class="form-text text-danger" v-if="errors.has('qty.'+index)" v-text="errors.get('qty.'+index)"></small>
                                                        </td>
                                                        <input type="hidden" :set="stock.product_id[index] = selectedProduct.product_id" />
                                                        <input type="hidden" :set="selectedProduct.product_combination_id ? stock.product_combination_id[index] = selectedProduct.product_combination_id : [] " />

                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                         <td>
                                                            <small class="form-text text-danger" v-if="errors.has('warehouse_id')" v-text="errors.get('warehouse_id')"></small>
                                                        </td>
                                                        <td>
                                                            <small class="form-text text-danger" v-if="errors.has('stock_status')" v-text="errors.get('stock_status')"></small>
                                                        </td>
                                                        <td colspan="2">
                                                            <small class="form-text text-danger" v-if="errors.has('qty')" v-text="errors.get('qty')"></small>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-xl-12">
                            <div class="card card-custom gutter-b bg-white border-0">
                                <div class="card-body">
                                    <div class="col-md-12"><button class="btn btn-primary" @click="addstock()">Submit</button></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
</template>

<script>
import ErrorHandling from "./../../ErrorHandling";
export default {
    data() {
        return {
            display_form: 0,
            stock: {
                product_id:[],
                warehouse_id:[],
                stock_status:[],
                qty:[],
                product_combination_id:[]
            },
            product_id:'',
            display_table: false,
            error_message: '',
            request_method: "",
            warehouses: [],
            products: [],
            selectedProducts: [],
            token: [],
            errors: new ErrorHandling(),
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute("content")
        };
    },
    methods: {
        fetchWarehouses() {
            this.$parent.loading = true;
            var token = localStorage.getItem('token');
            const config = {
                headers: {
                    Authorization: `Bearer ${token}`
                }
            };
            axios.get('/api/admin/warehouse?getAllData=1', config)
                .then(res => {
                    if (res.data.status == "Success") {
                        this.warehouses = res.data.data;
                    }
                })
                .finally(() => (this.$parent.loading = false));
        },
        fetchProducts() {
            this.$parent.loading = true;
            var token = localStorage.getItem('token');
            const config = {
                headers: {
                    Authorization: `Bearer ${token}`
                }
            };
            var responseData = {};

            axios.get('/api/admin/product?getAllData=1', config)
                .then(res => {
                    if (res.data.status == "Success") {
                        this.products = res.data.data;
                    }
                })
                .finally(() => (this.$parent.loading = false));
        },
        addstock() {
            this.$parent.loading = true;
            var url = '/api/admin/stock';
            this.request_method = 'post'
            axios[this.request_method](url, this.stock, this.token)
                .then(res => {
                    if (res.data.status == "Success") {
                        this.display_form = 0;
                         this.stock= {
                            product_id:[],
                            warehouse_id:"",
                            stock_status:"IN",
                            qty:[],
                        }
                        this.selectedProducts = [];
                        this.errors = new ErrorHandling();
                        this.$toaster.success(res.data.message)
                    } else {
                        this.$toaster.error(res.data.message)
                    }
                })
                .catch(error => {
                    this.error_message = '';
                    this.errors = new ErrorHandling();
                    if (error.response.status == 422) {
                        if (error.response.data.status == 'Error') {
                            this.$toaster.error(error.response.data.message)
                        } else {
                            this.errors.record(error.response.data.errors);
                        }
                    }
                }).finally(() => (this.$parent.loading = false));

        },

        addProduct() {
            this.errors = new ErrorHandling();
            this.$parent.loading = true;
            var token = localStorage.getItem('token');
            const config = {
                headers: {
                    Authorization: `Bearer ${token}`
                }
            };
            var responseData = {};

            axios.get('/api/admin/product/' + this.product_id + '?getDetailWithLanguage=1&getDetail=1', config)
                .then(res => {
                    if (res.data.status == "Success") {
                        this.display_table = true;
                        // this.selectedProducts = res.data.data;
                        this.customIndex = 0;
                        var arr = {};
                        
                        if (res.data.data.product_type == 'simple') {
                            arr.product_id = res.data.data.product_id;
                            arr.product_type = res.data.data.product_type;
                            arr.title = res.data.data.detail.length > 0 ? res.data.data.detail[0].title : '';
                            arr.product_combination_id = null;
                            arr.qty = '';
                            arr.stock_status = '';
                            arr.warehouse = '';
                            this.stock.qty[i] = 0;
                            this.selectedProducts.push(arr);
                        } else {
                            if (res.data.data.combination_detail.length > 0) {
                                for (var i = 0; i < res.data.data.combination_detail.length; i++) {
                                    arr.product_combination_id = res.data.data.combination_detail[i].product_combination_id;
                                    var combination_name = '';
                                    if (res.data.data.combination_detail[i].combination.length > 0) {
                                        for (var j = 0; j < res.data.data.combination_detail[i].combination.length; j++) {
                                            if (j == 0) {
                                                combination_name = res.data.data.combination_detail[i].combination[j].variation.detail[0].name
                                            } else {
                                                combination_name += '-' + res.data.data.combination_detail[i].combination[j].variation.detail[0].name
                                            }
                                            // // console.log('i=' + i + 'j=' + j);
                                        }
                                    }
                                    arr.product_id = res.data.data.product_id;
                                    arr.product_type = res.data.data.product_type;
                                    arr.qty = '';
                                    this.stock.qty[i] = 0;

                                    arr.stock_status = '';
                                    arr.warehouse = '';
                                    arr.title = res.data.data.detail.length > 0 ? res.data.data.detail[0].title + ' (' + combination_name + ')' : '';
                                    this.selectedProducts.push(arr);
                                    arr = {};
                                }
                            }
                        }

                    }
                })
                .finally(() => (this.$parent.loading = false));
        },
        removeItem(index) {
            this.selectedProducts.splice(index, 1);
            this.stock.qty.splice(index, 1);
        }
    },
    mounted() {

        var token = localStorage.getItem('token');
        this.token = {
            headers: {
                Authorization: `Bearer ${token}`
            }
        };
        this.fetchWarehouses();
        this.fetchProducts();
    }
};
</script>
