<template>
  <div>
    <div class="row">
      <div class="col-12">
        <div class="card">
          <img class="card-img-top" src="holder.js/100x180/" alt="" />
          <div class="card-body">
            <form action="" @submit.prevent="add_emp()">
              <div class="form-group row">
                <div class="col-sm-4 col-lg-4 col-md-4">
                  <label for="form-control">First Name:</label>
                  <input
                    type="text"
                    class="form-control"
                    v-model="form.first_name"
                    :class="{ 'is-invalid': form.errors.has('first_name') }"
                  />
                    <has-error :form="form" field="first_name"></has-error>

                </div>
                <div class="col-sm-4 col-lg-4 col-md-4">
                  <label for="form-control">Last Name:</label>
                  <input
                    type="text"
                    class="form-control"
                    v-model="form.last_name"
                     :class="{ 'is-invalid': form.errors.has('last_name') }"
                  />
                  <has-error :form="form" field="last_name"></has-error>
                </div>
                <div class="col-sm-4 col-lg-4 col-md-4">
                  <label for="form-control">NIC:</label>
                  <input type="text" class="form-control" :class="{ 'is-invalid': form.errors.has('nic') }" v-model="form.nic" />
                  <has-error :form="form" field="nic"></has-error>
                </div>
              </div>
              <div class="form-group mt-3 row">
                <div class="col-sm-4 col-lg-4 col-md-4">
                  <label for="form-control">Email:</label>
                  <input
                    type="text"
                    class="form-control"
                    v-model="form.email"
                    :class="{ 'is-invalid': form.errors.has('email') }"
                  />
                  <has-error :form="form" field="email"></has-error>
                </div>
                <div class="col-sm-4 col-lg-4 col-md-4">
                  <label for="form-control">Mobile:</label>
                  <input
                    type="text"
                    class="form-control"
                    v-model="form.mobile"
                    :class="{ 'is-invalid': form.errors.has('mobile') }"
                  />
                  <has-error :form="form" field="email"></has-error>
                </div>
                <div class="col-sm-4 col-lg-4 col-md-4">
                  <label for="form-control">Job Type:</label>
                  <select
                    class="form-control"
                    id="exampleFormControlSelect1"
                    v-model="form.job_id"
                  >
                    <option
                      v-for="(job, index) in jobdata"
                      :key="index"
                      :value="job.id"
                    >
                      {{ job.name }}
                    </option>
                  </select>
                </div>
              </div>
              <div v-if="form.job_id == 1">
                <div class="col-sm-4 col-lg-4 col-md-4">
                  <label for="form-control"> <h6>For Doctors:</h6> </label>
                </div>
                <div class="form-group mt-2 row">
                  <div class="col-sm-4 col-lg-4 col-md-4">
                    <label for="form-control"> Speciality:</label>
                    <select v-model="form.spec_id" class="form-control">
                      <option
                        v-for="(spec, index) in spec_data"
                        :key="index"
                        :value="spec.id"
                      >
                      {{ spec.name }}
                      </option>
                    </select>
                  </div>
                  <div class="col-sm-4 col-lg-4 col-md-4">
                    <label for="form-control">Working Hopspital:</label>
                    <input v-model="form.hospital" class="form-control" type="text" />
                  </div>
                  <div class="col-sm-4 col-lg-4 col-md-4">
                    <label for="form-control"> Type:</label>
                    <select
                      id="exampleFormControlSelect1"
                      v-model="form.doc_type"
                      class="form-control"
                    >
                      <option value="1">Permenent Doctors</option>
                      <option value="2">Visiting Doctors</option>
                    </select>
                  </div>
                </div>
                <div v-if="form.doc_type == 2" class="form-group mt-2 row">
                  <div class="col-sm-4 col-lg-4 col-md-4">
                    <label for="form-control">Charge per patient:</label>
                    <input v-model="form.charge_pp" class="form-control" type="text" />
                  </div>
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
                Add Employee
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-12">
        <div class="card">
          <div
            class="card-header d-flex justify-content-between align-items-center"
          >
            <h4 class="card-title">Assign User</h4>
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
                    <th width="20%" scope="col">Employee Name</th>
                    <th width="40%" scope="col">NIC</th>
                    <th width="20%" scope="col">Status</th>
                    <th width="10%" scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(emp, index) in empdata" :key="index">
                    <th scope="row">{{ emp.id }}</th>
                    <td>{{ emp.first_name }}</td>
                    <td>{{ emp.nic }}</td>
                    <td>
                      {{ emp.user_id == null ? "Not Assigned" : "Assigned" }}
                    </td>
                    <td style="text-align: center">
                      <a style="cursor: pointer" @click="assign_user(emp.id)"
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

    <!-- Assign User Model  -->

    <div
      class="modal fade"
      id="modelId"
      tabindex="-1"
      role="dialog"
      aria-labelledby="modelTitleId"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Assign Employee As User</h5>
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
                <form method="POST" @submit.prevent="mform_submit">
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
                    Create
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
    this.getAllRoles();
    this.get_spec();
  },
  props: ["user_id"],

  mounted() {
    this.job_list();
    this.emp_list();
  },
  data() {
    return {
      form: new Form({
        id: "",
        first_name: "",
        last_name: "",
        address: "",
        email: "",
        nic: "",
        mobile: "",
        job_id: "",
        spec_id: "",
        hospital:"",
        doc_type:"",
        charge_pp: "",
      }),
      search_keyword: "",

      jobdata: {},

      empdata: {},

      spec_data: {},

      // Create model data
      img_name: "Choose File",
      submit_disabled: false,

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

      //End create model data
    };
  },
  methods: {
    job_list: function () {
      axios
        .get("/api/joblist")
        .then((response) => {
          if (response.status == 200) {
            this.jobdata = response.data;
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },

    add_emp: function () {
      this.form
        .post("/api/employee")
        .then((response) => {
          if (response.status == 200) {
            swal.fire(response.data.msg);
            this.form.reset();
            this.emp_list();
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },

    emp_list: function () {
      axios
        .get("/api/employee")
        .then((response) => {
          if (response.status == 200) {
            this.empdata = response.data;
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
    search_all_emp: function () {
      axios
        .get("/api/employee/search/" + this.search_keyword)
        .then((response) => {
          this.empdata = response.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },

    // create user model methods
    assign_user: function (id) {
      // console.log(id);
      this.mform.emp_id = id;
      $("#modelId").modal("show");
    },

    mform_submit: async function () {
      try {
        const response = await this.mform.post("/api/user/assign");
        if (response.status == 200) {
          swal.fire(response.data.msg);
          this.form.reset();
          this.emp_list();
          $("#modelId").modal("hide");

        }
      } catch (error) {
        console.log(error);
      }
    },

    getAllRoles: async function () {
      try {
        const response = await axios.get("/api/role/get/user/" + this.user_id);
        if (response.status == 200) {
          this.role_list = response.data;
        }
      } catch (error) {
        console.log(error);
      }
    },

    submitForm: async function () {
      try {
        this.submit_disabled = true;
        const response = await this.form.post("/api/user");
        if (response.status == 200) {
          this.form.reset();
          this.img_name = "Choose File";
          this.submit_disabled = false;
          Toast.fire({
            icon: "success",
            title: response.data.message,
          });
        }
      } catch (error) {
        console.log(error);
        this.submit_disabled = false;
      }
    },

    uploadFile: function (event) {
      let file = event.target.files[0];

      this.img_name = file.name;
      this.mform.photo.name = file.name;

      let reader = new FileReader();

      reader.onloadend = (file) => {
        this.mform.photo.file = reader.result;
      };

      reader.readAsDataURL(file);
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
  },
};
</script>

<style>
</style>
