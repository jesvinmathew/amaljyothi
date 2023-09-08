<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Uploads') }}
        </h2>
    </x-slot>

    <div class="container py-12">
        <div class="card">
            <div class="card-header">
                List of Files
                @if(Auth::user()->user_type_id==1)
                    <div class="float-end"><a href="{{route('uploads.create')}}">Add</a></div>
                @endif
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">User</th>
                            <th scope="col">Name</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($uploads as $key => $upload)
                            <tr>
                                <th scope="row">{{$key+1}}</th>
                                <td>{{$upload->User->name}}</td>
                                <td>{{$upload->name}}</td>
                                <td>
                                    <a href="{{route('uploads.show', $upload->id)}}">Show</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{$uploads}}
            </div>
        </div>
    </div>
</x-app-layout>
