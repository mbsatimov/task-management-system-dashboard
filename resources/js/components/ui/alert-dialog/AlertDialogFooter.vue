<script setup lang="ts">
import type { HTMLAttributes } from "vue"
import { cn } from "@/lib/utils"

const props = defineProps<{
  class?: HTMLAttributes["class"]
}>()
</script>

<template>
  <div :class="cn('grid grid-cols-1 gap-1.5 sm:grid-cols-2', props.class)">
    <slot />
  </div>
</template>
