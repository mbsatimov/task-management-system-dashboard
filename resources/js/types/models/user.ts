import { Role } from "./role"
import { TaskCategory } from "@/types/models/taskCategory"
import { Group } from "@/types/models/group"

export interface User {
  id: number
  name: string
  email: string
  roles: Role[]
  created_at: string
  updated_at: string
  student_number: string | null
  category: TaskCategory | null
  group: Group | null
  category_id: number | null
  group_id: number | null
  details: {} | null
}
