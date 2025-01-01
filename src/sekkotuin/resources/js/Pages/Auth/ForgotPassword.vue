<script setup lang="ts">
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';

defineProps<{
	status?: string;
}>();

const form = useForm({
	email: '',
});

const submit = () => {
	form.post(route('password.email'));
};
</script>

<template>
	<GuestLayout>
		<Head title="Forgot Password" />

		<div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
		メールアドレスをお知らせいただければ、新しいパスワードを選択できるパスワードリセットリンクをメールでお送りします。
		</div>

		<div
			v-if="status"
			class="mb-4 text-sm font-medium text-green-600 dark:text-green-400"
		>
			{{ status }}
		</div>

		<form @submit.prevent="submit">
			<div>

				<TextInput
					id="email"
					v-model="form.email"
					type="email"
					label="メールアドレス"
					icon="mdi-email"
					class="mt-1 block w-full"
					required
					autofocus
					autocomplete="username"
				/>

				<InputError class="mt-2" :message="form.errors.email" />
			</div>

			<div class="mt-4 flex items-center justify-end">
				<PrimaryButton
					:class="{ 'opacity-25': form.processing }"
					:disabled="form.processing"
				>
					送信する
				</PrimaryButton>
			</div>
		</form>
	</GuestLayout>
</template>
