<script>
export default {
  computed: {
    // Just a property to show the icon if weather is harsh
    harshWeather() {
      return this.user.weather.main.feels_like < 2 ||
        this.user.weather.main.feels_like > 40
        ? true
        : false;
    },
  },
  props: {
    user: Object,
    default: null,
  },
};
</script>

<template>
  <v-card
    class="mx-auto weather-card"
    @click="$emit('show-details')"
    v-if="user"
  >
    <v-card-item>
      <template v-slot:title>
        {{ user.name }}
      </template>
      <template v-slot:subtitle> </template>
    </v-card-item>

    <template v-if="user.weather && user.weather.cod == 200">
      <v-card-text class="py-0" v-if="user.weather">
        <v-row align="center" no-gutters>
          <v-col class="text-h4" cols="8">
            {{ user.weather.main.feels_like }}&deg;C
          </v-col>

          <v-col cols="4" class="text-right">
            <v-icon
              :color="harshWeather ? 'error' : 'success'"
              :icon="
                harshWeather
                  ? 'mdi-weather-cloudy-alert'
                  : 'mdi-weather-night-partly-cloudy'
              "
              size="30"
            ></v-icon>
          </v-col>
        </v-row>
      </v-card-text>

      <div class="d-flex py-3 justify-space-between">
        <v-list-item density="compact">
          <template v-slot:prepend>
            <v-icon
              icon="mdi-weather-windy"
              class="text-grey-darken-2 mr-2"
            ></v-icon>
          </template>
          <v-list-item-subtitle
            >{{ user.weather.wind.speed }} km/h</v-list-item-subtitle
          >
        </v-list-item>

        <v-list-item density="compact">
          <template v-slot:prepend>
            <v-icon
              icon="mdi-weather-pouring"
              class="text-grey-darken-2 mr-2"
            ></v-icon>
          </template>
          <v-list-item-subtitle
            >{{ user.weather.main.humidity }}%</v-list-item-subtitle
          >
        </v-list-item>
      </div>
    </template>
    <template v-else>
      <div class="text-h6 pa-4">
        <v-icon
          icon="mdi-alert-circle"
          size="18"
          color="error"
          class="me-1 pb-1"
        ></v-icon>
        No Weather details
      </div>
    </template>
  </v-card>
</template>
