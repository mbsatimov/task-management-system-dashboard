<script lang="ts" setup>
import { router, useForm } from "@inertiajs/vue3"
import { Input } from "@/components/ui/input"
import { Button } from "@/components/ui/button"
import { Card, CardContent, CardFooter, CardHeader, CardTitle } from "@/components/ui/card"
import { FormMessage } from "@/components/ui/form"
import { Select, SelectContent, SelectGroup, SelectItem, SelectTrigger, SelectValue } from "@/components/ui/select"
import { TaskCategory } from "@/types/models/taskCategory"
import { Textarea } from "@/components/ui/textarea"
import { Label } from "@/components/ui/label"
import { Task } from "@/types/models/task"
import { Pagination } from "@/types/pagination"
import { User } from "@/types/models/user"
import { ref, watch } from "vue"
import { debounce } from "lodash"
import { Popover, PopoverContent, PopoverTrigger } from "@/components/ui/popover"
import { Command, CommandEmpty, CommandGroup, CommandItem, CommandList } from "@/components/ui/command"
import { cn } from "@/lib/utils"
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from "@/components/ui/table"
import { Checkbox } from "@/components/ui/checkbox"
import { Badge } from "@/components/ui/badge"
import PaginationLinks from "@/components/PaginationLinks.vue"

const props = defineProps<{
  task: Task
  categories: TaskCategory[]
  students: Pagination<User>
  mentors: Pagination<User>
  searchTerm: string | null
}>()

const search = ref(props.searchTerm || "")

watch(search, value =>
  debounce(
    () =>
      router.get(
        `/tasks/${props.task.id}/edit`,
        { search: value },
        { preserveState: true }
      ),
    500
  )()
)

const form = useForm<{
  title: string
  description: string
  video: string
  deadline: string
  category_id?: number
  mentor_id: number
  student_ids: number[]
  students: User[]
}>({
  title: props.task.title,
  description: props.task.description,
  video: props.task.video,
  deadline: props.task.deadline,
  category_id: props.task.category.id,
  mentor_id: props.task.mentor.id,
  student_ids: props.task.students.map(p => p.id),
  students: props.task.students,
})

const submit = () => {
  form.put(`/tasks/${props.task.id}`)
}

/**
 * @param student {User}
 */
const handleChange = (student: User) => {
  if (form.student_ids?.includes(student.id)) {
    form.student_ids = form.student_ids?.filter(p => p !== student.id)
    form.students = form.students?.filter(p => p !== student)
  } else {
    form.student_ids?.push(student.id)
    form.students?.push(student)
  }
}

const open = ref(false)
</script>
<template>
  <div class="space-y-6">
    <form class="space-y-6" @submit.prevent="submit">
      <Card>
        <CardHeader>
          <CardTitle>Task/Create</CardTitle>
        </CardHeader>
        <CardContent class="space-y-6">
          <div class="space-y-1">
            <Label>Title</Label>
            <Input v-model="form.title" placeholder="Name" />
            <FormMessage>{{ form.errors.title }}</FormMessage>
          </div>
          <div class="space-y-1">
            <Label>Description</Label>
            <Textarea v-model="form.description" placeholder="Description" />
            <FormMessage>{{ form.errors.description }}</FormMessage>
          </div>
          <div class="space-y-1">
            <Label>Video Url</Label>
            <Input v-model="form.video" placeholder="Video url" type="url" />
            <FormMessage>{{ form.errors.video }}</FormMessage>
          </div>
          <div class="space-y-1">
            <Label>Deadline</Label>
            <Input
              v-model="form.deadline"
              placeholder="Deadline"
              type="datetime-local"
            />
            <FormMessage>{{ form.errors.deadline }}</FormMessage>
          </div>
          <div class="space-y-1">
            <Label>Category</Label>
            <Select @update:modelValue="val => (form.category_id = +val)">
              <SelectTrigger>
                <SelectValue placeholder="Select a category" />
              </SelectTrigger>
              <SelectContent>
                <SelectGroup>
                  <SelectItem
                    v-for="category in categories"
                    :key="category.id"
                    :value="String(category.id)"
                  >
                    {{ category.name }}
                  </SelectItem>
                </SelectGroup>
              </SelectContent>
            </Select>
            <FormMessage>{{ form.errors.category_id }}</FormMessage>
          </div>
          <div class="space-y-1">
            <Label>Mentor</Label>
            <Popover v-model:open="open">
              <PopoverTrigger as-child>
                <Button
                  :aria-expanded="open"
                  class="w-full justify-between"
                  role="combobox"
                  variant="outline"
                >
                  {{
                    form.mentor_id
                      ? mentors.data.find(
                          mentor => mentor.id === form.mentor_id
                        )?.name
                      : "Select mentor..."
                  }}

                  <ChevronsUpDown class="ml-2 h-4 w-4 shrink-0 opacity-50" />
                </Button>
              </PopoverTrigger>
              <PopoverContent class="w-[600px] p-0">
                <Command v-model="form.mentor_id">
                  <Input v-model="search" placeholder="Search mentor..." />
                  <CommandEmpty>No mentors found.</CommandEmpty>
                  <CommandList>
                    <CommandGroup>
                      <CommandItem
                        v-for="mentor in mentors.data"
                        :key="mentor.id"
                        :value="mentor.id"
                        @select="open = false"
                      >
                        <Check
                          :class="
                            cn(
                              'mr-2 h-4 w-4',
                              form.mentor_id === mentor.id
                                ? 'opacity-100'
                                : 'opacity-0'
                            )
                          "
                        />
                        {{ mentor.name }}
                      </CommandItem>
                    </CommandGroup>
                  </CommandList>
                </Command>
              </PopoverContent>
            </Popover>
            <FormMessage>{{ form.errors.mentor_id }}</FormMessage>
          </div>
        </CardContent>
        <CardFooter>
          <Button as-child variant="secondary">
            <Link href="/tasks">Cancel</Link>
          </Button>
          <Button :disabled="form.processing" class="primary-btn" type="submit">
            Create
          </Button>
        </CardFooter>
      </Card>
    </form>

    <Card>
      <CardHeader>
        <Input
          v-model="search"
          class="max-w-md"
          placeholder="Search..."
          type="text"
        />
      </CardHeader>
      <CardContent>
        <Table>
          <TableHeader>
            <TableRow>
              <TableHead>#</TableHead>
              <TableHead>Name</TableHead>
              <TableHead>Email</TableHead>
              <TableHead>Role</TableHead>
            </TableRow>
          </TableHeader>
          <TableBody>
            <TableRow v-for="user in students.data" :key="user.id">
              <TableCell class="flex items-center">
                <Checkbox
                  :checked="form.student_ids?.includes(user.id)"
                  @update:checked="handleChange(user)"
                />
              </TableCell>
              <TableCell>{{ user.name }}</TableCell>
              <TableCell>{{ user.email }}</TableCell>
              <TableCell class="space-x-1">
                <Badge v-for="(role, i) in user.roles" :key="role.id">
                  {{ role.name }}
                </Badge>
              </TableCell>
            </TableRow>
          </TableBody>
        </Table>
        <PaginationLinks :paginator="students" class="mt-4" />
      </CardContent>
    </Card>
  </div>
</template>
