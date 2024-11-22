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
import { Permission } from "@/types/models/permission"

const { permission } = defineProps<{
  permission: Permission
}>()

const form = useForm({
  name: permission.name,
})

const submit = () => {
  form.put(`/permissions/${permission.id}`)
}
</script>
<template>
  <Card>
    <CardHeader>
      <CardTitle>Permission/Update</CardTitle>
    </CardHeader>
    <form @submit.prevent="submit" class="space-y-6">
      <CardContent>
        <div>
          <Input name="name" v-model="form.name" placeholder="Name" />
          <FormMessage>{{ form.errors.name }}</FormMessage>
        </div>
      </CardContent>
      <CardFooter>
        <Button variant="secondary" as-child>
          <Link href="/permissions">Cancel</Link>
        </Button>
        <Button type="submit" class="primary-btn" :disabled="form.processing">
          Update
        </Button>
      </CardFooter>
    </form>
  </Card>
</template>
