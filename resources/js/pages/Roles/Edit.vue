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
import type { Permission } from "@/types/models/permission"

const { role, permissions } = defineProps<{
  role: Role
  permissions: Permission[]
}>()

const form = useForm<{ name: string; permissions: string[] }>({
  name: role.name,
  permissions: role.permissions.map(p => p.name),
})

const handleChange = (name: string) => {
  if (form.permissions.includes(name)) {
    form.permissions = form.permissions.filter(p => p !== name)
  } else {
    form.permissions.push(name)
  }
}

const submit = () => {
  form.put(`/roles/${role.id}`)
}
</script>
<template>
  <Card>
    <CardHeader>
      <CardTitle>Role/Update</CardTitle>
    </CardHeader>
    <form class="space-y-6" @submit.prevent="submit">
      <CardContent>
        <div>
          <Input v-model="form.name" name="name" placeholder="Name" />
          <FormMessage>{{ form.errors.name }}</FormMessage>
        </div>
        <div class="mt-4">
          <h2 class="mb-2 text-lg font-semibold">Permissions</h2>
          <div
            class="grid grid-cols-[repeat(auto-fit,minmax(200px,1fr))] gap-4"
          >
            <div
              v-for="permission in permissions"
              :key="permission.name"
              class="flex items-center gap-2"
            >
              <Checkbox
                :id="`permission-${permission.name}`"
                :checked="form.permissions.includes(permission.name)"
                @update:checked="handleChange(permission.name)"
              />
              <Label :for="`permission-${permission.name}`">
                {{ permission.name }}
              </Label>
            </div>
          </div>
          <FormMessage>{{ form.errors.permissions }}</FormMessage>
        </div>
      </CardContent>
      <CardFooter>
        <Button as-child variant="secondary">
          <Link href="/roles">Cancel</Link>
        </Button>
        <Button :disabled="form.processing" class="primary-btn" type="submit">
          Update
        </Button>
      </CardFooter>
    </form>
  </Card>
</template>
