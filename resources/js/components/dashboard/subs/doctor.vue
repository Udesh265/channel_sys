<template>
  <div>
    <div class="col-12">
      <div class="card">
        <img class="card-img-top" src="holder.js/100x180/" alt="" />
        <div class="card-body">
          <div class="row">
            <div class="col-9">
              <input
                v-model="pform.patient_id"
                type="text"
                class="form-control"
                placeholder="Enter Barcode ID or NIC"
                @keypress="get_patient_by_id()"
              />
            </div>
            <div class="col-3">
              <button
                @click="get_patient_by_id()"
                type="button"
                class="form-control btn btn-success"
              >
                Search Patient
              </button>
            </div>
          </div>
        </div>
      </div>
      <div v-if="pform.patient_id == patient_data.id">
        <div class="row mt-3">
          <div class="col-5">
            <div class="card bg-white">
              <img class="card-img-top" src="holder.js/100x180/" alt="" />
              <div class="card-body border-left border-success border-w-4">
                <div class="row">
                  <div class="col-9">
                    <h5>Patient Data</h5>
                  </div>
                </div>
                <div class="row mt-3">
                  <div class="col-3">
                    <h6 style="font-weight: bold">Name</h6>
                  </div>
                  <div class="col-1">
                    <h6>:</h6>
                  </div>
                  <div class="col-8">
                    <h6>{{ patient_data.name }}</h6>
                  </div>
                </div>
                <div class="row mt-2">
                  <div class="col-3">
                    <h6 style="font-weight: bold">Address</h6>
                  </div>
                  <div class="col-1">
                    <h6>:</h6>
                  </div>
                  <div class="col-8">
                    <h6>{{ patient_data.address }}</h6>
                  </div>
                </div>
                <div class="row mt-2">
                  <div class="col-3">
                    <h6 style="font-weight: bold">Age</h6>
                  </div>
                  <div class="col-1">
                    <h6>:</h6>
                  </div>
                  <div class="col-8">
                    <h6>{{ patient_data.age }}</h6>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-7">
            <div class="card bg-white rounded" style="height: 183px">
              <img class="card-img-top" src="holder.js/100x180/" alt="" />
              <div class="card-body border-left border-success border-w-4">
                <div class="row mb-3">
                  <div class="col-9">
                    <h5>Biometric Data</h5>
                  </div>
                  <div class="col-3">
                    <button
                      v-if="(biometric_data.id = biometric_data.id)"
                      type="button"
                      class="form-control btn btn-primary"
                      style="color: white"
                      @click="biometric_modal(biometric_data)"
                    >
                      Update
                    </button>
                    <button
                      v-if="biometric_data.id == null"
                      type="button"
                      class="form-control btn btn-primary"
                      style="color: white"
                      @click="add_biometric_modal()"
                    >
                      Add Data
                    </button>
                  </div>
                </div>
                <div class="row mt-3">
                  <div class="col-3">
                    <h6>Weight : {{ biometric_data.weight }}</h6>
                  </div>
                  <div class="col-3">
                    <h6>Height : {{ biometric_data.height }}</h6>
                  </div>
                  <div class="col-3">
                    <h6>B/P Lvl : {{ biometric_data.bp }}</h6>
                  </div>
                  <div class="col-3">
                    <h6>L/P : {{ biometric_data.lp }}</h6>
                  </div>
                </div>
                <div class="row mt-2">
                  <div class="col-8">
                    <h6>Primary Diseases : {{ biometric_data.diseases }}</h6>
                  </div>
                  <div class="col-4">
                    <h6></h6>
                  </div>
                </div>
                <div class="row mt-2">
                  <div class="col-8">
                    <h6>Others : {{ biometric_data.others }}</h6>
                  </div>
                  <div class="col-4">
                    <h6></h6>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- modal for UPDATE patient biometric data  -->
        <!-- Modal for Update-->
        <div
          class="modal fade"
          id="modelId_bio"
          tabindex="-1"
          role="dialog"
          aria-labelledby="exampleModalCenterTitle"
          aria-hidden="true"
        >
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header" style="background-color: #1e3d73">
                <h5
                  class="modal-title"
                  id="exampleModalLongTitle"
                  style="color: white"
                >
                  Patient Data
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
                <form action="">
                  <div class="col-12">
                    <div class="row form-group">
                      <div class="col-12">
                        <label for="form-control">Primary Diseases:</label>
                        <input
                          v-model="pform.diseases"
                          type="text"
                          placeholder="Ex:Diabetics,High Pressure,.."
                          class="form-control"
                        />
                      </div>
                    </div>
                    <div class="row form-group">
                      <div class="col-6">
                        <label for="form-control">Weight:</label>
                        <input
                          v-model="pform.weight"
                          type="text"
                          placeholder="52 Kg"
                          class="form-control"
                        />
                      </div>
                      <div class="col-6">
                        <label for="form-control">Height:</label>
                        <input
                          v-model="pform.height"
                          type="text"
                          placeholder="162 cm"
                          class="form-control"
                        />
                      </div>
                    </div>
                    <div class="row form-group">
                      <div class="col-6">
                        <label for="form-control">B/P Level:</label>
                        <input
                          v-model="pform.bp"
                          type="text"
                          placeholder="120 hg"
                          class="form-control"
                        />
                      </div>
                      <div class="col-6">
                        <label for="form-control">Lipid Profile:</label>
                        <input
                          v-model="pform.lp"
                          type="text"
                          placeholder="195"
                          class="form-control"
                        />
                      </div>
                    </div>
                    <div class="row form-group">
                      <div class="col-12">
                        <label for="form-control">Others:</label>
                        <input
                          v-model="pform.others"
                          type="text"
                          placeholder="Ex: Other facts,.."
                          class="form-control"
                        />
                      </div>
                    </div>
                  </div>
                </form>
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
                  @click="update_biometric_data()"
                  type="button"
                  class="btn btn-primary"
                >
                  Save changes
                </button>
              </div>
            </div>
          </div>
        </div>
        <!-- end patinet biometric data  -->

        <!-- Model for Add Bio metric Data -->
        <!-- Add data  -->
        <div
          class="modal fade"
          id="add_bio_modal"
          tabindex="-1"
          role="dialog"
          aria-labelledby="exampleModalCenterTitle"
          aria-hidden="true"
        >
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header" style="background-color: #1e3d73">
                <h5
                  class="modal-title"
                  id="exampleModalLongTitle"
                  style="color: white"
                >
                  Add Bio Data
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
                <form action="">
                  <div class="col-12">
                    <div class="row form-group">
                      <div class="col-12">
                        <label for="form-control">Primary Diseases:</label>
                        <input
                          v-model="pform.diseases"
                          type="text"
                          placeholder="Ex:Diabetics,High Pressure,.."
                          class="form-control"
                        />
                      </div>
                    </div>
                    <div class="row form-group">
                      <div class="col-6">
                        <label for="form-control">Weight:</label>
                        <input
                          v-model="pform.weight"
                          type="text"
                          placeholder="52 Kg"
                          class="form-control"
                        />
                      </div>
                      <div class="col-6">
                        <label for="form-control">Height:</label>
                        <input
                          v-model="pform.height"
                          type="text"
                          placeholder="162 cm"
                          class="form-control"
                        />
                      </div>
                    </div>
                    <div class="row form-group">
                      <div class="col-6">
                        <label for="form-control">B/P Level:</label>
                        <input
                          v-model="pform.bp"
                          type="text"
                          placeholder="120 hg"
                          class="form-control"
                        />
                      </div>
                      <div class="col-6">
                        <label for="form-control">Lipid Profile:</label>
                        <input
                          v-model="pform.lp"
                          type="text"
                          placeholder="195"
                          class="form-control"
                        />
                      </div>
                    </div>
                    <div class="row form-group">
                      <div class="col-12">
                        <label for="form-control">Others:</label>
                        <input
                          v-model="pform.others"
                          type="text"
                          placeholder="Ex: Other facts,.."
                          class="form-control"
                        />
                      </div>
                    </div>
                  </div>
                </form>
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
                  @click="add_biometric_data()"
                  type="button"
                  class="btn btn-primary"
                >
                  Add
                </button>
              </div>
            </div>
          </div>
        </div>
        <!-- End Add Bio metric Data modal -->

