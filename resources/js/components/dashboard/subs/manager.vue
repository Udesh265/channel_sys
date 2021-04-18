<template>
  <div>
    <div class="row">
      <div class="col-12 col-sm-6 col-xl-4 mt-3">
        <div class="card">
          <div class="card-body text-info border-bottom border-info border-w-5">
            <h2 class="text-center">{{ total_doc_appointment }}</h2>
            <h6 class="text-center">Total Doctors Appointments</h6>
          </div>
        </div>
      </div>
      <div class="col-12 col-sm-6 col-xl-4 mt-3">
        <div class="card">
          <div
            class="card-body text-success border-bottom border-success border-w-5"
          >
            <h2 class="text-center">{{ total_lab_appointment }}</h2>
            <h6 class="text-center">Total Lab Appointments</h6>
          </div>
        </div>
      </div>
      <div class="col-12 col-sm-6 col-xl-4 mt-3">
        <div class="card">
          <div
            class="card-body text-danger border-bottom border-danger border-w-5"
          >
            <h2 class="text-center">{{ total_services_count }}</h2>
            <h6 class="text-center">Waiting Appointments (LKR)</h6>
          </div>
        </div>
      </div>
    </div>
    <div class="row mt-3">
      <div class="col-8">
        <div id="chart">
          <apexchart
            type="line"
            height="350"
            :options="chartOptions"
            :series="series"
          ></apexchart>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["user_id"],
  created() {
    this.get_total_doc_appointment();
    this.get_total_lab_appointment();
    this.get_total_services();
    this.get_payment_data_for_chart();
    // console.log(payment_data);
    // console.log();
  },

  mounted() {
    // this.get_total_appointment_amount();
    // console.log(this.payment_data);
  },
  data() {
    return {
      series: [
        {
          name: "Desktops",
          data: [],
        },
      ],
      chartOptions: {
        chart: {
          height: 350,
          type: "line",
          zoom: {
            enabled: false,
          },
        },
        dataLabels: {
          enabled: false,
        },
        stroke: {
          curve: "straight",
        },
        title: {
          text: "Total Payments Trend",
          align: "left",
        },
        grid: {
          row: {
            colors: ["#f3f3f3", "transparent"], // takes an array which will be repeated on columns
            opacity: 0.5,
          },
        },
        xaxis: {
          categories: [],
        },
      },

      total_doc_appointment: "",
      total_lab_appointment: "",
      total_services_count: "",
      payment_data: {},
    };
  },
  methods: {
    updateTheme(e) {
      this.chartOptions = {
        theme: {
          palette: "palette2",
        },
      };
    },
    get_total_doc_appointment: function () {
      axios
        .get("/api/appointment/total_doc_app")
        .then((response) => {
          if (response) {
            this.total_doc_appointment = response.data;
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },

    get_total_lab_appointment: function () {
      axios
        .get("/api/appointment/total_lab_app")
        .then((response) => {
          if (response) {
            this.total_lab_appointment = response.data;
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },

    get_total_services: function () {
      axios
        .get("/api/appointment/total_services_count")
        .then((response) => {
          if (response) {
            this.total_services_count = response.data;
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },

    get_payment_data_for_chart: function () {
        const months = ["January", "February", "March", "April", "May","June","July", "August", "September", "October", "November","December"];
      axios
        .get("/api/get_all_payment_data")
        .then((response) => {
          if (response) {
            this.payment_data = response.data;
            const paymentData = response.data;
            const monthPay = {};
            paymentData.forEach(p => {
                const numericMonth = new Date(p.created_at).getMonth();
                const month = months[numericMonth];
                if (monthPay[month] === undefined) {
                    monthPay[month] = p.amount
                } else {
                    monthPay[month] += p.amount
                }
            });
            console.log(Object.keys(monthPay));
            this.chartOptions = {
              ...this.chartOptions,
              ...{
                xaxis: {
                  categories: Object.keys(monthPay),
                },
              },
            };
            this.series = [
              {
                name: "Amount",
                data: Object.values(monthPay),
              },
            ];
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },

    get_patient_by_user_id: function () {
      axios
        .get("/api/appointment/get_patient_by_userID/" + this.user_id)
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

    get_appointment_list: function () {
      axios
        .get("/api/appointment/get_appointment_list/" + this.vform.p_id)
        .then((response) => {
          if (response.status == 200) {
            this.appointment_list = response.data;
            // let new_date = moment(this.appointment_list.).format("LL");
            // this.display_doctor_appointment_date = new_date;
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
    delete_app: function (id) {
      swal
        .fire({
          title: "Are you sure?",
          text: "You won't be able to revert this!",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Yes, Delete it!",
        })
        .then((result) => {
          if (result.isConfirmed) {
            axios
              .patch("/api/appointment/del/" + id)
              .then((response) => {
                if (response.status == 200) {
                  this.get_appointment_list();
                }
              })
              .catch((error) => {
                console.log(error);
              });
          }
        });
    },

    del_lab_app: function (id) {
      swal
        .fire({
          title: "Are you sure?",
          text: "You won't be able to revert this!",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Yes, Delete it!",
        })
        .then((result) => {
          if (result.isConfirmed) {
            axios
              .patch("/api/appointment/del_lab_app/" + id)
              .then((response) => {
                if (response.status == 200) {
                  this.get_lab_appointments();
                }
              })
              .catch((error) => {
                console.log(error);
              });
          }
        });
    },

    modal_appointment_view: function (app) {
      $("#modal_app_view").modal("show");
      this.selected_appointment = app;
    },
    modal_lab_app_view: function (app) {
      $("#modal_lab_app").modal("show");
      this.selected_lab_appointment_data = app;
    },

    get_lab_appointments: function () {
      axios
        .get("/api/lab/get_lab_appointment/" + this.user_id)
        .then((response) => {
          if (response.status == 200) {
            this.lab_app_list = response.data;
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


