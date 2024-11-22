<script setup lang="ts">
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
import type { Permission } from "@/types/models/permission"
import { Checkbox } from "@/components/ui/checkbox"
import { Label } from "@/components/ui/label"

defineProps<{
  permissions: Permission[]
}>()

const form = useForm<{ name: string; permissions: number[] }>({
  name: "",
  permissions: [],
})

const handleChange = (id: number) => {
  if (form.permissions.includes(id)) {
    form.permissions = form.permissions.filter(p => p !== id)
  } else {
    form.permissions.push(id)
  }
}

const submit = () => {
  form.post("/roles")
}
</script>
<template>
  <Card>
    <CardHeader>
      <CardTitle>Role/Create</CardTitle>
    </CardHeader>
    <form @submit.prevent="submit" class="space-y-6">
      <CardContent>
        <div>
          <Input name="name" v-model="form.name" placeholder="Name" />
          <FormMessage>{{ form.errors.name }}</FormMessage>
        </div>
        <div class="mt-4">
          <h2 class="mb-2 text-lg font-semibold">Permissions</h2>
          <div
            class="grid grid-cols-[repeat(auto-fit,minmax(200px,1fr))] gap-4"
          >
            <div
              v-for="permission in permissions"
              :key="permission.id"
              class="flex items-center gap-2"
            >
              <Checkbox
                :checked="form.permissions.includes(permission.id)"
                @update:checked="handleChange(permission.id)"
                :id="`permission-${permission.id}`"
              />
              <Label :for="`permission-${permission.id}`">
                {{ permission.name }}
              </Label>
            </div>
          </div>
        </div>
      </CardContent>
      <CardFooter>
        <Button variant="secondary" as-child>
          <Link href="/roles">Cancel</Link>
        </Button>
        <Button type="submit" class="primary-btn" :disabled="form.processing">
          Create
        </Button>
      </CardFooter>
    </form>
  </Card>
</template>
