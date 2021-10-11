<template>
  <div
    class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-2"
    v-if="toast.success && visible"
  >
    <div
      class="
        bg-green-500
        text-white
        px-6
        py-4
        border-0
        rounded
        relative
        bg-emerald-500
      "
    >
      <span class="text-xl inline-block mr-5 align-middle">
        <i class="fas fa-bell" />
      </span>
      <span class="inline-block align-middle mr-8">
        <b class="capitalize">Success!</b>
        {{ toast.success }}
      </span>
      <button
        class="
          absolute
          bg-transparent
          text-2xl
          font-semibold
          leading-none
          right-0
          top-0
          mt-4
          mr-6
          outline-none
          focus:outline-none
        "
      >
        <span @click.prevent="visible = !visible">×</span>
      </button>
    </div>
  </div>
  <div
    class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-2"
    v-if="toast.error && visible"
  >
    <div
      class="
        bg-red-400
        text-white
        px-6
        py-4
        border-0
        rounded
        relative
        bg-emerald-500
      "
    >
      <span class="text-xl inline-block mr-5 align-middle">
        <i class="fas fa-bell" />
      </span>
      <span class="inline-block align-middle mr-8">
        <b class="capitalize">Error</b> {{ toast.error }}
      </span>
      <button
        class="
          absolute
          bg-transparent
          text-2xl
          font-semibold
          leading-none
          right-0
          top-0
          mt-4
          mr-6
          outline-none
          focus:outline-none
        "
      >
        <span @click.prevent="visible = !visible">×</span>
      </button>
    </div>
  </div>
</template>
<script>
import { ref } from "@vue/reactivity";
export default {
  name: "Alert",
  props: {
    toast: Object,
  },
  setup(props) {
    const visible = ref(true);
    return {
      visible,
    };
  },
};
</script>
