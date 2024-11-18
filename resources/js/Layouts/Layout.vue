<script setup lang="ts">
import { Sidebar } from "./Sidebar";
import { Toaster } from "@/components/ui/sonner";
</script>
<template>
    <div class="h-screen lg:flex">
        <Sidebar />
        <main class="overflow-y-auto bg-[#FAFAFA] lg:flex-1">
            <slot />
        </main>
        <Toaster />
    </div>
</template>
