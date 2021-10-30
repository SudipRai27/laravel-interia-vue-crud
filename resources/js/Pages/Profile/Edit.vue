<template>
  <Head title="Profile" />

  <BreezeAuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Dashboard
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
                <Label for="image" value="Image"> </Label>
                <input
                  type="file"
                  ref="imageRef"
                  style="display: none"
                  @change="selectImage"
                />
                <InputError :message="errors.image"></InputError>

                <img
                  :src="previewImage"
                  class="rounded-full h-20 w-20 object-cover"
                  v-if="previewImage"
                />

                <div class="mt-2" v-show="profile.image && !previewImage">
                  <img
                    :src="profile.image"
                    class="rounded-full h-20 w-20 object-cover"
                  />
                </div>
                <Button
                  class="mt-2 mr-2"
                  type="button "
                  @click.prevent="selectNewImage"
                  >Select image
                </Button>
              </div>
              <div class="mt-2">
                <Button
                  :class="{ 'opacity-25': form.processing }"
                  :disabled="form.processing"
                  >Update
                </Button>
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
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import Button from "@/Components/Button";
import Label from "@/Components/Label";
import Input from "@/Components/Input";
import InputError from "@/Components/InputError";
import { ref, onMounted } from "vue";
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
    auth: Object,
    profile: Object,
  },

  setup(props) {
    const form = useForm({
      name: props.auth.user.name,
      email: props.auth.user.email,
      image: null,
    });

    const imageRef = ref(null);
    const previewImage = ref(null);

    onMounted(() => {});

    const submit = () => {
      form.post(route("profile.update"), {
        preserveScroll: true,
        onSuccess: () => {
          notify({
            title: "Success",
            type: "success",
            text: "Profile Updated Successfully",
          });
        },
        onError: (error) => {},
      });
    };

    const selectNewImage = () => {
      imageRef.value.click();
    };

    const selectImage = (event) => {
      const file = event.target.files[0];
      previewImage.value = URL.createObjectURL(file);
      form.image = file;
    };

    return {
      form,
      submit,
      imageRef,
      selectNewImage,
      selectImage,
      previewImage,
    };
  },
};
</script>
