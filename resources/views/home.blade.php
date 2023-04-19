@extends('layouts.app')

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

<div class="card-body">
    <br>
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
        <th>Зөрчил</th>
        <th>Цахилгаан мэдээ</th>
        <th>Авсан арга хэмжээ</th>
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
                                                <td>{{$item->reason}}</td>
                                                <td></td>
                                                <td></td>
                                                <td><button type="submit" class="btn btn-default" data-toggle="modal" data-target="#exampleModalCenter">
<i class="fas fa-plus"></i>
</button></td>

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
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <form method="post" enctype="multipart/form-data" action="adddetail">
        @csrf
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Зам дээр хүн бүртгэл</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="row">
      <div class="col-md-4"> 
      <div class="form-group">
        <label>Зөрчил гаргасан байгууллага</label>
        <select class="form-control select2" id="dep_id" name="dep_id" >
            @foreach($dep as $executors)
               <option value= "{{$executors->executor_id}}"> @if($executors->executor_type == 2){{$executors->department_abbr}} - {{$executors->executor_abbr}} @else {{$executors->executor_abbr}}@endif </option> @endforeach
         </select>
        </div>
      </div>
      <div class="col-md-4"> 
      <div class="form-group">
        <label>Зөрчил гаргасан хүний тоо</label>
        <input type="number" class="form-control" id="people_count" name="people_count">
        </div>
      </div>
         <div class="col-md-4"> 
      <div class="form-group">
        <label>Зөрчил гаргасан хугацаа</label>
        <input type="text" class="form-control" id="time" name="time">
        </div>
      </div>
      <div class="col-md-4"> 
      <div class="form-group">
        <label>УБТЗ мөн эсэх</label>
        <select class="form-control" id="is_ubtz" name="is_ubtz">
          <option value="1">Тийм</option>
          <option value="0">Үгүй</option>
          </select>
        </div>
      </div>
      <div class="col-md-4"> 
      <div class="form-group">
        <label>Цахилгааны №</label>
        <input type="text" class="form-control" maxlength="40" id="info_no" name="info_no">
        </div>
      </div>
      <div class="col-md-4"> 
      <div class="form-group">
        <label>Цахилгааны огноо</label>
        <input type="date" class="form-control" maxlength="40" id="info_date" name="info_date">
        </div>
      </div>
      <div class="col-md-4"> 
      <div class="form-group">
        <label>Албан тушаал</label>
        <input type="text" class="form-control"maxlength="40" id="info_job" name="info_job">
        </div>
      </div>
      <div class="col-md-4"> 
      <div class="form-group">
        <label>Нэр</label>
        <input type="text" class="form-control" maxlength="40" id="info_employee" name="info_employee">
        </div>
      </div>
      <div class="col-md-4"> 
      <div class="form-group">
        <label>Файл хавсаргах</label>
        <input type="file" class="form-control" maxlength="40" id="info_file" name="info_file">
        </div>
      </div>
      <div class="col-sm-12">
      <div class="form-group">
      <label>Авсан арга хэмжээ</label>
      <textarea class="form-control" rows="3" maxlength="40" id="description" name="description"></textarea>
      </div>
      </div>
      </div>
      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Хаах</button>
        <button type="submit" class="btn btn-primary">Хадгалах</button>
      </div>
      </form>
    </div>
  </div>
</div>
@endsection
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>
    $(document).ready( function () {
    $('#myTable').DataTable();
} );
    </script>