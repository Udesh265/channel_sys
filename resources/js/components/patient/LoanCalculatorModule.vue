<template>
    <div class="row">
        <div class="col-12 mt-3">
            <div class="card">
                <div
                    class="card-header d-flex justify-content-between align-items-center"
                >
                    <h4 class="card-title">Loan Calculation</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-3">
                            <label for="">Amount</label>
                            <input
                                class="form-control"
                                :class="{
                                    'is-invalid': hasError('Vprincipal')
                                }"
                                v-model="Vprincipal"
                                type="text"
                            />
                            <div
                                v-show="hasError('Vprincipal')"
                                class="help-block invalid-feedback"
                            >
                                Amount rate is required.
                            </div>
                        </div>

                        <div class="form-group col-3">
                            <label for="">Interest Type</label>
                            <select
                                class="form-control"
                                :class="{
                                    'is-invalid': hasError('Vinteresttype')
                                }"
                                v-model="Vinteresttype"
                            >
                                <option value="dc">Daily Cash Rate</option>
                                <option value="fx">Fixed Rate</option>
                                <option value="fl">Flat Rate</option>
                                <option value="rd" disabled
                                    >Reducing Balance</option
                                >
                            </select>
                            <div
                                v-show="hasError('Vinteresttype')"
                                class="help-block invalid-feedback"
                            >
                                Interest type is required.
                            </div>
                        </div>

                        <div class="form-group col-3">
                            <label for="">Interest Rate</label>
                            <input
                                class="form-control"
                                :class="{
                                    'is-invalid': hasError('interest_rate')
                                }"
                                v-model="interest_rate"
                                type="text"
                            />
                            <div
                                v-show="hasError('interest_rate')"
                                class="help-block invalid-feedback"
                            >
                                Interest rate is required.
                            </div>
                        </div>

                        <div class="form-group col-3">
                            <label for="">Loan Term</label>
                            <div class="row no-gutters">
                                <div class="col-4">
                                    <input
                                        class="form-control inline-block"
                                        :class="{
                                            'is-invalid': hasError('Vnum_years')
                                        }"
                                        v-model="Vnum_years"
                                        type="text"
                                        placeho
                                        lde
                                        r="Loan Term"
                                    />
                                    <div
                                        v-show="hasError('Vnum_years')"
                                        class="help-block invalid-feedback"
                                    >
                                        Term is required.
                                    </div>
                                </div>
                                <div class="col-8">
                                    <select
                                        :disabled="disableOnDailyCash"
                                        class="form-control inline-block"
                                        :class="{
                                            'is-invalid': hasError(
                                                'Vloantermtype'
                                            )
                                        }"
                                        v-model="Vloantermtype"
                                    >
                                        <option value="1">Years</option>
                                        <option value="12">Months</option>
                                        <option value="52">Weeks</option>
                                        <option value="365">Days</option>
                                    </select>
                                    <div
                                        v-show="hasError('Vloantermtype')"
                                        class="help-block invalid-feedback"
                                    >
                                        Term type is required.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-3">
                            <label for="">Repayment Schedule</label>
                            <select
                                :disabled="disableOnDailyCash"
                                class="form-control"
                                :class="{
                                    'is-invalid': hasError('Vppy')
                                }"
                                v-model="Vppy"
                            >
                                <option value="1">Annually</option>
                                <option value="12">Monthly</option>
                                <option value="52">Weekly</option>
                                <option value="365">Daily</option>
                            </select>
                            <div
                                v-show="hasError('Vppy')"
                                class="help-block invalid-feedback"
                            >
                                Repayment schedule is required.
                            </div>
                        </div>

                        <div class="form-group col-3">
                            <label for="">First Date</label>
                            <input
                                class="form-control"
                                :class="{
                                    'is-invalid': hasError('Vfirstdate')
                                }"
                                v-model="Vfirstdate"
                                type="date"
                            />
                            <div
                                v-show="hasError('Vfirstdate')"
                                class="help-block invalid-feedback"
                            >
                                First date is required.
                            </div>
                        </div>

                        <div class="form-group col-6">
                            <button
                                class="btn btn-block btn-primary"
                                style="margin-top: 5%;"
                                @click="gettotal()"
                            >
                                Calculate
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 mt-3">
            <div class="card">
                <div
                    class="card-header d-flex justify-content-between align-items-center"
                >
                    <h4 class="card-title">Estimated Calculations</h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th>Interest Rate</th>
                                <td>{{ display.interest_rate }} %</td>
                            </tr>
                            <tr>
                                <th>Receivable Interest</th>
                                <td>{{ display.total_interest | currency }}</td>
                            </tr>
                            <tr>
                                <th>Installment Amount</th>
                                <td>
                                    {{ display.installment_amount | currency }}
                                </td>
                            </tr>
                                <tr>
                                <th>Installment Interest Amount</th>
                                <td>
                                    {{ display.installment_interest_amount | currency }}
                                </td>
                            </tr>
                            <tr>
                                <th>Total Payable</th>
                                <td>{{ display.total_payable | currency }}</td>
                            </tr>
                            <tr>
                                <th>Number Of Payments</th>
                                <td>{{ display.number_of_payments }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    mounted() {
        let date = moment()
            .add(7, "days")
            .format("YYYY-MM-DD");
        this.Vfirstdate = date;
    },
    data() {
        return {
            Vprincipal: "",
            interest_rate: "",
            Vnum_years: "",
            Vppy: "",
            Vloantermtype: "",

            Vinteresttype: "",
            Vfirstdate: "",

            display: {
                interest_rate: 0,
                total_interest: 0,
                installment_amount: 0,
                total_payable: 0,
                number_of_payments: 0,
                installment_interest_amount: 0
            },

            errors: {}
        };
    },
    methods: {
        formatPrice(value) {
            let val = (value / 1).toFixed(2);
            return val;
        },
        validateInputs: function() {
            if (
                this.Vprincipal &&
                this.interest_rate &&
                this.Vnum_years &&
                this.Vppy &&
                this.Vloantermtype &&
                this.Vinteresttype &&
                this.Vfirstdate
            ) {
                this.errors = {};
                return true;
            }

            this.errors = {};

            if (!this.Vprincipal) {
                this.errors["Vprincipal"] = "Amount rate is required";
            }

            if (!this.interest_rate) {
                this.errors["interest_rate"] = "Interest rate is required";
            }

            if (!this.Vnum_years) {
                this.errors["Vnum_years"] = "Term is required";
            }

            if (!this.Vppy) {
                this.errors["Vppy"] = "Repayment schedule is required";
            }

            if (!this.Vloantermtype) {
                this.errors["Vloantermtype"] = "Term type is required";
            }

            if (!this.Vinteresttype) {
                this.errors["Vinteresttype"] = "Interest type is required";
            }

            if (!this.Vfirstdate) {
                this.errors["Vfirstdate"] = "First date is required";
            }

            this.$emit("calculate", "");
        },
        hasError: function(value) {
            return this.errors.hasOwnProperty(value);
        },
        gettotal: async function() {
            let validation = this.validateInputs();
            if (!validation) return;

            let result;

            if (this.Vinteresttype == "fx") {
                result = await this.calculateFixedRateInterest(
                    this.Vprincipal,
                    this.interest_rate,
                    this.Vnum_years,
                    this.Vppy,
                    this.Vloantermtype,
                    this.Vfirstdate
                );
            } else if (this.Vinteresttype == "fl") {
                result = await this.calculateFlatRateInterest(
                    this.Vprincipal,
                    this.interest_rate,
                    this.Vnum_years,
                    this.Vppy,
                    this.Vloantermtype,
                    this.Vfirstdate
                );
            } else if (this.Vinteresttype == "dc") {
                result = await this.calculateDailyCashRate(
                    this.Vprincipal,
                    this.interest_rate,
                    this.Vnum_years,
                    this.Vppy,
                    this.Vloantermtype,
                    this.Vfirstdate
                );
            }

            this.display.interest_rate = this.interest_rate;
            this.display.total_interest = result.total_interest_payable;
            this.display.installment_amount =
                result.installment_amount_with_interest;
            this.display.total_payable = result.total_payable_with_interest;
            this.display.number_of_payments = result.number_of_payments;
            this.display.installment_interest_amount = result.interest_per_installment;

            this.$emit("calculate", result);
        },
        getRepaymentTypeVariable: function(value) {
            switch (value) {
                case "1":
                    return "y";
                    break;

                case "12":
                    return "m";
                    break;

                case "52":
                    return "w";
                    break;

                case "365":
                    return "d";
                    break;
            }
        },
        calculateFlatRateInterest: function(
            Vprincipal,
            interest,
            Vnum_years,
            Vppy,
            Vloantermtype,
            Vfirstdate
        ) {
            //Interest rate
            let interest_rate = interest / 100;

            //Number of payments
            let num_pmts = (Vnum_years * Vppy) / Vloantermtype;
            num_pmts = Math.round(num_pmts);
            if (num_pmts == 0) {
                num_pmts = 1;
            }

            //Interest only
            let io =
                Number(Vprincipal) * (Number(interest_rate) / Number(Vppy));

            //Total interest
            let total_interest = (io * Vppy * Vnum_years) / Vloantermtype;

            //Total payable
            let total_payable = Number(total_interest) + Number(Vprincipal);

            //Installment Amount with interest
            let installment =
                Number(io) + Number(Vprincipal) / Number(num_pmts);

            return {
                principal_amount: this.formatPrice(Vprincipal),
                number_of_payments: num_pmts,
                installment_without_interest: this.formatPrice(
                    Vprincipal / num_pmts
                ),
                interest_per_installment: this.formatPrice(io),
                installment_amount_with_interest: this.formatPrice(installment),
                total_interest_payable: this.formatPrice(total_interest),
                total_payable_with_interest: this.formatPrice(total_payable),
                interest_type: "fl",
                interest_rate: interest_rate,
                repayment_schedule: this.getRepaymentTypeVariable(Vppy),
                first_date: Vfirstdate
            };
        },
        calculateFixedRateInterest: function(
            Vprincipal,
            interest,
            Vnum_years,
            Vppy,
            Vloantermtype,
            Vfirstdate
        ) {
            //Interest rate
            let interest_rate = interest / 100;

            //Number of payments
            let num_pmts = (Vnum_years * Vppy) / Vloantermtype;
            num_pmts = Math.round(num_pmts);
            if (num_pmts == 0) {
                num_pmts = 1;
            }

            //Interest only
            let io = Number(Vprincipal) * Number(interest_rate);

            //Total interest
            let total_interest = (io * Vppy * Vnum_years) / Vloantermtype;

            //Total payable
            let total_payable = Number(total_interest) + Number(Vprincipal);

            //Installment Amount with interest
            let installment =
                Number(io) + Number(Vprincipal) / Number(num_pmts);

            return {
                principal_amount: this.formatPrice(Vprincipal),
                number_of_payments: num_pmts,
                installment_without_interest: this.formatPrice(
                    Vprincipal / num_pmts
                ),
                interest_per_installment: this.formatPrice(io),
                installment_amount_with_interest: this.formatPrice(installment),
                total_interest_payable: this.formatPrice(total_interest),
                total_payable_with_interest: this.formatPrice(total_payable),
                interest_type: "fx",
                interest_rate: interest_rate,
                repayment_schedule: this.getRepaymentTypeVariable(Vppy),
                first_date: Vfirstdate
            };
        },
        calculateDailyCashRate: function(
            Vprincipal,
            interest,
            Vnum_years,
            Vppy,
            Vloantermtype,
            Vfirstdate
        ) {
            //Interest rate
            let interest_rate = interest / 100;

            //Number of payments
            let num_pmts = (Vnum_years * Vppy) / Vloantermtype;
            num_pmts = Math.round(num_pmts);
            if (num_pmts == 0) {
                num_pmts = 1;
            }

            //Interest only
            let io = Number(Vprincipal) * Number(interest_rate);

            //Total interest
            let total_interest = (io / 25) * num_pmts;

            //Total payable
            let total_payable = Number(total_interest) + Number(Vprincipal);

            //Installment Amount with interest
            let installment =
                (Number(io) / 25) + Number(Vprincipal) / Number(num_pmts);

            return {
                principal_amount: this.formatPrice(Vprincipal),
                number_of_payments: num_pmts,
                installment_without_interest: this.formatPrice(
                    Vprincipal / num_pmts
                ),
                interest_per_installment: this.formatPrice(installment - (Vprincipal / num_pmts)),
                installment_amount_with_interest: this.formatPrice(installment),
                total_interest_payable: this.formatPrice(total_interest),
                total_payable_with_interest: this.formatPrice(total_payable),
                interest_type: "dc",
                interest_rate: interest_rate,
                repayment_schedule: "d",
                first_date: Vfirstdate
            };
        }
    },
    computed: {
        disableOnDailyCash: function() {
            if (this.Vinteresttype == "dc") {
                this.Vppy = 365;
                this.Vloantermtype = 365;
                return true;
            } else {
                return false;
            }
        }
    }
};
</script>
