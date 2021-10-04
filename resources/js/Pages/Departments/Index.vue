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
            <Table>
              <template #header>
                <TableColumn>Id</TableColumn>
                <TableColumn>Name</TableColumn>
                <TableColumn>Email</TableColumn>
                <TableColumn>Phone</TableColumn>
                <TableColumn>Action</TableColumn>
              </template>
              <tr
                v-for="department in departments.data"
                :key="department.id"
                class="hover:bg-gray-200"
              >
                <TableColumn>{{ department.id }}</TableColumn>
                <TableColumn>{{ department.name }}</TableColumn>
                <TableColumn>{{ department.email }}</TableColumn>
                <TableColumn>{{ department.phone }}</TableColumn>
              </tr>
            </Table>
            <!-- <Pagination :links="departments.links"></Pagination> -->

            <Paginator :paginator="departments" />
          </div>
        </div>
      </div>
    </div>
  </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import TableColumn from "@/Components/TableColumn.vue";
import { Head } from "@inertiajs/inertia-vue3";
import Table from "@/Components/Table";
import Pagination from "@/Components/Pagination";
import Paginator from "@/Components/Paginator";

export default {
  components: {
    BreezeAuthenticatedLayout,
    Head,
    TableColumn,
    Table,
    Pagination,
    Paginator,
  },

  props: {
    departments: {
      required: true,
      type: Object,
    },
  },

  mounted() {
    console.log(this.departments.links);
  },
};
</script>
