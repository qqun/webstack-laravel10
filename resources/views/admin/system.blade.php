@extends('../admin')
@section('content')
@include('../admin/partials/header')
@include('../admin/partials/navbar')

<div class="page-wrapper" >
	<!-- page-header -->
	<!-- ./page-header -->
	<div class="page-body">
		<div class="container-xl">
			<div class="card">
				<div class="row g-0">
					<!-- row -->
					<div class="col-3 d-none d-md-block border-end">
	                	<div class="card-body">
	                		<h4 class="subheader">System Settings</h4>
	                		<div class="list-group list-group-transparent">
	                			<a href="#settings" class="list-group-item list-group-item-action d-flex align-items-center active">System</a>
	                			<a href="#users" class="list-group-item list-group-item-action d-flex align-items-center">Users</a>
	                		</div>
	                	</div>
	                
	              	</div>
@if(!empty(session('success')))

@endif

<script type="text/javascript">
// $(document).ready(function() {
	sweetAlert.fire(" session('success') }}");
	// console.log({{ session('success') }})
// });


</script>
	              	<div class="col d-flex flex-column">
	              		<form action="{{ route('admin.system.store') }}" method="post">
	              			{{ csrf_field() }}
	              		<div class="card-body">
	              			<h2 class="mb4">{{ $title }}</h2>
		                	@foreach($system as $s)
		                  <div class="mb-3 row">
		                    <label class="col-3 col-form-label required">{{ $s->title }}</label>
		                    <div class="col">
		                      <input type="text" name="{{ $s->key }}" class="form-control" placeholder="{{ $s->title }}" value="{{ $s->value }}">
		                      <small class="form-hint">{{ $s->description }}</small>
		                    </div>
		                  </div>
		                  @endforeach
		                  
		                </div>
		                <div class="card-footer text-end">
		                  <button type="submit" class="btn btn-primary">Submit</button>
		                </div>
		                </form>
	              	</div>

					<!-- ./row -->
				</div>
			</div>
		</div>
	</div>
</div>






@include('../admin/partials/footer')
@endsection