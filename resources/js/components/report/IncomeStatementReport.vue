<template>
  <div>
    <div class="row">
      <div class="col-12">
        <div class="card">
          <img class="card-img-top" src="holder.js/100x180/" alt="" />
          <div class="card-body">
            <div class="form-group row mt-2">
              <div class="col-3">
                From :
                <input
                  v-model="form.t_from"
                  class="form-control"
                  type="date"
                  name=""
                  id=""
                />
              </div>
              <div class="col-3">
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
                  v-if="this.form.t_from != '' && this.form.t_to != ''"
                  @click="get_doc_appointment_amount"
                  class="form-control btn btn-success"
                  type="date"
                  name=""
                  id=""
                >
                  Genarate Report
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row mt-2">
      <div class="col-12">
        <div class="card">
          <img class="card-img-top" src="holder.js/100x180/" alt="" />
          <div class="card-body" id="printme">
              <div class="row mb-2">
                  <div class="col-4"><h5>Income Statement Report</h5>
                  </div>
              </div>
            <table class="table">
              <thead>
                <tr>
                  <th style="width: 70%">Description</th>
                  <th>Amount</th>
                  <th>Deduction</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td scope="row">Total Appointment Income</td>
                  <td>{{ doc_appointment_amount | currency }}</td>
                  <td></td>
                </tr>
                <tr>
                  <td scope="row">Total Services Income</td>
                  <td>{{ service_amount | currency }}</td>
                  <td></td>
                </tr>
                <tr>
                  <td scope="row">Total Net Income</td>
                  <td>
                     {{ total_net_income | currency }}
                  </td>
                  <td></td>
                </tr>
                <tr>
                  <td scope="row">Total Doctors Salary Payments</td>
                  <td></td>
                  <td class="text-danger">
                    - {{ doctors_salary_amount | currency }}
                  </td>
                </tr>
                <tr>
                  <td scope="row"><h6>Net Profit</h6></td>
                  <td>
                    <h5>{{ net_profit | currency }}.LKR</h5>
                  </td>
                  <td></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

                  <button
                  v-if="this.form.t_from != '' && this.form.t_to != ''"
                  @click="print()"
                  class="form-control btn btn-success mt-2"
                  type="date"
                  name=""
                  id=""
                >
                  Print Report
                </button>

      </div>
    </div>
  </div>
</template>

<script>
export default {
    computed:{

        total_net_income(){
            return parseInt(this.doc_appointment_amount) + parseInt(this.service_amount);
        },
        net_profit(){
            return parseInt(this.total_net_income) - parseInt(this.doctors_salary_amount);
        },

    },
  created() {
    //   this.get_doc_appointment_amount();
    //  this.get_service_amount();
  },
  mounted() {
    //   this.get_service_amount();
  },
  data() {
    return {
      form: new Form({
        t_from: "",
        t_to: "",
      }),
      doc_appointment_amount: "",
      service_amount: "",
      doctors_salary_amount: "",
    };
  },
  methods: {
    get_doc_appointment_amount: function () {
      // this.get_service_amount();
      this.form
        .post("/api/reports/get_doc_appointment_amount")
        .then((response) => {
          if (response.status == 200) {
            this.doc_appointment_amount = response.data;
            this.get_service_amount();
            this.get_doctors_salary_amount();
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
    get_service_amount: function () {
      this.form
        .post("/api/reports/get_service_amount")
        .then((response) => {
          if (response.status == 200) {
            this.service_amount = response.data;
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
    get_doctors_salary_amount: function () {
      this.form
        .post("/api/reports/get_doctors_salary_amount")
        .then((response) => {
          if (response.status == 200) {
            this.doctors_salary_amount = response.data;
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },


    print:function(){
        this.$htmlToPaper("printme");
    }
  },
};
</script>

<style>
</style>