<!-- start patient history record  -->
        <div class="row mt-3">
          <div class="col-12">
            <div class="card shadow bg-white rounded">
              <div class="card-body">
                <div class="row mb-3">
                  <div class="col-9">
                    <h5>Patient Treatment History</h5>
                  </div>
                  <div class="col-3">
                    <button
                      type="button"
                      class="form-control btn btn-primary"
                      style="color: white"
                      @click="add_treatment_record_modal()"
                    >
                      Add New Record
                    </button>
                  </div>
                </div>
                <table class="table table-striped">
                  <thead class="thead-inverse">
                    <tr>
                      <th style="width: 70%">History Records</th>
                      <th style="width: 20%">Date</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr
                      class="zoom"
                      v-for="(treat, index) in treatment_data"
                      :key="index"
                    >
                      <td>
                        {{ treat.treatment }}
                      </td>

                      <td>{{ treat.updated_at }}</td>
                      <td>
                        <i
                          class="fa fa-edit text-success icon-button mx-1"
                          @click="update_history_record_modal(treat)"
                        ></i>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <!-- Start add patient history records  -->
        <!-- Modal -->
        <div
          class="modal fade"
          id="modelId_treatment_record"
          tabindex="-1"
          role="dialog"
          aria-labelledby="exampleModalCenterTitle"
          aria-hidden="true"
        >
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header" style="background-color: #1e3d73">
                <h5
                  class="modal-title"
                  id="exampleModalLongTitle"
                  style="color: white"
                >
                  Add Patient Treatment Records
                </h5>
                <button
                  type="button"
                  class="close"
                  data-dismiss="modal"
                  aria-label="Close"
                  style="color: white"
                >
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form action="">
                  <div class="col-12">
                    <div class="row form-group">
                      <div class="col-12">
                        <label for="form-control"
                          >Patient Treatments details:</label
                        >
                        <textarea
                          v-model="tform.treatment"
                          class="form-control"
                          id="exampleFormControlTextarea1"
                          rows="3"
                          placeholder="Type patient tratment records"
                        ></textarea>
                      </div>
                    </div>
                    <div class="row form-group">
                      <div class="col-12">
                        <label for="form-control"
                          >Next Treatment (optional) :</label
                        >
                        <textarea
                          v-model="tform.next_treatment"
                          class="form-control"
                          rows="3"
                          placeholder="Type Next treatment information records"
                        ></textarea>
                      </div>
                    </div>
                    <div class="row form-group">
                      <div class="col-12">
                        <label for="form-control"
                          >Next Treatment Date (optional):</label
                        >
                        <input
                          v-model="tform.date"
                          type="date"
                          class="form-control"
                        />
                      </div>
                    </div>
                  </div>
                </form>
              </div>
              <div class="modal-footer">
                <button
                  type="button"
                  class="btn btn-primary"
                  @click="add_treatment_record()"
                >
                  Add Record
                </button>
              </div>
            </div>
          </div>
        </div>

        <!--End Start add patient history records  -->


         <!-- Start UPDATE UPDATE UPDATE patient history records  -->
        <!-- Modal -->
        <div
          class="modal fade"
          id="modelId_update_record"
          tabindex="-1"
          role="dialog"
          aria-labelledby="exampleModalCenterTitle"
          aria-hidden="true"
        >
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header" style="background-color: #1e3d73">
                <h5
                  class="modal-title"
                  id="exampleModalLongTitle"
                  style="color: white"
                >
                  Update Patient Treatment Records
                </h5>
                <button
                  type="button"
                  class="close"
                  data-dismiss="modal"
                  aria-label="Close"
                  style="color: white"
                >
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form action="">
                  <div class="col-12">
                    <div class="row form-group">
                      <div class="col-12">
                        <label for="form-control"
                          >Patient Treatments details:</label
                        >
                        <textarea
                          v-model="tform.treatment"
                          class="form-control"
                          id="exampleFormControlTextarea1"
                          rows="3"
                          placeholder="Type patient tratment records"
                        ></textarea>
                      </div>
                    </div>
                    <div class="row form-group">
                      <div class="col-12">
                        <label for="form-control"
                          >Next Treatment (optional) :</label
                        >
                        <textarea
                          v-model="tform.next_treatment"
                          class="form-control"
                          rows="3"
                          placeholder="Type Next treatment information records"
                        ></textarea>
                      </div>
                    </div>
                    <div class="row form-group">
                      <div class="col-12">
                        <label for="form-control"
                          >Next Treatment Date (optional):</label
                        >
                        <input
                          v-model="tform.date"
                          type="date"
                          class="form-control"
                        />
                      </div>
                    </div>
                  </div>
                </form>
              </div>
              <div class="modal-footer">
                <button
                  type="button"
                  class="btn btn-primary"
                  @click="update_treatment_record()"
                >
                  Add Record
                </button>
              </div>
            </div>
          </div>
        </div>

        <!--End Start UPDATE UPDATE patient history records  -->

        <div class="row mt-3">
          <div class="col-12">
            <div class="card shadow bg-white rounded">
              <div class="card-body">
                <div class="row mb-3">
                  <div class="col-9">
                    <h5>Patient Laboraty Reports</h5>
                  </div>
                </div>
                <table class="table table-striped">
                  <thead class="thead-inverse">
                    <tr>
                      <th style="width: 70%">Description</th>
                      <th>Date</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr class="zoom">
                      <td>
                        Lorem ipsum dolor sit amet consectetur, adipisicing
                      </td>
                      <td>2021-08-31</td>
                      <td>
                        <i
                          class="fa fa-eye text-success icon-button mx-1"
                          @click="modal_appointment_view(app)"
                        ></i>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        Lorem ipsum dolor sit amet consectetur, adipisicing
                      </td>
                      <td>2021-08-31</td>
                      <td>
                        <i
                          class="fa fa-eye text-success icon-button mx-1"
                          @click="update_history_record_modal(treat)"
                        ></i>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  props: ["user_id"],
  created() {},
  mounted() {
    // this.get_biometric_data();
  },
  data() {
    return {
      patient_id: "",
         treatment_id:"",
      pform: new Form({
        diseases: "",
        weight: "",
        height: "",
        bp: "",
        lp: "",
        others: "",
        patient_id: "",
      }),
      tform: new Form({
        treatment: "",
        next_treatment: "",
        date: "",
        patient_id: "",
        user_id: this.user_id,


      }),
      patient_data: {},
      biometric_data: {},
      treatment_data: {},
    };
  },
  methods: {
    biometric_modal: function (biometric_data) {
      $("#modelId_bio").modal("show");
      this.pform.fill(biometric_data);
    },
    add_biometric_modal: function () {
      $("#add_bio_modal").modal("show");
    },
    add_treatment_record_modal: function () {
      $("#modelId_treatment_record").modal("show");
    },
    update_history_record_modal: function (treat) {
        $("#modelId_update_record").modal("show");
      this.tform.fill(treat);
        this.treatment_id = treat.id;
    },

    get_patient_by_id: function () {
      this.patient_id = this.pform.patient_id;
      axios
        .get("/api/appointment/get_patient/" + this.patient_id)
        .then((response) => {
          if (response.status == 200) {
            this.patient_data = response.data;
            this.get_biometric_data();
            this.get_treatment_data_by_patient_id();
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
    add_biometric_data: function () {
      this.patient_id = this.pform.patient_id;
      this.pform
        .post("/api/patient/add_bio_data")
        .then((response) => {
          if (response.status == 200) {
            swal.fire("Record Added Successfull");
            this.get_biometric_data();
            this.reset();
          }
        })
        .catch((error) => {
          console.error(error);
        });
      $("#add_bio_modal").modal("hide");
    },
    update_biometric_data: function () {
      this.patient_id = this.pform.patient_id;
      this.pform
        .patch("/api/patient/bio_data/" + this.patient_id)
        .then((response) => {
          if (response.status == 200) {
            swal.fire("Record Added Successfull");
            this.get_biometric_data();
            this.reset();
          }
        })
        .catch((error) => {
          console.error(error);
        });
      $("#modelId_bio").modal("hide");
    },
    get_biometric_data: function () {
      this.patient_id = this.pform.patient_id;
      axios
        .get("/api/patient/get_biometric_data/" + this.patient_id)
        .then((response) => {
          if (response.status == 200) {
            this.biometric_data = response.data;
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },

    add_treatment_record: function () {
      this.patient_id = this.pform.patient_id;
      this.tform
        .post("/api/patient/add_treatment/" + this.patient_id)
        .then((response) => {
          if (response.status == 200) {
            swal.fire(response.data.msg);
            $("#modelId_treatment_record").modal("hide");
               this.get_treatment_data_by_patient_id();
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
    get_treatment_data_by_patient_id: function () {
      this.patient_id = this.pform.patient_id;

      axios
        .get("/api/patient/get_treatment_data/" + this.patient_id)
        .then((response) => {
          if (response.status == 200) {
            this.treatment_data = response.data;


          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
    update_treatment_record: function(){

        this.tform
        .patch("/api/patient/update_treatment/" + this.treatment_id)
        .then((response) => {
          if (response.status == 200) {
            swal.fire(response.data.msg);
            this.get_treatment_data_by_patient_id();
            this.reset();
             $("#modelId_update_record").modal("hide");

          }
        })
        .catch((error) => {
          console.log(error);
        });

    }
  },
};
</script>

<style>
</style>
