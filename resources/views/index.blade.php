@extends('app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="text-right" style="text-align:center">
            <a class="btn btn-success" href="{{ route('hotel.create')}}">予約登録</a>
            </div>
        </div>
    </div>

    <div class="row" style="text-align:right">
        <div class="col-lg-12">
        @auth ログイン者 :{{ $user_name }} @endauth
        </div>
    </div>

    <div class="row" style="text-align:center">
        <div class="col-lg-12">
            @if ($message = Session::get('success'))
                <div class="alert alert-success mt-1"><p>{{$message}}</p></div>
            @endif
            @if ($message = Session::get('error'))
                <div class="alert alert-danger mt-1"><p>{{$message}}</p></div>
            @endif
        </div>
    </div>    

    <form action="" method="POST">
        <div class="col-12 mb-2 mt-2">
            <div class="form-group" align="left"> 
            割り増し倍率(土日) : <select name="extraCharge" id="extraCharge">
            <?php 
                $val = 1.3; 
                $ave = 0.1;
            ?>
            @for($i = 1; $i<=8; $i++)
                @if($i > 1) {
                    <option value="{{$i}}">{{  $val + $ave  }}</option>
                    {{   $val = $val +$ave  }}
                @else
                    <option value="{{$i}}">{{  $val  }}</option>
                @endif
            @endfor
            </select>
            </div>
        </div>
    </form>

    <br>
    <table class="table table-bordered">
        <tr>
            <th>チェックイン</th>
            <th>チェックアウト</th>
            <th>氏名</th>
            <th>メール</th>
            <th>宿泊人数</th>
            <th>ステータス</th>
            <th>料金</th>
            <th>備考欄</th>
            <th></th>
        </tr>
        @foreach ($hotels as $hotel)
        <!--
                    データベース内の情報を表示
                                                -->
        <tr>
            <td style="text-align:left">{{ $hotel->date1 }}</td>
            <td style="text-align:left">{{ $hotel->date2 }}</td>
            <td>{{ $hotel->name }}</td>
            <td style="text-align:left">{{ $hotel->email }}</td>
            <td style="text-align:center">{{ $hotel->adult+$hotel->child+$hotel->senior}}人</td>
            <td style="text-align:center">{{ $hotel->state }}</td>
            <td style="text-align:right">{{ $hotel->price }}円</td>
            <td style="text-align:left">{{ $hotel->remarks }}</td>
            <td style="text-align:center">
                <a class="btn btn-primary" href="{{  route('hotel.edit',$hotel->id)  }}">変更</a>
            </td>
        </tr>
        @endforeach
    </table>
 
    {!! $hotels->links('pagination::bootstrap-5') !!}
 
@endsection