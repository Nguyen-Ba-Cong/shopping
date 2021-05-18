@extends('layouts.admin')

@section('title')
<title>Update Menu</title>
@endsection
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @include('partials.content-header',['name' => 'Menu', 'key' => 'Edit' ])
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
            <div class="col-md-6">
                    <form action = "{{route('menus.update',['id'=>$menu->id])}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label>Tên Menu:</label>
                            <input type="text" value="{{$menu->name}}" name = "name" class="form-control" placeholder="Nhập tên menu">
                        </div>
                        <div class="form-group">
                            <label>Chọn menu cha</label>
                            <select class="form-control" name = "parent_id">
                                <option value="0">Chọn menu cha</option>
                                {{!!$htmlOption!!}}
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Edit</button>
                    </form>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
@endsection