<template>
  <div>
    <div class="col-12">
      <div class="row mb-2">
        <div class="col-12">
          <h2>New Member Registration</h2>
        </div>
      </div>

      <div class="card">
        <img class="card-img-top" src="holder.js/100x180/" alt="" />
        <div class="card-body">
          <form action="" @submit.prevent="add_patient()">
            <div class="row form-group">
              <div class="col-12">
                <label for="form-control"><h5>Basic Information</h5></label>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-sm-4 col-lg-4 col-md-4">
                <label for="form-control">Patient Name:</label>
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
                <label for="form-control">Adddress:</label>
                <input class="form-control" rows="3" v-model="form.address" />
              </div>
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
            </div>
            <button type="submit" class="btn btn-primary btn-md">
              Next
            </button>
          </form>


          <div>
            <div class="row form-group">
              <div class="col-12">
                <label for="form-control"
                  ><h5 class="mt-3">User Authentication</h5></label
                >
              </div>
            </div>
             <form @submit.prevent="submitUpdate()">
            <div class="form-group mt-3 row">

                <div class="col-md-4 mb-3">
                  <label for="validationDefault02">Username:</label>
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
                  <label for="validationDefault04">New Password:</label>
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
                  <label for="validationDefault05">Confirm Password:</label>
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
              </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>


<script>
export default {
  props: ["user_id"],
  created() {
    this.get_patient_list();
    this.getAllRoles();
  },
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

      mform: new Form({
        user_id: "",
        role_id: "",
        username: "",
        email: "",
        password: "",
        password_confirmation: "",
        photo: {},
      }),
      role_list: {},
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

    submitUpdate: async function () {
      try {
        const response = await this.mform.post(
          `/api/patient/assign/user/${this.mform.user_id}`
        );
        if (response.status == 200) {
          swal.fire("Success!", "Access Granted", "success");
          $("#assign_user_model").modal("hide");
          this.mform.clear();
          this.mform.reset();
          this.get_patient_list();
          console.log("Success message");
        }
      } catch (error) {
        console.log(error.message);
      }
    },
  },
};
</script>

<style>
</style>
