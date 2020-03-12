@extends('layouts.master')

@section('title')
    <title>Manajemen Kasur</title>
@endsection
@section('css')
<style type="text/css">
  .wrapper{
    padding:50px;
  }
</style>
@endsection
@section('content')
   <div class="wrapper">
  <div class="row">
    <div class="col-md-12">
     <div class="col-md-3"></div>
      <div class="col-md-6">
        <form action="" method="POST" class="form-horizontal" role="form">
            <div class="form-group">
              <legend>Plugins Datetimepicker</legend>
            </div>
            <div class="form-group">
              <label for="datetimepicker">Datetimepicker Default</label>
              <div class='input-group date' id='datetimepicker1'>
                    <input type='text' class="form-control" />
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>         
            <div class="form-group">
              <label for="datetimepicker">Datetimepicker With Format YYYY-MM-DD h:m:s A</label>
              <div class='input-group date' id='datetimepicker2'>
                    <input type='text' class="form-control" />
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>     
            <div class="form-group">
              <label for="datetimepicker">Datetimepicker Format Time</label>
              <div class='input-group date' id='datetimepicker3'>
                    <input type='text' class="form-control" />
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>  
            <div class="form-group">
              <label for="datetimepicker">Datetimepicker No Icon</label>
              <div class='input-group date' >
                    <input type='text' class="form-control" id='datetimepicker4' />
                    <span class="input-group-addon">
                    </span>
                </div>
            </div>       
            <div class="form-group">
              <label for="datetimepicker">Datetimepicker Custom Icon</label>
              <div class='input-group date' id='datetimepicker5'>
                    <input type='text' class="form-control"  />
                    <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div> 
            <div class="form-group">
              <label for="datetimepicker">Datetimepicker View Mode Year</label>
              <div class='input-group date' id='datetimepicker6'>
                    <input type='text' class="form-control"  />
                    <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>   
            <div class="form-group">
              <label for="datetimepicker">Datetimepicker View Mode Month</label>
              <div class='input-group date' id='datetimepicker7'>
                    <input type='text' class="form-control"  />
                    <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>       
            <div class="form-group">
              <label for="datetimepicker">Datetimepicker Disable Date</label>
              <div class='input-group date' id='datetimepicker8'>
                    <input type='text' class="form-control" />
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>        
            <div class="form-group">
              <button type="submit" class="btn btn-info">Submit</button>
              <button type="submit" class="btn btn-danger">Cancel</button>
            </div>
            <div class="form-group">
                  <label>Date range:</label>

                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="far fa-calendar-alt"></i>
                      </span>
                    </div>
                    <input type="text" class="form-control float-right" id="reservation">
                  </div>
                  <!-- /.input group -->
                </div>
        </form>
      </div>
      <div class="col-md-3"></div>
    </div>
  </div>
</div>      
</body>
@endsection
@section('js')
<script src="{{asset('date.min.js')}}"></script>
@endsection