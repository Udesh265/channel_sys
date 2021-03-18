<template>
  <div>
    <div class="row">
      <div class="col-12 col-sm-6 col-xl-4 mt-3">
        <div class="card">
          <div class="card-body text-info border-bottom border-info border-w-5">
            <h2 class="text-center">{{ appointment_data }}</h2>
            <h6 class="text-center">Total Appointments</h6>
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
    </div>
    <div class="row">
      <div class="col-12 mt-3">
        <div class="card">
          <div class="card-header justify-content-between align-items-center">
            <h6 class="card-title">View Appointments</h6>
          </div>
          <div class="card-body table-responsive p-0">
            <table class="table font-w-600 mb-0">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Speciality</th>
                  <th>Doctor Name</th>
                  <th>Appointment Date</th>
                  <th>Payment Status</th>
                  <th>Type</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <tr
                  class="zoom"
                  v-for="(app, index) in appointment_list"
                  :key="index"

                >
                  <th scope="row">{{ app.id }}</th>
                  <td class="text-success">
                    {{ app.schedule.employee.doctor.speciality.name }}
                  </td>
                  <td class="text-danger">
                    {{ app.schedule.employee.first_name }}
                  </td>
                  <td class="text-info">{{ app.schedule.startDate }}</td>
                   <td  class="text-info">{{ app.payment.payment_status }}</td>
                    <td  class="text-info">{{ app.payment.type }}</td>
                  <td class="text-info">
                    <i
                      class="fa fa-trash text-danger icon-button mx-1"
                      @click="delete_app(app.id)"
                    ></i>
                  </td>
                </tr>
              </tbody>
            </table>
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

      vform: new Form({
        p_id: "",
        app_id:"",
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
        .get("/api/appointment/get_patient/" + this.user_id)
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
            //    this.vform.app_id = this.app.id;
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
    delete_app: function(id){
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

        axios.patch("/api/appointment/del/" + id)
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
  },
};
</script>

<style>
</style>
