<script lang="ts" setup>
import SidebarContentMenu from "./SidebarContentMenu.vue"
</script>

<template>
  <div
    class="flex h-full w-[252px] flex-col justify-between overflow-y-auto p-8"
  >
    <div class="">
      <div class="flex items-center gap-3">
        <img alt="Logo" class="size-10" src="/public/logo.png" />
        <Link class="inline-block text-[32px] font-semibold" href="/">DNX</Link>
      </div>

      <div class="mt-[60px]">
        <SidebarContentMenu />
      </div>
    </div>
  </div>
</template>
