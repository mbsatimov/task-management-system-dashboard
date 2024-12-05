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
import {
  Select,
  SelectContent,
  SelectGroup,
  SelectItem,
  SelectTrigger,
  SelectValue,
} from "@/components/ui/select"
import { TaskCategory } from "@/types/models/taskCategory"
import { Textarea } from "@/components/ui/textarea"
import { Label } from "@/components/ui/label"

defineProps<{
  categories: TaskCategory[]
}>()

const form = useForm<
  Partial<{
    title: string
    description: string
    video: string
    category_id: number
  }>
>({
  title: undefined,
  description: undefined,
  video: undefined,
  category_id: undefined,
})

const submit = () => {
  form.post("/tasks")
}
</script>
<template>
  <form class="space-y-6" @submit.prevent="submit">
    <Card>
      <CardHeader>
        <CardTitle>Task/Create</CardTitle>
      </CardHeader>
      <CardContent class="space-y-6">
        <div class="space-y-1">
          <Label>Title</Label>
          <Input v-model="form.title" placeholder="Name" />
          <FormMessage>{{ form.errors.title }}</FormMessage>
        </div>
        <div class="space-y-1">
          <Label>Description</Label>
          <Textarea v-model="form.description" placeholder="Description" />
          <FormMessage>{{ form.errors.description }}</FormMessage>
        </div>
        <div class="space-y-1">
          <Label>Video Url</Label>
          <Input v-model="form.video" placeholder="Video url" type="url" />
          <FormMessage>{{ form.errors.video }}</FormMessage>
        </div>
        <div class="space-y-1">
          <Label>Category</Label>
          <Select @update:modelValue="val => (form.category_id = +val)">
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
          <Link href="/tasks">Cancel</Link>
        </Button>
        <Button :disabled="form.processing" class="primary-btn" type="submit">
          Create
        </Button>
      </CardFooter>
    </Card>
  </form>
</template>
