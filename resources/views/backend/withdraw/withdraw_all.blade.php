@extends('backend.layout.master')

@section('content')
    <div class="main-content">
        <div class="row withdraw-all-row">

            <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>{{ __('User') }}</th>
                                        <th>{{ __('Withdraw Amount') }}</th>
                                        <th>{{ __('User Will Get') }}</th>
                                        {{-- <th>{{ __('Charge Type') }}</th> --}}
                                        <th>{{ __('Charge') }}</th>
                                        <th>{{ __('status') }}</th>
                                        <th>{{ __('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($withdrawlogs as $key => $withdrawlog)
                                        <tr>
                                            <td>

                                                <a href="{{route('admin.user.details', $withdrawlog->user->id)}}" >
                                                    <span class="ml-2">
                                                        {{$withdrawlog->user->username}}
                                                    </span>
                                                </a>

                                            </td>

                                            {{-- <td>{{ $general->currency_icon . '  ' . $withdrawlog->withdraw_amount + ($withdrawlog->withdrawMethod->charge_type === 'percent'
                                                    ? ($withdrawlog->withdraw_amount * $withdrawlog->withdraw_charge) / 100
                                                    : $withdrawlog->withdraw_amount) }}
                                            </td> --}}
                                            <td>
                                                {{ showAmount($withdrawlog->withdraw_amount) }} {{@$general->site_currency}}
                                            </td>
                                            <td>
                                                {{ showAmount($withdrawlog->withdraw_amount - $withdrawlog->withdraw_charge) }} {{@$general->site_currency}}
                                            </td>
                                            {{-- <td>
                                                {{ ucwords($withdrawlog->withdrawMethod->charge_type) }}
                                            </td> --}}
                                            <td>
                                                {{ number_format($withdrawlog->withdraw_charge, 2) }} {{@$general->site_currency}}
                                            </td>
                                            <td>
                                                @if ($withdrawlog->status == 1)
                                                    <span class="badge badge-success">{{ __('Success') }}</span>
                                                @elseif($withdrawlog->status == 2)
                                                    <span class="badge badge-danger">{{ __('Rejected') }}</span>
                                                @else
                                                    <span class="badge badge-warning">{{ __('Pending') }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <button class="btn btn-md btn-info details"
                                                    data-user_data="{{ json_encode($withdrawlog->user_withdraw_prof) }}"
                                                    data-transaction="{{ $withdrawlog->transaction_id }}"
                                                    data-amount="{{ $withdrawlog->withdraw_amount }}"
                                                    data-charge="{{ $withdrawlog->withdraw_charge }}"
                                                    data-payment_details_lebel="{{ $withdrawlog->withdrawMethod->payment_details_lebel }}"
                                                    data-singel_currency="{{ $withdrawlog->withdrawMethod->singel_currency }}"
                                                    data-singel_rate="{{ $withdrawlog->withdrawMethod->singel_rate }}"
                                                    data-provider="{{ $withdrawlog->user->fullname }}"
                                                    data-username="{{ $withdrawlog->user->username }}"
                                                    data-user="{{ $withdrawlog->user }}"
                                                    data-informations="{{ $withdrawlog->informations }}"
                                                    data-email="{{ $withdrawlog->user->email }}"
                                                    data-method_name="{{ $withdrawlog->withdrawMethod->name }}"
                                                    data-date="{{ __($withdrawlog->created_at->format('d F Y')) }}">{{ __('Details') }}</button>
                                                @if ($withdrawlog->status == 0)
                                                    <button class="btn btn-md btn-primary accept"
                                                        data-url="{{ route('admin.withdraw.accept', $withdrawlog) }}">{{ __('Accept') }}</button>
                                                    <button class="btn btn-md btn-danger reject"
                                                        data-url="{{ route('admin.withdraw.reject', $withdrawlog) }}">{{ __('Reject') }}</button>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td class="text-center" colspan="100%">{{ __('No Data Found') }}</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @if ($withdrawlogs->hasPages())
                        {{ $withdrawlogs->links('backend.partial.paginate') }}
                    @endif
                </div>
            </div>
        </div>
    </div>



    <!-- Modal -->
    <div class="modal fade" id="details" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">


            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('Withdraw Details') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid withdraw-details">

                    </div>
                    <div class="container-fluid withdraw-infos mt-3">


                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">{{ __('Close') }}</button>

                </div>
            </div>

        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="accept" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">

            <form action="" method="post">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ __('Withdraw Accept') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <p>{{ __('Are you sure to Accept this withdraw request') }}?</p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">{{ __('Close') }}</button>
                        <button type="submit" class="btn btn-primary">{{ __('Accept') }}</button>

                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="reject" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">

            <form action="" method="post">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ __('Withdraw Reject') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="form-group col-md-12">

                                <label for="">{{ __('Reason Of Reject') }}</label>
                                <textarea name="reason_of_reject" id="" cols="30" rows="10" class="form-control"> </textarea>

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
                        <button type="submit" class="btn btn-danger">{{ __('Reject') }}</button>

                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection


@push('style')
    <style>
        .image-rounded{
            width: 50px;
            height: 50px;
        }
    </style>
@endpush


{{-- @if (strtolower($withdrawal->method->currency) == 'bdt' || strtolower($withdrawal->method->currency) == 'taka' || strtolower($withdrawal->method->currency) == 'tk')
    @if (@$withdrawal->user->bdt_wallet_number)
        <div class="row mt-4">
            <div class="col-md-12">
                <h6>{{__($withdrawal->method->name)}} Number</h6>
                <p>{{ @$withdrawal->user->bdt_wallet_number }}</p>
            </div>
        </div>
    @endif
@endif

@if (strtolower($withdrawal->method->currency) == 'usdt')
    @if (@$withdrawal->user->usdt_wallet_address)
        <div class="row mt-4">
            <div class="col-md-12">
                <h6>USDT (TRC20) Wallet Address</h6>
                <p>{{ @$withdrawal->user->usdt_wallet_address }}</p>
            </div>
        </div>
    @endif
@endif --}}

@push('script')
    <script>
        $(function() {
            'use strict'

            $('.details').on('click', function() {
                const modal = $('#details');

                let html = `

                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ __('Withdraw Amount') }}
                            <span>${ Number.parseFloat($(this).data('amount')).toFixed(2) } {{@$general->site_currency}}</span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ __('User Will Get') }}
                            <span>${ Number.parseFloat( ($(this).data('amount') - $(this).data('charge')) * $(this).data('singel_rate')).toFixed(2) } ${$(this).data('singel_currency')}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ __('Transaction Id') }}
                            <span>${$(this).data('transaction')}</span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ __('Username') }}
                            <span>${$(this).data('username')}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ __('Withdraw Date') }}
                            <span>${$(this).data('date')}</span>
                        </li>
                    </ul>


                `;

                modal.find('.withdraw-details').html(html);

                let informations = $(this).data('informations');
                let infos = '';
                // console.log(informations);

                // $.each(informations, function (index, value) {
                //     infos += `
                //         <li class="list-group-item">${cap1stLeter(index.replace('_', " "))} : ${value}</li>
                //     `;
                // });

                // if (infos) {
                //     $('.withdraw-infos').html(`

                //         <h6 class="mb-3 text-center">
                //             Informations
                //         </h6>
                //         <ul class="list-group">
                //             ${infos}
                //         </ul>

                //     `);
                // } else {
                //     $('.withdraw-infos').html(``);
                // }

                let walletInfo = '';
                let thisUser = $(this).data('user');
                let singel_currency = $(this).data('singel_currency');
                    singel_currency = singel_currency.toLowerCase();

                if (singel_currency == 'usdt' && thisUser.usdt_wallet_address) {
                    walletInfo = `
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Gateway <span>${$(this).data('method_name')}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            USDT Wallet Address <span>${thisUser.usdt_wallet_address}</span>
                        </li>
                    `;
                } else if (singel_currency != 'usdt' && thisUser.bdt_wallet_number) {
                    walletInfo = `
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Gateway <span>${$(this).data('method_name')}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Wallet Address <span>${thisUser.bdt_wallet_number}</span>
                        </li>
                    `;
                }

                if (walletInfo) {
                    $('.withdraw-infos').html(`

                        <h6 class="mb-3 text-center">
                            Informations
                        </h6>
                        <ul class="list-group">
                            ${walletInfo}
                        </ul>

                    `);
                } else {
                    $('.withdraw-infos').html(``);
                }

                modal.modal('show');
            })

            $('.accept').on('click', function() {
                const modal = $('#accept');

                modal.find('form').attr('action', $(this).data('url'));
                modal.modal('show');
            })

            $('.reject').on('click', function() {
                const modal = $('#reject');

                modal.find('form').attr('action', $(this).data('url'));
                modal.modal('show');
            })

        })

        //cap 1st leter
        const cap1stLeter = (string) => {
            return string.charAt(0).toUpperCase() + string.slice(1);
        }
    </script>
@endpush
