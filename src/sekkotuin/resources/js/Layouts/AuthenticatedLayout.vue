<script setup lang="ts">
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
import { ref } from 'vue';

const drawer = ref(false);
const navigationLinks = [
	{ name: 'Dashboard', route: route('dashboard'), icon: 'mdi-view-dashboard' },
];
</script>

<template>
	<v-app>
		<!-- ヘッダー -->
		<v-app-bar color="white" elevated>
			<!-- ハンバーガーメニュー -->
			<v-app-bar-nav-icon @click="drawer = !drawer" />

			<!-- タイトル -->
			<v-toolbar-title>
				<Link :href="route('dashboard')">
					<ApplicationLogo
						class="block h-12 w-auto fill-current text-gray-800"
					/>
				</Link>
			</v-toolbar-title>

			<!-- ユーザー情報 -->
			<v-spacer />
			<v-menu offset-y>
				<template #activator="{ props }">
					<v-btn v-bind="props" variant="text">
						{{ $page.props.auth.user.name }}
						<v-icon right>mdi-chevron-down</v-icon>
					</v-btn>
				</template>
				<v-list>
					<Link
						:href="route('profile.edit')"
						class="v-list-item cursor-pointer hover:bg-gray-100"
					>
						<v-list-item>
							<v-list-item-title>Profile</v-list-item-title>
						</v-list-item>
					</Link>
					<Link
						:href="route('logout')"
						method="post"
						class="v-list-item cursor-pointer hover:bg-gray-100"
					>
						<v-list-item>
							<v-list-item-title>Log Out</v-list-item-title>
						</v-list-item>
					</Link>
				</v-list>
			</v-menu>
		</v-app-bar>

		<!-- サイドバー -->
		<v-navigation-drawer app v-model="drawer" temporary>
			<!-- サイドバーのナビゲーションリンク -->
			<v-list>
				<v-list-item
					v-for="item in navigationLinks"
					:key="item.name"
					:active-class="'v-list-item--active'"
					class="v-list-item"
				>
					<Link
						:href="item.route"
						class="v-list-item w-auto cursor-pointer hover:bg-gray-100"
					>
						<v-icon class="mr-3">{{ item.icon }}</v-icon>
						<v-list-item-title>{{ item.name }}</v-list-item-title>
					</Link>
				</v-list-item>
			</v-list>
		</v-navigation-drawer>

		<!-- ページのコンテンツ -->
		<v-main>
			<!-- ヘッダー -->
			<header class="mt-4 bg-white" v-if="$slots.header">
				<div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
					<slot name="header" />
				</div>
			</header>

			<!-- メインコンテンツ -->
			<slot />
		</v-main>
	</v-app>
</template>

<style scoped>
.v-list-item--active {
	background-color: rgba(0, 0, 0, 0.08);
}
</style>
