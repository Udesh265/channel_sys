<template>
  <div>
    <div class="row">
      <div class="col-12 col-sm-6 col-xl-4 mt-3">
        <div class="card">
          <div class="card-body text-info border-bottom border-info border-w-5">
            <h2 class="text-center">{{ active_emp_count }}</h2>
            <h6 class="text-center">Active Employees</h6>
          </div>
        </div>
      </div>
      <div class="col-12 col-sm-6 col-xl-4 mt-3">
        <div class="card">
          <div
            class="card-body text-success border-bottom border-success border-w-5"
          >
            <h2 class="text-center">{{ suspended_emp_count }}</h2>
            <h6 class="text-center">Suspended Employees</h6>
          </div>
        </div>
      </div>
      <div class="col-12 col-sm-6 col-xl-4 mt-3">
        <div class="card">
          <div
            class="card-body text-danger border-bottom border-danger border-w-5"
          >
            <h2 class="text-center">{{ active_user_count }}</h2>
            <h6 class="text-center">Active Users</h6>
          </div>
        </div>
      </div>
    </div>
    <div class="row mt-2">
      <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="card">
          <div
            class="card-header d-flex justify-content-between align-items-center"
          >
            <h4 class="card-title">Employee Management Overview</h4>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-3">
                From :
                <input
                  v-model="t_from"
                  class="form-control"
                  type="date"
                  name=""
                  id=""
                />
              </div>
              <div class="col-3">
                To :
                <input
                  v-model="t_to"
                  class="form-control"
                  type="date"
                  name=""
                  id=""
                />
              </div>
              <div class="col-3">
                Job Role :
                <select v-model="role_id" class="form-control">
                  <option
                    v-for="(role, index) in job_role_data"
                    :key="index"
                    :value="role.name"
                  >
                    {{ role.name }}
                  </option>
                </select>
              </div>
              <div class="col-2">
                .
                <button
                  v-if="
                    this.t_from != '' && this.t_to != '' && this.role_id != '' "
                  @click="get_filtered_emp_list"
                  class="form-control btn btn-success"
                  name=""
                  id=""
                >
                  Filter
                </button>
              </div>
              <div class="col-1">
                .
                <button
                  v-if="
                    this.t_from != '' && this.t_to != '' && this.role_id != ''
                  "
                  @click="emp_list"
                  class="form-control btn btn-danger"
                  type="date"
                  name=""
                  id=""
                >
                  reset
                </button>
              </div>
            </div>
            <table class="table mt-2">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>NIC</th>
                  <th>Mobile</th>
                  <th>Job Role</th>
                  <th>Reg.Date</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(emp, index) in selected_emp_list" :key="index">
                  <td scope="row">{{ emp.id }}</td>
                  <td>{{ emp.first_name }}</td>
                  <td>{{ emp.nic }}</td>
                  <td>{{ emp.mobile }}</td>
                  <td>{{ emp.job.name }}</td>
                  <td>{{ emp.created_at | myDate }}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  created() {
    this.get_active_emp_count();
    this.get_suspended_emp_count();
    this.get_active_user_count();
    this.emp_list();
    this.get_jobrole();
  },
  mounted() {
    //   this.get_filtered_emp_list();
  },
  data() {
    return {
      active_emp_count: "",
      suspended_emp_count: "",
      active_user_count: "",

      emp_data: {},
      job_role_data: {},
      selected_emp_list:{},
    //   selected_emp_list

      t_to: "",
      t_from: "",
      role_id: "",

    };
  },
  methods: {
    get_active_emp_count: function () {
      axios
        .get("/api/reports/get_active_emp_count")
        .then((response) => {
          if (response.status) {
            this.active_emp_count = response.data;
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
    get_suspended_emp_count: function () {
      axios
        .get("/api/reports/get_suspended_emp_count")
        .then((response) => {
          if (response.status) {
            this.suspended_emp_count = response.data;
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
    get_active_user_count: function () {
      axios
        .get("/api/reports/get_active_user_count")
        .then((response) => {
          if (response.status) {
            this.active_user_count = response.data;
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
    emp_list: function () {
      axios
        .get("/api/reports/get_all_emp")
        .then((response) => {
          if (response.status == 200) {
              this.selected_emp_list = response.data;
            this.emp_data = response.data;
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
    get_jobrole: function () {
      axios
        .get("/api/reports/get_job_role")
        .then((response) => {
          if (response.status == 200) {
            this.job_role_data = response.data;
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },

    get_filtered_emp_list: function () {
      const lists = this.emp_data;
      const role = this.job_role_data;

      const to = new Date(this.t_to).getTime();
      const from = new Date(this.t_from).getTime();

      const filtered_list = lists.filter((list)=>{
          const reg_date = new Date(list.created_at).getTime();
          const role = list.job.name;

          if(reg_date <= to && reg_date >= from){
            //    console.log(true);
               if(role == this.role_id){
                    console.log(true);
                   return true;
               }

          }
          return false;
      });

     if(filtered_list.length === 0){
           swal.fire("No Records Found on this range");
     }

     this.selected_emp_list = filtered_list;

    },
  },
};
</script>

<style>
</style>
