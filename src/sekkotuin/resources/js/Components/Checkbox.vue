<script setup lang="ts">
import { computed } from 'vue';

const emit = defineEmits(['update:checked']);

const props = defineProps<{
	checked: boolean;
	value?: any;
	label?: string;
}>();

const proxyChecked = computed({
	get() {
		return props.checked;
	},

	set(val) {
		emit('update:checked', val);
	},
});
</script>

<template>
	<v-checkbox
		v-model="proxyChecked"
		:value="value"
		:label="label"
	/>
</template>
