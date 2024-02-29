<?php $__env->startSection('content2'); ?>
<style>
    [chrome-autofilled] {
        color: #ffffff !important;
    }
</style>
    <div class="container">
        <div class="row gy-4">
            <div class="col-12">
                <div class="site-card">
                    <form action="" method="post">
                        <?php echo csrf_field(); ?>
                        <div class="card-header">
                            <h5 class="mb-0">
                                <?php echo e(__('Current Balance: ')); ?> <span class="color-change"><?php echo e(number_format(auth()->user()->balance, 2) . ' ' . $general->site_currency); ?></span>
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for=""><?php echo e(__('Withdraw Method')); ?></label>
                                <select name="method" id="" class="select">
                                    <option value="" selected><?php echo e(__('Select Method')); ?></option>
                                    <?php $__currentLoopData = $withdraws; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $withdraw): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($withdraw->id); ?>"
                                            data-url="<?php echo e(route('user.withdraw.fetch', $withdraw->id)); ?>">
                                            <?php echo e($withdraw->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="row appendData"></div>
                        </div>
                    </form>
                </div>
            </div>

            
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('style'); ?>
<style>
    .input-group>:not(:first-child):not(.dropdown-menu):not(.valid-tooltip):not(.valid-feedback):not(.invalid-tooltip):not(.invalid-feedback) {
        padding: 8px;
        background: #f0b90b !important;
    }
    .form-control {
        height: 40px;
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script'); ?>

    <script>
        $(function() {
            'use strict'

            $('select[name=method]').on('change', function() {
                if ($(this).val() == '') {
                    $('.appendData').addClass('d-none');
                    $('.instruction').text('');
                    return;
                }
                $('.appendData').removeClass('d-none');
                getData($('select[name=method] option:selected').data('url'))
            })

            $(document).on('keyup', '.amount', function() {
                const withdraw_charge_type = $('.withdraw_charge_type2').text();

                if ($(this).val() == '') {
                    $('.final_amo').val(0);
                    return
                }

                const charge = $('.charge').val();

                if (withdraw_charge_type.localeCompare("percent") == 1) {
                    let percentAmount = Number.parseFloat($(this).val()) - Number.parseFloat((charge * $(
                        this).val()) / 100);

                    $('.final_amo').val(percentAmount.toFixed(2));
                    return
                }
                if (withdraw_charge_type.localeCompare("fixed") == 1) {

                    let totalAmount = Number.parseFloat($(this).val()) - Number.parseFloat(charge);

                    $('.final_amo').val(totalAmount).toFixed(2);
                }
            })

            function getData(url) {
                $.ajax({
                    url: url,
                    method: "GET",
                    success: function(response) {

                        $('.instruction').html(response.withdraw_instruction)
                        let html = `

                                <div class="col-md-12 mb-3 mt-3">
                                    <label for=""><?php echo e(__('Withdraw Amount')); ?> <span class="text-danger">*</span></label>
                                    <input type="number" name="amount" class="form-control amount" required>
                                    <p class="text-small color-change mb-0 mt-1"><span><?php echo e(__('Min Amount & ')); ?>  ${Number.parseFloat(response.min_amount).toFixed(2)}</span> <span><?php echo e(__('Max Amount')); ?> ${Number.parseFloat(response.max_amount).toFixed(2)}</span></p>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label><?php echo e(__('Withdraw Charge')); ?></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control charge" value="${Number.parseFloat(response.charge).toFixed(2)}" required disabled>
                                        <div class="input-group-text">
                                            <span class="withdraw_charge_type">${response.charge_type == 'fixed' ? '<?php echo e($general->site_currency); ?>' : '%'}<span>
                                            <span class="withdraw_charge_type2 d-none">${response.charge_type}<span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label for=""><?php echo e(__('Final Withdraw Amount')); ?> <span class="text-danger">*</span></label>
                                    <input type="text" name="final_amo" class="form-control final_amo" required readonly>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label for=""><?php echo e(__('Withdraw Pin')); ?> <span class="text-danger">*</span></label>
                                    <input style="color: #ffffff !important;" type="text" name="withdraw_pass" class="form-control" required>
                                </div>

                                <div class="col-md-12">
                                   <button class="btn main-btn w-100" type="submit"><?php echo e(__('Withdraw Now')); ?></button>
                                </div>
                   `;

                        $('.appendData').html(html);
                    }
                })
            }
        })
    </script>
    

<?php $__env->stopPush(); ?>

<?php echo $__env->make(template().'layout.master2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u207221236/domains/codeshack.net/public_html/tradedemo/core/resources/views/theme3/user/withdraw/index.blade.php ENDPATH**/ ?>