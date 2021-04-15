<template>
  <div>
    <div class="row">
      <div class="col-12">
        <div class="card">
          <img class="card-img-top" src="holder.js/100x180/" alt="" />
          <div class="card-body">
            <div class="form-group row">
              <div class="col-sm-4 col-lg-4 col-md-4">
                <label for="form-control">Full Name:</label>
                <input
                  type="text"
                  placeholder="Enter Full name"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('name') }"
                  v-model="form.name"
                />
                <has-error :form="form" field="name"></has-error>
              </div>
              <div class="col-sm-3 col-lg-3 col-md-3">
                <label for="form-control">Mobile:</label>
                <input
                  type="text"
                  placeholder="077*******"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('mobile') }"
                  v-model="form.mobile"
                />
                <has-error :form="form" field="mobile"></has-error>
              </div>
              <div class="col-sm-3 col-lg-3 col-md-3">
                <label for="form-control">Email</label>
                <input
                  type="text"
                  placeholder="example@gmail.com"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('email') }"
                  v-model="form.email"
                />
                <has-error :form="form" field="email"></has-error>
              </div>
              <div class="col-sm-2 col-lg-2 col-md-2">
                <label for="form-control">Age:</label>
                <input
                  type="text"
                  placeholder="Ex: 65"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('age') }"
                  v-model="form.age"
                />
                <has-error :form="form" field="age"></has-error>
              </div>
            </div>
            <div class="row">
              <div class="col-6">
                <label for="">Select Service Type :</label>
                <select
                  @change="selected_service"
                  v-model="form.service_type"
                  class="form-control"
                >
                  <option
                    v-for="(service, index) in service_list"
                    :key="index"
                    :value="service.id"
                  >
                    {{ service.name }}
                  </option>
                </select>
              </div>

              <div class="col-4">
                <label for="">Service Fee :</label>
                <input
                  v-model="service_fee.fee"
                  class="form-control"
                  type="text"
                  name=""
                  id=""
                />
              </div>

              <div class="col-2">
                <label for="">.</label>
                <button
                  @click="add_service"
                  class="form-control btn btn-primary"
                >
                  Add
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row mt-1">
      <div class="col-12">
        <div class="card">
          <img class="card-img-top" src="holder.js/100x180/" alt="" />
          <div class="card-body">
            <table class="table">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Service Name</th>
                  <th>Amount</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <tr
                  v-for="(service, index) in form.selected_service_list"
                  :key="index"
                >
                  <td scope="row">{{ service.id }}</td>
                  <td scope="row">{{ service.name }}</td>
                  <td scope="row">{{ service.fee }}</td>
                  <td scope="row">
                    <i
                      @click="delete_row(service)"
                      class="fa fa-trash text-danger icon-button mx-1"
                    ></i>
                  </td>
                </tr>
              </tbody>
            </table>

            <button class="form-control btn btn-primary" @click="submit_service">Submit</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {

    props:["user_id"],
  computed: {
    service_fee() {
      if (this.form.service_type) {
        const service = _.find(this.service_list, {
          id: this.form.service_type,
        });
        this.selected_service = service;
        return service;
      }

      return { fee: null };
    },
  },
  created() {
    this.get_service_list();
  },
  mounted() {},
  data() {
    return {
      form: new Form({
        name: "",
        mobile: "",
        email: "",
        age: "",
        service_type: "",
        selected_service_list: [],
        user_id:this.user_id,
      }),
      selected_service: {},
      // [{service_type: "eco_test", fee: 1999,}]
      service_list: {},
    };
  },

  methods: {
    add_service: function () {
      if (!_.isEmpty(this.selected_service)) {
        this.form.selected_service_list.push(this.selected_service);
        this.selected_service = {}; // clear the selected service
      }
    },
    delete_row: function (service) {
      const services = this.form.selected_service_list.filter(
        (s) => s.id != service.id
      );
      this.form.selected_service_list = services;
    },

    submit_service: function () {
        this.form.post("/api/submit_service")
        .then((response)=>{
            if(response.status == 200){

            }
        })
        .catch(()=>{
            console.log(error)
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
  },
};
</script>

<style>
</style>
