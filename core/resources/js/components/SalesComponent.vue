<template>
  <div class="container px-3">
    <div class="flex flex-col">
      <div class="w-full overflow-hidden mb-4 border border-gray-200 sm:rounded-lg">
        <table class="w-full divide-y divide-gray-200">
          <thead class="bg-gray-300">
            <tr>
              <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{$t('message.reference')}}</th>
              <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{$t('message.customer')}}</th>
              <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{$t('message.agent')}}</th>
              <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{$t('message.document')}}</th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
            <tr class="border-b border-gray-200 hover:bg-gray-100">
              <td class="px-6 py-4 whitespace-nowrap text-left">
                <input
                  type="hidden"
                  name="order_id"
                  v-if="sale.order"
                  v-model="sale.order.id"
                />
                <input
                  type="hidden"
                  name="order_id"
                  v-else
                />
                <input
                  type="text"
                  class="rounded-sm px-2 py-2 focus:outline-none bg-white-100"
                  name="reference"
                  placeholder="Reference"
                  v-model="sale.reference"
                />
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-left">
                <input type="hidden" name="user_id" v-model="sale.user.id" />
                <input
                  type="text"
                  class="rounded-sm px-2 py-2 focus:outline-none"
                  name="user"
                  placeholder="Customer"
                  v-model="sale.user.name"
                  v-on:input="debounceInput()"
                  autocomplete="off"
                />
                <div v-if="showCustomers" class="menu">
                  <div
                    class="menu-item"
                    v-for="(customer, index) in customersList"
                    v-bind:key="index"
                    v-on:click="selectCustomer(customer)"
                  >
                    <span v-if="customersList.length !== 0">{{ customer.name }}</span>
                  </div>
                </div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-left">
                <input type="hidden" name="admin_id" v-model="user.id" />
                <input
                  type="text"
                  class="rounded-sm px-2 py-2 focus:outline-none"
                  name="admin"
                  placeholder="User"
                  v-model="user.username"
                  readonly
                />
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-left">
                <div v-if="!sale.document">
                  <input type="file" name="document" />
                </div>
                <div v-if="sale.document" class="flex">
                  <div class="py-2 px-3 bg-gray-300">{{ sale.document }}</div>
                  <button
                    class="rounded-sm px-3 py-2 focus:outline-none text-white font-bold bg-red-300"
                    v-on:click.prevent="deleteFile"
                  >
                    X
                  </button>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <h1 class="font-bold text-md py-2">{{$t('message.sale_items')}}</h1>
      <products-component v-if="category === 'products'" :order_items="sale.orderitems" @changeSubTotal="changeSubTotal($event)"></products-component>
      <packages-component v-else :order_items="sale.orderitems" @changeSubTotal="changeSubTotal($event)"></packages-component>
      <div class="w-1/2 overflow-hidden mb-4 border border-gray-200 sm:rounded-lg">
        <table class="w-full divide-y divide-gray-200">
          <thead class="bg-gray-300">
            <tr>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{$t('message.subtotal')}}</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{$t('message.tax')}}</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{$t('message.total')}}</th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
            <tr>
              <td class="px-3 py-4 whitespace-nowrap text-left">
                <input
                  type="number"
                  class="rounded-sm px-3 py-2 focus:outline-none bg-white-100 w-full mr-2"
                  name="subtotal"
                  placeholder="Subtotal"
                  v-model="subTotal"
                  readonly
                />
              </td>
              <td class="px-3 py-4 whitespace-nowrap text-left">
                <input
                  type="number"
                  class="rounded-sm px-3 py-2 focus:outline-none w-full mr-2"
                  name="tax"
                  placeholder="Tax"
                  v-model="tax"
                />
              </td>
              <td class="px-3 py-4 whitespace-nowrap text-left">
                <input
                  type="text"
                  class="rounded-sm px-3 py-2 focus:outline-none w-full"
                  name="total"
                  placeholder="Total"
                  v-model="total"
                  readonly
                />
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="w-full overflow-hidden mb-4 border border-gray-200 sm:rounded-lg">
        <table class="w-full divide-y divide-gray-200">
          <thead class="bg-gray-300">
            <tr>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{$t('message.payment_status')}}</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{$t('message.payment_method')}}</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{$t('message.paid_amount')}}</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{$t('message.due')}}</th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
            <tr>
              <td class="px-3 py-4 whitespace-nowrap text-left">
                <select
                  name="payment_status"
                  class="rounded-sm px-3 py-2 focus:outline-none w-full"
                >
                  <option value="1" :selected="sale.payment.status === 1">
                    {{$t('message.due')}}
                  </option>
                  <option value="2" :selected="sale.payment.status === 2">
                    {{$t('message.paid')}}
                  </option>
                  <option value="3" :selected="sale.payment.status === 3">
                    {{$t('message.pending')}}
                  </option>
                  <option value="4" :selected="sale.payment.status === 4">
                    {{$t('message.partial')}}
                  </option>
                </select>
              </td>
              <td class="px-3 py-4 whitespace-nowrap text-left">
                <select
                  name="payment_method"
                  class="rounded-sm px-3 py-2 focus:outline-none w-full"
                >
                  <option value="1" :selected="sale.payment.method === 1">
                    {{$t('message.cash')}}
                  </option>
                  <option value="2" :selected="sale.payment.method === 2">
                    {{$t('message.check')}}
                  </option>
                  <option value="3" :selected="sale.payment.method === 3">
                    {{$t('message.deposit')}}
                  </option>
                </select>
              </td>
              <td class="px-3 py-4 whitespace-nowrap text-left">
                <input
                  type="number"
                  name="paid_amount"
                  v-model="sale.payment.paid_amount"
                  class="rounded-sm px-3 py-2 focus:outline-none w-full"
                />
              </td>
              <td class="px-3 py-4 whitespace-nowrap text-left">
                <input
                  type="number"
                  name="due"
                  v-model="due"
                  class="rounded-sm px-3 py-2 focus:outline-none w-full"
                  readonly
                />
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="w-full flex justify-between mb-4">
      <div class="w-1/2">
      <label for="note" class="text-gray-700">{{$t('message.sale_note')}}</label>
        <textarea
          class="rounded-sm px-3 py-2 focus:outline-none w-full mr-2"
          name="note"
          cols="30"
          rows="10"
          v-model="sale.note"
        ></textarea>
            </div>
          <div class="w-1/2">
          <label for="payment_note" class="text-gray-700">{{$t('message.payment_note')}}</label>
          <textarea
          class="rounded-sm px-3 py-2 focus:outline-none w-full"
          name="payment_note"
          id=""
          cols="30"
          rows="10"
          v-model="sale.payment.note"
        ></textarea>
        </div>
      </div>
      <div class="flex">
        <button
          type="submit"
          class="rounded outline-none py-2 px-3 bg-blue-600 hover:bg-blue-400 text-white font-semibold"
        >
          {{$t('message.save')}}
        </button>
      </div>
    </div>
  </div>
