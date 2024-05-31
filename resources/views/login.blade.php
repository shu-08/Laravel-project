@extends('app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2 style="font-size:1rem;">ログイン画面</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-success" href="{{ url('/hotels') }}">戻る</a>
        </div>
    </div>
</div>
 
<div style="text-align:right;">
<form action="{{ route('hotel.store') }}" method="POST">
    @csrf
     
     <div class="row">
        <div class="col-12 mb-2 mt-2">
            <div class="form-group">
                <input type="text" name="userid" class="form-control" placeholder="ユーザーid">
                @error('userid')
                <span style="color:red;">10文字以内で入力してください</span>
                @enderror
            </div>
        </div>
        <div class="col-12 mb-2 mt-2">
            <div class="form-group">
                <input type="text" name="name" class="form-control" placeholder="名前">
                @error('name')
                <span style="color:red;">10文字以内で入力してください</span>
                @enderror
            </div>
        </div>
        <div class="col-12 mb-2 mt-2">
            <div class="form-group">
                <input type="text" name="email" class="form-control" placeholder="メールアドレス">
                @error('email')
                <span style="color:red;">30文字以内で入力してください</span>
                @enderror
            </div>
        </div>
        <div class="col-12 mb-2 mt-2">
            <div class="form-group">
                <input type="text" name="password" class="form-control" placeholder="パスワード">
            </div>
        </div>
        <div class="col-12 mb-2 mt-2">
                <button type="submit" class="btn btn-primary w-100">登録</button>
        </div>
    </div>      
</form>
</div>
@endsection