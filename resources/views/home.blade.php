@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @if($errors->any())
                <div class="alert alert-primary d-flex justify-content-between align-items-center" role="alert">
                    {{$errors->first()}}
                    <button type="button" class="btn-close" aria-label="Close" onclick="closeParent(event)"></button>
                </div>
            @endif
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <span>User Details</span>
                    <button type="button" data-bs-toggle="modal" data-bs-target="#addUser" class="btn btn-success btn-sm">Add User</button>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{-- {{ __('You are logged in!') }} --}}
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Counter</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{$user->id}}</td>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>{{$user->counter}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="addUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        {{-- <h5 class="modal-title" id="exampleModalLabel">Modal title</h5> --}}
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{url('postData')}}" method="POST">
            @csrf
            <div class="mb-3">
              <label for="name" class="form-label">Name</label>
              <input type="text" class="form-control" id="name" name="name">
              @error('name')
              <div class="form-text">{{$message}}</div>
              @enderror
            </div>
            <div class="mb-3">
              <label for="email" class="form-label">Email address</label>
              <input type="email" class="form-control" id="email" name="email">
              @error('email')
                <div class="form-text">{{$message}}</div>
              @enderror
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
      </div>
    </div>
  </div>
</div>
</div>
<script>
    function closeParent(e){
     let parentEl = e.target.parentElement;
     if(parentEl.classList.contains('d-flex')){
        parentEl.classList.remove('d-flex')
        parentEl.classList.add('d-none')
     }
    }
</script>
@endsection
