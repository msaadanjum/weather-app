<script>
import WeatherCard from "./WeatherCard.vue";
import WeatherDialog from "./WeatherDialog.vue";
export default {
  components: { WeatherCard, WeatherDialog },
  data: () => ({
    apiResponse: null,
    detailUser: null,
    dialog: false,
    loading: true,
  }),

  created() {
    this.fetchData();
  },

  methods: {
    // Get all users
    async fetchData() {
      const url = "http://localhost/users";
      this.loading = true;
      this.apiResponse = await (await fetch(url)).json();
      this.loading = false;
    },
  },
};
</script>

<template>
  <div>
    <v-container class="mb-6">
      <template v-if="apiResponse && !loading">
        <div class="d-flex flex justify-lg-space-between my-7">
          <!-- To show the last time weather was updated -->
          <div v-if="apiResponse?.users[0]?.last_weather_updated">
            Last Updated:
            {{ $dayjs(apiResponse?.users[0].last_weather_updated).fromNow() }}
            ({{
              $dayjs(apiResponse?.users[0].last_weather_updated).format(
                "DD-MM-YYYY HH:mm A"
              )
            }})
          </div>
        </div>
        <weather-dialog
          :detailUser="detailUser"
          @reset-user="detailUser = null"
        />
        <v-row align="center" gutters="5">
          <v-col
            v-for="(user, index) in apiResponse.users"
            :key="index"
            xs="12"
            sm="6"
            md="4"
            lg="3"
            class="mb-5"
          >
            <weather-card
              @show-details="detailUser = user"
              :user="user"
            ></weather-card>
          </v-col>
        </v-row>
      </template>

      <!-- Loader before the data loads -->
      <v-row v-else class="my-7">
        <v-col
          v-for="index in 12"
          :key="index"
          cols="12"
          xs="12"
          sm="6"
          md="4"
          lg="3"
        >
          <v-sheet rounded color="grey-lighten-2" class="px-3 pt-3 pb-3" width="100%" height="200"></v-sheet>
        </v-col>
      </v-row>
    </v-container>
  </div>
</template>
