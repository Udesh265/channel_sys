<template>
  <div class="row mt-3">
    <div class="col-12">
      <div class="card shadow bg-white rounded">
        <div class="card-body">
          <div class="row mb-3">
            <div class="col-9">
              <h5>Laboraty Reports</h5>
            </div>
          </div>
          <table class="table">
            <thead>
              <tr>
                <th>ID</th>
                <th>Report Type</th>
                <th>Report Date</th>
                <th>Report</th>
              </tr>
            </thead>
            <tbody>
              <tr
                class="zoom"
                v-for="(data, index) in lab_report_data"
                :key="index"
              >
                <td scope="row">{{ data.id }}</td>
                <td class="text-info">
                  {{ data.report_type.report_type }}
                </td>
                <td class="text-danger">
                  {{ data.date }}
                </td>

                <td class="text-info">
                  <i
                    class="fa fa-file text-success icon-button mx-1"
                    @click="view_report_modal(data.documents)"
                  ></i>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
     <!-- View file modal  -->
    <!-- Modal -->
    <div
      class="modal fade"
      id="view_report"
      ref="view_report"
      tabindex="-1"
      role="dialog"
      aria-labelledby="modelTitleId"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Lab Report</h5>
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
            <div class="row">
              <div class="col-12">
                  <div id="print_this">

                  <img :src="report_file" alt="some_image" style="width:100%" />
                  </div>
              </div>
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
            <button @click="print()" type="button" class="btn btn-primary">Print Report</button>
          </div>
        </div>
      </div>
    </div>

    <!-- end view file modal  -->
  </div>

</template>

<script>
export default {
  props: ["user_id"],
  created() {
    this.get_patient_by_user_id();
  },
  mounted() {},
  data() {
    return {
      lab_report_data: {},
      patient_data: {},

      p_id: "",
      report_file:"",


    };
  },
  methods: {
    get_patient_by_user_id: function () {
      axios
        .get("/api/appointment/get_patient_by_userID/" + this.user_id)
        .then((response) => {
          if (response.status == 200) {
            this.patient_data = response.data;
            this.p_id = this.patient_data.id;
            this.get_lab_report_data();
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
    get_lab_report_data: function () {
      this.p_id = this.patient_data.id;
      axios
        .get("/api/patient/get_lab_report_data/" + this.p_id)
        .then((response) => {
          if (response.status == 200) {
            this.lab_report_data = response.data;
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
    view_report_modal: function (data) {
      $("#view_report").modal("show");
      this.report_file = data[0].path;
    },
  },
};
</script>

<style>
</style>
