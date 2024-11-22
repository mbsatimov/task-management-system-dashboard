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

const form = useForm({
  name: undefined,
})

const submit = () => {
  form.post("/permissions")
}
</script>
<template>
  <Card>
    <CardHeader>
      <CardTitle>Permission/Create</CardTitle>
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
          Create
        </Button>
      </CardFooter>
    </form>
  </Card>
</template>
