<script setup lang="ts">
  import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
  import { Head, useForm } from '@inertiajs/vue3';
  import TextInput from '@/Components/TextInput.vue';
  import TextArea from '@/Components/TextArea.vue';
  import InputError from '@/Components/InputError.vue';
  import { Core as YubinBangoCore } from "yubinbango-core2";

  // customers のデータ構造を定義
  type Customer = {
    id: number;
    last_name: string;
    first_name: string;
    last_name_kana: string;
    first_name_kana: string;
    postcode: string;
    address: string;
    tel: string;
    birth: string;
    gender: number;
    memo: string;
  };

  const props = defineProps<{ customer: Customer }>();

  const customerForm = useForm<Customer>({
    id: props.customer.id,
    last_name: props.customer.last_name,
    first_name: props.customer.first_name,
    last_name_kana: props.customer.last_name_kana,
    first_name_kana: props.customer.first_name_kana,
    postcode: props.customer.postcode,
    address: props.customer.address,
    tel: props.customer.tel,
    birth: props.customer.birth,
    gender: props.customer.gender,
    memo: props.customer.memo,
  })

  const fetchAddress = () => {
    new YubinBangoCore(String(customerForm.postcode), (value: any) => {
      customerForm.address = value.region + value.locality + value.street
    })
  }

  const updateCustomer = () => {
    customerForm.put(route('customers.update', {
      'customer' : customerForm.id
    }))
  }


</script>
<template>
	<Head title="顧客編集" />

	<AuthenticatedLayout>
		<template #header>
			<h2
				class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200"
			>
				顧客編集
			</h2>
		</template>

		<div class="mb-10">
			<div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
				<div
					class="py-5 overflow-hidden bg-white shadow-lg sm:rounded-lg dark:bg-gray-800"
				>
          <v-container>
            <v-row>
              <v-col lg="3"></v-col>
              <v-col md="12" lg="6" cols="12">
                <form @submit.prevent="updateCustomer">
                  <InputError class="" :message="customerForm.errors.last_name" />
                  <InputError class="" :message="customerForm.errors.first_name" />
                  <div class="d-flex">
                    <TextInput
                    label="姓"
                    placeholder="例：山田"
                    id="last_name"
                    v-model="customerForm.last_name"
                    type="text"
                    icon="mdi-card-bulleted-outline"
                    class="block w-full"
                    required
                    autofocus
                    autocomplete="姓"
                    />
                    <TextInput
                    label="名"
                    placeholder="例：太郎"
                    id="first_name"
                    v-model="customerForm.first_name"
                    type="text"
                    icon="mdi-card-bulleted-outline"
                    class="block w-full ml-2"
                    required
                    autocomplete="名"
                    />
                  </div>
                  <InputError class="" :message="customerForm.errors.last_name_kana" />
                  <InputError class="" :message="customerForm.errors.first_name_kana" />
                  <div class="d-flex">
                    <TextInput
                    label="姓カナ"
                    placeholder="例：ヤマダ"
                    id="last_name_kana"
                    v-model="customerForm.last_name_kana"
                    type="text"
                    icon="mdi-card-bulleted-outline"
                    class="block w-full"
                    required
                    autocomplete="姓カナ"
                    />
                    <TextInput
                    label="名カナ"
                    placeholder="例：タロウ"
                    id="first_name_kana"
                    v-model="customerForm.first_name_kana"
                    type="text"
                    icon="mdi-card-bulleted-outline"
                    class="block w-full ml-2"
                    required
                    autocomplete="名カナ"
                    />
                  </div>
                  <InputError class="" :message="customerForm.errors.postcode" />
                  <TextInput
                  label="郵便番号"
                  placeholder="例：1234567"
                  id="postcode"
                  v-model="customerForm.postcode"
                  type="number"
                  icon="mdi-post-lamp"
                  class="block w-full"
                  required
                  autocomplete="郵便番号"
                  @change="fetchAddress"
                  />
                  <InputError class="" :message="customerForm.errors.address" />
                  <TextInput
                  label="住所"
                  id="address"
                  v-model="customerForm.address"
                  type="text"
                  icon="mdi-home"
                  class="block w-full"
                  required
                  autocomplete="住所"
                  />
                  <InputError class="" :message="customerForm.errors.tel" />
                  <TextInput
                  label="電話番号"
                  placeholder="例：09876543210"
                  id="tel"
                  v-model="customerForm.tel"
                  type="number"
                  icon="mdi-phone"
                  class="block w-full"
                  required
                  autocomplete="電話番号"
                  />
                  <InputError class="" :message="customerForm.errors.birth" />
                  <TextInput
                  label="誕生日"
                  id="birth"
                  v-model="customerForm.birth"
                  type="date"
                  icon="mdi-cake"
                  class="block w-full"
                  required
                  autocomplete="誕生日"
                  />
                  <InputError class="" :message="customerForm.errors.gender" />
                  <v-radio-group v-model="customerForm.gender" inline>
                    <template v-slot:label>
                        <div>性別</div>
                    </template>
                    <v-radio label="男性" :value="0"></v-radio>
                    <v-radio label="女性" :value="1" class="ml-2"></v-radio>
                    <v-radio label="不明" :value="2" class="ml-2"></v-radio>
                  </v-radio-group>
                  <InputError class="" :message="customerForm.errors.memo" />
                  <TextArea
                  label="メモ"
                  id="memo"
                  v-model="customerForm.memo"
                  icon="mdi-book-open-blank-variant-outline"
                  class="block w-full"
                  autocomplete="メモ"
                  />
                  <v-btn :disabled="customerForm.processing" color="blue-darken-1" type="submit" class="text-none" rounded="xs" size="x-large" variant="flat" block>登録する</v-btn>
                </form>
              </v-col>
            </v-row>
          </v-container>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>