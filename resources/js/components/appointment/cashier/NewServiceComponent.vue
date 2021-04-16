<template>
  <div>
    <div class="row">
      <div class="col-12">
        <div class="card">
          <img class="card-img-top" src="holder.js/100x180/" alt="" />
          <div class="card-body">
            <div class="form-group row">
              <div class="col-sm-4 col-lg-4 col-md-4">
                <label for="form-control">Full Name:</label>
                <input
                  type="text"
                  placeholder="Enter Full name"
                  class="form-control"
                  required
                  :class="{ 'is-invalid': form.errors.has('name') }"
                  v-model="form.name"
                />
                <has-error :form="form" field="name"></has-error>
              </div>
              <div class="col-sm-3 col-lg-3 col-md-3">
                <label for="form-control">Mobile:</label>
                <input
                  required
                  type="text"
                  placeholder="077*******"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('mobile') }"
                  v-model="form.mobile"
                />
                <has-error :form="form" field="mobile"></has-error>
              </div>
              <div class="col-sm-3 col-lg-3 col-md-3">
                <label for="form-control">Email</label>
                <input
                  required
                  type="text"
                  placeholder="example@gmail.com"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('email') }"
                  v-model="form.email"
                />
                <has-error :form="form" field="email"></has-error>
              </div>
              <div class="col-sm-2 col-lg-2 col-md-2">
                <label for="form-control">Age:</label>
                <input
                  required
                  type="text"
                  placeholder="Ex: 65"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('age') }"
                  v-model="form.age"
                />
                <has-error :form="form" field="age"></has-error>
              </div>
            </div>
            <div class="row">
              <div class="col-6">
                <label for="">Select Service Type :</label>
                <select
                  @change="selected_service"
                  v-model="form.service_type"
                  class="form-control"
                >
                  <option
                    v-for="(service, index) in service_list"
                    :key="index"
                    :value="service.id"
                  >
                    {{ service.name }}
                  </option>
                </select>
              </div>

              <div class="col-4">
                <label for="">Service Fee :</label>
                <input
                  v-model="service_fee.fee"
                  class="form-control"
                  type="text"
                  name=""
                  id=""
                />
              </div>

              <div class="col-2">
                <label for="">.</label>
                <button
                  @click="add_service"
                  class="form-control btn btn-primary"
                >
                  Add
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row mt-1">
      <div class="col-12">
        <div class="card">
          <img class="card-img-top" src="holder.js/100x180/" alt="" />
          <div class="card-body">
            <table class="table">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Service Name</th>
                  <th>Amount</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <tr
                  v-for="(service, index) in form.selected_service_list"
                  :key="index"
                >
                  <td scope="row">{{ service.id }}</td>
                  <td scope="row">{{ service.name }}</td>
                  <td scope="row">{{ service.fee }}</td>
                  <td scope="row">
                    <i
                      @click="delete_row(service)"
                      class="fa fa-trash text-danger icon-button mx-1"
                    ></i>
                  </td>
                </tr>
              </tbody>
            </table>
            <div class="row">
              <div class="col-6"></div>
              <div class="col-6">
                <label for="form-control"
                  ><h5>Total : {{ total }}</h5>
                </label>
              </div>
            </div>

            <button
              class="form-control btn btn-success"
              @click="submit_service"
            >
              Pay Bill
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-- Start printed bill for lab appointment  -->
    <div
      class="modal fade"
      id="payment"
      tabindex="-1"
      role="dialog"
      aria-labelledby="modelTitleId"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header" style="background-color: #1e3d73">
            <h5 class="modal-title" style="color: white">
              Payment For Doctor Appointment
            </h5>
          </div>
          <div class="modal-body">
            <div class="form-group mt-2">
              <label for=""><h5>Total Service Fee :</h5></label>
              <label for=""
                ><h5>{{ total }} LKR</h5></label
              >
            </div>
            <div class="form-group">
              <label for=""><h6>Balance</h6></label>
              <input
                type="text"
                class="form-control"
                disabled
                v-model="balance"
              />
            </div>
            <div class="form-group">
              <label for=""><h6>Paid Amount</h6></label>
              <input
                type="text"
                v-model="billform.paid_amount"
                class="form-control"
                placeholder=""
                aria-describedby="helpId"
              />
            </div>
          </div>
          <div class="modal-footer">
            <button
              v-if="billform.paid_amount >= total"
              @click="pay_bill()"
              type="button"
              class="btn btn-primary"
            >
              Pay & Print Bill
            </button>
          </div>
        </div>
      </div>
    </div>
    <!-- End doc pay appointment modal  -->

    <!-- Show Bill Modal -->
    <div
      id="printme"
      class="modal"
      tabindex="-1"
      role="dialog"
      aria-hidden="true"
    >
      <div id="invoice-POS">
        <!-- <p style="margin-left: 85px; margin-top:0px;">බිල්පත</p> -->
        <p style="margin-left: 15px; font-size: 14px">
          --- Nawamini Channelling Centre ----
          <br />New Town, Digana, Rajawella <br />Tel: 0552268036/0719362359
        </p>
        ---------------------------------------------
        <div>
          <label style="font-size: 12px">ID:</label>
          <label style="font-size: 12px">{{ payment_id }}</label>
          <label style="font-size: 12px; margin-left: 20px">Date :</label>
          <label style="font-size: 12px">{{          }}</label>
        </div>

        <table style="width: 250px">
          <tr>
            <th style="text-align: left; font-size: 12px">#</th>
            <th style="text-align: left; font-size: 12px">Description</th>
            <th style="text-align: left; font-size: 12px">Fee</th>
          </tr>
          <tr v-for="(list,index) in form.selected_service_list" :key="index">
            <td style="text-align: left; font-size: 10px">
              {{ list.id }}
            </td>
            <td
              style="text-align: left; font-size: 10px"
            >
              {{ list.name }}
            </td>
            <td
              style="text-align: left; font-size: 10px"
            >
              {{ list.fee }}
            </td>
          </tr>
        </table>

        <label style="font-size: 12px">Paid Amount:</label>
        <label style="font-size: 12px; margin-left: 10px"
          >Rs: {{ billform.paid_amount }}</label
        >
        <br />
        <label style="font-size: 12px">Balance:</label>
        <label style="font-size: 12px; margin-left: 10px"
          >Rs: {{ balance }}</label
        >
        <br />

        <label style="font-size: 12px">Total :</label>
        <label
          style="font-size: 12px; margin-left: 5px"
          >Rs: {{ total }}</label
        >
        <br />

        <br />---------------------------------------------
        <br />
        <div style="margin-left: 55px; font-size: 12px">Thank You,Welcome!</div>

        <p style="font-size: 10px; margin-left: 15px">
          Software Developed by Udesh / For BIT Project
        </p>
      </div>
    </div>
    <!--  End Modal -->
  </div>
