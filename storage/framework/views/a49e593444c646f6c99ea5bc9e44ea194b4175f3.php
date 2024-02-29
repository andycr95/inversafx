
<?php $__env->startSection('content2'); ?>

<div class="container">
    <div class="card mt-2">
        <div class="card-body text-center">
            <h3 class="pb-2 mb-1 border-bottom">KYC Status</h3>
        </div>
    </div>
</div>

<div class="section my-3">
    <div class="transactions">
        <?php $__currentLoopData = $kyc; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <!-- item -->
        <a href="#" class="item pt-1 pb-1 px-3">
            <div class="detail">
                <img src="https://cdn-icons-png.flaticon.com/512/12195/12195137.png" class="image-block imaged w48" alt="">

                <div>
                    <strong><?php echo e($user->fname); ?></strong>
                    <p>Country: <?php echo e($data->country); ?></p>
                    <p>Card Type: <?php echo e($data->type); ?></p>
                    <p class="small text-secondary">
                        <?php echo e(showDateTime($data->created_at, 'd-m-Y')); ?> | <?php echo e(diffForHumans($data->created_at)); ?>

                    </p>
                </div>
            </div>
            <div align="right" class="col-auto">
                <h5 class="text-danger mb-1">
                    Status
                </h5>
                <?php if($data->status == 1): ?>
                    <span class="badge badge-success style--light"><?php echo app('translator')->get('Verify'); ?></span>
                <?php elseif($data->status == 0): ?>
                    <span class="badge badge-warning style--light"><?php echo app('translator')->get('Pending'); ?></span>
                <?php elseif($data->status == 2): ?>
                    <span class="badge badge-danger style--light"><?php echo app('translator')->get('Rejected'); ?></span>
                <?php endif; ?>
            </div>
        </a>
        <!-- * item -->
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make(template().'layout.master2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/a/Documents/trading/resources/views/theme3/user/kyclist.blade.php ENDPATH**/ ?>