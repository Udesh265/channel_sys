<template>
  <div>
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="card">
          <div
            class="card-header d-flex justify-content-between align-items-center"
          >
            <h4 class="card-title">Employee Management Overview</h4>
            <input
              type="text"
              placeholder="Ex: Type Name or NIC Press Enter"
              class="form-control col-4"
              v-model="search_keyword"
              @keypress.enter="emp_list"
            />
            <button
              type="button"
              @click="get_all_emp"
              class="btn btn-primary col-2"
            >
              View All
            </button>
          </div>
          <div class="card-body">
            <table class="table">
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
                <tr v-for="(emp, index) in emp_data" :key="index">
                  <td scope="row">{{ emp.id }}</td>
                  <td>{{ emp.first_name }}</td>
                  <td>{{ emp.nic }}</td>
                  <td>{{ emp.mobile }}</td>
                  <td>
                    <a style="cursor: pointer" @click="get_one_employee(emp.id)"
                      ><i class="fa fa-eye text-success mx-1"></i
                    ></a>
                    <a
                      style="cursor: pointer"
                      @click="update_emp_load_modal(emp)"
                      ><i class="fa fa-edit text-success mx-1"></i
                    ></a>
                    <a style="cursor: pointer" @click="emp_del(emp.id)"
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

    <!-- Update Employee model start -->
    <!-- Modal -->
    <div
      class="modal fade bd-example-modal-lg"
      id="modelId"
      tabindex="-1"
      role="dialog"
      aria-labelledby="modelTitleId"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Edit Employee</h5>
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
                    <form @submit.prevent="update_emp()">
                      <div class="form-group row">
                        <div class="col-sm-4 col-lg-4 col-md-4">
                          <label for="form-control">First Name:</label>
                          <input
                            type="text"
                            class="form-control"
                            v-model="form.first_name"
                          />
                        </div>
                        <div class="col-sm-4 col-lg-4 col-md-4">
                          <label for="form-control">Last Name:</label>
                          <input
                            type="text"
                            class="form-control"
                            v-model="form.last_name"
                          />
                        </div>
                        <div class="col-sm-4 col-lg-4 col-md-4">
                          <label for="form-control">NIC:</label>
                          <input
                            type="text"
                            class="form-control"
                            v-model="form.nic"
                          />
                        </div>
                      </div>
                      <div class="form-group mt-3 row">
                        <div class="col-sm-4 col-lg-4 col-md-4">
                          <label for="form-control">Email:</label>
                          <input
                            type="text"
                            class="form-control"
                            v-model="form.email"
                          />
                        </div>
                        <div class="col-sm-4 col-lg-4 col-md-4">
                          <label for="form-control">Mobile:</label>
                          <input
                            type="text"
                            class="form-control"
                            v-model="form.mobile"
                          />
                        </div>
                        <div class="col-sm-4 col-lg-4 col-md-4">
                          <label for="form-control">Job Type:</label>
                          <select
                            class="form-control"
                            id="exampleFormControlSelect1"
                            v-model="form.job_type_id"
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
                        Update
                      </button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- End Update employee model  -->

    <!-- View employee details -->
    <div
      class="modal fade bd-example-modal-lg"
      id="modelId1"
      tabindex="-1"
      role="dialog"
      aria-labelledby="modelTitleId"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Employee Profile</h5>
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
                      <div class="col-9" >
                        <div class="row mt-2">
                          <div class="col-3">First Name</div>
                          <div class="col-1">:</div>
                          <div class="col-5">{{ one_emp_data.first_name }}</div>
                        </div>
                        <div class="row mt-2">
                          <div class="col-3">Last Name</div>
                          <div class="col-1">:</div>
                          <div class="col-5">{{ one_emp_data.last_name }}</div>
                        </div>
                        <div class="row mt-2">
                          <div class="col-3">NIC</div>
                          <div class="col-1">:</div>
                          <div class="col-5">{{ one_emp_data.nic }}</div>
                        </div>
                        <div class="row mt-2">
                          <div class="col-3">Email</div>
                          <div class="col-1">:</div>
                          <div class="col-5">{{ one_emp_data.email }}</div>
                        </div>
                        <div class="row mt-2">
                          <div class="col-3">Mobile</div>
                          <div class="col-1">:</div>
                          <div class="col-5">{{ one_emp_data.mobile }}</div>
                        </div>
                        <div class="row mt-2">
                          <div class="col-3">Job Role</div>
                          <div class="col-1">:</div>
                          <div class="col-5">
                            {{ one_emp_data.nic }}
                          </div>
                        </div>
                        <div class="row mt-2">
                          <div class="col-3">Address</div>
                          <div class="col-1">:</div>
                          <div class="col-5">{{ one_emp_data.address }}</div>
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
    <!-- View End Employee details madal -->
  </div>
</template>

<script>
export default {
  created() {
    this.get_job_list();
  },
  mounted() {
    this.get_all_emp();
    //this.emp_del();
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
        job_type_id: "",
      }),

      search_keyword: "",
      jobdata: {},
      emp_data: {},
      all_emp_data: {},
      one_emp_data: {},
    };
  },
  methods: {
    emp_list: function () {
      axios
        .get("/api/employee/search/" + this.search_keyword)
        .then((response) => {
          if (response.status == 200) {
            this.emp_data = response.data;
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },

    get_all_emp: function () {
      axios
        .get("/api/employee/all/")
        .then((response) => {
          if (response.status == 200) {
            this.emp_data = response.data;
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },

    emp_del: function (id) {
      // console.log("dsdss");
      swal
        .fire({
          title: "Are you sure?",
          text: "You won't be able to revert this!",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Yes, delete it!",
        })
        .then((result) => {
          if (result.isConfirmed) {
            axios
              .patch("/api/employee/del/" + id)
              .then((response) => {
                if (response.status == 200) {
                  swal.fire(
                    "Deleted!",
                    "Your file has been deleted.",
                    "success"
                  );
                  this.get_all_emp();
                }
              })
              .catch((error) => {
                console.log(error);
              });
          }
        });
    },

    get_job_list: function () {
      axios
        .get("/api/jobtype")
        .then((response) => {
          if (response.status == 200) {
            this.jobdata = response.data;
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },

    get_one_employee: function (id) {
      $("#modelId1").modal("show");

      axios
        .get("/api/employee/getone/" + id)
        .then((response) => {
          if (response.status == 200) {
            this.one_emp_data = response.data;
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },

    update_emp_load_modal: function (id) {
      $("#modelId").modal("show");
      this.form.fill(id);
    },

    update_emp: function () {
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
              .patch("/api/employee/update/" + this.form.id)
              .then((response) => {
                if (response.status == 200) {
                  swal.fire(
                    "Updated!",
                    "Your file has been Updated.",
                    "success"
                  );
                  this.get_all_emp();
                  $("#modelId").modal("hide");
                }
              })
              .catch((error) => {
                console.log(error);
              });
          }
        });
    },
  },
};
</script>

<style>
</style>
