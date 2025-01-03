<script setup lang="ts">
  import { onMounted } from 'vue';
  import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
  import { Head } from '@inertiajs/vue3'; 

  const props = defineProps<{
    customers: {id: number, full_name: string, full_name_kana: string, created_at:string}[]
  }>()
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
					class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800"
				>
          <v-container>
            <v-row>
              <v-col cols="12">
                <v-data-table
                  :items="customers"
                >
                </v-data-table>
              </v-col>
            </v-row>
          </v-container>
				</div>
			</div>
		</div>
	</AuthenticatedLayout>
</template>