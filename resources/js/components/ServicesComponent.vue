<template>
  <div class="row">
    <div class="col-6">
      <div class="card">
        <img class="card-img-top" src="holder.js/100x180/" alt="" />
        <div class="card-body">
          <form action="" @submit.prevent="add_service()">
            <div class="form-group">
              <label for="form-control">Service Name</label>
              <input
                placeholder="Example: ECG"
                class="form-control"
                type="text"
                v-model="form.name"
              />
            </div>
            <div class="form-group">
              <label for="form-control">Service Fee</label>
              <input
                placeholder="Example: 2500.00"
                class="form-control"
                type="text"
                v-model="form.fee"
              />
            </div>
            <button type="submit" class="btn btn-primary">Add</button>
          </form>
        </div>
      </div>
    </div>
    <div class="col-6">
      <table class="table">
        <thead>
          <tr>
            <th>#</th>
            <th width="60%">Service Name</th>
            <th>Fee</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(list, index) in service_list" :key="index">
            <td scope="row">{{ list.id }}</td>
            <td>{{ list.name }}</td>
            <td>{{ list.fee }}</td>
            <td>
              <a style="cursor: pointer" href="#" @click="del_job(room.id)"
                ><i class="fa fa-edit text-danger mx-1"></i
              ></a>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
export default {
  created() {
    this.get_service_list();
  },
  mounted() {
    this.get_service_list();
  },
  data() {
    return {
      form: new Form({
          name:"",
          fee:"",
      }),

      service_list: {},
    };
  },
  methods: {
    add_service: function () {
      this.form
        .post("/api/add_service")
        .then((response) => {
          if (response.status == 200) {
            this.form.reset();
            swal.fire(response.data.msg);
            this.get_service_list();
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },

    get_service_list: function () {
      axios
        .get("/api/get_service_list")
        .then((response) => {
          if (response.status == 200) {
            this.service_list = response.data;
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },

    del_job: function (id) {
      axios
        .delete("/api/jobtype/" + id)
        .then((response) => {
          if (response.status == 200) {
            this.response = response.data;
            this.get_job_list();
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
