@extends('layouts.app')
@section('title', 'Users')
@section('content')
@include('layouts.breadcrumb')

<div class="row">
  <div class="col-md-12">
    <div class="card mb-4">
      <div class="card-body">
          <div class="card-title mb-3">User</div>
          <form>
            <div class="row">
              <div class="col-md-4"> 
                <div class="form-group">
                  <label for="basicInput">Username</label>
                  <input type="text" class="form-control text-uppercase" id="SearchUser" name="SearchUser" placeholder="" />
                </div>
              </div>
              <div class="col-md-12"> 
                <button type="button" class="btn btn-primary" id ="btnSearch" name="btnSearch">Search</button>
                @can('user-create')
                <a href="{{ route('users.create') }}" class="btn btn-info">Create</a>
                @endcan
              </div>
            </div>
          </form>
      </div>
    </div>
  </div>
  <div class="col-md-12">
    <div class="card mb-4">
      <div class="card-body">
        <div class="card-title mb-3">List User</div>
        <div class="row">
          <div class="col-sm-12">
            <div class="card-datatable table-responsive pt-0">
              <div class="table-responsive">
                <table class="display table table-striped table-bordered" id="detailedTable" style="width:100%">
                  <thead>
                  </thead>
                </table>
              </div>
            </div>
          </div>
        </div>  
      </div>
    </div>
  </div>
</div>
	
@endsection
@section('styles')
<style>
</style>
@endsection

