import { Role } from "./role"
import { Group } from "@/types/models/group"

export interface User {
  id: number
  name: string
  email: string
  roles: Role[]
  group: Group | null
  created_at: string
  updated_at: string
}
