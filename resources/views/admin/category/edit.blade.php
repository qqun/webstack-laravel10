@extends('../admin')
@section('content')
@include('../admin/partials/header')




@include('../admin/partials/notifications')

  <div class="card card-small mb-3">
          <div class="card-body">
            <form class="edit-category" action="{{ route('admin.category.update', $data) }}" method="post" name="edit-category">
              @method('PUT')
              {{ csrf_field() }}
              <div class="form-control">
              <label>分类名</label> 
              <input type="text" name="title" class="form-control form-control-lg col-md-6 mb-3" placeholder="分类名" value="{{ $data->title }}">
          </div>
          <div class="form-control">
              <label>排序</label>
              <input type="text" name="order" class="form-control form-control-lg col-md-6 mb-3" placeholder="排序" value="{{ $data->order }}">
          </div>
          <div class="form-control">
              <label>图标</label>
              <input type="text" name="icon" class="form-control form-control-lg col-md-6 mb-3" placeholder="图标" value="{{ $data->icon }}">
          </div>
          <div class="form-control">
              	<label>上级分类</label>
              <select name="parent_id" class="form-control form-control-lg col-md-5 mb-3">
                <option selected value="">==顶级分类==</option>
                @foreach ($list as  $value)
                  <option value="{{ $value->id }}" {{ $data->parent_id == $value->id?'selected':'' }}>{{ $value->title }}</option>
                @endforeach
              </select>
          </div>
          <button type="submit">submit</button>
            </form>
          </div>
        </div>
  

@endsection