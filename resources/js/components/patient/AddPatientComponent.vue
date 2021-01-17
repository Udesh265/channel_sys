<template>
  <div>
    <div class="col-12">
      <div class="card">
        <img class="card-img-top" src="holder.js/100x180/" alt="" />
        <div class="card-body">
          <form action="" @submit.prevent="add_patient()">
            <div class="form-group row">
              <div class="col-sm-4 col-lg-4 col-md-4">
                <label for="form-control">Full Name:</label>
                <input type="text" class="form-control" v-model="form.name" />
              </div>
              <div class="col-sm-4 col-lg-4 col-md-4">
                <label for="form-control">NIC:</label>
                <input type="text" class="form-control" v-model="form.nic" />
              </div>
              <div class="col-sm-4 col-lg-4 col-md-4">
                <label for="form-control">Email</label>
                <input type="text" class="form-control" v-model="form.email" />
              </div>
            </div>
            <div class="form-group mt-3 row">
              <div class="col-sm-4 col-lg-4 col-md-4">
                <label for="form-control">Mobile:</label>
                <input type="text" class="form-control" v-model="form.mobile" />
              </div>
              <div class="col-sm-4 col-lg-4 col-md-4">
                <label for="form-control">Age:</label>
                <input type="text" class="form-control" v-model="form.age" />
              </div>
              <div class="col-sm-4 col-lg-4 col-md-4">
                <label for="form-control">Patient Type:</label>
                <select
                  class="form-control"
                  id="exampleFormControlSelect1"
                  v-model="form.p_type"
                >
                  <option value="Regular">Regular</option>
                  <option value="Registered">Registered</option>
                </select>
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
              Add Patient
            </button>
          </form>
        </div>
      </div>

      <!-- access system fro patients -->
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div
              class="card-header d-flex justify-content-between align-items-center"
            >
              <h4 class="card-title">Allow System Access For Pateints</h4>
              <input
                type="text"
                placeholder="Ex: Type Name or NIC Press Enter"
                class="form-control col-4"
                v-model="search_keyword"
                @keypress.enter="search_all_emp"
              />
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th width="10%" scope="col"></th>
                      <th width="20%" scope="col">Patients Name</th>
                      <th width="40%" scope="col">NIC</th>
                      <th width="20%" scope="col">Status</th>
                      <th width="10%" scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(patient, index) in patient_data" :key="index">
                      <th scope="row">{{ patient.id }}</th>
                      <td>{{ patient.name }}</td>
                      <td>{{ patient.nic }}</td>
                      <td>
                        {{
                          patient.user_id == null ? "Not Assigned" : "Assigned"
                        }}
                      </td>
                      <td style="text-align: center">
                        <a
                          style="cursor: pointer"
                          @click="assign_user(patient.id)"
                          ><i class="fa fa-eye text-success mx-1"></i
                        ></a>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- End access system for patients -->
    </div>

    <!-- Assign User Model  -->

    <div
      class="modal fade"
      id="assign_user_model"
      tabindex="-1"
      role="dialog"
      aria-labelledby="modelTitleId"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Assign Patient As User</h5>
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
                <form @submit.prevent="mform_submit">
                  <div class="form-row">
                    <div class="col-md-4 mb-3">
                      <label for="validationDefault03">Role</label>
                      <select
                        class="form-control"
                        name="role_id"
                        :class="{ 'is-invalid': mform.errors.has('role_id') }"
                        v-model="mform.role_id"
                      >
                        <option
                          v-for="(role, index) in role_list"
                          :key="index"
                          v-bind:value="role.id"
                        >
                          {{ role.name }}
                        </option>
                      </select>
                      <has-error :form="mform" field="role_id"></has-error>
                    </div>
                    <div class="col-md-4 mb-3">
                      <label for="validationDefault02">Username</label>
                      <input
                        v-model="mform.username"
                        type="text"
                        name="username"
                        class="form-control"
                        :class="{ 'is-invalid': mform.errors.has('username') }"
                      />
                      <has-error :form="mform" field="username"></has-error>
                    </div>
                    <div class="col-md-4 mb-3">
                      <label for="validationDefaultEmail">Email</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="inputGroupPrepend2"
                            >@</span
                          >
                        </div>
                        <input
                          v-model="mform.email"
                          type="text"
                          name="email"
                          class="form-control"
                          :class="{ 'is-invalid': mform.errors.has('email') }"
                        />
                        <has-error :form="mform" field="email"></has-error>
                      </div>
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="col-md-4 mb-3">
                      <label for="validationDefault04">Password</label>
                      <input
                        v-model="mform.password"
                        type="password"
                        name="password"
                        class="form-control"
                        :class="{ 'is-invalid': mform.errors.has('password') }"
                      />
                      <has-error :form="mform" field="password"></has-error>
                    </div>
                    <div class="col-md-4 mb-3">
                      <label for="validationDefault05"
                        >Password Confirmation</label
                      >
                      <input
                        v-model="mform.password_confirmation"
                        type="password"
                        name="password_confirmation"
                        class="form-control"
                        :class="{ 'is-invalid': mform.errors.has('password') }"
                      />
                      <has-error
                        :form="mform"
                        field="password_confirmation"
                      ></has-error>
                    </div>
                  </div>
                  <div class="form-row pt-3">
                    <div class="col-md-4">
                      <label for="validationDefault05"
                        >Profile Pic (600px X 600px Recommended)</label
                      >
                      <div class="custom-file overflow-hidden mb-5">
                        <input
                          id="customFile1"
                          @change="uploadFile"
                          type="file"
                          name="Photo"
                          class="custom-file-input"
                        />
                        <label for="customFile1" class="custom-file-label">{{
                          img_name
                        }}</label>
                      </div>
                    </div>
                  </div>

                  <button
                    class="btn btn-primary"
                    :disabled="mform.busy"
                    type="submit"
                  >
                    Assign As User
                  </button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- End Assign User Model  -->
  </div>
</template>

<script>
export default {
  created() {
    this.get_patient_list();
  },
  mounted() {},
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

      mform: new Form({
        role_id: "",
        emp_id: "",
        username: "",
        email: "",
        password: "",
        password_confirmation: "",
        photo: {
          name: "",
          file: "",
        },
      }),
      role_list: "",
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
    assign_user: function () {

         $("#assign_user_model").modal("show");

    },


  },
};
</script>

<style>
</style>
