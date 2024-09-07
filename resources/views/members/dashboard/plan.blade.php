@extends('members.dashboard.layouts.app')
@section('content')

    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f4f4f4;
            margin: 0;
        }

        .subscription-cards {
            display: flex;
            gap: 20px;
        }

        .card {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 250px;
            text-align: center;
        }

        .card h2 {
            margin-top: 0;
        }

        .price {
            font-size: 24px;
            color: #333;
            margin: 10px 0;
        }

        .features {
            list-style: none;
            padding: 0;
        }

        .features li {
            background-color: #f9f9f9;
            margin: 5px 0;
            padding: 10px;
            border-radius: 4px;
        }

        .subscribe-btn {
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            padding: 10px 20px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        .subscribe-btn:hover {
            background-color: #0056b3;
        }

    </style>
    <div class="subscription-cards">
        @foreach ($packages as $package )


        <div class="card">
            <h2>{{ $package->name }}</h2>
            <p class="price">${{ $package->price }}/{{ $package->time }}</p>
            <ul class="features">
                {{ $package->description }}
            </ul>
            

            <a href="{{ route('plans.show', $package->price) }}" class="subscribe-btn">Subscribe</a>
        </div>

        @endforeach
    </div>
@endsection
