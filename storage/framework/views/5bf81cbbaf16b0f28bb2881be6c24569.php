<?php $__env->startSection('style'); ?>
    <?php echo \Illuminate\View\Factory::parentPlaceholder('style'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('static/less/product.css')); ?>?ver=<?php echo e(config('app.asset_version')); ?>"/>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <?php echo \Illuminate\View\Factory::parentPlaceholder('script'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <ul class="breadcrumb">
        <li><a href="<?php echo e(url('/')); ?>">首頁</a></li>
        <li class="active">訂購專區</li>
    </ul>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<section class="product-section">

    <div class="wrap">
        <h1 class="title p-title">訂購專區</h1>
        <div class="main">

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$goods): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <div class="goods" onclick="window.location.href='<?php echo e(url('product/'.$goods->id)); ?>'">

                    <div class="info scale-effect" >
                        <div class="goods-img"><a href="<?php echo e(url('product/'.$goods->id)); ?>"><img src="<?php echo e(asset('uploads/'.$goods->img)); ?>" alt="<?php echo e($goods->name); ?>"></a></div>
                        <div class="boa">
                            <p class="title"><a href="<?php echo e(url('product/'.$goods->id)); ?>"><?php echo e($goods->name); ?></a></p>
                            <p class="brief"><?php echo $goods->label; ?></p>
                            <div class="price">
                                <p class="market">NT$ <?php echo e(number_format(round($goods->market_price))); ?></p>
                                <p class="now">NT$ <?php echo e(number_format(round($goods->price))); ?></p>
                            </div>

                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>



        </div>

    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('web.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/mac-2312-r/workspace/wwwroot/纤体-減肥/xenicalxshop/xenicalxshop-v1/resources/views/web/product/index.blade.php ENDPATH**/ ?>