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
                v-model="s_form.employee_id"
                @change="get_schedule"
                class="form-control"
              >
                <option
                  v-for="(doc, index) in doc_data"
                  :key="index"
                  :value="doc.employee.id"
                >
                  {{ doc.employee.first_name }}
                </option>
              </select>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-6">
            <div class="form-group">
              <label for="form-control">Room</label>
              <select
              @change="get_all_schedule"
                v-model="s_form.room_id"

                class="form-control"
              >
                <option
                  v-for="(room, index) in room_list"
                  :key="index"
                  :value="room.id"
                >
                  {{ room.room_name }}
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
                :showTimes="true"
                @click-date="
                  (date) => {
                    calenderClicked(date);
                  }
                "
                @click-item="
                  (calendarItem) => {
                    remove_item(calendarItem);
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
      </div>
    </div>

    <!-- Modal -->
    <div
      class="modal fade"
      id="s_model"
      tabindex="-1"
      role="dialog"
      aria-labelledby="modelTitleId"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-body">
            <div class="container-fluid">
              <div class="row">
                <div class="col-md-6 m-auto text-center">
                  <label for="form-control">Pick Time</label>
                  <input
                    v-model="s_form.time"
                    class="form-control"
                    :class="{ 'is-invalid': s_form.errors.has('time') }"
                    type="time"
                  />
                  <has-error :form="s_form" field="time"></has-error>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer text-center">
            <button
              type="button"
              class="btn btn-secondary"
              data-dismiss="modal"
            >
              Close
            </button>
            <button
              type="button"
              @click="create_schedule"
              class="btn btn-primary"
            >
              Save
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
      room_list:{},

      // calnder

      s_form: new Form({
        employee_id: "",
        startDate: "",
        time: "",
        room_id:""
      }),

      showDate: new Date(),
      items: [],
    };
  },
  methods: {
    create_schedule: function () {
      this.s_form
        .post("/api/schedule/save")
        .then((response) => {
          if (response.status == 200) {
            this.items = response.data.map((item) => {
              return {
                id: item.id,
                startDate: item.startDate,
                classes: "bg-event",
                title: "Scheduled",
              };
            });
            $("#s_model").modal("hide");
            this.get_all_schedule();

          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
    get_schedule: function () {
      axios
        .get("/api/schedule/get/" + this.s_form.employee_id)
        .then((response) => {
          if (response.status == 200) {
            this.items = response.data.map((item) => {
              return {
                id: item.id,
                startDate: item.startDate,
                classes: "bg-event",
                title: `Scheduled - ${item.employee.first_name}`,
              };
            });
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
        get_all_schedule: function () {

      axios
        .get("/api/schedule/get_by_room_id/" + this.s_form.room_id, {params: {emp_id: this.s_form.employee_id}} )
        .then((response) => {
          if (response.status == 200) {
            this.items = response.data.map((item) => {
              return {
                id: item.id,
                startDate: item.startDate,
                classes: "bg-event",
                title: `${item.employee.first_name}`,
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
          console.log(response);
          if (response.status == 200) {
            this.doc_data = response.data;
            this.get_room_list();
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },

    calenderClicked(date) {
      let newDate = this.$options.filters.calenderDate(date);
      //   console.log(newDate);
      this.s_form.startDate = newDate;
      if (this.s_form.employee_id) {
        $("#s_model").modal("show");
      }
    },
    setShowDate(d) {
      this.showDate = d;
    },

    getEventDetails: function (data) {
      console.log(data);
    },
    get_room_list: function(){
          axios
          .get('/api/room_list')
          .then((response) => {
              if(response.status == 200){
                  this.room_list = response.data;
              }
          })
          .catch((error) => {
              console.log(error);
          });
      },


    remove_item: function (data) {
      //   let id = data.id;

      let { id } = data;
      console.log(data);
      swal
        .fire({
          title: "Are you sure?",
          text: "You won't be able to revert this!",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Yes, delete it!",
        })
        .then((result) => {
          if (result.isConfirmed) {
            axios
              .delete("/api/schedule/del/" + id)
              .then((response) => {
                if (response.status == 200) {
                  this.get_schedule();
                }
              })
              .catch((error) => {
                console.log(error);
              });
          }
        });
    },
  },
};
</script>

<style>
</style>

