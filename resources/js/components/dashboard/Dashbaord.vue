<template>
  <div>

      <PatientDash v-if="$can('dashboard_management_view')" />

  </div>
</template>

<script>
import PatientDash from "./subs/patient"
import DoctorDash from "./subs/doctor"
export default {
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
