<div class="sidebar">
    <div class="site-width">

        <!-- START: Menu-->
        <ul id="side-menu" class="sidebar-menu">
            <li class="dropdown"><a href="#"><i class="icon-home mr-1"></i> Dashboard</a>
                <ul>
                    <li class="{{ $page_option['sub'] === 'dash' ? 'active' : '' }}"><a
                            href="{{ route('home') }}"><i class="fa fa-rocket"></i> Dashboard</a></li>
                    <li><a href="index-account.html"><i class="icon-layers"></i> My Account</a></li>
                </ul>
            </li>

            <li class="dropdown"><a href="#"><i class="icon-home mr-1"></i> Appointment</a>
                <ul>
                    <li class="{{ $page_option['sub'] === 'new_appointment' ? 'active' : '' }}"><a
                            href="{{ route('appointment.create') }}"><i class="fa fa-rocket"></i> New Appointment</a>
                    </li>
                    <li><a href="{{ route('appointment.view') }}"><i class="icon-layers"></i>View Appointment</a></li>
                </ul>
            </li>
            <li class="dropdown"><a href="#"><i class="icon-home mr-1"></i> Lab Tests</a>
                <ul>
                    <li class="{{ $page_option['sub'] === 'new_lab_test' ? 'active' : '' }}">
                        <a href="{{ route('lab.new_appointment') }}"><i class="fa fa-rocket"></i> Lab Test
                            Appointment</a>
                    </li>
                    {{-- <li><a href="{{ route('appointment.view') }}"><i class="icon-layers"></i> Appointment</a></li> --}}
                    <li class="{{ $page_option['sub'] === 'lab_report' ? 'active' : '' }}"><a
                            href="{{ route('lab.report') }}"><i class="icon-layers"></i>Lab Report</a></li>


                </ul>
            </li>

            <li class="dropdown"><a href="#"><i class="icon-home mr-1"></i> Laboraty Service</a>
                <ul>
                    <li class="{{ $page_option['sub'] === 'overview' ? 'active' : '' }}">
                        <a href="{{ route('lab.overview') }}"><i class="fa fa-rocket"></i>Overview</a>
                    </li>
                    <li><a href="{{ route('lab.overview') }}"><i class="icon-layers"></i>Summery</a></li>
                </ul>
            </li>

            @if (Auth::user()->can('user_management_create') || Auth::user()->can('user_management_view') || Auth::user()->can('user_management_update') || Auth::user()->can('user__management_delete') || Auth::user()->can('role_management_create') || Auth::user()->can('role_management_view') || Auth::user()->can('role_management_update') || Auth::user()->can('role_management_delete'))

                <li class="dropdown"><a href="#"><i class="icon-organization mr-1"></i>Permissions & Users</a>
                    <ul>
                        @if (Auth::user()->can('role_management_management_create') || Auth::user()->can('role_management_view') || Auth::user()->can('role_management_update') || Auth::user()->can('role_management_delete'))

                            <li class="dropdown {{ $page_option['main'] === 'permission' ? 'active' : '' }}"><a
                                    href="#"><i class="fas fa-sitemap"></i>Roles & Permissions</a>
                                <ul class="sub-menu">
                                    <li class="{{ $page_option['sub'] === 'permission_index' ? 'active' : '' }}"><a
                                            href="{{ route('permission.index') }}">Manage</a>
                                    </li>
                                </ul>
                            </li>
                        @endif
                        @if (Auth::user()->can('user_management_create') || Auth::user()->can('user_management_view') || Auth::user()->can('user_management_update') || Auth::user()->can('user_management_delete'))
                            <li class="dropdown {{ $page_option['main'] === 'user' ? 'active' : '' }}"><a href="#"><i
                                        class="fas fa-user-tie"></i> Users</a>
                                <ul class="sub-menu">
                                    <li class="{{ $page_option['sub'] === 'user_create' ? 'active' : '' }}"><a
                                            href="{{ route('user.create') }}">Create New User</a>
                                    </li>
                                    <li class="{{ $page_option['sub'] === 'user_index' ? 'active' : '' }}"><a
                                            href="{{ route('user.index') }}">View All Users</a>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif


            @if (Auth::user()->can('employee_management_create') || Auth::user()->can('employee_management_view') || Auth::user()->can('employee_management_update') || Auth::user()->can('employee_management_delete'))

                <li class="dropdown"><a href="#"><i class="icon-organization mr-1"></i>Employee Management</a>
                    <ul>
                        <li class="dropdown {{ $page_option['main'] === 'employee' ? 'active' : '' }}"><a href="#"><i
                                    class="fas fa-sitemap"></i>Employee</a>
                            <ul class="sub-menu">
                                <li class="{{ $page_option['sub'] === 'employee_create' ? 'active' : '' }}"><a
                                        href="{{ route('employee.create') }}">Add Employee</a>
                                </li>
                                <li class="{{ $page_option['sub'] === 'employee_manage' ? 'active' : '' }}"><a
                                        href="{{ route('employee.manage_emp') }}">Manage</a>
                                </li>
                                <li class="{{ $page_option['sub'] === 'jobtype_create' ? 'active' : '' }}"><a
                                        href="{{ route('jobtype.create') }}">Job Type</a>
                                </li>
                            </ul>
                        </li>

                        <li class="dropdown {{ $page_option['main'] === 'user' ? 'active' : '' }}"><a href="#"><i
                                    class="fas fa-user-tie"></i>Attendence</a>
                            <ul class="sub-menu">
                                <li class="{{ $page_option['sub'] === 'user_create' ? 'active' : '' }}"><a
                                        href="{{ route('user.create') }}">View</a>
                                </li>
                                <li class="{{ $page_option['sub'] === 'user_index' ? 'active' : '' }}"><a
                                        href="{{ route('user.index') }}">Manage</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
            @endif

            @if (Auth::user()->can('patient_management_create') || Auth::user()->can('patient_management_view') || Auth::user()->can('patient_management_update') || Auth::user()->can('patient_management_delete'))
                <li class="dropdown"><a href="#"><i class="icon-organization mr-1"></i>Patient Management</a>
                    <ul>
                        <li class="dropdown {{ $page_option['main'] === 'patient' ? 'active' : '' }}"><a href="#"><i
                                    class="fas fa-sitemap"></i>Patient</a>
                            <ul class="sub-menu">
                                <li class="{{ $page_option['sub'] === 'add_patient' ? 'active' : '' }}"><a
                                        href="{{ route('patient.add_patient') }}">Add Patient</a>
                                </li>
                                <li class="{{ $page_option['sub'] === 'patient_manage' ? 'active' : '' }}"><a
                                        href="{{ route('patient.manage_patient') }}">Manage</a>
                                </li>
                                <li class="{{ $page_option['sub'] === 'jobtype_create' ? 'active' : '' }}"><a
                                        href="{{ route('jobtype.create') }}">Job Type</a>
                                </li>
                            </ul>
                        </li>

                        <li class="dropdown {{ $page_option['main'] === 'user' ? 'active' : '' }}"><a href="#"><i
                                    class="fas fa-user-tie"></i>Attendence</a>
                            <ul class="sub-menu">
                                <li class="{{ $page_option['sub'] === 'user_create' ? 'active' : '' }}"><a
                                        href="{{ route('user.create') }}">View</a>
                                </li>
                                <li class="{{ $page_option['sub'] === 'user_index' ? 'active' : '' }}"><a
                                        href="{{ route('user.index') }}">Manage</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
            @endif

            <li class="dropdown"><a href="#"><i class="icon-organization mr-1"></i>Schedule Management</a>
                <ul>
                    <li class="dropdown {{ $page_option['main'] === 'schedule' ? 'active' : '' }}"><a href="#"><i
                                class="fas fa-sitemap"></i>Schedule</a>
                        <ul class="sub-menu">
                            <li class="{{ $page_option['sub'] === 'add_schedule' ? 'active' : '' }}"><a
                                    href="{{ route('schedule.add_schedule') }}">Add Schedule</a>
                            </li>
                            {{-- <li class="{{ $page_option['sub'] === 'patient_manage' ? 'active' : '' }}"><a
                            href="{{ route('schedule.manage') }}">Manage</a>
                    </li> --}}

                        </ul>
                    </li>
                </ul>
            </li>

            {{-- @if (Auth::user()->can('user_management_create') || Auth::user) --}}
            <li class="dropdown"><a href="#"><i class="icon-organization mr-1"></i>Doctors Management</a>
                <ul>
                    <li class="dropdown {{ $page_option['main'] === 'doctor' ? 'active' : '' }}"><a href="#"><i
                                class="fas fa-sitemap"></i>Doctors</a>
                        <ul class="sub-menu">



                            <li class="{{ $page_option['sub'] === 'employee_manage' ? 'active' : '' }}"><a
                                    href="{{ route('employee.manage_emp') }}">Manage</a>
                            </li>



                        </ul>
                    </li>
                </ul>
            </li>


            <li class="dropdown"><a href="#"><i class="icon-home mr-1"></i> Settings</a>
                <ul>
                    <li class="{{ $page_option['sub'] === 'add_speciality' ? 'active' : '' }}"><a
                            href="{{ route('doctor.speciality') }}"><i class="fa fa-rocket"></i> Add Doctors
                            Speciality</a></li>
                    <li><a href="{{ route('lab.add_reports_type') }}"><i class="icon-layers"></i>Add Report Types</a>
                    </li>
                    <li><a href="{{ route('appointment.add_rooms') }}"><i class="icon-layers"></i>Add Rooms</a>
                    </li>
                    <li class="{{ $page_option['sub'] === 'system_time' ? 'active' : '' }}"><a
                            href="{{ route('system.time') }}"><i class="icon-layers"></i>Work Place Time</a>
                    </li>
                </ul>
            </li>


            <li class="dropdown"><a href="#"><i class="icon-home mr-1"></i> Reception </a>
                <ul>
                    <li class="dropdown {{ $page_option['main'] === 'cashier' ? 'active' : '' }}"><a href="#"><i
                                class="fas fa-sitemap"></i>Cashier</a>
                        <ul class="sub-menu">
                            <li class="{{ $page_option['sub'] === 'doctor_appointment' ? 'active' : '' }}"><a
                                    href="{{ route('cashier.doc_app') }}">Doctor Appointments</a>
                            </li>
                            <li class="{{ $page_option['sub'] === 'add_schedule' ? 'active' : '' }}"><a
                                href="{{ route('schedule.add_schedule') }}">Lab Appointments</a>
                            </li>
                            <li class="{{ $page_option['sub'] === 'add_schedule' ? 'active' : '' }}"><a
                                href="{{ route('schedule.add_schedule') }}">Services</a>
                            </li>


                        </ul>
                    </li>
                    <li class="{{ $page_option['sub'] === 'waiting_online_payment' ? 'active' : '' }}"><a
                        href="{{ route('appointment.waitpayment') }}"><i class="icon-layers"></i>Waiting Online Payment</a>
                </li>
                <li class="{{ $page_option['sub'] === 'check_doc' ? 'active' : '' }}"><a
                    href="{{ route('appointment.check_doc') }}"><i class="icon-layers"></i>Check Doctors Avaiablility</a>
            </li>

                </ul>
            </li>

            <li class="dropdown"><a href="#"><i class="icon-organization mr-1"></i>Attendance</a>
                <ul>
                    <li class="{{ $page_option['sub'] === 'attendance' ? 'active' : '' }}"><a
                            href="{{ route('employee.attendance') }}"><i class="icon-layers"></i>Attendance</a>
                    </li>
                </ul>
            </li>




        </ul>
        <!-- END: Menu-->
        <ol class="breadcrumb bg-transparent align-self-center m-0 p-0 ml-auto">
            <li class="breadcrumb-item"><a href="#">Application</a></li>
            <li class="breadcrumb-item active">Blank Page</li>
        </ol>
    </div>
</div>
