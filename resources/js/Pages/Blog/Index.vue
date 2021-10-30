<template>
  <Head title="Dashboard" />

  <BreezeAuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Blogs Datatable
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 bg-white border-b border-gray-200">
            <Button type="button" @click.prevent="showModal = !showModal">
              Create
            </Button>
            <BlogTable :blogs="blogs" :filters="filters"></BlogTable>

            <CreateBlog
              :showModal="showModal"
              @closeModal="showModal = false"
            ></CreateBlog>
          </div>
        </div>
      </div>
    </div>
  </BreezeAuthenticatedLayout>
</template>

<script>
import { Head } from "@inertiajs/inertia-vue3";
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import Button from "@/Components/Button";
import CreateBlog from "./Modal/Create.vue";

import BlogTable from "./Components/Table";

export default {
  components: {
    BreezeAuthenticatedLayout,
    Button,
    Head,
    CreateBlog,
    BlogTable,
  },

  props: {
    blogs: {
      required: true,
      type: Object,
    },
    filters: {
      required: true,
      type: Object,
    },
  },

  data() {
    return {
      showModal: false,
    };
  },
};
</script>
