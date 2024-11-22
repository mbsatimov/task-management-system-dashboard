<script setup lang="ts">
import { useForm } from "@inertiajs/vue3"
import { Input } from "@/components/ui/input"
import { Button } from "@/components/ui/button"
import {
  Card,
  CardHeader,
  CardTitle,
  CardDescription,
  CardContent,
} from "@/components/ui/card"
import { FormMessage } from "@/components/ui/form"
import AuthLayout from "@/layouts/AuthLayout.vue"

const form = useForm({
  email: undefined,
  password: undefined,
  remember: false,
})

const submit = () => {
  form.post("/login", {
    onError: () => form.reset("password", "remember"),
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
        <form @submit.prevent="submit" class="space-y-6">
          <div>
            <Input
              name="email"
              v-model="form.email"
              type="email"
              placeholder="Email"
            />
            <FormMessage>{{ form.errors.email }}</FormMessage>
          </div>
          <div>
            <Input
              name="password"
              v-model="form.password"
              type="password"
              placeholder="Password"
            />
            <FormMessage>{{ form.errors.password }}</FormMessage>
          </div>

          <div class="flex items-center justify-between">
            <div class="flex items-center gap-2">
              <input type="checkbox" v-model="form.remember" id="remember" />
              <label for="remember">Remember me</label>
            </div>
          </div>
          <div>
            <Button class="primary-btn" :disabled="form.processing">
              Login
            </Button>
          </div>
        </form>
      </CardContent>
    </Card>
  </div>
</template>
