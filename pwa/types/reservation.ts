import type { Item } from "./item";

export interface Reservation extends Item {
  type?: string;
  confirmed?: boolean;
  barcode?: string;
  organisation?: string;
  firstName?: string;
  lastName?: string;
  gender?: string;
  registrationNumber?: string;
  birth?: string;
  personalNumber?: string;
  city?: string;
  country?: string;
}
