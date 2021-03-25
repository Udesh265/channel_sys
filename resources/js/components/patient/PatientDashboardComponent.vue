<template>
  <div class="col-12">
    <div class="row">
      <div class="col-12 col-sm-6 col-xl-4 mt-3">
        <div class="card">
          <div class="card-body text-info border-bottom border-info border-w-5">
            <h2 class="text-center">{{ appointment_data }}</h2>
            <h6 class="text-center">Total Appointments</h6>
          </div>
        </div>
      </div>
      <div class="col-12 col-sm-6 col-xl-4 mt-3">
        <div class="card">
          <div
            class="card-body text-success border-bottom border-success border-w-5"
          >
            <h2 class="text-center">{{ total_app_amount | currency }}</h2>
            <h6 class="text-center">Total Paid Amount (LKR)</h6>
          </div>
        </div>
      </div>
      <div class="col-12 col-sm-6 col-xl-4 mt-3">
        <div class="card">
          <div
            class="card-body text-danger border-bottom border-danger border-w-5"
          >
            <h2 class="text-center">{{ panding_amount | currency }}</h2>
            <h6 class="text-center">Waiting Appointments (LKR)</h6>
          </div>
        </div>
      </div>
    </div>
    <div class="row mt-3">
      <div class="col-6">
        <div class="card shadow  bg-white" style="height: 180px">
          <img class="card-img-top" src="holder.js/100x180/" alt="" />
          <div class="card-body border-bottom border-success border-w-5"></div>
        </div>
      </div>
      <div class="col-6">
        <div class="card shadow  bg-white rounded" style="height: 180px">
          <img class="card-img-top" src="holder.js/100x180/" alt="" />
          <div class="card-body border-bottom border-success border-w-5"></div>
        </div>
      </div>
    </div>
    <div class="row mt-3">
      <div class="col-12">
        <div class="card shadow bg-white rounded" style="height: 180px">
          <img class="card-img-top" src="holder.js/100x180/" alt="" />
          <div class="card-body"></div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  props: ["user_id"],
  created() {
    this.get_total_appointment();
    this.get_patient_by_user_id();
  },

  mounted() {
    // this.get_total_appointment_amount();
  },
  data() {
    return {
      appointment_data: {},
      total_app_amount: {},
      panding_amount: {},

      vform: new Form({
        p_id: "",
        app_id: "",
      }),
    };
  },
  methods: {
    get_total_appointment: function () {
      axios
        .get("/api/appointment/get_app_by_userID/" + this.user_id)
        .then((response) => {
          if (response) {
            this.appointment_data = response.data;
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },

    get_patient_by_user_id: function () {
      axios
        .get("/api/appointment/get_patient/" + this.user_id)
        .then((response) => {
          if (response.status == 200) {
            this.patient_data = response.data;
            this.vform.p_id = this.patient_data.id;

            this.get_total_appointment_amount();
            this.get_pending_payment();
            this.get_appointment_list();
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },

    get_total_appointment_amount: function () {
      axios
        .get("/api/appointment/get_tot_amount/" + this.vform.p_id)
        .then((response) => {
          if (response.status == 200) {
            this.total_app_amount = response.data;
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
    get_pending_payment: function () {
      axios
        .get("/api/appointment/get_pending_pay/" + this.vform.p_id)
        .then((response) => {
          if (response.status == 200) {
            this.panding_amount = response.data;
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
};
</script>

<style>
</style>
