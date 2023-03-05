<script>
export default {
  props: {
    detailUser: Object,
    default: null,
  },
  data() {
    return {
      dialog: false,
    };
  },
  watch: {
    /**
     * Listener to show dialog box when clicked on a card
     */
    detailUser() {
      if (this.detailUser) {
        this.dialog = true;
      }
    },
    /**
     * Listener to reset the dialog when modal is closed
     */
    dialog() {
      if (this.dialog == false) {
        this.$emit("reset-user");
      }
    },
  },
};
</script>

<template>
  <v-row justify="center">
    <v-dialog
      width="auto"
      max-width="600px"
      v-model="dialog"
      transition="dialog-bottom-transition"
    >
      <v-card v-if="detailUser">
        <v-toolbar dark color="success" height="50">
          <v-btn icon dark @click="dialog = false">
            <v-icon>mdi-close</v-icon>
          </v-btn>
          <v-toolbar-title
            >Weather Details: <b>{{ detailUser.name }}</b></v-toolbar-title
          >
        </v-toolbar>
        <v-list lines="two" class="slim-scrollbar" subheader>
          <v-row align="center" no-gutters>
            <v-col class="mb-5" v-if="detailUser.weather.name" cols="6">
              <v-list-item
                prepend-icon="mdi-flag"
                title="Name"
                :subtitle="`${detailUser.weather.name}`"
              ></v-list-item>
            </v-col>
            <v-col class="mb-5" cols="6">
              <v-list-item
                prepend-icon="mdi-map-marker-radius"
                title="Location"
                :subtitle="`${detailUser.weather.coord.lon}, ${detailUser.weather.coord.lat}`"
              ></v-list-item>
            </v-col>
            <v-col class="mb-5" cols="6">
              <v-list-item
                prepend-icon="mdi-thermometer"
                title="Temperature"
                :subtitle="`${detailUser.weather.main.temp_min} / ${detailUser.weather.main.temp_max} &deg;C`"
              ></v-list-item>
            </v-col>

            <v-col class="mb-5" cols="6">
              <v-list-item
                prepend-icon="mdi-weather-cloudy"
                :title="detailUser.weather?.weather[0]?.main"
                :subtitle="`${detailUser.weather?.weather[0]?.description}`"
              ></v-list-item>
            </v-col>
            <v-col class="mb-5" cols="6">
              <v-list-item
                prepend-icon="mdi-weather-windy"
                title="Pressure"
                :subtitle="`${detailUser.weather.main.pressure}`"
              ></v-list-item>
            </v-col>
            <v-col
              class="mb-5"
              cols="6"
              v-if="detailUser.weather?.sys?.sunrise"
            >
              <v-list-item
                prepend-icon="mdi-weather-sunny"
                title="Sunrise"
                :subtitle="`${$dayjs(detailUser.weather.sys.sunrise).format(
                  'HH:mm A'
                )}`"
              ></v-list-item>
            </v-col>
            <v-col class="mb-5" cols="6" v-if="detailUser.weather?.sys?.sunset">
              <v-list-item
                prepend-icon="mdi-weather-night"
                title="Sunset"
                :subtitle="`${$dayjs(detailUser.weather.sys.sunset).format(
                  'HH:mm A'
                )}`"
              ></v-list-item>
            </v-col>

            <v-col class="mb-5" cols="6">
              <v-list-item
                prepend-icon="mdi-water-percent"
                title="Humidity"
                :subtitle="`${detailUser.weather.main.humidity}%`"
              ></v-list-item>
            </v-col>
            <v-col class="mb-5" cols="6">
              <v-list-item
                prepend-icon="mdi-account-eye"
                title="Visibility"
                :subtitle="`${detailUser.weather.visibility}`"
              ></v-list-item>
            </v-col>
            <v-col class="mb-5" cols="6">
              <v-list-item
                prepend-icon="mdi-tailwind"
                title="Wind"
                :subtitle="`${detailUser.weather.wind.speed} km/h`"
              ></v-list-item>
            </v-col>
          </v-row>
        </v-list>
        <v-divider></v-divider>
        <v-card-actions class="d-flex justify-end">
          <v-btn variant="flat" color="error" @click="dialog = false"
            >Close</v-btn
          >
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-row>
</template>
