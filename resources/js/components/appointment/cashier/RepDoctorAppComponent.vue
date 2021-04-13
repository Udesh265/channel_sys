<template>
  <div>
    <div class="col-12">
      <div class="card">
        <img class="card-img-top" src="holder.js/100x180/" alt="" />
        <div class="card-body">
          <form action="">
            <div class="form-group row">
              <div class="col-sm-4 col-lg-4 col-md-4">
                <label for="form-control">Full Name:</label>
                <input
                  type="text"
                  placeholder="Enter Full name"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('name') }"
                  v-model="form.name"
                />
                <has-error :form="form" field="name"></has-error>
              </div>
              <div class="col-sm-3 col-lg-3 col-md-3">
                <label for="form-control">Mobile:</label>
                <input
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
                <div class="form-group">
                  <label for="form-control">Speciality</label>
                  <select
                    v-model="aform.spec_id"
                    @change="get_doc_list"
                    class="form-control"
                  >
                    <option
                      v-for="(spec, index) in spec_data"
                      :key="index"
                      :value="spec.id"
                    >
                      {{ spec.name }}
                    </option>
                  </select>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group">
                  <label for="form-control">Doctor Name</label>
                  <select
                    v-model="selected_doc"
                    @change="get_schedule"
                    class="form-control"
                  >
                    <option
                      v-for="(doc, index) in doc_data"
                      :key="index"
                      :value="doc"
                    >
                      {{ doc.employee.first_name }}
                    </option>
                  </select>
                </div>
              </div>
            </div>
            <div class="row" v-if="selected_doc.id">
              <div class="col-6">
                <div class="form-group">
                  <label for="form-control">Doctor Fee :</label>
                  <input
                    class="form-control"
                    disabled="true"
                    type="text"
                    name=""
                    id=""
                    v-model="selected_doc.charge_pp"
                  />
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12">
                <div class="form-group">
                  <label for="form-control"
                    ><h5>Pick Doctor Availble Date :</h5></label
                  >
                  <calendar-view
                    :showTimes="true"
                    @click-date="
                      (date) => {
                        calenderClicked(date);
                      }
                    "
                    @click-item="
                      (calendarItem) => {
                        appointment_item(calendarItem);
                      }
                    "
                    class="theme-default"
                    :startingDayOfWeek="1"
                    :show-date="showDate"
                    :items="items"
                    style="height: 70vh"
                  >
                    <calendar-view-header
                      slot="header"
                      slot-scope="t"
                      :header-props="t.headerProps"
                      @input="setShowDate"
                    />
                  </calendar-view>
                </div>
              </div>
            </div>

            <button type="submit" class="btn btn-primary btn-lg">
              Add Patient
            </button>
          </form>
        </div>
      </div>
    </div>
     <!-- Start printed bill for lab appointment  -->
            <div
              class="modal fade"
              id="load_doc_pay_modal"
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
                    <button
                      type="button"
                      class="close"
                      data-dismiss="modal"
                      aria-label="Close"
                    >
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div class="form-group mt-2">
                      <label for=""><h5>Appointment Fee :</h5></label>
                      <label for=""
                        ><h5>{{ form.charge_pp }} LKR</h5></label
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
                      type="button"
                      class="btn btn-secondary"
                      data-dismiss="modal"
                    >
                      Close
                    </button>
                    <button
                      @click="pay_doctor_appointment()"
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
                  <br />New Town, Digana, Rajawella <br />Tel:
                  0552268036/0719362359
                </p>
                ---------------------------------------------
                <div>
                  <label style="font-size: 12px">ID:</label>
                  <label style="font-size: 12px">{{
                    billform.appointment_id
                  }}</label>
                  <label style="font-size: 12px; margin-left: 20px"
                    >Date :</label
                  >
                  <label style="font-size: 12px">{{ billform.date }}</label>
                </div>

                <table style="width: 250px">
                  <tr>
                    <th style="text-align: left; font-size: 12px">#</th>
                    <th style="text-align: left; font-size: 12px">
                      Description
                    </th>
                    <th style="text-align: left; font-size: 12px">Fee</th>
                  </tr>
                  <tr>
                    <td style="text-align: left; font-size: 10px">
                      {{ billform.appointment_id }}
                    </td>
                    <td style="text-align: left; font-size: 10px">
                      {{ billform.test_name }}
                    </td>
                    <td style="text-align: left; font-size: 10px">
                      {{ billform.lab_app_amount }}
                    </td>
                  </tr>
                </table>

                <label style="font-size: 12px">Paid Amount:</label>
                <label style="font-size: 12px; margin-left: 10px"
                  >Rs: {{ billform.paid_amount }}</label
                >
                <br />

                <label style="font-size: 12px">Total :</label>
                <label style="font-size: 12px; margin-left: 5px"
                  >Rs: {{ billform.lab_app_amount }}</label
                >
                <br>
                <label style="font-size: 14px"> Token No : </label>
                <label style="font-size: 15px; margin-left: 5px"
                  > {{ billform.token }} </label
                >
                <br />---------------------------------------------
                <br />
                <div style="margin-left: 55px; font-size: 12px">
                  Thank You,Welcome!
                </div>

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
  created() {
    // this.get_patient_list();
    // this.getAllRoles();
    this.get_spec();
  },
  mounted() {
    this.get_patient_list();
  },
    computed: {
    balance() {
      return (
        parseInt(this.billform.paid_amount) - parseInt(this.form.charge_pp)
      );
    },
  },
  data() {
    return {
      form: new Form({
        id: "",
        name: "",
        nic: "000000000",
        address: "regular user no address",
        mobile: "",
        email: "",
        age: "",
        p_type: "Regular",
        status: "1",

        charge_pp: "",
        payment_method: "",
        schedule_id: "",
        user_id: this.user_id,
        status: "1",
      }),

    //   patient_data: {},

    //   role_list: {},

      // cut from new appointment
      aform: new Form({
        spec_id: "",
        name: "",
      }),

      sform: new Form({
        charge_pp: "",
        payment_method: "",
        schedule_id: "",
        user_id: this.user_id,
        status: "1",
        p_id: "",
      }),

        billform: new Form({
        appointment_id: "",
        lab_app_amount: 0,
        paid_amount: 0,
        test_name: "",
        date: "",
        token:"",
      }),

      payment_id:"",

      spec_data: {},
      doc_data: {},
      //   patient_data: {},

      // calnder

      one_appointment: {},
      selected_doc: {},

      showDate: new Date(),
      items: [],
    };
  },
  methods: {
    add_patient: function () {
      this.form
        .post("/api/patient/addpatient")
        .then((response) => {
          if (response.status == 200) {
            swal.fire("Success!", "Patient Added Successfully", "success");
            this.form.reset();
            this.get_patient_list();
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
    get_spec: function () {
      axios
        .get("/api/doctor/get_spec")
        .then((response) => {
          if (response.status == 200) {
            this.spec_data = response.data;
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
    get_doc_list: function () {
      axios
        .get("/api/doctor/get_doc_list/" + this.aform.spec_id)
        .then((response) => {
          //   console.log(response);
          if (response.status == 200) {
            this.doc_data = response.data;
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },

    get_schedule: function () {
      axios
        .get("/api/appointment/get/" + this.selected_doc.employee_id)
        .then((response) => {
          if (response.status == 200) {
            this.items = response.data.map((item) => {
              return {
                id: item.id,
                startDate: item.startDate,
                classes: "bg-event event-button",
                title: "Available",
              };
            });
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
    appointment_item: function (data) {
      this.form.schedule_id = data.id;
      this.form.charge_pp = this.selected_doc.charge_pp;
    //   this.form.p_id = this.patient_data.id;
    this.form.post("/api/appointment/submit_regular_patient_appointment")
    .then((response)=>{
        if(response.status == 200){
            // swal.fire(response.data.msg);
          this.payment_id = response.data.data.payment.payment_id;

            this.load_modal_pay_for_doc_appointment();

        }
    })
    .catch((error)=>{
        console.log(error);
    });
    },

    load_modal_pay_for_doc_appointment: function(){

         this.form.charge_pp = this.selected_doc.charge_pp;
         $("#load_doc_pay_modal").modal("show");

        //  console.log(payment_id);
    },

    pay_doctor_appointment: function(){
        //  this.payment_id = response.data.data.payment.payment_id;

        axios.patch("/api/appointment/regular_doc_app_paid/" + this.payment_id)
        .then((response)=>{
        if(response.status == 200){
             swal.fire(response.data.msg);
             $("#load_doc_pay_modal").modal("hide");
             this.$htmlToPaper("printme");

        }
    })
    .catch((error)=>{
        console.log(error);
    });

    }



  },
};
</script>

<style>
#invoice-POS {
  padding: 0mm;
  margin: 0 auto;
  margin-bottom: 1px;
  width: 100mm;
  background: #fff;
}
</style>
