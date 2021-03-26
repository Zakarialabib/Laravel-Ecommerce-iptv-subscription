<template>
  <div class="container px-3">
    <div class="flex flex-col">
      <div class="w-full overflow-hidden mb-4 border border-gray-200 sm:rounded-lg">
        <table class="w-full divide-y divide-gray-200">
          <thead class="bg-gray-300">
            <tr>
              <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{$t('message.reference')}}</th>
              <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{$t('message.supplier')}}</th>
              <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{$t('message.agent')}}</th>
              <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{$t('message.document')}}</th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
            <tr class="border-b border-gray-200 hover:bg-gray-100">
              <td class="px-6 py-4 whitespace-nowrap text-left">
                <input
                  type="text"
                  class="rounded-sm px-2 py-2 focus:outline-none bg-white-100"
                  name="reference"
                  placeholder="Reference"
                  v-model="purchase.reference"
                />
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-left">
                <input type="hidden" name="supplier_id" v-model="purchase.supplier.id" />
                <input
                  type="text"
                  class="rounded-sm px-2 py-2 focus:outline-none"
                  name="supplier"
                  placeholder="Supplier"
                  v-model="purchase.supplier.company_name"
                  v-on:input="debounceInput()"
                  autocomplete="off"
                />
                <div v-if="showSuppliers" class="menu">
                  <div
                    class="menu-item"
                    v-for="(supplier, index) in suppliersList"
                    v-bind:key="index"
                  >
                    <span v-on:click="selectSupplier(supplier)" v-if="suppliersList.length !== 0">{{ supplier.name }}</span>
                  </div>
                </div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-left">
                <input type="hidden" name="admin_id" v-model="user.id" />
                <input
                  type="text"
                  class="rounded-sm px-2 py-2 focus:outline-none"
                  name="admin"
                  placeholder="Agent"
                  v-model="user.username"
                  readonly
                />
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-left">
                <div v-if="!purchase.document">
                  <input type="file" name="document" />
                </div>
                <div v-if="purchase.document" class="flex">
                  <div class="py-2 px-3 bg-gray-300">{{ purchase.document }}</div>
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
      <h1 class="font-bold text-md py-2">{{$t('message.purchase_items')}}</h1>
      <div
        class="w-full overflow-hidden mb-2 border border-gray-200 sm:rounded-lg"
      >
        <table class="w-full divide-y divide-gray-200">
          <thead class="bg-gray-300">
            <tr
              class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal"
            >
              <th
                class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider"
              >
                id
              </th>
              <th
                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
              >
                {{$t('message.product')}}
              </th>
              <th
                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
              >
                {{$t('message.price')}}
              </th>
              <th
                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
              >
                {{$t('message.quantity')}}
              </th>
              <th
                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
              >
                {{$t('message.total')}}
              </th>
              <th
                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
              >
                {{$t('message.actions')}}
              </th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
            <tr
              v-for="(item, index) in purchaseItems"
              v-bind:key="index"
              class="border-b border-gray-200 hover:bg-gray-100"
            >
              <td class="px-3 py-4 whitespace-nowrap text-center">
                <span>{{ index + 1 }}</span>
              </td>
              <td class="px-3 py-4 whitespace-nowrap text-left">
                <input type="hidden" name="purchase_item_id[]" v-model="item.id" />
                <input
                  class="rounded-sm px-3 py-2 focus:outline-none w-full"
                  type="text"
                  name="title[]"
                  v-model="item.title"
                  placeholder="Title"
                  autocomplete="off"
                />
              </td>
              <td class="px-3 py-4 whitespace-nowrap text-left">
                <input
                  class="rounded-sm px-3 py-2 focus:outline-none w-full"
                  name="price[]"
                  type="number"
                  v-model="item.price"
                  placeholder="Price"
                />
              </td>
              <td class="px-3 py-4 whitespace-nowrap text-left">
                <input
                  class="rounded-sm px-3 py-2 focus:outline-none w-full"
                  type="number"
                  name="qty[]"
                  v-model="item.qty"
                  placeholder="Quantity"
                />
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-center">
                {{ (item.price * item.qty).toFixed(2) }}
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="flex justify-center">
                  <button v-on:click.prevent="handleDeleteItem(index)">
                    <i class="fas fa-trash-alt"></i>
                  </button>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="flex justify-end w-full mb-4">
        <button
          v-on:click.prevent="handleAddRow()"
          class="rounded outline-none py-2 px-3 bg-blue-600 hover:bg-blue-400 text-white font-semibold capitalize"
        >
          {{$t('message.add')}}
        </button>
      </div>
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
                  <option value="1" :selected="purchase.payment.status === 1">
                    {{$t('message.due')}}
                  </option>
                  <option value="2" :selected="purchase.payment.status === 2">
                    {{$t('message.paid')}}
                  </option>
                  <option value="3" :selected="purchase.payment.status === 3">
                    {{$t('message.pending')}}
                  </option>
                  <option value="4" :selected="purchase.payment.status === 4">
                    {{$t('message.partial')}}
                  </option>
                </select>
              </td>
              <td class="px-3 py-4 whitespace-nowrap text-left">
                <select
                  name="payment_method"
                  class="rounded-sm px-3 py-2 focus:outline-none w-full"
                >
                  <option value="1" :selected="purchase.payment.method === 1">
                    {{$t('message.cash')}}
                  </option>
                  <option value="2" :selected="purchase.payment.method === 2">
                    {{$t('message.check')}}
                  </option>
                  <option value="3" :selected="purchase.payment.method === 3">
                    {{$t('message.deposit')}}
                  </option>
                </select>
              </td>
              <td class="px-3 py-4 whitespace-nowrap text-left">
                <input
                  type="number"
                  name="paid_amount"
                  v-model="purchase.payment.paid_amount"
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
          <label for="purchase_note" class="text-gray-700">{{$t('message.purchase_note')}}</label>
        <textarea
          class="rounded-sm px-3 py-2 focus:outline-none w-full mr-2"
          name="note"
          cols="30"
          rows="10"
          v-model="purchase.note"
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
          v-model="purchase.payment.note"
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
export default {
  props: ["purchase_prop", "user", "lang"],
  data: function () {
    return {
      purchase: this.purchase_prop,
      purchaseItems: [],
      tax: 0,
      paidAmount: 0,
      csrf: document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content"),
      menuId: null,
      suppliersList: [],
      showSuppliers: false,
    };
  },
  mounted() {
    this.$i18n.locale = this.lang;
    this.purchaseItems = this.purchase.purchase_items || [];
    axios.defaults.headers.common["X-CSRF-TOKEN"] = this.csrf;
  },

  computed: {
    subTotal() {
      let total = 0;
      this.purchaseItems.forEach((item) => {
        total += item.price * item.qty;
      });
      return total;
    },
    total() {
      return (this.subTotal * this.tax) / 100 + this.subTotal;
    },
    due() {
      return (this.total - this.purchase.payment.paid_amount).toFixed(2);
    },
  },
  methods: {
    debounceInput: _.debounce(function () {
      this.searchSuppliers(this.purchase.supplier.company_name)
    }, 500),
    handleDeleteItem(index) {
      this.purchaseItems.splice(index, 1)
    },
    handleAddRow() {
      this.purchaseItems.push({
        id: 0,
        product_order_id: 0,
        product_id: 0,
        title: "",
        price: "",
        qty: 0,
      });
    },
    searchSuppliers(keyword) {
      axios
        .get(`/admin/suppliers/search?keyword=${keyword}`)
        .then((response) => {
          if (response.status === 200) {
            this.suppliersList = response.data.suppliers;
            this.showSuppliers = true;
          }
        });
    },
    selectSupplier(supplier) {
      this.showSuppliers = false;
      this.purchase.supplier = supplier;
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
            .delete(`/admin/purchases/file/${this.purchase.id}`)
            .then((response) => {
              if (response.status === 200) {
                this.purchase.document = null;
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