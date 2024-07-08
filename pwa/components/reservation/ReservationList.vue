<template>
  <div class="flex items-center justify-between">
    <h1 class="text-3xl my-4">Reservations</h1>
    <v-btn class="ma-1 pa-1" @click="router.push('reservations/create')">Create new</v-btn>
  </div>

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

  <div
    v-if="deletedItem || mercureDeletedItem"
    class="bg-green-100 rounded py-4 px-4 my-2 text-green-700 text-sm"
    role="status"
  >
    <template v-if="deletedItem">{{ deletedItem["@id"] }} deleted.</template>
    <template v-else-if="mercureDeletedItem">
      {{ mercureDeletedItem["@id"] }} deleted by another user.
    </template>
  </div>

  <v-card class="ma-1 pa-1">
        <v-card-title class="d-flex flex-row">
            <v-text-field v-model="search" label="Search" prepend-inner-icon="mdi-magnify" variant="outlined"
                hide-details single-line>
            </v-text-field>
        </v-card-title>
        <v-card-text>
          <v-data-table v-if="!isLoading" :search="search" :headers="dessertHeaders" :items="items">
            <template v-slot:item.actions="{ item }">
              <nuxt-link
              :to="{ name: 'reservations-id', params: { id: getIdFromIri(item['@id']) } }"
              class="px-6 py-2 bg-blue-600 text-xs rounded shadow-md hover:bg-blue-700"
            >
              Show
            </nuxt-link>
            <nuxt-link
              :to="{ name: 'reservations-id-edit', params: { id: getIdFromIri(item['@id']) } }"
              class="px-6 py-2 bg-green-600 text-xs rounded shadow-md hover:bg-green-700"
            >
              Edit
            </nuxt-link>
            </template>
          </v-data-table>

        </v-card-text>
  </v-card>

  <div v-if="view" class="flex justify-center">
    <nav aria-label="Page navigation">
      <ul class="flex list-style-none">
        <li :class="{ disabled: !pagination.previous }">
          <nuxt-link
            :to="{
              name: 'reservations-page-page',
              params: { page: pagination.first },
            }"
            aria-label="First page"
            :class="
              !pagination.previous
                ? 'text-gray-500 pointer-events-none'
                : 'text-gray-800 hover:bg-gray-200'
            "
            class="block py-2 px-3 rounded"
          >
            <span aria-hidden="true">&lArr;</span> First
          </nuxt-link>
        </li>

        <li :class="{ disabled: !pagination.previous }">
          <nuxt-link
            :to="{
              name: 'reservations-page-page',
              params: { page: pagination.previous ?? pagination.first },
            }"
            :class="
              !pagination.previous
                ? 'text-gray-500 pointer-events-none'
                : 'text-gray-800 hover:bg-gray-200'
            "
            class="block py-2 px-3 rounded"
            aria-label="Previous page"
          >
            <span aria-hidden="true">&larr;</span> Previous
          </nuxt-link>
        </li>

        <li :class="{ disabled: !pagination.next }">
          <nuxt-link
            :to="{
              name: 'reservations-page-page',
              params: { page: pagination.next ?? pagination.last },
            }"
            :class="
              !pagination.next
                ? 'text-gray-500 pointer-events-none'
                : 'text-gray-800 hover:bg-gray-200'
            "
            class="block py-2 px-3 rounded"
            aria-label="Next page"
          >
            Next <span aria-hidden="true">&rarr;</span>
          </nuxt-link>
        </li>

        <li :class="{ disabled: !pagination.next }">
          <nuxt-link
            :to="{ name: 'reservations-page-page', params: { page: pagination.last } }"
            :class="
              !pagination.next
                ? 'text-gray-500 pointer-events-none'
                : 'text-gray-800 hover:bg-gray-200'
            "
            class="block py-2 px-3 rounded"
            aria-label="Last page"
          >
            Last <span aria-hidden="true">&rArr;</span>
          </nuxt-link>
        </li>
      </ul>
    </nav>
  </div>
</template>

<script lang="ts" setup>
import { ref } from 'vue';
import { storeToRefs } from "pinia";
import { useMercureList } from "~~/composables/mercureList";
import { useReservationDeleteStore } from "~~/stores/reservation/delete";
import { useReservationListStore } from "~~/stores/reservation/list";
import { useFetchList } from "~~/composables/api";
import { getIdFromIri } from "~~/utils/resource";
import type { Reservation } from "~~/types/reservation";

const router = useRouter();

const reservationDeleteStore = useReservationDeleteStore();
const { deleted: deletedItem, mercureDeleted: mercureDeletedItem } =
  storeToRefs(reservationDeleteStore);

const reservationListStore = useReservationListStore();
const { items, view, error, isLoading, hubUrl } = await useFetchList<Reservation>(
  "reservations"
);
reservationListStore.setData({ items, view, error, isLoading, hubUrl });

const pagination = {
  first: view.value?.["hydra:first"]?.slice(-1),
  previous: view.value?.["hydra:previous"]?.slice(-1),
  next: view.value?.["hydra:next"]?.slice(-1),
  last: view.value?.["hydra:last"]?.slice(-1),
};

useMercureList({ store: reservationListStore, deleteStore: reservationDeleteStore });

onBeforeUnmount(() => {
  reservationListStore.$reset();
  reservationDeleteStore.$reset();
});
const search = ref('');

const dessertHeaders = ref([
    {
        title: 'Type', key: 'type', sortable: false
    },
    {
        title: 'Confirmed', key: 'confirmed', sortable: false
    },
    {
        title: 'Barcode', key: 'barcode', sortable: false
    },
    {
        title: 'Organisation', key: 'organisation', sortable: false
    },
    {
        title: 'First name', key: 'firstName', sortable: false
    },
    {
        title: 'Last name', key: 'lastName', sortable: false
    },
    {
        title: 'Gender', key: 'gender', sortable: false
    },
    {
        title: 'RegistrationNumber', key: 'registrationNumber', sortable: false
    },
    {
        title: 'Birth year', key: 'birth', sortable: false
    },
    {
        title: 'PersonalNumber', key: 'personalNumber', sortable: false
    },
    {
        title: 'City', key: 'city', sortable: false
    },
    {
        title: 'Country', key: 'country', sortable: false
    },
    {
        title: 'Actions', key: 'actions', sortable: false
    },
  ]);
</script>
