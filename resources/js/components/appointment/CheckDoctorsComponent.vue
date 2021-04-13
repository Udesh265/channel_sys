<template>
  <div>
    <div class="card">
      <img class="card-img-top" src="holder.js/100x180/" alt="" />
      <div class="card-body">
        <div class="row">
          <div class="col-4">
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
          <div class="col-4">
            <div class="form-group">
              <label for="form-control">Doctor Name</label>
              <select
                v-model="selected_doc"
                @change="get_schedule"
                class="form-control"
              >
                <option
                  v-for="(doc, index) in doc_data"
                  :key="index"
                  :value="doc"
                >
                  {{ doc.employee.first_name }}
                </option>
              </select>
            </div>
          </div>
          <div class="col-4">
            <div class="form-group">
              <label for="form-control">Doctor Fee :</label>
              <input
                class="form-control"
                disabled="true"
                type="text"
                name=""
                id=""
                v-model="selected_doc.charge_pp"
              />
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-12">
            <div class="form-group">
              <label for="form-control"
                ><h5>Doctor Availble Date :</h5></label
              >
              <calendar-view
                :showTimes="true"
                @click-date="
                  (date) => {
                    calenderClicked(date);
                  }
                "
                @click-item="
                  (calendarItem) => {
                    appointment_item(calendarItem);
                  }
                "
                class="theme-default"
                :startingDayOfWeek="1"
                :show-date="showDate"
                :items="items"
                style="height: 70vh"
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
      </div>
    </div>

    <!-- end model -->
  </div>
</template>

<script>
export default {
  created() {
    this.get_spec();
    this.get_patient_by_user_id();
  },
  props: ["user_id"],
  mounted() {
    this.get_doc_list();
    this.get_schedule();

    $(this.$refs.appointment_model).on(
      "hidden.bs.modal",
      this.on_appointment_modal_close
    );
  },
  data() {
    return {
      form: new Form({
        spec_id: "",
        name: "",
      }),

      sform: new Form({
        charge_pp: "",
        payment_method: "",
        schedule_id: "",
        user_id: this.user_id,
        status: "1",
        p_id: "",
      }),

      spec_data: {},
      doc_data: {},
      patient_data: {},

      // calnder

      one_appointment: {},
      selected_doc: {},

      showDate: new Date(),
      items: [],
    };
  },
  methods: {
    on_appointment_modal_close: function () {
      this.sform.reset();
    },
    get_schedule: function () {
      axios
        .get("/api/appointment/get/" + this.selected_doc.employee_id)
        .then((response) => {
          if (response.status == 200) {
            this.items = response.data.map((item) => {
              return {
                id: item.id,
                startDate: item.startDate,
                classes: "bg-event event-button",
                title: "Available",
              };
            });
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },

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
          //   console.log(response);
          if (response.status == 200) {
            this.doc_data = response.data;
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },

    setShowDate(d) {
      this.showDate = d;
    },

    // getEventDetails: function (data) {
    //   console.log(data);
    // },

    appointment_item: function (data) {
      this.sform.schedule_id = data.id;
      this.sform.charge_pp = this.selected_doc.charge_pp;
      this.sform.p_id = this.patient_data.id;
      axios
        .get("/api/schedule/get_one_schedule/" + this.sform.schedule_id)
        .then((response) => {
          if (response.status == 200) {
            this.one_appointment = response.data;
          }
        })
        .catch((error) => {
          console.log(error);
        });

      $("#appointment_model").modal("show");
    },
  },
};
</script>

<style>
</style>

