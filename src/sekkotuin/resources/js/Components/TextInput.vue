<script setup lang="ts">
import { onMounted, ref } from 'vue';

const props = withDefaults(
  defineProps<{
		label?: string;
    type?: string;
    icon?: string;
  }>(),
  {
    type: 'text', // type のデフォルト値
    icon: 'mdi-home',    // icon のデフォルト値
  },
);

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
	<v-text-field :label="label" ref="input" v-model="model"  :prepend-inner-icon="icon" :type="type" variant="outlined"/>
</template>
