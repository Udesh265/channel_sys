<template>
  <div>
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-lg-12">
            <div class="p-5">
              <!-- Credit card form tabs -->
              <ul
                role="tablist"
                class="nav bg-light nav-pills rounded-pill nav-fill mb-3"
              >
                <li class="nav-item">
                  <a
                    data-toggle="pill"
                    href="#nav-tab-card"
                    class="nav-link active rounded-pill"
                  >
                    <i class="fa fa-credit-card"></i>
                    Credit Card
                  </a>
                </li>
                <li class="nav-item">
                  <a
                    data-toggle="pill"
                    href="#nav-tab-paypal"
                    class="nav-link rounded-pill"
                  >
                    <i class="fa fa-paypal"></i>
                    Paypal
                  </a>
                </li>
                <li class="nav-item">
                  <a
                    data-toggle="pill"
                    href="#nav-tab-bank"
                    class="nav-link rounded-pill"
                  >
                    <i class="fa fa-university"></i>
                    Bank Transfer
                  </a>
                </li>
              </ul>
              <!-- End -->

              <!-- Credit card form content -->
              <div class="tab-content">
                <!-- credit card info-->
                <div id="nav-tab-card" class="tab-pane fade show active">
                  <form role="form">
                    <div class="form-group">
                      <label for="username">Full name (on the card)</label>
                      <input
                        v-model="form.name"
                        type="text"
                        name="username"
                        placeholder="Jassa"
                        class="form-control"
                      />
                    </div>
                    <div class="form-group">
                      <label for="cardNumber">Card number</label>
                      <div class="input-group">
                        <input
                          v-model="form.card"
                          type="text"
                          name="cardNumber"
                          placeholder="Your card number"
                          class="form-control"
                        />
                        <div class="input-group-append">
                          <span class="input-group-text text-muted">
                            <i class="fa fa-credit-card mx-1"></i>
                            <i class="fa fa-money-check mx-1"></i>
                            <i class="fa fa-money-check-alt mx-1"></i>
                          </span>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-8">
                        <div class="form-group">
                          <label
                            ><span class="hidden-xs">Expiration</span></label
                          >
                          <div class="input-group">
                            <input
                              v-model="form.month"
                              type="number"
                              placeholder="MM"
                              name=""
                              class="form-control"
                              required
                            />
                            <input
                              v-model="form.year"
                              type="number"
                              placeholder="YY"
                              name=""
                              class="form-control"
                              required
                            />
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="form-group mb-4">
                          <label
                            title="Three-digits code on the back of your card"
                            >CVV
                            <i class="fa fa-question-circle"></i>
                          </label>
                          <input
                            v-model="form.cvv"
                            type="text"
                            required
                            class="form-control"
                          />
                        </div>
                      </div>
                    </div>
                    <button
                      @click="submit_payment()"
                      type="button"
                      class="btn btn-primary btn-block"
                    >
                      Confirm Payment
                    </button>
                  </form>
                </div>
                <!-- End -->

                <!-- Paypal info -->
                <div id="nav-tab-paypal" class="tab-pane fade">
                  <p>Paypal is easiest way to pay online</p>
                  <p>
                    <button type="button" class="btn btn-primary rounded-pill">
                      <i class="fa fa-paypal mr-2"></i> Log into my Paypal
                    </button>
                  </p>
                  <p class="text-muted">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                    sed do eiusmod tempor incididunt ut labore et dolore magna
                    aliqua.
                  </p>
                </div>
                <!-- End -->

                <!-- bank transfer info -->
                <div id="nav-tab-bank" class="tab-pane fade">
                  <h6>Bank account details</h6>
                  <dl>
                    <dt>Bank</dt>
                    <dd>Sampath Bank - Kandy Brach</dd>
                  </dl>
                  <dl>
                    <dt>Account number</dt>
                    <dd>117775877975</dd>
                  </dl>
                  <dl>
                    <dt>IBAN</dt>
                    <dd>CZ7775877975656</dd>
                  </dl>
                  <p class="text-muted">
                    Please send your bank slip to our email.
                    payments@nawaminichanneling.com
                  </p>
                </div>
                <!-- End -->
              </div>
              <!-- End -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["p_id"],
  mounted() {
    console.log(this.p_id);
  },
  data() {
    return {
      form: new Form({
        name: "",
        card: "",
        month: "",
        year: "",
        cvv: "",
        pay_id: this.p_id,
      }),
    };
  },
  methods: {
    submit_payment: function () {
      this.id = this.form.pay_id;
      console.log(this.id);
      axios
        .patch("/api/appointment/online_payment/" + this.id)
        .then((response) => {
          if (response.status == 200) {
            swal
              .fire({
                position: "middle",
                icon: "success",
                title: response.data.msg,
                showConfirmButton: false,
                timer: 1500,
              })
              .then(() => {

                window.location.href = 'view_appointment';
              });
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
