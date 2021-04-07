<template>
  <div>
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div style="background-color: #f64e60" class="card-header">
            <h6 style="color: white">Today Appointment List</h6>
          </div>
          <div class="card-body">
            <table class="table">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Report Type</th>
                  <th>Patient Name</th>
                  <th>Mobile</th>
                  <th>Type</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <tr
                  class="zoom"
                  v-for="(data, index) in waiting_list"
                  :key="index"
                >
                  <td scope="row">{{ data.id }}</td>
                  <td class="text-danger">
                    {{ data.report_type.report_type }}
                  </td>
                  <td class="text-success">{{ data.patient.name }}</td>
                  <td>{{ data.patient.mobile }}</td>
                  <td>{{ data.payment.type }}</td>
                  <td class="text-info">
                    <i
                      class="fa fa-check icon-button mx-1"
                      @click="check_appointment(data.id)"
                    ></i>
                    <i
                      class="fa fa-eye text-success icon-button mx-1"
                      @click="modal_appointment_view(app)"
                    ></i>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div class="row mt-3">
      <div class="col-12">
        <div class="card">
          <div style="background-color: #17a2b8" class="card-header">
            <h6 style="color: white">Processing List</h6>
          </div>
          <div class="card-body">
            <table class="table">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Report Type</th>
                  <th>Patient Name</th>
                  <th>Mobile</th>
                  <th>Type</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <tr
                  class="zoom"
                  v-for="(data, index) in processing_list"
                  :key="index"
                >
                  <td scope="row">{{ data.id }}</td>
                  <td class="text-danger">
                    {{ data.report_type.report_type }}
                  </td>
                  <td class="text-success">{{ data.patient.name }}</td>
                  <td>{{ data.patient.mobile }}</td>
                  <td>{{ data.payment.type }}</td>
                  <td class="text-info">
                    <i
                      class="fa fa-check icon-button mx-1"
                      @click="file_upload_modal(data.patient_id,data.id)"
                    ></i>
                    <i
                      class="fa fa-eye text-success icon-button mx-1"

                    ></i>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div class="row mt-3">
      <div class="col-12">
        <div class="card">
          <div style="background-color: #1ee0ac" class="card-header">
            <h6 style="color: white">To Be Delivered List</h6>
          </div>
          <div class="card-body">
            <table class="table">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Report Type</th>
                  <th>Patient Name</th>
                  <th>Mobile</th>
                  <th>Type</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <tr
                  class="zoom"
                  v-for="(data, index) in deliver_list"
                  :key="index"
                >
                  <td scope="row">{{ data.id }}</td>
                  <td class="text-danger">
                    {{ data.report_type.report_type }}
                  </td>
                  <td class="text-success">{{ data.patient.name }}</td>
                  <td>{{ data.patient.mobile }}</td>
                  <td>{{ data.payment.type }}</td>
                  <td class="text-info">
                    <i
                      class="fa fa-upload text-success icon-button mx-1"
                      @click="file_upload_modal(data)"
                    ></i>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <!-- file upload modal start  -->

    <!-- Modal -->
    <div
      class="modal fade"
      id="file_modal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="modelTitleId"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header" style="background-color: #1e3d73">
            <h5 class="modal-title" style="color: white">Lab Report Upload</h5>
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
            <file-dialog
              :isInvalid="form.errors.errors.hasOwnProperty('image')"
              :accept="''"
              @output="
                (file) => {
                  this.form.image = file;
                }
              "
              :label="'Upload Lab Report'"
            >
              <p slot="errorMessage" class="invalid-feedback d-block">
                File is required
              </p>
            </file-dialog>
          </div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-secondary"
              data-dismiss="modal"
            >
              Close
            </button>
            <button @click="upload_file" type="button" class="btn btn-primary">Save</button>
          </div>
        </div>
      </div>
    </div>
    <!-- end file upload modal  -->
  </div>
</template>

<script>

export default {
  created() {
    this.get_waiting_app_list();
    this.get_processing_list();
    this.get_deliver_list();
  },
  mounted() {
    // this.get_waiting_app_list();
  },
  data() {
    return {

      form:new Form({
          image:"",
          p_id:"",
          lab_app_id:"",
      }),

      waiting_list: {},
      processing_list: {},
      deliver_list: {},
    };
  },
  methods: {

      upload_file: function(){
          this.form.post("/api/laboraty/upload_file")
          .then((response)=>{
              if(response.status == 200){
                  console.log(response.data);
              }
          })
          .catch((error)=>{
              console.log(error);
          });
      },

    file_upload_modal: function (p_id, id) {
      this.form.p_id = p_id;
      this.form.lab_app_id = id;
      $("#file_modal").modal("show");
    },
    get_waiting_app_list: function () {
      axios
        .get("/api/laboraty/get_waiting_list")
        .then((response) => {
          if (response.status == 200) {
            this.waiting_list = response.data;
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
    check_appointment: function (id) {
      // console.log(id);
      swal
        .fire({
          title: "Did you checked the Appointment ?",
          text: "You won't be able to revert this!",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Yes,I Checked!",
        })
        .then((result) => {
          if (result.isConfirmed) {
            axios
              .patch("/api/laboraty/check_appointment/" + id)
              .then((response) => {
                if (response.status == 200) {
                  this.get_waiting_app_list();
                  this.get_processing_list();
                }
              })
              .catch((error) => {
                console.log(error);
              });
          }
        });
    },
    get_processing_list: function () {
      axios
        .get("/api/laboraty/get_processing_list")
        .then((response) => {
          if (response.status == 200) {
            this.processing_list = response.data;
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
    checked_processing: function (id) {
      swal
        .fire({
          title: "Did Process Complete ?",
          text: "You won't be able to revert this!",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Yes,I done!",
        })
        .then((result) => {
          if (result.isConfirmed) {
            axios
              .patch("/api/laboraty/checked_processing/" + id)
              .then((response) => {
                if (response.status == 200) {
                  this.get_processing_list();
                  this.get_deliver_list();
                }
              })
              .catch((error) => {
                console.log(error);
              });
          }
        });
    },

    get_deliver_list: function () {
      axios
        .get("/api/laboraty/get_deliver_list")
        .then((response) => {
          if (response.status == 200) {
            this.deliver_list = response.data;
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
