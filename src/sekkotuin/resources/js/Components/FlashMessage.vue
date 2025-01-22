<script setup lang="ts">
  import { usePage } from '@inertiajs/vue3';
  import { ref } from 'vue';

  const flash = usePage().props.flash;

  // 初期状態でSnackbarを表示するかどうかを設定
  const isSnackbarVisible = ref(flash?.status === 'success');

</script>
<template>
  <v-snackbar v-model="isSnackbarVisible" color="success" location="top center" timeout="2500">
    {{ flash?.message }}
  </v-snackbar>
</template>