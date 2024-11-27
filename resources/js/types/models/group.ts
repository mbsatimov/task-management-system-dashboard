import { User } from "@/types/models/user"

export interface Group {
  id: number
  name: string
  users: User[]
}
