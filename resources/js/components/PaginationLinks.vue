<script lang="ts" setup>
import { Pagination } from "@/types/pagination"

defineProps<{
  paginator: Pagination
}>()

const makeLabel = (label: string) => {
  if (label.includes("Previous")) {
    return "<<"
  } else if (label.includes("Next")) {
    return ">>"
  } else {
    return label
  }
}
</script>

<template>
  <div class="flex items-start justify-between">
    <p class="text-sm text-slate-600">
      Showing {{ paginator.from }} to {{ paginator.to }} of
      {{ paginator.total }} results
    </p>

    <div class="flex items-center overflow-hidden rounded-md shadow-sm">
      <div v-for="link in paginator.links" :key="link.label">
        <component
          :is="link.url ? 'Link' : 'span'"
          :class="{
            'hover:bg-background': link.url,
            'text-muted-foreground': !link.url,
            'font-bold text-blue-500': link.active,
          }"
          :href="link.url"
          class="grid h-12 w-12 place-items-center border border-x bg-background"
          v-html="makeLabel(link.label)"
        />
      </div>
    </div>
  </div>
</template>
