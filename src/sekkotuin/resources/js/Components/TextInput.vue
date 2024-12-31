<script setup lang="ts">
import { onMounted, ref } from 'vue';

const props = defineProps<{
	label: string;
}>();

const model = defineModel<string>({ required: true });

const input = ref<HTMLInputElement | null>(null);

onMounted(() => {
	if (input.value?.hasAttribute('autofocus')) {
		input.value?.focus();
	}
});

defineExpose({ focus: () => input.value?.focus() });
</script>

<template>
	<v-text-field :label="label" ref="input" v-model="model" />
	<!-- <input
		ref="input"
		v-model="model"
		class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-indigo-600 dark:focus:ring-indigo-600"
	/> -->
</template>
