<template>
  <div class="flex items-center justify-between">
    <nuxt-link
      :to="{ name: 'reservations' }"
      class="text-blue-600 hover:text-blue-800"
    >
      &lt; Back to list
    </nuxt-link>

    <button
      class="px-6 py-2 bg-red-600 text-white text-xs rounded shadow-md hover:bg-red-700"
      @click="deleteItem"
    >
      Delete
    </button>
  </div>

  <h1 class="text-3xl my-4">Edit Reservation {{ item?.["@id"] }}</h1>

  <div
    v-if="isLoading || deleteLoading"
    class="bg-blue-100 rounded py-4 px-4 text-blue-700 text-sm"
    role="status"
  >
    Loading...
  </div>

  <div
    v-if="error || deleteError"
    class="bg-red-100 rounded py-4 px-4 my-2 text-red-700 text-sm"
    role="alert"
  >
    {{ error || deleteError }}
  </div>

  <div
    v-if="created || updated"
    class="bg-green-100 rounded py-4 px-4 my-2 text-green-700 text-sm"
    role="status"
  >
    <template v-if="updated">{{ updated["@id"] }} updated.</template>
    <template v-else-if="created">{{ created["@id"] }} created.</template>
  </div>

  <Form :values="item" :errors="violations" @submit="update" />
</template>

<script lang="ts" setup>
import { ref } from "vue";
import { storeToRefs } from "pinia";
import Form from "~~/components/reservation/ReservationForm.vue";
import { useReservationUpdateStore } from "~~/stores/reservation/update";
import { useReservationCreateStore } from "~~/stores/reservation/create";
import { useReservationDeleteStore } from "~~/stores/reservation/delete";
import { useMercureItem } from "~~/composables/mercureItem";
import { useFetchItem, useUpdateItem } from "~~/composables/api";
import { type SubmissionErrors } from "~~/types/error";
import type { Reservation } from "~~/types/reservation";

const route = useRoute();
const router = useRouter();

const reservationCreateStore = useReservationCreateStore();
const { created } = storeToRefs(reservationCreateStore);

const reservationDeleteStore = useReservationDeleteStore();
const { error: deleteError, deleted, isLoading: deleteLoading } =
  storeToRefs(reservationDeleteStore);

const reservationUpdateStore = useReservationUpdateStore();

useMercureItem({
  store: reservationUpdateStore,
  deleteStore: reservationDeleteStore,
  redirectRouteName: "reservations",
});

const id = decodeURIComponent(route.params.id as string);
let updated: Ref<Reservation | undefined> = ref(undefined);
let violations: Ref<SubmissionErrors | undefined> = ref(undefined);
let {
  retrieved: item,
  error,
  isLoading,
  hubUrl,
} = await useFetchItem<Reservation>(`reservations/${id}`);
reservationUpdateStore.setData({
  retrieved: item,
  error,
  isLoading,
  hubUrl,
});

async function update(payload: Reservation) {
  if (!item?.value) {
    reservationUpdateStore.setError("No item found. Please reload");
    return;
  }

  const data = await useUpdateItem<Reservation>(item.value, payload);
  updated.value = data.updated.value;
  violations.value = data.violations.value;
  isLoading.value = data.isLoading.value;
  error.value = data.error.value;
  reservationUpdateStore.setUpdateData(data);
}

async function deleteItem() {
  if (!item?.value) {
    reservationDeleteStore.setError("No item found. Please reload");
    return;
  }

  if (window.confirm("Are you sure you want to delete this reservation?")) {
    const { isLoading, error } = await useDeleteItem(item.value);

    if (error.value) {
      reservationDeleteStore.setError(error.value);
      return;
    }

    reservationDeleteStore.setLoading(Boolean(isLoading?.value));
    reservationDeleteStore.setDeleted(item.value);
    reservationDeleteStore.setMercureDeleted(undefined);

    if (deleted) {
      router.push({ name: "reservations" });
    }
  }
}

onBeforeUnmount(() => {
  reservationUpdateStore.$reset();
  reservationCreateStore.$reset();
  reservationDeleteStore.$reset();
});
</script>
