<template>
  <div>
    <div class="row">
      <div class="col-12">
        <div class="card">
          <img class="card-img-top" src="holder.js/100x180/" alt="" />
          <div class="card-body">
            <div class="row">
              <div class="col-9">
                <input
                  type="text"
                  class="form-control"
                  placeholder="Enter Barcode ID or NIC"
                  v-model="patient_id"
                  @keypress="get_lab_appointment_list()"
                />
              </div>
              <div class="col-3">
                <button
                  type="button"
                  @click="get_lab_appointment_list()"
                  class="form-control btn btn-success"
                >
                  Search Patient
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div v-if="patient_id == !null">
      <div class="row mt-3">
        <div class="col-12">
          <div class="card">
            <div style="background-color: #f64e60" class="card-header">
              <h6 style="color: white">Today Doctors Appointment List</h6>
            </div>
            <div class="card-body">
              <table class="table font-w-600 mb-0">
                <thead>
                  <tr>
                    <th>Token ID</th>
                    <th>Room No</th>
                    <th>Speciality</th>
                    <th>Doctor Name</th>
                    <th>Appointment Date</th>
                    <th>Payment Status</th>
                    <th>Amount</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr
                    class="zoom"
                    v-for="(app, index) in doc_app_list"
                    :key="index"
                  >
                    <th scope="row">{{ app.token.token }}</th>
                    <td class="text-info">{{ app.schedule.room.room_name }}</td>
                    <td v-if="Object.keys(app).length > 0" class="text-success">
                      {{ app.schedule.employee.doctor.speciality.name }}
                    </td>
                    <td class="text-danger">
                      {{ app.schedule.employee.first_name }}
                    </td>
                    <td class="text-info">{{ app.schedule.startDate }}</td>
                    <td class="text-danger">
                      {{ app.payment.payment_status }}
                    </td>
                    <td class="text-info">{{ app.payment.amount }}</td>
                    <td class="text-info">
                      <i
                        class="fa fa-print text-danger icon-button mx-1"
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
      <div class="row mt-3">
        <div class="col-12">
          <div class="card">
            <div style="background-color: #17a2b8" class="card-header">
              <h6 style="color: white">Lab Appointment</h6>
            </div>
            <div class="card-body">
              <table class="table">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Report Type</th>
                    <th>Patient Name</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr
                    class="zoom"
                    v-for="(data, index) in lab_app_list"
                    :key="index"
                  >
                    <td scope="row">{{ data.id }}</td>
                    <td class="text-danger">
                      {{ data.report_type.report_type }}
                    </td>
                    <td class="text-success">{{ data.patient.name }}</td>
                    <td>{{ data.payment.amount }}</td>
                    <td>{{ data.payment.payment_status }}</td>
                    <td class="text-info">
                      <i
                        @click="pay_appointment(data.id)"
                        v-if="data.payment.payment_status == 'Pending'"
                        class="fa fa-print text-success icon-button mx-1"
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
  </div>
</template>

<script>
export default {
  created() {},
  mounted() {
    //   this.get_lab_appointment_list();
  },
  data() {
    return {
      patient_id: "",
      lab_app_list: {},
      appointment_id: "",
      doc_app_list: {},
    };
  },
  methods: {
    get_lab_appointment_list: function () {
      axios
        .get("/api/lab/get_lab_appointment_for_reception/" + this.patient_id)
        .then((response) => {
          if (response.status == 200) {
            this.lab_app_list = response.data;
            this.get_doctor_appointment_list();
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },

    get_doctor_appointment_list: function () {
      axios
        .get("/api/lab/get_doc_appointment_for_reception/" + this.patient_id)
        .then((response) => {
          if (response.status == 200) {
            this.doc_app_list = response.data;
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },

    pay_appointment: function (data) {
      this.appointment_id = data;
      axios
        .patch("/api/lab/waiting_payment_paid/" + this.appointment_id)
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
