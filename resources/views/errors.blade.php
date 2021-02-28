@if($errors->any())
    <div style="width: 50%;background-color: indianred;
    /* color: white; */
    padding: 15px;
    border-radius: 4px;
    margin: 20px auto;
color: white;">
        <ul>
            @foreach ($errors->all() as $error)
                <li class="alert-error" style="text-align: right;font-size: 13px">
                    {{ $error }}
                </li>
            @endforeach
        </ul>
    </div>
@endif

