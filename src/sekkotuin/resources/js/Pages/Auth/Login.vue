<script setup lang="ts">
import Checkbox from '@/Components/Checkbox.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps<{
	canResetPassword?: boolean;
	status?: string;
}>();

const form = useForm({
	email: '',
	password: '',
	remember: false,
});

const submit = () => {
	form.post(route('login'), {
		onFinish: () => {
			form.reset('password');
		},
	});
};
</script>

<template>
	<GuestLayout>
		<Head title="Log in" />

		<div v-if="status" class="mb-4 text-sm font-medium text-green-600">
			{{ status }}
		</div>

		<form @submit.prevent="submit">
			<div>
				<!-- <InputLabel for="email" value="Email" /> -->

				<TextInput
					label="メールアドレス"
					id="email"
					v-model="form.email"
					type="email"
					icon="mdi-email"
					class="mt-1 block w-full"
					required
					autofocus
					autocomplete="username"
				/>

				<InputError class="" :message="form.errors.email" />
			</div>

			<div>
				<!-- <InputLabel for="password" value="Password" /> -->

				<TextInput
					label="パスワード"
					id="password"
					v-model="form.password"
					type="password"
					icon="mdi-key"
					class="mt-1 block w-full"
					required
					autocomplete="current-password"
				/>

				<InputError class="" :message="form.errors.password" />
			</div>

			<div class="block">
				<Checkbox v-model:checked="form.remember" name="remember" label="ログイン状態を保存する" />
			</div>

			<div class="flex items-center justify-end">
				<Link
					v-if="canResetPassword"
					:href="route('password.request')"
					class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:text-gray-400 dark:hover:text-gray-100 dark:focus:ring-offset-gray-800"
				>
					パスワードを忘れた方はこちら
				</Link>

				<PrimaryButton
					class="ms-4"
					:class="{ 'opacity-25': form.processing }"
					:disabled="form.processing"
				>
					ログインする
				</PrimaryButton>
			</div>
		</form>
	</GuestLayout>
</template>