@section('scripts')
<script type="text/javascript">

  function validasidelete(userid){
     Swal.fire({
        title: "Yakin akan di hapus?",
        text: "ID "+userid+" Akan dihapus",
        icon: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Hapus",
        closeOnConfirm: false
    } ,
    function(){
        $.ajax({
          dataType: 'json',
          type:'DELETE',
          url: "{{route('users.delete')}}",
          data:{userid:userid},
          success: function(data) {
              //  Swal.fire("UPDATED!", "Generate data berhasil", "success");
              tampildata('');
          },
            error: function(data) {
              // Swal.fire("Error :" + data.status);
              tampildata('');
          }
        });
         Swal.fire("DELETED!", "Hapus data berhasil", "success");
      });
      //return confirm("Do you want to delete this item?"); 
  }

	$("#btnSearch").click(function(e){
		var nama =$("#SearchUser").val();
    tampildata(nama);
  });

  //refresh di cards
  $('a[data-action="reload"]').on('click', function () {
    tampildata('');
  });

  function lockUnlock(){
    $(".userLock").change(function(){
      let id = $(this).attr('id');
      let key= $(this).data('nama');
      let newStatus,oldStatus;
      let domId="lblUserLock_"+ key;
      if (this.checked) {
        newStatus=1;
        oldsStatus=0;
        updateStatus(key,oldStatus,newStatus,domId)
      } else {
        newStatus=0;
        oldStatus=1;
        updateStatus(key,oldStatus,newStatus,domId)
      }
    });
  }

  function updateStatus(username,oldStatus,newStatus,domId){
      $.ajax({
        dataType: 'json',
        type:'POST',
        url: "{{route('user.update.status')}}",
        data:{
          username:username,
          oldStatus:oldStatus,
          newStatus:newStatus
        },
        success: function(data) {
          if (data.status=1){
            if (newStatus==1){
               $("#"+domId).text("Active");
            }

            if (newStatus==0){
                $("#"+domId).text("Locked");
            }
          }else{
             Swal.fire("Warning", data.message, "warning");
          }
        },
        error: function(data) {
           Swal.fire("Error","Error :" + data.status,"error");
        }
      });
  }
  
	function tampildata(nama){
    let dtdom ='<"d-flex justify-content-between align-items-center header-actions mx-1 row mt-75"' +
        '<"col-lg-12 col-xl-6" l>' +
        '<"col-lg-12 col-xl-6 pl-xl-75 pl-0"<"dt-action-buttons text-xl-right text-lg-left text-md-right text-left d-flex align-items-center justify-content-lg-end align-items-center flex-sm-nowrap flex-wrap mr-1"<"mr-1"f>B>>' +
        '>t' +
        '<"d-flex justify-content-between mx-2 row mb-1"' +
        '<"col-sm-12 col-md-6"i>' +
        '<"col-sm-12 col-md-6"p>' +
        '>';
    let arr_col_print =[1,2,3,4]; 
    $(function(){
        var oTable =$("#detailedTable").DataTable({
            ajax:
            {
              url:'{{ route("user.lists")}}',
              data:{q:nama}
            },
            processing: true,
            serverSide: true,
            buttons: true,
            dom:dtdom,
            lengthMenu: [
              [ 10, 25, 50, -1 ],
              [ '10', '25', '50', 'all' ]
            ],
            buttons: [
              {
                extend: 'collection',
                className: 'btn btn-outline-secondary dropdown-toggle',
                text: feather.icons['share'].toSvg({ class: 'font-small-3 mr-50' }) + 'Export',
                buttons: [
                  {
                    extend: 'print',
                    text: feather.icons['printer'].toSvg({ class: 'font-small-4 mr-50' }) + 'Print',
                    className: 'dropdown-item',
                    exportOptions: { columns: arr_col_print }
                  },
                  {
                    extend: 'csv',
                    text: feather.icons['file-text'].toSvg({ class: 'font-small-4 mr-50' }) + 'Csv',
                    className: 'dropdown-item',
                    exportOptions: { columns: arr_col_print }
                  },
                  {
                    extend: 'excel',
                    text: feather.icons['file'].toSvg({ class: 'font-small-4 mr-50' }) + 'Excel',
                    className: 'dropdown-item',
                    exportOptions: { columns: arr_col_print }
                  },
                  {
                    extend: 'pdf',
                    text: feather.icons['clipboard'].toSvg({ class: 'font-small-4 mr-50' }) + 'Pdf',
                    className: 'dropdown-item',
                    exportOptions: { columns: arr_col_print }
                  },
                  {
                    extend: 'copy',
                    text: feather.icons['copy'].toSvg({ class: 'font-small-4 mr-50' }) + 'Copy',
                    className: 'dropdown-item',
                    exportOptions: { columns: arr_col_print }
                  }
                ],
                init: function (api, node, config) {
                  $(node).removeClass('btn-secondary');
                  $(node).parent().removeClass('btn-group');
                  setTimeout(function () {
                    $(node).closest('.dt-buttons').removeClass('btn-group').addClass('d-inline-flex');
                  }, 50);
                }
              },
            ],
            responsive: {
              details: {
                display: $.fn.dataTable.Responsive.display.modal({
                  header: function (row) {
                    var data = row.data();
                    return 'Details of ' + data['name'];
                  }
                }),
                type: 'column',
                renderer: function (api, rowIdx, columns) {
                  var data = $.map(columns, function (col, i) {
                    return col.title !== '' // ? Do not show row in modal popup if title is blank (for check box)
                      ? '<tr data-dt-row="' +
                          col.rowIndex +
                          '" data-dt-column="' +
                          col.columnIndex +
                          '">' +
                          '<td>' +
                          col.title +
                          ':' +
                          '</td> ' +
                          '<td>' +
                          col.data +
                          '</td>' +
                          '</tr>'
                      : '';
                  }).join('');
                  return data ? $('<table class="table"/>').append(data) : false;
                }
              }
            },
            columnDefs: [
              {
                // For Responsive
                className: 'control',
                orderable: false,
                responsivePriority: 2,
                targets: 0
              },
              {
                targets: 1,
                visible: false
              },
              {
                // Avatar image/badge, Name and post
                targets: 2,
                responsivePriority: 4,
                render: function (data, type, full, meta) {
                  var $user_img = full['username'],
                    $name = full['username'],
                    $post = full['name'];
                    if ($user_img) {
                        // For Avatar image
                        let errorImage= "'{{ URL::asset('app-assets/images/avatars/default.png')}}'"; 
                        let avatarImage= "{{ URL::asset('app-assets/images/avatars/') }}/"+$user_img+".jpg"; 
                        var $output = 
                          '<img src="'+avatarImage+'" onerror="this.src='+errorImage+'" alt="Avatar" width="32" height="32" class="rounded-circle">';
                      } else {
                        // For Avatar badge
                        var stateNum = full['status'];
                        var states = ['success', 'danger', 'warning', 'info', 'dark', 'primary', 'secondary'];
                        var $state = states[stateNum],
                          $name = full['username'],
                          $initials = $name.match(/\b\w/g) || [];
                        $initials = (($initials.shift() || '') + ($initials.pop() || '')).toUpperCase();
                        $output = '<span class="avatar-content">' + $initials + '</span>';
                    }

                    var colorClass = $user_img === '' ? ' bg-light-' + $state + ' ' : '';
                    // Creates full output for row
                    var $row_output =
                      '<div class="d-flex justify-content-left align-items-center">' +
                      '<div class="avatar ' +
                      colorClass +
                      ' mr-1">' +
                      $output +
                      '</div>' +
                      '<div class="d-flex flex-column">' +
                      '<span class="emp_name text-truncate font-weight-bold">' +
                      $name +
                      '</span>' +
                      '<small class="emp_post text-truncate text-muted">' +
                      $post +
                      '</small>' +
                      '</div>' +
                      '</div>';
                    return $row_output;
                }
              },
              {
                responsivePriority: 1,
                targets: 2
              },
              { width: '10%', targets: 8 }
            ],
            drawCallback: function( settings ) {
              feather.replace({
                    width: 14,
                    height: 14
              });

              lockUnlock();
            },
            order: [[ 1, 'asc' ]],
            bDestroy: true, //pakai ini supaya bisa di load berulang2
            // scrollX: true, //pakai ini supaya waktu responsive  bisa di scroll horizontal
            columns: [
                { data: 'group_id',name:'group_id', title:'',orderable: false, searchable: false },
                { data: 'name', name: 'name',title:'Name' },
                { data: 'username', name: 'username',title:'Username'},
                { data: 'email', name: 'email',title:'Email' },
                { data: 'status', name: 'email',title:'Status' },
                { data: 'roles', name: 'roles',title:'Roles' },
                { data: 'last_login_at', name: 'last_login_at',title:'Last login' },
                { data: 'last_login_ip', name: 'last_login_ip',title:'Last IP' },
                { data: 'action', name: 'action',title:'action', orderable: false, searchable: false },
            ],
      });
      // $('div.head-label').html('<h6 class="mb-0">Data Users</h6>');
    });
  }

  $('#detailedTable').on('draw.dt', function () {  
      $('.my-tooltip').tooltip({
            trigger: "hover"
      });
  });
	
	$.ajaxSetup({
	    headers: {
	        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    }
	});

</script>
@endsection