@extends('../admin')
@section('content')
@include('../admin/partials/header')
@include('../admin/partials/navbar')

      <div class="page-wrapper">
        <!-- page-header -->
        <div class="page-header d-print-none">
          <div class="container-xl">
            <div class="row g-2 align-items-center">
              <div class="col">
                <!-- Page pre-title -->
                <!-- <div class="page-pretitle">
                  Overview
                </div> -->
                <h2 class="page-title">
                  Site
                </h2>
              </div>
              <!-- Page title actions -->
              <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                  <span class="d-none d-sm-inline">
                    <a href="#" class="btn">
                      New Site
                    </a>
                  </span>
                  <a href="#" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal" data-bs-target="#modal-report">
                    <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                    Create new Site
                  </a>
                  
                </div>
              </div>
            </div>




          </div>
        </div>
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
                  <!-- <form class="card"> -->
                    <form class="card" action="{{ route('admin.site.store') }}" method="post" id="from-site">
                      <input type="hidden" name="_method" value="post">
                    {{ csrf_field() }}
                    <div class="card-header">
                      <h3 class="card-title">My Profile</h3>
                    </div>
                    <div class="card-body">
                      <div class="mb-3">
                        <label class="form-label">分类</label>
                        <select name="parent_id" class="form-control">
                          <option selected value="0">==顶级分类==</option>
                          @foreach ($data as  $value)
                            <option value="{{ $value->id }}">{{ $value->title }}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="mb-3">
                        <label class="form-label">名称</label>
                        <input class="form-control" placeholder="名称" name="title" value="">
                      </div>
                      <div class="mb-3">
                        <label class="form-label">图标</label>
                        <input class="form-control" placeholder="图标" name="thumb" value="">
                      </div>
                      <div class="mb-3">
                        <label class="form-label">URL</label>
                        <input class="form-control" placeholder="URL" name="url" value="">
                      </div>
                      <div class="mb-3">
                        <label class="form-label">描述</label>
                        <textarea class="form-control" name="describe" rows="5">{{ old('describe') }}</textarea>
                      </div>

                    </div>
                    <div class="card-footer text-end">
                      <a href="#" class="btn btn-primary">
                        Save
                      </a>
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
                    <h3 class="card-title">Invoices</h3>
                  </div>
                  <div class="table-responsive">
                    <table class="table table-vcenter card-table table-striped">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>名称</th>
                          <th>分类</th>
                          <th>创建/更新时间</th>
                          <th>状态</th>
                          <th >操作</th>
                        </tr>
                      </thead>
                      <tbody>

                      	@foreach($list as $s)
                      	<tr>
                      		<td>{{ $s->id}}</td>
                          <td>
                            <div class="d-flex py-1 align-items-center">
                              <span class="avatar me-2" style="background-image: url({{ $s->thumb}})"></span>
                              <div class="flex-fill">
                                <div class="font-weight-medium">{{ $s->title}}</div>
                                <div class="text-muted"><a href="#" class="text-reset">{{ $s->url}}</a></div>
                              </div>
                            </div>
                          </td>
                          <td>
                            <div>{{ $s->category_id}}</div>
                            <div class="text-muted">Accounting</div>
                          </td>
                          <td>
                          	<div>{{ $s->created_at}}</div>
              							<div class="text-muted">{{ $s->updated_at}}</div>
              						</td>
                          <td class="text-muted">
                            User
                          </td>
                          <td>
                            <a href="{{ route('admin.site.edit', $s->id) }}">编辑</a> ｜ 
                            <a href="javascript:;" class="btn btn-xs" onclick="editData({{ $s->id }})" >编辑</a> ｜ 
                            <a href="javascript:;" onclick="destoryData({{ $s->id }});">删除</a>
                          </td>
                        </tr>
                        @endforeach

                        
                      </tbody>
                    </table>
                  </div>
                  <div class="card-footer d-flex align-items-center">
                    {{ $list->links('admin.partials.pagination') }}

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



<script type="text/javascript">

  function saveData() {
    var parent_id = $('[name="parent_id"]');
    var title = $('[name="title"]');
    var thumb = $('[name="thumb"]');
    var url = $('[name="url"]');
    var describe = $('[name="describe"]');

    var method = $('[name="_method"]');
    var token = $('[name="_token"]');
    var form = $('#form-category');

    var data = {
      parent_id:parent_id.val(),
      title:title.val(),
      thumb:thumb.val(),
      url:url.val(),
      describe:describe.val(),
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
    $.get("{{ url('admin/site') }}/"+id+"/edit", '', function(data) {
      var parent_id = $('[name="parent_id"]');
      var title = $('[name="title"]');
      var thumb = $('[name="thumb"]');
      var url = $('[name="url"]');
      var describe = $('[name="describe"]');

      var method = $('[name="_method"]');
      var form = $('#form-category');

      parent_id.children().remove();
      parent_id.append('<option value="0">==顶级分类==</option>');
      $.each(data.category, function(key,val) {
        parent_id.append("<option value="+val.id+">"+val.title+"</option>");
      });
      parent_id.val(data.data.category_id);
      title.val(data.data.title);
      thumb.val(data.data.thumb);
      url.val(data.data.url);
      describe.val(data.data.describe);
      method.val('put');
      form.attr('action', "{{ url('admin/site') }}/"+id);
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
		  	$.post("{{ url('admin/site') }}/"+id, data, function(data){
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