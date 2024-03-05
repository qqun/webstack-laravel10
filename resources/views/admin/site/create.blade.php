@extends('../admin')
@section('content')
@include('../admin/partials/header')


site.create


@include('../admin/partials/notifications')

<form action="{{ route('admin.site.store') }}" method="post">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	<select name="category_id">
		<option value="0">选择分类</option>
		@foreach($data as $val)
		<option value="{{ $val->id }}">{{ $val->_title }}</option>
		@endforeach
	</select>
	<input type="text" name="title">
	<input type="text" name="thumb">
	<input type="text" name="describe">
	<input type="text" name="url">

	<button type="submit">submit</button>
</form>
@endsection