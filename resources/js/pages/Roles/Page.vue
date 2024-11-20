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
import {
  Dialog,
  DialogContent,
  DialogHeader,
  DialogTitle,
  DialogTrigger,
} from "@/components/ui/dialog"

import RoleForm from "./RoleForm.vue"

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
      <Dialog>
        <DialogTrigger as-child>
          <Button>Create new Role</Button>
        </DialogTrigger>
        <DialogContent>
          <DialogHeader>
            <DialogTitle>Create New Role</DialogTitle>
          </DialogHeader>
          <RoleForm />
        </DialogContent>
      </Dialog>
    </div>
    <Table>
      <TableHeader>
        <TableRow>
          <TableHead>Name</TableHead>
          <TableHead>Created at</TableHead>
          <TableHead>Updated at</TableHead>
          <TableHead class="text-end">Actions</TableHead>
        </TableRow>
      </TableHeader>
      <TableBody>
        <TableRow v-for="role in roles" :key="role.id">
          <TableCell>{{ role.name }}</TableCell>
          <TableCell>{{ role.created_at }}</TableCell>
          <TableCell>{{ role.updated_at }}</TableCell>
          <TableCell class="flex justify-end gap-2">
            <Dialog>
              <DialogTrigger as-child>
                <Button size="icon">
                  <EditIcon />
                </Button>
              </DialogTrigger>
              <DialogContent>
                <DialogHeader>
                  <DialogTitle>Update Role</DialogTitle>
                </DialogHeader>
                <RoleForm :default-values="role" />
              </DialogContent>
            </Dialog>
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
