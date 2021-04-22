<template>
    <div>
    <div class="row mt-2">
      <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="card">
          <div
            class="card-header d-flex justify-content-between align-items-center"
          >
            <h4 class="card-title">Top Service List Given Date Range</h4>
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
                Report Type :
                <select class="form-control" v-model="form.type">
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
                    this.form.t_from != '' &&
                    this.form.t_to != '' &&
                    this.type != ''
                  "
                  @click="get_service_list"
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
                  <th>#</th>
                  <th>Service Name</th>
                  <th>Service Fee</th>
                  <th>Date</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(app, index) in service_list" :key="index" :class="{'color-row-highlight' : index == 0}">
                  <td>{{ app.id }}</td>
                  <td>{{ app.service_name }}</td>
                  <td>{{ app.service_fee }}</td>
                  <td>{{ app.created_at | myDate }}</td>
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
    this.get_report_type();
  },
  mounted() {},
  data() {
    return {
      form: new Form({
        t_from: "",
        t_to: "",
        type: "",
      }),
      service_list:"",
      report_type_data:"",
    };
  },
  methods: {
    get_service_list: function () {
      this.form
        .post("/api/reports/get_service_list")
        .then((response) => {
          if (response.status) {
            this.service_list = response.data.service_list;
          }
        })
        .catch((error) => {
          console.log(error);
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
  print:function(){
    this.$htmlToPaper("printme");
  },
  },

}
</script>

<style>

</style>
