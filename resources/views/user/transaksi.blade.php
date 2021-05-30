@extends('layouts.app')

@section('content')
<!--================Checkout Area =================-->
@if(isset($transactions))
  <section class="cart_area">
    <div class="container toparea">
      <div class="underlined-title">
          <div class="editContent">
              <h1 class="text-center latestitems">YOUR TRANSACTIONS</h1>
          </div>
          <div class="wow-hr type_short">
              <span class="wow-hr-h">
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              </span>
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="cart_inner">
        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th>
                  <strong style="color:Black;">Payment Timeout</strong>
                </th>
                <th>
                  <strong style="color:Black;">Transaction ID</strong>
                </th>
                <th>
                  <strong style="color:Black;">Address</strong>
                </th>
                <th>
                  <strong style="color:Black;">Regency</strong>
                </th>
                <th>
                    <strong style="color:Black;">Province</strong>
                </th>
                <th>
                    <strong style="color:Black;">Total</strong>
                </th>
                <th>
                    <strong style="color:Black;">Status</strong>
                </th>
                <th>
                  <strong style="color:Black;">Detail</strong>
                </th>
              </tr>
            </thead>
            <tbody>
              @foreach ($transactions as $transaction)
                <tr> 
                  <td>
                    @if ($transaction->status == 'unverified' & $transaction->timeout > date('Y-m-d H:i:s') & is_null($transaction->proof_of_payment))
                      @php
                        date_default_timezone_set("Asia/Makassar");
                        $date1 = new DateTime($transaction->timeout);
                        $date2 = new DateTime(date('Y-m-d H:i:s'));
                        $tenggat = $date1->diff($date2);
                      @endphp
                        <span class="btn-sm btn-warning font-weight-bold">{{$tenggat->h}} Jam, {{$tenggat->i}} Menit</span>
                    @else
                    <div class="text-center">
                      <strong> --- </strong>
                    </div>
                    @endif
                  </td>               
                  <td>
                      <p style="color:Black;">{{$transaction->id}}</p>
                  </td>
                  <td>
                      <p style="color:Black;">{{$transaction->address}}</p>
                  </td>
                  <td>
                      <p style="color:Black;">{{$transaction->regency}}</p>
                  </td>
                  <td>
                      <p style="color:Black;">{{$transaction->province}}</p>
                  </td>
                  <td>
                      <p style="color:Black;">Rp{{number_format($transaction->total)}}</p>
                  </td>
                  <td class="text-center">
                    @if ($transaction->status == 'success')
                      <span style="color: white;" class="btn-sm btn-success font-weight-bold  mt-1 btn-lg btn-block">{{$transaction->status}}</span>
                    @elseif ($transaction->status == 'delivered' || $transaction->status == 'verified' || $transaction->status == 'indelivery' || $transaction->status == 'waiting approval')
                      <span style="color: white;" class="btn-sm btn-warning font-weight-bold  mt-1 btn-lg btn-block">{{$transaction->status}}</span>
                    @else
                      <span style="color: white;" class="btn-sm btn-danger font-weight-bold mt-1 btn-lg btn-block">{{$transaction->status}}</span>
                    @endif
                  </td>
                  <td>
                    <a href="/transaksi/detail/{{Crypt::encrypt($transaction->id)}}"><strong>See Detail</strong></a>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
          <div class="row">
              <div class="col-md-12 text-center">
                  Page : {{ $transactions->currentPage() }} || Item Per Page : {{ $transactions->perPage() }} <br/>
                  {{ $transactions->links() }}
              </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@else
  <section class="item content">
    <div class="container toparea">
      <div class="underlined-title">
        <div class="editContent">
          <h1 class="text-center latestitems">Transaction Not Found!</h1>
        </div>
        <div class="wow-hr type_short">
          <span class="wow-hr-h">
          <i class="fa fa-star"></i>
          <i class="fa fa-star"></i>
          <i class="fa fa-star"></i>
          </span>
        </div>
      </div>
    </div>
  </section>
  <script>
    alert("Transaction Not Found! Redirecting Back to Home.");
    window.location.href = '/';
  </script>
@endif
<!--================End Checkout Area =================-->
@endsection