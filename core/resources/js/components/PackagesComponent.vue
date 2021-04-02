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
            {{$t('message.package')}}
          </th>
          <th
            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
          >
            {{$t('message.plan')}}
          </th>
          <th
            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
          >
            {{$t('message.price')}}
          </th>
          <th
            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
          >
            {{$t('message.start_date')}}
          </th>
          <th
            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
          >
            {{$t('message.status')}}
          </th>
        </tr>
      </thead>
      <tbody class="bg-white divide-y divide-gray-200">
        <tr class="border-b border-gray-200 hover:bg-gray-100" v-if="order">
          <td class="px-3 py-4 whitespace-nowrap text-center">
            <span>1</span>
          </td>
          <td class="px-3 py-4 whitespace-nowrap text-left">
            <input type="hidden" name="order_id" v-model="order.id" />
            <input
              type="hidden"
              name="package_id"
              v-model="order.package.id"
            />
            <input
              class="rounded-sm px-3 py-2 focus:outline-none w-full"
              type="text"
              name="name"
              v-model="order.package.name"
              placeholder="Name"
              @click="listPackages()"
              readonly
            />
            <div v-if="showMenu" class="menu">
              <div
                class="menu-item"
                v-for="(packageItem, index) in packagesList"
                v-bind:key="index"
                @click="selectPackage(packageItem)"
              >
                {{ packageItem.name }}
              </div>
            </div>
          </td>
          <td class="px-3 py-4 whitespace-nowrap text-left">
            <input type="hidden" name="plan_id" v-model="order.plan.id">
            <select
              name="plan_type"
              class="rounded-sm px-3 py-2 focus:outline-none w-full"
              v-model="selectedPlanType"
              v-on:change="changePlan()"
            >
              <option value="1">
                {{$t('message.monthly_plan')}}
              </option>
              <option value="2">
                {{$t('message.quarter_plan')}}
              </option>
              <option value="3">
                {{$t('message.semiannual_plan')}}
              </option>
              <option value="4">
                {{$t('message.annual_plan')}}
              </option>
            </select>
          </td>
          <td class="px-3 py-4 whitespace-nowrap text-left">
            <input
              class="rounded-sm px-3 py-2 focus:outline-none w-full"
              name="plan_price"
              type="number"
              v-on:change="subTotalChanged()"
              v-model="order.plan.price"
              placeholder="Price"
              readonly
            />
          </td>
          <td class="px-3 py-4 whitespace-nowrap text-left">
            <input 
            class="rounded-sm px-3 py-2 focus:outline-none w-full"
            type="date" 
            name="start_date"
            v-model="order.start_date"
            >
          </td>
          <td class="px-3 py-4 whitespace-nowrap text-left">
            <select
              name="package_status"
              class="rounded-sm px-3 py-2 focus:outline-none w-full"
              v-model="order.package_status"
            >
              <option value="1" :selected="order.package_status === 1">
                {{$t('message.inactive')}}
              </option>
              <option value="2" :selected="order.package_status === 2">
                {{$t('message.near_end')}}
              </option>
              <option value="3" :selected="order.package_status === 3">
                {{$t('message.active')}}
              </option>
            </select>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
</template>

<script>
export default {
  props: ["order-prop"],
  data: function () {
    return {
      order: null,
      showMenu: false,
      packagesList: [],
      selectedPlanType: 1,
    };
  },
  mounted() {
    this.order = this.orderProp;
    this.selectedPlanType = this.order.plan.type;
    this.subTotalChanged();
  },
  methods: {
    subTotalChanged() {
      this.$emit('changeSubTotal', this.order.plan.price);
    },
    listPackages(index) {
      axios.get("/admin/package/list").then((response) => {
        if (response.status === 200) {
          this.showMenu = true;
          this.packagesList = response.data.packages;
        }
      });
    },
    selectPackage(packageItem) {
      this.order = {
        id: null,
        plan: packageItem.plans[0],
        package: {
          id: packageItem.id,
          name: packageItem.name,
          plans: packageItem.plans,
        },
        user: this.order.user,
        start_date: this.order.start_date,
      };
      this.subTotalChanged();
      this.showMenu = false
    },
    changePlan() {
      const index = this.order.package.plans.findIndex(plan => plan.type == this.selectedPlanType);
      this.order.plan = this.order.package.plans[index];
      this.subTotalChanged();
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