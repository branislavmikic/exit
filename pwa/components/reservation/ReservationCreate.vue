<template>
  <nuxt-link :to="{ name: 'reservations' }" class="text-blue-600 hover:text-blue-800">
    &lt; Back to list
  </nuxt-link>

  <h1 class="text-3xl my-4">Create Reservation</h1>

  <div
    v-if="isLoading"
    class="bg-blue-100 rounded py-4 px-4 text-blue-700 text-sm"
    role="status"
  >
    Loading...
  </div>

  <div
    v-if="error"
    class="bg-red-100 rounded py-4 px-4 my-2 text-red-700 text-sm"
    role="alert"
  >
    {{ error }}
  </div>

  <Form :errors="violations" @submit="create" />
</template>

<script lang="ts" setup>
import { onBeforeUnmount } from "vue";
import { storeToRefs } from "pinia";
import Form from "~~/components/reservation/ReservationForm.vue";
import { useReservationCreateStore } from "~~/stores/reservation/create";
import { useCreateItem } from "~~/composables/api";
import { getIdFromIri } from "~~/utils/resource";
import type { Reservation } from "~~/types/reservation";

const reservationCreateStore = useReservationCreateStore();
const { created, isLoading, violations, error } = storeToRefs(reservationCreateStore);

async function create(item: Reservation) {
  const data = await useCreateItem<Reservation>("reservations", item);
  reservationCreateStore.setData(data);

  // if (!created?.value?.["@id"]) {
  //   reservationCreateStore.setError("Missing item id. Please reload");
  //   return;
  // }

  navigateTo({
    name: "reservations-id-edit",
    params: { id: getIdFromIri(created?.value?.["@id"]) },
  });
}

onBeforeUnmount(() => {
  reservationCreateStore.$reset();
});
</script>
