<template>
  <div class="row">
    <div class="col-12">
      <div class="card">
        <img class="card-img-top" src="holder.js/100x180/" alt="" />
        <div class="card-body">
          <form action="" @submit.prevent="add_speciality()">
            <div class="row">
              <div class="col-6">
                <div class="form-group">
                  <label for="form-control">Job Type</label>
                  <input
                    placeholder="Example:Doctor"
                    class="form-control"
                    type="text"
                    v-model="form.name"
                  />
                </div>
              </div>
              <div class="col-4">
                <div class="form-group">
                  <label for="form-control"></label>
                  <button
                    type="submit"
                    class="btn btn-primary form-control mt-2"
                  >
                    Add Speciality
                  </button>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>Doctor Speciality Name</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(spec,index) in spec_data" :key="index">
                      <td>{{spec.name}}</td>
                      <td>

                        <a style="cursor: pointer" @click="delete_spec(spec.id)"
                          ><i
                            class="fa fa-trash text-danger icon-button mx-1"
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
</template>

<script>

export default {
  created() {
      this.get_spec();
  },
  mounted() {

  },

  data() {
    return {
      form: new Form({
        id: "",
        name: "",
      }),
      spec_data: {},
    };
  },

  methods: {
    add_speciality: function () {
      this.form
        .post("/api/doctor/addspeciality")
        .then((response) => {
          if (response.status == 200) {
            swal.fire(response.data.msg);
            this.get_spec();
            this.form.reset();
          }
        })
        .catch((error) => {
          console.log(error);
        });
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

  delete_spec: function(id){
      axios.delete(`/api/doctor/del/${id}`)
      .then((response)=>{
          if(response.status == 200){
              this.get_spec();
          }
      })
      .catch((error)=>{
          console.log(error);
      });
  },
}
}
</script>

<style>
</style>
