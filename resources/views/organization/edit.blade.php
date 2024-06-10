<!DOCTYPE html>
<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed layout-compact" dir="ltr" data-theme="theme-default" data-assets-path="assets/" data-template="vertical-menu-template">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>Edit Organisation Details</title>
    <meta name="description" content="" />
    @include('super_admin.header')
    <link rel="stylesheet" href="{{ asset('assets/flatpickr/flatpickr.css')}}" />
    <style type="text/css">
        .add_parent .btn-primary {
            background-color: #e00814 !important;
            border-color: #e00814 !important;
        }

        .add_parent .app-brand-logo.demo {
            width: auto !important;
            height: auto !important;
        }

        .add_parent .form-check-input:checked,
        .add_parent .form-check-input[type=checkbox]:indeterminate {
            background-color: #e00814 !important;
            border-color: #e00814 !important;
        }

        .add_parent .form-check-input:focus {
            border-color: #e00814 !important;
        }

        .add_parent .bg-primary {
            background-color: #e00814 !important;
        }

        .add_parent .bg-menu-theme .menu-inner .menu-item.active>.menu-link.menu-toggle,
        .add_parent .layout-menu-hover.layout-menu-collapsed .bg-menu-theme .menu-inner .menu-item.active>.menu-link.menu-toggle,
        .add_parent .bg-menu-theme .menu-inner .menu-item.active>.menu-link.menu-toggle,
        .add_parent .bg-menu-theme.menu-vertical .menu-item.active>.menu-link:not(.menu-toggle) {
            background: linear-gradient(72.47deg, #e00814 22.16%, rgb(224, 8, 20, 0.7) 76.47%) !important;
            color: #ffffff !important;
        }

        .add_parent .menu-vertical .app-brand {
            margin: 20px 0.875rem 20px 1rem;
        }

        .add_parent i {
            font-size: 17px !important;
        }

        #half_logo {
            display: none;
        }

        .layout-menu-collapsed .half_logo {
            margin-left: 3px !important;
        }

        .layout-navbar-fixed .layout-page:before {
            background: #0000000d;
            mask: none;
        }

        .add_parent #template-customizer .template-customizer-open-btn {
            display: none;
        }

        .add_org .form-label {
            font-size: 17px;
        }
    </style>
</head>

