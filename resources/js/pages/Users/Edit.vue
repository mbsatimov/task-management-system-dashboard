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
import { User } from "@/types/models/user"

const { user } = defineProps<{
  user: User
}>()

const form = useForm({
  name: user.name,
})

const submit = () => {
  form.put(`/users/${user.id}`)
}
</script>
<template>
  <Card>
    <CardHeader>
      <CardTitle>User/Update</CardTitle>
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
          <Link href="/users">Cancel</Link>
        </Button>
        <Button type="submit" class="primary-btn" :disabled="form.processing">
          Update
        </Button>
      </CardFooter>
    </form>
  </Card>
</template>
