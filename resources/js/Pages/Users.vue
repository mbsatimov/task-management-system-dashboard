<script setup lang="ts">
import { Edit2Icon } from "lucide-vue-next"
import {
  Table,
  TableBody,
  TableCell,
  TableHead,
  TableHeader,
  TableRow,
} from "@/components/ui/table"
import { User } from "@/types/models/user"

defineProps<{
  users: Pagination<User>
}>()
</script>

<template>
  <Table>
    <TableHeader>
      <TableRow>
        <TableHead>Full Name</TableHead>
        <TableHead>Email</TableHead>
        <TableHead>Role</TableHead>
        <TableHead>Created at</TableHead>
        <TableHead>Updated at</TableHead>
        <TableHead>Actions</TableHead>
      </TableRow>
    </TableHeader>
    <TableBody>
      <TableRow v-for="user in users.data" :key="user.id">
        <TableCell>{{ user.full_name }}</TableCell>
        <TableCell>{{ user.email }}</TableCell>
        <TableCell>{{ user.role }}</TableCell>
        <TableCell>{{ user.created_at }}</TableCell>
        <TableCell>{{ user.updated_at }}</TableCell>
        <TableCell>
          <Edit2Icon />
        </TableCell>
      </TableRow>
    </TableBody>
  </Table>
</template>
