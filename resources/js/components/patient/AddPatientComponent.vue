<template>
  <div>
      <div class="col-12">
          <div class="card">
          <img class="card-img-top" src="holder.js/100x180/" alt="" />
          <div class="card-body">
            <form action="">
              <div class="form-group row">
                <div class="col-sm-4 col-lg-4 col-md-4">
                  <label for="form-control">Full Name:</label>
                  <input
                    type="text"
                    class="form-control"
                    v-model="form.name"
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
                <div class="col-sm-4 col-lg-4 col-md-4">
                  <label for="form-control">Email</label>
                  <input type="text" class="form-control" v-model="form.email" />
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
</template>

<script>
export default {};
</script>

<style>
</style>
