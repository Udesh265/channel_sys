/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

// Permission Mixins
import Permission from "./mixins/Permission.vue"
Vue.mixin(Permission);

//vForms
import { Form, HasError, AlertError } from 'vform';
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)
window.Form = Form;

//apex chart
import VueApexCharts from 'vue-apexcharts'
Vue.use(VueApexCharts)

Vue.component('apexchart', VueApexCharts)

// Vue Barcode
import Barcode from "vue-barcode";
Vue.component("vue-barcode", Barcode);

// vCard QR Code Generator
import vCard from "vue-vcard";
Vue.component("vue-vcard", vCard);

//File64
import File64 from 'vue-file64';
Vue.component('file-dialog', File64);

// Vue2 TimePicker
import VueTimepicker from "vue2-timepicker";
Vue.component("timepicker", VueTimepicker);

// Vue Simple Calender
import { CalendarView, CalendarViewHeader } from "vue-simple-calendar";
Vue.component("calendar-view", CalendarView);
Vue.component("calendar-view-header", CalendarViewHeader);

//Moment JS
import moment from 'moment';
window.moment = moment;

Vue.filter('myDate', function (date) {
    return moment(date).format("MMM Do YYYY");
});

Vue.filter("calenderDate", function(date) {
    return moment(date).format("YYYY-MM-DD");
});

Vue.filter('currency', function (amount) {
    let val = 'Rs. ' + (amount / 1).toFixed(2);
    return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
});


Vue.filter('billDate', function (date) {
    return moment(date).format("DD-MM-YYYY H:mm");
});

//SweetAlert
import Swal from 'sweetalert2'
window.swal = Swal;

const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
  onOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
})

window.Toast = Toast;

//Vue New Instance
window.Fire = new Vue();

//Laravel Vue Pagination
Vue.component('pagination', require('laravel-vue-pagination'));

//vue printer module

import VueHtmlToPaper from 'vue-html-to-paper';
const options = {
  name: '_blank',
  specs: [
    'fullscreen=yes',
    'titlebar=yes',
    'scrollbars=yes'
  ],
  styles: [
    'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css',
    'https://unpkg.com/kidlat-css/css/kidlat.css'
  ]
}
Vue.use(VueHtmlToPaper, options);
// or, using the defaults with no stylesheet
Vue.use(VueHtmlToPaper);



/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('dashboard-component', require('./components/dashboard/Dashbaord.vue').default);

//Permission Components
Vue.component('permission-component', require('./components/PermissionComponent.vue').default);
Vue.component('role-based-permission', require('./components/RolePermissionComponent.vue').default);
Vue.component('new-user-component' , require('./components/NewUserComponent.vue').default);
Vue.component('profile-view-component', require('./components/ProfileComponent.vue').default);
Vue.component('add-employee-component', require('./components/employee/AddEmployeeComponent.vue').default);
Vue.component('add-job-component', require('./components/employee/AddJobTypeComponent.vue').default);
Vue.component('manage-emp-component', require('./components/employee/ManageEmployeeComponent.vue').default);
Vue.component('add-patient-component', require('./components/patient/AddPatientComponent.vue').default);
Vue.component('manage-patient-component', require('./components/patient/ManagePatientComponent.vue').default);
Vue.component('add-schedule-component', require('./components/schedule/AddScheduleComponent.vue').default);
Vue.component('add-doctor-speciality',require('./components/doctor/AddSpecialityComponent.vue').default);
Vue.component('add-patient-online-component', require('./components/patient/AddpatientOnlineComponent.vue').default);
Vue.component('new-appointment-component',require('./components/appointment/NewAppointmentComponent.vue').default);
Vue.component('view-appointment-component',require('./components/appointment/ViewAppointmentComponent.vue').default);
Vue.component('online-payment-component',require('./components/appointment/OnlinePaymentComponent.vue').default);
Vue.component('lab-test-appointment-component',require('./components/lab/LabTestAppointmentComponent.vue').default);
Vue.component('lab-report-type-component',require('./components/lab/LabReportType.vue').default);
Vue.component('laboraty-overview-component',require('./components/lab/LaboratyOverviewComponent.vue').default);
Vue.component('add-room-component',require('./components/schedule/AddRoomComponent.vue').default);
Vue.component('lab-report-component',require('./components/lab/laboraty_report.vue').default);
Vue.component('add-workplacetime-component',require('./components/WorkPlaceTimeComponent.vue').default);
Vue.component('mark-attendance-component',require('./components/MarkAttendanceComponent.vue').default);
Vue.component('wait-online-payment-component',require('./components/appointment/WaitingOnlinePaymentComponent.vue').default);
Vue.component('check-doctors-component',require('./components/appointment/CheckDoctorsComponent.vue').default);
Vue.component('rep-doctor-appointment-component',require('./components/appointment/cashier/RepDoctorAppComponent.vue').default);
Vue.component('view-all-appointment-component',require('./components/appointment/cashier/ViewAllAppointment.vue').default);
Vue.component('view-all-lab-app-component',require('./components/appointment/cashier/ViewAllLabAppointment.vue').default);
Vue.component('service-component',require('./components/ServicesComponent.vue').default);
Vue.component('new-service-component',require('./components/appointment/cashier/NewServiceComponent.vue').default);
Vue.component('visiting-doc-salary-component',require('./components/report/PayVisitingDoctorSalaryComponent.vue').default);

Vue.component('employee-report-component',require('./components/report/EmployeeManagementReportComponent.vue').default);
Vue.component('patient-report-component',require('./components/report/PatientManagementReportComponent.vue').default);
Vue.component('appointment-mgt-component',require('./components/report/TopAppointmentListReportComponent.vue').default);
Vue.component('top-lab-appointment-report-component',require('./components/report/TopLabAppointmentListComponent.vue').default);

Vue.component('lab-appointment-list-report-component',require('./components/report/LabAppointmentList.vue').default);
Vue.component('income-statement-report-component',require('./components/report/IncomeStatementReport.vue').default);
Vue.component('top-service-report-component',require('./components/report/TopServiceListComponent.vue').default);
Vue.component('service-list-component',require('./components/report/ServiceListComponent.vue').default);












/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
