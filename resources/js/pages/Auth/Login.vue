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
import AuthLayout from "@/layouts/AuthLayout.vue"

const form = useForm({
  email: undefined,
  password: undefined,
  remember: false,
})

const submit = () => {
  form.post(route("login"), {
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
          <Input
            name="email"
            :modelValue="form.email"
            type="email"
            :message="form.errors.email"
            placeholder="Email"
          />
          <Input
            name="password"
            :modelValue="form.password"
            type="password"
            :message="form.errors.password"
            placeholder="Password"
          />

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
