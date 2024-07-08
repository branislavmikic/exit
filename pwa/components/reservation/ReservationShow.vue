<template>
  <div class="flex items-center justify-between">
    <nuxt-link
      :to="{ name: 'reservations' }"
      class="text-blue-600 hover:text-blue-800"
    >
      &lt; Back to list
    </nuxt-link>

    <div>
      <nuxt-link
        v-if="item"
        :to="{ name: 'reservations-id-edit', params: { id: getIdFromIri(item['@id']) } }"
        class="px-6 py-2 mr-2 bg-green-600 text-white text-xs rounded shadow-md hover:bg-green-700"
      >
        Edit
      </nuxt-link>
      <button
        class="px-6 py-2 bg-red-600 text-white text-xs rounded shadow-md hover:bg-red-700"
        @click="deleteItem"
      >
        Delete
      </button>
    </div>
  </div>

  <h1 class="text-3xl my-4">Show Reservation {{ item?.["@id"] }}</h1>

  <div
    v-if="isLoading"
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

  <div v-if="item" class="overflow-x-auto">
    <table class="min-w-full">
      <thead class="border-b">
        <tr>
          <th scope="col" class="text-sm font-medium px-6 py-4 text-left">
            Field
          </th>
          <th scope="col" class="text-sm font-medium px-6 py-4 text-left">
            Value
          </th>
        </tr>
      </thead>
      <tbody>
        <tr class="border-b">
          <th
            class="text-sm font-medium px-6 py-4 text-left capitalize"
            scope="row"
          >
            type
          </th>
          <td class="px-6 py-4 whitespace-nowrap text-sm">
            {{ item.type }}
                    </td>
        </tr>
        <tr class="border-b">
          <th
            class="text-sm font-medium px-6 py-4 text-left capitalize"
            scope="row"
          >
            confirmed
          </th>
          <td class="px-6 py-4 whitespace-nowrap text-sm">
            {{ item.confirmed }}
                    </td>
        </tr>
        <tr class="border-b">
          <th
            class="text-sm font-medium px-6 py-4 text-left capitalize"
            scope="row"
          >
            barcode
          </th>
          <td class="px-6 py-4 whitespace-nowrap text-sm">
            {{ item.barcode }}
                    </td>
        </tr>
        <tr class="border-b">
          <th
            class="text-sm font-medium px-6 py-4 text-left capitalize"
            scope="row"
          >
            organisation
          </th>
          <td class="px-6 py-4 whitespace-nowrap text-sm">
            {{ item.organisation }}
                    </td>
        </tr>
        <tr class="border-b">
          <th
            class="text-sm font-medium px-6 py-4 text-left capitalize"
            scope="row"
          >
            firstName
          </th>
          <td class="px-6 py-4 whitespace-nowrap text-sm">
            {{ item.firstName }}
                    </td>
        </tr>
        <tr class="border-b">
          <th
            class="text-sm font-medium px-6 py-4 text-left capitalize"
            scope="row"
          >
            lastName
          </th>
          <td class="px-6 py-4 whitespace-nowrap text-sm">
            {{ item.lastName }}
                    </td>
        </tr>
        <tr class="border-b">
          <th
            class="text-sm font-medium px-6 py-4 text-left capitalize"
            scope="row"
          >
            gender
          </th>
          <td class="px-6 py-4 whitespace-nowrap text-sm">
            {{ item.gender }}
                    </td>
        </tr>
        <tr class="border-b">
          <th
            class="text-sm font-medium px-6 py-4 text-left capitalize"
            scope="row"
          >
            registrationNumber
          </th>
          <td class="px-6 py-4 whitespace-nowrap text-sm">
            {{ item.registrationNumber }}
                    </td>
        </tr>
        <tr class="border-b">
          <th
            class="text-sm font-medium px-6 py-4 text-left capitalize"
            scope="row"
          >
            birth
          </th>
          <td class="px-6 py-4 whitespace-nowrap text-sm">
            {{ item.birth }}
                    </td>
        </tr>
        <tr class="border-b">
          <th
            class="text-sm font-medium px-6 py-4 text-left capitalize"
            scope="row"
          >
            personalNumber
          </th>
          <td class="px-6 py-4 whitespace-nowrap text-sm">
            {{ item.personalNumber }}
                    </td>
        </tr>
        <tr class="border-b">
          <th
            class="text-sm font-medium px-6 py-4 text-left capitalize"
            scope="row"
          >
            city
          </th>
          <td class="px-6 py-4 whitespace-nowrap text-sm">
            {{ item.city }}
                    </td>
        </tr>
        <tr class="border-b">
          <th
            class="text-sm font-medium px-6 py-4 text-left capitalize"
            scope="row"
          >
            country
          </th>
          <td class="px-6 py-4 whitespace-nowrap text-sm">
            {{ item.country }}
                    </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script lang="ts" setup>
import { storeToRefs } from "pinia";
import { useReservationShowStore } from "~~/stores/reservation/show";
import { useReservationDeleteStore } from "~~/stores/reservation/delete";
import { useMercureItem } from "~~/composables/mercureItem";
import { useFetchItem } from "~~/composables/api";
import { getIdFromIri } from "~~/utils/resource";
import type { Reservation } from "~~/types/reservation";

const route = useRoute();
const router = useRouter();

const reservationDeleteStore = useReservationDeleteStore();
const { error: deleteError, deleted } = storeToRefs(reservationDeleteStore);

const reservationShowStore = useReservationShowStore();

useMercureItem({
  store: reservationShowStore,
  deleteStore: reservationDeleteStore,
  redirectRouteName: "reservations",
});

const id = decodeURIComponent(route.params.id as string);
const {
  retrieved: item,
  isLoading,
  error,
  hubUrl,
} = await useFetchItem<Reservation>(`reservations/${id}`);
reservationShowStore.setData({ retrieved: item, isLoading, error, hubUrl });

async function deleteItem() {
  if (!item?.value) {
    reservationDeleteStore.setError("No item found. Please reload");
    return;
  }

  if (window.confirm("Are you sure you want to delete this reservation?")) {
    const { error } = await useDeleteItem(item.value);

    if (error.value) {
      reservationDeleteStore.setError(error.value);
      return;
    }

    reservationDeleteStore.setDeleted(item.value);
    reservationDeleteStore.setMercureDeleted(undefined);

    if (deleted) {
      router.push({ name: "reservations" });
    }
  }
}

onBeforeUnmount(() => {
  reservationShowStore.$reset();
});
</script>
