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
        </div>
        <div class="row" v-if="selected_doc.id">
          <div class="col-6">
            <div class="form-group">
              <label for="form-control">Doctor Fee :{{  }}</label>
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
                ><h5>Pick Doctor Availble Date :</h5></label
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

    <!-- Modal -->
    <div
      class="modal fade"
      id="appointment_model"
      tabindex="-1"
      role="dialog"
      aria-labelledby="modelTitleId"
      aria-hidden="true"
    >

        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">
                Appointment Confirmation
              </h5>
              <button
                type="button"
                class="close"
                data-dismiss="modal"
                aria-label="Close"
              >
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div v-if="Object.keys(selected_doc).length > 0">
                <label for="form-control">Doctor Name : {{selected_doc.employee.first_name}}</label><br>
                <label for="form-control">Doctor Fee : {{selected_doc.charge_pp}}</label><br>
                <label for="form-control">Date : {{one_appointment.startDate}}</label>
                </div>
            </div>
            <div class="modal-footer">
              <button
                type="button"
                class="btn btn-secondary"
                data-dismiss="modal"
              >
                Close
              </button>
              <button type="button" class="btn btn-primary">
                Save changes
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
    this.get_schedule();
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
      selected_doc: {

      },
      one_appointment:{},


      showDate: new Date(),
      items: [],
    };
  },
  methods: {

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

        this.id = data.id;

        axios.get("/api/schedule/get_one_schedule/" + this.id)
        .then((response)=>{
            if(response.status == 200){
                this.one_appointment = response.data;
            }

        })
        .catch((error)=>{
            console.log(error);
        });

      $("#appointment_model").modal("show");


    },
  },
};
</script>

<style>
</style>

