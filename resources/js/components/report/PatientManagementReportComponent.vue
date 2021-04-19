<template>
  <div>
    <div class="row">
      <div class="col-12 col-sm-6 col-xl-4 mt-3">
        <div class="card">
          <div class="card-body text-info border-bottom border-info border-w-5">
            <h2 class="text-center">{{ today_new_patients }}</h2>
            <h6 class="text-center">Todays New Patients</h6>
          </div>
        </div>
      </div>
      <div class="col-12 col-sm-6 col-xl-4 mt-3">
        <div class="card">
          <div
            class="card-body text-success border-bottom border-success border-w-5"
          >
            <h2 class="text-center">{{ monthly_new_patients_count }}</h2>
            <h6 class="text-center">Monthly New Patients</h6>
          </div>
        </div>
      </div>
      <div class="col-12 col-sm-6 col-xl-4 mt-3">
        <div class="card">
          <div
            class="card-body text-danger border-bottom border-danger border-w-5"
          >
            <h2 class="text-center">{{ online_patients_count }}</h2>
            <h6 class="text-center">Total Online Registration</h6>
          </div>
        </div>
      </div>
    </div>

    <div class="row mt-2">
      <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="card">
          <div
            class="card-header d-flex justify-content-between align-items-center"
          >
            <h4 class="card-title">Top Payments Patient List</h4>
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
                Type :
                <select v-model="form.type" class="form-control">
                  <option value="Online">Online Patient</option>
                  <option value="On-Visit">On-visit Patient</option>
                </select>
              </div>
              <div class="col-2">
                Status :
                <select v-model="form.status" class="form-control">
                  <option value="Confirm">Confirm Payments</option>
                  <option value="Pending">Pending Payments</option>
                </select>
              </div>
              <div class="col-2">
                OrderBy :
                <select v-model="form.orderBy" class="form-control">
                  <option value="desc">Desecnding</option>
                  <option value="asc">Asecnding</option>
                </select>
              </div>
              <div class="col-1">
                .
                <button
                  v-if="this.form.t_from != '' && this.form.t_to != '' && this.form.type != '' && this.status != '' && this.form.orderBy != '' "
                  @click="get_top_paid_patient_list"
                  class="form-control btn btn-success"
                  name=""
                  id=""
                >
                  Filter
                </button>
              </div>
              <div class="col-1">
                .
                <button
                 v-if="this.form.t_from != '' && this.form.t_to != '' && this.form.type != '' && this.status != '' && this.form.orderBy != '' "
                  @click="reset_patient()"
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
                  <th>#</th>
                  <th>Name</th>
                  <th>Mobile</th>
                  <th>Patient Type</th>
                  <th>Pay Type</th>
                  <th>Date</th>
                  <th>Amount</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(emp, index) in top_paid_patient_list" :key="index">
                  <td scope="row">{{ emp.id }}</td>
                  <td>{{ emp.patient.name }}</td>
                  <td>{{ emp.patient.mobile }}</td>
                  <td>{{ emp.patient.p_type }}</td>
                  <td>{{ emp.type }}</td>
                  <td>{{ emp.created_at | myDate }}</td>
                  <td>{{ emp.amount | currency }}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  created() {
    this.get_today_new_patients_count();
    this.get_monthly_new_patients_count();
    this.get_online_patients_count();
  },
  mounted() {},
  data() {
    return {
      today_new_patients: "",
      monthly_new_patients_count: "",
      online_patients_count: "",
      top_paid_patient_list:{},

      form: new Form({
        t_from: "",
        t_to: "",
        type: "",
        status: "",
        orderBy: "",
      }),
    };
  },
  methods: {
    get_today_new_patients_count: function () {
      axios
        .get("/api/reports/get_today_new_patients_count")
        .then((response) => {
          if (response.status) {
            this.today_new_patients = response.data;
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },

    get_monthly_new_patients_count: function () {
      axios
        .get("/api/reports/get_monthly_new_patients_count")
        .then((response) => {
          if (response.status) {
            this.monthly_new_patients_count = response.data;
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
    get_online_patients_count: function () {
      axios
        .get("/api/reports/get_online_patients_count")
        .then((response) => {
          if (response.status) {
            this.online_patients_count = response.data;
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
    get_top_paid_patient_list: function(){
        this.form.post("/api/reports/get_top_paid_patient_list")
         .then((response) => {
          if (response.status) {
            this.top_paid_patient_list = response.data;
          }
        })
        .catch((error) => {
          console.log(error);
        });

    },
    reset_patient: function(){
        this.form.reset();
    }

  },
};
</script>

<style>
</style>
