@extends(template().'layout.master2')


@section('content2')
    <div class="dashboard-body-part">
        <div class="card-body text-end">
            <form action="" method="get" class="d-inline-flex">
               
                <input type="date" class="form-control me-3" placeholder="Search User" name="date">
                <button type="submit" class="cmn-btn">{{ __('Search') }}</button>
            </form>
        </div>
        <div class="table-responsive">
            <table class="table cmn-table">
                <thead>
                    <tr class="bg-yellow">
                        <th>{{ __('Plan Name') }}</th>
                        <th>{{ __('Interest') }}</th>
                        <th>{{ __('Invest Amount') }}</th>
                        <th>{{ __('Payment Date') }}</th>
                        <th>{{ __('Next Payment Date') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($interestLogs as $log)
                        <tr>
                            <td data-caption="{{ __('Plan Name') }}">{{ $log->payment->plan->plan_name }}</td>
                            <td data-caption="{{ __('Interest') }}">{{ number_format($log->interest_amount, 2) }}
                                {{ @$general->site_currency }}</td>
                            <td data-caption="{{ __('Invest Amount') }}">{{ number_format($log->payment->amount, 2) }}
                                {{ @$general->site_currency }}</td>
                            <td data-caption="{{ __('Payment Date') }}">{{ $log->created_at }}</td>
                            <td data-caption="{{ __('Next Payment Date') }}">{{ isset($log->payment->next_payment_date) ? $log->payment->next_payment_date : 'Plan Expired' }}
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
@endsection
