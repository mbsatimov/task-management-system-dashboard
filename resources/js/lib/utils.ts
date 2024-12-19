import { type ClassValue, clsx } from "clsx"
import { twMerge } from "tailwind-merge"

export function cn(...inputs: ClassValue[]) {
  return twMerge(clsx(inputs))
}

/**
 * Helper to format a date string to 'YYYY-MM-DDTHH:MM'
 * @param dateString {string}
 * @returns {string}
 */
export const formatToDateTimeLocal = (dateString: string): string => {
  const date = new Date(dateString);
  const pad = (n: number) => n.toString().padStart(2, "0");
  return `${date.getFullYear()}-${pad(date.getMonth() + 1)}-${pad(date.getDate())}T${pad(date.getHours())}:${pad(date.getMinutes())}`;
};