</template>

<script>
export default {
  props: ["user_id"],
  computed: {
    service_fee() {
      if (this.form.service_type) {
        const service = _.find(this.service_list, {
          id: this.form.service_type,
        });
        this.selected_service = service;
        return service;
      }

      return { fee: null };
    },

    total() {
      var sum = 0;
      this.form.selected_service_list.forEach((item) => {
        sum += item.fee;
      });
      return sum;
    },
    balance() {
      return parseInt(this.billform.paid_amount) - parseInt(this.total);
    },
  },
  created() {
    this.get_service_list();
  },
  mounted() {},
  data() {
    return {
      form: new Form({
        name: "",
        mobile: "",
        email: "",
        age: "",
        service_type: "",
        selected_service_list: [],
        user_id: this.user_id,
      }),
      billform: new Form({
        balance: "",
        paid_amount: "",
      }),

      payment_id: "",
      selected_service: {},
      // [{service_type: "eco_test", fee: 1999,}]
      service_list: {},
    };
  },

  methods: {
    add_service: function () {
      if (!_.isEmpty(this.selected_service)) {
        this.form.selected_service_list.push(this.selected_service);
        this.selected_service = {}; // clear the selected service
      }
    },
    delete_row: function (service) {
      const services = this.form.selected_service_list.filter(
        (s) => s.id != service.id
      );
      this.form.selected_service_list = services;
    },

    submit_service: function () {
      this.form
        .post("/api/submit_service")
        .then((response) => {
          if (response.status == 200) {
            this.payment_id = response.data;
            this.load_payment_modal();
          }
        })
        .catch(() => {
          console.log(error);
        });
    },

    load_payment_modal: function () {
      // $("#payment").modal("show");
      $("#payment").modal({
        backdrop: "static",
        keyboard: false,
      });
    },

    pay_bill: function () {
      axios
        .patch("/api/service_payment_confirm/" + this.payment_id)
        .then((response) => {
          if (response.status == 200) {
            swal.fire(response.data.msg);
            $("#payment").modal("hide");
            this.$htmlToPaper("printme");
            this.form.reset();
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },

    get_service_list: function () {
      axios
        .get("/api/get_service_list")
        .then((response) => {
          if (response.status == 200) {
            this.service_list = response.data;
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
