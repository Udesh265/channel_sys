<template>
  <div>
    <div class="card">
      <img class="card-img-top" src="holder.js/100x180/" alt="" />
      <div class="card-body">
        <div class="row">
          <div class="col-6">
            <div class="form-group">
              <label for="form-control">Speciality</label>
              <select
                v-model="form.spec_id"
                @change="get_doc_list"
                class="form-control"
              >
                <option
                  v-for="(spec, index) in spec_data"
                  :key="index"
                  :value="spec.id"
                >
                  {{ spec.name }}
                </option>
              </select>
            </div>
          </div>
          <div class="col-6">
            <div class="form-group">
              <label for="form-control">Doctor Name</label>
              <select v-model="form.name" class="form-control">
                <option
                  v-for="(doc, index) in doc_data"
                  :key="index"
                  :value="doc.id"
                >
                  {{ doc.employee.first_name }}
                </option>
              </select>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <div class="form-group">
              <label for="form-control">Add Date & Time</label>
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
                style="height: 80vh"
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
        <div class="row">
          <div class="col-12">
            <button type="button" class="btn btn-primary">
              Create Schedule
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  created() {
    this.get_spec();
  },
  mounted() {
    this.get_doc_list();
  },
  data() {
    return {
      form: new Form({
        spec_id: "",
        name: "",
      }),
      spec_data: {},
      doc_data: {},

      // calnder
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
    get_spec: function () {
      axios
        .get("/api/doctor/get_spec")
        .then((response) => {
          if (response.status == 200) {
            this.spec_data = response.data;
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
    get_doc_list: function () {
      axios
        .get("/api/doctor/get_doc_list/" + this.form.spec_id)
        .then((response) => {
          console.log(response);
          if (response.status == 200) {
            this.doc_data = response.data;
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },

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

<style>
</style>
