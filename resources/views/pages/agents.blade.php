@extends('layouts.main')

@section('title', 'Agent')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Agent</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    

                    <!-- Modal -->
                    @php
                        function children($data)
                        {
                            if ($data->children->count() > 0) {
                            }
                            echo '<ul>';
                            foreach ($data->children as $child) {
                                echo "<li>{$child->id}, {$child->name}</li>";
                                children($child);
                            }
                            echo '</ul>';
                        }
                    @endphp
                    @foreach ($models as $model)
                                        <li>{{$model->id}}, {{$model->name}}</li>
                                        @php
                                            children($model);
                                        @endphp
                    @endforeach
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<footer class="main-footer">
    <div class="float-right d-none d-sm-block">
        <b>Version</b> 3.2.0
    </div>
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
</footer>


@endsection