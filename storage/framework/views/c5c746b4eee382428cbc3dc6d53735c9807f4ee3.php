<div class="container">
    <div class="card mt-2">
        <div class="card-body text-center">
            <h3 class="pb-2 mb-1 border-bottom">Records</h3>
            <div class="row justify-content-center">
                <div class="col-3 d-inline-block text-truncate px-1 mb-1">
                    <a class="btn btn-primary btn-sm w-100 logNav transactionLogBtn" id="logNavTransaction" href="#">All</a>
                </div>
                <div class="col-3 d-inline-block text-truncate px-1 mb-1">
                    <a class="btn btn-primary btn-sm w-100 logNav depositLogBtn" id="logNavDeposit" href="#" >Deposit</a>
                </div>
                <div class="col-3 d-inline-block text-truncate px-1 mb-1">
                    <a class="btn btn-primary btn-sm w-100 logNav withdrawLogBtn" id="logNavWithdraw" href="#">Withdraw</a>
                </div>
                
                <div class="col-3 d-inline-block text-truncate px-1 mb-1">
                    <a class="btn btn-primary btn-sm w-100 logNav commisionLogBtn" id="logNavReferral" href="#">Commision</a>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    console.log($('#currentPath').html());

    $('.logNav').removeClass('disabled');

    if( $('#currentPath').html() == 'Deposit_Log' ){
        $('#logNavDeposit').addClass("disabled");
    }
    if( $('#currentPath').html() == 'Withdraw_Log' ){
        $('#logNavWithdraw').addClass("disabled");
    }
    if( $('#currentPath').html() == 'Invest_Log' ){
        $('#logNavInvest').addClass("disabled");
    }
    if( $('#currentPath').html() == 'Interest_Log' ){
        $('#logNavInterest').addClass("disabled");
    }
    // if( $('#currentPath').html() == 'Transfer_Log' ){
    //     $('#logNavTransfer').addClass("disabled");
    // }
    if( $('#currentPath').html() == 'Transaction_Log' ){
        $('#logNavTransaction').addClass("disabled");
    }
    if( $('#currentPath').html() == 'Referral_Log' ){
        $('#logNavReferral').addClass("disabled");
    }

</script>
<?php /**PATH /home/u207221236/domains/codeshack.net/public_html/tradedemo/core/resources/views/theme3/includes/user/logs_nav.blade.php ENDPATH**/ ?>