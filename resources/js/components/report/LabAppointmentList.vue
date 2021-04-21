<template>
  <div>
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
                    this.t_from_lab != '' && this.t_to_lab != '' && this.report_type != ''
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
                    this.t_from_lab != '' && this.t_to_lab != '' && this.report_type != ''
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
                  <th>Payment status</th>
                  <th>Report in Stage</th>
                  <th>Pay Method</th>
                  <th>Date</th>
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
                  <td>{{ data.payment.payment_status }}</td>
                  <td>{{ data.status }}</td>
                  <td>{{ data.payment.type }}</td>
                  <td>{{ data.date }}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <!-- End lab appointment  -->
  </div>
</template>

<script>
export default {
  created() {
    // this.get_spec();
    this.get_lab_appointment_list();
    this.get_report_type();
    // this.pay_appointment();
  },
  mounted() {},

  data() {
    return {
      t_to_lab: "",
      t_from_lab: "",
      report_type: "",

      report_type_data: {},

      view_all_lab_list: {},

      selected_lab_app_list: {},
    };
  },
  methods: {
    get_report_type: function () {
      axios
        .get("/api/lab/get_report_type")
        .then((response) => {
          if (response.status == 200) {
            this.report_type_data = response.data;
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
          }
        })
        .catch((error) => {
          console.log(error);
        });
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

    print: function () {
      this.$htmlToPaper("printme");
    },
  },
};
</script>

<style>
</style>
