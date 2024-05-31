@extends('app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2 style="font-size:1rem;">予約編集画面</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-success" href="{{ url('/hotels') }}">戻る</a>
        </div>
    </div>
</div>
 
<div style="text-align:right;">
<form action="{{ route('hotel.update',$hotel->id) }}" method="POST">
    @method('PUT')
    @csrf
<div class="row">
        <div class="col">
            <input type="text" name="checkin" class="form-control" onfocus="this.type='date'" onfocusout="this.type='text'" placeholder="チェックイン" value="{{ $hotel->date1 }}">
        </div>
        <div class="col">
            <input type="text" name="checkout" class="form-control" onfocus="this.type='date'" onfocusout="this.type='text'" placeholder="チェックアウト" value="{{ $hotel->date2 }}">
        </div>
        <div class="col-12 mb-2 mt-2">
            <div class="form-group">
                <input type="text" name="name" class="form-control" placeholder="氏名" value="{{ $hotel->name }}">
                @error('name')
                <span style="color:red;">10文字以内で入力してください</span>
                @enderror
            </div>
        </div>
        <div class="col-12 mb-2 mt-2">
            <div class="form-group">
                <input type="text" name="email" class="form-control" placeholder="メールアドレス" value="{{ $hotel->email }}">
                @error('email')
                <span style="color:red;">メールアドレス形式で入力してください</span>
                @enderror
            </div>
        </div>


        <div class="col-12 mb-2 mt-2">
            <div class="form-group" align="left"> 
                大人:<select name="adult">
                @for($i = 0; $i<=10; $i++)
                    <option value="{{$i}}" 
                    @if( "{{$i}}" === "{{$hotel->adult}}" ) selected @endif>
                    {{$i}}</option>
                @endfor
                </select>

                子供:<select name="child">
                @for($i = 0; $i<=10; $i++)
                    <option value="{{$i}}" 
                    @if( "{{$i}}" === "{{$hotel->child}}" ) selected @endif>
                    {{$i}}</option>
                @endfor
                </select>

                シニア:<select name="senior">
                @for($i = 0; $i<=10; $i++)
                    <option value="{{$i}}" 
                    @if( "{{$i}}" === "{{$hotel->senior}}" ) selected @endif>
                    {{$i}}</option>
                @endfor

                </select>
            </div>
        </div>
        
        <div class="col-12 mb-2 mt-2">
            <div class="form-group">
                <select name ="state" class="form-select">
                    @foreach ($states as $state)
                        <option value="{{$state->id}}"
                        @if( "{{$state->id}}" === "{{$hotel->stateid}}" ) selected @endif>
                        {{ $state->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-12 mb-2 mt-2">
            <div class="form-group">
                <input type="text" name="remarks" class="form-control" placeholder="備考欄" value="{{ $hotel->remarks }}">
                @error('remarks')
                <span style="color:red;">50文字以内で入力してください</span>
                @enderror
            </div>
        </div>
        <div class="col-12 mb-2 mt-2">
                <button type="submit" class="btn btn-primary w-100">登録</button>
        </div>
    </div>      
</form>
</div>
@endsection