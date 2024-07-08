import { defineStore } from "pinia";
import type { Reservation } from "~~/types/reservation";
import { FetchItemData } from "~~/types/api";
interface State {
  retrieved?: Reservation;
  isLoading: boolean;
  error?: string;
  hubUrl?: URL;
}

export const useReservationShowStore = defineStore("reservationShow", {
  state: (): State => ({
    retrieved: undefined,
    isLoading: false,
    error: "",
    hubUrl: undefined,
  }),

  actions: {
    setData({
      retrieved,
      isLoading,
      error,
      hubUrl,
    }: FetchItemData<Reservation>) {
      this.setRetrieved(retrieved.value);
      this.setLoading(isLoading.value);
      this.setHubUrl(hubUrl.value);

      if (error.value instanceof Error) {
        this.setError(error.value?.message);
      }
    },

    setLoading(isLoading: boolean) {
      this.isLoading = isLoading;
    },

    setRetrieved(retrieved?: Reservation) {
      this.retrieved = retrieved;
    },

    setHubUrl(hubUrl?: URL) {
      this.hubUrl = hubUrl;
    },

    setError(error?: string) {
      this.error = error;
    },
  },
});
