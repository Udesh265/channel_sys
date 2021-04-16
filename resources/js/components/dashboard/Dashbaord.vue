<template>
  <div>

      <PatientDash :user_id="this.user_id" v-if="$can('dashboard_management_view')" />
      <DoctorDash :user_id="this.user_id" v-if="$can('doctordash_management_view')"/>

  </div>
</template>

<script>
import PatientDash from "./subs/patient"
import DoctorDash from "./subs/doctor"
export default {
    props:["user_id"],
    components: {
        PatientDash,
        DoctorDash,

    },
    data: () => ({
    })
}
</script>

<style>

</style>
