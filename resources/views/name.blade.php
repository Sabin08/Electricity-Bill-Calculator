<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Electricity Bill Calculator</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
  <link href="{{asset('front/style.css')}}" rel="stylesheet">
</head>
<body>
<div class="container-fluid">
  <header class="header">
  <h1>Electricity Bill Calculator</h1>
   </header>
   <div class="login">
    <form action="{{route('process')}}" method="POST">
     @csrf
    <select name="amp" id="amp" class="col-sm-2 col-form-select" required>
    <option value="">Please select curret (amp)</option>
      @foreach($a_unit as $item) 
        <!-- <option value="{{$item->id}}" required>{{$item->ampere}}</option> -->
        <!-- @if(isset($ampere_id)) -->
      <option value="{{$item->id}}" {{$ampere_id==$item->id?'selected':''}} required>{{$item->ampere}}</option>
      <!-- @endif -->
      
      @endforeach
  
     </select><br><br>
    <input placeholder="consumed unit" type="number" id="tarea" name="tarea" class="col-sm-2 col-form-label" min="1" max="9999" maxlength="6" required value="{{$unit}}"><br><br>
     <input type="submit" value="calculate" id="btn" class="btn btn-secondary">
    </div>
    <hr>
</div>
  <div class="container-fluid">
  <table class="table">
  
  
  @if(isset($c_aRange))
  <p class="fw-bolder">Details for {{$ampere->ampere}} ampere circuit:</p>
  <thead>
    <tr>
      <th scope="col">KW/HR</th>
      <th scope="col">Minumun Charge</th>
      <th scope="col">Rate</th>
    </tr>
  </thead>
  <tbody>
    
  @foreach($data2 as $ca)
  @foreach($c_aRange as $r)
  @if($r->id==$ca->c_id)
  
    <tr>
    <td>{{$r->kw_hr}} </td>
    <td> {{$ca->minimum}}</td>
    <td>{{$ca->rate}} </td>
    </tr>
    @endif
    @endforeach
  @endforeach

  
  @endif
</tbody>
</table>

  @if(isset($message))
  
  <p class="fw-bolder">Your Range Lies in: {{$range->kw_hr}}</p>
  <p class="fw-bolder">Total minimum amount: {{$mincharge}}</p>
  <p class="fw-bolder">Total amount: {{$mincharge}} + {{$runit}}*{{$data->rate}} = Rs {{$result}}</p>
  @endif
 
  </div>
</form>
  
</body>
</html>