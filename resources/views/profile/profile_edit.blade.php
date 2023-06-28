@extends('layouts.app')

@section('content')

    <div class="prose ml-4">
        <h2> {{ $user->name }} のプロフィール編集ページ</h2>
    </div>

    <div class="flex justify-center">
        <form method="POST" action="{{ route('users.update', $user->id) }}" class="w-1/2">
            @csrf
            @method('PUT')
            
                <div class="form-control my-4">
                    <label for="name" class="label">
                        <span class="label-text">name:</span>
                    </label>
                    <input type="text" name="name" value="{{ $user->name }}" class="input input-bordered w-full">
                </div>

                <div class="form-control my-4">
                    <label for="email" class="label">
                        <span class="label-text">email:</span>
                    </label>
                    <input type="text" name="email" value="{{ $user->email }}" class="input input-bordered w-full">
                </div>
                
                <div class="form-control my-4">
                    <label for="biography" class="label">
                        <span class="label-text">biography:</span>
                    </label>
                    <input type="text" name="biography" value="{{ $user->biography }}" class="input input-bordered w-full">
                </div>
                
                <div class="form-control my-4">
                    <label for="location" class="label">
                        <span class="label-text">location:</span>
                    </label>
                    <input type="text" name="location" value="{{ $user->location }}" class="input input-bordered w-full">
                </div>

            <button type="submit" class="btn btn-outline">更新</button>
        </form>
    </div>

@endsection