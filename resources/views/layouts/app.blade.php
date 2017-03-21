<!DOCTYPE html>
<html lang="en">

    @include('partials.head')

    <body>

        <div id="wrapper">

            @include('partials.navbar')

            <div id="page-wrapper">

                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">
                                @yield('page-header')
                                <!--<small>Statistics Overview</small>-->
                            </h1>
                            <!--                            <ol class="breadcrumb">
                                                            <li class="active">
                                    <i class="fa fa-dashboard"></i> Dashboard
                                </li>
                                                        </ol>-->
                        </div>
                    </div>
                    <!-- /.row -->

                    <div class="main-content">
                        @yield('content')
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- /#page-wrapper -->

        </div>
        <!-- /#wrapper -->

        @include('partials.scripts')

        @yield('scripts')

        @include('partials.notifications')

    </body>

</html>
