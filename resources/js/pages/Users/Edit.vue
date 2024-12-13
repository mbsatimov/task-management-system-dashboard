<script lang="ts" setup>
import { useForm } from "@inertiajs/vue3"
import { Input } from "@/components/ui/input"
import { Button } from "@/components/ui/button"
import { Card, CardContent, CardFooter, CardHeader, CardTitle } from "@/components/ui/card"
import { FormMessage } from "@/components/ui/form"
import { Checkbox } from "@/components/ui/checkbox"
import type { Role } from "@/types/models/role"
import { Label } from "@/components/ui/label"
import { Select, SelectContent, SelectGroup, SelectItem, SelectTrigger, SelectValue } from "@/components/ui/select"
import { User } from "@/types/models/user"
import type { TaskCategory } from "@/types/models/taskCategory"

const { user, roles } = defineProps<{
  user: User
  roles: Role[]
  categories: TaskCategory[]
}>()

const form = useForm<
  Partial<{
    name: string
    email: string
    password: string
    student_number: string
    category_id: number
    roles: string[]
  }>
>({
  name: user.name,
  email: user.email,
  password: undefined,
  student_number: user.details?.student_number ?? undefined,
  category_id: user.details?.category_id ?? undefined,
  roles: user.roles.map(role => role.name),
})

/**
 * @param name {string}
 */
const handleChange = (name: string) => {
  if (form.roles?.includes(name)) {
    form.roles = form.roles?.filter(p => p !== name)
  } else {
    form.roles?.push(name)
  }
}

const submit = () => {
  form.put(`/users/${user.id}`)
}
</script>
<template>
  <Card>
    <CardHeader>
      <CardTitle>User/Create</CardTitle>
    </CardHeader>
    <form @submit.prevent="submit">
      <CardContent class="space-y-6">
        <div>
          <Label for="name">Name</Label>
          <Input id="name" v-model="form.name" name="name" placeholder="Last name" />
          <FormMessage>{{ form.errors.name }}</FormMessage>
        </div>
        <div>
          <Label for="email">Email</Label>
          <Input
            id="email"
            v-model="form.email"
            name="email"
            placeholder="Email"
            type="email"
          />
          <FormMessage>{{ form.errors.email }}</FormMessage>
        </div>
        <div>
          <Label for="password">Password</Label>
          <Input
            id="password"
            v-model="form.password"
            name="password"
            placeholder="Password"
            type="password"
          />
          <FormMessage>{{ form.errors.password }}</FormMessage>
        </div>

        <div class="mt-4">
          <h2 class="mb-2 text-lg font-semibold">Roles</h2>
          <div
            class="grid grid-cols-[repeat(auto-fit,minmax(200px,1fr))] gap-4"
          >
            <div
              v-for="role in roles"
              :key="role.name"
              class="flex items-center gap-2"
            >
              <Checkbox
                :id="`role-${role.name}`"
                :checked="form.roles?.includes(role.name)"
                @update:checked="handleChange(role.name)"
              />
              <Label :for="`role-${role.name}`">
                {{ role.name }}
              </Label>
            </div>
          </div>
          <FormMessage>{{ form.errors.roles }}</FormMessage>
        </div>
        <div>
          <Input
            v-if="form.roles?.includes('student')"
            v-model="form.student_number"
            placeholder="Student number"
          />
          <FormMessage>{{ form.errors.student_number }}</FormMessage>
        </div>
        <div v-if="form.roles?.includes('mentor')" class="space-y-1">
          <Label>Category</Label>
          <Select :default-value="String(user.details?.category_id)"
                  @update:modelValue="val => (form.category_id = +val)">
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
      </CardContent>
      <CardFooter>
        <Button as-child variant="secondary">
          <Link href="/users">Cancel</Link>
        </Button>
        <Button :disabled="form.processing" class="primary-btn" type="submit">
          Create
        </Button>
      </CardFooter>
    </form>
  </Card>
</template>
