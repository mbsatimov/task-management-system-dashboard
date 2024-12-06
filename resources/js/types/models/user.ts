import { Role } from "./role"
import { Group } from "@/types/models/group"
import { TaskCategory } from "@/types/models/taskCategory"

export interface User {
  id: number
  name: string
  email: string
  roles: Role[]
  created_at: string
  updated_at: string
  student?: Student
  mentor?: Mentor
}

export interface Student {
  user_id: number
  group: Group | null
  student_number: string
  created_at: string
  updated_at: string
}

export interface Mentor {
  user_id: number
  category: TaskCategory
  created_at: string
  updated_at: string
}
