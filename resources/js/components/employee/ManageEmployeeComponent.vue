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
                    <a style="cursor: pointer"
                      ><i class="fa fa-eye text-success mx-1"></i
                    ></a>
                    <a style="cursor: pointer" @click="update_emp(emp.id)"
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
      class="modal fade"
      id="modelId"
      tabindex="-1"
      role="dialog"
      aria-labelledby="modelTitleId"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Modal title</h5>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">Body</div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-secondary"
              data-dismiss="modal"
            >
              Close
            </button>
            <button type="button" class="btn btn-primary">Save</button>
          </div>
        </div>
      </div>
    </div>
    <!-- End Update employee model  -->
  </div>
</template>

<script>
export default {
  created() {},
  mounted() {
    //   this.get_all_emp();
    //this.emp_del();
  },
  data() {
    return {
      search_keyword: "",

      id: "",
      first_name: "",
      last_name: "",
      address: "",
      email: "",
      nic: "",
      mobile: "",
      job_id: "",
      emp_data: {},
      all_emp_data: {},
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

    update_emp: function(id){

        $("#modelId").modal("show");
    },

  },
};
</script>

<style>
</style>
