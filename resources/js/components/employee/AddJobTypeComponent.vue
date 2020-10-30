<template>
  <div class="row">
    <div class="col-6">
      <div class="card">
        <img class="card-img-top" src="holder.js/100x180/" alt="" />
        <div class="card-body">
          <form action="" @submit.prevent="add_job()">
            <div class="form-group">
              <label for="form-control">Job Type</label>
              <input
                placeholder="Example:Doctor"
                class="form-control"
                type="text"
                v-model= "form.name"
              />
            </div>
            <button type="submit" class="btn btn-primary">Add Job Type</button>
          </form>
        </div>
      </div>
    </div>
    <div class="col-6">
      <table class="table">
        <thead>
          <tr>
            <th>#</th>
            <th width="75%">Job Type</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(job,index) in jobdata" :key="index">
            <td scope="row">{{ job.id }}</td>
            <td>{{ job.name }}</td>
            <td>
              <a style="cursor: pointer" href="#" @click="del_job(job.id)"
                ><i class="fa fa-trash text-danger mx-1"></i
              ></a>
            </td>
          </tr>
          <tr>
            <td scope="row"></td>
            <td></td>
            <td></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
export default {
  created() {},
  mounted() {
      this.get_job_list();
  },
  data() {
      return {
          form: new Form({
              id:"",
              name:"",
          }),

          jobdata:{},
      }

  },
  methods: {
       add_job: function(){
           this.form
           .post('/api/jobtype')
           .then((response) => {
               if(response.status == 200){
                  this.form.reset();
                   this.get_job_list();

               }
           })
           .catch((error) => {
               console.log(error);
           });

      },

      get_job_list: function(){
          axios
          .get('/api/jobtype')
          .then((response) => {
              if(response.status == 200){
                  this.jobdata = response.data;
              }
          })
          .catch((error) => {
              console.log(error);
          });
      },

      del_job: function(id){
          axios
          .delete('/api/jobtype/' + id)
          .then((response) => {
              if(response.status == 200){
                  this.response = response.data;
                  this.get_job_list();
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
