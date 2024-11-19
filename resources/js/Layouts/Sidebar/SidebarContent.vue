<script setup lang="ts">
import SidebarContentMenu from "./SidebarContentMenu.vue"
</script>

<template>
  <div
    class="flex h-full w-[252px] flex-col justify-between overflow-y-auto p-8"
  >
    <div class="">
      <div class="flex gap-3">
        <p class="inline-block text-[32px] font-semibold">DNX</p>
      </div>

      <div class="mt-[60px]">
        <SidebarContentMenu />
      </div>
    </div>
  </div>
</template>
