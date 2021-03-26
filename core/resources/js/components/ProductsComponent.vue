<template>
<div>
  <div class="w-full overflow-hidden mb-2 border border-gray-200 sm:rounded-lg">
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
          v-for="(item, index) in orderItems"
          v-bind:key="index"
          class="border-b border-gray-200 hover:bg-gray-100"
        >
          <td class="px-3 py-4 whitespace-nowrap text-center">
            <span>{{ index + 1 }}</span>
          </td>
          <td class="px-3 py-4 whitespace-nowrap text-left">
            <input type="hidden" name="order_item_id[]" v-model="item.id" />
            <input
              type="hidden"
              name="product_id[]"
              v-model="item.product_id"
            />
            <input
              class="rounded-sm px-3 py-2 focus:outline-none w-full"
              type="text"
              name="title[]"
              v-model="item.title"
              placeholder="Title"
              @click="listProducts(index)"
              readonly
            />
            <div v-if="menuId === index" class="menu">
              <div
                class="menu-item"
                v-for="(product, _index) in productsList"
                v-bind:key="_index"
                @click="selectProduct(product, index)"
              >
                {{ product.title }}
              </div>
            </div>
          </td>
          <td class="px-3 py-4 whitespace-nowrap text-left">
            <input
              class="rounded-sm px-3 py-2 focus:outline-none w-full"
              name="price[]"
              type="number"
              v-model="item.price"
              v-on:change="subTotalChanged()"
              placeholder="Price"
            />
          </td>
          <td class="px-3 py-4 whitespace-nowrap text-left">
            <input
              class="rounded-sm px-3 py-2 focus:outline-none w-full"
              type="number"
              name="qty[]"
              v-model="item.qty"
              v-on:change="subTotalChanged()"
              placeholder="Quantity"
            />
          </td>
          <td class="px-6 py-4 whitespace-nowrap text-center">
            {{ (item.price * item.qty).toFixed(2) }}
          </td>
          <td class="px-6 py-4 whitespace-nowrap flex justify-center">
            <button v-on:click.prevent="handleDeleteItem(index)">
              <i class="fas fa-trash-alt"></i>
            </button>
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
</div>
</template>

<script>
export default {
  props: ["order_items"],
  data: function () {
    return {
      orderItems: [],
      menuId: null,
      productsList: [],
    };
  },
  mounted() {
    this.orderItems = this.order_items;
    this.subTotalChanged();
  },
  computed: {
    subTotal() {
      let total = 0;
      this.orderItems.forEach((item) => {
        total += item.price * item.qty;
      });
      return total;
    },
  },
  methods: {
    subTotalChanged() {
      this.$emit('changeSubTotal', this.subTotal);
    },
    handleDeleteItem(index) {
      this.orderItems.splice(index, 1)
      this.subTotalChanged();
    },
    handleAddRow() {
      this.orderItems.push({
        id: -1,
        product_order_id: 0,
        product_id: 0,
        title: "",
        price: "",
        qty: 0,
      });
      this.subTotalChanged();
    },
    listProducts(index) {
      axios.get("/admin/products/list").then((response) => {
        if (response.status === 200) {
          this.menuId = index;
          this.productsList = response.data.products;
        }
      });
    },
    selectProduct(product, index) {
      Vue.set(this.orderItems, index, {
        id: product.id,
        product_id: product.id,
        title: product.title,
        price: product.current_price,
        qty: 1,
      });
      this.subTotalChanged();
      this.menuId = null
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