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
                      v-model="t_to"
                      class="form-control"
                      type="date"
                      name=""
                      id=""
                    />
                  </div>
                  <div class="col-3">
                    Doctor Speciality :
                    <select v-model="spec_id" class="form-control">
                      <option
                        v-for="(spec, index) in spec_data"
                        :key="index"
                        :value="spec.name"
                      >
                        {{ spec.name }}
                      </option>
                    </select>
                  </div>
                  <div class="col-2">
                    .
                    <button
                      v-if="
                        this.t_from != '' &&
                        this.t_to != '' &&
                        this.spec_id != ''
                      "
                      @click="get_doctor_appointment_list_by_selected_date"
                      class="form-control btn btn-success"
                      type="date"
                      name=""
                      id=""
                    >
                      Filter
                    </button>
                  </div>
                  <div class="col-1">
                    .
                    <button
                      v-if="
                        this.t_from != '' &&
                        this.t_to != '' &&
                        this.spec_id != ''
                      "
                      @click="get_doctor_appointment_list"
                      class="form-control btn btn-danger"
                      type="date"
                      name=""
                      id=""
                    >
                      reset
                    </button>
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
                              class="fa fa-trash text-danger icon-button mx-1"
                              @click="delete_app(app.id)"
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
                    <div class="row">
                      <div class="col-3">
                        From :
                        <input
                          v-model="t_from_lab"
                          class="form-control"
                          type="date"
                          name=""
                          id=""
                        />
                      </div>
                      <div class="col-3">
                        To :
                        <input
                          v-model="t_to_lab"
                          class="form-control"
                          type="date"
                          name=""
                          id=""
                        />
                      </div>
                      <div class="col-3">
                        Report Type :
                        <select class="form-control" v-model="report_type">
                          <option
                            v-for="(type, index) in report_type_data"
                            :key="index"
                            :value="type.id"
                          >
                            {{ type.report_type }}
                          </option>
                        </select>
                      </div>
                      <div class="col-2">
                        .
                        <button
                          v-if="
                            this.t_from_lab != '' &&
                            this.t_to_lab != '' &&
                            this.report_type != ''
                          "
                          @click="get_lab_appointment_list_by_selected_date"
                          class="form-control btn btn-success"
                          type="date"
                          name=""
                          id=""
                        >
                          Filter
                        </button>
                      </div>
                      <div class="col-1">
                        .
                        <button
                          v-if="
                            this.t_from_lab != '' &&
                            this.t_to_lab != '' &&
                            this.report_type != ''
                          "
                          @click="get_lab_appointment_list"
                          class="form-control btn btn-danger"
                          type="date"
                          name=""
                          id=""
                        >
                          reset
                        </button>
                      </div>
                    </div>
                    <table class="table mt-2">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Report Type</th>
                          <th>Patient Name</th>
                          <th>Amount</th>
                          <th>Date</th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr
                          class="zoom"
                          v-for="(data, index) in selected_lab_app_list"
                          :key="index"
                        >
                          <td scope="row">{{ data.id }}</td>
                          <td class="text-danger">
                            {{ data.report_type.report_type }}
                          </td>
                          <td class="text-success">{{ data.patient.name }}</td>
                          <td>{{ data.payment.amount }}</td>
                          <td class="text-danger">{{ data.date }}</td>
                          <td>{{ data.payment.payment_status }}</td>
                          <td class="text-danger">
                            <i
                              @click="load_payment_modal(data)"
                              class="fa fa-trash text-danger icon-button mx-1"
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
    this.get_report_type();
    // this.pay_appointment();
    this.get_doctor_appointment_list();
  },
  mounted() {},

  data() {
    return {
      t_to: "",
      t_from: "",

      t_to_lab:"",
      t_from_lab:"",

      spec_id: "",
      report_type: "",

      doc_spec: "",

      patient_id: "",
      view_all_lab_list: {},
      doc_app_list: {},
      selected_doc_app_list: {},
      selected_lab_app_list:{},
      spec_data: {},
      report_type_data:{},
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
        .get("/api/lab/get_all_lab_appointment")
        .then((response) => {
          if (response.status == 200) {
            this.view_all_lab_list = response.data;
            this.selected_lab_app_list = response.data;
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
      const spec = this.doc_spec;

      const to = new Date(this.t_to).getTime();
      const from = new Date(this.t_from).getTime();

      const filtered_docs = docs.filter((doc) => {
        const date = new Date(doc.schedule.startDate).getTime();
        const spec = doc.schedule.employee.doctor.speciality.name;

        if (date <= to && date >= from) {
          console.log(true);
          //   return true;
          if (spec == this.spec_id) {
            return true;
          }
        }
        return false;
      });

      if (filtered_docs.length === 0) {
        // console.log("no records!");
        swal.fire("No Records Found on this range");
      }

      this.selected_doc_app_list = filtered_docs;
    },
    get_lab_appointment_list_by_selected_date: function () {
      const lists = this.view_all_lab_list;
      const report_type = this.report_type;

      const to = new Date(this.t_to_lab).getTime();
      const from = new Date(this.t_from_lab).getTime();

      const filtered_list = lists.filter((list) => {
        const date = new Date(list.date).getTime();
        const report_type = list.report_type.id;

        if (date <= to && date >= from) {
          console.log(true);
          //   return true;
          if (report_type == this.report_type) {
              console.log(true);
            return true;
          }
        }
        return false;
      });

      if (filtered_list.length === 0) {
        // console.log("no records!");
        swal.fire("No Records Found on this range");
      }

      this.selected_lab_app_list = filtered_list;
    },

    delete_app: function (id) {
      swal
        .fire({
          title: "Are you sure?You want yo Cancel Appointment?",
          text: "You won't be able to revert this!",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Yes, Cancel it!",
        })
        .then((result) => {
          if (result.isConfirmed) {
            axios
              .patch("/api/appointment/del/" + id)
              .then((response) => {
                if (response.status == 200) {
                  this.get_doctor_appointment_list();
                }
              })
              .catch((error) => {
                console.log(error);
              });
          }
        });
    },
    get_report_type: function(){
        axios.get("/api/lab/get_report_type")
         .then((response) => {
          if (response.status == 200) {
            this.report_type_data = response.data;
          }
        })
        .catch((error) => {
          console.log(error);
        });

    },

    print: function () {
      this.$htmlToPaper("printme");
    },
  },
};
</script>

<style>
</style>
