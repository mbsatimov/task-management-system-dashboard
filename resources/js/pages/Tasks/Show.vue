<script lang="ts" setup>
import { Task } from "@/types/models/task"
import { ArrowLeftIcon, Trash2Icon } from "lucide-vue-next"
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
import { format } from "date-fns"
import { router, usePage } from "@inertiajs/vue3"
import { toast } from "vue-sonner"

const props = defineProps<{
  task: Task
}>()

const page = usePage<{
  flash: { message?: string }
}>()

const onDelete = (studentId: number) => {
  router.delete(`/tasks/${props.task.id}/student`, {
    data: { student_id: studentId },
  })
  toast.success(page.props.flash.message)
}
</script>
<template>
  <div>
    <div class="flex items-center gap-2">
      <Button as-child size="icon" variant="secondary">
        <Link href="/tasks"> <ArrowLeftIcon class="size-8" /></Link>
      </Button>
      <h1 class="py-4 text-2xl font-bold">{{ task.title }}</h1>
    </div>
    <div class="py-3">
      <h2 class="py-2 text-lg font-bold">Deadline</h2>
      <p>{{ format(task.deadline, "dd, MMM yyyy") }}</p>
    </div>
    <div class="py-3">
      <h2 class="py-2 text-lg font-bold">Description</h2>
      <p>{{ task.description }}</p>
    </div>
    <div class="py-3">
      <h2 class="py-2 text-lg font-bold">Students</h2>
      <Table>
        <TableHeader>
          <TableRow>
            <TableHead>#</TableHead>
            <TableHead>Name</TableHead>
            <TableHead>Email</TableHead>
            <TableHead class="text-end">Actions</TableHead>
          </TableRow>
        </TableHeader>
        <TableBody>
          <TableRow v-for="(student, index) in task.students" :key="student.id">
            <TableCell>{{ index + 1 }}</TableCell>
            <TableCell>{{ student.name }}</TableCell>
            <TableCell>{{ student.email }}</TableCell>
            <TableCell class="flex justify-end gap-2">
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
                    <Button
                      as-child
                      size="sm"
                      variant="destructive"
                      @click="onDelete(student.id)"
                    >
                      <AlertDialogAction>Delete</AlertDialogAction>
                    </Button>
                  </AlertDialogFooter>
                </AlertDialogContent>
              </AlertDialog>
            </TableCell>
          </TableRow>
        </TableBody>
      </Table>
    </div>
  </div>
</template>
