<template>
  <Head title="Dashboard" />

  <BreezeAuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Create New Employee
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
              <div>
                <Label for="email" value="Email"> </Label>
                <Input
                  type="text"
                  id="email"
                  class="mt-1 block w-1/2"
                  v-model="form.email"
                  @keypress="errors.email ? (errors.email = '') : ''"
                  :error="errors.email"
                ></Input>
                <InputError :message="errors.email"></InputError>
              </div>
              <div>
                <Label for="phone" value="Phone"> </Label>
                <Input
                  type="text"
                  id="phone"
                  class="mt-1 block w-1/2"
                  v-model="form.phone"
                  maxlength="10"
                  @keypress="errors.phone ? (errors.phone = '') : ''"
                  :error="errors.phone"
                ></Input>
                <InputError :message="errors.phone"></InputError>
              </div>
              <div>
                <Label for="department" value="Department"> </Label>
                <select v-model="form.department_id">
                  <option value="">Please select a department</option>
                  <option
                    v-for="department in departments"
                    :key="department.id"
                    :value="department.id"
                  >
                    {{ department.name }}
                  </option>
                </select>
                <InputError :message="errors.department_id"></InputError>
              </div>
              <div class="mt-2">
                <Button
                  :class="{ 'opacity-25': form.processing }"
                  :disabled="form.processing"
                  >Create</Button
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
import { notify } from "@kyvg/vue3-notification";

export default {
  components: {
    BreezeAuthenticatedLayout,
    Label,
    Input,
    InputError,
    Button,
  },

  props: {
    errors: Object,
    departments: {
      type: Array,
      required: true,
    },
  },

  setup() {
    const form = useForm({
      name: "",
      email: "",
      phone: "",
      email: "",
      department_id: "",
    });

    const submit = () => {
      form.post(route("employees.store"), {
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
