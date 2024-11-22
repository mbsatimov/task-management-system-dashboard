<script setup lang="ts">
import { router } from "@inertiajs/vue3"
import { EditIcon, Trash2Icon } from "lucide-vue-next"
import {
  Table,
  TableBody,
  TableCell,
  TableHead,
  TableHeader,
  TableRow,
} from "@/components/ui/table"
import {
  AlertDialog,
  AlertDialogCancel,
  AlertDialogContent,
  AlertDialogFooter,
  AlertDialogHeader,
  AlertDialogTitle,
  AlertDialogTrigger,
  AlertDialogAction,
} from "@/components/ui/alert-dialog"
import { Button } from "@/components/ui/button"
import { User } from "@/types/models/user"
import { Pagination } from "@/types/pagination"

defineProps<{
  users: Pagination<User>
}>()

const onDelete = (id: number) => {
  router.delete(`/users/${id}`)
}
</script>

<template>
  <div>
    <h1 class="py-4 text-2xl font-bold">Roles</h1>
    <div className="mb-4 flex justify-end">
      <Button as-child>
        <Link href="/users/create">Create new User</Link>
      </Button>
    </div>
    <Table>
      <TableHeader>
        <TableRow>
          <TableHead>Name</TableHead>
          <TableHead>Email</TableHead>
          <TableHead>Role</TableHead>
          <TableHead>Actions</TableHead>
        </TableRow>
      </TableHeader>
      <TableBody>
        <TableRow v-for="user in users.data" :key="user.id">
          <TableCell>{{ user.name }}</TableCell>
          <TableCell>{{ user.email }}</TableCell>
          <TableCell>
            <span v-for="(role, i) in user.roles" :key="role.id">
              {{ role.name }}
              <span v-if="i < user.roles.length - 1">, </span>
            </span>
          </TableCell>
          <TableCell class="flex justify-end gap-2">
            <Button size="icon" as-child>
              <Link :href="`/users/${user.id}/edit`">
                <EditIcon />
              </Link>
            </Button>
            <AlertDialog>
              <AlertDialogTrigger>
                <Button variant="destructive" size="icon">
                  <Trash2Icon />
                </Button>
              </AlertDialogTrigger>
              <AlertDialogContent>
                <AlertDialogHeader>
                  <div class="rounded-xl bg-destructive/15 p-2">
                    <Trash2Icon class="size-8 text-destructive" />
                  </div>
                  <AlertDialogTitle>Are you sure?</AlertDialogTitle>
                </AlertDialogHeader>
                <AlertDialogFooter>
                  <AlertDialogCancel>Cancel</AlertDialogCancel>
                  <Button variant="destructive" size="sm" as-child>
                    <AlertDialogAction @click="onDelete(role.id)">
                      Delete
                    </AlertDialogAction>
                  </Button>
                </AlertDialogFooter>
              </AlertDialogContent>
            </AlertDialog>
          </TableCell>
        </TableRow>
      </TableBody>
    </Table>
  </div>
</template>
