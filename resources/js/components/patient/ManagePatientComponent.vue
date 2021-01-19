<template>
  <div>
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="card">
          <div
            class="card-header d-flex justify-content-between align-items-center"
          >
            <h4 class="card-title">Patient Management Overview</h4>
            <input
              type="text"
              placeholder="Ex: Type Name or NIC Press Enter"
              class="form-control col-4"
              v-model="search_keyword"
              @keypress.enter="get_by_search"
            />
          </div>
          <div class="card-body">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>NIC</th>
                  <th>Mobile</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(patient, index) in patient_data" :key="index">
                  <td scope="row">{{ patient.id }}</td>
                  <td>{{ patient.name }}</td>
                  <td>{{ patient.nic }}</td>
                  <td>{{ patient.mobile }}</td>
                  <td>
                    <a
                      style="cursor: pointer"
                      @click="get_patient_profile(patient)"
                      ><i class="fa fa-eye text-success mx-1"></i
                    ></a>
                    <a
                      style="cursor: pointer"
                      @click="load_update_patient(patient)"
                      ><i class="fa fa-edit text-success mx-1"></i
                    ></a>
                    <a style="cursor: pointer" @click="delete_patient(patient.id)"
                      ><i class="fa fa-trash text-danger mx-1"></i
                    ></a>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <!-- View patients profile details -->
    <div
      class="modal fade bd-example-modal-lg"
      id="modal_profile"
      tabindex="-1"
      role="dialog"
      aria-labelledby="modelTitleId"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Patient Profile</h5>
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
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <img class="card-img-top" src="holder.js/100x180/" alt="" />
                  <div class="card-body">
                    <div class="row">
                      <div class="col-3">Profile Picture</div>
                      <div class="col-9">
                        <div class="row mt-2">
                          <div class="col-3">Full Name</div>
                          <div class="col-1">:</div>
                          <div class="col-5">
                            {{ patient_profile_data.name }}
                          </div>
                        </div>
                        <div class="row mt-2">
                          <div class="col-3">Address</div>
                          <div class="col-1">:</div>
                          <div class="col-5">
                            {{ patient_profile_data.address }}
                          </div>
                        </div>
                        <div class="row mt-2">
                          <div class="col-3">NIC</div>
                          <div class="col-1">:</div>
                          <div class="col-5">
                            {{ patient_profile_data.nic }}
                          </div>
                        </div>
                        <div class="row mt-2">
                          <div class="col-3">Email</div>
                          <div class="col-1">:</div>
                          <div class="col-5">
                            {{ patient_profile_data.email }}
                          </div>
                        </div>
                        <div class="row mt-2">
                          <div class="col-3">Mobile</div>
                          <div class="col-1">:</div>
                          <div class="col-5">
                            {{ patient_profile_data.mobile }}
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- View End patients details madal -->

    <!-- Update patients  details -->
    <div
      class="modal fade"
      id="load_update_p_data"
      tabindex="-1"
      role="dialog"
      aria-labelledby="modelTitleId"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Update Patient</h5>
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
            <div class="card">
              <img class="card-img-top" src="holder.js/100x180/" alt="" />
              <div class="card-body">
                <form action="" @submit.prevent="update_patient()">
                  <div class="form-group row">
                    <div class="col-sm-4 col-lg-4 col-md-4">
                      <label for="form-control">Full Name:</label>
                      <input
                        type="text"
                        class="form-control"
                        :class="{ 'is-invalid': form.errors.has('name') }"
                        v-model="form.name"
                      />
                      <has-error :form="form" field="name"></has-error>
                    </div>
                    <div class="col-sm-4 col-lg-4 col-md-4">
                      <label for="form-control">NIC:</label>
                      <input
                        type="text"
                        class="form-control"
                        :class="{ 'is-invalid': form.errors.has('nic') }"
                        v-model="form.nic"
                      />
                      <has-error :form="form" field="nic"></has-error>
                    </div>
                    <div class="col-sm-4 col-lg-4 col-md-4">
                      <label for="form-control">Email</label>
                      <input
                        type="text"
                        class="form-control"
                        :class="{ 'is-invalid': form.errors.has('email') }"
                        v-model="form.email"
                      />
                      <has-error :form="form" field="email"></has-error>
                    </div>
                  </div>
                  <div class="form-group mt-3 row">
                    <div class="col-sm-4 col-lg-4 col-md-4">
                      <label for="form-control">Mobile:</label>
                      <input
                        type="text"
                        class="form-control"
                        :class="{ 'is-invalid': form.errors.has('mobile') }"
                        v-model="form.mobile"
                      />
                      <has-error :form="form" field="mobile"></has-error>
                    </div>
                    <div class="col-sm-4 col-lg-4 col-md-4">
                      <label for="form-control">Age:</label>
                      <input
                        type="text"
                        class="form-control"
                        :class="{ 'is-invalid': form.errors.has('age') }"
                        v-model="form.age"
                      />
                      <has-error :form="form" field="age"></has-error>
                    </div>
                    <div class="col-sm-4 col-lg-4 col-md-4">
                      <label for="form-control">Patient Type:</label>
                      <select
                        class="form-control"
                        id="exampleFormControlSelect1"
                        :class="{ 'is-invalid': form.errors.has('p_type') }"
                        v-model="form.p_type"
                      >
                        <option value="Regular">Regular</option>
                        <option value="Registered">Registered</option>
                      </select>
                      <has-error :form="form" field="p_type"></has-error>
                    </div>
                  </div>
                  <div class="form-group mt-3 row">
                    <div class="col-sm-4 col-lg-4 col-md-4">
                      <label for="form-control">Adddress:</label>
                      <textarea
                        class="form-control"
                        rows="3"
                        v-model="form.address"
                      ></textarea>
                    </div>
                  </div>

                  <button type="submit" class="btn btn-primary btn-lg">
                    Update Patient
                  </button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- End Update Patients data -->
  </div>
