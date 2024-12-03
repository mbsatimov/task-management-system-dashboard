<script lang="ts" setup>
import { Check, ChevronsUpDown, XIcon } from "lucide-vue-next"
import { router, useForm } from "@inertiajs/vue3"
import { Input } from "@/components/ui/input"
import { Button } from "@/components/ui/button"
import {
  Card,
  CardContent,
  CardFooter,
  CardHeader,
  CardTitle,
} from "@/components/ui/card"
import { FormMessage } from "@/components/ui/form"
import { User } from "@/types/models/user"
import { Pagination } from "@/types/pagination"
import { ref, watch } from "vue"
import { debounce } from "lodash"
import {
  Select,
  SelectContent,
  SelectGroup,
  SelectItem,
  SelectTrigger,
  SelectValue,
} from "@/components/ui/select"
import {
  Command,
  CommandEmpty,
  CommandGroup,
  CommandItem,
  CommandList,
} from "@/components/ui/command"
import {
  Popover,
  PopoverContent,
  PopoverTrigger,
} from "@/components/ui/popover"
import { Badge } from "@/components/ui/badge"
import { TaskCategory } from "@/types/models/taskCategory"
import { Textarea } from "@/components/ui/textarea"

const props = defineProps<{
  users: Pagination<User>
  categories: TaskCategory[]
  searchTerm: string | null
}>()

const search = ref(props.searchTerm || "")

watch(search, value =>
  debounce(
    () =>
      router.get("/tasks/create", { search: value }, { preserveState: true }),
    500
  )()
)
const form = useForm<{
  title: string
  description: string
  video: string
  category_id?: number
  created_by_id?: number
  updated_by_id?: number
  user_ids: number[]
  users: User[]
}>({
  title: "",
  description: "",
  video: "",
  category_id: undefined,
  created_by_id: undefined,
  updated_by_id: undefined,
  user_ids: [],
  users: [],
})

const handleChange = (user: User) => {
  if (form.user_ids.includes(user.id)) {
    form.user_ids = form.user_ids.filter(p => p !== user.id)
    form.users = form.users.filter(p => p !== user)
  } else {
    form.user_ids.push(user.id)
    form.users.push(user)
  }
}

const submit = () => {
  form.post("/tasks")
}
</script>
<template>
  <form class="space-y-6" @submit.prevent="submit">
    <Card>
      <CardHeader>
        <CardTitle>Task/Create</CardTitle>
      </CardHeader>
      <CardContent class="space-y-6">
        <div>
          <Input v-model="form.title" placeholder="Name" />
          <FormMessage>{{ form.errors.title }}</FormMessage>
        </div>
        <div>
          <Textarea v-model="form.description" placeholder="Description" />
          <FormMessage>{{ form.errors.title }}</FormMessage>
        </div>
        <div>
          <Input v-model="form.video" placeholder="Video url" type="url" />
          <FormMessage>{{ form.errors.title }}</FormMessage>
        </div>
        <Select>
          <SelectTrigger>
            <SelectValue placeholder="Select a category" />
          </SelectTrigger>
          <SelectContent @select="form.category_id = +$event">
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
        <div>
          <Popover>
            <PopoverTrigger as-child>
              <Button class="w-full justify-between" variant="outline">
                <span class="font-medium text-muted-foreground">
                  {{ form.user_ids.length }} selected
                </span>
                <ChevronsUpDown class="ml-2 h-4 w-4 shrink-0 opacity-50" />
              </Button>
            </PopoverTrigger>

            <PopoverContent class="popover-content-width-full p-0">
              <Command class="rounded-lg border shadow-md">
                <Input
                  v-model="search"
                  class="focus-visible:ring-0"
                  placeholder="Type a member name..."
                />
                <CommandList>
                  <CommandEmpty>No results found.</CommandEmpty>
                  <CommandGroup>
                    <CommandItem
                      v-for="user in users.data"
                      :key="user.id"
                      :value="user.id"
                      class="flex cursor-pointer justify-between"
                      @click="() => handleChange(user)"
                    >
                      <span>{{ user.name }}</span>
                      <Check
                        v-if="form.user_ids.includes(user.id)"
                        class="size-5"
                      />
                    </CommandItem>
                  </CommandGroup>
                </CommandList>
              </Command>
            </PopoverContent>
          </Popover>
          <div class="mt-3 flex flex-wrap gap-4">
            <Badge v-for="user in form.users" :key="user.id" class="gap-1">
              {{ user.name }}
              <button type="button" @click="handleChange(user)">
                <XIcon class="size-4" />
              </button>
            </Badge>
          </div>
          <FormMessage>{{ form.errors.users }}</FormMessage>
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
</template>
