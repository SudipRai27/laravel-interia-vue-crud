<template>
  <Head title="Dashboard" />

  <BreezeAuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Posts with infinite scrolling
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 bg-white border-b border-gray-200">
            <!-- Card Item -->
            <Card
              v-for="post in postsData.data"
              :key="post.id"
              :post="post"
            ></Card>
            <!-- Card Item -->
          </div>
        </div>
      </div>
    </div>
  </BreezeAuthenticatedLayout>
</template>
<script>
import Card from "./Components/Card.vue";
import { Head } from "@inertiajs/inertia-vue3";
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";

export default {
  components: {
    BreezeAuthenticatedLayout,
    Card,
    Head,
  },

  mounted() {
    console.log(this.posts);
  },

  props: {
    posts: {
      required: true,
      type: Object,
    },
  },

  data() {
    return {
      postsData: this.posts,
      loading: false,
    };
  },

  mounted() {
    window.addEventListener("scroll", _.debounce(this.loadMore, 100));
    //no need to use debounce as we are using loading to prevent multiple request at a time can remove loading and only use debounce or viceversa
  },
  methods: {
    loadMore() {
      let pixelsFromBottom =
        document.documentElement.offsetHeight -
        document.documentElement.scrollTop -
        window.innerHeight;

      if (pixelsFromBottom < 200) {
        if (this.loading) return;
        if (this.postsData.meta.current_page < this.postsData.meta.last_page) {
          this.loading = true;
          axios
            .get(this.postsData.links.next)
            .then((res) => {
              this.postsData = {
                links: res.data.links,
                data: [...this.postsData.data, ...res.data.data],
                meta: res.data.meta,
              };
            })
            .finally(() => {
              this.loading = false;
            });
        }
      }
    },
  },
  destroyed() {
    window.removeEventListener("scroll", this.loadMore);
  },
};
</script>

