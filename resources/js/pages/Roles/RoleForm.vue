<script setup lang="ts">
import { useForm } from "@inertiajs/vue3"
import { Input } from "@/components/ui/input"
import { Button } from "@/components/ui/button"
import type { Role } from "@/types/models/role"
import { DialogClose } from "@/components/ui/dialog"

const { defaultValues } = defineProps<{
  defaultValues?: Role
}>()

const form = useForm({
  name: defaultValues?.name,
})

const submit = () => {
  if (defaultValues) {
    form.put(`/roles/${defaultValues.id}`)
  } else {
    form.post("/roles")
  }
}

console.log(form.name)
</script>
<template>
  <form @submit.prevent="submit" class="space-y-6">
    <Input
      name="name"
      v-model="form.name"
      :message="form.errors.name"
      placeholder="Name"
    />
    <DialogClose asChild>
      <Button type="submit" class="primary-btn" :disabled="form.processing">
        Save
      </Button>
    </DialogClose>
  </form>
</template>
