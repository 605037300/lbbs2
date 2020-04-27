@if(count($errors)>0)
    <div class='alert alert-danger'>
        <div class='mt-2'>
            有错误
        </div>
        <ul class='mt-2 mb-2'>
            @foreach($errors->all() as $error)
                <li > <i class='glyphicon glyicon-remove'></i> {{$error}}</li>
            @endforeach
        </ul>
     
    </div>


@endif