<body class="add_parent">
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->
            @include('super_admin.sidebar')
            <!-- / Menu -->
            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->
                @include('super_admin.navbar')
                <!-- / Navbar -->
                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div class="d-flex flex-column justify-content-center">
                            <h4 class="mb-1 mt-3" style="color: #e00814;">Edit Organisation Details</h4>
                        </div>
                        <!-- Add Product -->
                        <form method="POST" action={{route('organization_update');}} enctype="multipart/form-data">
                            @csrf
                            <p style="height: 2px;"></p>
                            <div class="row add_org">
                                <!-- Flat Picker -->
                                @if(session()->has('message'))
                                <div class="alert alert-success">
                                    {{ session()->get('message') }}
                                </div>
                                @endif
                                @if (session()->has('error'))
                                <div class="alert alert-danger">
                                    {{ session()->get('error') }}
                                </div>
                                @endif
                                <div class="col-12 mb-4 col-lg-8 col-xl-8">
                                    <div class="card">
                                        <div class="card-body">
                                            @if($errors->any())
                                            @foreach($errors->all() as $error)
                                            <div class="alert alert-danger">
                                                {{ $error }}
                                            </div>
                                            @endforeach
                                            @endif
                                            <div class="row">
                                                <!-- Range Picker-->
                                                <div class="col-md-6 col-lg-12 col-xl-12 col-12 mb-4">
                                                    <input type="text" class="form-control" placeholder="YYYY-MM-DD to YYYY-MM-DD" id="flatpickr-range" style="display:none;" />
                                                    <div class="mb-3">
                                                        <label for="defaultFormControlInput" class="form-label">Name</label><span class="text-danger">*</span>
                                                        <input type="text" class="form-control" name="name" id="defaultFormControlInput" value="{{ $data->name; }}" placeholder="Name" aria-describedby="defaultFormControlHelp" />
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="exampleFormControlInput1" class="form-label">Email address</label><span class="text-danger">*</span>
                                                        <input type="email" class="form-control" name="email" id="exampleFormControlInput1" value="{{ $data->email; }}" placeholder="name@example.com" />
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="bs-rangepicker-single" class="form-label">Start Date</label><span class="text-danger">*</span>
                                                        <input type="text" id="flatpickr-date1" name="start_date" class="form-control" value="{{!empty($data->start_date)?$data->start_date->format('d/m/Y'):NULL; }}" placeholder="DD-MM-YYYY" />
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="bs-rangepicker-single" class="form-label">End Date</label><span class="text-danger">*</span>
                                                        <input type="text" id="flatpickr-date2" name="end_date" class="form-control" value="{{!empty($data->end_date)?$data->end_date->format('d/m/Y'):NULL; }}" placeholder="DD-MM-YYYY" />
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="org_color" class="form-label" style="padding-right: 10px;">Color</label>
                                                        <input class="form-control" type="color" name="color" value="{{ $data->color; }}" id="org_color" />
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="formFile" class="form-label">Logo</label>
                                                        <input class="form-control" type="file" name="logo" id="formFile" />
                                                        <input type="hidden" name="id" id="id" value="{{ $data->id; }}" />
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="address" class="form-label">Address</label><span class="text-danger">*</span>
                                                        <textarea class="form-control" id="address" name="address" rows="3">{{  $data->address }}</textarea>
                                                        @error('address')
                                                        <p class="text-danger">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="defaultFormControlInput" class="form-label">VAT No</label><span class="text-danger">*</span>
                                                        <input type="text" class="form-control" name="vat_no" value="{{ $data->vat_no }}" id="defaultFormControlInput" placeholder="VAT No" aria-describedby="defaultFormControlHelp" />
                                                        @error('vat_no')
                                                        <span style="color:red;">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="defaultFormControlInput" class="form-label">Contact No</label><span class="text-danger">*</span>
                                                        <input type="text" class="form-control" name="contact_no" value="{{  $data->contact_no }}" id="defaultFormControlInput" placeholder="Contact No" aria-describedby="defaultFormControlHelp" />
                                                        @error('contact_no')
                                                        <span style="color:red;">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                               <!--suspension msg-->
                               <?php  $sus_count = $suspensions->count();
                                if( $sus_count >0 )
                                {
                                ?>
                                <div class="col-12 mb-4 col-lg-4 col-xl-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="mb-1 mt-3" style="color: #e00814;">Suspension Details</h5>
                                            <table id="example" data-order='[[ 0, "desc" ]]' class="display nowrap" style="width:100%">
                                                <thead>
                                                 <tr>
                                                    <!-- <th>ID</th> -->
                                                    <th>Reason</th>
                                                    <th> Date</th>
                                                   </tr>
                                                </thead>
                                                <tbody>


                                                    <?php foreach ($suspensions as $suspension) {
                                                       echo '<tr>';
                                                    //    echo '<td>' . $suspension->id . '</td>';
                                                       echo '<td title="'.$suspension->suspension_reason.'" style="cursor: pointer;" data-bs-toggle="tooltip">' . mb_strimwidth($suspension->suspension_reason,0,20,'...') . '</td>';
                                                       echo '<td>' . $suspension->suspension_date . '</td>';
                                                        echo '</tr>';
                                                     } ?>


                                                </tbody>
                                             </table>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>
                                <!--suspension msg-->
                                <p style="height: 2px;"></p>
                                <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-3">
                                    <div class="d-flex align-content-center flex-wrap gap-3">
                                        <div class="d-flex gap-3">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                            <a href="{{ route('organization_list') }}" class="btn btn-label-secondary">Discard</a>
                                        </div>

                                    </div>
                                </div>
                        </form>
                        <!-- /Flatpickr -->
                        <!-- Color Picker -->
                        <!-- /Color Picker-->
                    </div>
                </div>
                <!-- / Content -->
                <!-- Footer -->

                <!-- / Footer -->
                <div class="content-backdrop fade"></div>
            </div>
            <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
    </div>
    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>
    <!-- Drag Target Area To SlideIn Menu On Small Screens -->
    <div class="drag-target"></div>
    </div>
    <!-- / Layout wrapper -->
    @include('super_admin.footer')
    <script src="{{ asset('assets/flatpickr/flatpickr.js')}}"></script>
    <script src="{{ asset('assets/js/forms-pickers.js')}}"></script>
    <script type="text/javascript">
        new DataTable('#example', {
        scrollX: true
        });
     </script>
</body>

</html>
