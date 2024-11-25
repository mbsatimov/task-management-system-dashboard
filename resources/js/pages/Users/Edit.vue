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
import type { Role } from "@/types/models/role"
import { User } from "@/types/models/user"

const { user, roles } = defineProps<{
  roles: Role[]
  user: User
}>()

const form = useForm<{
  name: string
  email: string
  password: string
  roles: string[]
}>({
  name: user.name,
  email: user.email,
  password: "",
  roles: user.roles.map(role => role.name),
})

const handleChange = (name: string) => {
  if (form.roles.includes(name)) {
    form.roles = form.roles.filter(p => p !== name)
  } else {
    form.roles.push(name)
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
          <Input v-model="form.name" name="name" placeholder="Last name" />
          <FormMessage>{{ form.errors.name }}</FormMessage>
        </div>
        <div>
          <Input
            v-model="form.email"
            name="email"
            placeholder="Email"
            type="email"
          />
          <FormMessage>{{ form.errors.email }}</FormMessage>
        </div>

        <div>
          <Input
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
                :checked="form.roles.includes(role.name)"
                @update:checked="handleChange(role.name)"
              />
              <Label :for="`role-${role.name}`">
                {{ role.name }}
              </Label>
            </div>
          </div>
          <FormMessage>{{ form.errors.roles }}</FormMessage>
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