</template>

<script>
export default {
  created() {},
  mounted() {
    this.get_patient_list();
  },

  data() {
    return {
      form: new Form({
        id: "",
        name: "",
        nic: "",
        address: "",
        mobile: "",
        email: "",
        age: "",
        p_type: "",
        status: "",
      }),
      patient_data: {},
      patient_profile_data: {},
      search_keyword: "",
    };
  },
  methods: {
    get_by_search: function () {
      axios
        .get("/api/patient/get_by_search/" + this.search_keyword)
        .then((response) => {
          if (response.status == 200) {
            this.patient_data = response.data;
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
    get_patient_list: function () {
      axios
        .get("/api/patient/get_all")
        .then((response) => {
          if (response.status == 200) {
            this.patient_data = response.data;
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },

    get_patient_profile: function (patient) {
      this.patient_profile_data = patient;
      $("#modal_profile").modal("show");
    },

    load_update_patient: function (id) {
      $("#load_update_p_data").modal("show");
      this.form.fill(id);
    },

    update_patient: function () {
      swal
        .fire({
          title: "Are you sure?",
          text: "You won't be able to revert this!",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Yes, update it!",
        })
        .then((result) => {
          if (result.isConfirmed) {
            this.form
              .patch("/api/patient/update/" + this.form.id)
              .then((response) => {
                if (response.status == 200) {
                  swal.fire(
                    "Updated!",
                    "Your file has been Updated.",
                    "success"
                  );
                  this.get_patient_list();
                  $("#load_update_p_data").modal("hide");
                }
              })
              .catch((error) => {
                console.log(error);
              });
          }
        });
    },

    delete_patient: function () {
      this.form
        .patch("/api/patient/del/" + this.form.id)
        .then((response) => {
          if (response == 200) {
            swal.fire("Deleted!", "Your file has been Deleted.", "success");
            this.get_patient_list();
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
