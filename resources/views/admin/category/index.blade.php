@extends('../admin')
@section('content')
@include('../admin/partials/header')
@include('../admin/partials/navbar')


      <div class="page-wrapper">
        <!-- page-header -->
<!--         <div class="page-header d-print-none">
          <div class="container-xl">
            <div class="row g-2 align-items-center">
              <div class="col">
                <h2 class="page-title">
                  Category
                </h2>
              </div>
            </div>
          </div>
        </div> -->
        <!-- ./page-header -->
        <!-- page-body -->
        <div class="page-body">
          <div class="container-xl">
            <div class="row row-cards">
              <!-- content -->
            <!-- left -->
            <div class="col-lg-4">
              <div class="row row-cards">
			@include('../admin/partials/notifications')
                <div class="col-12">


                  <form class="card" action="{{ route('admin.category.store') }}" method="post" id="form-category">
                  	<input type="hidden" name="_method" value="post">
                  	{{ csrf_field() }}
                    <div class="card-header">
                      <h3 class="card-title">Category</h3>
                    </div>
                    <div class="card-body">
                      <!-- <div class="mb-3">
                        <div class="row">
                          <div class="col-auto">
                            <span class="avatar avatar-md" style="background-image: url(./static/avatars/002m.jpg)"></span>
                          </div>
                          <div class="col">
                            <div class="mb-3">
                              <label class="form-label">Email-Address</label>
                              <input class="form-control" placeholder="your-email@domain.com">
                            </div>
                          </div>
                        </div>
                      </div> -->
                      <div class="mb-3">
                      	<label class="form-label">上级分类</label>
                      	<select name="parent_id" class="form-control">
			                <option selected value="0">==顶级分类==</option>
			                @foreach ($data as  $value)
			                  <option value="{{ $value->id }}">{{ $value->title }}</option>
			                @endforeach
			              </select>
                      </div>
                      <div class="mb-3">
                        <label class="form-label">分类名称</label>
                        <input class="form-control" placeholder="分类名称" name="title" value="">
                      </div>
                      <div class="mb-3">
                        <label class="form-label">排序</label>
                        <input class="form-control" placeholder="0" name="order" value="{{ old('order') }}">
                      </div>
                      <div class="mb-3">
                        <label class="form-label">图标 <small>svg</small></label>
                        <textarea class="form-control" name="icon" rows="5">{{ old('icon') }}</textarea>
                        <small><a href="https://tabler.io/icons" target="_black">获取2979 icons</a></small>
                      </div>
                    </div>
                    <div class="card-footer text-end">
                      <button type="submit" class="btn btn-primary" >
                        Save
                      </button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <!-- ./left -->

            <!-- right -->
            <div class="col-lg-8">
              <div class="row row-cards">
                <!-- col-12 -->
                <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">List</h3>
                  </div>
                  <div class="table-responsive">
                    <table class="table table-vcenter card-table table-striped">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>分类</th>
                          <th>排序</th>
                          <th>图标</th>
                          <th>状态</th>
                          <th >操作</th>
                        </tr>
                      </thead>
                      <tbody>

                      	@foreach($data as $dat)
                      	<tr>
                      		<td>{{ $dat->id}}</td>
                          <td>
                            {{ $dat->_title}}
                          </td>
                          <td>
                            {{ $dat->order}}
                          </td>
                          <td>
                          	{!! $dat->icon !!}
													</td>
                          <td class="text-muted">
                            User
                          </td>
                          <td>
                            <a href="{{ route('admin.category.edit', $dat->id) }}">编辑</a> ｜ 
                            <a href="javascript:;" class="btn btn-xs" onclick="editData({{ $dat->id }})" >编辑</a> ｜ 
                            <a href="javascript:;" onclick="destoryData({{ $dat->id }});">删除</a>
                          </td>
                        </tr>
												@endforeach

                        
                      </tbody>
                    </table>
                  </div>
                  <div class="card-footer d-flex align-items-center">
					total {{ count($data) }}
                  </div>
                </div>
              </div>
                <!-- ./col-12 -->
              </div>
            </div>
            <!-- ./right -->
              <!-- /content -->
            </div>
          </div>
        </div>
        <!-- ./page-body -->
        @include('../admin/partials/footer')
      </div>


<button type="button" onclick="msg()">Publish</button>
<button type="button" id="publish">Publish2</button>

<script type="text/javascript">

// $(document).ready(function(){
// 	$('#publish').on('click',function(e){
// 		// console.log('x');
// 		Swal.fire("SweetAlert2 is working!");
// 	});
// });

	function saveData() {
		var parent_id = $('[name="parent_id"]');
		var title = $('[name="title"]');
		var order = $('[name="order"]');
		var icon = $('[name="icon"]');
		var method = $('[name="_method"]');
		var token = $('[name="_token"]');
		var form = $('#form-category');

		var data = {
			parent_id:parent_id.val(),
			title:title.val(),
			order:order.val(),
			icon:icon.val(),

		};

		$.ajax({
			type:method.val(),
			url:form.attr('action'),
			headers:{
				'X-CSRF-TOKEN': token.val()
			},
			data:data,
			error:function(res){
				console.log(res);
			},
			success:function(res){
				console.log('success');
				console.log(res);
			}
		});
	}

	function editData(id) {
		$.get("{{ url('admin/category') }}/"+id+"/edit", '', function(data) {
			var parent_id = $('[name="parent_id"]');
			var title = $('[name="title"]');
			var order = $('[name="order"]');
			var icon = $('[name="icon"]');
			var method = $('[name="_method"]');
			var form = $('#form-category');

			parent_id.children().remove();
			parent_id.append('<option value="0">==顶级分类==</option>');
			$.each(data.category, function(key,val) {
				parent_id.append("<option value="+val.id+">"+val.title+"</option>");
			});
			parent_id.val(data.data.parent_id);
			title.val(data.data.title);
			order.val(data.data.order);
			icon.val(data.data.icon);
			method.val('put');
			form.attr('action', "{{ url('admin/category') }}/"+id);
		});
	}
	function msg() {
		sweetAlert.fire({
	      title: "Cancelled!",
	      text: "Your file has been deleted.",
	      icon: "error"
	    });
	}
	function destoryData(id) {
		sweetAlert.fire({
		  title: "Are you sure?",
		  text: "删除不可恢复!",
		  icon: "warning",
		  showCancelButton: true,
		  confirmButtonColor: "#3085d6",
		  cancelButtonColor: "#d33",
		  confirmButtonText: "确认删除!",
		  cancelButtonText: "取消!"
		}).then((result) => {
		  if (result.isConfirmed) {
		  	data = {"_method":"delete","_token":"{{ csrf_token() }}"};
		  	$.post("{{ url('admin/category') }}/"+id, data, function(data){
		  		if(data.status == 0) {
		  			sweetAlert.fire({
				      title: "Deleted!",
				      text: data.msg,
				      icon: "success"
				    }).then((result) => {
						  if (result.isConfirmed) {
						    location.reload()
						  }
						});
		  		} else {
		  			sweetAlert.fire({
				      title: "Cancelled!",
				      text: data.msg,
				      icon: "error"
				    });
		  		}
		  		// location.reload()
		  	})
		    
		  }
		});

		// 
	}
</script>





@endsection
