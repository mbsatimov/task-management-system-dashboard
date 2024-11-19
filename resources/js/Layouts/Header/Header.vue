<script setup lang="ts">
import { MenuIcon } from "lucide-vue-next"
import { Button } from "@/components/ui/button"
import {
  Sheet,
  SheetTrigger,
  SheetContent,
  SheetTitle,
} from "@/components/ui/sheet"
import SidebarContent from "../Sidebar/SidebarContent.vue"
</script>
<template>
  <div class="flex h-20 items-center bg-white px-4">
    <Sheet>
      <SheetTrigger as-child>
        <Button size="icon" variant="ghost" class="rounded-full lg:hidden">
          <MenuIcon />
        </Button>
      </SheetTrigger>
      <SheetContent class="w-fit p-0" side="left">
        <SheetTitle class="sr-only">Sidebar</SheetTitle>
        <SidebarContent />
      </SheetContent>
    </Sheet>
  </div>
</template>
