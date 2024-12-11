import { TaskCategory } from "@/types/models/taskCategory"
import { User } from "@/types/models/user"

export type TaskStatus = 'completed' | 'uncompleted' | 'discarded'

interface StudentWithTaskStatus extends User {
  status: TaskStatus
}

export interface TaskPreview {
  id: number
  title: string
  description: string
  video: string
  category: TaskCategory
  mentor: User
  deadline: string
  students_count: number
}

export interface Task {
  id: number
  title: string
  description: string
  video: string
  category: TaskCategory
  mentor: User
  deadline: string
  students: StudentWithTaskStatus[]
}
