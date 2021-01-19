/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');


//vForms
import { Form, HasError, AlertError } from 'vform';
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)
window.Form = Form;

//File64
import File64 from 'vue-file64';
Vue.component('file-dialog', File64);


//Moment JS
import moment from 'moment';
Vue.filter('myDate', function (date) {
    return moment(date).format("MMM Do YYYY");
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

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

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
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
