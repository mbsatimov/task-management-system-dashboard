import { Role } from "./role"

export interface User {
  id: number
  name: string
  email: string
  roles: Role[]
  created_at: string
  updated_at: string
}
