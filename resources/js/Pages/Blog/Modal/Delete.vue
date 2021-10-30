<template>
  <div v-show="showModal">
    <div
      tabindex="0"
      class="
        z-40
        overflow-auto
        left-0
        top-0
        bottom-0
        right-0
        w-full
        h-full
        fixed
      "
    >
      <div
        class="z-50 relative p-3 mx-auto my-0 max-w-full"
        style="width: 600px"
      >
        <div
          class="
            bg-white
            rounded
            shadow-lg
            border
            flex flex-col
            overflow-hidden
          "
        >
          <button
            class="
              fill-current
              h-6
              w-6
              absolute
              right-0
              top-0
              m-6
              font-3xl font-bold
            "
            @click.prevent="closeModal"
          >
            &times;
          </button>
          <div class="px-6 py-3 text-xl border-b font-bold">Delete Blog</div>
          <div class="p-6 flex-grow">
            Are you sure you want to delete this blog ?
          </div>
          <div class="px-6 py-3 border-t">
            <div class="flex justify-end">
              <button
                type="button"
                class="bg-gray-700 text-gray-100 rounded px-4 py-2 mr-1"
                @click.prevent="closeModal"
              >
                Close
              </button>
              <button
                type="button"
                class="bg-blue-600 text-gray-200 rounded px-4 py-2"
                @click.prevent="deleteBlog"
              >
                Delete
              </button>
            </div>
          </div>
        </div>
      </div>
      <div
        @click.prevent="closeModal"
        class="
          z-40
          overflow-auto
          left-0
          top-0
          bottom-0
          right-0
          w-full
          h-full
          fixed
          bg-black
          opacity-50
        "
      ></div>
    </div>
  </div>
</template>
<script>
export default {
  name: "Delete",
  props: {
    blogId: {
      required: true,
      type: Number,
    },
    showModal: {
      required: true,
      type: Boolean,
    },
  },

  methods: {
    closeModal() {
      this.$emit("closeModal");
    },
    deleteBlog() {
      this.$inertia.delete(route("blogs.destroy", this.blogId), {
        preserveScroll: true,
        onSuccess: (page) => {
          this.closeModal();
          this.$notify({
            title: "Success",
            type: "success",
            text: "Blog Deleted Successfully",
          });
        },
      });
    },
  },
};
</script>
