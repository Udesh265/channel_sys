<template>
  <div>
    <div class="row">
      <div class="col-12">
        <div class="card">
          <img class="card-img-top" src="holder.js/100x180/" alt="" />
          <div class="card-body">
            <form action="">
              <div class="form-group row">
                <div class="col-sm-4 col-lg-4 col-md-4">
                  <label for="form-control">First Name:</label>
                  <input type="text" class="form-control" />
                </div>
                <div class="col-sm-4 col-lg-4 col-md-4">
                  <label for="form-control">Last Name:</label>
                  <input type="text" class="form-control" />
                </div>
                <div class="col-sm-4 col-lg-4 col-md-4">
                  <label for="form-control">NIC:</label>
                  <input type="text" class="form-control" />
                </div>
              </div>
              <div class="form-group mt-3 row">
                <div class="col-sm-4 col-lg-4 col-md-4">
                  <label for="form-control">Email:</label>
                  <input type="text" class="form-control" />
                </div>
                <div class="col-sm-4 col-lg-4 col-md-4">
                  <label for="form-control">Mobile:</label>
                  <input type="text" class="form-control" />
                </div>
                <div class="col-sm-4 col-lg-4 col-md-4">
                  <label for="form-control">Job Type:</label>
                  <select class="form-control" id="exampleFormControlSelect1">
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                  </select>
                </div>
              </div>
              <div class="form-group mt-3 row">
                <div class="col-sm-4 col-lg-4 col-md-4">
                  <label for="form-control">Adddress:</label>
                  <textarea class="form-control" rows="3"></textarea>
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
    <!-- <div class="row">
      <div class="col-lg-12 col-md-12">
        <div class="card">
          <img class="card-img-top" src="holder.js/100x180/" alt="" />
          <div class="card-body">
            <h4 class="card-title">Assign User</h4>

            <table class="table table-responsive">
              <thead class="thead-inverse">
                <tr>
                  <th width="10%">Id</th>
                  <th width="40%">Name</th>
                  <th width="40%">NIC</th>
                  <th width="10%">Action</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td scope="row">1</td>
                  <td>ssdd</td>
                  <td>dssdsds</td>
                  <td>dssdsds</td>
                </tr>
                <tr>
                  <td scope="row">1</td>
                  <td>ssdd</td>
                  <td>dssdsds</td>
                  <td>dssdsds</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div> -->

    <div class="row">
      <div class="col-12">
        <div class="card">
          <div
            class="card-header d-flex justify-content-between align-items-center"
          >
            <h4 class="card-title">Assign User</h4>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th width="10%" scope="col">#</th>
                    <th width="20%" scope="col">Employee Name</th>
                    <th width="60%" scope="col">NIC</th>
                    <th width="10%" scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">1</th>
                    <td>Udesh</td>
                    <td>942442017v</td>
                    <td style="text-align: center"><!----></td>
                  </tr>

                  <tr>
                    <th scope="row">2</th>
                    <td>manager</td>
                    <td>942442017v</td>
                    <td style="text-align: center">
                      <a style="cursor: pointer"
                        ><i class="fa fa-eye text-success mx-1"></i
                      ></a>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  created() {},
  mounted() {},
  data() {},
  methods: {},
};
</script>

<style>
</style>
