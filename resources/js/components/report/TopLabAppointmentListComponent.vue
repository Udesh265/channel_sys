<template>
  <div>
    <div class="row mt-2">
      <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="card">
          <div
            class="card-header d-flex justify-content-between align-items-center"
          >
            <h4 class="card-title">Top Lab Appointments List Given Date Range</h4>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-2">
                From :
                <input
                  v-model="form.t_from"
                  class="form-control"
                  type="date"
                  name=""
                  id=""
                />
              </div>
              <div class="col-2">
                To :
                <input
                  v-model="form.t_to"
                  class="form-control"
                  type="date"
                  name=""
                  id=""
                />
              </div>

              <div class="col-2">
                .
                <button
                  v-if="
                    this.form.t_from != '' &&
                    this.form.t_to != ''
                  "
                  @click="get_top_lab_report_list"
                  class="form-control btn btn-success"
                  name=""
                  id=""
                >
                  Filter
                </button>
              </div>
            </div>
            <div id="printme">
            <table class="table mt-2">
              <thead>
                <tr>
                  <th>Report Name</th>
                  <th>Report Fee</th>
                  <th># Appointments Count</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(app, index) in top_lab_report_list" :key="index" :class="{'color-row-highlight' : index == 0}">
                  <td>{{ app.report_type }}</td>
                  <td>{{ app.fee }}</td>
                  <td>{{ app.lab_appointment_count }}</td>
                </tr>
              </tbody>
            </table>
            </div>
          </div>
          <button @click="print()">print report</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  created() {
    //   this.get_top_service_list();
  },
  mounted() {},
  data() {
    return {
      form: new Form({
        t_from: "",
        t_to: "",
        type: "",
      }),
      top_lab_report_list:"",
    };
  },
  methods: {
    get_top_lab_report_list: function () {
      this.form
        .post("/api/reports/get_top_lab_report_list")
        .then((response) => {
          if (response.status) {
            this.top_lab_report_list = response.data;
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
    print: function(){
        this.$htmlToPaper("printme");
    }
  },
};
</script>

<style>
.color-row-highlight{
    background-color: rgba(237, 0, 0, 0.803);
}
</style>
