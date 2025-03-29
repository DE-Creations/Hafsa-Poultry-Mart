<x-app-layout>

    <div class="app-body">
        <!-- Container starts -->
        <div class="container">
            <!-- Row start -->
            <div class="row gx-3">
                <div class="col-12 col-xl-6">
                    <!-- Breadcrumb start -->
                    <ol class="breadcrumb mb-3">
                        <li class="breadcrumb-item">
                            <i class="icon-house_siding lh-1"></i>
                            <a href="index.html" class="text-decoration-none">Home</a>
                        </li>
                        <li class="breadcrumb-item">Dashboards</li>
                        <li class="breadcrumb-item">Analytics</li>
                    </ol>
                    <!-- Breadcrumb end -->
                </div>
            </div>
            <!-- Row end -->

            <div class="row">
                <div class="col-xl-6 col-sm-12 col-12">
                    <div class="space-y-6">
                        <div class="p-4 sm:p-8 card shadow sm:rounded-lg">
                            <div class="card-body">
                                @include('profile.partials.update-profile-information-form')
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-6 col-sm-12 col-12">
                    <div class="space-y-6">
                        <div class="p-4 sm:p-8 card shadow sm:rounded-lg">
                            <div class="card-body">
                                @include('profile.partials.update-password-form')
                            </div>
                        </div>
                    </div>
                </div>

                {{--  <div class="offset-xl-3 col-xl-6 col-sm-12 col-12">
                    <div class="space-y-6">
                        <div class="p-4 sm:p-8 card shadow sm:rounded-lg">
                            <div class="card-body">
                                @include('profile.partials.delete-user-form')
                            </div>
                        </div>
                    </div>
                </div>  --}}
            </div>
        </div>
        <!-- Container ends -->
    </div>

</x-app-layout>
