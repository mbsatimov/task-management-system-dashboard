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

const form = useForm({
  name: undefined,
})

const submit = () => {
  form.post("/task-categories")
}
</script>
<template>
  <Card>
    <CardHeader>
      <CardTitle>Task Category/Create</CardTitle>
    </CardHeader>
    <form class="space-y-6" @submit.prevent="submit">
      <CardContent>
        <div>
          <Input v-model="form.name" name="name" placeholder="Name" />
          <FormMessage>{{ form.errors.name }}</FormMessage>
        </div>
      </CardContent>
      <CardFooter>
        <Button as-child variant="secondary">
          <Link href="/task-categories">Cancel</Link>
        </Button>
        <Button :disabled="form.processing" class="primary-btn" type="submit">
          Create
        </Button>
      </CardFooter>
    </form>
  </Card>
</template>
