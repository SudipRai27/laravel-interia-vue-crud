<template>
  <div class="container mx-auto my-5">
    <div
      class="
        relative
        rounded-lg
        flex flex-col
        md:flex-row
        items-center
        md:shadow-xl md:h-72
        mx-2
      "
    >
      <div
        class="
          z-0
          order-1
          md:order-2
          relative
          w-full
          md:w-2/5
          h-80
          md:h-full
          overflow-hidden
          rounded-lg
          md:rounded-none md:rounded-r-lg
        "
      >
        <div
          class="
            absolute
            inset-0
            w-full
            h-full
            object-fill object-center
            bg-blue-400 bg-opacity-30 bg-cover bg-bottom
          "
          style="
            background-image: url(https://images.unsplash.com/photo-1525302220185-c387a117886e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1350&q=80);
            background-blend-mode: multiply;
          "
        ></div>
        <div
          class="
            md:hidden
            absolute
            inset-0
            h-full
            p-6
            pb-6
            flex flex-col-reverse
            justify-start
            items-start
            bg-gradient-to-b
            from-transparent
            via-transparent
            to-gray-900
          "
        >
          <h3 class="w-full font-bold text-2xl text-white leading-tight mb-2">
            {{ post.title }}
          </h3>
          <h4 class="w-full text-xl text-gray-100 leading-tight"></h4>
        </div>
        <svg
          class="
            hidden
            md:block
            absolute
            inset-y-0
            h-full
            w-24
            fill-current
            text-white
            -ml-12
          "
          viewBox="0 0 100 100"
          preserveAspectRatio="none"
        >
          <polygon points="50,0 100,0 50,100 0,100" />
        </svg>
      </div>

      <div
        class="
          z-10
          order-2
          md:order-1
          w-full
          h-full
          md:w-3/5
          flex
          items-center
          -mt-6
          md:mt-0
        "
      >
        <div
          class="
            p-8
            md:pr-18 md:pl-14 md:py-12
            mx-2
            md:mx-0
            h-full
            bg-white
            rounded-lg
            md:rounded-none md:rounded-l-lg
            shadow-xl
            md:shadow-none
          "
        >
          <h4 class="hidden md:block text-xl text-gray-400">
            {{ post.title }}
          </h4>
          <h3 class="hidden md:block font-bold text-2xl text-gray-700">
            {{ post.title }}
          </h3>
          <p class="text-gray-600 text-justify">
            {{ post.body }}
          </p>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  props: {
    post: {
      required: true,
      type: Object,
    },
  },
};
</script>
