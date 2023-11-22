<!DOCTYPE html>
<html>
<head>
    @include('Admin/includes/header')
</head>
<body>
<div class="container-fluid">
    <div class="row admin-header">
        <div class="col-md-6 col-xs-6 text-left"><p><a href="/admin">{{ Auth::user()->name }}</a></p></div>
        <div class="col-md-6 col-xs-6 text-right"><p><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a></p></div>
    </div>
    <div class="row admin-workspace">
        <div class="col-md-2 ad-leftbar">

        </div>
        <div class="col-md-10 ad-rightbar">
            <table class="table table-striped">
                <tr>
                    <th>Name</th>
                    <th>Price</th>
                    <th>E-email</th>
                    <th>Created at</th>
                </tr>
                @foreach ( $orders as $item)
                    <tr>
                        <td>{{ $item->name }} </td>
                        <td>{{ $item->price }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->created_at }}</td>

                        <td class="table-auto-width">
                            <a href="/admin/delOrder/{{$item->id}}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>

<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>
</html>
