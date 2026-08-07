<?php $__env->startSection('style'); ?>
    <?php echo \Illuminate\View\Factory::parentPlaceholder('style'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('static/less/index.css')); ?>?ver=<?php echo e(config('app.asset_version')); ?>"/>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('static/less/product.css')); ?>?ver=<?php echo e(config('app.asset_version')); ?>"/>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <?php echo \Illuminate\View\Factory::parentPlaceholder('script'); ?>

    <script>

        var Swiper5 = new Swiper('.swiper-container-news',{
            slidesPerView : 3,
            slidesPerGroup : 3,
            loop : true,
            pagination: {
                el: '.swiper-pagination-news',
                clickable :true,
            },
        })
    </script>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>

    <section class="ad-section">
        <div class="full-banner" style="background-image: url(<?php echo e(asset_upload(app('cache.config')->get('home_page_banner'))); ?>)"></div>
        <div class="wrap">
            <div class="major">
                <div class="safeguard">
                    <div class="item">
                        <div class="ico"><i class="iconfont" >&#xe614;</i></div>
                        <div class="text">
                            <p class="p1">歐洲原廠</p>
                            <p class="p2">羅氏品質 歐洲製造</p>
                        </div>
                    </div>
                    <div class="item">
                        <div class="ico"><i class="iconfont" style="font-size: 46px;    transform: rotateY(180deg);">&#xe739;</i></div>
                        <div class="text">
                            <p class="p1">運費全免</p>
                            <p class="p2">回饋福利 安心購物</p>
                        </div>
                    </div>
                    <div class="item">
                        <div class="ico"><i class="iconfont">&#xe6de;</i></div>
                        <div class="text">
                            <p class="p1">隱私保護</p>
                            <p class="p2">素盒包裝 保護隱私</p>
                        </div>
                    </div>
                    <div class="item">
                        <div class="ico"><i class="iconfont" style="font-size: 36px;">&#xe6b8;</i></div>
                        <div class="text">
                            <p class="p1">定期回饋</p>
                            <p class="p2">優惠不斷 感恩顧客</p>
                        </div>
                    </div>
                </div>
                <div class="spread">
                    <div class="col-left">
                        <div class="adv a1" style="background-image: url(<?php echo e(asset_upload(app('cache.config')->get('home_adv_1'))); ?>)"></div>
                        <div class="adv a2" style="background-image: url(<?php echo e(asset_upload(app('cache.config')->get('home_adv_2'))); ?>)"></div>
                    </div>

                </div>
            </div>
        </div>
        <section class="about-section">
            <div class="wrapper about">
                <div class="row ab-main"  >
                    <h1 class="ab-title"><?php echo app('cache.config')->get('home_about_title'); ?></h1>

                    <div class="text">
                        <?php echo app('cache.config')->get('home_about'); ?>

                    </div>
                </div>
            </div>
        </section>
    </section>



    <section class="product-section" style="margin-bottom: 100px">

        <div class="wrap">
            <h2 class="title p-title">訂購專區</h2>
            <div class="main">

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$goods): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <div class="goods" onclick="location.href='<?php echo e(url('product/'.$goods->id)); ?>'">
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



    <section class="suit" style="background-image: url(<?php echo e(asset_upload(app('cache.config')->get('for_people_image'))); ?>)">
        <div class="wrapper">
            <div class="suit-head" >
                <h2 class="title">品牌承诺</h2>
            </div>
            <div class="suit-content">
                <?php
                    $people_key=0;
                    $icons = [
                        [
                            'icon'=>'&#xe614;',
                            'style'=>'font-size:50px'
                        ],
                        [
                            'icon'=>'&#xe739;',
                            'style'=>'font-size:50px; transform: rotateY(180deg);'
                        ],
                        [
                            'icon'=>'&#xe699;',
                            'style'=>'font-size:50px'
                        ],
                        [
                            'icon'=>'&#xe6b8;',
                            'style'=>'font-size:50px'
                        ],
                        [
                            'icon'=>'&#xe637;',
                            'style'=>'font-size:50px'
                        ],
                        [
                            'icon'=>'&#xe6de;',
                            'style'=>'font-size:50px'
                        ],
                    ];
                ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $for_people; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="item">
                    <div class="box">
                        <p class="ico"><i class="iconfont" style="<?php echo \Illuminate\Support\Arr::get($icons,$people_key.'.style'); ?>"><?php echo \Illuminate\Support\Arr::get($icons,$people_key.'.icon'); ?></i></p>
                        <p class="text"><?php echo e($item->text); ?></p>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($item->desc)): ?>
                            <p class="desc"><?php echo e($item->desc); ?></p>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>

                </div>
                    <?php
                        $people_key++;
                    ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </div>
    </section>

    <div class="news-section">
        <div class="wrapper">
            <h2 class="news-title">瘦身部落格</h2>
            <div class="news-main">
                <div class="swiper-container swiper-container-news" style="min-height: 580px;">
                    <div class="swiper-wrapper clearfix" style="margin-top: 30px;">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $news; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="swiper-slide">
                                <div class="item">
                                    <div class="img-wrapper">
                                        <a href="<?php echo e(url('news/'.$item->id)); ?>"><img src="<?php echo e(asset_upload($item->img)); ?>" alt="<?php echo e($item->title); ?>"></a>
                                    </div>
                                    <div class="content">
                                        <div class="title-box">
                                            <h3 class="title"><a href="<?php echo e(url('news/'.$item->id)); ?>" title="<?php echo e($item->title); ?>"><?php echo e($item->title); ?></a></h3>
                                        </div>
                                        <div class="stars">
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php for($i=1;$i<=5;$i++): ?>
                                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($item->stars >= $i): ?>
                                                    <i class="iconfont">&#xe9a1;</i>
                                                <?php elseif($i>$item->stars && $item->stars>$i-1): ?>
                                                    <i class="iconfont">&#xe9a3;</i>
                                                <?php else: ?>
                                                    <i class="iconfont">&#xe9a2;</i>
                                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                            <?php endfor; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                                        </div>
                                        <p class="desc"><?php echo e(\Illuminate\Support\Str::limit($item->brief?$item->brief:strip_tags($item->content),116)); ?></p>
                                    </div>
                                </div>
                            </div>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                </div>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(count($news) > 3): ?>
                    <div class="swiper-pagination swiper-pagination-news"></div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </div>
    </div>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(app('cache.config')->get('promote_image')): ?>
        <section class="fraud-section">
            <div class="main">

                    <img width="100%" src="<?php echo e(asset_upload(app('cache.config')->get('promote_image'))); ?>" alt="隱私包裝">

            </div>
        </section>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('web.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/mac-2312-r/workspace/wwwroot/纤体-減肥/xenicalxshop/xenicalxshop-v1/resources/views/web/index.blade.php ENDPATH**/ ?>