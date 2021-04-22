<template>
  <div>
    <div class="row">
      <div class="col-12 col-sm-6 col-xl-4 mt-3">
        <div class="card">
          <div class="card-body text-info border-bottom border-info border-w-5">
            <h2 class="text-center">{{ today_new_appointment }}</h2>
            <h6 class="text-center">Todays Appointments</h6>
          </div>
        </div>
      </div>
      <div class="col-12 col-sm-6 col-xl-4 mt-3">
        <div class="card">
          <div
            class="card-body text-success border-bottom border-success border-w-5"
          >
            <h2 class="text-center">{{ total_online_appointment_count }}</h2>
            <h6 class="text-center">Total Online Appointments</h6>
          </div>
        </div>
      </div>
      <div class="col-12 col-sm-6 col-xl-4 mt-3">
        <div class="card">
          <div
            class="card-body text-danger border-bottom border-danger border-w-5"
          >
            <h2 class="text-center">{{total_onvisit_appointment_count}}</h2>
            <h6 class="text-center">Total On-visit Appointments</h6>
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
            <h4 class="card-title">Top Appointments Speciality List</h4>
          </div>
          <div id="printme" class="card-body">
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
                OrderBy :
                <select v-model="form.orderBy" class="form-control">
                  <option value="desc">Desecnding</option>
                  <option value="asc">Asecnding</option>
                </select>
              </div>
              <div class="col-1">
                .
                <button

                  @click="top_appointments_list"
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
                  v-if="
                    this.form.t_from != '' &&
                    this.form.t_to != '' &&
                    this.form.orderBy != ''
                  "
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
                  <th>Speciality Name</th>
                  <th>Appointment Quantity</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(app,index) in top_paid_appointments_list_sorted" :key="index">
                  <td>{{ app.speciality_id }}</td>
                  <td>{{ app.speciality_name }}</td>
                  <td>{{ app.appointment_count}}</td>
                </tr>
              </tbody>
            </table>

            <!-- <div v-for="(app,index) in top_paid_appointments_list_sorted" :key="index">

            <table class="table mt-2">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Speciality Name</th>
                  <th>Appointment Quantity</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>{{ app.speciality_id }}</td>
                  <td>{{ app.speciality_name }}</td>
                  <td>{{ app.appointment_count}}</td>
                </tr>
              </tbody>
            </table>
            <table class="table mt-2">
              <thead>
                <tr>
                  <th>Doctor Name</th>
                  <th>Appointment Quantity</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(doc,index) in app.doctors" :key="index">
                  <td>{{ doc.employee.first_name }}</td>
                  <td>{{ doc.appointments_count }}</td>
                </tr>
              </tbody>
            </table>
            </div> -->
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
    this.get_today_new_appointment_count();
    this.get_total_online_appointment_count();
    this.get_total_onvisit_appointment_count();

    // this.top_appointments_list();
  },
  mounted() {
    //   this.top_appointments_list();
  },
  data() {
    return {
      today_new_appointment: "",
      total_online_appointment_count: "",
      total_onvisit_appointment_count:"",

      top_paid_appointments_list: {},

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
    get_today_new_appointment_count: function () {
      axios
        .get("/api/reports/get_today_new_appointment_count")
        .then((response) => {
          if (response.status) {
            this.today_new_appointment = response.data;
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },

    get_total_online_appointment_count: function () {
      axios
        .get("/api/reports/total_online_appointment_count")
        .then((response) => {
          if (response.status) {
            this.total_online_appointment_count = response.data;
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
    get_total_onvisit_appointment_count: function () {
      axios
        .get("/api/reports/total_onvisit_appointment_count")
        .then((response) => {
          if (response.status) {
            this.total_onvisit_appointment_count = response.data;
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },


    top_appointments_list: function () {
      this.form.post("/api/reports/top_appointments_list")
        .then((response) => {
          if (response.status == 200) {
            this.top_paid_appointments_list = response.data;
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
  computed: {
      top_paid_appointments_list_sorted() {
          if(this.top_paid_appointments_list) {
            return  _.orderBy(this.top_paid_appointments_list, ['appointment_count'], [this.form.orderBy]);
          }

          return {};
      }
  }
};
</script>

<style>
</style>
