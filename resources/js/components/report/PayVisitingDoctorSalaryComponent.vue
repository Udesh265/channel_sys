<template>
  <div>
    <div class="row">
      <div class="col-12">
        <div class="card">
          <img class="card-img-top" src="holder.js/100x180/" alt="" />
          <div class="card-body">
            <div class="row">
              <div class="col-9">
                <input
                  type="text"
                  class="form-control"
                  placeholder="Enter Barcode ID or NIC or Mobile Number"
                  v-model="search_value"
                  @keypress="get_doctor_salary()"
                />
              </div>
              <div class="col-3">
                <button
                  @click="get_doctor_salary"
                  type="button"
                  class="form-control btn btn-success"
                >
                  Search Doctor
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div v-if="this.search_value != ''">
        <div>
      <div class="row mt-2">
        <div class="col-12">
          <div class="card">
            <img class="card-img-top" src="holder.js/100x180/" alt="" />
            <div class="card-body">
              <div class="form-group row mt-2">
                <div class="col-sm-4 col-lg-4 col-md-4">
                  <label for="form-control"><h6>Doctor Name:</h6> </label>
                  <label for="form-control"
                    ><h6 style="color:red">{{ doc_name }}</h6>
                  </label>
                </div>
                <div class="col-sm-3 col-lg-3 col-md-3">
                  <label for="form-control"><h6>Appointments:</h6></label>
                  <label for="form-control"
                    ><h6 style="color:red">{{ appointment_count }}</h6></label
                  >
                </div>
                <div class="col-sm-2 col-lg-2 col-md-2">
                  <label for="form-control"><h6>Date:</h6></label>
                  <label for="form-control">{{ display_date }}</label>
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
            <div class="card-body"  id="printme">
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
                    <td scope="row">Charge Per Patient</td>
                    <td>{{ doctor_fee }}</td>
                    <td></td>
                  </tr>
                  <tr>
                    <td scope="row">Channeling Charge</td>
                    <td>{{ channel_charge }}</td>
                    <td></td>
                  </tr>
                  <tr>
                    <td scope="row">Total Appointments balance</td>
                    <td>{{ total_appointment_amount }}</td>
                    <td></td>
                  </tr>
                  <tr>
                    <td scope="row">Total Channeling Charges</td>
                    <td></td>
                    <td class="text-danger"> - {{ total_channling_charge }}</td>
                  </tr>
                  <tr>
                    <td scope="row"><h6>Net Salary</h6></td>
                    <td ><h5>{{ net_salary }}.LKR</h5></td>
                    <td></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
        </div>
      <div class="row mt-1">
        <div class="col-9"></div>
        <div class="col-3">
          <button
            @click="pay_salary"
            type="button"
            class="form-control btn btn-success"
          >
            Pay & Print Pay Sheet
          </button>
        </div>
      </div>
    </div>

    <!-- Start printed paysheet for doctor  -->
    <div
      class="modal fade"
      id="pay_sal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="modelTitleId"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header" style="background-color: #1e3d73">
            <h5 class="modal-title" style="color: white">
              Payment For Doctor Salary
            </h5>
          </div>
          <div class="modal-body">
            <div class="form-group mt-2">
              <label for=""><h5>Total Payment :</h5></label>
              <label for=""
                ><h5>{{ net_salary }} LKR</h5></label
              >
            </div>

          </div>
          <div class="modal-footer">
            <button @click="pay_bill()" type="button" class="btn btn-primary">
              Pay & Print Bill
            </button>
          </div>
        </div>
      </div>
    </div>
    <!-- End doc pay sheet modal  -->
  </div>
</template>

<script>
export default {
  computed: {
    total_appointment_amount() {
      return parseInt(this.appointment_count) * parseInt(this.doctor_fee);
    },
    total_channling_charge() {
      return parseInt(this.appointment_count) * parseInt(this.channel_charge);
    },
    net_salary() {
      return (
        parseInt(this.total_appointment_amount) -
        parseInt(this.total_channling_charge)
      );
    },
  },

  created() {},
  mounted() {},
  data() {
    return {
      search_value: "",
      doctor_fee: "",
      channel_charge: "",
      appointment_count: "",
      //   total_appointment_amount:"",
      //   total_channling_charge:"",

      doc_name: "",

      doctor_data: "",
      channel_charge_data: "",

      display_date: new Date(),

      form: new Form({
        doc_salary: "",
        emp_id: "",
      }),
    };
  },
  methods: {
    get_doctor_salary: function () {
      axios
        .get("/api/reports/get_doc_salary/" + this.search_value)
        .then((response) => {
          if (response.status == 200) {
            this.doctor_data = response.data;
            this.doctor_fee = this.doctor_data.charge_pp;
            this.get_channeling_charge();
            this.get_doc_app_count();
            this.get_doc_data();
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },

    get_channeling_charge: function () {
      axios
        .get("/api/reports/get_channel_charge")
        .then((response) => {
          if (response.status == 200) {
            this.channel_charge_data = response.data;
            this.channel_charge = this.channel_charge_data.charge_amount;
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
    get_doc_app_count: function () {
      axios
        .get("/api/reports/get_doc_app_count/" + this.search_value)
        .then((response) => {
          if (response.status == 200) {
            this.appointment_count = response.data;
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
    get_doc_data: function () {
      axios
        .get("/api/reports/get_doc_data/" + this.search_value)
        .then((response) => {
          if (response.status == 200) {
            this.doc_name = response.data;
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
    pay_salary: function () {
      $("#pay_sal").modal("show");
    },
    pay_bill: function () {

        this.form.doc_salary = this.net_salary;
        this.form.emp_id = this.doctor_data.employee_id;
      this.form.post("/api/reports/save_salary" )
        .then((response) => {
          if (response.status == 200) {
            swal.fire(response.data.msg);
            $("#pay_sal").modal("hide");
            this.$htmlToPaper("printme");
            this.form.reset();
            this.search_value = '';

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
