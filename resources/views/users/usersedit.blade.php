
<form action="{{route('douseredit',['user_id'=>$user_id])}}" method="post">
    @csrf
    <table>
    @foreach ($userdata as $item)
        <tr>
            <td><input type="text" name="user_name" id="" value="{{ $item["user_name"]}}"></td>
            <td> {{$item["realname"]}} </td>
            <td> {{$item["birthday"]}} </td>
            <td> {{$item["gender"]}} </td>
            <td> {{$item["email"]}} </td>
        </tr>
    @endforeach
    <tr>
        <td><input type="submit" value="Submit"></td>
    </tr>
</table>
</form>

{{-- {{ var_dump($userdata)}} --}}