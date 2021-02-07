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

            <li class="dropdown"><a href="#"><i class="icon-organization mr-1"></i>Permissions & Users</a>
                <ul>
                    <li class="dropdown {{ $page_option['main'] === 'permission' ? 'active' : '' }}"><a href="#"><i
                                class="fas fa-sitemap"></i>Roles & Permissions</a>
                        <ul class="sub-menu">
                            <li class="{{ $page_option['sub'] === 'permission_index' ? 'active' : '' }}"><a
                                    href="{{ route('permission.index') }}">Manage</a>
                            </li>
                        </ul>
                    </li>
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
                </ul>
            </li>

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
                    <li class="dropdown {{ $page_option['main'] === 'doctor' ? 'active' : '' }}"><a href="#"><i
                                class="fas fa-sitemap"></i>Doctors</a>
                        <ul class="sub-menu">

                            <li class="{{ $page_option['sub'] === 'employee_manage' ? 'active' : '' }}"><a
                                    href="{{ route('employee.manage_emp') }}">Manage</a>
                            </li>
                            <li class="{{ $page_option['sub'] === 'add_speciality' ? 'active' : '' }}"><a
                                href="{{ route('doctor.speciality') }}">Add Speciality</a>
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
        </ul>
        <!-- END: Menu-->
        <ol class="breadcrumb bg-transparent align-self-center m-0 p-0 ml-auto">
            <li class="breadcrumb-item"><a href="#">Application</a></li>
            <li class="breadcrumb-item active">Blank Page</li>
        </ol>
    </div>
</div>
