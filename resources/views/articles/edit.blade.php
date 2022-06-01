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
                  @if(session()->has('error'))
                  <div class="alert alert-danger alert-dismissible fade show" role="alert">
                      <strong>{{ session()->get('error') }}</strong>
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  @endif
                  <form action="{{route('articles.update','test')}}" method="POST" enctype="multipart/form-data">
                    {{method_field('patch')}}
                      @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label>category</label>
                            <?php $id = 0 ?>
                          <select class="form-control" required name="category" required>
                              {{-- {{dd($article->article_category)}} --}}
                                {{-- <option selected="true" disabled="disabled">choices</option> --}}
                                @if($article->article_category()->exists())
                                    
                                     @foreach($article->article_category as $value) 
                                       {{ $id = $value->id }}
                                       <option value="{{$value->id}}"> {{$value->title}} </option>
                                    @endforeach 

                                @endif
                                @foreach($category as $value)
                                    @if($value->id !== $id)
                                         <option value="{{$value->id}}">{{$value->title}}</option>
                                    @endif
                                @endforeach
                             
                          </select>
                        </div>
                        <div class="form-group">
                            <input class="form-control" value="{{$article->title}}" name="title" required placeholder="Title:">
                          </div>
                        <div class="form-group">
                            <textarea id="compose-textarea" name="desc" required class="form-control" style="height: 300px">
                                  {{$article->description}}
                            </textarea>
                        </div>
                        <div class="form-group">
                          <div class="btn btn-default btn-file">
                            <i class="fas fa-paperclip"></i> Images
                            <input type="file" accept="image/*" onchange="loadFile(event)" name="photo">
                            @if($article->image()->exists())
                            <img src="{{ URL::asset('Article/img/articles/'.$article->image->filename) }}"  width="100%" height="100%" id="output"/>
                            @endif
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <input class="form-control" value="{{$article->id}}" name="id" type="hidden">
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

<script>
    var loadFile = function(event) {
        var output = document.getElementById('output');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
            URL.revokeObjectURL(output.src) // free memory
        }
    };
</script>

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