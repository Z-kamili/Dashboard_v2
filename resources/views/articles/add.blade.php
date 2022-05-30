@extends('layouts.master')

@section('title')

Article

@stop


@section('css')
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('assets/dist/css/adminlte.min.css')}}">
@endsection


@section('title_page1')

Home  

@endsection


@section('title_page2')

article

@endsection

@section('content')
    
      <!-- Content Wrapper. Contains page content -->
      <div>
        <!-- Main content -->
        <section class="content">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-3">
                <a href="{{route('articles.index')}}" class="btn btn-primary btn-block mb-3">Back</a>
    
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Folders</h3>
    
                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                      </button>
                    </div>
                  </div>
                  <div class="card-body p-0">
                    <ul class="nav nav-pills flex-column">
                      <li class="nav-item active">
                        <a href="#" class="nav-link">
                          <i class="fas fa-inbox"></i> Inbox
                          <span class="badge bg-primary float-right">12</span>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="#" class="nav-link">
                          <i class="far fa-envelope"></i> Sent
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="#" class="nav-link">
                          <i class="far fa-file-alt"></i> Drafts
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="#" class="nav-link">
                          <i class="fas fa-filter"></i> Junk
                          <span class="badge bg-warning float-right">65</span>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="#" class="nav-link">
                          <i class="far fa-trash-alt"></i> Trash
                        </a>
                      </li>
                    </ul>
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Labels</h3>
    
                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                      </button>
                    </div>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body p-0">
                    <ul class="nav nav-pills flex-column">
                      <li class="nav-item">
                        <a class="nav-link" href="#"><i class="far fa-circle text-danger"></i> Important</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="#"><i class="far fa-circle text-warning"></i> Promotions</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="#"><i class="far fa-circle text-primary"></i> Social</a>
                      </li>
                    </ul>
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->
              </div>
              <!-- /.col -->
              <div class="col-md-9">
                <div class="card card-primary card-outline">
                  <div class="card-header">
                    <h3 class="card-title">Create New Articles</h3>
                  </div>
                  <!-- /.card-header -->
                  <form action="{{route('articles.store')}}" method="POST">
                      @csrf
                    <div class="card-body">
                        <div class="form-group">
                          <input class="form-control" name="title" required placeholder="Title:">
                        </div>
                        <div class="form-group">
                            <textarea id="compose-textarea" name="desc" required class="form-control" style="height: 300px">
                           
                            </textarea>
                        </div>
                        <div class="form-group">
                          <div class="btn btn-default btn-file">
                            <i class="fas fa-paperclip"></i> Images
                            <input type="file" required name="files">
                          </div>
                        </div>
                      </div>
                      <!-- /.card-body -->
                      <div class="card-footer">
                        <div class="float-right">
                          <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                      </div>
                  </form>

                  <!-- /.card-footer -->
                </div>
                <!-- /.card -->
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
      </div>
    <!-- ./wrapper -->

@endsection


@section('scripts')

<!-- ./wrapper -->

<!-- jQuery -->
<script src={{URL::asset("assets/plugins/jquery/jquery.min.js")}}></script>
<!-- Bootstrap 4 -->
<script src={{URL::asset("assets/plugins/bootstrap/js/bootstrap.bundle.min.js")}}></script>
<!-- AdminLTE App -->
<script src={{URL::asset("assets/dist/js/adminlte.min.js")}}></script>
<!-- Summernote -->
<script src={{URL::asset("assets/plugins/summernote/summernote-bs4.min.js")}}></script>
<!-- AdminLTE for demo purposes -->
<script src={{URL::asset("assets/dist/js/demo.js")}}></script>
<!-- Page specific script -->
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script type="text/javascript" src={{URL::asset("assets/js/pages/dashboard.js")}}></script>
<script>
  $(function () {
    //Add text editor
    $('#compose-textarea').summernote()
  })
</script>

@endsection