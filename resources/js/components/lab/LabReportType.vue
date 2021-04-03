<template>
  <div>
    <div class="row">
      <div class="col-12">
        <div class="card">
          <img class="card-img-top" src="holder.js/100x180/" alt="" />
          <div class="card-body">
            <form action="" @submit.prevent="add_report_type()">
              <div class="row">
                <div class="col-6">
                  <div class="form-group">
                    <label for="form-control">Report Type :</label>
                    <input
                      placeholder="Type Report types "
                      class="form-control"
                      type="text"
                      v-model="form.report_type"
                    />
                  </div>
                </div>
                <div class="col-4">
                  <div class="form-group">
                    <label for="form-control">Fee:</label>
                    <input
                      placeholder="Type Report types "
                      class="form-control"
                      type="text"
                      v-model="form.fee"
                    />
                  </div>
                </div>
                <div class="col-2">
                  <div class="form-group">
                    <label for="form-control"></label>
                    <button
                      type="submit"
                      class="btn btn-primary form-control mt-2"
                      style="color: white"
                    >
                      Add
                    </button>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-12">
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th>Report Type</th>
                        <th>Fee</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="(data, index) in type_data" :key="index">
                        <td>{{ data.report_type }}</td>
                        <td>{{ data.fee }}</td>
                        <td>
                          <a
                            @click="load_update_modal(data)"
                            style="cursor: pointer"
                            ><i
                              class="fa fa-edit text-danger icon-button mx-1"
                            ></i
                          ></a>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- Update lab report type-->

    <!-- Modal -->
    <div
      class="modal fade"
      id="load_modal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="modelTitleId"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header" style="background-color: #1e3d73">
            <h5 class="modal-title" style="color: white">Update Report Type</h5>
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
            <div class="col-12">
              <div class="card">
                <img class="card-img-top" src="holder.js/100x180/" alt="" />
                <div class="card-body">
                  <form action="" @submit.prevent="update_record()">
                    <div class="row">
                      <div class="col-6">
                        <div class="form-group">
                          <label for="form-control">Report Type :</label>
                          <input
                            placeholder="Type Report types "
                            class="form-control"
                            type="text"
                            v-model="form.report_type"
                          />
                        </div>
                      </div>
                      <div class="col-4">
                        <div class="form-group">
                          <label for="form-control">Fee:</label>
                          <input
                            placeholder="Type Report types "
                            class="form-control"
                            type="text"
                            v-model="form.fee"
                          />
                        </div>
                      </div>
                      <div class="col-2">
                        <div class="form-group">
                          <label for="form-control"></label>
                          <button
                            type="submit"
                            class="btn btn-primary form-control mt-2"
                            style="color: white"
                          >
                            Update
                          </button>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- end modal  -->
  </div>
</template>

<script>
export default {
  created() {
    this.get_type();
  },
  mounted() {},

  data() {
    return {
      form: new Form({
        id: "",
        report_type: "",
        fee: "",
      }),
      type_data: {},
    };
  },

  methods: {
    load_update_modal: function (data) {
      $("#load_modal").modal("show");
      this.form.fill(data);
      console.log(data.id);
    },

    add_report_type: function () {
      this.form
        .post("/api/lab/add_report_type")
        .then((response) => {
          if (response.status == 200) {
            swal.fire(response.data.msg);
            this.get_type();
            this.form.reset();
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },

    get_type: function () {
      axios
        .get("/api/lab/get_all")
        .then((response) => {
          if (response.status == 200) {
            this.type_data = response.data;
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },

    update_record: function () {
      this.id = this.form.id;
      this.form
        .patch("/api/lab/update/" + this.id)
        .then((response) => {
          if (response.status == 200) {
            this.get_type();
            $("#load_modal").modal("hide");
            this.form.reset();
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
