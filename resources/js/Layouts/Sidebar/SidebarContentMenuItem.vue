<script setup lang="ts">
import { cn } from "@/lib/utils";
import type { NavItem } from "@/types/nav";

console.log(route().current());
const { item } = defineProps<{
    item: NavItem;
}>();
</script>
<template>
    <Link
        :href="route(item.href)"
        :class="
            cn(
                'flex items-center gap-3 rounded-md px-5 py-2.5 text-sm font-semibold text-secondary-300 transition-colors hover:bg-muted hover:text-foreground',
                {
                    'bg-muted text-foreground': $page.component === item.title,
                },
            )
        "
    >
        <component :is="item.icon" />
        <span>{{ item.title }}</span>
    </Link>
</template>
