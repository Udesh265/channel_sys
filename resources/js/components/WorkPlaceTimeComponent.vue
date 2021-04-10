<template>
  <div class="row">
    <div class="col-12 mt-3">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title pb-2">Workplace Time Settings</h4>
          <small
            >Manage organization times. This will determine the employee's
            attendance based on times determined here.</small
          >
        </div>
        <div class="card-body">
          <div class="form-group row">
            <div class="col-4">
              <label for=""> Full Day Arrival Time (Before)</label>
            </div>
            <div class="col-8">
              <timepicker
                hide-clear-button
                format="h:mm A"
                v-model="settings.setting_ArrivalTimeFullDay"
                input-width="20em"
              />
            </div>
          </div>
          <div class="form-group row">
            <div class="col-4">
              <label for="">Half Day Arrival Time (Before)</label>
            </div>
            <div class="col-8">
              <timepicker
                hide-clear-button
                format="h:mm A"
                input-width="20em"
                v-model="settings.setting_ArrivalTimeHalfDay"
              />
            </div>
          </div>
          <div class="form-group row">
            <div class="col-4">
              <label for="">End Of Day (After)</label>
            </div>
            <div class="col-8">
              <timepicker
                hide-clear-button
                format="h:mm A"
                input-width="20em"
                v-model="settings.setting_EndOfDayTime"
              />
            </div>
          </div>
          <button
            @click="save_time_settings()"
            type="submit"
            class="btn btn-primary"
          >
            Update Time Settings
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  created() {},
  mounted() {},
  data() {
    return {
      settings: new Form({
        setting_ArrivalTimeFullDay: "",
        setting_ArrivalTimeHalfDay: "",
        setting_EndOfDayTime: "",
      }),
    };
  },
  methods: {
    save_time_settings: function () {
      this.settings
        .post("/api/attendance/workplace_time")
        .then((response) => {
          if (response.status == 200) {
            swal.fire(response.data.msg);
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
};
</script>

<style>
</style>
