@extends('backend.layout.master')


@section('content')
    <div class="main-content">
        <section class="section">

            <div class="section-header pl-0">
                <h1 class="pl-0">{{ __($pageTitle) }}</h1>
            </div>

            <div class="mb-4">
                <code class="mb-2 d-inline-block text-dark">
                    {{ __('Please Set Cron Url To Your Server') }}
                </code>
                <div class="input-group">
                    <input type="text" name="" class="form-control copy-text" value="curl -s {{ route('cron.collect.bonus') }}">
                    <div class="input-group-append">
                        <button class="input-group-text gr-bg-1 text-white copy" type="button" id="button-addon2">{{ __('Copy Cron Url') }}</button>
                    </div>
                </div>
                {{-- <div class="input-group">
                    <input type="text" name="" class="form-control copy-text" value="curl -s {{ route('returninterest') }}">
                    <div class="input-group-append">
                        <button class="input-group-text gr-bg-1 text-white copy" type="button" id="button-addon2">{{ __('Copy Cron Url') }}</button>
                    </div>
                </div> --}}
            </div>

            <div class="row">
                <div class="col-12">
                    <h6 class="my-3"><i data-feather="calendar"></i> Total Section</h6>
                    <hr>
                </div>
                {{-- <div class="custom-xxxl-4 custom-xxl-4 col-md-6 col-sm-6 col-12 mb-4">
                    <div class="card-stat gr-bg-1">
                        <div class="icon">
                            <i class="fas fa-money-bill-wave-alt"></i>
                        </div>
                        <div class="content">
                            <p class="caption">{{ __('Total Invest') }}</p>
                            <h4 class="card-stat-amount">{{ number_format($totalPayments, 2) . ' ' . @$general->site_currency }}</h4>
                        </div>
                    </div>
                </div>
                <div class="custom-xxxl-4 custom-xxl-4 col-md-6 col-sm-6 col-12 mb-4">
                    <div class="card-stat gr-bg-2">
                        <div class="icon">
                            <i class="fas fa-spinner"></i>
                        </div>
                        <div class="content">
                            <p class="caption">{{ __('Total Pending Invest') }}</p>
                            <h4 class="card-stat-amount">{{ number_format($totalPendingPayments, 2) . ' ' . @$general->site_currency }}</h4>
                        </div>
                    </div>
                </div>

                <div class="custom-xxxl-4 custom-xxl-4 col-md-6 col-sm-6 col-12 mb-4">
                    <div class="card-stat gr-bg-3">
                        <div class="icon">
                            <i class="fas fa-spinner"></i>
                        </div>
                        <div class="content">
                            <p class="caption">{{ __('Total Interest Amount') }}</p>
                            <h4 class="card-stat-amount">{{ number_format($totalInterest, 2) . ' ' . @$general->site_currency }}</h4>
                        </div>
                    </div>
                </div> --}}

                <div class="custom-xxxl-4 custom-xxl-4 col-md-4 col-sm-6 col-12 mb-4">
                    <div class="card-stat gr-bg-4">
                        <div class="icon">
                            <i class="far fa-user"></i>
                        </div>
                        <div class="content">
                            <p class="caption">{{ __('Total User') }}</p>
                            <h4 class="card-stat-amount">{{ $totalUser }}</h4>
                        </div>
                    </div>
                </div>

                <div class="custom-xxxl-4 custom-xxl-4 col-md-4 col-sm-6 col-12 mb-4">
                    <div class="card-stat gr-bg-3">
                        <div class="icon">
                            <i class="fas fa-user-tie"></i>
                        </div>
                        <div class="content">
                            <p class="caption">{{ __('Total Active User') }}</p>
                            <h4 class="card-stat-amount">{{ $activeUser }}</h4>
                        </div>
                    </div>
                </div>
                <div class="custom-xxxl-4 custom-xxl-4 col-md-4 col-sm-6 col-12 mb-4">
                    <div class="card-stat gr-bg-2">
                        <div class="icon">
                            <i class="fas fa-user-times"></i>
                        </div>
                        <div class="content">
                            <p class="caption">{{ __('Total Ban User') }}</p>
                            <h4 class="card-stat-amount">{{ $deActiveUser }}</h4>
                        </div>
                    </div>
                </div>

                <div class="custom-xxxl-6 custom-xxl-6 col-md-6 col-sm-6 col-12 mb-4">
                    <div class="card-stat gr-bg-10">
                        <div class="icon">
                            <i class="fa-brands fa-bitcoin fa-shake"></i>
                        </div>
                        <div class="content">
                            <p class="caption">{{ __('Total Trade Profit') }}</p>
                            <h4 class="card-stat-amount">{{ number_format(@$tradingProfit, 2) . ' ' . @$general->site_currency }}</h4>
                        </div>
                    </div>
                </div>
                <div class="custom-xxxl-6 custom-xxl-6 col-md-6 col-sm-6 col-12 mb-4">
                    <div class="card-stat gr-bg-7">
                        <div class="icon">
                            <i class="fa-brands fa-bitcoin fa-shake"></i>
                        </div>
                        <div class="content">
                            <p class="caption">{{ __('Total Trade Lose') }}</p>
                            <h4 class="card-stat-amount">{{ number_format(@$tradingLose, 2) . ' ' . @$general->site_currency }}</h4>
                        </div>
                    </div>
                </div>

                <div class="custom-xxxl-6 custom-xxl-6 col-md-6 col-sm-6 col-12 mb-4">
                    <div class="card-stat gr-bg-5">
                        <div class="icon">
                            <i class="fas fa-hand-holding-usd"></i>
                        </div>
                        <div class="content">
                            <p class="caption">{{ __('Total Deposit') }}</p>
                            <h4 class="card-stat-amount">{{ number_format(@$totalDeposit, 2) . ' ' . @$general->site_currency }}</h4>
                        </div>
                    </div>
                </div>
                <div class="custom-xxxl-6 custom-xxl-6 col-md-6 col-sm-6 col-12 mb-4">
                    <div class="card-stat gr-bg-4">
                        <div class="icon">
                            <i class="fa-solid fa-spinner fa-spin"></i>
                        </div>
                        <div class="content">
                            <p class="caption">{{ __('Total Pending Deposit') }}</p>
                            <h4 class="card-stat-amount">{{ number_format(@$pendignDeposit, 2) . ' ' . @$general->site_currency }}</h4>
                        </div>
                    </div>
                </div>

                <div class="custom-xxxl-6 custom-xxl-6 col-md-6 col-sm-6 col-12 mb-4">
                    <div class="card-stat gr-bg-7">
                        <div class="icon">
                            <i class="fas fa-hand-holding-usd"></i>
                        </div>
                        <div class="content">
                            <p class="caption">{{ __('Total Withdraw') }}</p>
                            <h4 class="card-stat-amount">{{ number_format(@$totalWithdraw, 2) . ' ' . @$general->site_currency }}</h4>
                        </div>
                    </div>
                </div>

                <div class="custom-xxxl-6 custom-xxl-6 col-md-6 col-sm-6 col-12 mb-4">
                    <div class="card-stat gr-bg-8">
                        <div class="icon">
                            <i class="fa-solid fa-spinner fa-spin"></i>
                        </div>
                        <div class="content">
                            <p class="caption">{{ __('Total Pending Withdraw') }}</p>
                            <h4 class="card-stat-amount">{{ number_format(@$pendignWithdraw, 2) . ' ' . @$general->site_currency }}</h4>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <h6 class="my-3"><i data-feather="calendar"></i> Today Section</h6>
                    <hr>
                </div>
                <div class="custom-xxxl-4 custom-xxl-4 col-md-4 col-sm-6 col-12 mb-4">
                    <div class="card-stat gr-bg-1">
                        <div class="icon">
                            <i class="fas fa-money-bill-wave-alt"></i>
                        </div>
                        <div class="content">
                            <p class="caption">{{ __('Today Trade Runing') }}</p>
                            <h4 class="card-stat-amount">{{ number_format($todayTrading, 2) . ' ' . @$general->site_currency }}</h4>
                        </div>
                    </div>
                </div>

                <div class="custom-xxxl-4 custom-xxl-4 col-md-4 col-sm-6 col-12 mb-4">
                    <div class="card-stat gr-bg-3">
                        <div class="icon">
                            <i class="fas fa-hand-holding-usd"></i>
                        </div>
                        <div class="content">
                            <p class="caption">{{ __('Today Deposit') }}</p>
                            <h4 class="card-stat-amount">{{ number_format(@$todayDeposit, 2) . ' ' . @$general->site_currency }}</h4>
                        </div>
                    </div>
                </div>

                <div class="custom-xxxl-4 custom-xxl-4 col-md-4 col-sm-6 col-12 mb-4">
                    <div class="card-stat gr-bg-7">
                        <div class="icon">
                            <i class="fas fa-hand-holding-usd"></i>
                        </div>
                        <div class="content">
                            <p class="caption">{{ __('Today Withdraw') }}</p>
                            <h4 class="card-stat-amount">{{ number_format(@$todayWithdraw, 2) . ' ' . @$general->site_currency }}</h4>
                        </div>
                    </div>
                </div>
            </div>

            {{-- <div class="row">
                <div class="col-12">
                    <h6 class="my-3"><i data-feather="box"></i> Others Section</h6>
                    <hr>
                </div>
                <div class="custom-xxxl-4 custom-xxl-4 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon gr-bg-1 rounded-circle">
                            <i class="fas fa-dungeon"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>{{ __('Withdraw Charge') }}</h4>
                            </div>
                            <div class="card-body">
                                {{ number_format($totalWithdrawCharge, 2) . ' ' . @$general->site_currency }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="custom-xxxl-4 custom-xxl-4 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon gr-bg-1 rounded-circle">
                            <i class="fas fa-hand-holding-usd"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>{{ __('Withdraw Gateways') }}</h4>
                            </div>
                            <div class="card-body">
                                {{ $totalWithdrawGateways }}
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}

            {{-- <div class="row">
                <div class="col-md-6 col-12 col-lg-6">
                    <div class="card invest-report-card">
                        <div class="card-header gr-bg-1">
                            <h4 class="text-white">{{ __('Invest Report') }}</h4>
                        </div>
                        <div class="card-body">
                            <canvas id="myChart2"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-md-6  col-12 col-lg-6">
                    <div class="card invest-report-card">
                        <div class="card-header gr-bg-1">
                            <h4 class="text-white">{{ __('Withdraw Report') }}</h4>
                        </div>
                        <div class="card-body">
                            <canvas id="myChart3"></canvas>
                        </div>
                    </div>
                </div>
            </div> --}}

            <div class="row">
                <div class="col-md-12  col-lg-12 col-12 all-users-table">
                    <div class="card-header">
                        <h5>{{ __('All Users') }}</h5>
                    </div>
                    <div class="card">
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table id="example" class="table">
                                    <thead>
                                        <tr>
                                            <th>{{ __('Sl') }}</th>
                                            <th>{{ __('User Name') }}</th>
                                            <th>{{ __('Email') }}</th>
                                            <th>{{ __('Status') }}</th>
                                            <th>{{ __('Action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($users as $key => $user)
                                            <tr>
                                                <td>{{ $key + $users->firstItem() }}</td>
                                                <td>{{ $user->username }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>
                                                    @if ($user->status)
                                                        <span class='badge badge-success'>{{ __('Active') }}</span>
                                                    @else
                                                        <span class='badge badge-danger'>{{ __('Inactive') }}</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('admin.user.details', $user) }}"
                                                        class="btn btn-md btn-primary"><i class="fa fa-pen"></i></a>
                                                </td>
                                            </tr>
                                        @empty
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @if ($users->hasPages())
                            <div class="card-footer">
                                {{ $users->links('backend.partial.paginate') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('script')
    <script src="{{ asset('asset/admin/js/chart.min.js') }}"></script>

    <script>
        'use strict'
        var copyButton = document.querySelector('.copy');
        var copyInput = document.querySelector('.copy-text');
        copyButton.addEventListener('click', function(e) {
            e.preventDefault();
            var text = copyInput.select();
            document.execCommand('copy');
            notifyMsg('Copied SuccessFully!', 'success')
        });
        copyInput.addEventListener('click', function() {
            this.select();
        });

        var ctx2 = document.getElementById('myChart2').getContext('2d');
        var myChart2 = new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: @json($months),
                datasets: [{
                    label: 'Total Invests',
                    barThickness: 10,
                    maxBarThickness: 12,
                    data: @json($totalAmount),
                    backgroundColor: ['#2C86DB'],
                    borderColor: [
                        '#2C86DB'
                    ],
                    borderWidth: 2,
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });



        var ctx3 = document.getElementById('myChart3').getContext('2d');
        var myChart3 = new Chart(ctx3, {
            type: 'bar',
            data: {
                labels: @json($withdrawMonths),
                datasets: [{
                    label: 'Total Withdraw',
                    barThickness: 10,
                    maxBarThickness: 12,
                    data: @json($withdrawTotalAmount),
                    backgroundColor: ['#2C86DB'],
                    borderColor: [
                        '#2C86DB'
                    ],
                    borderWidth: 2
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

@endpush
