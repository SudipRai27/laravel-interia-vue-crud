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
            <div class="flex items-end mb-6">
              <!-- can also do $page.props.can.create -->
              <AnchorLink :href="route('departments.create')" v-if="can.create">
                Create Department
              </AnchorLink>
            </div>
            <Table>
              <template #header>
                <TableColumn @click="sortColumn('id')">
                  Id
                  <template v-if="sortBy === 'id'">
                    {{ sort === "asc" ? "&darr;" : "&uarr;" }}
                  </template>
                </TableColumn>
                <TableColumn @click="sortColumn('name')">
                  Name
                  <template v-if="sortBy === 'name'">
                    {{ sort === "asc" ? "&darr;" : "&uarr;" }}
                  </template>
                </TableColumn>
                <TableColumn>Action</TableColumn>
              </template>
              <tr
                v-for="department in departments.data"
                :key="department.id"
                class="hover:bg-gray-200"
              >
                <TableColumn>{{ department.id }} </TableColumn>
                <TableColumn>{{ department.name }}</TableColumn>
                <TableColumn>
                  <AnchorLink
                    :href="route('departments.edit', { slug: department.slug })"
                    mode="edit"
                    v-if="department.can.update"
                  >
                    Edit
                  </AnchorLink>
                  <AnchorLink
                    @click.prevent="goToEmployees(department.id)"
                    mode="view"
                    href="#"
                  >
                    View
                  </AnchorLink>
                  <AnchorLink
                    href="#"
                    @click.prevent="deleteDepartment(department.slug)"
                    method="DELETE"
                    v-if="department.can.delete"
                    as="button"
                    mode="delete"
                  >
                    Delete
                  </AnchorLink>
                </TableColumn>
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
import AnchorLink from "@/Components/AnchorLink.vue";
import Table from "@/Components/Table";
import Paginator from "@/Components/Paginator";
import Pagination from "@/Components/Pagination";
import TableColumn from "@/Components/TableColumn.vue";
import { Head } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";

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
    can: {
      required: true,
      type: Object,
    },
    sortBy: String,
    sort: String,
  },

  setup(props) {
    const goToEmployees = (departmentId) => {
      Inertia.get(route("employees.index"), {
        department_id: departmentId,
      });
    };

    const deleteDepartment = (slug) => {
      Inertia.delete(route("departments.destroy", slug), {
        preserveScroll: true,
        preserveState: false,
      });
    };

    const sortColumn = (col) => {
      Inertia.get(route("departments.index"), {
        sortBy: col,
        sort: props.sort === "asc" ? "desc" : "asc",
        page: props.departments.current_page,
      });
    };

    return {
      goToEmployees,
      deleteDepartment,
      sortColumn,
    };
  },
};
</script>
