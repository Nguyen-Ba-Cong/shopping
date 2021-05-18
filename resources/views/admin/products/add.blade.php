@extends('layouts.admin')

@section('css')
<meta name="csrf-token" content="{{ csrf_token() }}">

<link href="{{asset('vendor/select2/select2.min.css')}}" rel="stylesheet" />
<link href="{{asset('admin/product/add/add.css')}}" rel="stylesheet" />
<link rel="stylesheet" href="{{ asset('vendor/file-manager/css/file-manager.css') }}">




@endsection
@section('title')
<title>Add Product</title>
@endsection
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @include('partials.content-header',['name' => 'Product', 'key' => 'Add' ])
    <!-- /.content-header -->

    <!-- Main content -->
    <form action="" method="post" enctype="multipart/form-data">
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">

                        @csrf
                        <div class="form-group">
                            <label>Tên sản phẩm:</label>
                            <input type="text" name="name" class="form-control" placeholder="Nhập tên sản phấm">
                        </div>
                        <div class="form-group">
                            <label>Giá sản phẩm:</label>
                            <input type="text" name="price" class="form-control" placeholder="Nhập giá sản phẩm">
                        </div>
                        <div class="form-group">
                            <label>Ảnh đại diện:</label>
                            <input type="file" name="feature_image_path" class="form-control-file">
                        </div>
                        <div class="form-group">
                            <label>Ảnh chi tiết:</label>
                            <input type="file" multible="multiple" name="image_path[]" class="form-control-file">
                        </div>
                        <div class="form-group">
                            <label>Chọn danh mục:</label>
                            <select class="form-control select-init" name="parent_id">
                                <option value="">Chọn danh mục</option>
                                {{!!$htmlOption!!}}
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Tags:</label>
                            <select name="tags[]" class="form-control tag-select-choose" multiple="multiple">

                            </select>
                        </div>

                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Nội dung:</label>
                            <textarea name='content' class="form-control my-editor" rows="8"></textarea>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
    </form>
    <!-- /.content -->
</div>
@endsection
@section('js')

<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/4.5.6/tinymce.min.js"></script>

<script src="{{asset('vendor/select2/select2.min.js')}}"></script>
<script src="{{asset('vendor/file-manager/js/file-manager.js')}}"></script>
<script src="{{asset('admin/product/add/add.js')}}"></script>
@endsection