<template>
  <Head title="Dashboard" />

  <BreezeAuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Create New Department
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 bg-white border-b border-gray-200">
            <form @submit.prevent="submit">
              <div>
                <Label for="name" value="Name"> </Label>
                <Input
                  type="text"
                  id="name"
                  class="mt-1 block w-1/2"
                  v-model="form.name"
                  @keypress="errors.name ? (errors.name = '') : ''"
                  :error="errors.name"
                ></Input>
                <InputError :message="errors.name"></InputError>
              </div>
              <div class="mt-2">
                <Button
                  :class="{ 'opacity-25': form.processing }"
                  :disabled="form.processing"
                  >Update</Button
                >
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </BreezeAuthenticatedLayout>
</template>

<script>
import { useForm } from "@inertiajs/inertia-vue3";
import Label from "@/Components/Label";
import Input from "@/Components/Input";
import InputError from "@/Components/InputError";
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import Button from "@/Components/Button";
import { onMounted } from "@vue/runtime-core";
import { notify } from "@kyvg/vue3-notification";

export default {
  components: {
    BreezeAuthenticatedLayout,
    Label,
    Input,
    InputError,
    Button,
  },

  mounted() {},

  props: {
    errors: Object,
    department: {
      required: true,
      type: Object,
    },
  },

  setup(props) {
    const form = useForm({
      name: "",
    });

    onMounted(() => {
      form.name = props.department.name;
    });

    const submit = () => {
      form.put(route("departments.update", props.department.slug), {
        preserveScroll: true,
        onSuccess: () => {
          form.reset();
          notify({
            title: "Success",
            type: "success",
            text: "Employee created successfully",
          });
        },
        onError: (error) => {},
      });
    };

    return { form, submit };
  },
};
</script>
