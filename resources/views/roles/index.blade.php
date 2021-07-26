@extends('layouts.app')
@section('title', 'Roles management')
@section('content')
@include('layouts.breadcrumb')
<div class="row">
  <div class="col-md-12">
    <div class="card mb-4">
      <div class="card-body">
        <div class="card-title mb-3">List @yield('title')</div>
        <div class="row">
          <div class="col-sm-12">
            <a type="button" id="addNewRole" class="btn btn-primary mr-1 mt-1" href="{{ route('roles.create') }}"> Add New Role</a>
          </div>
        </div>
        <br>
        <div class="row">
          <div class="col-sm-12">
            <div class="card-datatable table-responsive">
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

@section('scripts')
<script type="text/javascript">

  $(document).ready(function(){    
      showList(); 
  });

  function showList(oIsiCari){
    let dtdom = '<"card-header border-bottom p-1"<"head-label"><"dt-action-buttons text-right"B>><"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>';
    let arr_col_print =[0,1,2];
    var oTable = $("#detailedTable").DataTable({
      processing: true,
      serverSide: true,
      bDestroy: true, //pakai ini supaya bisa di load berulang2
      oSearch: {"sSearch":oIsiCari},
      scrollX: true,
      ajax:{url: "{{ route('roles.list') }}"},
      columns: [
          {
              data: 'id',title:'No',
                  render: function (data, type, row, meta) {
                      return meta.row + meta.settings._iDisplayStart + 1;
                  }, orderable: false, searchable: false
              },
          { data: 'name', name: 'name' ,title:'Name'},
          { data: 'guard_name', name: 'guard_name' ,title:'Guard Name'},
          { data: 'action', name: 'action',title:'Action', orderable: false, searchable: false},
      ],
      columnDefs: [
        {
          // For Responsive
          className: 'control',
          orderable: false,
          responsivePriority: 2,
          targets: 0
        },
        {
          responsivePriority: 1,
          targets: 3
        }
      ],
      drawCallback: function (settings) {
          feather.replace({
              width: 14,
              height: 14
          });
      },
      // order: [[1, 'asc']],
      dom:dtdom,
      displayLength: 10,
      lengthMenu: [
              [ 10, 25, 50, -1 ],
              [ '10', '25', '50', 'All' ]
      ],
      buttons: [
        {
          extend: 'collection',
          className: 'btn btn-outline-secondary dropdown-toggle mr-2',
          text: feather.icons['share'].toSvg({ class: 'font-small-4 mr-50' }) + 'Export',
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
        }
      ],
    });
    $('div.head-label').html('<h6 class="mb-0">Role lists</h6>');
    // Order by the grouping

    // oTable.on('draw.dt', function () {
    //   $('.my-tooltip').tooltip({
    //         trigger: "hover"
    //   });
    // });
  }

  function validasidelete(id,name){
    Swal.fire({
      title: "Are you sure?",
      text: "This ("+name+") Roles will be deleted",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
          /* Read more about isConfirmed, isDenied below */
          if (result.isConfirmed) {
              $.ajax({
              dataType: 'json',
              type:'POST',
              url: "{{ route('roles.destroy') }}",
              data:{
                  id:id
              },
              success: function(data) {
                Swal.fire(
                    'Deleted!',
                    data.message,
                    'success'
                  )
                  showList();
              },
                  error: function(data) {
                  alert(data.status);
              }
              });
          } 
      })
  }
    
  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });
</script>
@endsection
