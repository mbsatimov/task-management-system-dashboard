<script lang="ts" setup>
import { useForm } from "@inertiajs/vue3"
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
import { Label } from "@/components/ui/label"
import { User } from "@/types/models/user"
import { Pagination } from "@/types/pagination"

defineProps<{
  users: Pagination<User>
}>()

const form = useForm<{
  name: string
  users: string[]
}>({
  name: "",
  users: [],
})

const handleChange = (name: string) => {
  if (form.users.includes(name)) {
    form.users = form.users.filter(p => p !== name)
  } else {
    form.users.push(name)
  }
}

const submit = () => {
  form.post("/groups")
}
</script>
<template>
  <Card>
    <CardHeader>
      <CardTitle>Group/Create</CardTitle>
    </CardHeader>
    <form class="space-y-6" @submit.prevent="submit">
      <CardContent>
        <div>
          <Input v-model="form.name" name="name" placeholder="Name" />
          <FormMessage>{{ form.errors.name }}</FormMessage>
        </div>
        <div class="mt-4">
          <h2 class="mb-2 text-lg font-semibold">Users</h2>
          <div
            class="grid grid-cols-[repeat(auto-fit,minmax(200px,1fr))] gap-4"
          >
            <div
              v-for="user in users.data"
              :key="user.name"
              class="flex items-center gap-2"
            >
              <Checkbox
                :id="`user-${user.name}`"
                :checked="form.users.includes(user.name)"
                @update:checked="handleChange(user.name)"
              />
              <Label :for="`user-${user.name}`">
                {{ user.name }}
              </Label>
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
    </form>
  </Card>
</template>
