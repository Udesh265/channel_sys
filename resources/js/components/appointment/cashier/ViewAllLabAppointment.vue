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
                          v-for="(data, index) in view_all_lab_list"
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

</template>

<script>
export default {
  created() {
    // this.get_spec();
    this.get_lab_appointment_list();
    // this.pay_appointment();
  },
  mounted() {},

  data() {
    return {
      t_to: "",
      t_from: "",

      spec_id: "",

      doc_spec: "",

      patient_id: "",
      view_all_lab_list: {},
      doc_app_list: {},
      selected_doc_app_list: {},
      spec_data: {},
    };
  },
  methods: {

    get_lab_appointment_list: function () {
      axios
        .get("/api/lab/get_all_lab_appointment")
        .then((response) => {
          if (response.status == 200) {
            this.view_all_lab_list = response.data;
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
}
</script>

<style>

</style>
