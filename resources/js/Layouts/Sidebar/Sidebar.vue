<script setup lang="ts">
import { ref } from "vue";
import SidebarContent from "./SidebarContent.vue";
import { Sheet, SheetContent, SheetTitle } from "@/components/ui/sheet";

const open = ref(false);
</script>
<template>
    <aside>
        <Sheet v-model:open="open">
            <SheetContent class="w-fit p-0" side="left">
                <SheetTitle class="sr-only">Sidebar</SheetTitle>
                <SidebarContent />
            </SheetContent>
        </Sheet>

        <div class="hidden h-full lg:block">
            <SidebarContent />
        </div>
    </aside>
</template>
