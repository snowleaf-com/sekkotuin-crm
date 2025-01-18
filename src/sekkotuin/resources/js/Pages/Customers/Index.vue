<script setup lang="ts">
  import { onMounted, computed } from 'vue';
  import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
  import { Head, useForm } from '@inertiajs/vue3';
  import dayjs from 'dayjs';
  import { LaravelPagination } from '@/types/laravel';
  import Pagination from '@/Components/Pagination.vue';
  import { Link } from '@inertiajs/vue3';

  // customers のデータ構造を定義
  type Customer = {
    id: number;
    full_name: string;
    full_name_kana: string;
    created_at: string;
  };
  // フォームの型を定義
  type SearchForm = {
    searchKeyword?: string;
  };
  type SortForm = {
    sortVal: 'asc' | 'desc';
  };

  // props管理
  // LaravelPagination<Customer> を使用
  const props = defineProps<{
    customers: LaravelPagination<Customer>;
    keyword: string;
    sort: 'asc' | 'desc';
  }>();

  // フォームデータ管理
  const searchForm = useForm<SearchForm>({
    searchKeyword: ""
  })
  const sort = useForm<SortForm>({
    sortVal: "desc"
  })

  // ソートアイコンの切り替え
  const getSortIcon = () => {
    return sort.sortVal === 'asc' ? "mdi-menu-up" : "mdi-menu-down";
  }

  // 動的にクエリパラメータを生成
const queryParams = computed(() => {
  const params:Record<string, string> = {}
  if (searchForm.searchKeyword) {
    params.searchKeyword = searchForm.searchKeyword;
  }
  if (sort.sortVal) {
    params.sortVal = sort.sortVal;
  }
  return params;
});

  // GET送信用関数
  const searchByName = () => {
    searchForm.get(route('customers.index', queryParams.value))
  }
  const sortHandler = () => {
    sort.sortVal = sort.sortVal === "asc" ? "desc" : "asc";

    sort.get(route('customers.index', queryParams.value))
  }

  // 画面マウント後処理
  onMounted(() => {
    //検索ワードを保持する
    searchForm.searchKeyword = props.keyword
    sort.sortVal = props.sort
  })
</script>

<template>
	<Head title="顧客一覧" />

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
            <v-row>
              <v-col cols="1">

              </v-col>
              <v-col cols="3" class="d-flex">
                <form @submit.prevent class="w-100">
                  <v-text-field density="compact" label="顧客検索" variant="solo" hide-details single-line v-model="searchForm.searchKeyword">
                    <template #append-inner>
                      <button @click="searchByName" type="submit" class="icon-button"> 
                        <v-icon>mdi-magnify</v-icon>
                      </button>
                    </template> 
                  </v-text-field>
                </form>
              </v-col>
              <v-col cols="5">
              </v-col>
              <v-col cols="2"><Link :href="route('customers.create')"><v-btn color="blue" class="w-full">顧客登録</v-btn></Link>
              </v-col>
              <v-col cols="1">
              </v-col>
            </v-row>
            <v-row class="justify-center">
              <v-col cols="12" md="10" lg="10" xl="10">
                <v-table density="compact">
                  <thead>
                    <tr>
                      <th class="text-left">ID</th>
                      <th class="text-right">名前</th>
                      <th class="text-right">かな</th>
                      <th class="text-right">
                        <button @click="sortHandler">
                          最終来院日
                          <v-icon>{{ getSortIcon() }}</v-icon>
                        </button>
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr
                      v-for="item in customers.data" :key="item.id">
                      <td>{{ item.id }}</td>
                      <td class="text-right">{{ item.full_name }}</td>
                      <td class="text-right">{{ item.full_name_kana }}</td>
                      <td class="text-right">{{ dayjs(item.created_at).format("YYYY-MM-DD") }}</td>
                    </tr>
                  </tbody>
                </v-table>
              </v-col>
              <Pagination class="my-6" :links="customers.links" />
            </v-row>
          </v-container>
				</div>
			</div>
		</div>
	</AuthenticatedLayout>
</template>