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
                                            Add Quotation
                                        </h3>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-xl-12">
                            <div class="card card-custom gutter-b bg-white border-0">
                                <div class="card-body">
                                    <form>
                                        <div class="form-group row">
                                            <div class="col-md-6">
                                                <label class="text-body">Quotation Type </label>
                                                <fieldset class="form-group mb-3">
                                                    <select v-model="quotation.type" class=" js-states form-control bg-transparent">
                                                        <option value="">Select type</option>
                                                        <option value="sale">Sale</option>
                                                        <option value="purchase">Purchase</option>
                                                    </select>
                                                    <small class="form-text text-danger" v-if="errors.has('type')" v-text="errors.get('type')"></small>
                                                </fieldset>
                                            </div>

                                            <div class="col-md-6" v-if="quotation.type != ''">
                                                <label class="text-body">Warehouses</label>
                                                <fieldset class="form-group mb-3">
                                                    <select v-model="quotation.warehouse_id" class=" js-states form-control bg-transparent">
                                                        <option value="">Select Warehouse</option>
                                                        <option v-for="warehouse in warehouses" v-bind:value="warehouse.warehouse_id"  >
                                                            {{ warehouse.warehouse_name }}
                                                        </option>
                                                    </select>
                                                    <small class="form-text text-danger" v-if="errors.has('warehouse_id')" v-text="errors.get('warehouse_id')"></small>
                                                </fieldset>
                                            </div>
                                            <div class="col-md-6" v-if="quotation.type == 'purchase'">
                                                <label class="text-body">Purchasers</label>
                                                <fieldset class="form-group mb-3">
                                                    <select v-model="quotation.purchaser_id" class=" js-states form-control bg-transparent">
                                                        <option value="">Select Purchasers</option>
                                                        <option v-for="purchaser in purchasers" v-bind:value="purchaser.purchaser_id">
                                                            {{ purchaser.purchaser_first_name }} {{ purchaser.purchaser_last_name }}
                                                        </option>
                                                    </select>
                                                    <small class="form-text text-danger" v-if="errors.has('purchaser_id')" v-text="errors.get('purchaser_id')"></small>
                                                </fieldset>
                                            </div>

                                            <div class="col-md-6" v-if="quotation.type == 'sale'">
                                                <label class="text-body">Customers</label>
                                                <fieldset class="form-group mb-3">
                                                    <select v-model="quotation.customer_id" class=" js-states form-control bg-transparent">
                                                        <option value="">Select Customer</option>
                                                        <option v-for="customer in customers" v-bind:value="customer.customer_id">
                                                            {{ customer.customer_first_name }} {{ customer.customer_last_name }}
                                                        </option>
                                                    </select>
                                                    <small class="form-text text-danger" v-if="errors.has('customer_id')" v-text="errors.get('customer_id')"></small>
                                                </fieldset>
                                            </div>
                                            
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-xl-12" v-if="quotation.type != ''">
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
                                                        <th class="border-0  header-heading" scope="col">Quantity</th>
                                                        <th class="border-0  header-heading" scope="col">Price {{getCurrencyTitle()}}</th>
                                                        <th class="border-0  header-heading" scope="col">Amount {{getCurrencyTitle()}}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr class="" v-for="(selectedProduct, index) in selectedProducts">
                                                        <td> {{ selectedProduct.title}}</td>
                                                        <td class=" text-center">
                                                            <input type="text" class="form-control" placeholder="Enter Quantity" v-model="quotation.qty[index]" @change="computeValues()">
                                                            <small class="form-text text-danger" v-if="errors.has('qty.'+index)" v-text="errors.get('qty.'+index)"></small>
                                                        </td>
                                                        <td class=" text-center">
                                                            <input type="text" class="form-control" placeholder="Enter Price" v-model="quotation.price[index]" @change="computeValues()">
                                                            <small class="form-text text-danger" v-if="errors.has('price.'+index)" v-text="errors.get('price.'+index)"></small>    
                                                        </td>
                                                        <td class=" text-center"><input type="text" readonly class="form-control" placeholder="Enter Price" :value="quotation.price[index] && quotation.qty[index] && !isNaN(quotation.price[index]) && !isNaN(quotation.qty[index]) ? quotation.price[index]*quotation.qty[index]:0" @change="computeValues()"></td>
                                                        <td class="text-right"><a href="#" class="confirm-delete" title="Delete" @click="removeItem(index)"><i class="fas fa-trash-alt"></i></a></td>

                                                        <input type="hidden" :set="quotation.product_id[index] = selectedProduct.product_id" />
                                                        <input type="hidden" :set="quotation.product_combination_id[index] = selectedProduct.product_combination_id" />
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                           
                                                        </td>
                                                        <td>
                                                            <small class="form-text text-danger" v-if="errors.has('qty')" v-text="errors.get('qty')"></small>
                                                        </td>
                                                        <td colspan="3">
                                                            <small class="form-text text-danger" v-if="errors.has('price')" v-text="errors.get('price')"></small>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-xl-12" v-if="quotation.type != ''">
                            <div class="card card-custom gutter-b bg-white border-0">
                                <div class="card-body">
                                    <div class="row mb-3">
                                        <div class="col-12">
                                            <label>Note</label>
                                            <fieldset class="form-group mb-3"><textarea class="form-control" id="label-textarea" rows="6" name="notes" placeholder="Please add some note" style="height: 130px;" spellcheck="false" v-model="quotation.note"></textarea></fieldset>
                                                <small class="form-text text-danger" v-if="errors.has('note')" v-text="errors.get('note')"></small>

                                        </div>
                                    </div>
                                    <div class="row justify-content-end">
                                        <div class="col-12 col-md-3">
                                            <div>
                                                <table class="table right-table mb-0">
                                                    <tbody>
                                                        <tr class="d-flex align-items-center justify-content-between">
                                                            <th class="border-0">
                                                                <h5 class="font-size-h5 mb-0 font-size-bold text-dark">Subtotal {{getCurrencyTitle()}}</h5>
                                                            </th>
                                                            <td class="border-0 justify-content-end d-flex text-black-50 font-size-base">{{ quotation.grand_total }}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12"><button class="btn btn-primary" @click="addQuotation()">Submit</button></div>
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
            quotation: {
                purchaser_id: "",
                customer_id: "",
                warehouse_id: "",
                grand_total: "0",
                type: "",
                note: "",
                product_id: [],
                product_combination_id: [],
                price: [],
                qty: [],
                subtotal: []
            },
            currency: [],
            product_id: '',
            customIndex: 0,
            display_table: false,
            searchParameter: '',
            sortBy: 'id',
            sortType: 'ASC',
            limit: 10,
            error_message: '',
            edit: false,
            actions: false,
            pagination: {},
            request_method: "",
            purchases: [],
            warehouses: [],
            customers: [],
            purchasers: [],
            products: [],
            selectedProducts: [],
            token: [],
            errors: new ErrorHandling(),
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute("content")
        };
    },
    methods: {
        fetchCurrency() {
            this.$parent.loading = true;
            var token = localStorage.getItem('token');
            const config = {
                headers: {
                    Authorization: `Bearer ${token}`
                }
            };
            var responseData = {};

            axios.get('/api/admin/currency?is_default=1', config)
                .then(res => {
                    if (res.data.status == "Success") {
                        this.currency = res.data.data;
                    }
                })
                .finally(() => (this.$parent.loading = false));
        },
        fetchCustomers() {
            this.$parent.loading = true;
            var token = localStorage.getItem('token');
            const config = {
                headers: {
                    Authorization: `Bearer ${token}`
                }
            };
            var responseData = {};

            axios.get('/api/admin/customer', config)
                .then(res => {
                    if (res.data.status == "Success") {
                        this.customers = res.data.data;
                    }
                })
                .finally(() => (this.$parent.loading = false));
        },
        fetchWarehouses() {
            this.$parent.loading = true;
            var token = localStorage.getItem('token');
            const config = {
                headers: {
                    Authorization: `Bearer ${token}`
                }
            };
            var responseData = {};

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
        fetchPurchasers() {
            this.$parent.loading = true;
            var token = localStorage.getItem('token');
            const config = {
                headers: {
                    Authorization: `Bearer ${token}`
                }
            };
            var responseData = {};

            axios.get('/api/admin/purchaser?getAllData=1', config)
                .then(res => {
                    if (res.data.status == "Success") {
                        this.purchasers = res.data.data;
                    }
                })
                .finally(() => (this.$parent.loading = false));
        },

        addQuotation() {
            this.$parent.loading = true;
            var url = '/api/admin/quotation';
            if (this.edit === false) {
                // Add
                this.request_method = 'post'
            } else {
                // Update
                var url = '/api/admin/quotation/' + this.quotation.id;
                this.request_method = 'put'
            }
            axios[this.request_method](url, this.quotation, this.token)
                .then(res => {
                    if (res.data.status == "Success") {
                        this.display_form = 0;
                         this.quotation= {
                            purchaser_id: "",
                            customer_id: "",
                            warehouse_id: "",
                            grand_total: "0",
                            type: "",
                            note: "",
                            product_id: [],
                            product_combination_id: [],
                            price: [],
                            qty: [],
                            subtotal: []
                        }
                        this.errors = new ErrorHandling();
                        this.selectedProducts = [];
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
        incrementIndex() {
            // // console.log('custom index => ');
            // this.customIndex++;
        },
        removeItem(index) {
            this.selectedProducts.splice(index, 1);
            this.quotation.price.splice(index, 1);
            this.quotation.qty.splice(index, 1);
            this.quotation.subtotal.splice(index, 1);
            
            if(this.selectedProducts.length == '0'){
                this.display_table = false;
            }
            else{
                this.display_table = true;
            }
            this.computeValues();
        },
        computeValues: function () {
            if (this.quotation.qty.length == this.quotation.price.length) {
                let subTotal = 0;
                for (var i = 0; i < this.quotation.qty.length; i++) {
                    if(this.quotation.qty[i] != '' && this.quotation.price[i] != '' && !isNaN(this.quotation.qty[i]) && !isNaN(this.quotation.price[i])){
                        subTotal = subTotal + (this.quotation.qty[i] * this.quotation.price[i]);
                        this.quotation.subtotal.push(this.quotation.qty[i] * this.quotation.price[i]);
                    }
                    else{
                        subTotal = subTotal + 0;
                        this.quotation.subtotal.push(0);
                    }
                }
                this.quotation.grand_total = subTotal;


            }
        },
        getCurrencyTitle(){
            return this.currency == null ? '' : '('+this.currency.title+')';
        }

    },
    mounted() {

        var token = localStorage.getItem('token');
        this.token = {
            headers: {
                Authorization: `Bearer ${token}`
            }
        };
        
        this.fetchCurrency();
        this.fetchWarehouses();
        this.fetchPurchasers();
        this.fetchCustomers();
        this.fetchProducts();
    }
};
</script>
