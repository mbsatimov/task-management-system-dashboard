<script setup lang="ts">
import type { NavItem } from "@/types/nav"
import SidebarContentMenuItem from "./SidebarContentMenuItem.vue"
import { LayoutListIcon } from "lucide-vue-next"

const items: NavItem[] = [
  {
    title: "Users",
    href: "users",
    icon: LayoutListIcon,
  },
  {
    title: "Tasks",
    href: "tasks",
    icon: LayoutListIcon,
  },
  {
    title: "Mentors",
    href: "mentors",
    icon: LayoutListIcon,
  },
  {
    title: "Groups",
    href: "groups",
    icon: LayoutListIcon,
  },
]
</script>
<template>
  <nav class="space-y-6">
    <SidebarContentMenuItem
      v-for="item in items"
      :key="item.href"
      :item="item"
    />
  </nav>
</template>
