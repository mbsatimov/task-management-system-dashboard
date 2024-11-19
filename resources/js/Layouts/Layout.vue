<script setup lang="ts">
import { Toaster } from "@/components/ui/sonner"
import { Sidebar } from "./Sidebar"
import { Header } from "./Header"
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
    <Toaster />
  </div>
</template>
