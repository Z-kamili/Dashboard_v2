@extends('layouts.master')

@section('title')

Dashboard

@stop


@section('css')

@endsection


@section('title_page1')

Category

@endsection


@section('title_page2')

Add

@endsection

@section('content')
            <!-- general form elements -->
            <div class="container card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Quick Example</h3>
                </div>
                <!-- form start -->
                <form method="POST" action="{{route('category.store')}}">
                    @csrf
                  <div class="card-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">title</label>
                      <input type="text" name="title" class="form-control" id="exampleInputEmail1" required placeholder="Enter title">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Description</label>
                      <textarea  class="form-control" name="Desc" id="exampleFormControlTextarea1" required rows="3"></textarea>
                    </div>
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                </form>
            </div>
@endsection


@section('scripts')

<!-- jQuery -->
<script src={{URL::asset("assets/plugins/jquery/jquery.min.js")}}></script>
<!-- Bootstrap 4 -->
<script src={{URL::asset("assets/plugins/bootstrap/js/bootstrap.bundle.min.js")}}></script>
<!-- bs-custom-file-input -->
<script src={{URL::asset("assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js")}}></script>
<!-- AdminLTE App -->
<script src={{URL::asset("assets/dist/js/adminlte.min.js")}}></script>
<!-- AdminLTE for demo purposes -->
<script src={{URL::asset("assets/dist/js/demo.js")}}></script>

@endsection