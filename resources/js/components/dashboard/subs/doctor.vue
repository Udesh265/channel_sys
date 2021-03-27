<template>
  <div>
    <div class="col-12">
      <div class="card">
        <img class="card-img-top" src="holder.js/100x180/" alt="" />
        <div class="card-body">
          <div class="row">
            <div class="col-9">
              <input
                type="text"
                class="form-control"
                placeholder="Enter Barcode ID or NIC"
              />
            </div>
            <div class="col-3">
              <button type="button" class="form-control btn btn-success">
                Search Patient
              </button>
            </div>
          </div>
        </div>
      </div>
      <div v-if="">
        <div class="row mt-3">
          <div class="col-5">
            <div class="card bg-white">
              <img class="card-img-top" src="holder.js/100x180/" alt="" />
              <div class="card-body border-left border-success border-w-4">
                <div class="row">
                  <div class="col-9">
                    <h5>Patient Data</h5>
                  </div>
                </div>
                <div class="row mt-3">
                  <div class="col-3">
                    <h6>Name</h6>
                  </div>
                  <div class="col-1">
                    <h6>:</h6>
                  </div>
                  <div class="col-8"><h6>D.M.Udeshika Nilantha</h6></div>
                </div>
                <div class="row mt-2">
                  <div class="col-3">
                    <h6>Address</h6>
                  </div>
                  <div class="col-1">
                    <h6>:</h6>
                  </div>
                  <div class="col-8"><h6>Kandy</h6></div>
                </div>
                <div class="row mt-2">
                  <div class="col-3">
                    <h6>Age</h6>
                  </div>
                  <div class="col-1">
                    <h6>:</h6>
                  </div>
                  <div class="col-8"><h6>26</h6></div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-7">
            <div class="card bg-white rounded" style="height: 168px">
              <img class="card-img-top" src="holder.js/100x180/" alt="" />
              <div class="card-body border-left border-success border-w-4">
                <div class="row mb-3">
                  <div class="col-9">
                    <h5>Biometric Data</h5>
                  </div>
                  <div class="col-3">
                    <button
                      type="button"
                      class="form-control btn btn-primary"
                      style="color: white"
                    >
                      Update
                    </button>
                  </div>
                </div>
                <div class="row mt-3">
                  <div class="col-3"><h6>Weight : 25kg</h6></div>
                  <div class="col-3"><h6>Height : 162cm</h6></div>
                  <div class="col-3"><h6>B/P Lvl : 120mg</h6></div>
                  <div class="col-3"><h6>L/P : 195mg</h6></div>
                </div>
                <div class="row mt-2">
                  <div class="col-4"><h6>Primary Diseases:</h6></div>
                  <div class="col-8">
                    <h6>Diabetics , High Pressure, Asthma</h6>
                  </div>
                </div>
                <div class="row mt-2">
                  <div class="col-4"><h6>Others:</h6></div>
                  <div class="col-8">
                    <h6>Diabetics , High Pressure, Asthma</h6>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row mt-3">
          <div class="col-12">
            <div class="card shadow bg-white rounded">
              <div class="card-body">
                <div class="row mb-3">
                  <div class="col-9">
                    <h5>Patient Treatment History</h5>
                  </div>
                  <div class="col-3">
                    <button
                      type="button"
                      class="form-control btn btn-primary"
                      style="color: white"
                    >
                      Add New Record
                    </button>
                  </div>
                </div>
                <table class="table table-striped">
                  <thead class="thead-inverse">
                    <tr>
                      <th style="width: 70%">Description</th>
                      <th>Date</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr class="zoom">
                      <td>
                        Lorem ipsum dolor sit amet consectetur, adipisicing
                        elit. Veniam possimus sed laborum, atque at praesentium
                        itaque magnam minus magni, recusandae corrupti nemo,
                        error voluptatem accusantium consequuntur quam iusto qui
                        deserunt?
                      </td>
                      <td>2021-08-31</td>
                      <td>
                        <i
                          class="fa fa-eye text-success icon-button mx-1"
                          @click="modal_appointment_view(app)"
                        ></i>
                      </td>
                    </tr>
                    <tr class="zoom">
                      <td>
                        Lorem ipsum dolor sit amet consectetur, adipisicing
                        elit. Veniam possimus sed laborum, atque at praesentium
                        itaque magnam minus magni, recusandae corrupti nemo,
                        error voluptatem accusantium consequuntur quam iusto qui
                        deserunt?
                      </td>
                      <td>2021-08-31</td>
                      <td>
                        <i
                          class="fa fa-eye text-success icon-button mx-1"
                          @click="modal_appointment_view(app)"
                        ></i>
                      </td>
                    </tr>

                    <tr>
                      <td>
                        Lorem ipsum dolor sit amet consectetur, adipisicing
                        elit. Veniam possimus sed laborum, atque at praesentium
                        itaque magnam minus magni, recusandae corrupti nemo,
                        error voluptatem accusantium consequuntur quam iusto qui
                        deserunt?
                      </td>
                      <td>2021-08-31</td>
                      <td>
                        <i
                          class="fa fa-eye text-success icon-button mx-1"
                          @click="modal_appointment_view(app)"
                        ></i>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div class="row mt-3">
          <div class="col-12">
            <div class="card shadow bg-white rounded">
              <div class="card-body">
                <div class="row mb-3">
                  <div class="col-9">
                    <h5>Patient Laboraty Reports</h5>
                  </div>
                </div>
                <table class="table table-striped">
                  <thead class="thead-inverse">
                    <tr>
                      <th style="width: 70%">Description</th>
                      <th>Date</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr class="zoom">
                      <td>
                        Lorem ipsum dolor sit amet consectetur, adipisicing
                      </td>
                      <td>2021-08-31</td>
                      <td>
                        <i
                          class="fa fa-eye text-success icon-button mx-1"
                          @click="modal_appointment_view(app)"
                        ></i>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        Lorem ipsum dolor sit amet consectetur, adipisicing
                      </td>
                      <td>2021-08-31</td>
                      <td>
                        <i
                          class="fa fa-eye text-success icon-button mx-1"
                          @click="modal_appointment_view(app)"
                        ></i>
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
  </div>
</template>

<script>
export default {};
</script>

<style>
</style>
