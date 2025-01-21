<script setup lang="ts">
  import { usePage } from '@inertiajs/vue3';

  const flash = usePage().props.flash;
</script>
<template>
  <v-snackbar v-if="flash?.status === 'success'">
    {{ flash.message }}
  </v-snackbar>
  <!-- <div v-if="flash?.status === 'success'">
    {{ flash?.message }}
  </div> -->
</template>