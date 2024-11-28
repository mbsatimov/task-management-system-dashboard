<script lang="ts" setup>
import { router, usePage } from "@inertiajs/vue3"
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
import type { TaskCategory } from "@/types/models/taskCategory"
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
import { computed, ref, watch } from "vue"
import { Input } from "@/components/ui/input"
import { debounce } from "lodash"

const props = defineProps<{
  taskCategories: TaskCategory[]
  searchTerm: string | null
}>()

const search = ref(props.searchTerm || "")

watch(search, value =>
  debounce(
    () =>
      router.get(
        "/task-categories",
        { search: value },
        { preserveState: true }
      ),
    500
  )()
)

const onDelete = (id: number) => {
  router.delete(`/task-categories/${id}`)
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
    <h1 class="py-4 text-2xl font-bold">TaskCategorys</h1>
    <div class="mb-4 flex justify-between gap-4">
      <Input
        v-model="search"
        class="max-w-md"
        placeholder="Search..."
        type="text"
      />
      <Button as-child>
        <Link href="/task-categories/create">Create new TaskCategory</Link>
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
          v-for="(taskCategory, index) in taskCategories"
          :key="taskCategory.id"
        >
          <TableCell>{{ index + 1 }}</TableCell>
          <TableCell class="w-1/2">{{ taskCategory.name }}</TableCell>
          <TableCell class="flex justify-end gap-2">
            <Button as-child size="icon">
              <Link :href="`/task-categories/${taskCategory.id}/edit`">
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
                    <AlertDialogAction @click="onDelete(taskCategory.id)">
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
