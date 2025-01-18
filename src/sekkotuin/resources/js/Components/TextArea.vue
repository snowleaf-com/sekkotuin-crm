<script setup lang="ts">
import { onMounted, ref } from 'vue';

const props = withDefaults(
  defineProps<{
		label?: string;
    icon?: string;
  }>(),
  {
    type: 'text', // type のデフォルト値
    icon: 'mdi-home',    // icon のデフォルト値
  },
);

const model = defineModel<string>({ required: true });

const input = ref<HTMLTextAreaElement | null>(null);

onMounted(() => {
	if (input.value?.hasAttribute('autofocus')) {
		input.value?.focus();
	}
});

defineExpose({ focus: () => input.value?.focus() });
</script>

<template>
	<v-textarea :label="label" ref="input" v-model="model" :prepend-inner-icon="icon" variant="outlined"/>
</template>
