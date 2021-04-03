<template>
  <div>
    <div class="col-12">
      <div class="card">
        <img class="card-img-top" src="holder.js/100x180/" alt="" />
        <div class="card-body">
          <div class="row">
            <div class="col-6">
              <div class="form-group">
                <label for="form-control"><h6>Select Report Type :</h6></label>
                <select class="form-control" v-model="aform.rtype_id">
                  <option v-for="(type,index) in report_type_data" :key="index" :value="type.id">
                      {{ type.report_type }}
                  </option>
                </select>
              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <label for="form-control"><h6>Report Fee :</h6></label>
                <input type="text" disabled class="form-control" :value="report_fee.fee">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="form-group">
                <label for="form-control"><h6>Pick A Date :</h6></label>
                <div class="form-group">
                  <calendar-view
                    :showTimes="true"
                    @click-date="
                      (date) => {
                        calenderClicked(date);
                      }
                    "
                    class="theme-default"
                    :startingDayOfWeek="1"
                    :show-date="showDate"
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
          </div>
        </div>
      </div>
    </div>
    <!-- Modal -->
    <div
      ref="lab_appointment_model"
      class="modal fade"
      id="lab_appointment_model"
      tabindex="-1"
      role="dialog"
      aria-labelledby="modelTitleId"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">
              Appointment Confirmation
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
            <div>
              <h5>Dear Customer,Your Appointment will be ready at {{ display_date}}</h5>
              <br />
              <h6>
                Please Select the payment method and confirm your appointment.
              </h6>
              <br />

              <label for="form-control"> Payment Method</label>
              <select
                v-model="aform.payment_method"
                class="form-control"
                :class="{ 'is-invalid': sform.errors.has('payment_method') }"
              >
                <option value="On-Visit">On Visit</option>
                <option value="Online">Online</option>
              </select>
              <has-error :form="sform" field="payment_method"></has-error>
            </div>
          </div>
          <div class="modal-footer">
            <button
              type="button"
              @click="payment_gatway_modal()"
              class="btn btn-secondary"
              data-dismiss="modal"
            >
              Close
            </button>
            <button
              type="button"
              @click="submit_appointment()"
              class="btn btn-primary"
            >
              Confirm Appointment
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-- end model -->
  </div>
</template>

<script>
export default {
  props: ["user_id"],
  created() {
    this.get_patient_by_user_id();
    this.get_report_type();
  },
  mounted() {},
  data() {
    return {

      aform: new Form({
        app_date: "",
        user_id: this.user_id,
        patient_id: "",
        payment_method: "",
        rtype_id:"",
      }),
      sform: new Form({
        charge_pp: "",
        payment_method: "",
        schedule_id: "",
        user_id: this.user_id,
        status: "1",
        p_id: "",
      }),
      showDate: new Date(),
      patient_data: {},
      report_type_data:{},
      selected_rtype:{},
      display_date:"",
    };
  },
  methods: {
    setShowDate(d) {
      this.showDate = d;
    },
    get_patient_by_user_id: function () {
      axios
        .get("/api/appointment/get_patient/" + this.user_id)
        .then((response) => {
          if (response.status == 200) {
            this.patient_data = response.data;
            this.aform.patient_id = this.patient_data.id;
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
    calenderClicked: function (date) {
      let new_date =moment(date).format('LL');
      console.log(new_date);
      this.aform.app_date = date;
      this.display_date = new_date;
      $("#lab_appointment_model").modal("show");
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

    }
  },
  computed: {
      report_fee() {
          if(this.aform.rtype_id) {
              return _.find(this.report_type_data, {id: this.aform.rtype_id})
          }

          return {fee: null};
      }
  }
};
</script>

<style>
</style>
