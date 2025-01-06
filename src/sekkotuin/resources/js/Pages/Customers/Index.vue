<script setup lang="ts">
  import { onMounted } from 'vue';
  import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
  import { Head } from '@inertiajs/vue3';
  // import { DataTableHeader } from '@/types/vuetify';

  const props = defineProps<{
    customers: {id: number, full_name: string, full_name_kana: string, created_at:string}[]
  }>()

  // const headers:DataTableHeader[] = [
  //   { title: 'ID', key: 'id' },
  //   { title: '名前', key: 'full_name' },
  //   { title: 'かな', key: 'full_name_kana' },
  //   { title: '最終来院日', key: 'created_at' },
  // ];

  onMounted(() => {
    console.log(props.customers);
  })
</script>

<template>
	<Head title="Dashboard" />

	<AuthenticatedLayout>
		<template #header>
			<h2
				class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200"
			>
				顧客関連
			</h2>
		</template>

		<div class="">
			<div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
				<div
					class="overflow-hidden bg-white shadow-lg sm:rounded-lg dark:bg-gray-800"
				>
          <v-container>
            <v-row class="justify-center">
              <v-col cols="10">
                <!-- <v-data-table
                  :items="customers"
                  :headers="headers"
                  item-key="id"
                >
                </v-data-table> -->
                <v-table density="compact">
                  <thead>
                    <tr>
                      <th class="text-left">ID</th>
                      <th class="text-right">名前</th>
                      <th class="text-right">かな</th>
                      <th class="text-right">最終来院日</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr
                      v-for="item in customers" :key="item.id">
                      <td>{{ item.id }}</td>
                      <td class="text-right">{{ item.full_name }}</td>
                      <td class="text-right">{{ item.full_name_kana }}</td>
                      <td class="text-right">{{ item.created_at }}</td>
                    </tr>
                  </tbody>
                </v-table>
              </v-col>
            </v-row>
          </v-container>
				</div>
			</div>
		</div>
	</AuthenticatedLayout>
</template>