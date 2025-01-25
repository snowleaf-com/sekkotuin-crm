<script setup lang="ts">

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
</script>

<template>
	<v-text-field :label="label" v-model="model"  :type="type" variant="plain" class="text-field-display" readonly/>
</template>

<style scoped>
.text-field-display .v-input__control {
  border: none; /* 囲いをなくす */
  background: none; /* 背景を透明に */
  color: black; /* 文字色を黒に */
  cursor: default; /* クリック可能でない見た目 */
  pointer-events: none; /* 完全な表示専用 */
}
</style>