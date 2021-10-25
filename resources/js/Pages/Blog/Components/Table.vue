<template>
  <!-- This example requires Tailwind CSS v2.0+ -->
  <div>
    <Input
      type="text"
      class="mt-1 block w-full"
      v-model="params.query"
      placeholder="Type a term"
    ></Input>
    <div class="flex flex-col mt-4">
      <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
          <div
            class="
              shadow
              overflow-hidden
              border-b border-gray-200
              sm:rounded-lg
            "
          >
            <table class="min-w-full divide-y divide-gray-200">
              <thead class="bg-gray-50">
                <tr>
                  <th
                    scope="col"
                    class="
                      px-6
                      py-3
                      text-left text-xs
                      font-medium
                      text-gray-500
                      uppercase
                      tracking-wider
                      cursor-pointer
                    "
                    @click.prevent="sort('id')"
                  >
                    ID
                    <template v-if="params.field === 'id'">
                      {{ params.direction === "asc" ? "&darr;" : "&uarr;" }}
                    </template>
                  </th>
                  <th
                    scope="col"
                    class="
                      px-6
                      py-3
                      text-left text-xs
                      font-medium
                      text-gray-500
                      uppercase
                      tracking-wider
                      cursor-pointer
                    "
                    @click.prevent="sort('title')"
                  >
                    Title
                    <template v-if="params.field === 'title'">
                      {{ params.direction === "asc" ? "&darr;" : "&uarr;" }}
                    </template>
                  </th>
                  <th
                    scope="col"
                    class="
                      px-6
                      py-3
                      text-left text-xs
                      font-medium
                      text-gray-500
                      uppercase
                      tracking-wider
                      cursor-pointer
                    "
                    @click.prevent="sort('description')"
                  >
                    Description
                    <template v-if="params.field === 'description'">
                      {{ params.direction === "asc" ? "&darr;" : "&uarr;" }}
                    </template>
                  </th>
                  <th scope="col" class="relative px-6 py-3">
                    <span class="sr-only">Edit</span>
                  </th>
                </tr>
              </thead>
              <tbody class="bg-white divide-y divide-gray-200">
                <tr v-for="blog in blogs.data" :key="blog.id">
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="flex items-center">{{ blog.id }}</div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-900">
                      {{
                        blog.title.length > 30
                          ? blog.title.substring(0, 30) + "..."
                          : blog.title
                      }}
                    </div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <span
                      class="
                        px-2
                        inline-flex
                        text-xs
                        leading-5
                        font-semibold
                        rounded-full
                        bg-green-100
                        text-green-800
                      "
                    >
                      {{
                        blog.description.length > 100
                          ? blog.description.substring(0, 100) + "..."
                          : blog.description
                      }}
                    </span>
                  </td>
                  <td
                    class="
                      px-6
                      py-4
                      whitespace-nowrap
                      text-right text-sm
                      font-medium
                    "
                  >
                    <a href="#" class="text-indigo-600 hover:text-indigo-900">
                      Edit
                    </a>
                    <a href="#" class="text-indigo-600 hover:text-indigo-900">
                      Delete
                    </a>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <CustomPaginator :meta="blogs.meta"></CustomPaginator>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import Input from "@/Components/Input";
import CustomPaginator from "@/Components/CustomPaginator.vue";
export default {
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

  components: {
    Input,
    CustomPaginator,
  },

  data() {
    return {
      params: {
        query: this.filters.query,
        page: this.filters.page ? this.filters.page : 1,
        field: this.filters.field,
        direction: this.filters.direction,
      },
    };
  },

  watch: {
    params: {
      handler: _.debounce(function () {
        let params = _.pickBy(this.params);
        this.$inertia.get(route("blogs.index"), params, {
          replace: true,
          preserveState: true,
          preserveScroll: true,
        });
      }, 300),
      deep: true,
    },
  },

  methods: {
    sort(field) {
      this.params.field = field;
      if (!this.params.direction) {
        this.params.direction = "asc";
      } else {
        this.params.direction = this.params.direction == "asc" ? "desc" : "asc";
      }
    },
  },
};
</script>
