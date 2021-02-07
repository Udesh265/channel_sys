<template>
  <div class="row">
    <div class="col-6">
      <div class="card">
        <img class="card-img-top" src="holder.js/100x180/" alt="" />
        <div class="card-body">
          <form action="" @submit.prevent="add_speciality()">
            <div class="form-group">
              <label for="form-control">Job Type</label>
              <input
                placeholder="Example:Doctor"
                class="form-control"
                type="text"
                v-model="form.name"
              />
            </div>
            <button type="submit" class="btn btn-primary">Add Speciality</button>
          </form>
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
        return {
            form : new Form({
                id:"",
                name:"",
            }),
        }
    },
    methods: {
        add_speciality: function(){
            this.form.post("/api/doctor/addspeciality")
            .then((response)=>{
                if(response.status == 200){
                    swal.fire(response.data.msg);
                }
            })
            .catch((error)=>{
                console.log(error);
            });
        },
    },
};
</script>

<style>
</style>
