<div class="allLoanIndex width">
    <div class="loanTitle">
        <i>
            <svg class="icon">
                <use xlink:href="#box"></use>
            </svg>
        </i>
        {{$data['title']}}
    </div>
    <div class="loadContainer">
        <div class="loanItems">
            <div class="loanItem">
                <label for="amountLoan">{{__('messages.loan1')}}</label>
                <div class="inputs">
                    <span>0</span>
                    <input min="0" max="{{$maxPriceLoan}}" name="amount" step="1000000" type="range">
                    <span>{{number_format($maxPriceLoan)}} {{__('messages.arz')}}</span>
                </div>
            </div>
            <div class="loanItem">
                <label for="monthLoan">{{__('messages.loan2')}}</label>
                <div class="inputs">
                    <span>1</span>
                    <input min="1" max="{{$maxMonthLoan}}" name="month" type="range">
                    <span>{{$maxMonthLoan}} {{__('messages.month')}}</span>
                </div>
            </div>
        </div>
        <div class="loanDetail">
            <div class="loanDetailItems">
                <div class="loanDetailItem">
                    <h5>{{__('messages.loan_price')}}</h5>
                    <p id="amountLoan1">0</p>
                </div>
                <div class="loanDetailItem">
                    <h5>{{__('messages.loan_month')}}</h5>
                    <p id="monthLoan1">1</p>
                </div>
                <div class="loanDetailItem">
                    <h5>{{__('messages.loan_install')}}</h5>
                    <p id="monthLoan2">1</p>
                </div>
                <div class="loanDetailItem">
                    <h5>{{__('messages.loan_profit')}}</h5>
                    <p id="profitLoan">0</p>
                </div>
                <div class="loanDetailItem">
                    <h5>{{__('messages.loan_amount')}}</h5>
                    <p id="refundLoan">0</p>
                </div>
            </div>
        </div>
        <div class="loanRecord">
            <h4>{{__('messages.loan_body')}}</h4>
            <button>{{__('messages.loan_send')}}</button>
        </div>
    </div>
</div>
