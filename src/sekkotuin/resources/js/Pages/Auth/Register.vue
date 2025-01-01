<script setup lang="ts">
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
	name: '',
	email: '',
	password: '',
	password_confirmation: '',
});

const submit = () => {
	form.post(route('register'), {
		onFinish: () => {
			form.reset('password', 'password_confirmation');
		},
	});
};
</script>

<template>
	<GuestLayout>
		<Head title="Register" />

		<form @submit.prevent="submit">
			<div>
				<TextInput
					label="名前"
					id="name"
					v-model="form.name"
					type="text"
					class="mt-1 block w-full"
					icon="mdi-pen"
					required
					autofocus
					autocomplete="name"
				/>

				<InputError class="mb-6" :message="form.errors.name" />
			</div>

			<div class="">

				<TextInput
					label="メールアドレス"
					id="email"
					v-model="form.email"
					type="email"
					icon="mdi-email"
					class="mt-1 block w-full"
					required
					autocomplete="username"
				/>

				<InputError class="mb-6" :message="form.errors.email" />
			</div>

			<div class="">

				<TextInput
					label="パスワード"
					id="password"
					v-model="form.password"
					type="password"
					icon="mdi-lock"
					class="mt-1 block w-full"
					required
					autocomplete="new-password"
				/>

				<InputError class="mb-6" :message="form.errors.password" />
			</div>

			<div class="">

				<TextInput
					label="パスワード再入力"
					id="password_confirmation"
					v-model="form.password_confirmation"
					type="password"
					icon="mdi-lock"
					class="mt-1 block w-full"
					required
					autocomplete="new-password"
				/>

				<InputError class="mb-6" :message="form.errors.password_confirmation" />
			</div>

			<div class="mt-4 flex items-center justify-end">
				<Link
					:href="route('login')"
					class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:text-gray-400 dark:hover:text-gray-100 dark:focus:ring-offset-gray-800"
				>
					登録済みの方はこちら
				</Link>

				<PrimaryButton
					class="ms-4"
					:class="{ 'opacity-25': form.processing }"
					:disabled="form.processing"
				>
					登録する
				</PrimaryButton>
			</div>
		</form>
	</GuestLayout>
</template>
