<script setup lang="ts">
import { router } from "@inertiajs/vue3"
import { toast } from "vue-sonner"
import { EditIcon, Trash2Icon } from "lucide-vue-next"
import {
  Table,
  TableBody,
  TableCell,
  TableHead,
  TableHeader,
  TableRow,
} from "@/components/ui/table"
import type { Permission } from "@/types/models/permission"
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

const props = defineProps<{
  message?: string
  permissions: Permission[]
}>()

const onDelete = (id: number) => {
  router.delete(`/permissions/${id}`)
}

if (props.message) {
  toast.success(props.message)
}
</script>

<template>
  <div>
    <h1 class="py-4 text-2xl font-bold">Permissions</h1>
    <div className="mb-4 flex justify-end">
      <Button as-child>
        <Link href="/permissions/create">Create new Permission</Link>
      </Button>
    </div>
    <Table>
      <TableHeader>
        <TableRow>
          <TableHead>#</TableHead>
          <TableHead>Name</TableHead>
          <TableHead class="text-end">Actions</TableHead>
        </TableRow>
      </TableHeader>
      <TableBody>
        <TableRow
          v-for="(permission, index) in permissions"
          :key="permission.id"
        >
          <TableCell>{{ index + 1 }}</TableCell>
          <TableCell class="w-1/2">{{ permission.name }}</TableCell>
          <TableCell class="flex justify-end gap-2">
            <Button size="icon" as-child>
              <Link :href="`/permissions/${permission.id}/edit`">
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
                    <AlertDialogAction @click="onDelete(permission.id)">
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
