<template>
  <Head title="Dashboard" />

  <BreezeAuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Employees
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 bg-white border-b border-gray-200">
            <div class="flex items-end mb-6">
              <div class="mr-4">
                <select v-model="departmentId" @change="getDepartment($event)">
                  <option value="">Please select a department</option>
                  <option
                    v-for="department in departments"
                    :key="`department${department.id}`"
                    :value="department.id"
                  >
                    {{ department.name }}
                  </option>
                </select>
              </div>
              <AnchorLink :href="route('employees.create')">
                Create Employee
              </AnchorLink>
            </div>

            <Table>
              <template #header>
                <TableColumn>Id</TableColumn>
                <TableColumn>Name</TableColumn>
                <TableColumn>Email</TableColumn>
                <TableColumn>Phone</TableColumn>
                <TableColumn>Department</TableColumn>
                <TableColumn>Action</TableColumn>
              </template>
              <tr
                v-for="employee in employees.data"
                :key="employee.id"
                class="hover:bg-gray-200"
              >
                <TableColumn>{{ employee.id }}</TableColumn>
                <TableColumn>{{ employee.name }}</TableColumn>
                <TableColumn>{{ employee.email }}</TableColumn>
                <TableColumn>{{ employee.phone }}</TableColumn>
                <TableColumn>{{ employee.department }}</TableColumn>
                <TableColumn>
                  <AnchorLink
                    :href="route('employees.edit', { employee: employee.id })"
                    mode="edit"
                  >
                    Edit
                  </AnchorLink>
                  <AnchorLink
                    :href="
                      route('employees.destroy', { employee: employee.id })
                    "
                    method="DELETE"
                    as="button"
                    mode="delete"
                  >
                    Delete
                  </AnchorLink>
                </TableColumn>
              </tr>
            </Table>

            <!-- <Pagination :links="employees.links"></Pagination> -->

            <Paginator :paginator="employees" />
          </div>
        </div>
      </div>
    </div>
  </BreezeAuthenticatedLayout>
</template>
<script>
import AnchorLink from "@/Components/AnchorLink.vue";
import Table from "@/Components/Table";
import Paginator from "@/Components/Paginator";
import Pagination from "@/Components/Pagination";
import TableColumn from "@/Components/TableColumn.vue";
import { Head } from "@inertiajs/inertia-vue3";
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import { ref } from "@vue/reactivity";
import { Inertia } from "@inertiajs/inertia";
import { onMounted } from "@vue/runtime-core";

export default {
  components: {
    BreezeAuthenticatedLayout,
    Head,
    TableColumn,
    Table,
    Pagination,
    Paginator,
    AnchorLink,
  },

  props: {
    departments: {
      required: true,
      type: Object,
    },
    employees: {
      required: true,
      type: Object,
    },
    department_id: [Number, String],
  },

  setup(props) {
    const departmentId = ref("");

    onMounted(() => {
      departmentId.value = props.department_id;
    });

    const getDepartment = (event) => {
      Inertia.get(
        route("employees.index"),
        {
          department_id: event.target.value,
        },
        {
          only: ["employees", "department_id", "flash"],
        }
      );
    };

    return {
      departmentId,
      getDepartment,
    };
  },
};
</script>

