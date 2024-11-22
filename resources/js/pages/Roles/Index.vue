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
import type { Role } from "@/types/models/role"
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

defineProps<{
  roles: Role[]
}>()

const onDelete = (id: number) => {
  router.delete(`/roles/${id}`)
}
</script>

<template>
  <div>
    <h1 class="py-4 text-2xl font-bold">Roles</h1>
    <div className="mb-4 flex justify-end">
      <Button as-child>
        <Link href="/roles/create">Create new Role</Link>
      </Button>
    </div>
    <Table>
      <TableHeader>
        <TableRow>
          <TableHead>#</TableHead>
          <TableHead>Name</TableHead>
          <TableHead>Permissions</TableHead>
          <TableHead class="text-end">Actions</TableHead>
        </TableRow>
      </TableHeader>
      <TableBody>
        <TableRow v-for="(role, index) in roles" :key="role.id">
          <TableCell>{{ index + 1 }}</TableCell>
          <TableCell class="w-[200px]">{{ role.name }}</TableCell>
          <TableCell>
            <span v-for="permission in role.permissions" :key="permission.id">
              {{ permission.name }},
            </span>
          </TableCell>
          <TableCell class="flex justify-end gap-2">
            <Button size="icon" as-child>
              <Link :href="`/roles/${role.id}/edit`">
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
