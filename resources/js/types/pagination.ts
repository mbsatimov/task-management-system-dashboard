interface Pagination<T> {
  data: T[]
  links: {
    url: string | null
    label: string
    active: boolean
  }[]
  current_page: number
  next_page_url: string | null
  prev_page_url: string | null
  first_page_url: string
  last_page_url: string
  from: number | null
  to: number | null
  last_page: number
  path: string
  per_page: number
  total: number
}
