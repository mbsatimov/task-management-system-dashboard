<script lang="ts" setup>
import { router, usePage } from "@inertiajs/vue3"
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
  AlertDialogAction,
  AlertDialogCancel,
  AlertDialogContent,
  AlertDialogFooter,
  AlertDialogHeader,
  AlertDialogTitle,
  AlertDialogTrigger,
} from "@/components/ui/alert-dialog"
import { Button } from "@/components/ui/button"
import { toast } from "vue-sonner"
import { computed } from "vue"
import { Group } from "@/types/models/group"
import { Pagination } from "@/types/pagination"

defineProps<{
  groups: Pagination<Group>
}>()

const onDelete = (id: number) => {
  router.delete(`/groups/${id}`)
}

const page = usePage<{
  flash: { message?: string }
}>()
const message = computed(() => page.props.flash.message)
if (message.value) {
  toast.success(message.value)
}
</script>
<template>
  <div>
    <h1 class="py-4 text-2xl font-bold">Groups</h1>
    <div class="mb-4 flex justify-end">
      <Button as-child>
        <Link href="/groups/create">Create new Group</Link>
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
        <TableRow v-for="(group, index) in groups.data" :key="group.id">
          <TableCell>{{ index + 1 }}</TableCell>
          <TableCell class="w-[200px]">{{ group.name }}</TableCell>
          <TableCell class="flex justify-end gap-2">
            <Button as-child size="icon">
              <Link :href="`/groups/${group.id}/edit`">
                <EditIcon />
              </Link>
            </Button>
            <AlertDialog>
              <AlertDialogTrigger>
                <Button size="icon" variant="destructive">
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
                  <Button as-child size="sm" variant="destructive">
                    <AlertDialogAction @click="onDelete(group.id)">
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
