<script lang="ts" setup>
import { Sidebar } from "./Sidebar"
import { Header } from "./Header"
import { Toaster } from "vue-sonner"
</script>
<template>
  <div class="flex h-screen flex-col lg:flex-row">
    <Sidebar />
    <div class="flex-1 overflow-y-auto bg-[#FAFAFA]">
      <Header />
      <main class="p-4 lg:p-6">
        <slot />
      </main>
    </div>
    <Toaster position="top-center" richColors />
  </div>
</template>
