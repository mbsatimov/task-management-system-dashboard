<script lang="ts" setup>
import { XIcon } from "lucide-vue-next"
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
import { Checkbox } from "@/components/ui/checkbox"
import { User } from "@/types/models/user"
import { Pagination } from "@/types/pagination"
import { ref, watch } from "vue"
import { debounce } from "lodash"
import {
  Table,
  TableBody,
  TableCell,
  TableHead,
  TableHeader,
  TableRow,
} from "@/components/ui/table"
import { Badge } from "@/components/ui/badge"
import PaginationLinks from "@/components/PaginationLinks.vue"

const props = defineProps<{
  users: Pagination<User>
  searchTerm: string | null
}>()

const search = ref(props.searchTerm || "")

watch(search, value =>
  debounce(
    () =>
      router.get("/groups/create", { search: value }, { preserveState: true }),
    500
  )()
)
const form = useForm<{
  name: string
  user_ids: number[]
  users: User[]
}>({
  name: "",
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
  form.post("/groups")
}
</script>
<template>
  <div class="space-y-6">
    <form class="space-y-6" @submit.prevent="submit">
      <Card>
        <CardHeader>
          <CardTitle>Group/Create</CardTitle>
        </CardHeader>
        <CardContent>
          <div>
            <Input v-model="form.name" name="name" placeholder="Name" />
            <FormMessage>{{ form.errors.name }}</FormMessage>
          </div>
          <div class="mt-4">
            <h2 class="mb-2 text-lg font-semibold">Users</h2>
            <div>
              <div class="flex flex-wrap gap-4">
                <Badge v-for="user in form.users" :key="user.id" class="gap-1">
                  {{ user.name }}
                  <button type="button" @click="handleChange(user)">
                    <XIcon class="size-4" />
                  </button>
                </Badge>
              </div>
            </div>
            <FormMessage>{{ form.errors.users }}</FormMessage>
          </div>
        </CardContent>
        <CardFooter>
          <Button as-child variant="secondary">
            <Link href="/groups">Cancel</Link>
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
            <TableRow v-for="user in users.data" :key="user.id">
              <TableCell class="flex items-center">
                <Checkbox
                  :checked="form.user_ids.includes(user.id)"
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
        <PaginationLinks :paginator="users" class="mt-4" />
      </CardContent>
    </Card>
  </div>
</template>
