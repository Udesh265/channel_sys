<template>
  <div>

      <PatientDash :user_id="this.user_id" v-if="$can('dashboard_management_view')" />
      <DoctorDash :user_id="this.user_id" v-if="$can('doctordash_management_view')"/>
      <LabDash :user_id="this.user_id" v-if="$can('labdashboard_management_view')"/>
      <ManagerDash :user_id="this.user_id" v-if="$can('managerdashboard_management_view')"/>

  </div>
</template>

<script>
import PatientDash from "./subs/patient"
import DoctorDash from "./subs/doctor"
import LabDash from "./subs/lab"
import ManagerDash from "./subs/manager"
export default {
    props:["user_id"],
    components: {
        PatientDash,
        DoctorDash,
        LabDash,
        ManagerDash,

    },
    data: () => ({
    })
}
</script>

<style>

</style>
