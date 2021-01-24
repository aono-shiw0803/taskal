@extends('layouts.index')

@section('breadcrumbs')
  {{ Breadcrumbs::render('files-create') }}
@endsection

@section('main')
<div class="page-title">
  <p>新規ファイルアップロード</p>
</div>
<div class="files-must">
  <p id="must"><span>※</span>は入力必須項目です。</p>
</div>
<form method="post" action="{{url('/files')}}" enctype="multipart/form-data">
  @csrf
  <table class="create-files-table">
    <tbody>
      <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
      <tr>
        <th>ファイル<span class="must">※</span></th>
        <td>
          <input type="file" name="file" value="{{old('file')}}">
          @if($errors->has('file'))
          <span id="error">{{$errors->first('file')}}</span>
          @endif
        </td>
      </tr>
      <tr>
        <th>ファイル形式<span class="must">※</span></th>
        <td id="radio-space">
          @foreach(config('const.typies') as $type)
            {{$type}}<input type="radio" name="type" value="{{$type}}">&nbsp;&nbsp;&nbsp;
          @endforeach
          @if($errors->has('type'))
            <span id="error">{{$errors->first('type')}}</span>
          @endif
        </td>
      </tr>
      <tr>
        <th>該当案件<span class="must">※</span></th>
        <td>
          <select name="matter" value="{{old('matter')}}">
            <option disabled selected value>選択してください</option>
            @foreach($matters as $matter)
            <option value="{{$matter->name}}">{{$matter->name}}</option>
              @endforeach
            </select>
            @if($errors->has('matter'))
            <span id="error">{{$errors->first('matter')}}</span>
            @endif
          </td>
        </tr>
          <tr>
            <th>備考</th>
            <td>
              <textarea id="textarea" name="content">{{old('content')}}</textarea>
              @if($errors->has('content'))
              <span id="error">{{$errors->first('content')}}</span>
              @endif
            </td>
          </tr>
          <tr>
            <th id="caution">※注意事項</th>
            <td id="caution">アップロードする「ファイル」と「ファイル形式」が一致しないと、正しくダウンロードができませんのでご注意ください。</td>
          </tr>
        </tbody>
      </table>
      <div class="create-files-btn-area">
        <ul>
          <li><input id="submit" type="submit" value="登録" onclick="return confirm('登録してもよろしいですか？')"></li>
        </ul>
      </div>
</form>
@endsection
