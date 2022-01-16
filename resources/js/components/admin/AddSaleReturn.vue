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
                                            Add Sale Return
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
                                            <div class="col-md-12">
                                                <label class="text-body">Chose Sale</label>
                                                <fieldset class="form-group mb-3">
                                                    <select v-model="sale.sale_id" class=" js-states form-control bg-transparent" @change="fetchSingleSale()">
                                                        <option value="">Select Sale #</option>
                                                        <option v-for="sale in sales" v-bind:value="sale.id">
                                                            {{ sale.id }}
                                                        </option>
                                                    </select>
                                                </fieldset>
                                            </div>

                                            <div class="col-md-6" v-if="display_sale">
                                                <label class="text-body">Warehouses</label>
                                                <fieldset class="form-group mb-3">
                                                    {{   sale.warehouse_name}}
                                                </fieldset>
                                            </div>
                                            <div class="col-md-6" v-if="display_sale">
                                                <label class="text-body">Customers</label>
                                                <fieldset class="form-group mb-3">
                                                   {{ sale.customer ? sale.customer.customer_first_name+ ' ' + sale.customer.customer_last_name : '' }}
                                                </fieldset>
                                            </div>
                                            <div class="col-md-6" v-if="display_sale">
                                                <label class="text-body">Sale Date</label>
                                                <fieldset class="form-group mb-3">
                                                    {{ sale.sale_date }}
                                                </fieldset>
                                            </div>
                                            
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-xl-12" v-if="display_table">
                            <div class="card card-custom gutter-b bg-white border-0">
                                <div class="card-body">
                                    <div class="col-12">
                                        <div class="table-responsive">
                                            <table class="table table-striped  text-body">
                                                <thead>
                                                    <tr>
                                                        <th class="border-0  header-heading" scope="col">Name</th>
                                                        <th class="border-0  header-heading" scope="col">Quantity</th>
                                                        <th class="border-0  header-heading" scope="col">Available Quantity</th>
                                                        <th class="border-0  header-heading" scope="col">Return Quantity</th>
                                                        <th class="border-0  header-heading" scope="col">Price {{getCurrencyTitle()}}</th>
                                                        <th class="border-0  header-heading" scope="col">Amount {{getCurrencyTitle()}}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr class="" v-for="(selectedProduct, index) in selectedProducts">
                                                        <td> {{ selectedProduct.title}}</td>
                                                        <td class=" text-center">
                                                            <input type="text" class="form-control" placeholder="Enter Quantity" :set="sale.qty[index] = selectedProduct.sale_qty" v-model="sale.qty[index]" readonly>
                                                            <small class="form-text text-danger" v-if="errors.has('sale_qty.'+index)" v-text="errors.get('sale_qty.'+index)"></small>
                                                        </td>
                                                        <td class=" text-center">
                                                            <input type="text" class="form-control" placeholder="0" :value="selectedProduct.available_qty" readonly>
                                                        </td>
                                                        <td class=" text-center">
                                                            <input type="text" class="form-control" placeholder="Enter Return Quantity" v-model="sale.qty[index]">
                                                            <small class="form-text text-danger" v-if="errors.has('qty.'+index)" v-text="errors.get('qty.'+index)"></small>
                                                        </td>
                                                        <td class=" text-center">
                                                            <input type="text" class="form-control" placeholder="Enter Price"
                                                            :set="sale.price[index] = selectedProduct.price" v-model="sale.price[index]" readonly>
                                                            <small class="form-text text-danger" v-if="errors.has('price.'+index)" v-text="errors.get('price.'+index)"></small>    
                                                        </td>
                                                        <td class=" text-center"><input type="text" readonly class="form-control" placeholder="Enter Price" :set="sale.product_total[index] = selectedProduct.payable" v-model="sale.product_total[index]"></td>

                                                        <input type="hidden" :set="sale.product_id[index] = selectedProduct.product_id" />
                                                        <input type="hidden" :set="sale.product_name[index] = selectedProduct.title" />
                                                        <input type="hidden" :set="sale.product_combination_id[index] = selectedProduct.product_combination_id" />
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                           
                                                        </td>
                                                        <td>
                                                            <small class="form-text text-danger" v-if="errors.has('sale_qty')" v-text="errors.get('sale_qty')"></small>
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
                        <div class="col-lg-12 col-xl-12" v-if="display_table">
                            <div class="card card-custom gutter-b bg-white border-0">
                                <div class="card-body">
                                    <div class="row mb-3">
                                        <div class="col-12">
                                            <label>Note</label>
                                            <fieldset class="form-group mb-3">
                                                <textarea class="form-control" id="label-textarea" rows="6" name="notes" style="height: 130px;" spellcheck="false" v-model="sale.desc" readonly></textarea>
                                            </fieldset>
                                                <small class="form-text text-danger" v-if="errors.has('desc')" v-text="errors.get('desc')"></small>

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
                                                            <td class="border-0 justify-content-end d-flex text-black-50 font-size-base">{{ sale.subtotal }}</td>
                                                        </tr>
                                                        <tr class="d-flex align-items-center justify-content-between">
                                                            <th class="border-0">
                                                                <h5 class="font-size-h5 mb-0 font-size-bold text-dark">Total {{getCurrencyTitle()}}</h5>
                                                            </th>
                                                            <td class="border-0 justify-content-end d-flex text-black-50 font-size-base">{{ sale.payable }}</td>
                                                        </tr>

                                                        <tr class="d-flex align-items-center justify-content-between">
                                                            <th class="border-0">
                                                                <h5 class="font-size-h5 mb-0 font-size-bold text-dark">Due Amount {{getCurrencyTitle()}}</h5>
                                                            </th>
                                                            <td class="border-0 justify-content-end d-flex text-black-50 font-size-base">{{ sale.due_amount }}</td>
                                                        </tr>
                                                        <tr class="d-flex align-items-center justify-content-between">
                                                            <th class="border-0">
                                                                <h5 class="font-size-h5 mb-0 font-size-bold text-dark">Discount {{getCurrencyTitle()}}</h5>
                                                            </th>
                                                            <td class="border-0 justify-content-end d-flex text-black-50 font-size-base">
                                                                {{ sale.discount }}
                                                            </td>
                                                        </tr>
                                                        
                                                        <tr class="d-flex align-items-center justify-content-between">
                                                            <th class="border-0">
                                                                <h5 class="font-size-h5 mb-0 font-size-bold text-dark">Amount Paid {{getCurrencyTitle()}}</h5>
                                                            </th>
                                                            <td class="border-0 justify-content-end d-flex text-black-50 font-size-base">
                                                                {{ sale.amount_paid }}
                                                            </td>
                                                        </tr>
                                                        <tr class="d-flex align-items-center justify-content-between">
                                                            <th class="border-0">
                                                                <h5 class="font-size-h5 mb-0 font-size-bold text-dark">Adjustment {{getCurrencyTitle()}}</h5>
                                                            </th>
                                                             <td class="border-0 justify-content-end d-flex text-black-50 font-size-base">
                                                                <input type="text" class="form-control bg-white" aria-describedby="textHelp" value="0" v-model="sale.adjustment">
                                                            </td>
                                                        </tr>
                                                       
                                                        
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12"><button class="btn btn-primary" @click="addSaleReturn()">Submit</button></div>
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
            display_sale: 0,
            sale: {
                sale_id:"",
                product_id: [],
                qty:[],
                price:[],
                product_total:[],
                product_name:[],
                product_combination_id:[],
                adjustment:0,
            },
            product_id: '',
            customIndex: 0,
            display_table: false,
            searchParameter: '',
            sortBy: 'id',
            sortType: 'ASC',
            limit: 10,
            error_message: '',
            edit: false,
            currency: [],
            actions: false,
            pagination: {},
            request_method: "",
            sales: [],
            warehouses: [],
            customers: [],
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
        fetchSales() {
            this.$parent.loading = true;
            var token = localStorage.getItem('token');
            const config = {
                headers: {
                    Authorization: `Bearer ${token}`
                }
            };
            var responseData = {};

            axios.get('/api/admin/sale', config)
                .then(res => {
                    if (res.data.status == "Success") {
                        this.sales = res.data.data;
                    }
                })
                .finally(() => (this.$parent.loading = false));
        },
        fetchSingleSale() {
            this.$parent.loading = true;
            axios.get('/api/admin/sale/'+this.sale.sale_id+'?getProduct=1&getProductCombination=1', this.token)
                .then(res => {
                    if (res.data.status == "Success") {
                        this.display_sale = true;
                        this.selectedProducts = [];
                        let data = res.data.data;
                        var arr = {};
                        this.sale.due_amount = data.due_amount;
                        this.sale.amount_paid  = data.amount_paid;
                        this.sale.desc = data.desc;
                        this.sale.discount = data.discount;
                        this.sale.sale_date = data.sale_date;
                        this.sale.payable = data.payable;
                        this.sale.warehouse_id = data.warehouse ? data.warehouse.warehouse_id:"";
                        this.sale.custoemr_id = data.customer ? data.customer.customer_id:"";
                        this.sale.warehouse_name = data.warehouse ? data.warehouse.warehouse_name:"";
                        this.sale.customer_name = data.customer ? data.customer.customer_first_name + ' ' +data.customer.customer_last_name :"";
                        // arr.payable =data.detail[0].payable;
                        var payable = 0;

                        for(var i = 0;i < data.detail.length;i++){
                            arr.sale_qty =data.detail[i].qty;
                            arr.price = data.detail[i].price;
                            arr.available_qty = parseFloat(data.detail[i].qty) - parseFloat(data.detail[i].product_returned_qty);
                            payable = data.detail[i].total + payable;
                            arr.payable =payable;
                            // alert(data.detail[i].payable);
                            let product = data.detail[i].product_id;
                            arr.product_id = product.product_id;
                            arr.product_type = product.product_type;
                            if (product.product_type == 'simple') {
                                arr.title = product.detail.length > 0 ? product.detail[0].title : '';
                                arr.product_combination_id = null;
                                this.selectedProducts.push(arr);
                                arr = {}
                            } else {
                            if (product.combination_detail.length > 0) {
                                for (var c = 0; c < product.combination_detail.length; c++) {
                                    arr.product_combination_id = product.combination_detail[c].product_combination_id;
                                    var combination_name = '';
                                    if (product.combination_detail[c].combination.length > 0) {
                                        for (var j = 0; j < product.combination_detail[c].combination.length; j++) {
                                            if (j == 0) {
                                                combination_name = product.combination_detail[c].combination[j].variation.detail[0].name
                                            } else {
                                                combination_name += '-' + product.combination_detail[c].combination[j].variation.detail[0].name
                                            }
                                            // // console.log('c=' + c+ 'j=' + j);
                                        }
                                    }
                                    arr.product_id = product.product_id;
                                    arr.product_type = product.product_type;
                                    arr.title = product.detail.length > 0 ? product.detail[0].title + ' (' + combination_name + ')' : '';
                                    
                                }
                                this.selectedProducts.push(arr);
                                arr = {};
                            }
                        }

                        }
                        this.display_table = true;
                        // // console.log(this.selectedProducts);
                    }
                })
                .finally(() => (this.$parent.loading = false));
        },
        addSaleReturn() {
            this.$parent.loading = true;
            var url = '/api/admin/sale_return';
            this.request_method = 'post'
            axios[this.request_method](url, this.sale, this.token)
                .then(res => {
                    if (res.data.status == "Success") {
                        this.display_form = 0;
                         this.sale= {
                            sale_id:"",
                            product_id: [],
                            qty:[],
                            price:[],
                            product_total:[],
                            product_name:[],
                            product_combination_id:[],
                            adjustment:0,
                        }
                        this.selectedProducts = [];
                        this.display_sale = this.display_table = false;
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
                    else if (error.response.status == 500) {
                        this.$toaster.error(error.response.data.message)
                    }
                }).finally(() => (this.$parent.loading = false));

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
        this.fetchSales();
    }
};
</script>
