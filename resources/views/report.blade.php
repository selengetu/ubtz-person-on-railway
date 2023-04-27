@extends('layouts.app')
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css">
@section('content')
    <div class="container-fluid">

    <div class="row mb-2">
<div class="col-sm-6">

</div>
<div class="col-sm-6">
<ol class="breadcrumb float-sm-right">
<li class="breadcrumb-item"><a href="#">Home</a></li>
<li class="breadcrumb-item active">Registration</li>
</ol>
</div>
</div>
    <div class="row">
<div class="col-12">
<div class="card">
<div class="card-header">
<h3 class="card-title"><b>Зам дээр хүн байсан тохиолдлууд</b></h3>
<div class="card-tools">

<div class="input-group input-group-sm">

<div class="input-group-append">


</div>
</div>
</div>
</div>

<div class="card-body row">
    <br>
          <div class="form-group col-md-3">
                            <label for="inputEmail4">Зөрчил гаргасан байгууллага</label>
                            <select class="form-control select2" id="schildabbr_id" name="schildabbr_id"
                                onchange="javascript:location.href = 'filter_childabbr/'+this.value;">
                                <option value="0">Бүгд</option>
                                @foreach ($dep as $executors)
                                    <option value="{{ $executors->executor_id }}"
                                        @if ($executors->executor_id == $schildabbr) selected @endif>
                                        @if ($executors->executor_type == 2)
                                            {{ $executors->department_abbr }} - {{ $executors->executor_abbr }}
                                        @else
                                            {{ $executors->executor_abbr }}
                                        @endif
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="inputEmail4">Эхлэх огноо</label>
                            <input type="date" class="form-control" maxlength="40" id="start_date" name="start_date">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="inputEmail4">Дуусах огноо</label>
                            <input type="date" class="form-control" maxlength="40" id="end_date" name="end_date">
                        </div>
<div class="table-responsive" >
        <table class="table table-hover table-bordered" id="myTable">
        <thead style="background-color:#AAC7FA">
        <tr>
        <th>№</th>
        <th>Огноо</th>
        <th>Машинч</th>
        <th>Чиглэл</th>
        <th>Байршил</th>
        <th>Галт тэрэгний №</th>
        <th>Зогссон минут</th>
        <th>Яаралтай тоормосын тэмдэглэгээ</th>
        <th>Цахилгаан</th>
        <th>Арга хэмжээ</th>

        </tr>
        </thead>
        <tbody>
        <?php $no = 1; ?>
                                        @foreach($data as $item)
                                            <tr>
                                                <td>{{$no}}</td>
                                                <td>{{$item->arrtime}}</td>
                                                <td>{{$item->mashname}}</td>
                                                <td>{{$item->fromstat}} - {{$item->tostat}}</td>
                                                <td>{{$item->fault_from}}</td>
                                                <td>{{$item->seriname}}- {{$item->zutnumber}}</td>
                                                <td>{{$item->fault_time}}</td>
                                                <td>{{$item->department_abbr}} - {{$item->people_count}}@if ($item->people_count) хүн @endif - {{$item->reason}}</td>
                                                <td>{{$item->info_no}} - {{$item->info_job}} - {{$item->info_employee}}  </td>
                                                <td>{{$item->description}} </td>
                                                
                                            </tr>
                                            <?php $no++; ?>
                                        @endforeach
        </tbody>
        </table>
</div>
</div>
</div>

</div>
</div>
    </div>
    
@endsection

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>
<script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>
<script>
    $(document).ready( function ($) {

    $('.time').mask('00:00');
    $(".ribdet").click(function(){
        var itag=$(this).attr('tag');
       $('#ribbon_id').val(itag);

       $.get('detailribbonfill/'+itag,function(data){
            $.each(data,function(i,qwe){
               if(qwe){
                var det =qwe.detail_id;
                $.get('detailfill/'+det,function(data){
            $.each(data,function(i,qwe){

                $('#detail_id').val(qwe.detail_id);
                $('#info_no').val(qwe.info_no);
                $('#people_count').val(qwe.people_count);
                $('#time').val(qwe.time);
                $('#dep_id').val(qwe.dep_id).trigger('change');
                $('#info_job').val(qwe.info_job);
                $('#info_employee').val(qwe.info_employee);
                $('#description').val(qwe.description);
                $("#image").attr("src", qwe.image);
            });

        });
               }
               else{
                $('#detail_id').val('');
                $('#info_no').val('');
                $('#people_count').val('');
                $('#time').val('');
                $('#info_job').val('');
                $('#info_employee').val('');
                $('#description').val('');
        
               }


            });

        });
      });
        $('#myTable').dataTable({ 
            dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
  });
} );
    </script>