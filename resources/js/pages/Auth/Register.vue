<script lang="ts" setup>
import { useForm } from "@inertiajs/vue3"
import { Input } from "@/components/ui/input"
import { Button } from "@/components/ui/button"
import {
  Card,
  CardContent,
  CardDescription,
  CardHeader,
  CardTitle,
} from "@/components/ui/card"
import { FormMessage } from "@/components/ui/form"
import AuthLayout from "@/layouts/AuthLayout.vue"

const form = useForm({
  name: undefined,
  email: undefined,
  password_confirmation: undefined,
  password: undefined,
})

const submit = () => {
  form.post("/register", {
    onError: () => form.reset("password", "password_confirmation"),
  })
}

defineOptions({
  layout: AuthLayout,
})
</script>
<template>
  <Head title="Login" />

  <div class="mx-auto w-1/2">
    <Card class="mx-auto w-full max-w-sm">
      <CardHeader>
        <CardTitle class="text-2xl">Login</CardTitle>
        <CardDescription>
          Enter your email below to login to your account
        </CardDescription>
      </CardHeader>
      <CardContent>
        <form class="space-y-6" @submit.prevent="submit">
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

          <div>
            <Input
              v-model="form.password_confirmation"
              name="password_confirmation"
              placeholder="Password Confirmation"
              type="password"
            />
            <FormMessage>{{ form.errors.password_confirmation }}</FormMessage>
          </div>
          <div>
            <Button :disabled="form.processing" class="primary-btn">
              Register
            </Button>
          </div>
        </form>
      </CardContent>
    </Card>
  </div>
</template>
