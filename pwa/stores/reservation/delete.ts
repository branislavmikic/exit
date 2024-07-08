import { defineStore } from "pinia";
import type { Reservation } from "~~/types/reservation";

interface State {
  deleted?: Reservation;
  mercureDeleted?: Reservation;
  isLoading: boolean;
  error?: string;
}

export const useReservationDeleteStore = defineStore("reservationDelete", {
  state: (): State => ({
    deleted: undefined,
    mercureDeleted: undefined,
    isLoading: false,
    error: undefined,
  }),

  actions: {
    setLoading(isLoading: boolean) {
      this.isLoading = isLoading;
    },

    setDeleted(deleted: Reservation) {
      this.deleted = deleted;
    },

    setMercureDeleted(mercureDeleted: Reservation | undefined) {
      this.mercureDeleted = mercureDeleted;
    },

    setError(error: string) {
      this.error = error;
    },
  },
});
