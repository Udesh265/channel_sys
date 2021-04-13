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
                        @click="load_doc_appointment_pay_modal(app)"
                        v-if="app.payment.payment_status == 'Pending'"
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
                        @click="load_payment_modal(data)"
                        v-if="data.payment.payment_status == 'Pending'"
                        class="fa fa-print text-success icon-button mx-1"
                      ></i>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <!--Start Pay Doctor Appointment bill modal  -->
            <!-- Modal -->
            <div
              class="modal fade"
              id="load_pay_modal"
              tabindex="-1"
              role="dialog"
              aria-labelledby="modelTitleId"
              aria-hidden="true"
            >
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header" style="background-color: #1e3d73">
                    <h5 class="modal-title" style="color: white">
                      Payment For Lab Appointment
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
                    <div class="form-group mt-2">
                      <label for=""><h5>Appointment Fee :</h5></label>
                      <label for=""
                        ><h5>{{ billform.lab_app_amount }} LKR</h5></label
                      >
                    </div>
                    <div class="form-group">
                      <label for=""><h6>Balance</h6></label>
                      <input
                        type="text"
                        class="form-control"
                        disabled
                        v-model="balance"
                      />
                    </div>
                    <div class="form-group">
                      <label for=""><h6>Paid Amount</h6></label>
                      <input
                        type="text"
                        v-model="billform.paid_amount"
                        class="form-control"
                        placeholder=""
                        aria-describedby="helpId"
                      />
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
                    <button
                    v-if="billform.paid_amount >= billform.lab_app_amount"
                      @click="pay_appointment()"
                      type="button"
                      class="btn btn-primary"
                    >
                      Pay & Print Bill
                    </button>
                  </div>
                </div>
              </div>
            </div>
            <!-- End Doctor Appointment Payment Modal  -->

            <!-- Start printed bill for lab appointment  -->
            <div
              class="modal fade"
              id="load_doc_pay_modal"
              tabindex="-1"
              role="dialog"
              aria-labelledby="modelTitleId"
              aria-hidden="true"
            >
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header" style="background-color: #1e3d73">
                    <h5 class="modal-title" style="color: white">
                      Payment For Doctor Appointment
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
                    <div class="form-group mt-2">
                      <label for=""><h5>Appointment Fee :</h5></label>
                      <label for=""
                        ><h5>{{ billform.lab_app_amount }} LKR</h5></label
                      >
                    </div>
                    <div class="form-group">
                      <label for=""><h6>Balance</h6></label>
                      <input
                        type="text"
                        class="form-control"
                        disabled
                        v-model="balance"
                      />
                    </div>
                    <div class="form-group">
                      <label for=""><h6>Paid Amount</h6></label>
                      <input
                        type="text"
                        v-model="billform.paid_amount"
                        class="form-control"
                        placeholder=""
                        aria-describedby="helpId"
                      />
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
                    <button
                      @click="pay_doctor_appointment()"
                      type="button"
                      class="btn btn-primary"
                    >
                      Pay & Print Bill
                    </button>
                  </div>
                </div>
              </div>
            </div>

            <!-- Show Bill Modal -->
            <div
              id="printme"
              class="modal"
              tabindex="-1"
              role="dialog"
              aria-hidden="true"
            >
              <div id="invoice-POS">
                <!-- <p style="margin-left: 85px; margin-top:0px;">බිල්පත</p> -->
                <p style="margin-left: 15px; font-size: 14px">
                  --- Nawamini Channelling Centre ----
                  <br />New Town, Digana, Rajawella <br />Tel:
                  0552268036/0719362359
                </p>
                ---------------------------------------------
                <div>
                  <label style="font-size: 12px">ID:</label>
                  <label style="font-size: 12px">{{
                    billform.appointment_id
                  }}</label>
                  <label style="font-size: 12px; margin-left: 20px"
                    >Date :</label
                  >
                  <label style="font-size: 12px">{{ billform.date }}</label>
                </div>

                <table style="width: 250px">
                  <tr>
                    <th style="text-align: left; font-size: 12px">#</th>
                    <th style="text-align: left; font-size: 12px">
                      Description
                    </th>
                    <th style="text-align: left; font-size: 12px">Fee</th>
                  </tr>
                  <tr>
                    <td style="text-align: left; font-size: 10px">
                      {{ billform.appointment_id }}
                    </td>
                    <td style="text-align: left; font-size: 10px">
                      {{ billform.test_name }}
                    </td>
                    <td style="text-align: left; font-size: 10px">
                      {{ billform.lab_app_amount }}
                    </td>
                  </tr>
                </table>

                <label style="font-size: 12px">Paid Amount:</label>
                <label style="font-size: 12px; margin-left: 10px"
                  >Rs: {{ billform.paid_amount }}</label
                >
                <br />

                <label style="font-size: 12px">Total :</label>
                <label style="font-size: 12px; margin-left: 5px"
                  >Rs: {{ billform.lab_app_amount }}</label
                >
                <br>
                <label style="font-size: 14px"> Token No : </label>
                <label style="font-size: 15px; margin-left: 5px"
                  > {{ billform.token }} </label
                >
                <br />---------------------------------------------
                <br />
                <div style="margin-left: 55px; font-size: 12px">
                  Thank You,Welcome!
                </div>

                <p style="font-size: 10px; margin-left: 15px">
                  Software Developed by Udesh / For BIT Project
                </p>
              </div>
            </div>
            <!--  End Modal -->

            <!-- ENd printed bill for lab appointment  -->
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
    // this.pay_appointment();
  },
  computed: {
    balance() {
      return (
        parseInt(this.billform.paid_amount) -
        parseInt(this.billform.lab_app_amount)
      );
    },
  },
  data() {
    return {
      patient_id: "",
      lab_app_list: {},
      doc_app_list: {},

      billform: new Form({
        appointment_id: "",
        lab_app_amount: 0,
        paid_amount: 0,
        test_name: "",
        date: "",
        token:"",
      }),
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

    load_doc_appointment_pay_modal: function (app) {
      $("#load_doc_pay_modal").modal("show");
      this.billform.appointment_id = app.id;
      this.billform.token = app.token.token;
      this.billform.lab_app_amount = app.payment.amount;
      this.billform.test_name = app.schedule.employee.doctor.speciality.name;
      this.billform.date = app.schedule.startDate;
    },

    load_payment_modal: function (data) {
      $("#load_pay_modal").modal("show");
      this.billform.appointment_id = data.id;
      this.billform.lab_app_amount = data.payment.amount;
      this.billform.test_name = data.report_type.report_type;
      this.billform.date = data.date;
    },

    pay_appointment: function () {
      //   this.appointment_id = data.id;
      axios
        .patch("/api/lab/waiting_payment_paid/" + this.billform.appointment_id)
        .then((response) => {
          if (response.status == 200) {
            swal.fire(response.data.msg);
            this.get_lab_appointment_list();
            $("#load_pay_modal").modal("hide");
            this.$htmlToPaper("printme");
            this.billform.reset();

            // setTimeout(() => {
            //   const d = new Printd();
            //   d.print(document.getElementById("printme"));
            // }, 1000);
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },

    pay_doctor_appointment: function () {

        // console.log("hi");
      //   this.appointment_id = data.id;
      axios
        .patch("/api/appointment/waiting_payment_paid/" + this.billform.appointment_id)
        .then((response) => {
          if (response.status == 200) {
            swal.fire(response.data.msg);
            this.get_doctor_appointment_list();
            $("#load_doc_pay_modal").modal("hide");
            this.$htmlToPaper("printme");
            this.billform.reset();
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
#invoice-POS {
  padding: 0mm;
  margin: 0 auto;
  margin-bottom: 1px;
  width: 100mm;
  background: #fff;
}
</style>
