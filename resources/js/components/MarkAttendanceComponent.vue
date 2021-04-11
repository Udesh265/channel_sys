<template>
  <div>
    <div class="col-12 mt-5">
      <div class="card" style="height:200px">
        <img class="card-img-top" src="holder.js/100x180/" alt="" />
            <div class="card-header">
       <h4> Mark Attendance </h4>
    </div>
        <div class="card-body">
          <div class="row mt-5">
            <div class="col-9">
              <input
                type="text"
                class="form-control"
                placeholder="Enter Barcode ID or Employee ID"
                v-model="attendance_value"
              />
            </div>
            <div class="col-3">
              <button
                @click="mark_attendance()"
                type="button"
                class="form-control btn btn-success"
              >
                Mark Attendance
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
    created(){

    },
    mounted(){

    },
    data(){
        return{
            attendance_value:"",
        }
    },
    methods:{
        mark_attendance: function(){
            if (this.attendance_value == null || this.attendance_value == "")
            {
                    swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "EMployee number or barcode is required!"
                    });
                    this.isBusy = false;
                    return;
                }
            axios.post(`/api/attendance/mark_attendance/${this.attendance_value}?time=${moment().format("LTS")}`)
            .then((response)=>{
            if (response.status == 200) {
                    Toast.fire({
                        icon: "success",
                        title: response.data.message
                    });
                    this.attendance_value = "";
                    // this.getCustomDateResults();
                }
                this.isBusy = false;
            })
            .catch ((error)=>{
                Toast.fire({
                    icon: "error",
                    title: error.data.message
                })
            });
        }
    }
};
</script>

<style>
</style>

