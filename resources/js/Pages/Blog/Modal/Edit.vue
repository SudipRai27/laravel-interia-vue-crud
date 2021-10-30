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
          <div class="px-6 py-3 text-xl border-b font-bold">Edit Blog</div>
          <div class="p-6 flex-grow">
            <div>
              <Label for="title" value="Title"></Label>
              <Input
                type="text"
                id="email"
                class="mt-1 block w-full"
                v-model="form.title"
                @keypress="form.clearErrors('title')"
              ></Input>
              <InputError :message="form.errors.title"></InputError>
            </div>
            <div class="mt-2">
              <Label for="description" value="Description"> </Label>
              <Input
                type="text"
                id="email"
                class="mt-1 block w-full"
                v-model="form.description"
                @keypress="form.clearErrors('description')"
              ></Input>
              <InputError :message="form.errors.description"></InputError>
            </div>
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
                :disabled="form.processing"
                @click.prevent="submit"
              >
                Edit
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
import Label from "@/Components/Label";
import Input from "@/Components/Input";
import InputError from "@/Components/InputError";
export default {
  props: {
    showModal: {
      required: true,
      type: Boolean,
    },

    blog: {
      required: true,
      type: Object,
    },
  },

  components: {
    Input,
    Label,
    InputError,
  },

  data() {
    return {
      form: this.$inertia.form({
        title: this.blog.title,
        description: this.blog.description,
      }),
    };
  },

  methods: {
    closeModal() {
      this.form.clearErrors();
      this.$emit("closeModal");
    },
    submit() {
      this.form.clearErrors();
      this.form.put(route("blogs.update", this.blog.id), {
        preserveScroll: true,
        onSuccess: () => {
          this.$notify({
            title: "Success",
            type: "success",
            text: "Blog Updated Successfully",
          });
          this.$emit("closeModal");
        },
      });
    },
  },
};
</script>

