<template>
  <div class="mt-3">
    <div class="card parentStyle">
      <div class="card-body">
        <calendar-view
          @click-date="
            (date) => {
              calenderClicked(date);
            }
          "
          class="theme-default"
          :startingDayOfWeek="1"
          :show-date="showDate"
          :items="items"
          style="height: 100vh"
        >
          <calendar-view-header
            slot="header"
            slot-scope="t"
            :header-props="t.headerProps"
            @input="setShowDate"
          />
        </calendar-view>
      </div>
    </div>
  </div>

</template>

<script>
export default {
  mounted() {
    console.log("Component mounted.");
  },
  data() {
    return {
      showDate: new Date(),
      items: [
        {
          id: 1,
          title: "Doctor Name",
          classes: "bg-event",
          startDate: "2021-01-03",
        },
        {
          id: 2,
          title: "Doctor aPP 2",
          classes: "bg-event",
          startDate: "2021-01-03",
        },

      ],
    };
  },
  methods: {
    calenderClicked(date) {
      let newDate = this.$options.filters.calenderDate(date);
      console.log(newDate);
    },
    setShowDate(d) {
      this.showDate = d;
    },
  },
};
</script>

