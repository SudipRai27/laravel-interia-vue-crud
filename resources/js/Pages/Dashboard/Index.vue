<template>
  <Head title="Dashboard" />

  <BreezeAuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Dashboard
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 bg-white border-b border-gray-200">
            <!-- <Link href="/depo">404 page</Link> -->
            <div class="mt-4 p-4 border border-gray-300 rounded">
              Sales
              <div class="flex justify-end">
                <Button type="button" @click.prevent="getWeeklySales">
                  Weekly
                </Button>
                <Button type="button" @click.prevent="getMonthlySales">
                  Monthly
                </Button>
              </div>
              <div class="mt-4">
                <div class="w-full h-64">
                  <SalesChart
                    :labels="sales.date"
                    :values="sales.count"
                  ></SalesChart>
                </div>
              </div>
            </div>

            <div class="lg:flex">
              <div
                class="mt-4 p-4 border border-gray-300 rounded w-full lg:w-1/2"
              >
                Customers
                <div class="flex justify-end">
                  <Button type="button" @click.prevent="getWeeklyCustomers">
                    Weekly
                  </Button>
                  <Button type="button" @click.prevent="getMonthlyCustomers">
                    Monthly
                  </Button>
                </div>
                <div class="mt-4">
                  <div class="w-full h-64">
                    <CustomersChart
                      :labels="customers.date"
                      :values="customers.count"
                    ></CustomersChart>
                  </div>
                </div>
              </div>
              <div
                class="
                  mt-4
                  p-4
                  border border-gray-300
                  rounded
                  w-full
                  lg:w-1/2 lg:ml-2
                "
              >
                Traffic
                <div class="flex justify-end">
                  <Button type="button" @click.prevent="getWeeklyTraffic">
                    Weekly
                  </Button>
                  <Button type="button" @click.prevent="getMonthlyTraffic">
                    Monthly
                  </Button>
                </div>
                <div class="mt-4">
                  <div class="w-full h-64">
                    <TrafficChart
                      :labels="traffic.date"
                      :values="traffic.count"
                    ></TrafficChart>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </BreezeAuthenticatedLayout>
</template>

<script>
import Button from "@/Components/Button";
import { Inertia } from "@inertiajs/inertia";
import { Head } from "@inertiajs/inertia-vue3";
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import SalesChart from "./Charts/SalesChart.vue";
import CustomersChart from "./Charts/CustomersChart.vue";
import TrafficChart from "./Charts/TrafficChart.vue";
export default {
  components: {
    SalesChart,
    CustomersChart,
    TrafficChart,
    BreezeAuthenticatedLayout,
    Button,
    Head,
  },
  props: {
    sales: Object,
    customers: Object,
    traffic: Object,
  },

  setup() {
    const getWeeklySales = () => {
      Inertia.get(
        route("dashboard"),
        { period: "weekly" },
        { only: ["sales"], preserveScroll: true }
      );
    };

    const getMonthlySales = () => {
      Inertia.get(
        route("dashboard"),
        { period: "monthly" },
        { only: ["sales"], preserveScroll: true }
      );
    };

    const getWeeklyCustomers = () => {
      Inertia.get(
        route("dashboard"),
        { period: "weekly" },
        { only: ["customers"], preserveScroll: true }
      );
    };

    const getMonthlyCustomers = () => {
      Inertia.get(
        route("dashboard"),
        { period: "monthly" },
        { only: ["customers"], preserveScroll: true }
      );
    };

    const getWeeklyTraffic = () => {
      Inertia.get(
        route("dashboard"),
        { period: "weekly" },
        { only: ["traffic"], preserveScroll: true }
      );
    };

    const getMonthlyTraffic = () => {
      Inertia.get(
        route("dashboard"),
        { period: "monthly" },
        { only: ["traffic"], preserveScroll: true }
      );
    };

    return {
      getWeeklySales,
      getMonthlySales,
      getWeeklyCustomers,
      getMonthlyCustomers,
      getWeeklyTraffic,
      getMonthlyTraffic,
    };
  },
};
</script>
