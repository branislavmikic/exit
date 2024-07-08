<template>
  <form class="py-4" @submit.prevent="emitSubmit">
    <div class="mb-2">
      <label
        for="reservation_type"
        class="text-gray-700 block text-sm font-bold capitalize"
      >
        type
      </label>
      <input
        id="reservation_type"
        v-model="item.type"
        :class="[
          'mt-1 w-full px-3 py-2 border rounded',
          violations?.type ? 'border-red-500' : 'border-gray-300',
        ]"
        type="text"
        placeholder=""
      />
      <div
        v-if="violations?.type"
        class="bg-red-100 rounded py-4 px-4 my-2 text-red-700 text-sm"
      >
        {{ violations.type }}
      </div>
    </div>
    <div class="mb-2">
      <label
        for="reservation_confirmed"
        class="text-gray-700 block text-sm font-bold capitalize"
      >
        confirmed
      </label>
      <input
        id="reservation_confirmed"
        v-model="item.confirmed"
        :class="[
          'mt-1 w-full px-3 py-2 border rounded',
          violations?.confirmed ? 'border-red-500' : 'border-gray-300',
        ]"
        type="checkbox"
        placeholder=""
      />
      <div
        v-if="violations?.confirmed"
        class="bg-red-100 rounded py-4 px-4 my-2 text-red-700 text-sm"
      >
        {{ violations.confirmed }}
      </div>
    </div>
    <div class="mb-2">
      <label
        for="reservation_barcode"
        class="text-gray-700 block text-sm font-bold capitalize"
      >
        barcode
      </label>
      <input
        id="reservation_barcode"
        v-model="item.barcode"
        :class="[
          'mt-1 w-full px-3 py-2 border rounded',
          violations?.barcode ? 'border-red-500' : 'border-gray-300',
        ]"
        type="text"
        placeholder=""
      />
      <div
        v-if="violations?.barcode"
        class="bg-red-100 rounded py-4 px-4 my-2 text-red-700 text-sm"
      >
        {{ violations.barcode }}
      </div>
    </div>
    <div class="mb-2">
      <label
        for="reservation_organisation"
        class="text-gray-700 block text-sm font-bold capitalize"
      >
        organisation
      </label>
      <input
        id="reservation_organisation"
        v-model="item.organisation"
        :class="[
          'mt-1 w-full px-3 py-2 border rounded',
          violations?.organisation ? 'border-red-500' : 'border-gray-300',
        ]"
        type="text"
        placeholder=""
      />
      <div
        v-if="violations?.organisation"
        class="bg-red-100 rounded py-4 px-4 my-2 text-red-700 text-sm"
      >
        {{ violations.organisation }}
      </div>
    </div>
    <div class="mb-2">
      <label
        for="reservation_firstName"
        class="text-gray-700 block text-sm font-bold capitalize"
      >
        firstName
      </label>
      <input
        id="reservation_firstName"
        v-model="item.firstName"
        :class="[
          'mt-1 w-full px-3 py-2 border rounded',
          violations?.firstName ? 'border-red-500' : 'border-gray-300',
        ]"
        type="text"
        placeholder=""
      />
      <div
        v-if="violations?.firstName"
        class="bg-red-100 rounded py-4 px-4 my-2 text-red-700 text-sm"
      >
        {{ violations.firstName }}
      </div>
    </div>
    <div class="mb-2">
      <label
        for="reservation_lastName"
        class="text-gray-700 block text-sm font-bold capitalize"
      >
        lastName
      </label>
      <input
        id="reservation_lastName"
        v-model="item.lastName"
        :class="[
          'mt-1 w-full px-3 py-2 border rounded',
          violations?.lastName ? 'border-red-500' : 'border-gray-300',
        ]"
        type="text"
        placeholder=""
      />
      <div
        v-if="violations?.lastName"
        class="bg-red-100 rounded py-4 px-4 my-2 text-red-700 text-sm"
      >
        {{ violations.lastName }}
      </div>
    </div>
    <div class="mb-2">
      <label
        for="reservation_gender"
        class="text-gray-700 block text-sm font-bold capitalize"
      >
        gender
      </label>
      <input
        id="reservation_gender"
        v-model="item.gender"
        :class="[
          'mt-1 w-full px-3 py-2 border rounded',
          violations?.gender ? 'border-red-500' : 'border-gray-300',
        ]"
        type="text"
        placeholder=""
      />
      <div
        v-if="violations?.gender"
        class="bg-red-100 rounded py-4 px-4 my-2 text-red-700 text-sm"
      >
        {{ violations.gender }}
      </div>
    </div>
    <div class="mb-2">
      <label
        for="reservation_registrationNumber"
        class="text-gray-700 block text-sm font-bold capitalize"
      >
        registrationNumber
      </label>
      <input
        id="reservation_registrationNumber"
        v-model="item.registrationNumber"
        :class="[
          'mt-1 w-full px-3 py-2 border rounded',
          violations?.registrationNumber ? 'border-red-500' : 'border-gray-300',
        ]"
        type="text"
        placeholder=""
      />
      <div
        v-if="violations?.registrationNumber"
        class="bg-red-100 rounded py-4 px-4 my-2 text-red-700 text-sm"
      >
        {{ violations.registrationNumber }}
      </div>
    </div>
    <div class="mb-2">
      <label
        for="reservation_birth"
        class="text-gray-700 block text-sm font-bold capitalize"
      >
        birth
      </label>
      <input
        id="reservation_birth"
        v-model="item.birth"
        :class="[
          'mt-1 w-full px-3 py-2 border rounded',
          violations?.birth ? 'border-red-500' : 'border-gray-300',
        ]"
        type="text"
        placeholder=""
      />
      <div
        v-if="violations?.birth"
        class="bg-red-100 rounded py-4 px-4 my-2 text-red-700 text-sm"
      >
        {{ violations.birth }}
      </div>
    </div>
    <div class="mb-2">
      <label
        for="reservation_personalNumber"
        class="text-gray-700 block text-sm font-bold capitalize"
      >
        personalNumber
      </label>
      <input
        id="reservation_personalNumber"
        v-model="item.personalNumber"
        :class="[
          'mt-1 w-full px-3 py-2 border rounded',
          violations?.personalNumber ? 'border-red-500' : 'border-gray-300',
        ]"
        type="text"
        placeholder=""
      />
      <div
        v-if="violations?.personalNumber"
        class="bg-red-100 rounded py-4 px-4 my-2 text-red-700 text-sm"
      >
        {{ violations.personalNumber }}
      </div>
    </div>
    <div class="mb-2">
      <label
        for="reservation_city"
        class="text-gray-700 block text-sm font-bold capitalize"
      >
        city
      </label>
      <input
        id="reservation_city"
        v-model="item.city"
        :class="[
          'mt-1 w-full px-3 py-2 border rounded',
          violations?.city ? 'border-red-500' : 'border-gray-300',
        ]"
        type="text"
        placeholder=""
      />
      <div
        v-if="violations?.city"
        class="bg-red-100 rounded py-4 px-4 my-2 text-red-700 text-sm"
      >
        {{ violations.city }}
      </div>
    </div>
    <div class="mb-2">
      <label
        for="reservation_country"
        class="text-gray-700 block text-sm font-bold capitalize"
      >
        country
      </label>
      <input
        id="reservation_country"
        v-model="item.country"
        :class="[
          'mt-1 w-full px-3 py-2 border rounded',
          violations?.country ? 'border-red-500' : 'border-gray-300',
        ]"
        type="text"
        placeholder=""
      />
      <div
        v-if="violations?.country"
        class="bg-red-100 rounded py-4 px-4 my-2 text-red-700 text-sm"
      >
        {{ violations.country }}
      </div>
    </div>

    <button
      type="submit"
      class="px-6 py-2 bg-green-500  font-medium rounded shadow-md hover:bg-green-600"
    >
      Submit
    </button>
  </form>
</template>

<script lang="ts" setup>
import { ref } from "vue";
import type { Reservation } from "~~/types/reservation";
import type { SubmissionErrors } from "~~/types/error";

const props = defineProps<{
  values?: Reservation;
  errors?: SubmissionErrors;
}>();

const violations = toRef(props, "errors");

let item: ref<Reservation> = ref({});

if (props.values) {
  item.value = {
    ...props.values,
  };
}

let emit = defineEmits<{
  (e: "submit", item: Reservation): void;
}>();

function emitSubmit() {
  emit("submit", item.value);
}
</script>
