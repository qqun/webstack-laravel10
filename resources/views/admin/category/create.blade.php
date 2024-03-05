@extends('../admin')
@section('content')
@include('../admin/partials/header')
<!-- 
<form action="{{ route('admin.category.store') }}" method="post">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	<select name="parent_id">
		<option value="0">顶级分类</option>
		@foreach($data as $val)
		<option value="{{ $val->id }}">{{ $val->_title }}</option>
		@endforeach
	</select>
	<input type="text" name="title" value="">
	<input type="text" name="icon" value="">
	<input type="text" name="order" value="">
	<button type="submit">submit</button>
</form>

 -->



@include('../admin/partials/notifications')


  <div class="card card-small mb-3">
          <div class="card-body">
            <form class="add-category" action="{{ route('admin.category.store') }}" method="post" name="add-category">
              {{ csrf_field() }}
              <div class="form-control">
              <label>分类名</label>
              <input type="text" name="title" class="form-control form-control-lg col-md-6 mb-3" placeholder="分类名" value="{{ old('title') }}">
          </div>
          <div class="form-control">
              <label>排序</label>
              <input type="text" name="order" class="form-control form-control-lg col-md-6 mb-3" placeholder="排序" value="{{ old('order') }}">
          </div>
          <div class="form-control">
              <label>图标</label>
              <input type="text" name="icon" class="form-control form-control-lg col-md-6 mb-3" placeholder="图标" value="{{ old('icon') }}">
          </div>
          <div class="form-control">
              	<label>上级分类</label>
              <select name="parent_id" class="form-control form-control-lg col-md-5 mb-3">
                <option selected value="">==顶级分类==</option>
                @foreach ($data as  $value)
                  <option value="{{ $value->id }}">{{ $value->title }}</option>
                @endforeach
              </select>
          </div>

            </form>
          </div>
        </div>
  <button class="btn btn-sm btn-accent" onclick = "createCate()">
 <i class="material-icons">file_copy</i> Publish</button>
<script type="text/javascript">
// 提交使用的是createCate()提交
function createCate(){
  document.forms['add-category'].submit();
}
</script>

@endsection