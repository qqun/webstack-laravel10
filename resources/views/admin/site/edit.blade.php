@extends('../admin')
@section('content')
@include('../admin/partials/header')


site.edit


@include('../admin/partials/notifications')

<form action="{{ route('admin.site.update',  $data) }}" method="post">
	@method('PUT')
    {{ csrf_field() }}
	<select name="category_id">
		<option>选择分类</option>
		@foreach($list as $value)
		<option value="{{ $value->id }}" {{ $data->category_id == $value->id?'selected':'' }} >{{ $value->_title }}</option>
		@endforeach
	</select>
	标题
	<input type="text" name="title" value="{{ $data->title }}">
	缩略图
	<input type="text" name="thumb" value="{{ $data->thumb }}">
	说明
	<input type="text" name="describe" value="{{ $data->describe }}">
	url
	<input type="text" name="url" value="{{ $data->url }}">

	<button type="submit">submit</button>
</form>
@endsection