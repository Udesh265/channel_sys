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
          <form id="hi" action="" @submit.prevent="add_patient()">
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
            </div>

            <div class="row form-group">
              <div class="col-12">
                <label for="form-control"
                  ><h5 class="mt-3">User Authentication</h5></label
                >
              </div>
            </div>

            <div class="form-group mt-3 row">
              <div class="col-md-4 mb-3">
                <label for="validationDefault02">Type Username: *</label>
                <input
                  v-model="form.username"
                  type="text"
                  name="username"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('username') }"
                />
                <has-error :form="form" field="username"></has-error>
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
            <div class="form-group mt-2 row">
              <div class="col-md-4 mb-3">
                <label for="validationDefault04">Create New Password:</label>
                <input
                  v-model="form.password"
                  type="password"
                  name="password"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('password') }"
                />
                <has-error :form="form" field="password"></has-error>
              </div>
              <div class="col-md-4 mb-3">
                <label for="validationDefault05">Confirm Password:</label>
                <input
                  v-model="form.password_confirmation"
                  type="password"
                  name="password_confirmation"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('password') }"
                />
                <has-error
                  :form="form"
                  field="password_confirmation"
                ></has-error>
              </div>
            </div>
            <button class="btn btn-primary" :disabled="form.busy" type="submit">
              Finish
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>


<script>
export default {
  //   props: ["user_id"],
  created() {},
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
        p_type: "online",
        status: "1",

        user_id: "",
        role_id: "4",
        username: "",
        password: "",
        password_confirmation: "",
        // photo: {},
      }),
      patient_data: {},
    };
  },
  methods: {
    add_patient: function () {
      let timerInterval;
      this.form
        .post("/api/patient/addpatient_online")
        .then((response) => {
          if (response.status == 200) {
            swal.fire({
              title: "Your Account Create Successfull",
              html: "Please login to the system",
              timer: 5000,
              timerProgressBar: true,
              didOpen: () => {
                Swal.showLoading();
                timerInterval = setInterval(() => {
                  const content = Swal.getContent();
                  if (content) {
                    const b = content.querySelector("b");
                    if (b) {
                      b.textContent = Swal.getTimerLeft();
                    }
                  }
                }, 100);
              },
              willClose: () => {
                clearInterval(timerInterval);

              },
            });
            window.location.href = "/login";
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },

    hide_form: function (id) {
      $("#hi").hide();
    },
  },
};
</script>

<style>
</style>
