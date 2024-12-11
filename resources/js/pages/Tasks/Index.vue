<script lang="ts" setup>
import { router, usePage } from "@inertiajs/vue3"
import { EditIcon, Trash2Icon } from "lucide-vue-next"
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from "@/components/ui/table"
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
import { computed, ref, watch } from "vue"
import { TaskPreview } from "@/types/models/task"
import { Pagination } from "@/types/pagination"
import { debounce } from "lodash"
import { Input } from "@/components/ui/input"
import PaginationLinks from "@/components/PaginationLinks.vue"

const props = defineProps<{
  tasks: Pagination<TaskPreview>
  searchTerm: string | null
}>()

const search = ref(props.searchTerm || "")

watch(search, value =>
  debounce(
    () => router.get("/tasks", { search: value }, { preserveState: true }),
    500
  )()
)

const onDelete = (id: number) => {
  router.delete(`/tasks/${id}`)
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
    <h1 class="py-4 text-2xl font-bold">Tasks</h1>
    <div class="mb-4 flex justify-between gap-4">
      <Input
        v-model="search"
        class="max-w-md"
        placeholder="Search..."
        type="text"
      />
      <Button as-child>
        <Link href="/tasks/create">Create new Task</Link>
      </Button>
    </div>
    <Table>
      <TableHeader>
        <TableRow>
          <TableHead>Title</TableHead>
          <TableHead>Category</TableHead>
          <TableHead>Mentor</TableHead>
          <TableHead>Students Count</TableHead>
          <TableHead class="text-end">Actions</TableHead>
        </TableRow>
      </TableHeader>
      <TableBody>
        <TableRow v-for="task in tasks.data" :key="task.id">
          <TableCell>{{ task.title }}</TableCell>
          <TableCell>{{ task.category.name }}</TableCell>
          <TableCell>{{ task.mentor.name }}</TableCell>
          <TableCell>{{ task.students_count }}</TableCell>
          <TableCell class="flex justify-end gap-2">
            <Button as-child size="icon">
              <Link :href="`/tasks/${task.id}/edit`">
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
                    <AlertDialogAction @click="onDelete(task.id)">
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
    <PaginationLinks :paginator="tasks" class="mt-4" />
  </div>
</template>
