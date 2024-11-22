<script setup lang="ts">
import type { NavItem } from "@/types/nav"
import SidebarContentMenuItem from "./SidebarContentMenuItem.vue"
import {
  LayoutListIcon,
  BoxesIcon,
  UserRoundCheckIcon,
  UsersIcon,
  UserCogIcon,
} from "lucide-vue-next"

const items: NavItem[] = [
  {
    title: "Tasks",
    href: "/tasks",
    icon: LayoutListIcon,
  },
  {
    title: "Groups",
    href: "/groups",
    icon: BoxesIcon,
  },
  {
    title: "Users",
    href: "/users",
    icon: UsersIcon,
  },
  {
    title: "Roles",
    href: "/roles",
    icon: UserCogIcon,
  },
  {
    title: "Permissions",
    href: "/permissions",
    icon: UserCogIcon,
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
