<template>
  <div>
    <!-- <div class="row">
      <div class="col-12 col-sm-6 col-xl-4 mt-3">
        <div class="card">
          <div class="card-body text-info border-bottom border-info border-w-5">
            <h2 class="text-center">{{ appointment_data }}</h2>
            <h6 class="text-center">Total Doctors Appointments</h6>
          </div>
        </div>
      </div>
      <div class="col-12 col-sm-6 col-xl-4 mt-3">
        <div class="card">
          <div
            class="card-body text-success border-bottom border-success border-w-5"
          >
            <h2 class="text-center">{{ total_app_amount | currency }}</h2>
            <h6 class="text-center">Total Paid Amount (LKR)</h6>
          </div>
        </div>
      </div>
      <div class="col-12 col-sm-6 col-xl-4 mt-3">
        <div class="card">
          <div
            class="card-body text-danger border-bottom border-danger border-w-5"
          >
            <h2 class="text-center">{{ panding_amount | currency }}</h2>
            <h6 class="text-center">Waiting Appointments (LKR)</h6>
          </div>
        </div>
      </div>
    </div> -->
    <div class="row">
      <div class="col-12 mt-3">
        <div class="card">
          <div class="card-header justify-content-between align-items-center">
            <h6 class="card-title">View Doctors Appointments</h6>
          </div>
          <div class="card-body table-responsive p-0">
            <table class="table font-w-600 mb-0">
              <thead>
                <tr>
                  <th>Token ID</th>
                  <th>Room No</th>
                  <th>Speciality</th>
                  <th>Doctor Name</th>
                  <th>Appointment Date</th>
                  <th>Payment Status</th>
                  <th>Type</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody >

                <tr

                  class="zoom"
                  v-for="(app, index) in appointment_list"
                  :key="index"

                >

                  <th scope="row">{{ app.token.token }}</th>
                  <td  class="text-info">{{ app.schedule.room.room_name }}</td>
                  <td v-if="Object.keys(app).length > 0" class="text-success">
                    {{ app.schedule.employee.doctor.speciality.name }}
                  </td>
                  <td class="text-danger">
                    {{ app.schedule.employee.first_name }}
                  </td>
                  <td class="text-info">{{ app.schedule.startDate }}</td>
                  <td class="text-danger">{{ app.payment.payment_status }}</td>
                  <td class="text-info">{{ app.payment.type }}</td>
                  <td class="text-info">
                    <i
                      class="fa fa-trash text-danger icon-button mx-1"
                      @click="delete_app(app.id)"
                    ></i>
                    <i
                      class="fa fa-eye text-success icon-button mx-1"
                      @click="modal_appointment_view(app)"
                    ></i>
                  </td>

                </tr>

              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-12 mt-3">
        <div class="card">
          <div class="card-header justify-content-between align-items-center">
            <h6 class="card-title">View Lab Appointments</h6>
          </div>
          <div class="card-body table-responsive p-0">
            <table class="table font-w-600 mb-0">
              <thead>
                <tr>
                <th>#</th>
                  <th>Appointment Date</th>
                  <th>Report Type</th>
                  <th>Payment Status</th>
                  <th>Report Status</th>
                  <th>Fee</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <tr
                  class="zoom"
                  v-for="(app, index) in lab_app_list"
                  :key="index"
                >
                    <th scope="row">{{ app.id }}</th>
                  <th scope="row">{{ app.date }}</th>
                  <td class="text-success">
                    {{ app.report_type.report_type }}
                  </td>
                  <td class="text-danger">
                    {{ app.payment.payment_status }}
                  </td>
                         <td class="text-danger">
                    {{ app.status }}
                  </td>
                  <td class="text-info">{{ app.report_type.fee }}</td>

                  <td class="text-info">
                    <i
                      class="fa fa-trash text-danger icon-button mx-1"
                      @click="del_lab_app(app.id)"
                    ></i>
                    <!-- <i
                      class="fa fa-eye text-success icon-button mx-1"
                      @click="modal_lab_app_view(app)"
                    ></i> -->
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <!-- appoitnment view modal start -->
    <!-- Modal -->
    <div
      class="modal fade"
      id="modal_app_view"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalCenterTitle"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header" style="background-color: #001638">
            <h5 class="modal-title" style="color: white">Doctor Appointment</h5>
            <button
              style="color: white"
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <h5 v-if="selected_appointment.hasOwnProperty('schedule')">
              Your Appointment at :
              {{ selected_appointment.schedule.startDate }}
            </h5>
            <br />
            <h5 v-if="selected_appointment.hasOwnProperty('schedule')">
              Doctor : {{ selected_appointment.schedule.employee.first_name }}
            </h5>
            <br />
               <h5 v-if="selected_appointment.hasOwnProperty('schedule')">
              Room : {{ selected_appointment.schedule.room.room_name }}
            </h5>
            <br />
            <h3
              class="text-center"
              v-if="selected_appointment.hasOwnProperty('token')"
            >
              TOKEN ID: {{ selected_appointment.token.token }}
            </h3>
          </div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-secondary"
              data-dismiss="modal"
            >
              Close
            </button>
          </div>
        </div>
      </div>
      <!-- End doctor appointment  -->

       <!--Lab Appoitnment view modal start -->
    <!-- Modal -->
    <div
      class="modal fade"
      id="modal_lab_app"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalCenterTitle"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header" style="background-color: #001638">
            <h5 class="modal-title" style="color: white">Lab Appointment</h5>
            <button
              style="color: white"
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <h5>
              Your Appointment at :
                {{ selected_lab_appointment_data.date }}
            </h5>

            <br />

          </div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-secondary"
              data-dismiss="modal"
            >
              Close
            </button>
          </div>
        </div>
      </div>
    </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["user_id"],
  created() {
    this.get_total_appointment();
    this.get_patient_by_user_id();
    this.get_lab_appointments();
  },

  mounted() {
    // this.get_total_appointment_amount();
  },
  data() {
    return {
      appointment_data: {},
      patient_data: {},
      total_app_amount: {},
      panding_amount: {},
      appointment_list: {},
      selected_appointment: {},
      lab_app_list: {},
      display_appointment_date:"",
      selected_lab_appointment_data:{},

      vform: new Form({
        p_id: "",
        app_id: "",
      }),
    };
  },
  methods: {
    get_total_appointment: function () {
      axios
        .get("/api/appointment/get_app_by_userID/" + this.user_id)
        .then((response) => {
          if (response) {
            this.appointment_data = response.data;
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },

    get_patient_by_user_id: function () {
      axios
        .get("/api/appointment/get_patient_by_userID/" + this.user_id)
        .then((response) => {
          if (response.status == 200) {
            this.patient_data = response.data;
            this.vform.p_id = this.patient_data.id;

            this.get_total_appointment_amount();
            this.get_pending_payment();
            this.get_appointment_list();
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },

    get_total_appointment_amount: function () {
      axios
        .get("/api/appointment/get_tot_amount/" + this.vform.p_id)
        .then((response) => {
          if (response.status == 200) {
            this.total_app_amount = response.data;
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
    get_pending_payment: function () {
      axios
        .get("/api/appointment/get_pending_pay/" + this.vform.p_id)
        .then((response) => {
          if (response.status == 200) {
            this.panding_amount = response.data;
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },

    get_appointment_list: function () {
      axios
        .get("/api/appointment/get_appointment_list/" + this.vform.p_id)
        .then((response) => {
          if (response.status == 200) {
            this.appointment_list = response.data;
            // let new_date = moment(this.appointment_list.).format("LL");
            // this.display_doctor_appointment_date = new_date;

          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
    delete_app: function (id) {
      swal
        .fire({
          title: "Are you sure?",
          text: "You won't be able to revert this!",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Yes, Delete it!",
        })
        .then((result) => {
          if (result.isConfirmed) {
            axios
              .patch("/api/appointment/del/" + id)
              .then((response) => {
                if (response.status == 200) {
                  this.get_appointment_list();
                }
              })
              .catch((error) => {
                console.log(error);
              });
          }
        });
    },

        del_lab_app: function (id) {
      swal
        .fire({
          title: "Are you sure?",
          text: "You won't be able to revert this!",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Yes, Delete it!",
        })
        .then((result) => {
          if (result.isConfirmed) {
            axios
              .patch("/api/appointment/del_lab_app/" + id)
              .then((response) => {
                if (response.status == 200) {
                  this.get_lab_appointments();
                }
              })
              .catch((error) => {
                console.log(error);
              });
          }
        });
    },

    modal_appointment_view: function (app) {
      $("#modal_app_view").modal("show");
      this.selected_appointment = app;
    },
    modal_lab_app_view: function (app) {
      $("#modal_lab_app").modal("show");
      this.selected_lab_appointment_data = app;
    },



    get_lab_appointments: function () {
      axios
        .get("/api/lab/get_lab_appointment/" + this.user_id)
        .then((response) => {
          if (response.status == 200) {
            this.lab_app_list = response.data;

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