</template>

<script>
import ProductsComponent from "./ProductsComponent.vue";
import PackagesComponent from "./PackagesComponent.vue";

export default {
  components: { ProductsComponent, PackagesComponent },
  props: ["sale_prop", "user", "category", "lang"],
  data: function () {
    return {
      sale: this.sale_prop,
      subTotal: 0,
      tax: 0,
      paidAmount: 0,
      csrf: document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content"),
      menuId: null,
      productsList: [],
      customersList: [],
      showCustomers: false,
    };
  },
  mounted() {
    this.$i18n.locale = this.lang;
    axios.defaults.headers.common["X-CSRF-TOKEN"] = this.csrf;
  },

  computed: {
    total() {
      return (this.subTotal * this.tax) / 100 + this.subTotal;
    },
    due() {
      return (this.total - this.sale.payment.paid_amount).toFixed(2);
    },
  },
  methods: {
    debounceInput: _.debounce(function () {
      this.searchCustomer(this.sale.user.name)
    }, 500),
    changeSubTotal(subTotal) {
      this.subTotal = subTotal;
    },
    searchCustomer(keyword) {
      axios
        .get(`/admin/register/search/users?keyword=${keyword}`)
        .then((response) => {
          if (response.status === 200) {
            this.customersList = response.data.customers;
            this.showCustomers = true;
          }
        });
    },
    selectCustomer(customer) {
      this.showCustomers = false;
      this.sale.user = customer;
    },
    deleteFile() {
      swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover this file!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      }).then((willDelete) => {
        if (willDelete) {
          axios
            .delete(`/admin/sales/products/file/${this.sale.id}`)
            .then((response) => {
              if (response.status === 200) {
                this.sale.document = null;
                swal("Poof! Your file has been deleted!", {
                  icon: "success",
                });
              }
            })
            .catch((error) => {
              swal("Error Try again", {
                icon: "error",
              });
            });
        }
      });
    },
  },
};
</script>

<style scoped>
.menu {
  max-height: 150px;
  overflow-y: scroll;
  background-color: #fff;
  background-clip: padding-box;
  border: 1px solid rgba(0, 0, 0, 0.15);
  border-radius: 0.25rem;
  color: #212529;
  cursor: pointer;
  display: flex;
  flex-direction: column;
  font-size: 1rem;
  list-style: none;
  margin: 0.125rem 0 0;
  padding: 0.5rem 0;
  position: absolute;
  text-align: left;
}

.menu-item {
  color: #212529;
  padding: 0.25rem 1.5rem;
  transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out,
    border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

.menu-item:hover {
  background-color: #f4f6f6;
  cursor: pointer;
}
</style>