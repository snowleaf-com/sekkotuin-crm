<script setup lang="ts">
import { ref, watch } from 'vue';

interface Props {
  visible: boolean
}

const props = defineProps<Props>()

const emit = defineEmits<{
  (event: "update:visible", value: boolean) :void
  (event: "confirm") :void
}>()

const localVisible = ref(props.visible)

watch(() => props.visible,
(newVal) => {
  localVisible.value = newVal
})

const closeDialog = () => {
  emit("update:visible", false)
}

const confirmDelete = () => {
  emit("confirm")
  closeDialog()
}
</script>
<template>
  <v-dialog v-model="localVisible" max-width="400px">
    <v-card>
      <v-card-title class="text-h6">本当に削除しますか？</v-card-title>
      <v-card-text>この操作は元に戻せません。</v-card-text>
      <v-card-actions>
        <v-spacer></v-spacer>
        <!-- キャンセルボタン -->
        <v-btn @click="closeDialog">キャンセル</v-btn>
        <!-- 削除確認ボタン -->
        <v-btn color="red-darken-1" class="text-none" variant="flat" @click="confirmDelete">削除</v-btn>
      </v-card-actions>
    </v-card>
</v-dialog>
</template>