<template>
  <div>
    <div class="card">
      <div class="card-header">
        <ul
          class="nav nav-tabs card-header-tabs pull-right"
          id="myTab"
          role="tablist"
        >
          <li class="nav-item">
            <a
              class="nav-link active"
              id="home-tab"
              data-toggle="tab"
              href="#home"
              role="tab"
              aria-controls="home"
              aria-selected="true"
              >Doctor Appointments</a
            >
          </li>
          <li class="nav-item">
            <a
              class="nav-link"
              id="profile-tab"
              data-toggle="tab"
              href="#profile"
              role="tab"
              aria-controls="profile"
              aria-selected="false"
              >Lab Appointments</a
            >
          </li>
          <li class="nav-item">
            <a
              class="nav-link"
              id="contact-tab"
              data-toggle="tab"
              href="#contact"
              role="tab"
              aria-controls="contact"
              aria-selected="false"
              >Services</a
            >
          </li>
        </ul>
      </div>

      <div class="card-body">
        <div class="tab-content" id="myTabContent">
          <div
            class="tab-pane fade show active"
            id="home"
            role="tabpanel"
            aria-labelledby="home-tab"
          >
            <!-- start doctot appointments  -->
            <div class="row mt-3">
              <div class="col-12">
                <div class="row">
                  <div class="col-3">
                    From :
                    <input
                      v-model="t_from"
                      class="form-control"
                      type="date"
                      name=""
                      id=""
                    />
                  </div>
                  <div class="col-3">
                    To :
                    <input
                      v-if="this.t_from != ''"
                      @change="get_doctor_appointment_list_by_selected_date"
                      v-model="t_to"
                      class="form-control"
                      type="date"
                      name=""
                      id=""
                    />
                  </div>
                  <div class="col-3">
                    Doctor Speciality :
                    <select
                      v-model="spec_id"
                      @change="get_doctor_appointment_list_by_selected_speciality"
                      class="form-control"
                    >
                      <option
                        v-for="(spec, index) in spec_data"
                        :key="index"
                        :value="spec.name"
                      >
                        {{ spec.name }}
                      </option>
                    </select>
                  </div>
                </div>
                <div class="card mt-2">
                  <div style="background-color: #f64e60" class="card-header">
                    <h6 class="ml-1" style="color: white">
                      Doctors Appointment List
                    </h6>
                  </div>
                  <div id="printme" class="card-body">
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
                          v-for="(app, index) in selected_doc_app_list"
                          :key="index"
                        >
                          <th v-if="Object.keys(app).length > 0" scope="row">
                            {{ app.token.token }}
                          </th>
                          <td
                            v-if="Object.keys(app).length > 0"
                            class="text-info"
                          >
                            {{ app.schedule.room.room_name }}
                          </td>
                          <td
                            v-if="Object.keys(app).length > 0"
                            class="text-success"
                          >
                            {{ app.schedule.employee.doctor.speciality.name }}
                          </td>
                          <td
                            v-if="Object.keys(app).length > 0"
                            class="text-danger"
                          >
                            {{ app.schedule.employee.first_name }}
                          </td>
                          <td
                            v-if="Object.keys(app).length > 0"
                            class="text-info"
                          >
                            {{ app.schedule.startDate }}
                          </td>
                          <td class="text-danger">
                            {{ app.payment.payment_status }}
                          </td>
                          <td
                            v-if="Object.keys(app).length > 0"
                            class="text-info"
                          >
                            {{ app.payment.amount }}
                          </td>
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
                  <button @click="print()">print</button>
                </div>
              </div>
            </div>
            <!-- end doctor appointment  -->
          </div>
          <div
            class="tab-pane fade"
            id="profile"
            role="tabpanel"
            aria-labelledby="profile-tab"
          >
            <!-- Start lab appointment  -->
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
                </div>
              </div>
            </div>
            <!-- End lab appointment  -->
          </div>
          <div
            class="tab-pane fade"
            id="contact"
            role="tabpanel"
            aria-labelledby="contact-tab"
          >
            .xx..
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
    this.get_lab_appointment_list();
    // this.pay_appointment();
    this.get_doctor_appointment_list();
  },
  mounted() {},

  data() {
    return {
      t_to: "",
      t_from: "",

      spec_id:"",

      doc_spec: "",

      patient_id: "",
      lab_app_list: {},
      doc_app_list: {},
      selected_doc_app_list: {},
      spec_data: {},
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
    get_lab_appointment_list: function () {
      axios
        .get("/api/appointment/get_lab_appointment_for_reception")
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
        .get("/api/appointment/get_all_doc_appointment")
        .then((response) => {
          if (response.status == 200) {
            this.doc_app_list = response.data;
            this.selected_doc_app_list = response.data;
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
    get_doctor_appointment_list_by_selected_date: function () {
      const docs = this.doc_app_list;

      const to = new Date(this.t_to).getTime();
      const from = new Date(this.t_from).getTime();

      const filtered_docs = docs.filter((doc) => {
        const date = new Date(doc.schedule.startDate).getTime();

        if (date <= to && date >= from) {
          console.log(true);
          return true;
        }
        return false;
      });

      if (filtered_docs.length === 0) {
        // console.log("no records!");
        swal.fire("No Records Found on this range");
      }

      this.selected_doc_app_list = filtered_docs;
    },

    get_doctor_appointment_list_by_selected_speciality: function () {
      const docs = this.doc_app_list;

      const spec = this.doc_spec;

      const filtered_app_list = docs.filter((doc) => {
        const spec = doc.schedule.employee.doctor.speciality.name;

        if (spec == this.spec_id) {
          return true;
        }
      });

      this.selected_doc_app_list = filtered_app_list;
    },

    print: function () {
      this.$htmlToPaper("printme");
    },
  },
};
</script>

<style>
</style>
