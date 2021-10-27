<template>
  <div
    class="
      bg-white
      px-4
      py-3
      flex
      items-center
      justify-between
      border-t border-gray-200
      sm:px-6
    "
  >
    <!-- For small screen -->
    <div class="flex-1 flex justify-between sm:hidden">
      <a
        href="#"
        class="
          relative
          inline-flex
          items-center
          px-4
          py-2
          border border-gray-300
          text-sm
          font-medium
          rounded-md
          text-gray-700
          bg-white
          hover:bg-gray-50
        "
        @click.prevent="
          meta.current_page > 1 ? switchPage(meta.current_page - 1) : ''
        "
      >
        Previous
      </a>
      <a
        href="#"
        class="
          ml-3
          relative
          inline-flex
          items-center
          px-4
          py-2
          border border-gray-300
          text-sm
          font-medium
          rounded-md
          text-gray-700
          bg-white
          hover:bg-gray-50
        "
        @click.prevent="
          meta.current_page < meta.last_page
            ? switchPage(meta.current_page + 1)
            : ''
        "
      >
        Next
      </a>
    </div>
    <!-- For small screen -->
    <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
      <div>
        <p class="text-sm text-gray-700">
          Showing
          <span class="font-medium">{{ meta.from }}</span>
          to
          <span class="font-medium">{{ meta.to }}</span>
          of
          <span class="font-medium">{{ meta.total }}</span>
          results
        </p>
      </div>
      <div>
        <nav
          class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px"
          aria-label="Pagination"
        >
          <!-- Previous link -->
          <a
            href="#"
            @click.prevent="
              meta.current_page > 1 ? switchPage(meta.current_page - 1) : ''
            "
            class="
              relative
              inline-flex
              items-center
              px-2
              py-2
              rounded-l-md
              border border-gray-300
              bg-white
              text-sm
              font-medium
              text-gray-500
              hover:bg-gray-50
            "
          >
            <span class="sr-only">Previous</span>
            <!-- Heroicon name: solid/chevron-left -->
            <svg
              class="h-5 w-5"
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 20 20"
              fill="currentColor"
              aria-hidden="true"
            >
              <path
                fill-rule="evenodd"
                d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                clip-rule="evenodd"
              />
            </svg>
          </a>
          <!-- Previous link -->
          <!-- Switch previous section link and page 1 link -->
          <template v-if="section > 1">
            <a
              href="#"
              class="
                bg-white
                border-gray-300
                text-gray-500
                hover:bg-gray-50
                relative
                inline-flex
                items-center
                px-4
                py-2
                border
                text-sm
                font-medium
              "
              @click.prevent="switchPage(1)"
            >
              1
            </a>
            <span
              class="
                relative
                inline-flex
                items-center
                px-4
                py-2
                border border-gray-300
                bg-white
                text-sm
                font-medium
                text-gray-700
              "
              @click.prevent="goOneSectionBackward"
            >
              ...
            </span>
          </template>
          <!-- Switch previous section link and page 1 link -->
          <!-- main links according to numbers per section -->
          <a
            href="#"
            @click.prevent="switchPage(page)"
            aria-current="page"
            v-for="(page, index) in pages"
            :key="index"
            :class="{
              'z-10 border-indigo-500 text-indigo-500':
                meta.current_page === page,
            }"
            class="
              bg-white
              border-gray-300
              text-gray-500
              hover:bg-gray-50
              relative
              inline-flex
              items-center
              px-4
              py-2
              border
              text-sm
              font-medium
            "
          >
            {{ page }}
          </a>
          <!-- main links according to numbers per section -->
          <!-- switch next section link and page last link -->
          <template v-if="section < sections">
            <span
              class="
                relative
                inline-flex
                items-center
                px-4
                py-2
                border border-gray-300
                bg-white
                text-sm
                font-medium
                text-gray-700
              "
              @click.prevent="goOneSectionForward"
            >
              ...
            </span>
            <a
              href="#"
              class="
                bg-white
                border-gray-300
                text-gray-500
                hover:bg-gray-50
                relative
                inline-flex
                items-center
                px-4
                py-2
                border
                text-sm
                font-medium
              "
              @click.prevent="switchPage(meta.last_page)"
              >{{ meta.last_page }}
            </a>
          </template>
          <!-- switch next section link and page last link -->
          <!-- Next Link -->
          <a
            href="#"
            @click.prevent="
              meta.current_page < meta.last_page
                ? switchPage(meta.current_page + 1)
                : ''
            "
            class="
              relative
              inline-flex
              items-center
              px-2
              py-2
              rounded-r-md
              border border-gray-300
              bg-white
              text-sm
              font-medium
              text-gray-500
              hover:bg-gray-50
            "
          >
            <span class="sr-only">Next</span>
            <svg
              class="h-5 w-5"
              x-description="Heroicon name: solid/chevron-right"
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 20 20"
              fill="currentColor"
              aria-hidden="true"
            >
              <path
                fill-rule="evenodd"
                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                clip-rule="evenodd"
              ></path>
            </svg>
          </a>
          <!-- Next Link -->
        </nav>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  props: {
    meta: {
      required: true,
      type: Object,
    },
  },

  data() {
    return {
      numbersPerSection: 7,
    };
  },

  computed: {
    sections() {
      return Math.ceil(this.meta.last_page / this.numbersPerSection);
    },
    section() {
      return Math.ceil(this.meta.current_page / this.numbersPerSection);
    },
    lastPage() {
      let lastPage =
        (this.section - 1) * this.numbersPerSection + this.numbersPerSection;
      if (this.section === this.sections) {
        lastPage = this.meta.last_page;
      }
      return lastPage;
    },
    pages() {
      return _.range(
        (this.section - 1) * this.numbersPerSection + 1,
        this.lastPage + 1
      );
    },
  },
  mounted() {
    if (this.meta.current_page > this.meta.last_page) {
      this.switchPage(this.meta.last_page);
    }
  },
  methods: {
    switchPage(page) {
      if (this.pageIsOutOfBounds(page) || page === this.meta.current_page) {
        return;
      }

      this.meta.links.forEach((link) => {
        if (link.label && parseInt(link.label) === page) {
          this.$inertia.get(
            link.url,
            {},
            {
              preserveScroll: true,
            }
          );
        }
      });
    },
    pageIsOutOfBounds(page) {
      return page <= 0 || page > this.meta.last_page;
    },
    goOneSectionForward() {
      this.switchPage(this.firstPageOfSection(this.section + 1));
    },
    goOneSectionBackward() {
      this.switchPage(this.firstPageOfSection(this.section - 1));
    },
    firstPageOfSection(section) {
      return (section - 1) * this.numbersPerSection + 1;
    },
  },
};
</script>
