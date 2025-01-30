<script setup lang="ts">
  import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
  import { Head, useForm, router } from '@inertiajs/vue3';
  import DisplayTextField from '@/Components/DisplayTextField.vue';
  import { ref } from 'vue';
  import ConfirmDeleteDialog from '@/Components/ConfirmDeleteDialog.vue';

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

  type Query = {
    page?: number;
    sortVal?: 'asc' | 'desc';
    searchKeyword?: string;
  }

  const props = defineProps<{ customer: Customer, query: Query}>();

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

  const dialog = ref<boolean>(false);

  const goToCustomerEdit = () => {
    router.get(route('customers.edit', {
      'customer': customerForm.id
    }))
  }
  
  const goToCustomerDelete = () => {
    customerForm.delete(route('customers.destroy', {
      'customer' : customerForm.id
    }))
    dialog.value = false
  }

  const goBack = () => {
    router.get(route('customers.index', {
      ...props.query
    }))
  }

</script>
<template>
	<Head title="顧客詳細" />

	<AuthenticatedLayout>
    
    <template #header>
      <v-btn variant="text" @click="goBack">
        <v-icon class="mr-2">mdi-chevron-left</v-icon>
        戻る
      </v-btn>
      <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200 text-center">
        顧客詳細
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
                <div class="d-flex">
                  <DisplayTextField
                  label="姓"
                  id="last_name"
                  v-model="customerForm.last_name"
                  type="text"
                  icon="mdi-card-bulleted-outline"
                  class="block w-full"
                  readonly
                  />
                  <DisplayTextField
                  label="名"
                  id="first_name"
                  v-model="customerForm.first_name"
                  type="text"
                  icon="mdi-card-bulleted-outline"
                  class="block w-full ml-2"
                  readonly
                  />
                </div>
                <div class="d-flex">
                  <DisplayTextField
                  label="姓カナ"
                  id="last_name_kana"
                  v-model="customerForm.last_name_kana"
                  type="text"
                  icon="mdi-card-bulleted-outline"
                  class="block w-full"
                  readonly
                  />
                  <DisplayTextField
                  label="名カナ"
                  id="first_name_kana"
                  v-model="customerForm.first_name_kana"
                  type="text"
                  icon="mdi-card-bulleted-outline"
                  class="block w-full ml-2"
                  readonly
                  />
                </div>
                <DisplayTextField
                label="郵便番号"
                id="postcode"
                v-model="customerForm.postcode"
                type="number"
                icon="mdi-post-lamp"
                class="block w-full"
                />
                <DisplayTextField
                label="住所"
                id="address"
                v-model="customerForm.address"
                type="text"
                icon="mdi-home"
                class="block w-full"
                readonly
                />
                <DisplayTextField
                label="電話番号"
                id="tel"
                v-model="customerForm.tel"
                type="number"
                icon="mdi-phone"
                class="block w-full"
                readonly
                />
                <DisplayTextField
                label="誕生日"
                id="birth"
                v-model="customerForm.birth"
                type="date"
                icon="mdi-cake"
                class="block w-full"
                readonly
                />
                <div class="mb-5">
                  <v-list-item-subtitle>性別</v-list-item-subtitle>
                  <v-list-item-title v-if="customerForm.gender === 0">男性</v-list-item-title>
                  <v-list-item-title v-if="customerForm.gender === 1">女性</v-list-item-title>
                  <v-list-item-title v-if="customerForm.gender === 2">その他</v-list-item-title>
                </div>
                <v-textarea
                label="メモ"
                id="memo"
                v-model="customerForm.memo"
                icon="mdi-book-open-blank-variant-outline"
                class="block w-full"
                variant="plain"
                readonly
                />
              </v-col>
            </v-row>
            <v-row>
              <v-col lg="3"></v-col>
              <v-col md="12" lg="6" cols="12">
                <v-btn color="blue-darken-1" class="text-none w-full" rounded="xs" size="x-large" variant="flat" @click="goToCustomerEdit">編集する</v-btn>
              </v-col>
            </v-row>
            <v-row>
              <v-col lg="3"></v-col>
              <v-col md="12" lg="6" cols="12">
                <v-btn color="red-darken-1 w-full" class="text-none" rounded="xs" size="x-large" variant="flat" @click="dialog = true">削除する</v-btn>
              </v-col>
            </v-row>
          </v-container>
          <ConfirmDeleteDialog v-model:visible="dialog"
          @confirm="goToCustomerDelete" />
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>