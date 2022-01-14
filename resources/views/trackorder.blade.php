@extends('layouts.master')
@section('content')
    <style>
        .stepper-wrapper {
            margin-top: auto;
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .stepper-item {
            position: relative;
            display: flex;
            flex-direction: column;
            align-items: center;
            flex: 1;

            @media (max-width: 768px) {
                font-size: 12px;
            }
        }

        .stepper-item::before {
            position: absolute;
            content: "";
            border-bottom: 2px solid #ccc;
            width: 100%;
            top: 20px;
            left: -50%;
            z-index: 2;
        }

        .stepper-item::after {
            position: absolute;
            content: "";
            border-bottom: 2px solid #ccc;
            width: 100%;
            top: 20px;
            left: 50%;
            z-index: 2;
        }

        .stepper-item .step-counter {
            position: relative;
            z-index: 5;
            display: flex;
            justify-content: center;
            align-items: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #ccc;
            margin-bottom: 6px;
        }

        .stepper-item.active {
            font-weight: bold;
        }

        .stepper-item.completed .step-counter {
            background-color: #4bb543;
        }

        .stepper-item.completed::after {
            position: absolute;
            content: "";
            border-bottom: 2px solid #4bb543;
            width: 100%;
            top: 20px;
            left: 50%;
            z-index: 3;
        }

        .stepper-item:first-child::before {
            content: none;
        }

        .stepper-item:last-child::after {
            content: none;
        }

    </style>
    <!-- About-us Content -->
    <section class="pro-content empty-content">
        <div class="container">

            <?php
            $statuses = ['Pending', 'Inprocess', 'Dispatched', 'Shipped', 'Complete'];
            ?>

            <div class="row">
                <div class="col-12">
                    <div class="mt-5" style="text-align: center">

                        <h2>Order#{{ $order_id }}</h2>
                        <p>Your Order is {{ $order_status }}</p>
                        <div class="stepper-wrapper">
                            {{-- @foreach (['Pending' => 'Pending', 'Inprocess' => 'Inprocess', 'Dispatched' => 'Dispatched', 'Shipped' => 'Shipped', 'Complete' => 'Completed'] as $key => $value)
                                <div class="stepper-item {{ $key == $order_status ? 'completed' : '' }}">
                                    <div class="step-counter">1</div>
                                    <div class="step-name">{{ $value }}</div>
                                </div>
                            @endforeach --}}
                           
                            @foreach ($statuses as $key => $value)
                                <div class="stepper-item {{ $order_status == $value && (array_search($value, $statuses) >= $key )  ? 'completed' : '' }}">
                                    <div class="step-counter">{{ $key + 1 }}</div>
                                    <div class="step-name">{{ $value }}</div>
                                </div>

                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

        </div>


    </section>

@endsection
@section('script')
@endsection
