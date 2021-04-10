<template>
  <div class="row">
    <div class="col-6">
      <div class="card">
        <img class="card-img-top" src="holder.js/100x180/" alt="" />
        <div class="card-body">
          <form action="" @submit.prevent="add_room()">
            <div class="form-group">
              <label for="form-control">Room Name</label>
              <input
                placeholder="Example: Room No:1"
                class="form-control"
                type="text"
                v-model="form.name"
              />
            </div>
            <button type="submit" class="btn btn-primary">Add Room</button>
          </form>
        </div>
      </div>
    </div>
    <div class="col-6">
      <table class="table">
        <thead>
          <tr>
            <th>#</th>
            <th width="75%">Room Name</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(room,index) in room_list" :key="index">
            <td scope="row">{{ room.id }}</td>
            <td>{{ room.room_name }}</td>
            <td>
              <a style="cursor: pointer" href="#" @click="del_job(room.id)"
                ><i class="fa fa-edit text-danger mx-1"></i
              ></a>
            </td>
          </tr>

        </tbody>
      </table>
    </div>
  </div>
</template>

<script>

export default {
  created() {
         this.get_room_list();
  },
  mounted() {
       this.get_room_list();
  },
  data() {
      return {
          form: new Form({
              id:"",
              room_name:"",
          }),

          room_list:{},

      }

  },
  methods: {
       add_room: function(){
           this.form
           .post('/api/add_room')
           .then((response) => {
               if(response.status == 200){
                  this.form.reset();
                    swal.fire(response.data.msg);
                    this.get_room_lis();

               }
           })
           .catch((error) => {
               console.log(error);
           });

      },

      get_room_list: function(){
          axios
          .get('/api/room_list')
          .then((response) => {
              if(response.status == 200){
                  this.room_list = response.data;
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
