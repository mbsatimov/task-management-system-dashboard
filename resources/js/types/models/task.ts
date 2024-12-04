import { TaskCategory } from "@/types/models/taskCategory"
import { User } from "@/types/models/user"

export interface Task {
  id: number
  title: string
  description: string
  video: string
  category: TaskCategory
  created_by: User
  updated_by: User
}
